<?php

namespace App\Observers;

use App\Jobs\SendEnquiryPushNotification;
use App\Models\Enquiry;

class EnquiryObserver
{
    public function created(Enquiry $enquiry): void
    {
        SendEnquiryPushNotification::dispatch($enquiry);
    }
}
