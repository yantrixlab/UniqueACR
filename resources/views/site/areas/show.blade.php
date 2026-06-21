@extends('site.layouts.app')
@section('title', $area->meta_title ?: 'AC Service in '.$area->name.' | Repair & Installation | Unique Aircon')
@section('meta_description', $area->meta_description ?: 'Expert AC repair, installation & servicing in '.$area->name.', Kolkata ('.$area->pinCodesDisplay().'). Same-day onsite visits. Call +91 8346904100.')
@section('meta_keywords', 'AC service '.$area->name.', AC repair '.$area->name.', air conditioner service '.$area->name.', AC repair Kolkata '.$area->pinCodesDisplay().', AC servicing near me '.$area->name)
@section('og_title', 'AC Service in '.$area->name.' | Unique Aircon')
@section('og_description', 'Same-day AC repair, installation & maintenance in '.$area->name.', Kolkata. Certified technicians, genuine parts. Call +91 8346904100.')
@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type'=>'BreadcrumbList','itemListElement'=>[
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],
            ['@type'=>'ListItem','position'=>2,'name'=>'Service Areas','item'=>route('areas.index')],
            ['@type'=>'ListItem','position'=>3,'name'=>$area->name,'item'=>route('areas.show',$area->slug)],
        ]],
        ['@type'=>['LocalBusiness','HVACBusiness'],'name'=>'Unique Aircon','url'=>url('/'),'telephone'=>'+918346904100','email'=>'uniquerac24@gmail.com','priceRange'=>'₹₹',
            'areaServed'=>[['@type'=>'Place','name'=>$area->name],['@type'=>'PostalAddress','postalCode'=>($area->pin_codes[0] ?? ''),'addressLocality'=>$area->name,'addressRegion'=>'West Bengal','addressCountry'=>'IN']],
            'address'=>['@type'=>'PostalAddress','streetAddress'=>'3/87 C. R Colony, Jadavpur','addressLocality'=>'Kolkata','addressRegion'=>'West Bengal','postalCode'=>'700032','addressCountry'=>'IN'],
            'geo'=>['@type'=>'GeoCoordinates','latitude'=>$area->latitude ?? 22.4987,'longitude'=>$area->longitude ?? 88.3714],
        ],
        ['@type'=>'Service','name'=>'AC Repair & Servicing in '.$area->name,'serviceType'=>'AC Repair, AC Installation, AC Maintenance','areaServed'=>['@type'=>'Place','name'=>$area->name.', Kolkata'],'provider'=>['@type'=>'LocalBusiness','name'=>'Unique Aircon','telephone'=>'+918346904100']],
        ['@type'=>'FAQPage','mainEntity'=>[
            ['@type'=>'Question','name'=>'Do you provide AC repair in '.$area->name.'?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Yes, Unique Aircon provides onsite AC repair in '.$area->name.' (PIN '.$area->pinCodesDisplay().'). Same-day dispatch. Call +91 8346904100.']],
            ['@type'=>'Question','name'=>'What AC brands do you service in '.$area->name.'?','acceptedAnswer'=>['@type'=>'Answer','text'=>'We service Voltas, LG, Daikin, Samsung, Blue Star, Hitachi, Lloyd, Carrier, OGeneral, and Whirlpool in '.$area->name.'.']],
            ['@type'=>'Question','name'=>'How quickly can you send a technician to '.$area->name.'?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Same-day dispatch for most requests in '.$area->name.'. Call +91 8346904100 for the fastest response.']],
        ]],
    ],
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endsection
@section('content')

@php
$zoneColor = [
    'South Kolkata & Jadavpur Zone'   => '#1a4fa0',
    'South-East & EM Bypass Zone'     => '#0e6e5a',
    'Central-South & Tollygunge Zone' => '#7a2b9e',
    'Science City & Bhawanipore Zone' => '#b84d00',
][$area->zone] ?? '#062d67';
@endphp

