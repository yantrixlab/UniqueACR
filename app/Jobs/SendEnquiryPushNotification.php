<?php

namespace App\Jobs;

use App\Models\Enquiry;
use App\Services\OneSignalService;
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
        $oneSignal->notifyAdmins(
            heading: 'New enquiry received',
            content: sprintf('%s: %s', $this->enquiry->name, str($this->enquiry->message)->limit(100)),
            data: ['enquiry_id' => $this->enquiry->id],
        );
    }
}
