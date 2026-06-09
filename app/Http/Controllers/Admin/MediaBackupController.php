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

            // Stream from ZIP and store to public disk preserving path
            $contents = $zip->getFromIndex($i);
            $target   = 'media/' . basename($name);

            // Don't overwrite existing files
            if (Storage::disk('public')->exists($target)) {
                // Generate unique name
                $target = 'media/' . Str::uuid() . '.' . $extension;
            }

            Storage::disk('public')->put($target, $contents);
            $mediaService->createFromPath($target);
            $extracted++;
        }

        $zip->close();

        return back()->with('import_success', "Import complete: {$extracted} files imported" . ($skipped ? ", {$skipped} skipped (unsupported type)." : '.'));
    }
}
