<?php

use App\Http\Controllers\Api\Admin\AdminAuthController;
use App\Http\Controllers\Api\Admin\AdminEnquiryController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\EnquiryController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/posts', [BlogPostController::class, 'index']);
Route::post('/enquiries', [EnquiryController::class, 'store'])->middleware('throttle:20,1');
Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:20,1');

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware(['auth:sanctum', 'admin.role'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::get('/enquiries', [AdminEnquiryController::class, 'index']);
        Route::get('/enquiries/{enquiry}', [AdminEnquiryController::class, 'show']);
        Route::patch('/enquiries/{enquiry}', [AdminEnquiryController::class, 'update']);
    });
});
