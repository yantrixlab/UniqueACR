<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\EnquiryView;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminEnquiryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $request->validate(['type' => ['nullable', 'in:booking,other']]);

        $enquiries = Enquiry::query()
            ->with('requestedServiceRecord')
            // Who-has-seen-it counts are for super admins only; other roles never receive the field.
            ->when($request->user()->isSuperAdmin(), fn ($query) => $query->withCount('views as seen_count'))
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

    public function show(Request $request, Enquiry $enquiry): JsonResponse
    {
        $user = $request->user();
        $data = $enquiry->toArray();

        if ($enquiry->isBooking()) {
            EnquiryView::query()->firstOrCreate(['enquiry_id' => $enquiry->id, 'user_id' => $user->id]);

            if ($user->isSuperAdmin()) {
                $viewers = $enquiry->views()->with('user:id,name,email,role')->oldest()->get();

                $data['seen_count'] = $viewers->count();
                $data['seen_by'] = $viewers->map(fn (EnquiryView $view) => [
                    'id' => $view->user_id,
                    'name' => $view->user?->name,
                    'email' => $view->user?->email,
                    'role' => $view->user?->role,
                    'seen_at' => $view->created_at?->toIso8601String(),
                ])->values()->all();
            }
        }

        return response()->json(['data' => $data]);
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
