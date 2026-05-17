<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $selectedMediaId = $this->data['image_media_id'] ?? null;
        $uploadedPath = $this->data['image_upload'] ?? null;

        if ($uploadedPath) {
            $media = app(MediaService::class)->createFromPath($uploadedPath);
            $data['image_path'] = $media->path;
        } elseif ($selectedMediaId) {
            $media = Media::query()->find($selectedMediaId);
            $data['image_path'] = $media?->path;
        }

        return $data;
    }
}
