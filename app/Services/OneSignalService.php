<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OneSignalService
{
    public function notifyAdmins(string $heading, string $content, array $data = []): void
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
