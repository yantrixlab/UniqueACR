<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable(['key', 'value'])]
class Setting extends Model
{
    private const ANNOUNCEMENT_BAR_KEY = 'announcement_bar';

    public const ANNOUNCEMENT_BAR_DEFAULTS = [
        'enabled' => false,
        'badge' => 'Fastest Response',
        'message' => "Kolkata's #1 Rated AC Service • Guaranteed 60-Min Doorstep Arrival",
        'helpline_label' => '24/7 Helpline:',
        'helpline_phone' => '+91 8346904100',
        'tag' => '30-Day Free Return Warranty',
        'background_color' => '#0b1d3a',
        'text_color' => '#ffffff',
        'accent_color' => '#38bdf8',
    ];

    /**
     * @return array<string, mixed>
     */
    public static function announcementBar(): array
    {
        return Cache::rememberForever('settings.'.self::ANNOUNCEMENT_BAR_KEY, function (): array {
            $stored = json_decode((string) static::query()->where('key', self::ANNOUNCEMENT_BAR_KEY)->value('value'), true);

            return array_merge(self::ANNOUNCEMENT_BAR_DEFAULTS, is_array($stored) ? $stored : []);
        });
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function saveAnnouncementBar(array $data): void
    {
        static::query()->updateOrCreate(
            ['key' => self::ANNOUNCEMENT_BAR_KEY],
            ['value' => json_encode(array_intersect_key($data, self::ANNOUNCEMENT_BAR_DEFAULTS), JSON_UNESCAPED_UNICODE)],
        );

        Cache::forget('settings.'.self::ANNOUNCEMENT_BAR_KEY);
    }
}
