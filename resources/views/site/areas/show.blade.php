@extends('site.layouts.app')
@section('title', $area->meta_title ?: 'AC Service in '.$area->name.' | Repair & Installation | Cooling Kolkata')
@section('meta_description', $area->meta_description ?: 'Expert AC repair, installation & servicing in '.$area->name.', Kolkata ('.$area->pinCodesDisplay().'). Same-day onsite visits. Call +91 8346904100.')
@section('meta_keywords', 'AC service '.$area->name.', AC repair '.$area->name.', air conditioner service '.$area->name.', AC repair Kolkata '.$area->pinCodesDisplay().', AC servicing near me '.$area->name)
@section('og_title', 'AC Service in '.$area->name.' | Cooling Kolkata')
@section('og_description', 'Same-day AC repair, installation & maintenance in '.$area->name.', Kolkata. Certified technicians, genuine parts. Call +91 8346904100.')
@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'    => 'BreadcrumbList',
            'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],
                ['@type'=>'ListItem','position'=>2,'name'=>'Service Areas','item'=>route('areas.index')],
                ['@type'=>'ListItem','position'=>3,'name'=>$area->name,'item'=>route('areas.show',$area->slug)],
            ],
        ],
        [
            '@type'       => ['LocalBusiness','HVACBusiness'],
            'name'        => 'Cooling Kolkata',
            'url'         => url('/'),
            'telephone'   => '+918346904100',
            'email'       => 'uniquerac24@gmail.com',
            'priceRange'  => '₹₹',
            'areaServed'  => [
                ['@type'=>'Place','name'=>$area->name],
                ['@type'=>'PostalAddress','postalCode'=>($area->pin_codes[0] ?? ''),'addressLocality'=>$area->name,'addressRegion'=>'West Bengal','addressCountry'=>'IN'],
            ],
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => '3/87 C. R Colony, Jadavpur',
                'addressLocality' => 'Kolkata',
                'addressRegion'   => 'West Bengal',
                'postalCode'      => '700032',
                'addressCountry'  => 'IN',
            ],
            'geo' => ['@type'=>'GeoCoordinates','latitude'=>$area->latitude ?? 22.4987,'longitude'=>$area->longitude ?? 88.3714],
        ],
        [
            '@type'       => 'Service',
            'name'        => 'AC Repair & Servicing in '.$area->name,
            'serviceType' => 'AC Repair, AC Installation, AC Maintenance',
            'areaServed'  => ['@type'=>'Place','name'=>$area->name.', Kolkata'],
            'provider'    => [
                '@type'     => 'LocalBusiness',
                'name'      => 'Cooling Kolkata',
                'telephone' => '+918346904100',
            ],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name'  => 'Do you provide AC repair in '.$area->name.'?',
                    'acceptedAnswer' => ['@type'=>'Answer','text'=>'Yes, Cooling Kolkata provides onsite AC repair in '.$area->name.' (PIN '.$area->pinCodesDisplay().'). Our technicians are dispatched the same day. Call +91 8346904100 to book.'],
                ],
                [
                    '@type' => 'Question',
                    'name'  => 'What AC brands do you service in '.$area->name.'?',
                    'acceptedAnswer' => ['@type'=>'Answer','text'=>'We service all major brands in '.$area->name.' including Voltas, LG, Daikin, Samsung, Blue Star, Hitachi, Lloyd, Carrier, OGeneral, and Whirlpool.'],
                ],
                [
                    '@type' => 'Question',
                    'name'  => 'How quickly can you send a technician to '.$area->name.'?',
                    'acceptedAnswer' => ['@type'=>'Answer','text'=>'For most requests in '.$area->name.' we dispatch a technician the same day, subject to slot availability. Call +91 8346904100 for the fastest response.'],
                ],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endsection
@section('content')

<section class="section" style="padding-top:2.5rem;">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span aria-hidden="true"> › </span>
            <a href="{{ route('areas.index') }}">Service Areas</a>
            <span aria-hidden="true"> › </span>
            <span aria-current="page">{{ $area->name }}</span>
        </nav>

        <div style="margin-top:1.5rem;display:flex;flex-wrap:wrap;gap:2.5rem;align-items:flex-start;">
            <div style="flex:1;min-width:280px;">
                <span class="brand-chip">{{ $area->zone }}</span>
                <h1 style="margin-top:.6rem;">{{ $area->page_heading ?: 'AC Repair & Service in '.$area->name.', Kolkata' }}</h1>
                <p style="color:var(--text-muted);margin:.5rem 0 1.25rem;">
                    PIN: <strong>{{ $area->pinCodesDisplay() }}</strong>
                    @if($area->distance_km)
                        &nbsp;·&nbsp; {{ $area->distance_km }} from Jadavpur
                    @endif
                </p>
                <p>{{ $area->intro_text }}</p>
                <div class="detail-cta-row" style="margin-top:1.5rem;">
                    <a class="primary-btn" href="{{ route('contact') }}">Book Service in {{ $area->name }}</a>
                    <a class="secondary-btn" href="https://wa.me/918346904100?text={{ rawurlencode('I need AC service in '.$area->name.', Kolkata') }}" target="_blank" rel="noopener">WhatsApp Us</a>
                </div>
            </div>

            <div style="flex:0 0 320px;max-width:100%;">
                <div class="map-shell" style="height:240px;border-radius:12px;overflow:hidden;">
                    @if($area->latitude && $area->longitude)
                    <iframe
                        title="AC Service in {{ $area->name }}"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        style="width:100%;height:100%;border:0;"
                        src="https://www.google.com/maps?q={{ $area->latitude }},{{ $area->longitude }}&z=15&output=embed"></iframe>
                    @else
                    <iframe
                        title="AC Service in {{ $area->name }}"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        style="width:100%;height:100%;border:0;"
                        src="https://www.google.com/maps?q={{ urlencode($area->name.', Kolkata') }}&z=15&output=embed"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Services offered in this area --}}
