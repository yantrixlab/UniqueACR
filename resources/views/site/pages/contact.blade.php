@extends('site.layouts.app')
@section('title','Contact Us | AC Repair & Service Booking Kolkata – Cooling Kolkata')
@section('meta_description','Contact Cooling Kolkata for AC repair, servicing, installation & AMC in Kolkata. Call +91 8346904100 or WhatsApp for same-day AC service near you.')
@section('meta_keywords','contact AC repair Kolkata, AC service booking Kolkata, AC repair phone number Kolkata, book AC service Kolkata, AC servicing near me contact number')
@section('og_title','Contact Cooling Kolkata | Book AC Repair & Service in Kolkata')
@section('og_description','Book AC repair, servicing, or installation in Kolkata. Call or WhatsApp +91 8346904100. Same-day slots available.')
@section('schema')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Do you provide same day AC service in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, same-day AC service is available for most Kolkata locations based on technician availability. Call +91 8346904100 or WhatsApp us to book an immediate slot."
            }
        },
        {
            "@type": "Question",
            "name": "Which AC brands do you support?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We support all major AC brands including Daikin, Voltas, LG, OGeneral, Samsung, Blue Star, Hitachi, Lloyd, Carrier and Whirlpool — covering most leading inverter and non-inverter systems."
            }
        },
        {
            "@type": "Question",
            "name": "Do you provide commercial AC servicing in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, we handle all commercial HVAC systems including VRV/VRF, ductable, cassette and packaged systems for offices, retail stores, hospitals, and large commercial properties in Kolkata."
            }
        },
        {
            "@type": "Question",
            "name": "Do you offer AMC packages for AC maintenance?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, annual maintenance contracts (AMC) are available for homes, offices, and business facilities in Kolkata. Our AMC plans include scheduled servicing, priority support, and discounted parts."
            }
        },
        {
            "@type": "Question",
            "name": "Which areas in Kolkata do you cover for AC repair?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We cover Jadavpur and nearby areas including Garia, Dhakuria, Tollygunge, Kasba, Ballygunge, Behala, Salt Lake, New Town and more across Kolkata."
            }
        }
    ]
}
</script>
@endverbatim
@endsection
@section('content')
<section class="contact-hero">
    <div class="contact-hero-glow a"></div>
    <div class="contact-hero-glow b"></div>
    <div class="container contact-hero-inner">
        <span class="pill">24/7 AC Support in Kolkata</span>
        <h1>Contact Our AC Experts</h1>
        <p>Get fast AC repair, installation, maintenance, and commercial HVAC support from trusted professionals in Kolkata.</p>
        <div class="contact-hero-tags">
            <span>AC service Kolkata</span>
            <span>AC repair Kolkata</span>
            <span>AC installation Kolkata</span>
        </div>
    </div>
</section>

<section class="section contact-info-zone">
    <div class="container">
        <h2>Reach Us Instantly</h2>
        <p class="sub">Pick your preferred contact method and our support team will respond quickly.</p>
        <div class="contact-cards">
            <a class="contact-card" href="https://maps.google.com/?q=3/87 C. R Colony, Jadavpur, Kolkata 700032" target="_blank" rel="noopener">
                <div class="ci-icon">📍</div>
                <h3>Business Address</h3>
                <p>3/87 C. R Colony, Jadavpur, Kolkata 700032</p>
            </a>
            <a class="contact-card" href="tel:+918346904100">
                <div class="ci-icon">📞</div>
                <h3>Phone Number</h3>
                <p>+91 8346904100</p>
            </a>
            <a class="contact-card" href="mailto:uniquerac24@gmail.com">
                <div class="ci-icon">✉️</div>
                <h3>Email Address</h3>
                <p>uniquerac24@gmail.com</p>
            </a>
            <a class="contact-card" href="https://wa.me/918346904100" target="_blank" rel="noopener">
                <div class="ci-icon">💬</div>
                <h3>WhatsApp Contact</h3>
                <p>Usually replies within 5 minutes</p>
            </a>
            <div class="contact-card">
                <div class="ci-icon">🕒</div>
                <h3>Business Hours</h3>
                <p>Mon-Sat: 9:30 AM - 9:30 PM<br>Emergency: 24/7</p>
            </div>
        </div>
    </div>
