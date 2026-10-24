<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OneSignalService
{
    /**
     * Notification channels created by the Android admin app (see MyApplication.java); both are
     * high importance so they pop up as heads-up banners. The booking channel plays the custom
     * booking_alert sound. Older app versions don't have them and OneSignal falls back to its
     * default channel.
     */
    public const BOOKING_CHANNEL_ID = 'booking_alerts';

    public const ENQUIRY_CHANNEL_ID = 'enquiry_alerts';

    public function notifyAdmins(string $heading, string $content, array $data = [], string $channelId = self::ENQUIRY_CHANNEL_ID): void
    {
        $appId = config('services.onesignal.app_id');
        $restApiKey = config('services.onesignal.rest_api_key');

        if (! $appId || ! $restApiKey) {
            Log::warning('OneSignal is not configured; skipping push notification.');

            return;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Key '.$restApiKey,
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id' => $appId,
            'filters' => [
                ['field' => 'tag', 'key' => 'role', 'relation' => '=', 'value' => 'admin'],
            ],
            'headings' => ['en' => $heading],
            'contents' => ['en' => $content],
            'data' => $data,
            'existing_android_channel_id' => $channelId,
        ]);

        if ($response->failed()) {
            Log::error('OneSignal notification failed.', ['response' => $response->body()]);

            return;
        }

        $recipients = $response->json('recipients');

        if ($recipients === 0) {
            Log::warning('OneSignal accepted the request but matched 0 devices (check that the Android app is tagging role=admin).', [
                'response' => $response->json(),
            ]);
        } else {
            Log::info('OneSignal notification sent.', ['recipients' => $recipients, 'response' => $response->json()]);
        }
    }
}
