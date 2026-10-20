<?php

namespace App\Support;

use Carbon\CarbonImmutable;

class BookingSchedule
{
    public const TIMEZONE = 'Asia/Kolkata';

    public const DAYS_AHEAD = 14;

    /** Minimum minutes between "now" and the start of a same-day slot. */
    public const LEAD_MINUTES = 60;

    /**
     * Visit windows, keyed by the value submitted by the form (start hour, 24h).
     *
     * @return array<string, array{label: string, start: int}>
     */
    public static function slots(): array
    {
        return [
            '09-11' => ['label' => '9 AM – 11 AM', 'start' => 9],
            '11-13' => ['label' => '11 AM – 1 PM', 'start' => 11],
            '13-15' => ['label' => '1 PM – 3 PM', 'start' => 13],
            '15-17' => ['label' => '3 PM – 5 PM', 'start' => 15],
            '17-19' => ['label' => '5 PM – 7 PM', 'start' => 17],
        ];
    }

    public static function now(): CarbonImmutable
    {
        return CarbonImmutable::now(self::TIMEZONE);
    }

    public static function today(): CarbonImmutable
    {
        return self::now()->startOfDay();
    }

    /**
     * @return array<int, CarbonImmutable>
     */
    public static function dates(): array
    {
        $today = self::today();

        return array_map(fn (int $offset) => $today->addDays($offset), range(0, self::DAYS_AHEAD - 1));
    }

    public static function lastBookableDate(): CarbonImmutable
    {
        return self::today()->addDays(self::DAYS_AHEAD - 1);
    }

    public static function slotAvailableOn(CarbonImmutable $date, string $slotKey): bool
    {
        $slot = self::slots()[$slotKey] ?? null;

        if ($slot === null || $date->lessThan(self::today())) {
            return false;
        }

        if (! $date->isSameDay(self::today())) {
            return true;
        }

        return $date->setTime($slot['start'], 0)->greaterThan(self::now()->addMinutes(self::LEAD_MINUTES));
    }

    public static function hasAnySlotOn(CarbonImmutable $date): bool
    {
        foreach (array_keys(self::slots()) as $key) {
            if (self::slotAvailableOn($date, $key)) {
                return true;
            }
        }

        return false;
    }

    public static function label(string $slotKey): ?string
    {
        return self::slots()[$slotKey]['label'] ?? null;
    }

    public static function formatVisit(?string $date, ?string $timeLabel): ?string
    {
        if (! $date) {
            return null;
        }

        $formatted = CarbonImmutable::parse($date, self::TIMEZONE)->format('D, d M Y');

        return $timeLabel ? "{$formatted}, {$timeLabel}" : $formatted;
    }
}
