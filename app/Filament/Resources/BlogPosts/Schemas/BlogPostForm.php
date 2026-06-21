<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Filament\Resources\BlogPosts\Blocks\VideoEmbedBlock;
use App\Filament\Forms\Components\MediaPicker;
use App\Services\SeoAnalysisService;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'xl' => 3])
                    ->schema([
                        Group::make([
                            Section::make()
                                ->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn (string $operation, ?string $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug((string) $state)) : null),
                                    TextInput::make('slug')
                                        ->required()
                                        ->maxLength(255)
                                        ->prefix(url('/blog') . '/')
                                        ->live(onBlur: true),
                                    Select::make('author_id')
                                        ->label('Author')
                                        ->relationship('author', 'name'),
                                ])
                                ->columns(2),

                            Section::make('Content')
                                ->headerActions([
                                    Action::make('toggleHtmlMode')
                                        ->label(fn (Get $get): string => $get('content_mode') === 'html' ? 'Visual' : 'HTML')
                                        ->icon(fn (Get $get): Heroicon => $get('content_mode') === 'html' ? Heroicon::Bars3BottomLeft : Heroicon::CodeBracket)
                                        ->color('gray')
                                        ->action(function (Get $get, Set $set): void {
                                            if ($get('content_mode') === 'html') {
                                                $set('content', $get('content_html'));
                                                $set('content_mode', 'visual');

                                                return;
                                            }

                                            $set('content_html', $get('content'));
                                            $set('content_mode', 'html');
                                        }),
                                ])
                                ->schema([
                                    Hidden::make('content_mode')
                                        ->default('visual')
                                        ->live()
                                        ->dehydrated(false),
                                    RichEditor::make('content')
                                        ->hiddenLabel()
                                        ->visible(fn (Get $get): bool => $get('content_mode') !== 'html')
                                        ->required()
                                        ->live(debounce: '750ms')
                                        ->toolbarButtons([
                                            ['h2', 'h3', 'h4'],
                                            ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                                            ['link', 'textColor', 'highlight'],
                                            ['alignStart', 'alignCenter', 'alignEnd'],
                                            ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                            ['table', 'attachFiles', 'customBlocks'],
                                            ['horizontalRule', 'clearFormatting'],
                                            ['undo', 'redo'],
                                        ])
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsDirectory('media/blog')
                                        ->fileAttachmentsVisibility('public')
                                        ->resizableImages()
                                        ->customBlocks([
                                            VideoEmbedBlock::class,
                                        ])
                                        ->columnSpanFull(),
                                    Textarea::make('content_html')
                                        ->hiddenLabel()
                                        ->visible(fn (Get $get): bool => $get('content_mode') === 'html')
                                        ->dehydrated(false)
                                        ->rows(20)
                                        ->extraInputAttributes(['style' => 'min-height: 32rem; font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: 0.8rem;'])
                                        ->columnSpanFull(),
                                ]),
                        ])->columnSpan(['default' => 1, 'xl' => 2]),

                        Group::make([
                            Section::make('Featured Image')
                                ->schema([
                                    MediaPicker::make('featured_image_media_id')
                                        ->label('Featured image')
                                        ->directory('media/blog')
                                        ->columnSpanFull()
                                        ->dehydrated(false),
                                ]),

                            Section::make('Publishing')
                                ->schema([
                                    Toggle::make('is_published')
                                        ->required(),
                                    DateTimePicker::make('published_at'),
                                ]),

                            Section::make('SEO')
                                ->collapsible()
                                ->schema([
                                    TextInput::make('focus_keyword')
                                        ->helperText('The main keyword or phrase this post should rank for.')
                                        ->live(onBlur: true),
                                    TextInput::make('meta_title')
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->helperText(fn (?string $state): string => Str::length((string) $state) . ' / 60 characters'),
                                    Textarea::make('meta_description')
                                        ->maxLength(320)
                                        ->live(onBlur: true)
                                        ->helperText(fn (?string $state): string => Str::length((string) $state) . ' / 156 characters'),
                                    TextInput::make('meta_keywords'),
                                    Html::make(function (Get $get): HtmlString {
                                        $analysis = app(SeoAnalysisService::class)->analyze([
                                            'title' => $get('title'),
                                            'slug' => $get('slug'),
                                            'meta_title' => $get('meta_title'),
                                            'meta_description' => $get('meta_description'),
                                            'focus_keyword' => $get('focus_keyword'),
                                            'content' => $get('content'),
                                        ]);

                                        return new HtmlString(
                                            view('filament.forms.components.seo-insights-panel', [
                                                'analysis' => $analysis,
                                                'slug' => $get('slug'),
                                                'title' => $get('meta_title') ?: $get('title'),
                                                'description' => $get('meta_description'),
                                            ])->render()
                                        );
                                    })->columnSpanFull(),
                                ]),
                        ])
                            ->columnSpan(['default' => 1, 'xl' => 1])
                            ->extraAttributes(['class' => 'blog-post-sidebar']),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
