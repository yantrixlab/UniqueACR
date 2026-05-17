<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request, ProductService $productService): View
    {
        $filters = [
            'search' => $request->string('search')->toString() ?: null,
            'brand' => $request->string('brand')->toString() ?: null,
            'category_id' => $request->integer('category_id') ?: null,
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'sort' => $request->string('sort')->toString() ?: 'latest',
        ];
        $listing = $productService->listingData($filters);

        return view('site.products.index', $listing + ['filters' => $filters]);
    }

    public function show(string $slug, ProductService $productService): View
    {
        $product = $productService->detail($slug);

        return view('site.products.show', compact('product'));
    }
}
