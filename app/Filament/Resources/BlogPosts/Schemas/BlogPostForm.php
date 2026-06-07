<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Models\Media;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('author_id')
                    ->relationship('author', 'name'),
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, ?string $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug((string) $state)) : null),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('featured_image_media_id')
                    ->label('Select Existing Image')
                    ->options(fn () => Media::query()->where('file_type', 'image')->orderByDesc('id')->limit(500)->get()->mapWithKeys(fn (Media $media) => [$media->id => ($media->title ?: $media->original_name).' (#'.$media->id.')'])->all())
                    ->searchable()
                    ->dehydrated(false),
                FileUpload::make('featured_image_upload')
                    ->label('Or Upload New Image')
                    ->image()
                    ->disk('public')
                    ->directory('media/blog')
                    ->visibility('public')
                    ->dehydrated(false),
                TextInput::make('meta_title'),
                Textarea::make('meta_description')
                    ->columnSpanFull(),
                TextInput::make('meta_keywords'),
                DateTimePicker::make('published_at'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
