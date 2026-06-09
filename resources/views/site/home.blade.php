@extends('site.layouts.app')
@section('title','Expert AC Servicing & Installation in Kolkata | Unique Air')
@section('content')
<section class="hero">
    <div class="hero-glow hero-glow-a"></div>
    <div class="hero-glow hero-glow-b"></div>
    <div class="container hero-shell hero-grid premium-hero-grid">
        <div class="hero-copy premium-hero-copy">
            <span class="pill">Trusted AC Experts in Kolkata • 7+ Years Experience</span>
            <h1>Fast, Reliable AC Service That Keeps You Cool All Year Round</h1>
            <p>Professional AC repair, installation, gas charging, and maintenance services for homes, offices, and commercial spaces. Certified technicians, transparent pricing, and quick response.</p>
            <div class="cta-row premium-cta-row">
                <a class="primary-btn" href="{{ route('contact') }}">Book Service</a>
                <a class="secondary-btn" href="{{ route('contact', ['service_type' => 'AMC']) }}">Get AMC Plan</a>
            </div>
            <ul class="hero-trust-points">
                <li>Same Day Service</li>
                <li>Certified Technicians</li>
                <li>Genuine Parts</li>
                <li>24/7 Support</li>
            </ul>
        </div>
        <div class="hero-visual-wrap" aria-hidden="true">
            <div class="hero-image-card">
                <img id="heroImg" src="/upload/web_image_res/home_hero_right.webp" alt="Professional AC service team and cooling solutions" loading="eager" class="hero-img-hidden">
                <div class="hero-airflow-wrap" aria-hidden="true">
                    <span class="hero-cool-glow"></span>
                    <div class="hero-mist-streams">
                        <span class="mist mist-1"></span>
                        <span class="mist mist-2"></span>
                        <span class="mist mist-3"></span>
                        <span class="mist mist-4"></span>
                    </div>
                    <div class="hero-airflow-particles">
                        <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section compact-top">
    <div class="container">
        <h2>Specialized Climate Solutions</h2>
        <p class="sub">Tailored cooling services for every environment.</p>
        <div class="split-cards">
            <article class="split-card light climate-card">
                <div class="mini-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 14a8 8 0 0 1 16 0M6.5 18h11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8 10.5c.8-.8 1.8-1.2 3-1.2 1.1 0 2 .4 2.8 1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </div>
                <h3>Domestic AC Services</h3>
                <p>Quick repair, deep cleaning, and seasonal maintenance for your home units. We handle Split, Window, and Inverter ACs with genuine parts.</p>
                <a href="{{ route('services.index', ['segment' => 'domestic']) }}">Learn more</a>
            </article>
            <article class="split-card dark climate-card">
                <div class="mini-icon mini-dark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><rect x="3.5" y="5.5" width="17" height="13" rx="2.2" stroke="currentColor" stroke-width="1.7"/><path d="M7 10h10M8 13h8M9 16h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                </div>
                <h3>Commercial HVAC</h3>
                <p>Scalable cooling for offices, factories, and retail spaces with VRV/VRF, Ductable, and Chiller systems.</p>
                <a class="badge-btn" href="{{ route('services.index', ['segment' => 'commercial']) }}">View Projects</a>
            </article>
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

