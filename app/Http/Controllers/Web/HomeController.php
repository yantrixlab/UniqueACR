<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(ServiceRepository $serviceRepository, ProductRepository $productRepository): View
    {
        $featuredProducts = $productRepository
            ->queryActive()
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = $productRepository->queryActive()->latest()->take(6)->get();
        }

        return view('site.home', [
            'services' => $serviceRepository->activeWithCategory()->take(6),
            'products' => $featuredProducts,
            'posts' => BlogPost::query()->where('is_published', true)->latest('published_at')->take(3)->get(),
            'testimonials' => Testimonial::query()->where('is_active', true)->latest()->take(6)->get(),
        ]);
    }
}
