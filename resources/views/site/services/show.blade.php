@extends('site.layouts.app')
@section('title', $service->name . ' in Kolkata | Unique Aircon')
@section('meta_description', ($service->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($service->description ?? ''), 150, '')) ?: 'Professional ' . $service->name . ' in Kolkata by certified technicians. Transparent pricing, same-day service. Call Unique Aircon at +91 8346904100.')
@section('og_title', $service->name . ' in Kolkata | Unique Aircon')
@section('og_description', \Illuminate\Support\Str::limit(strip_tags($service->description ?? ''), 160, '') ?: 'Expert ' . $service->name . ' in Kolkata. Fast response, genuine parts, certified technicians.')
@section('og_image', $service->image_path ? asset('storage/' . ltrim($service->image_path, '/')) : asset('upload/web_image_res/home_hero_right.webp'))
@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'Service',
    'name'     => $service->name,
    'description' => strip_tags($service->description ?? ''),
    'provider' => [
        '@type'     => 'LocalBusiness',
        'name'      => 'Unique Aircon',
        'telephone' => '+918346904100',
        'address'   => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => '3/87 C. R Colony, Jadavpur',
            'addressLocality' => 'Kolkata',
            'addressRegion'   => 'West Bengal',
            'postalCode'      => '700032',
            'addressCountry'  => 'IN',
        ],
    ],
    'areaServed'     => ['@type' => 'City', 'name' => 'Kolkata'],
    'serviceType'    => $service->service_type ?? 'AC Service',
    'offers'         => $service->price > 0 ? [
        '@type'         => 'Offer',
        'price'         => (string)$service->price,
        'priceCurrency' => 'INR',
        'availability'  => 'https://schema.org/InStock',
    ] : null,
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endsection
@section('content')

@php
    $image = $service->image_path
        ? (\Illuminate\Support\Str::startsWith($service->image_path, ['http://', 'https://', 'data:'])
            ? $service->image_path
            : asset('storage/' . ltrim($service->image_path, '/')))
        : null;
    $priceText = (float) $service->price > 0 ? '₹' . number_format((float) $service->price, 0) : 'Custom Pricing';
    $waText = rawurlencode('I need service for ' . $service->name);
@endphp

<section class="section product-detail-page">
    <div class="container product-detail-grid">
        <div class="detail-gallery">
            @if($image)
                <img src="{{ $image }}" alt="{{ $service->name }}" loading="eager">
            @else
                <div style="background:linear-gradient(135deg,#e8eef8,#d9e5f6);border-radius:12px;display:flex;align-items:center;justify-content:center;min-height:320px;">
                    <svg viewBox="0 0 120 80" style="width:120px;opacity:.4"><rect x="10" y="20" width="100" height="40" rx="8" fill="#3c7cc0"/><rect x="20" y="32" width="80" height="16" rx="8" fill="#8ec3f5"/><circle cx="95" cy="28" r="6" fill="#1a4e8a"/></svg>
                </div>
            @endif
        </div>

        <div class="detail-content">
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:.5rem;">
                @if(optional($service->category)->name)
                    <span class="brand-chip">{{ $service->category->name }}</span>
                @endif
                @php $seg = $service->segment ?? 'domestic'; @endphp
                <span class="svc-segment-badge svc-segment-badge--{{ $seg }}">
                    {{ $seg === 'commercial' ? '🏢 Commercial' : '🏠 Domestic' }}
                </span>
            </div>
            <h1>{{ $service->name }}</h1>

            @if($service->service_type)
                <p style="color:var(--accent);font-weight:600;margin-bottom:.5rem;">{{ \Illuminate\Support\Str::title($service->service_type) }}</p>
            @endif

            <p>{{ $service->description }}</p>

            <div class="price-row detail-price">
                <strong>{{ $priceText }}</strong>
                <span class="stock-chip" style="margin-left:1rem;">{{ $service->is_active ? 'Available Today' : 'On Request' }}</span>
            </div>

            <div class="detail-cta-row">
                <a class="primary-btn" href="{{ route('contact', ['service' => $service->slug]) }}" data-track="service_book_click" data-track-label="{{ $service->name }}">Book This Service</a>
                <a class="secondary-btn" target="_blank" rel="noopener" href="https://wa.me/918346904100?text={{ $waText }}" data-track="service_whatsapp_click" data-track-label="{{ $service->name }}">WhatsApp Now</a>
            </div>
        </div>
    </div>
</section>

@if($otherServices->isNotEmpty())
<section class="section svc-others-section">
    <div class="container">
        <h2 class="svc-others-title">Other Services</h2>
        <div class="svc-others-grid">
            @foreach($otherServices as $other)
            @php
                $otherImg = $other->image_path
                    ? asset('storage/' . ltrim($other->image_path, '/'))
                    : null;
                $otherPrice = (float) $other->price > 0 ? '₹' . number_format((float) $other->price, 0) : 'Custom Pricing';
            @endphp
            <a class="svc-other-card" href="{{ route('services.show', $other->slug) }}" data-track="select_service" data-track-label="{{ $other->name }} (Related)">
                <div class="svc-other-img">
                    @if($otherImg)
                        <img src="{{ $otherImg }}" alt="{{ $other->name }}" loading="lazy">
                    @else
                        <div class="svc-other-img-placeholder">
                            <svg viewBox="0 0 120 80" aria-hidden="true"><rect x="10" y="20" width="100" height="40" rx="8" fill="#3c7cc0"/><rect x="20" y="32" width="80" height="16" rx="8" fill="#8ec3f5"/><circle cx="95" cy="28" r="6" fill="#1a4e8a"/></svg>
                        </div>
                    @endif
                </div>
                <div class="svc-other-body">
                    @if(optional($other->category)->name)
                        <span class="brand-chip">{{ $other->category->name }}</span>
                    @endif
                    <h3>{{ $other->name }}</h3>
                    <p class="svc-other-price">{{ $otherPrice }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section svc-final-cta">
    <div class="container cta-panel">
        <h2>Need Fast & Professional AC Service in Kolkata?</h2>
        <p>Book expert AC technicians for installation, repair, maintenance, and commercial HVAC support.</p>
        <div class="quick-actions">
            <a class="primary-btn" href="{{ route('contact') }}" data-track="cta_click" data-track-label="Book Service - Service Detail Final CTA">Book Service</a>
            <a class="secondary-btn" href="tel:+918346904100" data-track="cta_click" data-track-label="Call Now - Service Detail Final CTA">Call Now</a>
            <a class="ghost-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener" data-track="cta_click" data-track-label="WhatsApp Us - Service Detail Final CTA">WhatsApp Us</a>
        </div>
    </div>
</section>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $service->name,
    'description' => $service->description,
    'provider' => [
        '@type' => 'LocalBusiness',
        'name' => 'Unique Aircon',
        'telephone' => '+918346904100',
    ],
    'offers' => (float) $service->price > 0 ? [
        '@type' => 'Offer',
        'priceCurrency' => 'INR',
        'price' => (float) $service->price,
    ] : null,
]) !!}
</script>
<script>
if (typeof gtag === 'function') {
    gtag('event', 'view_item', {
        label: @json($service->name),
        category: 'service',
    });
}
</script>
@endsection

