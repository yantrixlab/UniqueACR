<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
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

class AnnouncementBar extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static string|UnitEnum|null $navigationGroup = 'Site Settings';

    protected static ?string $navigationLabel = 'Announcement Bar';

    protected static ?string $title = 'Announcement Bar';

    protected static ?string $slug = 'announcement-bar';

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
        $this->form->fill(Setting::announcementBar());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Visibility')
                    ->description('Turn the bar on or off across the whole website.')
                    ->schema([
                        Toggle::make('enabled')
                            ->label('Show announcement bar')
                            ->inline(false),
                    ]),
                Section::make('Content')
                    ->description('Leave a field empty to hide that part of the bar. On mobile only the badge and message are shown.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('badge')
                            ->label('Badge')
                            ->maxLength(30),
                        TextInput::make('message')
                            ->label('Message')
                            ->maxLength(160),
                        TextInput::make('helpline_label')
                            ->label('Helpline label')
                            ->maxLength(40),
                        TextInput::make('helpline_phone')
                            ->label('Helpline phone')
                            ->tel()
                            ->maxLength(20)
                            ->helperText('Shown next to the label and used as the tap-to-call link.'),
                        TextInput::make('tag')
                            ->label('Right-side tag')
                            ->maxLength(40)
                            ->columnSpanFull(),
                    ]),
                Section::make('Colours')
                    ->columns(3)
                    ->schema([
                        ColorPicker::make('background_color')
                            ->label('Background')
                            ->required(),
                        ColorPicker::make('text_color')
                            ->label('Text')
                            ->required(),
                        ColorPicker::make('accent_color')
                            ->label('Badge & tag accent')
                            ->required(),
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
        Setting::saveAnnouncementBar($this->form->getState());

        Notification::make()
            ->title('Announcement bar saved')
            ->success()
            ->send();
    }
}
