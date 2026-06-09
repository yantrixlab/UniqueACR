@extends('site.layouts.app')
@section('title','Professional AC Repair, Installation & HVAC Solutions | Unique Air')
@section('content')
<section class="svc-hero">
    <div class="svc-glow a"></div><div class="svc-glow b"></div>
    <div class="container svc-hero-grid">
        <div class="svc-copy">
            <span class="pill svc-badge"><span class="svc-badge-dot"></span>Trusted AC Experts in Kolkata</span>
            <h1>Professional AC Repair, Installation & HVAC Solutions</h1>
            <p>Expert domestic and commercial AC servicing with fast response, certified technicians, genuine spare parts, and reliable cooling solutions across Kolkata.</p>
            <div class="cta-row svc-cta">
                <a class="primary-btn svc-primary" href="{{ route('contact') }}">Book AC Service</a>
                <a class="secondary-btn svc-secondary" href="{{ route('contact') }}">Get Free Inspection</a>
            </div>
            <ul class="hero-trust-points svc-trust">
                <li>Same Day Service</li><li>Certified Technicians</li><li>Genuine Parts</li><li>Commercial HVAC Experts</li>
            </ul>
        </div>
        <div class="svc-scene" aria-hidden="true">
            <div class="svc-grid-overlay"></div>
            <div class="svc-ac"><span class="svc-temp">19°C</span><span class="svc-status">Service Active</span></div>
            <div class="svc-air a"></div><div class="svc-air b"></div><div class="svc-air c"></div>
            <div class="svc-particles">
                <span class="p1"></span><span class="p2"></span><span class="p3"></span><span class="p4"></span><span class="p5"></span>
            </div>
            <div class="svc-gear g1">⚙</div>
            <div class="svc-gear g2">⚙</div>
            <div class="svc-ui one">Diagnostics • Stable</div>
            <div class="svc-ui two"><span>Repair Progress</span><div class="svc-mini-track"><span></span></div></div>
            <div class="svc-ui three">PM2.5: Normal</div>
            <div class="svc-tech"></div>
        </div>
    </div>
</section>

<section class="svc-nav-wrap">
    <div class="container">
        <nav class="svc-nav" aria-label="Service category navigation">
            <a href="#all-services">All Services</a>
            <a href="#all-services">Domestic + Commercial</a>
            <a href="#featured">Installation</a>
            <a href="#featured">Repair</a>
            <a href="#featured">Maintenance</a>
            <a href="#amc">AMC Services</a>
        </nav>
    </div>
</section>

@php
    $allServices = $services->values();
    $featuredServices = $allServices->take(6);
    $domesticServices = $allServices->filter(fn ($s) => optional($s->category)->segment === 'domestic')->values();
    $commercialServices = $allServices->filter(fn ($s) => optional($s->category)->segment === 'commercial')->values();

    $getServiceImage = function ($service): string {
        $path = $service->image_path;
        if (!$path) {
            return 'data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 900 520%22><defs><linearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22><stop offset=%220%25%22 stop-color=%22%23e8eef8%22/><stop offset=%22100%25%22 stop-color=%22%23d9e5f6%22/></linearGradient></defs><rect width=%22900%22 height=%22520%22 fill=%22url(%23g)%22/><rect x=%22335%22 y=%22195%22 width=%22230%22 height=%22130%22 rx=%2218%22 fill=%22%23ffffff%22 stroke=%22%23b7cceb%22/><rect x=%22365%22 y=%22238%22 width=%22170%22 height=%2224%22 rx=%2212%22 fill=%22%238ec3f5%22/><circle cx=%22520%22 cy=%22222%22 r=%2212%22 fill=%22%233c7cc0%22/></svg>';
        }
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', 'data:'])) {
            return $path;
        }
        return asset('storage/' . ltrim($path, '/'));
    };
@endphp

