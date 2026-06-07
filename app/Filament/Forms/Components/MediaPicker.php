<?php

namespace App\Filament\Forms\Components;

use App\Models\Media;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Collection;

class MediaPicker extends Field
{
    /**
     * @var view-string
     */
    protected string $view = 'filament.forms.components.media-picker';

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
