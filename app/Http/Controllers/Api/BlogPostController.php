<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\JsonResponse;

class BlogPostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = BlogPost::query()->where('is_published', true)->latest('published_at')->paginate(12);

        return response()->json($posts);
    }
}
