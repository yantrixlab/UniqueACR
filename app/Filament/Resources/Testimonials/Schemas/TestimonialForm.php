<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Models\Testimonial;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Reviewer name')
                    ->required()
                    ->maxLength(120),
                TextInput::make('designation')
                    ->label('Detail (optional)')
                    ->helperText('e.g. "Home owner", "Jadavpur" or "Local Guide".')
                    ->maxLength(120),
                Select::make('rating')
                    ->label('Star rating')
                    ->options([5 => '5 stars', 4 => '4 stars', 3 => '3 stars', 2 => '2 stars', 1 => '1 star'])
                    ->required()
                    ->default(5),
                Select::make('source')
                    ->label('Where was this review posted?')
                    ->options([Testimonial::SOURCE_GOOGLE => 'Google'])
                    ->placeholder('Other / direct feedback')
                    ->default(Testimonial::SOURCE_GOOGLE),
                DatePicker::make('reviewed_at')
                    ->label('Review date')
                    ->native(false)
                    ->maxDate(now())
                    ->helperText('Shown as "2 months ago". Newest reviews appear first.'),
                TextInput::make('review_url')
                    ->label('Link to the review (optional)')
                    ->url()
                    ->maxLength(500),
                Textarea::make('message')
                    ->label('Review text')
                    ->helperText('Paste the review exactly as the customer wrote it.')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Show on website')
                    ->default(true),
            ]);
    }
}
