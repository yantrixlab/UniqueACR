@extends('site.layouts.app')
@section('title', 'AC Repair Kolkata | Best AC Service, Installation & Maintenance – Cooling Kolkata')
@section('meta_description', 'Looking for AC repair in Kolkata? Cooling Kolkata offers same-day AC servicing, installation, gas charging & AMC for Voltas, LG, Daikin & all brands. Trusted AC repair service near me in Kolkata. Call +91 8346904100.')
@section('meta_keywords', 'AC repair Kolkata, ac repair kolkata near me, voltas ac repair Kolkata, lg ac repair Kolkata, best ac repair Kolkata, AC service Kolkata, AC servicing Kolkata, AC installation Kolkata, AC maintenance Kolkata, AC repair service near me, AC servicing near me, ac servicing price, ac servicing near me contact number, lg ac repair, ac repair in Kolkata, ac repair shop near me')
@section('og_title', 'AC Repair Kolkata | Best AC Service, Installation & Maintenance – Cooling Kolkata')
@section('og_description', 'Same-day AC repair & servicing in Kolkata for Voltas, LG, Daikin & all brands. Certified technicians, genuine parts, transparent pricing. Book now!')
@section('schema')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "How much does AC repair cost in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "AC repair cost in Kolkata typically ranges from ₹300 to ₹2,500 depending on the issue — gas charging, PCB repair, compressor service, etc. Cooling Kolkata provides transparent, no-hidden-cost estimates before starting any work."
            }
        },
        {
            "@type": "Question",
            "name": "Do you provide same-day AC repair service in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. Cooling Kolkata offers same-day AC repair and servicing across Kolkata including Jadavpur, Tollygunge, Behala, Salt Lake and surrounding areas. Call +91 8346904100 for quick response."
            }
        },
        {
            "@type": "Question",
            "name": "Which AC brands do you repair in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We repair all major AC brands including Voltas, LG, Daikin, Samsung, Blue Star, Hitachi, Lloyd, Carrier, Whirlpool and more. Our certified technicians are trained for both split and window AC units."
            }
        },
        {
            "@type": "Question",
            "name": "What is included in AC servicing near me?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Our AC servicing includes deep cleaning of indoor and outdoor units, filter cleaning, coil cleaning, drain cleaning, gas pressure check, and performance testing — all at a fixed transparent price."
            }
        }
    ]
}
</script>
@endverbatim
@endsection
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
                <h1>Our Services</h1>
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

@if($areas->isNotEmpty())
@php
$homeZoneColors = [
    'South Kolkata & Jadavpur Zone'   => '#60a5fa',
    'South-East & EM Bypass Zone'     => '#34d399',
    'Central-South & Tollygunge Zone' => '#c084fc',
    'Science City & Bhawanipore Zone' => '#fb923c',
];
@endphp

