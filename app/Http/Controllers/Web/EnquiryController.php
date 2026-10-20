<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Services\EnquiryService;
use App\Support\BookingSchedule;
use Illuminate\Http\RedirectResponse;

class EnquiryController extends Controller
{
    public function store(StoreEnquiryRequest $request, EnquiryService $enquiryService): RedirectResponse
    {
        $data = $request->validated();
        $enquiry = $enquiryService->create($data);

        $visit = BookingSchedule::formatVisit($data['preferred_date'] ?? null, $data['preferred_time'] ?? null);
        $service = $enquiry->requested_service;

        $redirect = back()->with('success', $visit
            ? 'Thank you. Your '.($service ? "{$service} " : '')."visit is requested for {$visit}. We'll confirm shortly."
            : 'Thank you. Your enquiry has been submitted.');

        return ($data['source_type'] ?? null) === 'service_booking'
            ? $redirect->withFragment('booking-form')
            : $redirect;
    }
}
