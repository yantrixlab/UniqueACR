<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Models\Media;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $mediaId = $this->data['image_media_id'] ?? null;

        if ($mediaId) {
            $media = Media::query()->find($mediaId);
            $data['image_path'] = $media?->path;
        }

        if (($this->data['description_mode'] ?? 'visual') === 'html') {
            $data['description'] = $this->data['description_html'] ?? $data['description'];
        }

        unset($data['description_html']);

        return $data;
    }
}