{{-- ═══════════════════════════════════════════════════════════════
     BOOKING SECTION
═══════════════════════════════════════════════════════════════ --}}
<section style="background:linear-gradient(135deg,#041d4a 0%,#083580 50%,#0a4199 100%);padding:5rem 0;position:relative;overflow:hidden;">
    {{-- Decorative blobs --}}
    <div style="position:absolute;top:-120px;right:-120px;width:480px;height:480px;border-radius:50%;background:radial-gradient(circle,rgba(96,165,250,.12) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-80px;left:-80px;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,rgba(96,165,250,.08) 0%,transparent 70%);pointer-events:none;"></div>
    {{-- Subtle grid pattern --}}
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:40px 40px;pointer-events:none;"></div>

    <div class="container" style="position:relative;">
        <div class="hb-grid">
            {{-- LEFT: Copy + Trust badges --}}
            <div class="hb-left">
                <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(96,165,250,.18);border:1px solid rgba(96,165,250,.3);color:#93c5fd;font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.35rem 1rem;border-radius:999px;margin-bottom:1.5rem;">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11.6 19.79 19.79 0 0 1 1.61 3 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.97-.97a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.5 16l.42.92Z"/></svg>
                    Book a Service — +91 83469 04100
                </div>
                <h2 style="color:#fff;font-size:clamp(1.8rem,3.5vw,2.6rem);font-weight:800;line-height:1.2;margin:0 0 1rem;letter-spacing:-.02em;">
                    Schedule Your Service<br>
                    <span style="background:linear-gradient(90deg,#60a5fa,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">in 60 Seconds</span>
                </h2>
                <p style="color:rgba(255,255,255,.65);font-size:1rem;line-height:1.7;margin:0 0 2rem;max-width:420px;">Don't let the heat get to you. Our certified technicians are ready to restore your comfort — same-day service available across South &amp; Central Kolkata.</p>

                {{-- Trust badges --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                    @foreach([
                        ['svg'=>'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 3 5 7v5c0 4.2 2.9 8 7 9 4.1-1 7-4.8 7-9V7l-7-4Z"/><path d="m9 12 2 2 4-4"/></svg>','title'=>'Certified Techs','sub'=>'Trained & background-verified'],
                        ['svg'=>'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>','title'=>'Same-Day Service','sub'=>'Response within 2–4 hours'],
                        ['svg'=>'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-4 0v2M12 12v4M10 14h4"/></svg>','title'=>'Genuine Spare Parts','sub'=>'OEM & branded components'],
                        ['svg'=>'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg>','title'=>'Transparent Pricing','sub'=>'No hidden charges, ever'],
                    ] as $tb)
                    <div style="display:flex;align-items:flex-start;gap:.75rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:1rem;">
                        <div style="width:36px;height:36px;border-radius:9px;background:rgba(96,165,250,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#93c5fd;">
                            <span style="width:18px;height:18px;display:block;">{!! $tb['svg'] !!}</span>
                        </div>
                        <div>
                            <div style="color:#fff;font-size:.82rem;font-weight:700;line-height:1.3;">{{ $tb['title'] }}</div>
                            <div style="color:rgba(255,255,255,.45);font-size:.72rem;margin-top:.15rem;line-height:1.4;">{{ $tb['sub'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: Form card --}}
            <div class="hb-right">
                <div style="background:rgba(255,255,255,.06);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.14);border-radius:20px;padding:2rem;box-shadow:0 32px 64px rgba(0,0,0,.35);">
                    <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:1.5rem;padding-bottom:1.25rem;border-bottom:1px solid rgba(255,255,255,.1);">
                        <div style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#3b82f6,#6366f1);display:flex;align-items:center;justify-content:center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <div style="color:#fff;font-weight:700;font-size:.95rem;line-height:1.2;">Book a Service Visit</div>
                            <div style="color:rgba(255,255,255,.5);font-size:.75rem;">We'll confirm within 30 minutes</div>
                        </div>
                        <div style="margin-left:auto;display:flex;align-items:center;gap:.3rem;background:rgba(52,211,153,.15);border:1px solid rgba(52,211,153,.3);color:#6ee7b7;font-size:.68rem;font-weight:700;padding:.25rem .6rem;border-radius:999px;">
                            <span style="width:5px;height:5px;border-radius:50%;background:#34d399;display:block;animation:blink 1.4s infinite;"></span>
                            Available Now
                        </div>
                    </div>
                    @include('site.partials.enquiry-form')
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     AREAS SECTION
═══════════════════════════════════════════════════════════════ --}}
<section style="background:linear-gradient(180deg,#051c48 0%,#07266a 100%);padding:4rem 0;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.025) 1px,transparent 1px);background-size:28px 28px;pointer-events:none;"></div>

    <div class="container" style="position:relative;">
        {{-- Section header --}}
        <div style="display:flex;flex-wrap:wrap;gap:1rem;align-items:center;justify-content:space-between;margin-bottom:2rem;">
            <div>
                <div style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.7);font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.3rem .85rem;border-radius:999px;margin-bottom:.8rem;">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $areas->count() }} Localities Covered
                </div>
                <h2 style="color:#fff;font-size:clamp(1.4rem,2.8vw,2rem);font-weight:800;margin:0 0 .4rem;letter-spacing:-.01em;">We Serve These Areas</h2>
                <p style="color:rgba(255,255,255,.5);font-size:.88rem;margin:0;">South &amp; Central Kolkata · Onsite AC repair, installation &amp; maintenance</p>
            </div>
            <a href="{{ route('areas.index') }}" style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.18);color:#fff;font-size:.82rem;font-weight:600;padding:.65rem 1.3rem;border-radius:10px;text-decoration:none;white-space:nowrap;transition:all .15s;"
               onmouseover="this.style.background='rgba(255,255,255,.15)'"
               onmouseout="this.style.background='rgba(255,255,255,.08)'">
                View All Service Areas
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        {{-- Area cards grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:.7rem;">
            @foreach($areas as $area)
            @php $dotColor = $homeZoneColors[$area->zone] ?? '#60a5fa'; @endphp
            <a href="{{ route('areas.show', $area->slug) }}"
               style="display:flex;align-items:center;gap:.8rem;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:12px;padding:.9rem 1rem;text-decoration:none;transition:all .18s ease;position:relative;overflow:hidden;"
               onmouseover="this.style.background='rgba(255,255,255,.1)';this.style.borderColor='rgba(255,255,255,.2)';this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.3)'"
               onmouseout="this.style.background='rgba(255,255,255,.05)';this.style.borderColor='rgba(255,255,255,.09)';this.style.transform='none';this.style.boxShadow='none'">
                <div style="width:34px;height:34px;border-radius:8px;background:{{ $dotColor }}18;border:1px solid {{ $dotColor }}44;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="width:8px;height:8px;border-radius:50%;background:{{ $dotColor }};box-shadow:0 0 8px {{ $dotColor }};display:block;"></span>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="color:#fff;font-size:.85rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.3;">{{ $area->name }}</div>
                    <div style="color:rgba(255,255,255,.4);font-size:.72rem;margin-top:.2rem;">PIN {{ $area->pinCodesDisplay() }}</div>
                </div>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="{{ $dotColor }}88" stroke-width="2.5" stroke-linecap="round" style="flex-shrink:0;"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            @endforeach
        </div>

        {{-- Zone legend --}}
        <div style="display:flex;flex-wrap:wrap;gap:.6rem 2rem;margin-top:2rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.08);">
            @foreach($areas->groupBy('zone') as $zoneName => $zoneAreas)
            @php $c = $homeZoneColors[$zoneName] ?? '#60a5fa'; @endphp
            <div style="display:inline-flex;align-items:center;gap:.5rem;">
                <span style="width:9px;height:9px;border-radius:50%;background:{{ $c }};box-shadow:0 0 6px {{ $c }}88;flex-shrink:0;"></span>
                <span style="color:rgba(255,255,255,.55);font-size:.78rem;">{{ $zoneName }}</span>
                <span style="background:{{ $c }}22;border:1px solid {{ $c }}44;color:{{ $c }};font-size:.68rem;font-weight:700;padding:.1rem .45rem;border-radius:999px;">{{ $zoneAreas->count() }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.hb-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
@media(max-width:900px) {
    .hb-grid { grid-template-columns: 1fr; gap: 2.5rem; }
    .hb-left h2 { font-size: 1.8rem; }
}
</style>
@endif

@if($testimonials->isNotEmpty())
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
            @foreach($testimonials as $t)
                <article class="test-card">
                    <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                    <p>{{ $t->message }}</p>
                    <strong>&mdash; {{ $t->name }}</strong>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── SEO Content Block ────────────────────────────────────────────── --}}
<section class="section seo-content-section" aria-label="About our AC repair services in Kolkata">
    <div class="container seo-content-wrap">

        <h2>AC Repair & Servicing in Kolkata – Your Trusted Cooling Partner</h2>
        <p>When the summer heat in Kolkata becomes unbearable, the last thing you need is a malfunctioning air conditioner. <strong>Cooling Kolkata</strong> is Kolkata's most trusted name for <strong>AC repair in Kolkata</strong>, offering fast, affordable, and professional services for homes, offices, shops, and commercial spaces across the city.</p>

        <h3>Expert AC Repair Service Near Me – Same Day Response</h3>
        <p>Whether your AC is not cooling, making unusual noise, leaking water, or showing error codes, our certified technicians are just a call away. We provide <strong>same-day AC repair service near me</strong> across all major areas of Kolkata including Jadavpur, Tollygunge, Behala, Salt Lake, New Town, Park Street, Ballygunge, Garia, and surrounding localities. Our response time is under 2 hours for most emergency calls, so your comfort is restored quickly without any prolonged inconvenience.</p>

        <h3>AC Servicing in Kolkata – Deep Cleaning for Peak Performance</h3>
        <p>Regular <strong>AC servicing in Kolkata</strong> is essential to maintain energy efficiency and extend the lifespan of your air conditioner. Our comprehensive AC servicing package includes thorough cleaning of indoor and outdoor units, filter washing, evaporator and condenser coil cleaning, drain pan cleaning, refrigerant gas pressure check, and full performance testing. Timely <strong>AC servicing near me</strong> not only reduces your electricity bills but also prevents costly breakdowns during peak summer months.</p>

        <h3>Voltas AC Repair Kolkata &amp; LG AC Repair Kolkata</h3>
        <p>We specialize in all leading brands. For <strong>Voltas AC repair in Kolkata</strong>, our technicians are trained to handle Voltas split ACs, window ACs, and cassette units — covering issues like compressor faults, PCB failures, gas leaks, and sensor errors. Similarly, our <strong>LG AC repair in Kolkata</strong> expertise covers the full LG range including Dual Inverter models. We also service and repair Daikin, Samsung, Blue Star, Hitachi, Lloyd, Carrier, Whirlpool, and all other major brands with genuine spare parts and manufacturer-recommended procedures.</p>

        <h3>AC Installation Kolkata – Professional Fitting, Zero Hassle</h3>
        <p>Planning to buy a new air conditioner? Our <strong>AC installation in Kolkata</strong> service ensures your new unit is fitted correctly, safely, and in compliance with all technical standards. Improper installation is one of the leading causes of poor AC performance and early breakdowns. Our installation team handles copper piping, indoor/outdoor unit mounting, electrical connections, and post-installation testing — all in one visit. We install split ACs, window ACs, cassette ACs, and multi-split systems for residential and commercial properties.</p>

        <h3>AC Maintenance Kolkata – AMC Plans for Worry-Free Cooling</h3>
        <p>Our <strong>AC maintenance in Kolkata</strong> Annual Maintenance Contract (AMC) plans are designed for homeowners and businesses who want hassle-free, year-round cooling performance. The AMC covers scheduled servicing visits, priority breakdown support, free labour on repairs, and discounted spare parts. An AMC is the smartest investment you can make to protect your AC and avoid surprise repair bills during peak season.</p>

        <h3>Why Kolkata Trusts Cooling Kolkata for AC Repair &amp; Servicing</h3>
        <ul class="seo-list">
            <li><strong>7+ Years of Experience</strong> serving residential and commercial clients across Kolkata</li>
            <li><strong>Certified Technicians</strong> trained for all major AC brands and models</li>
            <li><strong>Transparent Pricing</strong> – no hidden charges, free inspection before work begins</li>
            <li><strong>Genuine Spare Parts</strong> sourced from authorized distributors</li>
            <li><strong>Same-Day Service</strong> available 6 days a week across Kolkata</li>
            <li><strong>Post-Service Warranty</strong> on all repairs and installations</li>
            <li><strong>Easy Booking</strong> – call, WhatsApp, or fill our online form anytime</li>
        </ul>

        <p>Whether you need an emergency <strong>AC repair shop near me</strong>, a scheduled <strong>AC servicing near me</strong>, a fresh <strong>AC installation in Kolkata</strong>, or a long-term <strong>AC maintenance</strong> partner, Cooling Kolkata is the one-stop solution. <a href="{{ route('contact') }}" class="seo-inline-link">Book your service today</a> and experience the difference that certified expertise makes. For immediate assistance, call us at <a href="tel:+918346904100" class="seo-inline-link">+91 8346904100</a> or reach us on WhatsApp — we are always ready to keep you cool.</p>

    </div>
</section>

<style>
.seo-content-section { background: #fff; padding: 3.5rem 0 2.5rem; border-top: 1px solid #e8eef8; }
.seo-content-wrap { max-width: 860px; }
.seo-content-wrap h2 { font-size: 1.6rem; color: #0a2240; margin-bottom: 1rem; font-weight: 800; }
.seo-content-wrap h3 { font-size: 1.1rem; color: #0a3a89; margin: 1.6rem 0 .5rem; font-weight: 700; }
.seo-content-wrap p  { font-size: .95rem; color: #3d5175; line-height: 1.8; margin-bottom: .8rem; }
.seo-list { padding-left: 1.2rem; margin: .5rem 0 1rem; }
.seo-list li { font-size: .95rem; color: #3d5175; line-height: 1.8; margin-bottom: .3rem; }
.seo-inline-link { color: #2563eb; text-decoration: underline; font-weight: 600; }
.seo-inline-link:hover { color: #0ea5e9; }
</style>

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

