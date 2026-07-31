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
            'Authorization' => 'Basic '.$restApiKey,
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
        }
    }
}
