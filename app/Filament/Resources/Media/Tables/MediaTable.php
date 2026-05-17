<?php

namespace App\Filament\Resources\Media\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('category.name')->label('Category')->searchable(),
                TextColumn::make('file_type')->badge(),
                TextColumn::make('mime_type')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('size')->numeric()->suffix(' bytes')->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('media_category_id')->relationship('category', 'name'),
                SelectFilter::make('file_type')->options([
                    'image' => 'Image',
                    'file' => 'File',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