</section>

<section class="section contact-form-zone">
    <div class="container contact-form-grid">
        <div class="contact-form-shell">
            <h2>Book Service Now</h2>
            <p class="sub">Tell us your requirement and we will arrange a callback.</p>
            @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('enquiries.store') }}" class="modern-contact-form">
                @csrf
                <input type="hidden" name="source_type" value="general">
                <div class="fc-row two">
                    <label>Full Name<input type="text" name="name" value="{{ old('name') }}" required></label>
                    <label>Phone Number<input type="text" name="phone" value="{{ old('phone') }}" required></label>
                </div>
                <div class="fc-row two">
                    <label>Email<input type="email" name="email" value="{{ old('email') }}" required></label>
                    <label>Service Type
                        <select name="service_type" required>
                            <option value="" disabled @selected(!old('service_type'))>Select Service</option>
                            <option value="AC Repair" @selected(old('service_type')==='AC Repair')>AC Repair</option>
                            <option value="AC Installation" @selected(old('service_type')==='AC Installation')>AC Installation</option>
                            <option value="AC Maintenance" @selected(old('service_type')==='AC Maintenance')>AC Maintenance</option>
                            <option value="Commercial HVAC" @selected(old('service_type')==='Commercial HVAC')>Commercial HVAC</option>
                            <option value="AMC Services" @selected(old('service_type')==='AMC Services')>AMC Services</option>
                        </select>
                    </label>
                </div>
                <label>Address<input type="text" name="address" value="{{ old('address') }}" required></label>
                <label>Message<textarea name="message" rows="4" required>{{ old('message') }}</textarea></label>
                <button class="contact-submit" type="submit">Book Service Now</button>
            </form>
        </div>

        <aside class="support-quick-card">
            <span class="badge">Same Day Service</span>
            <h3>Emergency AC Support</h3>
            <p>Technicians are available across Kolkata for urgent repair and cooling restoration.</p>
            <ul>
                <li>Fast callback in 10-15 mins</li>
                <li>Certified HVAC professionals</li>
                <li>Genuine spare parts</li>
            </ul>
            <div class="quick-actions">
                <a class="primary-btn" href="tel:+918346904100">Call Now</a>
                <a class="secondary-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Us</a>
            </div>
            <p class="availability-dot"><span></span>Technician available now</p>
        </aside>
    </div>
</section>

<section class="section map-zone">
    <div class="container">
        <h2>Find Us in Jadavpur</h2>
        <p class="sub" style="margin-bottom:24px;">Coverage: Jadavpur, Garia, Dhakuria, Tollygunge, Ballygunge, Kasba, Santoshpur.</p>

        <div style="position:relative;border-radius:18px;overflow:hidden;box-shadow:0 8px 40px rgba(0,0,0,.14);">

            {{-- Leaflet map container --}}
            <div id="coverage-map" style="width:100%;height:460px;background:#e8f0fe;"></div>

            {{-- Address label overlay --}}
            <div style="position:absolute;top:16px;left:60px;z-index:1000;background:rgba(6,20,50,.88);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);color:#fff;padding:.55rem 1.1rem;border-radius:11px;font-size:.8rem;line-height:1.5;border:1px solid rgba(255,255,255,.14);pointer-events:none;box-shadow:0 4px 16px rgba(0,0,0,.3);">
                <strong style="display:block;font-size:.86rem;margin-bottom:.1rem;">📍 Cooling Kolkata</strong>
                <span style="color:rgba(255,255,255,.65);">3/87 C. R Colony, Jadavpur, Kolkata – 700032</span>
            </div>

            {{-- 8 km badge --}}
            <div style="position:absolute;bottom:30px;left:16px;z-index:1000;display:inline-flex;align-items:center;gap:.45rem;background:rgba(0,25,10,.88);backdrop-filter:blur(10px);border:1px solid rgba(34,197,94,.4);color:#4ade80;font-size:.74rem;font-weight:700;padding:.42rem 1rem;border-radius:999px;pointer-events:none;box-shadow:0 4px 14px rgba(0,0,0,.3);">
                <span class="map-pulse-dot"></span>
                8 km service coverage area
            </div>
        </div>

        <div class="coverage-tags" style="margin-top:1.25rem;">
            <span>Jadavpur</span><span>Garia</span><span>Dhakuria</span><span>Tollygunge</span><span>Ballygunge</span><span>Kasba</span>
        </div>
    </div>