<section class="section" id="featured">
    <div class="container">
        <h2>Featured Services</h2>
        <p class="sub">High-demand AC and HVAC services with transparent pricing and expert support.</p>
        <div class="svc-feature-grid">
            @forelse($featuredServices as $service)
                @php
                    $waText = rawurlencode('I need service for ' . $service->name);
                    $tag = $service->service_type ?: (optional($service->category)->segment === 'commercial' ? 'Commercial' : 'Popular');
                    $priceText = (float) $service->price > 0 ? '₹' . number_format((float) $service->price, 0) : 'Custom';
                    $image = $getServiceImage($service);
                @endphp
                <article class="product-item-card premium-product-card svc-product-card">
                    <a class="product-image-wrap svc-cover" href="{{ route('services.show', $service->slug) }}">
                        <img loading="lazy" src="{{ $image }}" alt="{{ $service->name }}">
                        <span class="card-top-tag">{{ \Illuminate\Support\Str::title($tag) }}</span>
                    </a>
                    <div class="product-card-body svc-card-body">
                        <div class="product-top-meta premium-meta">
                            <span class="brand-chip">{{ \Illuminate\Support\Str::title($service->service_type) }}</span>
                            <h3 class="card-price-heading">{{ $priceText }}</h3>
                        </div>
                        <h3>{{ $service->name }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($service->description, 96) }}</p>
                        <div class="stock-chip">{{ $service->is_active ? 'Available Today' : 'On Request' }}</div>
                        <div class="card-btn-row">
                            <a class="primary-btn" href="{{ route('services.show', $service->slug) }}">Book Service</a>
                            <a class="outline-btn wa-icon-btn" target="_blank" rel="noopener" aria-label="WhatsApp" href="https://wa.me/918346904100?text={{ $waText }}">
                                <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="#25D366" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <article class="product-item-card"><div class="product-card-body"><h3>No services added yet.</h3></div></article>
            @endforelse
        </div>
    </div>
</section>

<section class="section" id="all-services">
    <div class="container">
        <h2>All Services</h2>
        <p class="sub">Domestic and commercial AC solutions managed from a single service catalog.</p>
        <div class="svc-type-grid">
            @forelse($allServices as $service)
                @php
                    $waText = rawurlencode('I need service for ' . $service->name);
                    $priceText = (float) $service->price > 0 ? '₹' . number_format((float) $service->price, 0) : 'Custom';
                    $image = $getServiceImage($service);
                    $segmentTag = optional($service->category)->segment === 'commercial' ? 'Commercial' : 'Domestic';
                @endphp
                <article class="product-item-card premium-product-card svc-product-card">
                    <a class="product-image-wrap svc-cover" href="{{ route('services.show', $service->slug) }}">
                        <img loading="lazy" src="{{ $image }}" alt="{{ $service->name }}">
                        <span class="card-top-tag">{{ $segmentTag }}</span>
                    </a>
                    <div class="product-card-body svc-card-body">
                        <div class="product-top-meta premium-meta">
                            <span class="brand-chip">{{ \Illuminate\Support\Str::title($service->service_type) }}</span>
                            <h3 class="card-price-heading">{{ $priceText }}</h3>
                        </div>
                        <h3>{{ $service->name }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($service->description, 96) }}</p>
                        <div class="stock-chip">{{ $service->is_active ? 'Available Today' : 'On Request' }}</div>
                        <div class="card-btn-row">
                            <a class="primary-btn" href="{{ route('services.show', $service->slug) }}">Book Service</a>
                            <a class="outline-btn wa-icon-btn" target="_blank" rel="noopener" aria-label="WhatsApp" href="https://wa.me/918346904100?text={{ $waText }}">
                                <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="#25D366" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <article class="product-item-card"><div class="product-card-body"><h3>No services found.</h3></div></article>
            @endforelse
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Our Service Process</h2>
        <div class="timeline svc-time">
            <div><span>1. Book Service</span><p>Share your requirement via call, form, or WhatsApp.</p></div>
            <div><span>2. Technician Assignment</span><p>Nearest certified expert is assigned quickly.</p></div>
            <div><span>3. Inspection & Diagnosis</span><p>Complete issue assessment and estimate.</p></div>
            <div><span>4. Repair / Installation</span><p>Professional execution with genuine parts.</p></div>
            <div><span>5. Quality Check</span><p>Cooling performance and safety verification.</p></div>
            <div><span>6. Completion & Support</span><p>Post-service guidance and warranty support.</p></div>
        </div>
    </div>
</section>

