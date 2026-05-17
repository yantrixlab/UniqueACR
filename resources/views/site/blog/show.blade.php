@extends('site.layouts.app')
@section('title',$post->title)
@section('content')
<section><div class="container"><article class="card"><h1>{{ $post->title }}</h1><p class="muted">{{ optional($post->published_at)->format('d M Y') }}</p><div>{!! nl2br(e($post->content)) !!}</div></article></div></section>
@endsection