@if($services->isNotEmpty())
<section class="section" style="padding-top:2rem;">
    <div class="container">
        <h2>AC Services We Offer in {{ $area->name }}</h2>
        <p class="sub">All services are available onsite in {{ $area->name }} ({{ $area->pinCodesDisplay() }}).</p>
        <div class="services-grid">
            @foreach($services->take(6) as $service)
            <a href="{{ route('services.show', $service->slug) }}" class="card svc-card" style="text-decoration:none;">
                @if($service->image_path)
                <img src="{{ asset('storage/'.ltrim($service->image_path,'/')) }}" alt="{{ $service->name }} in {{ $area->name }}" loading="lazy" style="width:100%;height:180px;object-fit:cover;border-radius:8px 8px 0 0;">
                @endif
                <div style="padding:1.25rem 1.5rem;">
                    <h3 style="font-size:1rem;margin-bottom:.3rem;">{{ $service->name }}</h3>
                    @if(optional($service->category)->name)
                    <span class="brand-chip" style="font-size:.75rem;">{{ $service->category->name }}</span>
                    @endif
                    @if((float)$service->price > 0)
                    <p style="margin-top:.5rem;font-weight:700;color:var(--accent);">from ₹{{ number_format((float)$service->price,0) }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:1.5rem;">
            <a class="secondary-btn" href="{{ route('services.index') }}">View All Services</a>
        </div>
    </div>
</section>
@endif

{{-- Why choose us --}}
<section class="section" style="background:var(--surface-alt,#f7f9fc);padding-top:2rem;padding-bottom:2rem;">
    <div class="container">
        <h2>Why Choose Cooling Kolkata in {{ $area->name }}?</h2>
        <div class="why-grid" style="margin-top:1rem;">
            <article><strong>Same-Day Service</strong><p>Book by noon, get a technician today.</p></article>
            <article><strong>Certified Technicians</strong><p>Trained for all major AC brands.</p></article>
            <article><strong>Genuine Spare Parts</strong><p>No counterfeit components, ever.</p></article>
            <article><strong>Transparent Pricing</strong><p>Fixed quotes before work starts.</p></article>
            <article><strong>6 Days a Week</strong><p>Mon–Sat, 9 AM to 8 PM.</p></article>
            <article><strong>Commercial HVAC</strong><p>VRF, ductable & chiller systems too.</p></article>
        </div>
    </div>
</section>

{{-- Booking form --}}
<section class="section" id="book" style="padding-top:2rem;">
    <div class="container" style="max-width:640px;">
        <h2>Book AC Service in {{ $area->name }}</h2>
        <p style="margin-bottom:1.25rem;">Fill in your details and our team will confirm a slot for {{ $area->name }} ({{ $area->pinCodesDisplay() }}).</p>
        @include('site.partials.enquiry-form')
    </div>
</section>

{{-- FAQ --}}
<section class="section faq-zone" style="padding-top:2rem;">
    <div class="container">
        <h2>Frequently Asked Questions – AC Service in {{ $area->name }}</h2>
        <div class="faq-list">
            <details>
                <summary>Do you provide AC repair in {{ $area->name }}?</summary>
                <p>Yes. Cooling Kolkata provides onsite AC repair in {{ $area->name }} (PIN {{ $area->pinCodesDisplay() }}). Call +91 8346904100 for same-day booking.</p>
            </details>
            <details>
                <summary>Which AC brands do you service in {{ $area->name }}?</summary>
                <p>We service Voltas, LG, Daikin, Samsung, Blue Star, Hitachi, Lloyd, Carrier, OGeneral, Whirlpool, and all other major brands in {{ $area->name }}.</p>
            </details>
            <details>
                <summary>How quickly can you send a technician to {{ $area->name }}?</summary>
                <p>For most requests we dispatch a technician the same day. {{ $area->name }} is within our active service zone — call +91 8346904100 for fastest response.</p>
            </details>
            <details>
                <summary>Do you offer AMC packages in {{ $area->name }}?</summary>
                <p>Yes. We offer Basic, Standard, and Premium AMC plans starting at ₹2,999/unit/year, available across {{ $area->name }} and the surrounding {{ $area->zone }}.</p>
            </details>
            <details>
                <summary>What is the cost of AC servicing in {{ $area->name }}?</summary>
                <p>Standard AC servicing starts from ₹399. Repair and installation costs vary by issue and brand — we provide a free estimate before starting any work.</p>
            </details>
        </div>
    </div>
</section>

{{-- Other areas in same zone --}}
<section class="section" style="padding-top:2rem;padding-bottom:2rem;">
    <div class="container">
        <h2>Other Areas We Serve in {{ $area->zone }}</h2>
        <p style="margin-bottom:1rem;">Explore nearby localities also covered by Cooling Kolkata.</p>
        <a href="{{ route('areas.index') }}" class="ghost-btn">View All Service Areas →</a>
    </div>
</section>

<section class="section svc-final-cta">
    <div class="container cta-panel">
        <h2>Need Fast AC Service in {{ $area->name }}?</h2>
        <p>Book certified technicians for repair, installation, gas charging, and commercial HVAC — same day.</p>
        <div class="quick-actions">
            <a class="primary-btn" href="#book">Book Now</a>
            <a class="secondary-btn" href="tel:+918346904100">Call Now</a>
            <a class="ghost-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Us</a>
        </div>
    </div>
</section>

@endsection
