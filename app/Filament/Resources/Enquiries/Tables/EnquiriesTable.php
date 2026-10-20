<?php

namespace App\Filament\Resources\Enquiries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EnquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('source_type')
                    ->searchable(),
                TextColumn::make('preferred_date')
                    ->label('Visit date')
                    ->date('D, d M Y')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('preferred_time')
                    ->label('Visit time')
                    ->placeholder('—'),
                TextColumn::make('source_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('source_type')
                    ->label('Type')
                    ->options([
                        'service_booking' => 'Service booking',
                        'service' => 'Service',
                        'product' => 'Product',
                        'general' => 'General',
                    ]),
                Filter::make('upcoming_visits')
                    ->label('Upcoming visits')
                    ->query(fn (Builder $query): Builder => $query->whereDate('preferred_date', '>=', now('Asia/Kolkata')->toDateString())),
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
