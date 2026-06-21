<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Forms\Components\MediaPicker;
use App\Filament\Forms\Components\SafeRichEditor;
use App\Models\Brand;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
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
                            'name' => $data['name'],
                            'slug' => Str::slug($data['name']),
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
                Section::make('Description')
                    ->headerActions([
                        Action::make('toggleDescriptionHtmlMode')
                            ->label(fn (Get $get): string => $get('description_mode') === 'html' ? 'Visual' : 'HTML')
                            ->icon(fn (Get $get): Heroicon => $get('description_mode') === 'html' ? Heroicon::Bars3BottomLeft : Heroicon::CodeBracket)
                            ->color('gray')
                            ->action(function (Get $get, Set $set): void {
                                if ($get('description_mode') === 'html') {
                                    $set('description', $get('description_html'));
                                    $set('description_mode', 'visual');

                                    return;
                                }

                                if (blank($get('description_html'))) {
                                    $set('description_html', $get('description'));
                                }

                                $set('description_mode', 'html');
                            }),
                    ])
                    ->schema([
                        Hidden::make('description_mode')
                            ->default('visual')
                            ->live()
                            ->dehydrated(false),
                        SafeRichEditor::make('description')
                            ->hiddenLabel()
                            ->visible(fn (Get $get): bool => $get('description_mode') !== 'html')
                            ->dehydrated(fn (Get $get): bool => $get('description_mode') !== 'html')
                            ->required()
                            ->toolbarButtons([
                                ['h2', 'h3', 'h4'],
                                ['bold', 'italic', 'underline', 'strike'],
                                ['link', 'textColor', 'highlight'],
                                ['alignStart', 'alignCenter', 'alignEnd'],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['table', 'attachFiles'],
                                ['horizontalRule', 'clearFormatting'],
                                ['undo', 'redo'],
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('media/products')
                            ->fileAttachmentsVisibility('public')
                            ->resizableImages()
                            ->columnSpanFull(),
                        Textarea::make('description_html')
                            ->hiddenLabel()
                            ->visible(fn (Get $get): bool => $get('description_mode') === 'html')
                            ->dehydrated(fn (Get $get): bool => $get('description_mode') === 'html')
                            ->dehydrateStateUsing(fn (?string $state): string => (string) $state)
                            ->required(fn (Get $get): bool => $get('description_mode') === 'html')
                            ->rows(18)
                            ->extraInputAttributes(['style' => 'min-height: 28rem; font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: 0.8rem;'])
                            ->columnSpanFull(),
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
