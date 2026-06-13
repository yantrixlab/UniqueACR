@extends('site.layouts.app')
@section('title','AC Service Kolkata | AC Repair, Installation & Maintenance – Cooling Kolkata')
@section('meta_description','Explore all AC services in Kolkata – AC repair, AC servicing, gas charging, installation & AMC for Voltas, LG, Daikin & all brands. Certified technicians. Call +91 8346904100.')
@section('meta_keywords','AC service Kolkata, AC servicing Kolkata, AC repair service near me, AC servicing near me, AC installation Kolkata, AC maintenance Kolkata, voltas ac service, lg ac service Kolkata')
@section('og_title','AC Service Kolkata | AC Repair, Installation & Maintenance – Cooling Kolkata')
@section('og_description','All AC services in Kolkata under one roof – repair, servicing, gas charging, installation & AMC. Same-day slots available. Call +91 8346904100.')
@section('schema')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Do you provide same day AC repair in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, Cooling Kolkata provides same-day AC repair in Kolkata based on technician slot availability in your area. Call +91 8346904100 to book an immediate slot."
            }
        },
        {
            "@type": "Question",
            "name": "Which AC brands do you repair and service?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We service and repair all major AC brands including Daikin, Voltas, LG, OGeneral, Samsung, Blue Star, Hitachi, Lloyd, Carrier, and Whirlpool — both inverter and non-inverter models."
            }
        },
        {
            "@type": "Question",
            "name": "Do you provide commercial HVAC support in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, we handle all types of commercial HVAC systems including VRV/VRF, ductable, cassette, chiller, and packaged systems for offices, factories, hospitals, and retail spaces in Kolkata."
            }
        },
        {
            "@type": "Question",
            "name": "Do you offer AC AMC packages in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, we offer Basic, Standard, and Premium Annual Maintenance Contract (AMC) plans for homes and businesses in Kolkata. AMC includes scheduled servicing, priority breakdown support, and discounted spare parts."
            }
        },
        {
            "@type": "Question",
            "name": "Which areas in Kolkata do you cover for AC service?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We cover all major areas across Kolkata including Jadavpur, Tollygunge, Garia, Behala, Salt Lake, New Town, Kasba, Ballygunge, Dhakuria, Park Street, and surrounding localities."
            }
        }
    ]
}
</script>
@endverbatim
@endsection
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
    // $featuredServices is passed from controller (is_featured=true, with fallback)
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
        <div class="section-head" style="margin-bottom:20px;">
            <div>
                <h2>Featured Services</h2>
                <p class="sub">High-demand AC and HVAC services with transparent pricing and expert support.</p>
            </div>
        </div>

        @if($featuredServices->isNotEmpty())
        <div class="svc-slider-wrap" id="svcFeaturedSlider" aria-label="Featured services">
            <div class="svc-slider-track">
            @foreach($featuredServices as $fi => $service)
            @php
                $waText   = rawurlencode('I need service for ' . $service->name);
                $image    = $getServiceImage($service);
                $priceText = (float) $service->price > 0 ? '₹' . number_format((float) $service->price, 0) : 'Custom';
                $typeLabel = $service->service_type ? \Illuminate\Support\Str::title($service->service_type) : 'Service';
            @endphp
            <div class="svc-slide {{ $fi === 0 ? 'active' : '' }}" data-index="{{ $fi }}" aria-hidden="{{ $fi === 0 ? 'false' : 'true' }}">
                @if($image)
                    <img src="{{ $image }}" alt="{{ $service->name }}" class="svc-slide-bg" loading="{{ $fi === 0 ? 'eager' : 'lazy' }}" onerror="this.style.display='none'">
                @endif
                <div class="svc-slide-scrim"></div>

                <div class="svc-slide-ribbon">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Featured
                </div>

                <div class="svc-slide-content">
                    <div class="svc-slide-left">
                        <div class="svc-slide-meta-row">
                            <span class="svc-slide-type">{{ $typeLabel }}</span>
                            <span class="svc-slide-avail {{ $service->is_active ? 'avail' : 'req' }}">
                                {{ $service->is_active ? '● Available Today' : '○ On Request' }}
                            </span>
                        </div>
                        <h2 class="svc-slide-name">
                            <a href="{{ route('services.show', $service->slug) }}" tabindex="{{ $fi === 0 ? '0' : '-1' }}">{{ $service->name }}</a>
                        </h2>
                        <p class="svc-slide-desc">{{ \Illuminate\Support\Str::limit(strip_tags($service->description ?? ''), 90) }}</p>
                        <div class="svc-slide-btns">
                            <a class="svc-btn-book" href="{{ route('services.show', $service->slug) }}" tabindex="{{ $fi === 0 ? '0' : '-1' }}">Book Service</a>
                            <a class="svc-btn-wa" href="https://wa.me/918346904100?text={{ $waText }}" target="_blank" rel="noopener" tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                                <svg viewBox="0 0 32 32" width="17" height="17" aria-hidden="true"><path fill="#fff" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#25D366" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8l.5-.6c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.4c-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4-.1-.1-.4-.2-.7-.4Z"/></svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                    <div class="svc-slide-right">
                        <div class="svc-slide-price">{{ $priceText }}</div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>

            @if($featuredServices->count() > 1)
            <button class="svc-arrow svc-prev" id="svcPrev" aria-label="Previous">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <button class="svc-arrow svc-next" id="svcNext" aria-label="Next">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
            <div class="svc-dots" id="svcDots">
                @foreach($featuredServices as $fi => $s)
                <button class="svc-dot {{ $fi === 0 ? 'active' : '' }}" data-goto="{{ $fi }}" aria-label="Slide {{ $fi+1 }}"></button>
                @endforeach
            </div>
            @endif

            <div class="svc-progress"><div class="svc-progress-fill" id="svcProgressFill"></div></div>
        </div>

        <style>
        .svc-slider-wrap{position:relative;border-radius:16px;overflow:hidden;box-shadow:0 8px 40px rgba(0,0,0,.22);background:#111;height:420px;margin-bottom:0;}
        .svc-slider-track{position:absolute;inset:0;}
        .svc-slide{position:absolute;inset:0;opacity:0;transition:opacity .7s cubic-bezier(.4,0,.2,1);pointer-events:none;z-index:1;}
        .svc-slide.active{opacity:1;pointer-events:auto;z-index:2;}
        .svc-slide-bg{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;transform:scale(1);transition:transform 7s ease;will-change:transform;}
        .svc-slide.active .svc-slide-bg{transform:scale(1.06);}
        .svc-slide-scrim{position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,.08) 0%,rgba(0,0,0,.18) 35%,rgba(0,0,0,.72) 75%,rgba(0,0,0,.88) 100%);}
        .svc-slide-ribbon{position:absolute;top:20px;left:22px;z-index:5;background:linear-gradient(135deg,#f59e0b,#f97316);color:#fff;font-size:.68rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;padding:5px 13px;border-radius:30px;display:inline-flex;align-items:center;gap:5px;box-shadow:0 3px 14px rgba(249,115,22,.4);}
        .svc-slide-content{position:absolute;bottom:0;left:0;right:0;z-index:5;display:flex;align-items:flex-end;justify-content:space-between;gap:20px;padding:28px 30px 30px;}
        .svc-slide-left{flex:1;min-width:0;}
        .svc-slide-meta-row{display:flex;align-items:center;gap:10px;margin-bottom:6px;}
        .svc-slide-type{background:rgba(255,255,255,.15);backdrop-filter:blur(6px);color:#fff;font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:3px 11px;border-radius:4px;border:1px solid rgba(255,255,255,.2);}
        .svc-slide-avail{font-size:.72rem;font-weight:600;}
        .svc-slide-avail.avail{color:#4ade80;}
        .svc-slide-avail.req{color:#fbbf24;}
        .svc-slide-name{font-size:1.55rem;font-weight:800;color:#fff;line-height:1.2;margin:0 0 5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-shadow:0 2px 8px rgba(0,0,0,.5);}
        .svc-slide-name a{color:inherit;text-decoration:none;}
        .svc-slide-name a:hover{text-decoration:underline;text-underline-offset:3px;}
        .svc-slide-desc{font-size:.85rem;color:rgba(255,255,255,.78);margin:0 0 14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-shadow:0 1px 4px rgba(0,0,0,.5);}
        .svc-slide-btns{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
        .svc-btn-book{background:#111;color:#fff;text-decoration:none;display:inline-block;padding:10px 22px;border-radius:8px;font-size:.875rem;font-weight:700;transition:background .2s,transform .15s;letter-spacing:.01em;}
        .svc-btn-book:hover{background:#222;transform:translateY(-1px);}
        .svc-btn-wa{display:inline-flex;align-items:center;gap:7px;background:rgba(37,211,102,.12);color:#fff;text-decoration:none;padding:10px 18px;border-radius:8px;font-size:.875rem;font-weight:700;border:1.5px solid rgba(37,211,102,.55);transition:background .2s,transform .15s;backdrop-filter:blur(4px);}
        .svc-btn-wa:hover{background:rgba(37,211,102,.25);transform:translateY(-1px);}
        .svc-slide-right{flex-shrink:0;text-align:right;}
        .svc-slide-price{font-size:2.1rem;font-weight:900;color:#fff;letter-spacing:-.03em;line-height:1;text-shadow:0 2px 10px rgba(0,0,0,.5);margin-bottom:34px;}
        .svc-arrow{position:absolute;top:50%;transform:translateY(-50%);width:42px;height:42px;border-radius:50%;border:1.5px solid rgba(255,255,255,.3);background:rgba(0,0,0,.35);backdrop-filter:blur(8px);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,border-color .2s,transform .2s;z-index:10;}
        .svc-arrow:hover{background:rgba(0,0,0,.6);border-color:rgba(255,255,255,.7);transform:translateY(-50%) scale(1.08);}
        .svc-prev{left:14px;}.svc-next{right:14px;}
        .svc-dots{position:absolute;bottom:22px;right:24px;display:flex;gap:7px;z-index:10;}
        .svc-dot{width:8px;height:8px;border-radius:50%;border:1.5px solid rgba(255,255,255,.6);background:transparent;cursor:pointer;padding:0;transition:background .3s,width .3s,border-radius .3s,border-color .3s;}
        .svc-dot.active{background:#fff;border-color:#fff;width:24px;border-radius:4px;}
        .svc-progress{position:absolute;bottom:0;left:0;right:0;height:3px;background:rgba(255,255,255,.12);z-index:10;}
        .svc-progress-fill{height:100%;width:0;background:rgba(255,255,255,.7);transition:width linear;}
        @media(max-width:640px){
            .svc-slider-wrap{height:360px;border-radius:12px;}
            .svc-slide-content{padding:18px 16px 22px;gap:10px;}
            .svc-slide-name{font-size:1.1rem;}
            .svc-slide-desc{display:none;}
            .svc-slide-price{font-size:1.45rem;margin-bottom:28px;}
            .svc-prev{left:8px;}.svc-next{right:8px;}
            .svc-dots{right:50%;transform:translateX(50%);}
            .svc-btn-book,.svc-btn-wa{padding:9px 14px;font-size:.8rem;}
        }
        </style>

        <script>
        (() => {
          const slides = document.querySelectorAll('#svcFeaturedSlider .svc-slide');
          const dots   = document.querySelectorAll('#svcFeaturedSlider .svc-dot');
          const fill   = document.getElementById('svcProgressFill');
          const DURATION = 5000;
          if (!slides.length) return;
          let current = 0, timer = null, paused = false;

          function goTo(next) {
            if (next === current) return;
            slides[current].classList.remove('active');
            slides[current].setAttribute('aria-hidden', 'true');
            slides[current].querySelectorAll('[tabindex]').forEach(el => el.setAttribute('tabindex', '-1'));
            if (dots.length) { dots[current].classList.remove('active'); dots[next].classList.add('active'); }
            current = next;
            slides[current].classList.add('active');
            slides[current].setAttribute('aria-hidden', 'false');
            slides[current].querySelectorAll('[tabindex]').forEach(el => el.setAttribute('tabindex', '0'));
            resetProgress();
          }

          function nextSlide() { goTo((current + 1) % slides.length); }
          function prevSlide() { goTo((current - 1 + slides.length) % slides.length); }

          function resetProgress() {
            if (!fill) return;
            fill.style.transition = 'none';
            fill.style.width = '0%';
            requestAnimationFrame(() => requestAnimationFrame(() => {
              fill.style.transition = `width ${DURATION}ms linear`;
              fill.style.width = '100%';
            }));
          }

          function startAuto() {
            clearInterval(timer);
            timer = setInterval(() => { if (!paused) nextSlide(); }, DURATION);
            resetProgress();
          }

          if (slides.length > 1) {
            document.getElementById('svcNext')?.addEventListener('click', () => { nextSlide(); startAuto(); });
            document.getElementById('svcPrev')?.addEventListener('click', () => { prevSlide(); startAuto(); });
            dots.forEach(d => d.addEventListener('click', () => { goTo(+d.dataset.goto); startAuto(); }));
            const wrap = document.getElementById('svcFeaturedSlider');
            wrap?.addEventListener('mouseenter', () => { paused = true; });
            wrap?.addEventListener('mouseleave', () => { paused = false; });
            startAuto();
          }
        })();
        </script>
        @endif
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
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 96) }}</p>
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

<section class="section zz-process-section">
    <div class="container">
        <div class="zz-head">
            <h2>Our Service Process</h2>
            <p>Simple, transparent, and fast — from booking to completion.</p>
        </div>
        <div class="zz-timeline">
            {{-- Vertical dashed line --}}
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
                <div class="zz-dot">
                    <span></span>
                </div>
                <div class="zz-empty"></div>
            </div>
            @endforeach
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

<section style="padding:3.5rem 0;background:linear-gradient(160deg,#06205a 0%,#0f458f 100%);position:relative;overflow:hidden;">
    {{-- Background decoration --}}
    <div style="position:absolute;right:-80px;top:-80px;width:340px;height:340px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none;"></div>
    <div style="position:absolute;left:-60px;bottom:-60px;width:260px;height:260px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none;"></div>

    <div class="container" style="position:relative;">
        {{-- Header --}}
        <div style="display:flex;flex-wrap:wrap;gap:1.5rem;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;">
            <div>
                <span style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.12);color:rgba(255,255,255,.9);font-size:.75rem;font-weight:600;letter-spacing:.07em;text-transform:uppercase;padding:.3rem .85rem;border-radius:999px;margin-bottom:.85rem;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $areas->count() }}+ Localities Covered
                </span>
                <h2 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0;line-height:1.25;">Areas We Serve in South &amp; Central Kolkata</h2>
                <p style="color:rgba(255,255,255,.7);margin:.6rem 0 0;font-size:.95rem;">Onsite AC repair, installation &amp; maintenance. Same-day service available.</p>
            </div>
            <a href="{{ route('areas.index') }}" style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.12);color:#fff;font-size:.85rem;font-weight:600;padding:.6rem 1.2rem;border-radius:9px;border:1px solid rgba(255,255,255,.2);white-space:nowrap;flex-shrink:0;">
                View All Areas
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        {{-- Area Cards Grid --}}
        @php
        $zoneColors = [
            'South Kolkata & Jadavpur Zone'   => '#60a5fa',
            'South-East & EM Bypass Zone'     => '#34d399',
            'Central-South & Tollygunge Zone' => '#c084fc',
            'Science City & Bhawanipore Zone' => '#fb923c',
        ];
        @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.75rem;">
            @foreach($areas as $area)
            @php $dotColor = $zoneColors[$area->zone] ?? '#60a5fa'; @endphp
            <a href="{{ route('areas.show', $area->slug) }}"
               style="display:flex;align-items:center;gap:.75rem;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:11px;padding:.85rem 1rem;text-decoration:none;transition:all .16s ease;"
               onmouseover="this.style.background='rgba(255,255,255,.14)';this.style.borderColor='rgba(255,255,255,.25)';this.style.transform='translateY(-2px)'"
               onmouseout="this.style.background='rgba(255,255,255,.07)';this.style.borderColor='rgba(255,255,255,.1)';this.style.transform='translateY(0)'">
                <span style="width:8px;height:8px;border-radius:50%;background:{{ $dotColor }};flex-shrink:0;box-shadow:0 0 6px {{ $dotColor }}88;"></span>
                <div style="flex:1;min-width:0;">
                    <div style="color:#fff;font-size:.88rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $area->name }}</div>
                    <div style="color:rgba(255,255,255,.5);font-size:.75rem;margin-top:.15rem;">{{ $area->pinCodesDisplay() }}</div>
                </div>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.4)" stroke-width="2.5" stroke-linecap="round" style="flex-shrink:0;"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            @endforeach
        </div>

        {{-- Zone Legend --}}
        <div style="display:flex;flex-wrap:wrap;gap:.75rem 1.5rem;margin-top:1.75rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.1);">
            @foreach($areas->groupBy('zone') as $zoneName => $zoneAreas)
            @php $c = $zoneColors[$zoneName] ?? '#60a5fa'; @endphp
            <span style="display:inline-flex;align-items:center;gap:.4rem;font-size:.78rem;color:rgba(255,255,255,.6);">
                <span style="width:8px;height:8px;border-radius:50%;background:{{ $c }};flex-shrink:0;"></span>
                {{ $zoneName }} <span style="color:{{ $c }};font-weight:600;">({{ $zoneAreas->count() }})</span>
            </span>
            @endforeach
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
        'name' => 'Cooling Kolkata',
        'telephone' => '+918346904100',
        'areaServed' => ['Kolkata','Jadavpur','South Kolkata','North Kolkata'],
    ],
]) !!}
</script>
@endsection

