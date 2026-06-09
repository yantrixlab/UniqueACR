<?php

use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\EnquiryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ServiceController;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::post('/enquiries', [EnquiryController::class, 'store'])->middleware('throttle:8,1')->name('enquiries.store');

Route::get('/sitemap.xml', function () {
    $urls = collect([
        route('home'), route('services.index'), route('products.index'), route('blog.index'), route('about'), route('contact'), route('terms'), route('privacy'),
    ])
        ->merge(Product::query()->where('is_active', true)->pluck('slug')->map(fn ($slug) => route('products.show', $slug)))
        ->merge(BlogPost::query()->where('is_published', true)->pluck('slug')->map(fn ($slug) => route('blog.show', $slug)));

    return response()->view('site.pages.sitemap', ['urls' => $urls])->header('Content-Type', 'application/xml');
});