</section>

{{-- Leaflet loaded AFTER the map div exists --}}
<style>
.map-pulse-dot{width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 6px #22c55e;flex-shrink:0;animation:mapDotPulse 2s infinite;}
@keyframes mapDotPulse{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.6)}70%{box-shadow:0 0 0 7px rgba(34,197,94,0)}}
@keyframes markerPing{0%{transform:scale(.8);opacity:.8}100%{transform:scale(2.5);opacity:0}}
.leaflet-control-attribution{font-size:.62rem!important;opacity:.65;}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css"/>
<script>
(function(){
    /* Load Leaflet JS dynamically so it always runs AFTER the map div */
    var s = document.createElement('script');
    s.src = 'https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js';
    s.onload = initCoverageMap;
    s.onerror = function(){ console.warn('Leaflet failed to load'); };
    document.body.appendChild(s);

    function initCoverageMap(){
        var LAT = 22.486403, LNG = 88.375548;
        var el  = document.getElementById('coverage-map');
        if(!el || typeof L === 'undefined') return;

        var map = L.map(el, {
            center: [LAT, LNG],
            zoom: 12,
            zoomControl: true,
            scrollWheelZoom: true,
        });

        /* CartoDB Positron — clean professional light style */
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> &copy; <a href="https://carto.com/" target="_blank">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19,
        }).addTo(map);

        /* ── 8 km coverage circle (native Leaflet — scales with every zoom) ── */
        L.circle([LAT, LNG], {
            radius      : 8000,
            color       : '#16a34a',
            weight      : 2.2,
            opacity     : 0.9,
            dashArray   : '10 6',
            lineCap     : 'round',
            fillColor   : '#22c55e',
            fillOpacity : 0.09,
        }).addTo(map);

        /* Soft outer glow ring */
        L.circle([LAT, LNG], {
            radius      : 8000,
            color       : '#4ade80',
            weight      : 8,
            opacity     : 0.14,
            fillOpacity : 0,
        }).addTo(map);

        /* ── Custom animated marker ── */
        var pinHtml = [
            '<div style="position:relative;width:44px;height:44px;transform:translate(-50%,-50%)">',
              '<span style="position:absolute;inset:0;border-radius:50%;background:rgba(59,130,246,.22);animation:markerPing 2s cubic-bezier(0,0,.2,1) infinite"></span>',
              '<span style="position:absolute;inset:0;border-radius:50%;background:rgba(59,130,246,.12);animation:markerPing 2s cubic-bezier(0,0,.2,1) infinite .6s"></span>',
              '<span style="position:absolute;inset:9px;border-radius:50%;background:#1d4ed8;box-shadow:0 0 0 3px #fff,0 4px 14px rgba(0,0,0,.35);display:flex;align-items:center;justify-content:center;">',
                '<svg width="13" height="13" viewBox="0 0 24 24" fill="white"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>',
              '</span>',
            '</div>'
        ].join('');

        var marker = L.marker([LAT, LNG], {
            icon: L.divIcon({ className:'', html: pinHtml, iconSize:[0,0], iconAnchor:[0,0] })
        }).addTo(map);

        marker.bindPopup(
            '<div style="font-family:system-ui,sans-serif;padding:.2rem .1rem;min-width:185px">' +
              '<strong style="font-size:.88rem;color:#062d67;display:block;margin-bottom:.2rem">Cooling Kolkata</strong>' +
              '<span style="font-size:.76rem;color:#64748b;line-height:1.5">3/87 C. R Colony, Jadavpur<br>Kolkata – 700032</span><br>' +
              '<a href="tel:+918346904100" style="display:inline-block;margin-top:.45rem;font-size:.78rem;color:#1d4ed8;font-weight:700">+91 83469 04100</a>' +
            '</div>',
            { offset: [0, -8] }
        ).openPopup();

        /* ── "8 km service radius" label pinned ~8 km north ── */
        L.marker([LAT + 0.072, LNG], {
            icon: L.divIcon({
                className: '',
                html: '<div style="background:rgba(0,22,10,.82);border:1px solid rgba(34,197,94,.5);color:#4ade80;font-size:.68rem;font-weight:700;font-family:system-ui,sans-serif;padding:.26rem .8rem;border-radius:999px;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,0,.3)">● 8 km service radius</div>',
                iconAnchor: [72, 10],
            }),
            interactive: false,
            keyboard   : false,
        }).addTo(map);

        /* Force correct size after fonts/styles settle */
        setTimeout(function(){ map.invalidateSize(); }, 200);
    }
})();
</script>

