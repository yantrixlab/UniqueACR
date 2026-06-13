<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository
{
    public function getFeatured(int $limit = 6): Collection
    {
        $featured = Service::query()
            ->with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take($limit)
            ->get();

        // Fall back to latest active services if none are marked featured
        if ($featured->isEmpty()) {
            $featured = Service::query()
                ->with('category')
                ->where('is_active', true)
                ->latest()
                ->take($limit)
                ->get();
        }

        return $featured;
    }

    public function activeWithCategory(?string $segment = null): Collection
    {
        return Service::query()
            ->with('category')
            ->where('is_active', true)
            ->when($segment, fn ($q) => $q->whereHas('category', fn ($cq) => $cq->where('segment', $segment)))
            ->orderBy('name')
            ->get();
    }

    public function findActiveBySlug(string $slug): Service
    {
        return Service::query()
            ->with('category')
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
