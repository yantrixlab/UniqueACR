<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
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

    public function show(string $slug): View
    {
        $post = BlogPost::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('site.blog.show', compact('post'));
    }
}
