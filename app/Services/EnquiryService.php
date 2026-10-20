<?php

namespace App\Services;

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
            'source_id' => $payload['source_id'] ?? null,
            'preferred_date' => $payload['preferred_date'] ?? null,
            'preferred_time' => $payload['preferred_time'] ?? null,
            'status' => 'pending',
        ]);
    }
}
