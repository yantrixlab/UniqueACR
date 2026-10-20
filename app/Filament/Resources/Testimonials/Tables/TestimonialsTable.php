<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Reviewer')
                    ->searchable(),
                TextColumn::make('rating')
                    ->formatStateUsing(fn ($state): string => str_repeat('★', (int) $state).str_repeat('☆', max(0, 5 - (int) $state)))
                    ->sortable(),
                TextColumn::make('source')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => $state ? ucfirst($state) : 'Other')
                    ->color(fn (?string $state): string => $state === 'google' ? 'info' : 'gray'),
                TextColumn::make('reviewed_at')
                    ->label('Review date')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('message')
                    ->label('Review')
                    ->limit(60)
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label('Shown')
                    ->boolean(),
                TextColumn::make('designation')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('reviewed_at', 'desc')
            ->filters([
                //
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
