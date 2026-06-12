<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository
{
    public function queryActive(): Builder
    {
        return Product::query()
            ->with('category')
            ->where('is_active', true);
    }

    public function paginateFiltered(array $filters, int $perPage = 12): LengthAwarePaginator
    {
        $query = $this->applyFilters($this->queryActive(), $filters);
        $sort = $filters['sort'] ?? 'latest';

        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'featured' => $query->orderByDesc('is_featured')->orderByDesc('created_at'),
            default => $query->latest(),
        };

        return $query->paginate($perPage)->withQueryString();
    }

    public function getFeatured(int $limit = 6)
    {
        return $this->queryActive()->where('is_featured', true)->latest()->take($limit)->get();
    }

    public function findActiveBySlug(string $slug): Product
    {
        return $this->queryActive()->where('slug', $slug)->firstOrFail();
    }

    public function filterOptions(): array
    {
        $query = $this->queryActive();

        return [
            'brands' => (clone $query)->select('brand')->distinct()->orderBy('brand')->pluck('brand')->all(),
            'categories' => (clone $query)->get()->pluck('category.name', 'product_category_id')->filter()->unique()->all(),
            'minPrice' => (float) ((clone $query)->min('price') ?? 0),
            'maxPrice' => (float) ((clone $query)->max('price') ?? 0),
        ];
    }

    private function applyFilters(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['search'] ?? null, fn (Builder $q, string $search) => $q->where('name', 'like', "%{$search}%"))
            ->when($filters['brand'] ?? null, fn (Builder $q, string $brand) => $q->where('brand', $brand))
            ->when($filters['category_id'] ?? null, fn (Builder $q, int|string $categoryId) => $q->where('product_category_id', $categoryId))
            ->when($filters['min_price'] ?? null, fn (Builder $q, int|float|string $min) => $q->where('price', '>=', (float) $min))
            ->when($filters['max_price'] ?? null, fn (Builder $q, int|float|string $max) => $q->where('price', '<=', (float) $max));
    }
}
