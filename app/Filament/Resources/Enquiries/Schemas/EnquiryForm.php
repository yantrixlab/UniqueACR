<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('source_type'),
                TextInput::make('source_id')
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
