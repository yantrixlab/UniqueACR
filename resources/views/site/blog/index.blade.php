@extends('site.layouts.app')
@section('title','AC Repair & Service Tips Blog Kolkata | Cooling Kolkata')
@section('meta_description','Read expert AC repair, AC servicing tips, and cooling guides for Kolkata homes & offices. Stay updated with the latest HVAC news from Cooling Kolkata.')
@section('meta_keywords','AC repair tips Kolkata, AC service blog, AC maintenance guide, AC not cooling solution, HVAC tips Kolkata')
@section('og_title','AC Repair & Service Tips Blog | Cooling Kolkata')
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
                    $image = $post->featured_image ?? '';
                    $date = $post->published_at?->format('d M Y') ?? $post->created_at?->format('d M Y');
                @endphp
                <article class="blog-card">
                    <a class="blog-thumb" href="{{ route('blog.show', $post->slug) }}">
                        <img
                            loading="lazy"
                            src="{{ $image }}"
                            alt="{{ $post->title }}"
                            onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 700%22><defs><linearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22><stop offset=%220%25%22 stop-color=%22%23e7eef9%22/><stop offset=%22100%25%22 stop-color=%22%23d8e5f7%22/></linearGradient></defs><rect width=%221200%22 height=%22700%22 fill=%22url(%23g)%22/><rect x=%22485%22 y=%22280%22 width=%22230%22 height=%22130%22 rx=%2218%22 fill=%22%23ffffff%22 stroke=%22%23b7cceb%22/><rect x=%22515%22 y=%22324%22 width=%22170%22 height=%2222%22 rx=%2211%22 fill=%22%238ec3f5%22/><circle cx=%22670%22 cy=%22308%22 r=%2212%22 fill=%22%233b79be%22/></svg>';"
                        >
                    </a>
                    <div class="blog-body">
                        <p class="blog-date">{{ $date }}</p>
                        <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}</p>
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


