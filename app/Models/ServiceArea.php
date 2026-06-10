<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'slug', 'zone', 'zone_slug', 'pin_codes', 'distance_km', 'latitude', 'longitude', 'meta_title', 'meta_description', 'page_heading', 'intro_text', 'is_active', 'sort_order'])]
class ServiceArea extends Model
{
    protected function casts(): array
    {
        return [
            'pin_codes' => 'array',
            'is_active' => 'bool',
            'latitude'  => 'float',
            'longitude' => 'float',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByZone(Builder $query, string $zoneSlug): Builder
    {
        return $query->where('zone_slug', $zoneSlug);
    }

    public function pinCodesDisplay(): string
    {
        return implode(' / ', $this->pin_codes ?? []);
    }
}
