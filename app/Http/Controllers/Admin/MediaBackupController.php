<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class MediaBackupController extends Controller
{
    private const ALLOWED_EXTENSIONS = ['jpg','jpeg','png','gif','webp','svg','pdf','docx','xlsx','csv','mp4','mp3'];
    private const BACKUP_PATH        = 'app/backups/media-backup-latest.zip';

    // ─────────────────────────────────────────────────────────
    // EXPORT
    // ─────────────────────────────────────────────────────────

    public function export(): \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $media = Media::query()->where('is_active', true)->get();

        if ($media->isEmpty()) {
            return back()->with('import_error', 'No media files found to export.');
        }

        $backupDir = storage_path('app/backups');
        if (! is_dir($backupDir)) {
            @mkdir($backupDir, 0775, true);
        }

        // Keep at a fixed name so it can be restored from server without re-upload
        $zipPath = storage_path(self::BACKUP_PATH);

        $zip    = new ZipArchive();
        $result = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if ($result !== true) {
            Log::error('MediaBackup export: ZipArchive::open failed', ['code' => $result]);
            return back()->with('import_error', 'Could not create ZIP (code: ' . $result . '). Check server write permissions.');
        }

        $added = 0;
        foreach ($media as $item) {
            $filePath = Storage::disk($item->disk ?: 'public')->path($item->path);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $item->path);
                $added++;
            }
        }

        $zip->close();

        if ($added === 0) {
            @unlink($zipPath);
            return back()->with('import_error', 'No physical files found on disk to export.');
        }

        $filename = 'media-backup-' . now()->format('Y-m-d') . '.zip';

        // Stream in chunks — backup file stays on server for one-click restore
        return response()->streamDownload(function () use ($zipPath) {
            $handle = fopen($zipPath, 'rb');
            while (! feof($handle)) {
                echo fread($handle, 1024 * 1024);
                flush();
            }
            fclose($handle);
        }, $filename, [
            'Content-Type'        => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Length'      => filesize($zipPath),
            'Cache-Control'       => 'no-cache, no-store, must-revalidate',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
        ]);
    }

    // ─────────────────────────────────────────────────────────
    // BACKUP STATUS (called via JS to show/hide server restore button)
    // ─────────────────────────────────────────────────────────

    public function backupStatus(): \Illuminate\Http\JsonResponse
    {
        $path = storage_path(self::BACKUP_PATH);

        if (! file_exists($path)) {
            return response()->json(['exists' => false]);
        }

        return response()->json([
            'exists'   => true,
            'size'     => round(filesize($path) / 1024 / 1024, 1) . ' MB',
            'modified' => date('Y-m-d H:i', filemtime($path)),
        ]);
    }

    // ─────────────────────────────────────────────────────────
    // RESTORE FROM SERVER BACKUP (no upload required)
    // ─────────────────────────────────────────────────────────

    public function restoreFromServer(Request $request): \Illuminate\Http\RedirectResponse
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $zipPath = storage_path(self::BACKUP_PATH);

        if (! file_exists($zipPath)) {
            return back()->with('import_error', 'No server backup found. Click "Export ZIP" first to create one.');
        }

        return $this->runRestore($zipPath, force: true);
    }

    // ─────────────────────────────────────────────────────────
    // IMPORT FROM UPLOADED ZIP
    // ─────────────────────────────────────────────────────────

    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $request->validate([
            'zip_file' => ['required', 'file', 'max:524288'], // 512 MB — mime check skipped (unreliable across hosts)
        ]);

        $zipPath = $request->file('zip_file')->getPathname();
        $force   = (bool) $request->input('force_restore', false);

        return $this->runRestore($zipPath, $force);
    }

    // ─────────────────────────────────────────────────────────
    // CHUNKED UPLOAD  (each chunk ≤ 5 MB — stays under PHP limits)
    // ─────────────────────────────────────────────────────────

    /**
     * Receive one chunk and append it to the temp assembly file.
     * Expects: chunk (file), uuid (string), index (int), total (int)
     */
    /**
     * Receive one raw binary chunk via request body.
     * UUID, index, total are query-string params.
     * Using raw body (not multipart file upload) means upload_max_filesize does NOT apply —
     * only post_max_size does, which is always larger (default 8 MB vs 2 MB).
     */
    public function chunkUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $uuid  = $request->query('uuid', '');
        $index = (int) $request->query('index', 0);

        // Validate uuid is safe for use as a directory name
        if (! preg_match('/^[a-f0-9\-]{32,64}$/', $uuid)) {
            return response()->json(['ok' => false, 'error' => 'Invalid upload session.'], 422);
        }

        $contents = $request->getContent(); // raw binary — no upload_max_filesize limit
        if ($contents === '') {
            return response()->json(['ok' => false, 'error' => 'Empty chunk received.'], 422);
        }

        $dir = storage_path('app/chunks/' . $uuid);
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        file_put_contents("{$dir}/{$index}.part", $contents);

        return response()->json(['ok' => true, 'index' => $index]);
    }

    /**
     * All chunks received — assemble them in order, then run the restore.
     * Expects: uuid (string), total (int), force (bool)
     */
    public function chunkAssemble(Request $request): \Illuminate\Http\JsonResponse
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $request->validate([
            'uuid'  => ['required', 'string', 'alpha_dash', 'max:64'],
            'total' => ['required', 'integer', 'min:1'],
        ]);

        $uuid  = $request->input('uuid');
        $total = (int) $request->input('total');
        $force = (bool) $request->input('force', true);
        $dir   = storage_path('app/chunks/' . $uuid);

        // Verify all parts arrived
        for ($i = 0; $i < $total; $i++) {
            if (! file_exists("{$dir}/{$i}.part")) {
                return response()->json(['ok' => false, 'error' => "Missing chunk {$i}"], 422);
            }
        }

        // Assemble into the standard backup path
        $backupDir = storage_path('app/backups');
        if (! is_dir($backupDir)) {
            mkdir($backupDir, 0775, true);
        }
        $zipPath = storage_path(self::BACKUP_PATH);

        $out = fopen($zipPath, 'wb');
        for ($i = 0; $i < $total; $i++) {
            $part = "{$dir}/{$i}.part";
            fwrite($out, file_get_contents($part));
            unlink($part);
        }
        fclose($out);
        rmdir($dir);

        // Verify it's a valid ZIP before restoring
        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            return response()->json(['ok' => false, 'message' => 'Assembly failed — result is not a valid ZIP. Try again.'], 422);
        }
        $zip->close();

        // Run restore — returns result array directly when $returnResult is true
        [$imported, $relinked, $skipped, $errors] = $this->doRestore($zipPath, $force);

        $parts = [];
        if ($imported) $parts[] = "{$imported} files restored to disk & library";
        if ($relinked) $parts[] = "{$relinked} files re-linked to library";
        if ($skipped)  $parts[] = "{$skipped} skipped";
        if ($errors)   $parts[] = "{$errors} errors";

        $msg = $parts ? implode(', ', $parts) . '.' : 'All files already intact.';
        $ok  = $imported > 0 || $relinked > 0 || ($skipped > 0 && $errors === 0);

        return response()->json(['ok' => $ok, 'message' => 'Restore complete: ' . $msg]);
    }

    // ─────────────────────────────────────────────────────────
    // SHARED RESTORE LOGIC
    // ─────────────────────────────────────────────────────────

    private function runRestore(string $zipPath, bool $force = false): \Illuminate\Http\RedirectResponse
    {
        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            return back()->with('import_error', 'Could not open ZIP file. The file may be corrupt.');
        }
        $zip->close();

        [$imported, $relinked, $skipped, $errors] = $this->doRestore($zipPath, $force);

        $parts = [];
        if ($imported) $parts[] = "{$imported} files restored to disk & library";
        if ($relinked) $parts[] = "{$relinked} files re-linked to library";
        if ($skipped)  $parts[] = "{$skipped} skipped";
        if ($errors)   $parts[] = "{$errors} errors (check logs)";

        $msg  = $parts ? implode(', ', $parts) . '.' : 'Nothing to restore — all files already intact.';
        $type = ($errors && ! $imported && ! $relinked) ? 'import_error' : 'import_success';

        return back()->with($type, 'Restore complete: ' . $msg);
    }

    /** Returns [imported, relinked, skipped, errors] */
    private function doRestore(string $zipPath, bool $force = false): array
    {
        $zip = new ZipArchive();
        $zip->open($zipPath);

        $mediaService = app(MediaService::class);
        $imported = 0;
        $relinked = 0;
        $skipped  = 0;
        $errors   = 0;

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);

            if (str_ends_with($name, '/') || str_starts_with(basename($name), '.')) {
                continue;
            }

            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (! in_array($ext, self::ALLOWED_EXTENSIONS)) {
                $skipped++;
                continue;
            }

            $parts  = array_filter(explode('/', $name), fn ($s) => $s !== '' && $s !== '..');
            $target = implode('/', $parts);

            if (! str_starts_with($target, 'media/')) {
                $skipped++;
                continue;
            }

            $dbExists   = Media::query()->where('path', $target)->exists();
            $fileExists = Storage::disk('public')->exists($target);

            if ($dbExists && $fileExists && ! $force) {
                $skipped++;
                continue;
            }

            if ($force && $dbExists) {
                Media::query()->where('path', $target)->delete();
                $dbExists = false;
            }

            if (! $fileExists || $force) {
                $dir = Storage::disk('public')->path(dirname($target));
                if (! is_dir($dir)) {
                    mkdir($dir, 0775, true);
                }

                $contents = $zip->getFromIndex($i);
                if ($contents === false) {
                    Log::warning('MediaBackup: unreadable ZIP entry', ['name' => $name]);
                    $errors++;
                    continue;
                }

                if (! Storage::disk('public')->put($target, $contents)) {
                    Log::warning('MediaBackup: could not write to disk', ['target' => $target]);
                    $errors++;
                    continue;
                }

                $imported++;
            } else {
                $relinked++;
            }

            try {
                $mediaService->createFromPath($target);
            } catch (\Throwable $e) {
                Log::error('MediaBackup: createFromPath failed', ['target' => $target, 'error' => $e->getMessage()]);
                $errors++;
            }
        }

        $zip->close();

        return [$imported, $relinked, $skipped, $errors];
    }
}
