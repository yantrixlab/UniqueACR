<?php

namespace App\Filament\Resources\Media\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 3,
                'xl' => 4,
            ])
            ->columns([
                ImageColumn::make('path')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title')
                    ->label('Name')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('file_type')
                    ->badge(),
                TextColumn::make('url')
                    ->label('File URL')
                    ->copyable()
                    ->limit(35),
            ])
            ->filters([
                SelectFilter::make('file_type')->options([
                    'image' => 'Images',
                    'file' => 'Files',
                ]),
            ])
            ->recordActions([
                Action::make('copy_url')
                    ->label('Copy URL')
                    ->icon('heroicon-o-link')
                    ->action(function ($record): void {
                        Notification::make()
                            ->title('Copy this URL')
                            ->body($record->url)
                            ->success()
                            ->send();
                    }),
                DeleteAction::make()->label('Remove'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

