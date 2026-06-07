<?php

namespace App\Filament\Forms\Components;

use App\Models\Media;
use App\Services\MediaService;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

/**
 * An "Image" input with a button beside it that opens a modal Image Picker:
 * a grid of every image in the Media Library to choose from, plus an
 * uploader for adding brand new images — all in one place.
 *
 * The field's dehydrated state is always media IDs (single id, or an array
 * of ids when ->multiple()), so it's a drop-in replacement for the old
 * "Select existing" + "Upload new" field pairs.
 */
class MediaPicker extends Field
{
    /**
     * @var view-string
     */
    protected string $view = 'filament.forms.components.media-picker';

    protected bool $isMultiple = false;

    protected string $uploadDirectory = 'media';

    public function multiple(bool $condition = true): static
    {
        $this->isMultiple = $condition;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->isMultiple;
    }

    public function directory(string $directory): static
    {
        $this->uploadDirectory = $directory;

        return $this;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerActions([
            fn (): Action => Action::make('pickImages')
                ->label(fn (): string => filled($this->getState())
                    ? ($this->isMultiple ? 'Change images' : 'Change image')
                    : ($this->isMultiple ? 'Choose images' : 'Choose image'))
                ->color('gray')
                ->modalHeading($this->isMultiple ? 'Select images' : 'Select an image')
                ->modalSubmitActionLabel('Use selected')
                ->modalWidth('4xl')
                ->fillForm(fn (): array => [
                    'selected' => $this->getState(),
                ])
                ->schema([
                    MediaGridSelect::make('selected')
                        ->label('Image library')
                        ->multiple($this->isMultiple),
                    FileUpload::make('newUploads')
                        ->label($this->isMultiple ? 'Or upload new images' : 'Or upload a new image')
                        ->image()
                        ->multiple($this->isMultiple)
                        ->disk('public')
                        ->directory($this->uploadDirectory)
                        ->visibility('public'),
                ])
                ->action(function (array $data): void {
                    $selected = $data['selected'] ?? ($this->isMultiple ? [] : null);
                    $uploaded = Arr::wrap($data['newUploads'] ?? []);

                    $newIds = collect($uploaded)
                        ->filter()
                        ->map(fn (string $path) => app(MediaService::class)->createFromPath($path)->id)
                        ->values();

                    if ($this->isMultiple) {
                        $this->state(
                            collect(Arr::wrap($selected))
                                ->merge($newIds)
                                ->filter()
                                ->unique()
                                ->values()
                                ->all()
                        );

                        return;
                    }

                    $this->state($newIds->first() ?? $selected);
                }),
        ]);
    }

    public function getSelectedMedia(): Collection
    {
        $state = $this->getState();
        $ids = array_values(array_filter(
            $this->isMultiple ? Arr::wrap($state) : [$state]
        ));

        if ($ids === []) {
            return new Collection();
        }

        return Media::query()
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(fn (Media $media) => array_search($media->id, $ids))
            ->values();
    }
}
