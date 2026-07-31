<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isAdminRole()) {
            abort(403, 'This account is not permitted to use the admin app.');
        }

        return $next($request);
    }
}
