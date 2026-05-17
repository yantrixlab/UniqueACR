<?php

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
