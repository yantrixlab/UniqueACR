<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureVisitorIdCookie;
use App\Models\BlogPost;
use App\Models\BlogPostClap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogClapController extends Controller
{
    public const CAP_PER_VISITOR = 20;

    public function store(Request $request, string $slug): JsonResponse
    {
        $post = BlogPost::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $visitorId = (string) $request->cookie(EnsureVisitorIdCookie::COOKIE_NAME);

        $clap = BlogPostClap::query()->firstOrCreate([
            'blog_post_id' => $post->id,
            'visitor_id' => $visitorId,
        ]);

        if ($clap->clap_count >= self::CAP_PER_VISITOR) {
            return response()->json([
                'clap_count' => $post->clap_count,
                'visitor_claps' => $clap->clap_count,
                'capped' => true,
            ]);
        }

        $clap->increment('clap_count');
        $post->increment('clap_count');

        return response()->json([
            'clap_count' => $post->clap_count,
            'visitor_claps' => $clap->clap_count,
            'capped' => $clap->clap_count >= self::CAP_PER_VISITOR,
        ]);
    }
}
