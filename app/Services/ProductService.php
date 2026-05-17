<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function listingData(array $filters): array
    {
        $products = $this->productRepository->paginateFiltered($filters, 12);
        $options = $this->productRepository->filterOptions();

        return [
            'products' => $products,
            'brands' => $options['brands'],
            'categories' => $options['categories'],
            'minPrice' => $options['minPrice'],
            'maxPrice' => $options['maxPrice'],
        ];
    }

    public function detail(string $slug): Product
    {
        return $this->productRepository->findActiveBySlug($slug);
    }
}
