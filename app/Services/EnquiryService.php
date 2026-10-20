<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\EnquiryRepository;
use App\Support\BookingSchedule;

class EnquiryService
{
    public function __construct(private readonly EnquiryRepository $enquiryRepository)
    {
    }

    public function create(array $payload)
    {
        $message = $payload['message'] ?? 'Website Booking Request';

        // Resolved server-side from the slug so a customer can't attach an arbitrary service name.
        $service = ! empty($payload['service_slug'])
            ? Service::query()->where('slug', $payload['service_slug'])->where('is_active', true)->first()
            : null;

        if ($service) {
            $message .= "\nRequested Service: {$service->name}";
        }

        if (!empty($payload['service_type'])) {
            $message .= "\nService Type: {$payload['service_type']}";
        }

        if ($visit = BookingSchedule::formatVisit($payload['preferred_date'] ?? null, $payload['preferred_time'] ?? null)) {
            $message .= "\nPreferred Visit: {$visit}";
        }

        if (!empty($payload['address'])) {
            $message .= "\nAddress: {$payload['address']}";
        }

        return $this->enquiryRepository->create([
            'name' => $payload['name'],
            'phone' => $payload['phone'],
            'email' => $payload['email'] ?? null,
            'message' => $message,
            'source_type' => $payload['source_type'] ?? 'general',
            'source_id' => $service?->id ?? $payload['source_id'] ?? null,
            'preferred_date' => $payload['preferred_date'] ?? null,
            'preferred_time' => $payload['preferred_time'] ?? null,
            'status' => 'pending',
        ]);
    }
}