{{-- ═══ HERO ═══ --}}
<section style="background:linear-gradient(135deg,#06205a 0%,#0f458f 65%,#1a6dcc 100%);padding:117px 0 0;position:relative;overflow:hidden;">
    <div style="position:absolute;right:-100px;top:-100px;width:420px;height:420px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none;"></div>
    <div style="position:absolute;left:-60px;bottom:0;width:240px;height:240px;border-radius:50%;background:rgba(255,255,255,.03);pointer-events:none;"></div>

    <div class="container" style="position:relative;">
        {{-- Breadcrumb --}}
        <nav style="display:flex;align-items:center;gap:.4rem;font-size:.8rem;color:rgba(255,255,255,.55);margin-bottom:1.75rem;flex-wrap:wrap;">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,.55);">Home</a>
            <span>›</span>
            <a href="{{ route('areas.index') }}" style="color:rgba(255,255,255,.55);">Service Areas</a>
            <span>›</span>
            <span style="color:#fff;">{{ $area->name }}</span>
        </nav>

        <div style="display:grid;grid-template-columns:1fr auto;gap:2rem;align-items:start;">
            <div>
                {{-- Zone badge --}}
                <span style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.12);color:rgba(255,255,255,.9);font-size:.74rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;padding:.3rem .85rem;border-radius:999px;margin-bottom:1rem;">
                    <span style="width:7px;height:7px;border-radius:50%;background:{{ $zoneColor }};box-shadow:0 0 6px {{ $zoneColor }};"></span>
                    {{ $area->zone }}
                </span>

                <h1 style="color:#fff;font-size:clamp(1.6rem,4vw,2.5rem);line-height:1.2;margin:0 0 1rem;">
                    {{ $area->page_heading ?: 'AC Repair & Service in '.$area->name.', Kolkata' }}
                </h1>

                {{-- Meta row --}}
                <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-bottom:1.25rem;">
                    <span style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.1);color:rgba(255,255,255,.85);font-size:.82rem;padding:.3rem .75rem;border-radius:999px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        PIN {{ $area->pinCodesDisplay() }}
                    </span>
                    @if($area->distance_km)
                    <span style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.1);color:rgba(255,255,255,.85);font-size:.82rem;padding:.3rem .75rem;border-radius:999px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ $area->distance_km }} from Jadavpur
                    </span>
                    @endif
                    <span style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(46,213,115,.15);color:#2ed573;font-size:.82rem;font-weight:600;padding:.3rem .75rem;border-radius:999px;">
                        <span style="width:6px;height:6px;border-radius:50%;background:#2ed573;"></span>
                        Same-Day Service
                    </span>
                </div>

                <p style="color:rgba(255,255,255,.78);font-size:.97rem;line-height:1.7;max-width:560px;margin-bottom:1.75rem;">{{ $area->intro_text }}</p>

                {{-- CTAs --}}
                <div style="display:flex;flex-wrap:wrap;gap:.75rem;padding-bottom:2.5rem;">
                    <a href="#book" style="display:inline-flex;align-items:center;gap:.5rem;background:#fff;color:#06205a;font-weight:700;font-size:.9rem;padding:.75rem 1.5rem;border-radius:10px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Book Service Now
                    </a>
                    <a href="tel:+918346904100" style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.12);color:#fff;font-weight:600;font-size:.9rem;padding:.75rem 1.5rem;border-radius:10px;border:1px solid rgba(255,255,255,.2);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.56 21 3 13.44 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2Z"/></svg>
                        Call Now
                    </a>
                    <a href="https://wa.me/918346904100?text={{ rawurlencode('I need AC service in '.$area->name.', Kolkata') }}" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:.5rem;background:#25d366;color:#fff;font-weight:600;font-size:.9rem;padding:.75rem 1.5rem;border-radius:10px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347Z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.656 1.438 5.168L2 22l4.978-1.41A9.956 9.956 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2Zm0 18a7.95 7.95 0 0 1-4.076-1.117l-.292-.174-3.035.86.86-3.036-.19-.303A7.96 7.96 0 0 1 4 12c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8Z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>

            {{-- Map card --}}
            <div style="flex-shrink:0;width:320px;max-width:calc(100vw - 2rem);" class="hero-map-card">
                <div style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:16px;overflow:hidden;">
                    <div style="padding:.75rem 1rem;display:flex;align-items:center;gap:.5rem;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span style="color:rgba(255,255,255,.7);font-size:.78rem;">{{ $area->name }}, Kolkata</span>
                    </div>
                    <iframe
                        title="AC Service in {{ $area->name }}"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        style="width:100%;height:200px;border:0;display:block;"
                        src="https://www.google.com/maps?q={{ $area->latitude ?? 22.4987 }},{{ $area->longitude ?? 88.3714 }}&z=15&output=embed"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ TRUST BAR ═══ --}}
