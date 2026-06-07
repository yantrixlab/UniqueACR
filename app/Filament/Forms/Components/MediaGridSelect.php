<?php

namespace App\Filament\Forms\Components;

use App\Models\Media;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Collection;

/**
 * Renders a clickable grid of image thumbnails (radio for single-select,
 * checkboxes for multi-select) bound to the field's state via wire:model.
 * Used inside the MediaPicker's modal to browse the existing image library.
 */
class MediaGridSelect extends Field
{
    /**
     * @var view-string
     */
    protected string $view = 'filament.forms.components.media-grid-select';

    protected bool $isMultiple = false;

    public function multiple(bool $condition = true): static
    {
        $this->isMultiple = $condition;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->isMultiple;
    }

    public function getMediaItems(): Collection
    {
        return Media::query()
            ->where('file_type', 'image')
            ->orderByDesc('id')
            ->limit(300)
            ->get();
    }
}