<section class="section whatsapp-strip">
    <div class="container ws-inner">
        <div>
            <h3>Need Immediate Help?</h3>
            <p>Chat with our HVAC support team now. Usually replies within 5 minutes.</p>
        </div>
        <a class="ws-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Quick Contact</a>
    </div>
</section>

<section class="section faq-zone">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-list">
            <details><summary>Do you provide same day AC service?</summary><p>Yes, same-day support is available for most Kolkata locations based on technician availability.</p></details>
            <details><summary>Which AC brands do you support?</summary><p>We support major brands including Daikin, Voltas, OGeneral and most leading inverter and non-inverter systems.</p></details>
            <details><summary>Do you provide commercial AC servicing?</summary><p>Yes, we handle commercial HVAC including VRV/VRF, ductable, cassette and packaged systems.</p></details>
            <details><summary>Do you offer AMC packages?</summary><p>Yes, annual maintenance contracts are available for homes, offices, and business facilities.</p></details>
            <details><summary>Which areas in Kolkata do you cover?</summary><p>We cover Jadavpur and nearby areas including Garia, Dhakuria, Tollygunge, Kasba, Ballygunge and more.</p></details>
        </div>
    </div>
</section>

<section class="section hours-zone">
    <div class="container">
        <div class="hours-card">
            <h2>Business Hours & Availability</h2>
            <div class="hours-grid">
                <p><strong>Monday - Saturday:</strong> 9:30 AM - 9:30 PM</p>
                <p><strong>Sunday:</strong> Emergency only</p>
                <p><strong>Emergency Support:</strong> 24/7 phone assistance</p>
                <p><strong>Holiday Availability:</strong> On-call support</p>
            </div>
            <div class="hours-status"><span class="dot"></span>Currently Open • Available for Emergency Support</div>
        </div>
    </div>
</section>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => 'Cooling Kolkata',
    'url' => route('contact'),
    'telephone' => '+918346904100',
    'email' => 'uniquerac24@gmail.com',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '3/87 C. R Colony, Jadavpur',
        'addressLocality' => 'Kolkata',
        'addressRegion' => 'West Bengal',
        'postalCode' => '700032',
        'addressCountry' => 'IN',
    ],
    'openingHoursSpecification' => [[
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
        'opens' => '08:00',
        'closes' => '21:30',
    ]],
]) !!}
</script>
@endsection

