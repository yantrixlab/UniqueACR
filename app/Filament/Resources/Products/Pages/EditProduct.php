<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $paths = [];
        $selectedMediaIds = $this->data['image_media_ids'] ?? [];
        $uploadedPaths = $this->data['image_uploads'] ?? [];

        foreach ($selectedMediaIds as $mediaId) {
            $media = Media::query()->find($mediaId);
            if ($media?->path) {
                $paths[] = $media->path;
            }
        }

        foreach ($uploadedPaths as $uploadedPath) {
            $media = app(MediaService::class)->createFromPath($uploadedPath);
            $paths[] = $media->path;
        }

        if ($paths !== []) {
            $data['images'] = array_values(array_unique($paths));
        }

        return $data;
    }
}
