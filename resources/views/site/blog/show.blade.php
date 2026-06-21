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
@endsection
