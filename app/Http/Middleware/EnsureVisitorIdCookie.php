<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

/**
 * Assigns every anonymous visitor a long-lived, signed identifier cookie
 * so we can recognize the same browser across requests (e.g. for capping
 * blog claps per visitor, or counting unique reads) without requiring login.
 */
class EnsureVisitorIdCookie
{
    public const COOKIE_NAME = 'uac_vid';

    public function handle(Request $request, Closure $next): Response
    {
        $visitorId = $request->cookie(self::COOKIE_NAME);

        if (blank($visitorId)) {
            $visitorId = (string) Str::uuid();

            // Make it available to the rest of THIS request immediately —
            // a queued cookie only reaches the client on the response and
            // isn't visible via $request->cookie() until the next request.
            $request->cookies->set(self::COOKIE_NAME, $visitorId);

            Cookie::queue(self::COOKIE_NAME, $visitorId, 60 * 24 * 365);
        }

        return $next($request);
    }
}