<div style="background:var(--card);border-bottom:1px solid var(--line);">
    <div class="container">
        <div style="display:flex;flex-wrap:wrap;gap:0;overflow-x:auto;scrollbar-width:none;">
            @php $trustItems = [
                ['icon'=>'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>', 'label'=>'Same-Day Dispatch'],
                ['icon'=>'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>', 'label'=>'Certified Technicians'],
                ['icon'=>'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>', 'label'=>'Transparent Pricing'],
                ['icon'=>'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>', 'label'=>'Mon–Sat, 9AM–8PM'],
                ['icon'=>'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M14 9V5a3 3 0 0 0-6 0v4"/><rect x="2" y="9" width="20" height="13" rx="2" ry="2"/></svg>', 'label'=>'Genuine Spare Parts'],
                ['icon'=>'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>', 'label'=>'All Major AC Brands'],
            ]; @endphp
            @foreach($trustItems as $item)
            <div style="display:flex;align-items:center;gap:.5rem;padding:.85rem 1.25rem;color:var(--body);font-size:.82rem;font-weight:500;white-space:nowrap;border-right:1px solid var(--line);">
                <span style="color:var(--accent);">{!! $item['icon'] !!}</span>
                {{ $item['label'] }}
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══ SERVICES ═══ --}}
@if($services->isNotEmpty())
<section style="padding:3rem 0;">
    <div class="container">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;margin-bottom:1.75rem;flex-wrap:wrap;">
            <div>
                <h2 style="font-size:1.5rem;margin:0 0 .35rem;">AC Services in {{ $area->name }}</h2>
                <p style="color:var(--body);margin:0;font-size:.9rem;">All available onsite · PIN {{ $area->pinCodesDisplay() }}</p>
            </div>
            <a href="{{ route('services.index') }}" style="font-size:.85rem;color:var(--accent);font-weight:600;display:inline-flex;align-items:center;gap:.3rem;">
                View All
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.1rem;">
            @foreach($services->take(6) as $service)
            <a href="{{ route('services.show', $service->slug) }}" style="display:block;background:var(--card);border:1px solid var(--line);border-radius:14px;overflow:hidden;text-decoration:none;transition:all .18s ease;"
               onmouseover="this.style.boxShadow='0 6px 24px rgba(6,45,103,.1)';this.style.transform='translateY(-3px)';this.style.borderColor='#0f458f'"
               onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';this.style.borderColor='var(--line)'">
                @if($service->image_path)
                <div style="height:160px;overflow:hidden;position:relative;">
                    <img src="{{ asset('storage/'.ltrim($service->image_path,'/')) }}" alt="{{ $service->name }} in {{ $area->name }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
                    @if(optional($service->category)->name)
                    <span style="position:absolute;top:.65rem;left:.65rem;background:rgba(6,45,103,.8);color:#fff;font-size:.7rem;font-weight:600;padding:.2rem .6rem;border-radius:999px;">{{ $service->category->name }}</span>
                    @endif
                </div>
                @else
                <div style="height:100px;background:linear-gradient(135deg,#e8eef8,#d0ddf5);display:flex;align-items:center;justify-content:center;">
                    <svg viewBox="0 0 120 60" style="width:80px;opacity:.35"><rect x="10" y="15" width="100" height="30" rx="8" fill="#3c7cc0"/><rect x="20" y="22" width="80" height="16" rx="8" fill="#8ec3f5"/></svg>
                </div>
                @endif
                <div style="padding:1rem 1.1rem;">
                    <h3 style="font-size:.92rem;font-weight:700;margin:0 0 .5rem;color:var(--text);line-height:1.3;">{{ $service->name }}</h3>
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:.5rem;">
                        @if((float)$service->price > 0)
                        <span style="font-size:.9rem;font-weight:700;color:var(--accent);">from ₹{{ number_format((float)$service->price,0) }}</span>
                        @else
                        <span style="font-size:.82rem;color:var(--body);">Custom Pricing</span>
                        @endif
                        <span style="font-size:.75rem;color:#16a34a;font-weight:600;display:flex;align-items:center;gap:.3rem;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#16a34a;"></span>Available
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ WHY US ═══ --}}
<section style="padding:3rem 0;background:var(--card);border-top:1px solid var(--line);border-bottom:1px solid var(--line);">
    <div class="container">
        <h2 style="font-size:1.5rem;text-align:center;margin-bottom:.5rem;">Why Choose Unique Aircon in {{ $area->name }}?</h2>
        <p style="text-align:center;color:var(--body);margin-bottom:2rem;font-size:.9rem;">Trusted by homeowners and businesses across {{ $area->zone }}</p>
        @php $whyItems = [
            ['icon'=>'⚡','title'=>'Same-Day Service','desc'=>'Book by noon, get a technician at your door today.'],
            ['icon'=>'🛡️','title'=>'Certified Technicians','desc'=>'Factory-trained for Voltas, LG, Daikin, Samsung & more.'],
            ['icon'=>'🔩','title'=>'Genuine Spare Parts','desc'=>'Only OEM components — no counterfeit parts ever.'],
            ['icon'=>'💰','title'=>'Transparent Pricing','desc'=>'Fixed quote before work starts. Zero hidden charges.'],
            ['icon'=>'📅','title'=>'6 Days a Week','desc'=>'Monday to Saturday, 9 AM to 8 PM, all year round.'],
            ['icon'=>'🏢','title'=>'Commercial HVAC','desc'=>'VRF, ductable, cassette & chiller system specialists.'],
        ]; @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;">
            @foreach($whyItems as $item)
            <div style="background:var(--bg);border:1px solid var(--line);border-radius:14px;padding:1.4rem 1.25rem;display:flex;gap:1rem;align-items:flex-start;">
                <span style="font-size:1.6rem;line-height:1;flex-shrink:0;">{{ $item['icon'] }}</span>
                <div>
                    <strong style="font-size:.92rem;display:block;margin-bottom:.3rem;color:var(--text);">{{ $item['title'] }}</strong>
                    <p style="font-size:.82rem;color:var(--body);margin:0;line-height:1.5;">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ BOOKING FORM ═══ --}}
