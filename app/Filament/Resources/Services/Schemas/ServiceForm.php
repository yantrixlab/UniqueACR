<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Models\Media;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('service_category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, ?string $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug((string) $state)) : null),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('service_type')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('image_media_id')
                    ->label('Select Existing Image')
                    ->options(fn () => Media::query()->where('file_type', 'image')->orderByDesc('id')->limit(500)->get()->mapWithKeys(fn (Media $media) => [$media->id => ($media->title ?: $media->original_name).' (#'.$media->id.')'])->all())
                    ->searchable()
                    ->dehydrated(false),
                FileUpload::make('image_upload')
                    ->label('Or Upload New Image')
                    ->image()
                    ->disk('public')
                    ->directory('media/services')
                    ->visibility('public')
                    ->dehydrated(false),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
