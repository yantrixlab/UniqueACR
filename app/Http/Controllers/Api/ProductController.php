<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::query()->with('category')->where('is_active', true)->orderBy('name')->paginate(20);

        return response()->json($products);
    }
}
