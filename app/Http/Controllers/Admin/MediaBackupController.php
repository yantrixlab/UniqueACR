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
    // SHARED RESTORE LOGIC
    // ─────────────────────────────────────────────────────────

    private function runRestore(string $zipPath, bool $force = false): \Illuminate\Http\RedirectResponse
    {
        $zip        = new ZipArchive();
        $openResult = $zip->open($zipPath);

        if ($openResult !== true) {
            return back()->with('import_error', 'Could not open ZIP file (code: ' . $openResult . '). The file may be corrupt.');
        }

        $mediaService = app(MediaService::class);
        $imported = 0;
        $relinked = 0;
        $skipped  = 0;
        $errors   = 0;

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);

            // Skip directory entries and hidden/system files
            if (str_ends_with($name, '/') || str_starts_with(basename($name), '.')) {
                continue;
            }

            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (! in_array($ext, self::ALLOWED_EXTENSIONS)) {
                $skipped++;
                continue;
            }

            // Sanitise path — preserve subdirectories, strip ".." / absolute parts
            $parts  = array_filter(explode('/', $name), fn ($s) => $s !== '' && $s !== '..');
            $target = implode('/', $parts); // e.g. "media/products/image.jpg"

            if (! str_starts_with($target, 'media/')) {
                $skipped++;
                continue;
            }

            $dbExists   = Media::query()->where('path', $target)->exists();
            $fileExists = Storage::disk('public')->exists($target);

            // Truly intact — skip
            if ($dbExists && $fileExists && ! $force) {
                $skipped++;
                continue;
            }

            // Force: delete stale DB record so we recreate it fresh
            if ($force && $dbExists) {
                Media::query()->where('path', $target)->delete();
                $dbExists = false;
            }

            // Write file to disk if it's missing
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
                $relinked++; // file on disk, just missing DB record
            }

            try {
                $mediaService->createFromPath($target);
            } catch (\Throwable $e) {
                Log::error('MediaBackup: createFromPath failed', ['target' => $target, 'error' => $e->getMessage()]);
                $errors++;
            }
        }

        $zip->close();

        $parts = [];
        if ($imported) $parts[] = "{$imported} files restored to disk & library";
        if ($relinked) $parts[] = "{$relinked} files re-linked to library";
        if ($skipped)  $parts[] = "{$skipped} skipped";
        if ($errors)   $parts[] = "{$errors} errors (check logs)";

        $msg  = $parts ? implode(', ', $parts) . '.' : 'Nothing to restore — all files already intact.';
        $type = ($errors && ! $imported && ! $relinked) ? 'import_error' : 'import_success';

        return back()->with($type, 'Restore complete: ' . $msg);
    }
}
