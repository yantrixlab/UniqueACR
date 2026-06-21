<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Media;
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['description_html'] = $data['description'] ?? '';

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $mediaIds = $this->form->getRawState()['image_media_ids'] ?? [];

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

        if (($this->data['description_mode'] ?? 'visual') === 'html') {
            $data['description'] = $this->data['description_html'] ?? $data['description'];
        }

        unset($data['description_html']);

        return $data;
    }
}
