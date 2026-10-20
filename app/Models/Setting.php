<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable(['key', 'value'])]
class Setting extends Model
{
    private const ANNOUNCEMENT_BAR_KEY = 'announcement_bar';

    private const GOOGLE_REVIEWS_KEY = 'google_reviews';

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

    public const GOOGLE_REVIEWS_DEFAULTS = [
        'show_summary' => false,
        'rating' => null,
        'review_count' => null,
        'profile_url' => '',
        'write_review_url' => '',
    ];

    /**
     * @return array<string, mixed>
     */
    public static function announcementBar(): array
    {
        return static::jsonSetting(self::ANNOUNCEMENT_BAR_KEY, self::ANNOUNCEMENT_BAR_DEFAULTS);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function saveAnnouncementBar(array $data): void
    {
        static::saveJsonSetting(self::ANNOUNCEMENT_BAR_KEY, $data, self::ANNOUNCEMENT_BAR_DEFAULTS);
    }

    /**
     * @return array<string, mixed>
     */
    public static function googleReviews(): array
    {
        return static::jsonSetting(self::GOOGLE_REVIEWS_KEY, self::GOOGLE_REVIEWS_DEFAULTS);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function saveGoogleReviews(array $data): void
    {
        static::saveJsonSetting(self::GOOGLE_REVIEWS_KEY, $data, self::GOOGLE_REVIEWS_DEFAULTS);
    }

    /**
     * @param  array<string, mixed>  $defaults
     * @return array<string, mixed>
     */
    private static function jsonSetting(string $key, array $defaults): array
    {
        return Cache::rememberForever('settings.'.$key, function () use ($key, $defaults): array {
            $stored = json_decode((string) static::query()->where('key', $key)->value('value'), true);

            return array_merge($defaults, is_array($stored) ? $stored : []);
        });
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $defaults
     */
    private static function saveJsonSetting(string $key, array $data, array $defaults): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => json_encode(array_intersect_key($data, $defaults), JSON_UNESCAPED_UNICODE)],
        );

        Cache::forget('settings.'.$key);
    }
}
