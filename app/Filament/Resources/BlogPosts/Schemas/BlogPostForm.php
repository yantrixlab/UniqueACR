<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Filament\Forms\Components\MediaPicker;
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
                MediaPicker::make('featured_image_media_id')
                    ->label('Pick from Image Library')
                    ->columnSpanFull()
                    ->dehydrated(false),
                FileUpload::make('featured_image_upload')
                    ->label('Or Upload New Image')
                    ->image()
                    ->disk('public')
                    ->directory('media/blog')
                    ->visibility('public')
                    ->columnSpanFull()
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
