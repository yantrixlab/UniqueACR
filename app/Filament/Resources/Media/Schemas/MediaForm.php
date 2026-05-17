<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('media_category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                FileUpload::make('path')
                    ->label('Upload File')
                    ->disk('public')
                    ->directory('media')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/*', 'application/pdf', 'application/zip', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/plain'])
                    ->required()
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),
                TextInput::make('title')->maxLength(255),
                TextInput::make('alt_text')->maxLength(255),
                Toggle::make('is_active')->default(true)->required(),
            ]);
    }
}

