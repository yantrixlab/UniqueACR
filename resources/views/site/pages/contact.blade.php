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
        <p class="sub">Coverage: Jadavpur, Garia, Dhakuria, Tollygunge, Ballygunge, Kasba, Santoshpur.</p>

        <div class="map-shell" style="position:relative;overflow:hidden;border-radius:16px;">

            {{-- Google Maps iframe — zoom 12 so 8 km radius is visible --}}
            <iframe
                id="map-iframe"
                title="Cooling Kolkata Location"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                style="width:100%;height:440px;border:0;display:block;"
                src="https://www.google.com/maps?q=22.486403,88.375548&z=12&output=embed"></iframe>

            {{-- SVG overlay: 8 km radius circle --}}
            <svg id="map-radius-svg"
                 aria-hidden="true"
                 style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;overflow:visible;">
                <defs>
                    <radialGradient id="coverageGrad" cx="50%" cy="50%" r="50%">
                        <stop offset="0%"   stop-color="#22c55e" stop-opacity="0.18"/>
                        <stop offset="70%"  stop-color="#16a34a" stop-opacity="0.10"/>
                        <stop offset="100%" stop-color="#15803d" stop-opacity="0"/>
                    </radialGradient>
                    <filter id="circleGlow">
                        <feGaussianBlur stdDeviation="3" result="blur"/>
                        <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                    </filter>
                </defs>

                {{-- Filled gradient area --}}
                <circle id="coverage-fill"
                        cx="50%" cy="50%"
                        fill="url(#coverageGrad)"
                        stroke="none"/>

                {{-- Animated dashed stroke --}}
                <circle id="coverage-stroke"
                        cx="50%" cy="50%"
                        fill="none"
                        stroke="#22c55e"
                        stroke-width="2.5"
                        stroke-dasharray="10 6"
                        stroke-linecap="round"
                        opacity="0.85"
                        filter="url(#circleGlow)">
                    <animateTransform attributeName="transform"
                                      type="rotate"
                                      from="0"
                                      to="360"
                                      dur="60s"
                                      repeatCount="indefinite"
                                      additive="sum"/>
                </circle>

                {{-- Subtle outer pulse ring --}}
                <circle id="coverage-pulse"
                        cx="50%" cy="50%"
                        fill="none"
                        stroke="#4ade80"
                        stroke-width="1"
                        opacity="0">
                    <animate attributeName="r"         values="0;0;0" dur="1s" repeatCount="indefinite"/>
                    <animate attributeName="opacity"   values="0.5;0;0" dur="3s" repeatCount="indefinite"/>
                </circle>

                {{-- Center pin dot --}}
                <circle id="coverage-center" cx="50%" cy="50%" r="6"
                        fill="#22c55e" opacity="0.9" filter="url(#circleGlow)"/>
                <circle id="coverage-center-ring" cx="50%" cy="50%"
                        fill="none" stroke="#22c55e" stroke-width="1.5" opacity="0.5"/>

                {{-- "8 km service radius" label --}}
                <g id="coverage-label" opacity="0">
                    <rect id="lbl-bg" rx="6" ry="6" fill="rgba(0,20,10,0.75)" stroke="#22c55e" stroke-width="1"/>
                    <text id="lbl-text" fill="#4ade80" font-size="11" font-weight="700" font-family="system-ui,sans-serif"
                          text-anchor="middle">8 km service radius</text>
                </g>
            </svg>

            {{-- Address label overlay --}}
            <div style="position:absolute;top:16px;left:16px;background:rgba(0,0,0,.75);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);color:#fff;padding:.55rem 1rem;border-radius:10px;font-size:.8rem;line-height:1.4;border:1px solid rgba(255,255,255,.12);pointer-events:none;">
                <strong style="display:block;font-size:.85rem;margin-bottom:.15rem;">Cooling Kolkata</strong>
                <span style="color:rgba(255,255,255,.7);">3/87 C. R Colony, Jadavpur, Kolkata - 700032</span>
            </div>

            {{-- 8km badge --}}
            <div style="position:absolute;bottom:16px;left:16px;display:inline-flex;align-items:center;gap:.4rem;background:rgba(0,30,10,.8);backdrop-filter:blur(8px);border:1px solid rgba(34,197,94,.35);color:#4ade80;font-size:.75rem;font-weight:700;padding:.4rem .9rem;border-radius:999px;pointer-events:none;">
                <span style="width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 6px #22c55e;animation:mapDotPulse 2s infinite;flex-shrink:0;"></span>
                8 km service coverage
            </div>
        </div>

        <div class="coverage-tags" style="margin-top:1.25rem;">
            <span>Jadavpur</span><span>Garia</span><span>Dhakuria</span><span>Tollygunge</span><span>Ballygunge</span><span>Kasba</span>
        </div>
    </div>
