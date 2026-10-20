<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class GoogleReviews extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|UnitEnum|null $navigationGroup = 'Site Settings';

    protected static ?string $navigationLabel = 'Google Reviews';

    protected static ?string $title = 'Google Reviews';

    protected static ?string $slug = 'google-reviews';

    protected static ?int $navigationSort = 2;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        /** @var User|null $user */
        $user = auth()->user();

        return $user !== null
            && ($user->isSuperAdmin() || $user->hasPermission('resource.settings.view'));
    }

    public function mount(): void
    {
        $this->form->fill(Setting::googleReviews());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Rating summary')
                    ->description('The rating badge shown above the reviews on the home, services and service pages. Copy these numbers from your Google Business Profile so they always match what Google shows. The review cards themselves are managed under Testimonials.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('show_summary')
                            ->label('Show the Google rating summary')
                            ->inline(false)
                            ->columnSpanFull(),
                        TextInput::make('rating')
                            ->label('Average rating')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->step(0.1)
                            ->helperText('e.g. 4.8'),
                        TextInput::make('review_count')
                            ->label('Total Google reviews')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->helperText('e.g. 128'),
                    ]),
                Section::make('Links')
                    ->description('Optional buttons shown next to the rating.')
                    ->schema([
                        TextInput::make('profile_url')
                            ->label('Google reviews / Maps page')
                            ->url()
                            ->maxLength(500)
                            ->helperText('Opens when visitors click "See all reviews".'),
                        TextInput::make('write_review_url')
                            ->label('"Write a review" link')
                            ->url()
                            ->maxLength(500)
                            ->helperText('Opens when visitors click "Review us on Google".'),
                    ]),
            ])
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save changes')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ])->key('form-actions'),
                    ]),
            ]);
    }

    public function save(): void
    {
        Setting::saveGoogleReviews($this->form->getState());

        Notification::make()
            ->title('Google reviews settings saved')
            ->success()
            ->send();
    }
}
