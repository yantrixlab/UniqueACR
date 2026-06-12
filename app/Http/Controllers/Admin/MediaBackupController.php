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

    /**
     * Export all active media files as a ZIP download.
     * Writes to a temp file then streams it — avoids loading all file bytes into PHP memory at once.
     */
    public function export(): \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $media = Media::query()->where('is_active', true)->get();

        if ($media->isEmpty()) {
            return back()->with('import_error', 'No media files found to export.');
        }

        // Write ZIP to a dedicated temp path inside storage/app (writable on all hosts)
        $tmpDir  = storage_path('app/tmp');
        if (! is_dir($tmpDir)) {
            @mkdir($tmpDir, 0775, true);
        }
        $zipPath = $tmpDir . '/media-export-' . time() . '.zip';

        $zip = new ZipArchive();
        $result = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if ($result !== true) {
            Log::error('MediaBackup export: ZipArchive::open failed', ['code' => $result, 'path' => $zipPath]);
            return back()->with('import_error', 'Could not create ZIP archive (code: ' . $result . '). Check server write permissions.');
        }

        $added = 0;
        foreach ($media as $item) {
            $disk     = $item->disk ?: 'public';
            $filePath = Storage::disk($disk)->path($item->path);

            if (! file_exists($filePath)) {
                continue;
            }

            // Store with the original path so import can reconstruct it
            $zip->addFile($filePath, $item->path);
            $added++;
        }

        $zip->close();

        if ($added === 0) {
            @unlink($zipPath);
            return back()->with('import_error', 'No physical files found on disk to export.');
        }

        $filename = 'media-backup-' . now()->format('Y-m-d') . '.zip';

        return response()->streamDownload(function () use ($zipPath) {
            // Stream in 1 MB chunks — avoids memory_limit on large ZIPs
            $handle = fopen($zipPath, 'rb');
            while (! feof($handle)) {
                echo fread($handle, 1024 * 1024);
                flush();
            }
            fclose($handle);
            @unlink($zipPath);
        }, $filename, [
            'Content-Type'        => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Length'      => filesize($zipPath),
            'Cache-Control'       => 'no-cache, no-store, must-revalidate',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
        ]);
    }

    /**
     * Restore media from an uploaded ZIP backup.
     * - If DB record already exists for a path → skip (already restored).
     * - If file exists on disk but no DB record → create the record (re-link).
     * - If file is missing from disk → extract from ZIP, then create record.
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $request->validate([
            'zip_file' => ['required', 'file', 'mimes:zip,octet-stream', 'max:524288'],
        ]);

        $force = (bool) $request->input('force_restore', false);

        $zip     = new ZipArchive();
        $tmpPath = $request->file('zip_file')->getPathname();

        $openResult = $zip->open($tmpPath);
        if ($openResult !== true) {
            return back()->with('import_error', 'Invalid or corrupt ZIP file (code: ' . $openResult . ').');
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

            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            if (! in_array($extension, self::ALLOWED_EXTENSIONS)) {
                $skipped++;
                continue;
            }

            // Preserve the full path from the ZIP entry (e.g. "media/products/image.jpg").
            // Sanitise: strip any leading slashes / ".." segments to prevent path traversal.
            $safeParts = array_filter(
                explode('/', $name),
                fn ($seg) => $seg !== '' && $seg !== '..'
            );
            $target = implode('/', $safeParts); // e.g. "media/products/image.jpg"

            // Reject entries outside media/
            if (! str_starts_with($target, 'media/')) {
                $skipped++;
                continue;
            }

            $dbExists   = Media::query()->where('path', $target)->exists();
            $fileExists = Storage::disk('public')->exists($target);

            // Skip only when BOTH the DB record AND the physical file are intact
            if ($dbExists && $fileExists && ! $force) {
                $skipped++;
                continue;
            }

            // Force mode: wipe the old DB record so we create a fresh one
            if ($force && $dbExists) {
                Media::query()->where('path', $target)->delete();
            }

            // 2) File is missing from disk — extract it from the ZIP
            if (! Storage::disk('public')->exists($target)) {
                // Ensure the subdirectory exists (e.g. storage/app/public/media/products/)
                $dir = Storage::disk('public')->path(dirname($target));
                if (! is_dir($dir)) {
                    @mkdir($dir, 0775, true);
                }

                $contents = $zip->getFromIndex($i);
                if ($contents === false) {
                    Log::warning('MediaBackup import: could not read entry from ZIP', ['name' => $name]);
                    $errors++;
                    continue;
                }

                if (! Storage::disk('public')->put($target, $contents)) {
                    Log::warning('MediaBackup import: could not write file to disk', ['target' => $target]);
                    $errors++;
                    continue;
                }
                $imported++;
            } else {
                // 3) File exists on disk but no DB record — just re-create the record
                $relinked++;
            }

            try {
                $mediaService->createFromPath($target);
            } catch (\Throwable $e) {
                Log::error('MediaBackup import: createFromPath failed', ['target' => $target, 'error' => $e->getMessage()]);
                $errors++;
            }
        }

        $zip->close();

        $parts = [];
        if ($imported)  $parts[] = "{$imported} files extracted & added";
        if ($relinked)  $parts[] = "{$relinked} existing files re-linked to library";
        if ($skipped)   $parts[] = "{$skipped} skipped (already in library or unsupported)";
        if ($errors)    $parts[] = "{$errors} errors (check logs)";

        $msg = $parts ? implode(', ', $parts) . '.' : 'Nothing to restore — all files already in library.';

        return back()->with(
            $errors && ! $imported && ! $relinked ? 'import_error' : 'import_success',
            'Restore complete: ' . $msg
        );
    }
}
