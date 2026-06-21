<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Models\Media;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditBlogPost extends EditRecord
{
    protected static string $resource = BlogPostResource::class;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $mediaId = $this->data['featured_image_media_id'] ?? null;

        if ($mediaId) {
            $media = Media::query()->find($mediaId);
            $data['featured_image'] = $media?->path;
        }

        if (($this->data['content_mode'] ?? 'visual') === 'html') {
            $data['content'] = $this->data['content_html'] ?? $data['content'];
        }

        return $data;
    }
}
