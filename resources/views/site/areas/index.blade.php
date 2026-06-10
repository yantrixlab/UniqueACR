@extends('site.layouts.app')
@section('title', 'AC Service Areas in South Kolkata | All Zones – Cooling Kolkata')
@section('meta_description', 'Cooling Kolkata provides onsite AC repair, installation & maintenance across South Kolkata — Jadavpur, Garia, Tollygunge, Behala, Kasba, Ballygunge & more. Check your area.')
@section('meta_keywords', 'AC service South Kolkata, AC repair near me Kolkata, AC service areas Kolkata, Cooling Kolkata service zones')
@section('og_title', 'AC Service Areas in South Kolkata | Cooling Kolkata')
@section('og_description', 'Find out if Cooling Kolkata covers your area. We serve 16+ localities across 4 zones in South & Central Kolkata.')
@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],
        ['@type'=>'ListItem','position'=>2,'name'=>'Service Areas','item'=>route('areas.index')],
    ],
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endsection
@section('content')

<section class="section" style="padding-top:2.5rem;">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span aria-hidden="true"> › </span>
            <span aria-current="page">Service Areas</span>
        </nav>

        <h1 style="margin-top:1rem;">AC Service Areas in South &amp; Central Kolkata</h1>
        <p class="sub" style="max-width:640px;">We provide onsite AC repair, installation, and maintenance across <strong>{{ $zones->flatten()->count() }} localities</strong> in 4 zones. Find your area below and book a same-day visit.</p>
    </div>
</section>

@foreach($zones as $zoneName => $areas)
<section class="section" style="padding-top:1.5rem;padding-bottom:1.5rem;">
    <div class="container">
        <h2 style="font-size:1.2rem;color:var(--accent);margin-bottom:1rem;">{{ $zoneName }}</h2>
        <div class="services-grid">
            @foreach($areas as $area)
            <a href="{{ route('areas.show', $area->slug) }}" class="card svc-card" style="text-decoration:none;">
                <div style="padding:1.25rem 1.5rem;">
                    <h3 style="font-size:1rem;margin-bottom:.4rem;">{{ $area->name }}</h3>
                    <p style="font-size:.85rem;color:var(--text-muted);margin-bottom:.5rem;">{{ $area->pinCodesDisplay() }}</p>
                    <span style="font-size:.8rem;color:var(--accent);">{{ $area->distance_km }} from base →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endforeach

<section class="section svc-final-cta">
    <div class="container cta-panel">
        <h2>Don't See Your Area?</h2>
        <p>We may still be able to reach you. Call us or drop a WhatsApp and our team will confirm availability.</p>
        <div class="quick-actions">
            <a class="primary-btn" href="{{ route('contact') }}">Book Service</a>
            <a class="secondary-btn" href="tel:+918346904100">Call Now</a>
            <a class="ghost-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Us</a>
        </div>
    </div>
</section>

@endsection
