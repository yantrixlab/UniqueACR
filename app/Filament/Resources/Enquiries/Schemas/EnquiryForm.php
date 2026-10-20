<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use App\Support\BookingSchedule;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
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
                Section::make('Preferred visit')
                    ->description('Date and time window the customer chose when booking a service.')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        DatePicker::make('preferred_date')
                            ->label('Visit date')
                            ->native(false)
                            ->displayFormat('D, d M Y'),
                        Select::make('preferred_time')
                            ->label('Visit time')
                            ->options(
                                collect(BookingSchedule::slots())
                                    ->mapWithKeys(fn (array $slot) => [$slot['label'] => $slot['label']])
                                    ->all()
                            ),
                    ]),
                TextInput::make('source_type'),
                TextInput::make('source_id')
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
