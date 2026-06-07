<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Forms\Components\MediaPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, ?string $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug((string) $state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Select::make('brand')
                    ->options([
                        'Daikin' => 'Daikin',
                        'Voltas' => 'Voltas',
                        'OGeneral' => 'OGeneral',
                    ])
                    ->searchable()
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₹'),
                TextInput::make('discount_price')
                    ->numeric()
                    ->prefix('₹'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('specifications')
                    ->helperText('Use valid JSON, e.g. {"Capacity":"1.5 Ton","Energy Rating":"5 Star"}')
                    ->columnSpanFull(),
                MediaPicker::make('image_media_ids')
                    ->label('Pick from Image Library')
                    ->multiple()
                    ->columnSpanFull()
                    ->dehydrated(false),
                FileUpload::make('image_uploads')
                    ->label('Or Upload New Images')
                    ->multiple()
                    ->image()
                    ->disk('public')
                    ->directory('media/products')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->dehydrated(false),
                Textarea::make('images')
                    ->helperText('Auto-managed from selected/uploaded images. JSON array of relative paths.')
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->maxLength(255),
                Textarea::make('meta_description')
                    ->maxLength(320),
                Toggle::make('is_featured'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
