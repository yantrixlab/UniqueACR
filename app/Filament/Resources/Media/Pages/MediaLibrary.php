<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class MediaLibrary extends Page
{
    protected static string $resource = MediaResource::class;

    protected static string $view = 'filament.resources.media.pages.media-library';

    public array $uploads = [];

    public string $search = '';

    public string $tab = 'all';

    public string $sortBy = 'latest';

    public function uploadFiles(): void
    {
        $this->validate([
            'uploads' => ['required', 'array', 'min:1'],
            'uploads.*' => ['string'],
        ]);

        foreach ($this->uploads as $path) {
            app(MediaService::class)->createFromPath($path);
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

    public function render(): View
    {
        return view($this->getView(), [
            'mediaItems' => $this->mediaItems,
        ]);
    }
}
