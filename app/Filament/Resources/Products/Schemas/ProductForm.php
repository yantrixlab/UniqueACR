<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Forms\Components\MediaPicker;
use App\Models\Brand;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
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
                    ->options(fn () => Brand::where('is_active', true)->orderBy('name')->pluck('name', 'name')->toArray())
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')->required()->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data): string {
                        Brand::create([
                            'name'      => $data['name'],
                            'slug'      => \Illuminate\Support\Str::slug($data['name']),
                            'is_active' => true,
                        ]);
                        return $data['name'];
                    }),
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
                RichEditor::make('description')
                    ->required()
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike',
                        'h2', 'h3',
                        'bulletList', 'orderedList',
                        'link', 'blockquote',
                        'redo', 'undo',
                    ])
                    ->columnSpanFull(),
                KeyValue::make('specifications')
                    ->label('Specifications')
                    ->keyLabel('Property')
                    ->valueLabel('Value')
                    ->addActionLabel('Add Specification')
                    ->reorderable()
                    ->columnSpanFull(),
                MediaPicker::make('image_media_ids')
                    ->label('Images')
                    ->multiple()
                    ->directory('media/products')
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
