@extends('site.layouts.app')
@section('title', $post->title . ' | Unique Aircon Blog – AC Tips Kolkata')
@section('meta_description', $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 155, ''))
@section('og_type', 'article')
@section('og_title', $post->title . ' | Unique Aircon Blog')
@section('og_description', \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 160, ''))
@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context'         => 'https://schema.org',
    '@type'            => 'Article',
    'headline'         => $post->title,
    'description'      => \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 160, ''),
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
<section style="padding-top:73px"><div class="container"><article class="card"><h1>{{ $post->title }}</h1><p class="muted">{{ optional($post->published_at)->format('d M Y') }}</p><div class="blog-prose">
@if(\Illuminate\Support\Str::contains($post->content, '<'))
    {!! \Illuminate\Support\Str::sanitizeHtml($post->content) !!}
@else
    {!! nl2br(e($post->content)) !!}
@endif
</div></article></div></section>

<style>
.blog-prose { font-size: 1rem; line-height: 1.75; color: inherit; }
.blog-prose h2 { font-size: 1.5rem; font-weight: 700; margin: 1.6em 0 .6em; }
.blog-prose h3 { font-size: 1.25rem; font-weight: 700; margin: 1.4em 0 .5em; }
.blog-prose h4 { font-size: 1.1rem; font-weight: 700; margin: 1.2em 0 .5em; }
.blog-prose p { margin: 0 0 1em; }
.blog-prose ul, .blog-prose ol { padding-left: 1.4em; margin: 0 0 1em; }
.blog-prose li { margin-bottom: .35em; }
.blog-prose img { max-width: 100%; height: auto; border-radius: 10px; margin: 1em 0; }
.blog-prose blockquote { border-left: 3px solid #2563eb; margin: 1em 0; padding: .5em 1.2em; background: rgba(37,99,235,.06); border-radius: 0 8px 8px 0; color: inherit; }
.blog-prose a { color: #2563eb; text-decoration: underline; }
.blog-prose table { width: 100%; border-collapse: collapse; margin: 1em 0; }
.blog-prose table td, .blog-prose table th { border: 1px solid rgba(122,153,198,.3); padding: .5em .75em; }
.blog-prose code { background: rgba(122,153,198,.15); padding: .15em .4em; border-radius: 4px; font-size: .9em; }
.blog-prose pre { background: #0f172a; color: #e2e8f0; padding: 1em; border-radius: 8px; overflow-x: auto; margin: 1em 0; }
.blog-prose hr { border: none; border-top: 1px solid rgba(122,153,198,.3); margin: 1.5em 0; }
</style>
@endsection

