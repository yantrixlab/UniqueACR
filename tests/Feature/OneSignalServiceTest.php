<?php

namespace Tests\Feature;

use App\Services\OneSignalService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OneSignalServiceTest extends TestCase
{
    public function test_admin_push_targets_the_heads_up_channel(): void
    {
        config(['services.onesignal.app_id' => 'app-id', 'services.onesignal.rest_api_key' => 'key']);
        Http::fake(['onesignal.com/*' => Http::response(['id' => 'abc', 'recipients' => 1])]);

        app(OneSignalService::class)->notifyAdmins('New service booking', 'Name · Sun, 25 Oct 2026', ['enquiry_id' => 7]);

        Http::assertSent(fn (Request $request) => $request['existing_android_channel_id'] === 'new_bookings'
            && $request['headings']['en'] === 'New service booking'
            && $request['data']['enquiry_id'] === 7);
    }
}
