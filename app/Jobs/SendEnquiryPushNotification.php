<?php

namespace App\Jobs;

use App\Models\Enquiry;
use App\Services\OneSignalService;
use App\Support\BookingSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEnquiryPushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Enquiry $enquiry)
    {
    }

    public function handle(OneSignalService $oneSignal): void
    {
        $visit = BookingSchedule::formatVisit($this->enquiry->preferred_date?->toDateString(), $this->enquiry->preferred_time);

        $oneSignal->notifyAdmins(
            heading: $visit ? 'New service booking' : 'New enquiry received',
            content: $visit
                ? collect([$this->enquiry->name, $this->enquiry->requested_service, $visit])->filter()->implode(' · ')
                : sprintf('%s: %s', $this->enquiry->name, str($this->enquiry->message)->limit(100)),
            data: ['enquiry_id' => $this->enquiry->id],
            channelId: $this->enquiry->isBooking() ? OneSignalService::BOOKING_CHANNEL_ID : OneSignalService::ENQUIRY_CHANNEL_ID,
        );
    }
}
