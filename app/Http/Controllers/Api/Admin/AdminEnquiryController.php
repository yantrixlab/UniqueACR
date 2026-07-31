<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminEnquiryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $enquiries = Enquiry::query()
            ->latest()
            ->paginate($request->integer('per_page', 20));

        return response()->json($enquiries);
    }

    public function show(Enquiry $enquiry): JsonResponse
    {
        return response()->json(['data' => $enquiry]);
    }

    public function update(Request $request, Enquiry $enquiry): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,contacted,closed'],
        ]);

        $enquiry->update($validated);

        return response()->json(['data' => $enquiry]);
    }
}
