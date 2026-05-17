<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $selectedMediaId = $this->data['featured_image_media_id'] ?? null;
        $uploadedPath = $this->data['featured_image_upload'] ?? null;

        if ($uploadedPath) {
            $media = app(MediaService::class)->createFromPath($uploadedPath);
            $data['featured_image'] = $media->path;
        } elseif ($selectedMediaId) {
            $media = Media::query()->find($selectedMediaId);
            $data['featured_image'] = $media?->path;
        }

        return $data;
    }
}