<section class="section amc-promo-section">
    <div class="container">
        <div class="amc-promo-banner">
            <div class="amc-glow a"></div>
            <div class="amc-glow b"></div>
            <div class="amc-content">
                <span class="pill amc-pill"><span class="svc-badge-dot"></span>Premium Preventive Care</span>
                <h2>Annual AC Maintenance Contract (AMC)</h2>
                <p>Reliable AC servicing, preventive maintenance, faster cooling &amp; longer AC life for homes and businesses in Kolkata.</p>
                <div class="cta-row amc-cta-row">
                    <a class="primary-btn" href="{{ route('contact', ['service_type' => 'AMC']) }}">Book AMC Now</a>
                    <a class="secondary-btn" href="{{ route('contact') }}">Get Free Consultation</a>
                </div>
            </div>
            <div class="amc-visual" aria-hidden="true">
                <div class="amc-visual-grid"></div>
                <div class="amc-unit">
                    <span class="amc-led"></span>
                    <span class="amc-slot"></span>
                </div>
                <div class="amc-air a"></div>
                <div class="amc-air b"></div>
                <div class="amc-air c"></div>
                <span class="amc-tech-chip t1">Filter Health 96%</span>
                <span class="amc-tech-chip t2">Gas Level Stable</span>
                <span class="amc-tech-chip t3">Coil Clean</span>
                <span class="amc-part p1">⚙</span>
                <span class="amc-part p2">🧰</span>
                <span class="amc-part p3">🔧</span>
                <div class="amc-particles">
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section svc-emergency">
    <div class="container svc-em-card">
        <h2>24/7 Emergency AC Support</h2>
        <p>Rapid response team for urgent repair and cooling failures.</p>
        <div class="quick-actions">
            <a class="primary-btn" href="tel:+918346904100">Call Now</a>
            <a class="secondary-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Us</a>
        </div>
        <p class="availability-dot"><span></span>Average response time: 30-45 minutes</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Why Choose Our Services</h2>
        <div class="why-grid">
            <article>Certified Technicians</article><article>Genuine Spare Parts</article><article>Fast Service</article>
            <article>Affordable Pricing</article><article>Warranty Support</article><article>Commercial Expertise</article>
        </div>
    </div>
</section>

<section class="section" id="amc">
    <div class="container">
        <h2>AMC / Maintenance Plans</h2>
        <div class="amc-grid">
            <article><h3>Basic AMC</h3><p>2 preventive visits/year</p><strong>₹2,999 / unit</strong><a href="{{ route('contact') }}">Choose Plan</a></article>
            <article class="featured"><h3>Standard AMC</h3><p>4 visits + priority support</p><strong>₹4,999 / unit</strong><a href="{{ route('contact') }}">Choose Plan</a></article>
            <article><h3>Premium AMC</h3><p>6 visits + emergency support</p><strong>₹7,999 / unit</strong><a href="{{ route('contact') }}">Choose Plan</a></article>
        </div>
    </div>
</section>

<section class="section areas-zone">
    <div class="container">
        <h2>Find Us in Jadavpur</h2>
        <p class="sub">Coverage: Jadavpur, Garia, Dhakuria, Tollygunge, Ballygunge, Kasba, Santoshpur.</p>
        <div class="map-shell">
            <div class="map-location-label" aria-hidden="true">
                <strong>UNIQUE AIR</strong>
                <span>3/87 C. R Colony, Jadavpur, Kolkata - 700032</span>
            </div>
            <div class="map-focus-pin" aria-hidden="true">
                <span class="pin-core"></span>
                <span class="pin-wave wave-1"></span>
                <span class="pin-wave wave-2"></span>
                <span class="pin-wave wave-3"></span>
            </div>
            <iframe
                title="Unique Air Conditioning & Refrigeration Service Area Map"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q=22.486403,88.375548&z=16&output=embed"></iframe>
        </div>
        <div class="coverage-tags">
            <span>Jadavpur</span><span>South Kolkata</span><span>North Kolkata</span><span>Garia</span><span>Tollygunge</span><span>Kasba</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Customer Reviews</h2>
        <div class="test-grid">
            <article class="test-card"><div class="stars">★★★★★</div><p>Same-day AC repair with clear pricing.</p><strong>— Anirban S.</strong></article>
            <article class="test-card"><div class="stars">★★★★★</div><p>Great technicians and excellent support.</p><strong>— Priya K.</strong></article>
            <article class="test-card"><div class="stars">★★★★★</div><p>Professional HVAC maintenance for our office.</p><strong>— Rahul D.</strong></article>
        </div>
    </div>
</section>

<section class="section faq-zone">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-list">
            <details><summary>Do you provide same day AC repair?</summary><p>Yes, based on technician slot availability in your area.</p></details>
            <details><summary>Which AC brands do you support?</summary><p>Most major brands including Daikin, Voltas, OGeneral and more.</p></details>
            <details><summary>Do you provide commercial HVAC support?</summary><p>Yes, from VRV/VRF to ductable and chiller systems.</p></details>
            <details><summary>Do you offer AMC packages?</summary><p>Yes, we offer Basic, Standard, and Premium AMC plans.</p></details>
            <details><summary>Which areas do you serve?</summary><p>Across Kolkata, including Jadavpur and nearby zones.</p></details>
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
    'serviceType' => 'AC Repair, AC Installation, HVAC Services',
    'provider' => [
        '@type' => 'LocalBusiness',
        'name' => 'Unique Air Conditioning & Refrigeration',
        'telephone' => '+918346904100',
        'areaServed' => ['Kolkata','Jadavpur','South Kolkata','North Kolkata'],
    ],
]) !!}
</script>
@endsection
