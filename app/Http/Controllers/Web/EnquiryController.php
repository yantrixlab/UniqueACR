<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Services\EnquiryService;
use Illuminate\Http\RedirectResponse;

class EnquiryController extends Controller
{
    public function store(StoreEnquiryRequest $request, EnquiryService $enquiryService): RedirectResponse
    {
        $enquiryService->create($request->validated());

        return back()->with('success', 'Thank you. Your enquiry has been submitted.');
    }
}
