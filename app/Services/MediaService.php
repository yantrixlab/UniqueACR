<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    public function createFromPath(string $path, ?int $categoryId = null): Media
    {
        $disk = 'public';
        $fullPath = Storage::disk($disk)->path($path);

        $mimeType = Storage::disk($disk)->mimeType($path) ?: null;
        $size = Storage::disk($disk)->size($path) ?: 0;
        $originalName = basename($path);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $fileType = Str::startsWith((string) $mimeType, 'image/') ? 'image' : 'file';

        return Media::query()->create([
            'media_category_id' => $categoryId,
            'title' => pathinfo($originalName, PATHINFO_FILENAME),
            'original_name' => $originalName,
            'file_name' => basename($fullPath),
            'path' => $path,
            'disk' => $disk,
            'mime_type' => $mimeType,
            'size' => $size,
            'extension' => $extension,
            'file_type' => $fileType,
            'is_active' => true,
        ]);
    }
}