</section>

<style>
@keyframes mapDotPulse {
    0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.6)}
    70%{box-shadow:0 0 0 6px rgba(34,197,94,0)}
}
</style>

<script>
(function() {
    /* ─────────────────────────────────────────────
       Calculate 8 km radius in SVG pixels and
       position all circle elements correctly.
       ──────────────────────────────────────────── */
    const LAT       = 22.486403;
    const ZOOM      = 12;
    const RADIUS_KM = 8;

    function computeRadiusPx(containerW) {
        // Pixels per degree longitude at this zoom (Mercator, constant across latitudes)
        const pxPerDegLng = (256 * Math.pow(2, ZOOM)) / 360;
        // 8 km in degrees longitude at this latitude
        const radiusDegLng = RADIUS_KM / (111.32 * Math.cos(LAT * Math.PI / 180));
        // Pixels in the tile coordinate space
        const radiusTilePx = radiusDegLng * pxPerDegLng;
        // Degrees visible in the container
        const degsVisible  = containerW / pxPerDegLng;
        // Scale radius to container pixels
        return (radiusDegLng / degsVisible) * containerW;
    }

    function updateCircle() {
        const svg    = document.getElementById('map-radius-svg');
        const shell  = svg.parentElement;
        const w      = shell.offsetWidth;
        const h      = shell.offsetHeight;
        const cx     = w / 2;
        const cy     = h / 2;
        const r      = computeRadiusPx(w);

        svg.setAttribute('viewBox', `0 0 ${w} ${h}`);

        ['coverage-fill','coverage-stroke','coverage-pulse'].forEach(id => {
            const el = document.getElementById(id);
            el.setAttribute('cx', cx);
            el.setAttribute('cy', cy);
            el.setAttribute('r',  r);
        });

        // Fix rotate transform origin for stroke animation
        const stroke = document.getElementById('coverage-stroke');
        stroke.setAttribute('transform-origin', `${cx} ${cy}`);

        // Center dot & ring
        ['coverage-center','coverage-center-ring'].forEach(id => {
            const el = document.getElementById(id);
            el.setAttribute('cx', cx);
            el.setAttribute('cy', cy);
        });
        document.getElementById('coverage-center-ring').setAttribute('r', 12);

        // Pulse ring initial r
        const pulse = document.getElementById('coverage-pulse');
        pulse.setAttribute('r', r);
        pulse.querySelector('animate[attributeName="r"]').setAttribute('values', `${r};${r*1.06};${r}`);

        // Label — positioned at top of circle
        const lblGrp  = document.getElementById('coverage-label');
        const lblBg   = document.getElementById('lbl-bg');
        const lblText = document.getElementById('lbl-text');
        const lblW = 140, lblH = 26;
        const lblX = cx - lblW / 2;
        const lblY = cy - r - lblH - 8;
        if (lblY > 10) {
            lblBg.setAttribute('x',      lblX);
            lblBg.setAttribute('y',      lblY);
            lblBg.setAttribute('width',  lblW);
            lblBg.setAttribute('height', lblH);
            lblText.setAttribute('x',    cx);
            lblText.setAttribute('y',    lblY + 17);
            lblGrp.setAttribute('opacity', '1');
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', updateCircle);
    } else {
        updateCircle();
    }
    window.addEventListener('resize', updateCircle);
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

