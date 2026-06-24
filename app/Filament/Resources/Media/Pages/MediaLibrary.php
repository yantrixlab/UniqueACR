<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use App\Models\Media;
use App\Services\MediaService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
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

    public bool $isLoadingMedia = true;

    public Collection $mediaItems;

    public function mount(): void
    {
        $this->mediaItems = collect();
    }

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
        $this->loadMediaItems();

        Notification::make()
            ->title('Files uploaded')
            ->success()
            ->send();
    }

    /**
     * Scan the public disk media/ directory and create DB records for any
     * files that exist on disk but have no record in the database.
     * This is the zero-upload restore path — no ZIP needed.
     */
    public function scanAndSync(): void
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $mediaService = app(MediaService::class);
        $synced  = 0;
        $skipped = 0;

        $allFiles = Storage::disk('public')->allFiles('media');

        $existing = Media::query()
            ->whereIn('path', $allFiles)
            ->pluck('path')
            ->flip(); // path => index for O(1) lookup

        foreach ($allFiles as $path) {
            // Skip hidden/system files
            if (str_starts_with(basename($path), '.')) {
                continue;
            }

            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp','svg','pdf','docx','xlsx','csv','mp4','mp3'];

            if (! in_array($ext, $allowed)) {
                continue;
            }

            if ($existing->has($path)) {
                $skipped++;
                continue;
            }

            try {
                $mediaService->createFromPath($path);
                $synced++;
            } catch (\Throwable) {
                // skip unreadable files silently
            }
        }

        $this->loadMediaItems();

        Notification::make()
            ->title("Scan complete: {$synced} files added to library" . ($skipped ? ", {$skipped} already existed." : '.'))
            ->success()
            ->send();
    }

    public function removeMedia(int $id): void
    {
        Media::query()->whereKey($id)->delete();

        $this->loadMediaItems();

        Notification::make()
            ->title('Media removed')
            ->success()
            ->send();
    }

    /**
     * Deferred via wire:init so the page shell paints immediately and a
     * loading state is visible while this (potentially expensive, up to
     * 200-row + thumbnail) query runs, instead of blocking the entire
     * initial page response.
     */
    public function loadMediaItems(): void
    {
        if (! Schema::hasTable('media')) {
            $this->mediaItems = collect();
            $this->isLoadingMedia = false;

            return;
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

        $this->mediaItems = $query->limit(200)->get();
        $this->isLoadingMedia = false;
    }

    public function updatedTab(): void
    {
        $this->loadMediaItems();
    }

    public function updatedSearch(): void
    {
        $this->loadMediaItems();
    }

    public function updatedSortBy(): void
    {
        $this->loadMediaItems();
    }
}
