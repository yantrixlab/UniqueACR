<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Media;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $mediaIds = $this->data['image_media_ids'] ?? [];

        $paths = Media::query()
            ->whereIn('id', $mediaIds)
            ->get()
            ->sortBy(fn (Media $media) => array_search($media->id, $mediaIds))
            ->pluck('path')
            ->filter()
            ->values()
            ->all();

        if ($paths !== []) {
            $data['images'] = $paths;
        }

        return $data;
    }
}
