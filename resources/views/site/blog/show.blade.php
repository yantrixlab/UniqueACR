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

                <div class="article-share" id="articleShare" data-share-url="{{ url()->current() }}" data-share-title="{{ $title }}">
                    <button type="button" class="share-btn" id="shareBtn" aria-label="Share this article" aria-haspopup="true" aria-expanded="false">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="18" cy="5" r="3"/>
                            <circle cx="6" cy="12" r="3"/>
                            <circle cx="18" cy="19" r="3"/>
                            <path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"/>
                        </svg>
                    </button>

                    <div class="share-menu" id="shareMenu" role="menu" hidden>
                        <button type="button" class="share-menu-item" role="menuitem" id="copyLinkBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.07 0l2.83-2.83a5 5 0 0 0-7.07-7.07L11.5 4.5"/><path d="M14 11a5 5 0 0 0-7.07 0L4.1 13.83a5 5 0 0 0 7.07 7.07L12.5 19.5"/></svg>
                            <span id="copyLinkLabel">Copy link</span>
                        </button>

                        <div class="share-menu-divider"></div>

                        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="bluesky" data-track="cta_click" data-track-label="Blog Share Bluesky">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 8.5c-.9-1.8-3.4-5.1-5.7-6.7C4 0.2 3 0.7 3.3 2.6c.1.4.3 2.6.5 3.6.6 3.3 1.5 4.1 4.5 4.6-3.1.5-3.9 1.6-5.1 3.6-1 1.7.1 4 2.2 3.5 1.6-.4 3-1.5 4.6-4 1.6 2.5 3 3.6 4.6 4 2.1.5 3.2-1.8 2.2-3.5-1.2-2-2-3.1-5.1-3.6 3-.5 3.9-1.3 4.5-4.6.2-1 .4-3.2.5-3.6.3-1.9-.7-2.4-3-.8C15.4 3.4 12.9 6.7 12 8.5Z"/></svg>
                            Share on Bluesky
                        </a>
                        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="facebook" data-track="cta_click" data-track-label="Blog Share Facebook">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9.5"/><path d="M14.5 8.5h-1.2c-1 0-1.3.5-1.3 1.3V11h2.3l-.3 2.3H12V19h-2.4v-5.7H8V11h1.6V9.6c0-1.9 1-3.4 3.1-3.4h1.8z" fill="currentColor" stroke="none"/></svg>
                            Share on Facebook
                        </a>
                        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="linkedin" data-track="cta_click" data-track-label="Blog Share LinkedIn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2.5"/><path d="M7.5 10.5V17M7.5 7.5v.01M12 17v-4a2 2 0 0 1 4 0v4M12 13v4" stroke-linecap="round"/></svg>
                            Share on LinkedIn
                        </a>
                        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="threads" data-track="cta_click" data-track-label="Blog Share Threads">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.5 7.2c-1-1-2.2-1.5-3.7-1.5-3.4 0-5.6 2.6-5.6 6.3s2.2 6.3 5.7 6.3c2.9 0 4.8-1.4 4.8-3.7 0-1.8-1.2-2.9-3.3-3.2-1.7-.3-3.1-.1-3.6.7-.4.6-.1 1.4.7 1.7.6.2 1.2 0 1.4-.5"/></svg>
                            Share on Threads
                        </a>
                        <a class="share-menu-item" role="menuitem" target="_blank" rel="noopener" data-share="twitter" data-track="cta_click" data-track-label="Blog Share X">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 5l14 14M19 5 5 19"/></svg>
                            Share on X
                        </a>
                    </div>
                </div>
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

(function () {
    var shareWrap = document.getElementById('articleShare');
    if (!shareWrap) return;

    var shareBtn = document.getElementById('shareBtn');
    var shareMenu = document.getElementById('shareMenu');
    var shareUrl = shareWrap.dataset.shareUrl;
    var shareTitle = shareWrap.dataset.shareTitle;

    var links = {
        bluesky: 'https://bsky.app/intent/compose?text=' + encodeURIComponent(shareTitle + ' ' + shareUrl),
        facebook: 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl),
        linkedin: 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(shareUrl),
        threads: 'https://www.threads.net/intent/post?text=' + encodeURIComponent(shareTitle + ' ' + shareUrl),
        twitter: 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(shareTitle) + '&url=' + encodeURIComponent(shareUrl),
    };
    shareMenu.querySelectorAll('[data-share]').forEach(function (link) {
        link.href = links[link.dataset.share];
    });

    function closeMenu() {
        shareMenu.hidden = true;
        shareBtn.setAttribute('aria-expanded', 'false');
    }
    function openMenu() {
        shareMenu.hidden = false;
        shareBtn.setAttribute('aria-expanded', 'true');
    }

    shareBtn.addEventListener('click', function (e) {
        e.stopPropagation();

        // Prefer the native share sheet where available (mobile browsers) --
        // falls back to the dropdown menu of explicit share links otherwise.
        if (navigator.share) {
            navigator.share({ title: shareTitle, url: shareUrl }).catch(function () { /* user cancelled */ });
            return;
        }

        if (shareMenu.hidden) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    document.addEventListener('click', function (e) {
        if (!shareWrap.contains(e.target)) closeMenu();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMenu();
    });

    var copyBtn = document.getElementById('copyLinkBtn');
    var copyLabel = document.getElementById('copyLinkLabel');
    copyBtn.addEventListener('click', function () {
        navigator.clipboard.writeText(shareUrl).then(function () {
            copyLabel.textContent = 'Copied!';
            setTimeout(function () {
                copyLabel.textContent = 'Copy link';
                closeMenu();
            }, 1200);
        });
    });
})();
</script>
@endsection
