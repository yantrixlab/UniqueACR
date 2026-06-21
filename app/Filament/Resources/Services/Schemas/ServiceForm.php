<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Forms\Components\MediaPicker;
use App\Filament\Forms\Components\SafeRichEditor;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
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
                Select::make('segment')
                    ->label('Service Segment')
                    ->options([
                        'domestic' => 'Domestic',
                        'commercial' => 'Commercial',
                    ])
                    ->default('domestic')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
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
                            ->fileAttachmentsDirectory('media/services')
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
                MediaPicker::make('image_media_id')
                    ->label('Image')
                    ->directory('media/services')
                    ->columnSpanFull()
                    ->dehydrated(false),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_featured')
                    ->label('Is featured')
                    ->helperText('Show this service in the Featured Services slider on the home and services pages.')
                    ->default(false),
            ]);
    }
}
