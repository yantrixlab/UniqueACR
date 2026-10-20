<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

#[Fillable(['name', 'designation', 'rating', 'message', 'source', 'reviewed_at', 'review_url', 'is_active'])]
class Testimonial extends Model
{
    public const SOURCE_GOOGLE = 'google';

    protected function casts(): array
    {
        return [
            'is_active' => 'bool',
            'reviewed_at' => 'date',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Newest reviews first; entries without a review date come last.
     *
     * @return Collection<int, self>
     */
    public static function forDisplay(int $limit): Collection
    {
        return static::query()->active()->orderByDesc('reviewed_at')->latest()->take($limit)->get();
    }
}
