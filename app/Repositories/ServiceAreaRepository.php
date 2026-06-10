<?php

namespace App\Repositories;

use App\Models\ServiceArea;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class ServiceAreaRepository
{
    public function getAll(): Collection
    {
        return ServiceArea::query()->active()->orderBy('sort_order')->orderBy('name')->get();
    }

    public function getBySlug(string $slug): ServiceArea
    {
        return ServiceArea::query()->active()->where('slug', $slug)->firstOrFail();
    }

    public function getAllZonesGrouped(): SupportCollection
    {
        return $this->getAll()->groupBy('zone');
    }

    public function getByZone(string $zoneSlug): Collection
    {
        return ServiceArea::query()->active()->byZone($zoneSlug)->orderBy('sort_order')->get();
    }
}