<section class="section zz-process-section">
    <div class="container">
        <div class="zz-head">
            <h2>Our Service Process</h2>
            <p>Simple, transparent, and fast — from booking to completion.</p>
        </div>
        <div class="zz-timeline">
            <div class="zz-line"></div>

            @php
            $steps = [
                ['num'=>'01','title'=>'Book Service',          'desc'=>'Share your requirement via call, form, or WhatsApp.', 'icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                ['num'=>'02','title'=>'Technician Assignment', 'desc'=>'Nearest certified expert is assigned quickly.',         'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['num'=>'03','title'=>'Inspection & Diagnosis','desc'=>'Complete issue assessment and estimate.',               'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                ['num'=>'04','title'=>'Repair / Installation',  'desc'=>'Professional execution with genuine parts.',           'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                ['num'=>'05','title'=>'Quality Check',          'desc'=>'Cooling performance and safety verification.',        'icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                ['num'=>'06','title'=>'Completion & Support',   'desc'=>'Post-service guidance and warranty support.',         'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="zz-step {{ $i % 2 === 0 ? 'zz-right' : 'zz-left' }}">
                <div class="zz-card">
                    <div class="zz-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="{{ $step['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <span class="zz-num">Step {{ $step['num'] }}</span>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['desc'] }}</p>
                    </div>
                </div>
                <div class="zz-dot"><span></span></div>
                <div class="zz-empty"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section home-services-preview">
    <div class="container">
        <div class="section-head hs-section-head">
            <div>
                <h2>Our Services</h2>
                <p class="sub">Explore popular AC repair, installation, and maintenance solutions.</p>
            </div>
            <a class="view-all-btn" href="{{ route('services.index') }}">
                View All
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 10h12M11 5l5 5-5 5"/></svg>
            </a>
        </div>
    </div>
    <div class="hs-scroll-row">
        @forelse($services as $i => $service)
                @php
                    $serviceImage = $service->image_path
                        ? (\Illuminate\Support\Str::startsWith($service->image_path, ['http://', 'https://', 'data:'])
                            ? $service->image_path
                            : asset('storage/' . ltrim($service->image_path, '/')))
                        : '';
                    $servicePrice = (float) $service->price > 0 ? '₹' . number_format((float) $service->price, 0) : 'Custom';
                    $serviceType = $service->service_type ? \Illuminate\Support\Str::title($service->service_type) : 'Service';
                @endphp
                <article class="product-item-card premium-product-card">
                    <a class="product-image-wrap" href="{{ route('services.index') }}">
                        <img loading="lazy" src="{{ $serviceImage }}" alt="{{ $service->name }}" onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 900 520%22><defs><linearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22><stop offset=%220%25%22 stop-color=%22%23e8eef8%22/><stop offset=%22100%25%22 stop-color=%22%23d9e5f6%22/></linearGradient></defs><rect width=%22900%22 height=%22520%22 fill=%22url(%23g)%22/><rect x=%22335%22 y=%22195%22 width=%22230%22 height=%22130%22 rx=%2218%22 fill=%22%23ffffff%22 stroke=%22%23b7cceb%22/><rect x=%22365%22 y=%22238%22 width=%22170%22 height=%2224%22 rx=%2212%22 fill=%22%238ec3f5%22/><circle cx=%22520%22 cy=%22222%22 r=%2212%22 fill=%22%233c7cc0%22/></svg>';">
                        <span class="card-top-tag">{{ $i === 0 ? 'Top Service' : ($i === 1 ? 'Fast Support' : 'Trusted') }}</span>
                    </a>
                    <div class="product-card-body">
                        <div class="product-top-meta premium-meta">
                            <span class="brand-chip">{{ $serviceType }}</span>
                            <h3 class="card-price-heading">{{ $servicePrice }}</h3>
                        </div>
                        <h3><a href="{{ route('services.index') }}">{{ $service->name }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit($service->description, 95) }}</p>
                        <div class="stock-chip">{{ $service->is_active ? 'Available Today' : 'On Request' }}</div>
                        <div class="card-btn-row">
                            <a class="primary-btn" href="{{ route('contact', ['service' => $service->slug]) }}">Book Service</a>
                            <a class="outline-btn wa-icon-btn" target="_blank" rel="noopener" aria-label="WhatsApp" href="https://wa.me/918346904100?text={{ rawurlencode('I need service for '.$service->name) }}">
                                <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="#25D366" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
        @empty
            <article class="product-item-card"><div class="product-card-body"><h3>No services available</h3></div></article>
        @endforelse
    </div>
</section>

<section class="section product-zone">
    <div class="container">
        <div class="section-head">
            <div>
                <h2>Featured Products</h2>
                <p class="sub">Authorized sales and installation of top-tier cooling brands.</p>
            </div>
            <a class="view-all-btn" href="{{ route('products.index') }}">
                View All
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 10h12M11 5l5 5-5 5"/></svg>
            </a>
        </div>
        <div class="products-grid-page featured-same-grid">
            @forelse($products as $i => $product)
                @php
                    $imgPath = $product->images[0] ?? '';
                    $img = $imgPath
                        ? (\Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://', 'data:'])
                            ? $imgPath
                            : asset('storage/' . ltrim($imgPath, '/')))
                        : '';
                    $waText = rawurlencode("I am interested in {$product->name}");
                @endphp
                <article class="product-item-card premium-product-card product-clickable" data-url="{{ route('products.show', $product->slug) }}">
                    <a class="product-image-wrap" href="{{ route('products.show', $product->slug) }}">
                        <img loading="lazy" src="{{ $img }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 900 520%22><defs><linearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22><stop offset=%220%25%22 stop-color=%22%23e8eef8%22/><stop offset=%22100%25%22 stop-color=%22%23d9e5f6%22/></linearGradient></defs><rect width=%22900%22 height=%22520%22 fill=%22url(%23g)%22/><rect x=%22335%22 y=%22195%22 width=%22230%22 height=%22130%22 rx=%2218%22 fill=%22%23ffffff%22 stroke=%22%23b7cceb%22/><rect x=%22365%22 y=%22238%22 width=%22170%22 height=%2224%22 rx=%2212%22 fill=%22%238ec3f5%22/><circle cx=%22520%22 cy=%22222%22 r=%2212%22 fill=%22%233c7cc0%22/></svg>';">
                        <span class="card-top-tag">{{ $i === 0 ? 'Best Seller' : ($i === 1 ? 'Value King' : 'Premium Pick') }}</span>
                    </a>
                    <div class="product-card-body">
                        <div class="product-top-meta premium-meta">
                            <span class="brand-chip">{{ $product->brand }}</span>
                            <h3 class="card-price-heading">₹{{ number_format($product->price, 0) }}</h3>
                        </div>
                        <h3><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit($product->description, 95) }}</p>
                        <div class="stock-chip">{{ $product->stock > 0 ? 'In Stock' : 'Pre-order Available' }}</div>
                        <div class="card-btn-row">
                            <a class="primary-btn" href="{{ route('contact', ['product' => $product->slug]) }}">Enquire Now</a>
                            <a class="outline-btn wa-icon-btn" target="_blank" rel="noopener" aria-label="WhatsApp" href="https://wa.me/918346904100?text={{ $waText }}">
                                <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="#25D366" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <article class="product-item-card"><div class="product-card-body"><h3>No products added yet</h3></div></article>
            @endforelse
        </div>
    </div>
</section>

<script>
(() => {
  document.querySelectorAll('.product-clickable').forEach((card) => {
    card.addEventListener('click', (e) => {
      if (e.target.closest('a,button,input,select,textarea,label,form')) return;
      const url = card.getAttribute('data-url');
      if (url) window.location.href = url;
    });
  });

})();
</script>

<section class="booking-band">
    <div class="container booking-shell">
        <div class="booking-grid">
            <div>
                <h2>Schedule Your Service in 60 Seconds</h2>
                <p>Don't let the heat get to you. Our technicians are ready to restore your comfort today.</p>
                <ul class="feature-list">
                    <li>
                        <span class="fi" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M12 3 5 7v5c0 4.2 2.9 8 7 9 4.1-1 7-4.8 7-9V7l-7-4Z" stroke="currentColor" stroke-width="1.8"/><path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </span>
                        Certified Techs
                    </li>
                    <li>
                        <span class="fi" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M20 12a8 8 0 1 1-3-6.3" stroke="currentColor" stroke-width="1.8"/><path d="M12 8v4l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </span>
                        Fast Response
                    </li>
                    <li>
                        <span class="fi" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M4 8h16v10H4z" stroke="currentColor" stroke-width="1.8"/><path d="M9 8V6h6v2M4 13h16" stroke="currentColor" stroke-width="1.8"/></svg>
                        </span>
                        Genuine Spares
                    </li>
                    <li>
                        <span class="fi" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M12 4v16M8 8h6.5a2.5 2.5 0 1 1 0 5H10a2.5 2.5 0 1 0 0 5h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </span>
                        Fixed Pricing
                    </li>
                </ul>
            </div>
            <div class="booking-form-wrap">
                @include('site.partials.enquiry-form')
            </div>
        </div>
    </div>
</section>

<section class="section trust-block">
    <div class="container">
        <h2>Trusted by Kolkata's Finest</h2>
        <div class="icon-row" aria-label="Client segments">
            <span title="Office">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 21h18M5 21V5a1 1 0 0 1 1-1h5v17M11 21V9a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v12M8 8h.01M8 11h.01M8 14h.01M14 11h.01M14 14h.01M17 11h.01M17 14h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </span>
            <span title="Retail">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 10h18M5 10V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3M6 10h12v10H6V10Zm4 4h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <span title="Hospital">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 21h16M6 21V6a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v15M12 9v6M9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </span>
            <span title="Campus">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m2 10 10-5 10 5-10 5-10-5Zm4 2.5V16c0 .6 2.7 3 6 3s6-2.4 6-3v-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
        </div>
        <div class="test-grid">
            @forelse($testimonials as $t)
                <article class="test-card">
                    <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                    <p>{{ $t->message }}</p>
                    <strong>&mdash; {{ $t->name }}</strong>
                </article>
            @empty
                <article class="test-card"><p>No testimonials yet.</p></article>
            @endforelse
        </div>
    </div>
</section>

<style>
.hero-img-hidden {
    opacity: 0;
    transform: translateY(48px);
    transition: none;
}
.hero-img-reveal {
    animation: heroImgSlideUp .85s cubic-bezier(.22,.68,0,1.2) forwards;
}
@keyframes heroImgSlideUp {
    0%   { opacity: 0; transform: translateY(48px); }
    60%  { opacity: 1; }
    100% { opacity: 1; transform: translateY(0); }
}
</style>

<script>
(function () {
    var img = document.getElementById('heroImg');
    if (!img) return;

    function reveal() {
        img.classList.remove('hero-img-hidden');
        img.classList.add('hero-img-reveal');
    }

    if (img.complete && img.naturalWidth > 0) {
        // Already cached — small delay so user sees the animation
        setTimeout(reveal, 120);
    } else {
        img.addEventListener('load', function () { setTimeout(reveal, 80); }, { once: true });
        img.addEventListener('error', function () { reveal(); }, { once: true });
    }
})();
</script>
@endsection
