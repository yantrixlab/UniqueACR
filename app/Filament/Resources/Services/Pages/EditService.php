<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
