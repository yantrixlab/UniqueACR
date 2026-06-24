<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureVisitorIdCookie;
use App\Models\BlogPost;
use App\Models\BlogPostClap;
use App\Models\BlogPostRead;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('site.blog.index', compact('posts'));
    }

    public function show(Request $request, string $slug): View
    {
        $post = BlogPost::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $visitorId = (string) $request->cookie(EnsureVisitorIdCookie::COOKIE_NAME);

        $read = BlogPostRead::query()->firstOrCreate([
            'blog_post_id' => $post->id,
            'visitor_id' => $visitorId,
        ]);

        if ($read->wasRecentlyCreated) {
            $post->increment('read_count');
        }

        $visitorClapCount = BlogPostClap::query()
            ->where('blog_post_id', $post->id)
            ->where('visitor_id', $visitorId)
            ->value('clap_count') ?? 0;

        return view('site.blog.show', compact('post', 'visitorClapCount'));
    }
}
