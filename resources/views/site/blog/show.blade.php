@extends('site.layouts.app')

@php
    $imagePath = (string) ($post->featured_image ?? '');
    $fallbackImage = asset('upload/web_image_res/home_hero_right.webp');
    $featuredImageUrl = match (true) {
        \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://']) => $imagePath,
        \Illuminate\Support\Str::startsWith($imagePath, '/') => url($imagePath),
        filled($imagePath) => asset('storage/' . ltrim($imagePath, '/')),
        default => $fallbackImage,
    };
    $publishedDate = $post->published_at?->format('d M Y') ?? $post->created_at?->format('d M Y');
    $title = \App\Support\TextRepair::clean($post->title);
    $content = \App\Support\TextRepair::clean($post->content ?? '');
    $summary = \Illuminate\Support\Str::limit(strip_tags($content), 170, '');
    $metaDescription = $post->meta_description
        ? \App\Support\TextRepair::clean($post->meta_description)
        : \Illuminate\Support\Str::limit(strip_tags($content), 155, '');
@endphp

@section('title', $title . ' | Unique Aircon Blog - AC Tips Kolkata')
@section('meta_description', $metaDescription)
@section('og_type', 'article')
@section('og_title', $title . ' | Unique Aircon Blog')
@section('og_description', $summary)
@section('og_image', $featuredImageUrl)
@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context'         => 'https://schema.org',
    '@type'            => 'Article',
    'headline'         => $title,
    'description'      => $summary,
    'image'            => [$featuredImageUrl],
    'datePublished'    => optional($post->published_at)->toIso8601String(),
    'dateModified'     => optional($post->updated_at)->toIso8601String(),
    'author'           => ['@type' => 'Organization', 'name' => 'Unique Aircon'],
    'publisher'        => [
        '@type' => 'Organization',
        'name'  => 'Unique Aircon',
        'logo'  => ['@type' => 'ImageObject', 'url' => asset('favicon-96x96.png')],
    ],
    'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => url()->current()],
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')
<section class="article-page">
    <div class="container article-shell">
        <article class="article-card">
            <figure class="article-featured-image">
                <img src="{{ $featuredImageUrl }}" alt="{{ $title }}" fetchpriority="high">
            </figure>

            <div class="article-card-body">
                <h1>{{ $title }}</h1>
                <div class="article-meta">
                    <span>{{ $publishedDate }}</span>
                    <span>AC service insights</span>
                    <span>Kolkata</span>
                </div>

                <div class="blog-prose">
                    @if(\Illuminate\Support\Str::contains($content, '<'))
                        {!! $content !!}
                    @else
                        {!! nl2br(e($content)) !!}
                    @endif
                </div>
            </div>
        </article>

        <aside class="article-sidebar" aria-label="Service contact">
            <div class="article-clap-panel"
                 id="articleClapPanel"
                 data-clap-url="{{ route('blog.clap', $post->slug) }}"
                 data-cap="{{ \App\Http\Controllers\Web\BlogClapController::CAP_PER_VISITOR }}"
                 data-visitor-claps="{{ $visitorClapCount }}">
                <button type="button" class="clap-btn" id="clapBtn" aria-label="Clap for this article">
                    <span class="clap-btn-burst" aria-hidden="true"></span>
                    <span class="clap-btn-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11V6a1.5 1.5 0 0 1 3 0v5"/>
                            <path d="M12 10.5V4.5a1.5 1.5 0 0 1 3 0V11"/>
                            <path d="M15 10.5V6a1.5 1.5 0 0 1 3 0v8c0 3.31-2.69 6-6 6h-1c-2.4 0-4.13-.96-5.4-2.7L3 13.5a1.5 1.5 0 0 1 2.4-1.8L7 14"/>
                        </svg>
                    </span>
                </button>
                <div class="clap-meta">
                    <span class="clap-count" id="clapCount">{{ number_format($post->clap_count) }}</span>
                    <span class="clap-label">claps</span>
                </div>

                @include('site.components.share-button', ['shareUrl' => url()->current(), 'shareTitle' => $title])
            </div>

            <div class="article-cta-panel">
                <p class="article-cta-label">Need AC help?</p>
                <h2>Book a Kolkata technician</h2>
                <p>Transparent inspection, repair advice, and same-day support across South and Central Kolkata.</p>
                <a class="primary-btn" href="{{ route('contact') }}" data-track="cta_click" data-track-label="Blog Article Contact CTA">Get Quote</a>
                <a class="outline-btn" href="tel:+918346904100" data-track="cta_click" data-track-label="Blog Article Call CTA">Call +91 8346904100</a>
            </div>
        </aside>
    </div>
</section>

<script>
(function () {
    var panel = document.getElementById('articleClapPanel');
    if (!panel) return;

    var btn = document.getElementById('clapBtn');
    var countEl = document.getElementById('clapCount');
    var cap = parseInt(panel.dataset.cap, 10) || 20;
    var visitorClaps = parseInt(panel.dataset.visitorClaps, 10) || 0;
    var clapUrl = panel.dataset.clapUrl;
    var requestSeq = 0;
    var latestAppliedSeq = 0;

    function applyCappedState() {
        if (visitorClaps >= cap) {
            panel.classList.add('is-capped');
            btn.setAttribute('aria-label', 'You have clapped the maximum number of times for this article');
        }
    }
    applyCappedState();

    function burst() {
        btn.classList.remove('is-bursting');
        // restart the animation even on rapid repeated clicks
        void btn.offsetWidth;
        btn.classList.add('is-bursting');
    }

    btn.addEventListener('click', function () {
        if (visitorClaps >= cap) {
            applyCappedState();
            return;
        }

        visitorClaps += 1;
        panel.dataset.visitorClaps = visitorClaps;
        countEl.textContent = (parseInt(countEl.textContent.replace(/,/g, ''), 10) + 1).toLocaleString();
        burst();
        applyCappedState();

        // Every click sends its own request -- never silently dropped --
        // but only the most recently STARTED request is allowed to
        // overwrite the displayed totals, so a slow earlier response
        // can't clobber a newer optimistic value with stale data.
        var seq = ++requestSeq;

        fetch(clapUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
            .then(function (response) { return response.json(); })
            .then(function (data) {
                if (seq < latestAppliedSeq) return;
                latestAppliedSeq = seq;

                if (typeof data.clap_count === 'number') {
                    countEl.textContent = data.clap_count.toLocaleString();
                }
                if (typeof data.visitor_claps === 'number') {
                    visitorClaps = data.visitor_claps;
                    panel.dataset.visitorClaps = visitorClaps;
                }
                applyCappedState();
            })
            .catch(function () { /* optimistic UI already applied; ignore network errors */ });
    });
})();
</script>
@endsection
