<?php

namespace App\Filament\Resources\MediaCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MediaCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->required()->alphaDash()->unique(ignoreRecord: true),
            ]);
    }
}

