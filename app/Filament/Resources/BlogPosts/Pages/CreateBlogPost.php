<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Models\Media;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    public function getMaxWidth(): Width | string | null
    {
        return Width::Full;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $mediaId = $this->data['featured_image_media_id'] ?? null;

        if ($mediaId) {
            $media = Media::query()->find($mediaId);
            $data['featured_image'] = $media?->path;
        }

        return $data;
    }
}
