<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class MediaBackupController extends Controller
{
    /**
     * Export all media files as a ZIP download.
     */
    public function export(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $media = Media::query()->where('is_active', true)->get();

        $zipPath = storage_path('app/media-backup-' . now()->format('Y-m-d-His') . '.zip');
        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Could not create ZIP archive.');
        }

        foreach ($media as $item) {
            $filePath = Storage::disk($item->disk ?: 'public')->path($item->path);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $item->path);
            }
        }

        $zip->close();

        return response()->streamDownload(function () use ($zipPath) {
            echo file_get_contents($zipPath);
            @unlink($zipPath);
        }, 'media-backup-' . now()->format('Y-m-d') . '.zip', [
            'Content-Type' => 'application/zip',
        ]);
    }

    /**
     * Import media files from an uploaded ZIP archive.
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'zip_file' => ['required', 'file', 'mimes:zip', 'max:512000'], // 500 MB max
        ]);

        $zip = new ZipArchive();
        $uploaded = $request->file('zip_file');
        $tmpPath  = $uploaded->getPathname();

        if ($zip->open($tmpPath) !== true) {
            return back()->with('import_error', 'Invalid or corrupt ZIP file.');
        }

        $extracted = 0;
        $restored  = 0;
        $skipped   = 0;
        $mediaService = app(MediaService::class);

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);

            // Skip directories and hidden/system files
            if (str_ends_with($name, '/') || str_starts_with(basename($name), '.')) {
                continue;
            }

            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $allowed   = ['jpg','jpeg','png','gif','webp','svg','pdf','docx','xlsx','csv','zip','mp4','mp3'];

            if (! in_array($extension, $allowed)) {
                $skipped++;
                continue;
            }

            // Preserve the original path from the ZIP entry (e.g. "media/filename.jpg")
            $target = 'media/' . basename($name);

            // If a DB record already exists for this path, nothing to do
            if (Media::query()->where('path', $target)->exists()) {
                $restored++;
                continue;
            }

            // If the physical file is missing, write it from the ZIP
            if (! Storage::disk('public')->exists($target)) {
                $contents = $zip->getFromIndex($i);
                Storage::disk('public')->put($target, $contents);
            }

            // Create the DB record pointing to the original path
            $mediaService->createFromPath($target);
            $extracted++;
        }

        $zip->close();

        $msg = "Import complete: {$extracted} files restored to library";
        if ($restored)  $msg .= ", {$restored} already existed (skipped)";
        if ($skipped)   $msg .= ", {$skipped} skipped (unsupported type)";

        return back()->with('import_success', $msg . '.');
    }
}
