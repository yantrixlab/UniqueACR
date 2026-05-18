<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class MediaLibrary extends Page
{
    use WithFileUploads;

    protected static string $resource = MediaResource::class;

    protected string $view = 'filament.resources.media.pages.media-library';

    public array $uploads = [];

    public string $search = '';

    public string $tab = 'all';

    public string $sortBy = 'latest';

    public function uploadFiles(): void
    {
        $this->validate([
            'uploads' => ['required', 'array', 'min:1'],
            'uploads.*' => ['file', 'max:51200'],
        ]);

        foreach ($this->uploads as $file) {
            if (! $file instanceof TemporaryUploadedFile) {
                continue;
            }

            $storedPath = $file->store('media', 'public');
            app(MediaService::class)->createFromPath($storedPath);
        }

        $this->uploads = [];

        Notification::make()
            ->title('Files uploaded')
            ->success()
            ->send();
    }

    public function removeMedia(int $id): void
    {
        Media::query()->whereKey($id)->delete();

        Notification::make()
            ->title('Media removed')
            ->success()
            ->send();
    }

    public function getMediaItemsProperty(): Collection
    {
        if (! Schema::hasTable('media')) {
            return collect();
        }

        $query = Media::query()
            ->where('is_active', true);

        if ($this->tab === 'images') {
            $query->where('file_type', 'image');
        } elseif ($this->tab === 'files') {
            $query->where('file_type', 'file');
        }

        if ($this->search !== '') {
            $query->where(function ($q): void {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('original_name', 'like', '%'.$this->search.'%');
            });
        }

        $query
            ->when($this->sortBy === 'latest', fn ($q) => $q->orderByDesc('updated_at'))
            ->when($this->sortBy === 'oldest', fn ($q) => $q->orderBy('updated_at'))
            ->when($this->sortBy === 'name', fn ($q) => $q->orderBy('title'));

        return $query->limit(200)->get();
    }

    protected function getViewData(): array
    {
        return [
            'mediaItems' => $this->mediaItems,
        ];
    }
}