<section id="book" style="padding:3.5rem 0;background:var(--bg);">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start;max-width:900px;margin:0 auto;" class="book-grid">
            {{-- Left info --}}
            <div>
                <span style="display:inline-block;background:var(--accent);color:#fff;font-size:.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:.3rem .8rem;border-radius:999px;margin-bottom:1rem;">Book a Slot</span>
                <h2 style="font-size:1.5rem;margin:0 0 .75rem;">Book AC Service in {{ $area->name }}</h2>
                <p style="color:var(--body);font-size:.9rem;line-height:1.7;margin-bottom:1.5rem;">Our team will confirm your slot for <strong>{{ $area->name }}</strong> ({{ $area->pinCodesDisplay() }}) within minutes of your request.</p>
                <div style="display:flex;flex-direction:column;gap:.75rem;">
                    <div style="display:flex;align-items:center;gap:.75rem;font-size:.88rem;color:var(--body);">
                        <span style="width:32px;height:32px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.75rem;font-weight:700;">1</span>
                        Fill in your name, phone &amp; service type
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;font-size:.88rem;color:var(--body);">
                        <span style="width:32px;height:32px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.75rem;font-weight:700;">2</span>
                        We call you back to confirm the slot
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;font-size:.88rem;color:var(--body);">
                        <span style="width:32px;height:32px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.75rem;font-weight:700;">3</span>
                        Technician arrives at your door — same day
                    </div>
                </div>
                <div style="margin-top:2rem;padding:1.1rem 1.25rem;background:var(--card);border:1px solid var(--line);border-radius:12px;">
                    <p style="font-size:.82rem;color:var(--body);margin:0 0 .35rem;font-weight:600;">Prefer to call directly?</p>
                    <a href="tel:+918346904100" style="font-size:1.1rem;font-weight:700;color:var(--accent);display:flex;align-items:center;gap:.5rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.56 21 3 13.44 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2Z"/></svg>
                        +91 8346904100
                    </a>
                </div>
            </div>
            {{-- Form --}}
            <div style="background:var(--card);border:1px solid var(--line);border-radius:16px;padding:1.75rem;">
                @include('site.partials.enquiry-form')
            </div>
        </div>
    </div>
</section>

