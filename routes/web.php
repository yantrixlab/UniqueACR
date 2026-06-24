<?php

use App\Http\Controllers\Admin\MediaBackupController;
use App\Http\Controllers\Web\BlogClapController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\EnquiryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ServiceAreaController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Middleware\EnsureVisitorIdCookie;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceArea;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/service-areas', [ServiceAreaController::class, 'index'])->name('areas.index');
Route::get('/service-areas/{slug}', [ServiceAreaController::class, 'show'])->name('areas.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->middleware(EnsureVisitorIdCookie::class)->name('blog.show');
Route::post('/blog/{slug}/clap', [BlogClapController::class, 'store'])->middleware(['throttle:30,1', EnsureVisitorIdCookie::class])->name('blog.clap');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::post('/enquiries', [EnquiryController::class, 'store'])->middleware('throttle:8,1')->name('enquiries.store');

// Admin Media Backup (protected by Filament auth middleware)
Route::middleware(['web', 'auth:web'])->prefix('admin-media')->group(function () {
    Route::get('/export', [MediaBackupController::class, 'export'])->name('admin.media.export');
    Route::get('/backup-status', [MediaBackupController::class, 'backupStatus'])->name('admin.media.backup-status');
    Route::post('/restore-from-server', [MediaBackupController::class, 'restoreFromServer'])->name('admin.media.restore-from-server');
    Route::post('/import', [MediaBackupController::class, 'import'])->name('admin.media.import');
    Route::post('/chunk-upload', [MediaBackupController::class, 'chunkUpload'])->name('admin.media.chunk-upload');
    Route::post('/chunk-assemble', [MediaBackupController::class, 'chunkAssemble'])->name('admin.media.chunk-assemble');
});

Route::get('/sitemap.xml', function () {
    $urls = collect([
        route('home'), route('services.index'), route('products.index'), route('areas.index'), route('blog.index'), route('about'), route('contact'), route('terms'), route('privacy'),
    ])
        ->merge(Service::query()->where('is_active', true)->pluck('slug')->map(fn ($slug) => route('services.show', $slug)))
        ->merge(Product::query()->where('is_active', true)->pluck('slug')->map(fn ($slug) => route('products.show', $slug)))
        ->merge(BlogPost::query()->where('is_published', true)->pluck('slug')->map(fn ($slug) => route('blog.show', $slug)))
        ->merge(ServiceArea::query()->where('is_active', true)->pluck('slug')->map(fn ($slug) => route('areas.show', $slug)));

    // Built as a plain string (not a Blade view) so this can never be
    // broken by stale compiled-view caching on any deployment target.
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $url) {
        $xml .= '<url><loc>' . e($url) . '</loc></url>' . "\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
});
