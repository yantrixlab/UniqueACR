<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Service::query()->with('category')->where('is_active', true)->orderBy('name')->get();

        return response()->json(['data' => $services]);
    }
}
