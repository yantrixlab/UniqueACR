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
<section style="padding-top:73px"><div class="container"><article class="card"><h1>{{ $post->title }}</h1><p class="muted">{{ optional($post->published_at)->format('d M Y') }}</p><div>{!! nl2br(e($post->content)) !!}</div></article></div></section>
@endsection

