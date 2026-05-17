<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBlogPost extends EditRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
