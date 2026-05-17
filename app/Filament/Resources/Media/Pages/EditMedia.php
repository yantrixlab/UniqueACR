<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditMedia extends EditRecord
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $path = $data['path'] ?? '';
        $disk = 'public';
        $mime = $path ? Storage::disk($disk)->mimeType($path) : null;

        $data['original_name'] = basename((string) $path);
        $data['file_name'] = basename((string) $path);
        $data['disk'] = $disk;
        $data['mime_type'] = $mime;
        $data['size'] = $path ? (Storage::disk($disk)->size($path) ?: 0) : 0;
        $data['extension'] = pathinfo((string) $path, PATHINFO_EXTENSION);
        $data['file_type'] = Str::startsWith((string) $mime, 'image/') ? 'image' : 'file';
        $data['title'] = $data['title'] ?: pathinfo((string) basename((string) $path), PATHINFO_FILENAME);

        return $data;
    }
}

