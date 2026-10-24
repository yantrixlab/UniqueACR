<?php

namespace Tests\Feature;

use App\Models\Enquiry;
use App\Services\OneSignalService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OneSignalServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.onesignal.app_id' => 'app-id', 'services.onesignal.rest_api_key' => 'key']);
        Http::fake(['onesignal.com/*' => Http::response(['id' => 'abc', 'recipients' => 1])]);
    }

    public function test_direct_push_uses_the_enquiry_channel_by_default(): void
    {
        app(OneSignalService::class)->notifyAdmins('New enquiry received', 'Hello', ['enquiry_id' => 7]);

        Http::assertSent(fn (Request $request) => $request['existing_android_channel_id'] === 'enquiry_alerts'
            && $request['data']['enquiry_id'] === 7);
    }

    public function test_service_booking_push_uses_the_booking_channel_with_custom_sound(): void
    {
        Enquiry::create(['name' => 'Asha', 'phone' => '9', 'message' => 'm', 'source_type' => 'service_booking', 'status' => 'pending']);

        Http::assertSent(fn (Request $request) => $request['existing_android_channel_id'] === 'booking_alerts');
    }

    public function test_other_enquiries_use_the_enquiry_channel(): void
    {
        Enquiry::create(['name' => 'Ravi', 'phone' => '8', 'message' => 'm', 'source_type' => 'general', 'status' => 'pending']);

        Http::assertSent(fn (Request $request) => $request['existing_android_channel_id'] === 'enquiry_alerts');
    }
}
