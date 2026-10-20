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
        $request->validate(['type' => ['nullable', 'in:booking,other']]);

        $enquiries = Enquiry::query()
            ->with('requestedServiceRecord')
            ->when($request->query('type') === 'booking', fn ($query) => $query->bookings())
            ->when($request->query('type') === 'other', fn ($query) => $query->otherEnquiries())
            ->latest()
            ->paginate($request->integer('per_page', 20));

        return response()->json($enquiries);
    }

    public function stats(): JsonResponse
    {
        return response()->json(['data' => [
            'pending_bookings' => Enquiry::query()->bookings()->where('status', 'pending')->count(),
            'completed_bookings' => Enquiry::query()->bookings()->where('status', 'closed')->count(),
            'pending_other' => Enquiry::query()->otherEnquiries()->where('status', 'pending')->count(),
        ]]);
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

    public function destroy(Enquiry $enquiry): JsonResponse
    {
        $enquiry->delete();

        return response()->json(['message' => 'Enquiry deleted']);
    }
}
