@extends('site.layouts.app')
@section('title','Contact Us | AC Repair & Service Booking Kolkata – Unique Air')
@section('meta_description','Contact Unique Air for AC repair, servicing, installation & AMC in Kolkata. Call +91 8346904100 or WhatsApp for same-day AC service near you.')
@section('meta_keywords','contact AC repair Kolkata, AC service booking Kolkata, AC repair phone number Kolkata, book AC service Kolkata, AC servicing near me contact number')
@section('og_title','Contact Unique Air | Book AC Repair & Service in Kolkata')
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
            <span>AC repair Jadavpur</span>
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
                <p>Mon-Sat: 8:00 AM - 9:30 PM<br>Emergency: 24/7</p>
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
                title="Unique Air Conditioning & Refrigeration Location"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q=22.486403,88.375548&z=16&output=embed"></iframe>
        </div>
        <div class="coverage-tags">
            <span>Jadavpur</span><span>Garia</span><span>Dhakuria</span><span>Tollygunge</span><span>Ballygunge</span><span>Kasba</span>
        </div>
    </div>
</section>

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
                <p><strong>Monday - Saturday:</strong> 8:00 AM - 9:30 PM</p>
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
    'name' => 'Unique Air Conditioning & Refrigeration',
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
