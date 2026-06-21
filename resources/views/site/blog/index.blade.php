@extends('site.layouts.app')
@section('title','AC Repair & Service Tips Blog Kolkata | Unique Aircon')
@section('meta_description','Read expert AC repair, AC servicing tips, and cooling guides for Kolkata homes & offices. Stay updated with the latest HVAC news from Unique Aircon.')
@section('meta_keywords','AC repair tips Kolkata, AC service blog, AC maintenance guide, AC not cooling solution, HVAC tips Kolkata')
@section('og_title','AC Repair & Service Tips Blog | Unique Aircon')
@section('og_description','Expert AC tips, repair guides and HVAC news for Kolkata. Learn how to maintain your AC and save electricity.')
@section('content')
<section class="blog-hero">
    <div class="container">
        <span class="pill"><span class="svc-badge-dot"></span>HVAC Knowledge Hub</span>
        <h1>Blogs & Service Insights</h1>
        <p>Expert guides on AC repair, maintenance, installation, and energy-efficient cooling solutions for Kolkata homes and businesses.</p>
    </div>
</section>

<section class="section blog-grid-section">
    <div class="container">
        <div class="blog-grid">
            @forelse($posts as $post)
                @php
                    $imagePath = (string) ($post->featured_image ?? '');
                    $fallbackImage = asset('upload/web_image_res/home_hero_right.webp');
                    $image = match (true) {
                        \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://']) => $imagePath,
                        \Illuminate\Support\Str::startsWith($imagePath, '/') => url($imagePath),
                        filled($imagePath) => asset('storage/' . ltrim($imagePath, '/')),
                        default => $fallbackImage,
                    };
                    $date = $post->published_at?->format('d M Y') ?? $post->created_at?->format('d M Y');
                    $title = \App\Support\TextRepair::clean($post->title);
                    $excerpt = \Illuminate\Support\Str::limit(strip_tags(\App\Support\TextRepair::clean($post->content)), 150);
                @endphp
                <article class="blog-card">
                    <a class="blog-thumb" href="{{ route('blog.show', $post->slug) }}">
                        <img
                            loading="lazy"
                            src="{{ $image }}"
                            alt="{{ $title }}"
                            onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
                        >
                    </a>
                    <div class="blog-body">
                        <p class="blog-date">{{ $date }}</p>
                        <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $title }}</a></h3>
                        <p>{{ $excerpt }}</p>
                        <a class="outline-btn" href="{{ route('blog.show', $post->slug) }}">Read Article</a>
                    </div>
                </article>
            @empty
                <article class="blog-card empty">
                    <div class="blog-body">
                        <h3>No posts published yet</h3>
                        <p>New service guides and updates will appear here.</p>
                    </div>
                </article>
            @endforelse
        </div>

        <div class="blog-pagination">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