{{-- ═══ FAQ ═══ --}}
<section style="padding:3rem 0;background:var(--card);border-top:1px solid var(--line);">
    <div class="container" style="max-width:760px;">
        <h2 style="font-size:1.5rem;margin-bottom:.5rem;">Frequently Asked Questions</h2>
        <p style="color:var(--body);margin-bottom:2rem;font-size:.9rem;">AC service queries specific to {{ $area->name }}</p>
        @php $faqs = [
            ['q'=>'Do you provide AC repair in '.$area->name.'?', 'a'=>'Yes. Unique Aircon provides onsite AC repair in '.$area->name.' (PIN '.$area->pinCodesDisplay().'). Call +91 8346904100 for same-day booking.'],
            ['q'=>'Which AC brands do you service in '.$area->name.'?', 'a'=>'We service Voltas, LG, Daikin, Samsung, Blue Star, Hitachi, Lloyd, Carrier, OGeneral, Whirlpool, and all other major brands in '.$area->name.'.'],
            ['q'=>'How quickly can you send a technician to '.$area->name.'?', 'a'=>'For most requests we dispatch a technician the same day. '.$area->name.' is within our active service zone — call +91 8346904100 for fastest response.'],
            ['q'=>'Do you offer AMC packages in '.$area->name.'?', 'a'=>'Yes. We offer Basic (₹2,999), Standard (₹4,999), and Premium (₹7,999) AMC plans per unit per year, available across '.$area->name.'.'],
            ['q'=>'What is the cost of AC servicing in '.$area->name.'?', 'a'=>'Standard AC servicing starts from ₹399. Repair and installation costs vary by issue and brand — we provide a free estimate before starting any work.'],
        ]; @endphp
        <div style="display:flex;flex-direction:column;gap:.6rem;" id="faqList">
            @foreach($faqs as $i => $faq)
            <div style="background:var(--bg);border:1px solid var(--line);border-radius:12px;overflow:hidden;">
                <button onclick="toggleFaq({{ $i }})" style="width:100%;display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:1rem 1.25rem;background:none;border:none;cursor:pointer;text-align:left;font-weight:600;font-size:.9rem;color:var(--text);">
                    <span>{{ $faq['q'] }}</span>
                    <svg id="faq-icon-{{ $i }}" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2.5" stroke-linecap="round" style="flex-shrink:0;transition:transform .2s;"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div id="faq-body-{{ $i }}" style="display:none;padding:0 1.25rem 1rem;font-size:.88rem;color:var(--body);line-height:1.7;border-top:1px solid var(--line);">
                    <div style="padding-top:.75rem;">{{ $faq['a'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ FINAL CTA ═══ --}}
<section style="background:linear-gradient(135deg,#06205a,#0f458f);padding:3rem 0;">
    <div class="container" style="text-align:center;">
        <h2 style="color:#fff;font-size:1.75rem;margin-bottom:.75rem;">Need Fast AC Service in {{ $area->name }}?</h2>
        <p style="color:rgba(255,255,255,.75);max-width:480px;margin:0 auto 2rem;font-size:.95rem;">Certified technicians for repair, installation, gas charging, and commercial HVAC — same day.</p>
        <div style="display:flex;gap:.75rem;justify-content:center;flex-wrap:wrap;">
            <a href="#book" style="background:#fff;color:#06205a;font-weight:700;padding:.8rem 2rem;border-radius:10px;font-size:.92rem;">Book Now</a>
            <a href="tel:+918346904100" style="background:rgba(255,255,255,.12);color:#fff;font-weight:600;padding:.8rem 2rem;border-radius:10px;font-size:.92rem;border:1px solid rgba(255,255,255,.25);">Call +91 8346904100</a>
            <a href="https://wa.me/918346904100" target="_blank" rel="noopener" style="background:#25d366;color:#fff;font-weight:600;padding:.8rem 2rem;border-radius:10px;font-size:.92rem;">WhatsApp</a>
        </div>
    </div>
</section>

<style>
@media(max-width:768px) {
    .hero-map-card { display:none !important; }
    .book-grid { grid-template-columns:1fr !important; gap:1.5rem !important; }
}
</style>
<script>
function toggleFaq(i) {
    const body = document.getElementById('faq-body-' + i);
    const icon = document.getElementById('faq-icon-' + i);
    const open = body.style.display === 'block';
    // close all
    document.querySelectorAll('[id^="faq-body-"]').forEach(el => el.style.display = 'none');
    document.querySelectorAll('[id^="faq-icon-"]').forEach(el => el.style.transform = 'rotate(0deg)');
    if (!open) {
        body.style.display = 'block';
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

@endsection
