<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Forms\Components\MediaPicker;
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
                Select::make('service_category_id')
                    ->relationship('category', 'name')
                    ->label('Service category')
                    ->searchable()
                    ->preload()
                    ->required(),
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
                MediaPicker::make('image_media_id')
                    ->label('Image')
                    ->directory('media/services')
                    ->columnSpanFull()
                    ->dehydrated(false),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
