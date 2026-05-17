<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->alphaDash()
                    ->unique(ignoreRecord: true),
                Toggle::make('is_system')
                    ->label('System Role')
                    ->default(false),
                CheckboxList::make('permissions')
                    ->relationship('permissions', 'label')
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}

