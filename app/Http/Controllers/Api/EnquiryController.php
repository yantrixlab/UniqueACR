<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(StoreEnquiryRequest $request): JsonResponse
    {
        $enquiry = Enquiry::query()->create([
            'name' => $request->string('name')->toString(),
            'phone' => $request->string('phone')->toString(),
            'email' => $request->string('email')->toString() ?: null,
            'message' => $request->string('message')->toString(),
            'source_type' => $request->string('source_type')->toString() ?: 'general',
            'source_id' => $request->integer('source_id') ?: null,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Enquiry created', 'data' => $enquiry], 201);
    }
}
