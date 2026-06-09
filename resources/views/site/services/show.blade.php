@extends('site.layouts.app')
@section('title', $service->name . ' | Unique Air Conditioning & Refrigeration')
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
            @if(optional($service->category)->name)
                <span class="brand-chip">{{ $service->category->name }}</span>
            @endif
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
                <a class="primary-btn" href="{{ route('contact', ['service' => $service->slug]) }}">Book This Service</a>
                <a class="secondary-btn" target="_blank" rel="noopener" href="https://wa.me/918346904100?text={{ $waText }}">WhatsApp Now</a>
            </div>
        </div>
    </div>
</section>

<section class="section svc-final-cta">
    <div class="container cta-panel">
        <h2>Need Fast & Professional AC Service in Kolkata?</h2>
        <p>Book expert AC technicians for installation, repair, maintenance, and commercial HVAC support.</p>
        <div class="quick-actions">
            <a class="primary-btn" href="{{ route('contact') }}">Book Service</a>
            <a class="secondary-btn" href="tel:+918346904100">Call Now</a>
            <a class="ghost-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Us</a>
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
        'name' => 'Unique Air Conditioning & Refrigeration',
        'telephone' => '+918346904100',
    ],
    'offers' => (float) $service->price > 0 ? [
        '@type' => 'Offer',
        'priceCurrency' => 'INR',
        'price' => (float) $service->price,
    ] : null,
]) !!}
</script>
@endsection
