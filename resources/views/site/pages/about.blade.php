@extends('site.layouts.app')
@section('title','About Unique Aircon | Trusted AC Repair & Service Company in Kolkata')
@section('meta_description','Learn about Unique Aircon – 7+ years of trusted AC repair, servicing & installation in Kolkata. Certified technicians, genuine parts, transparent pricing.')
@section('meta_keywords','about Unique Aircon, AC repair company Kolkata, best AC service company Kolkata, AC technician Kolkata, trusted AC repair Kolkata')
@section('og_title','About Unique Aircon | Trusted AC Repair Company in Kolkata')
@section('og_description','7+ years of expert AC repair, servicing & installation in Kolkata. Meet the certified team behind Unique Aircon.')
@section('schema')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Do you provide same-day AC service in Kolkata?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, Unique Aircon provides same-day AC service in Kolkata subject to technician slot availability in your service area. Book via call or WhatsApp for fastest response."
            }
        },
        {
            "@type": "Question",
            "name": "Which AC brands does Unique Aircon support?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Unique Aircon supports most leading AC brands including Daikin, Voltas, LG, OGeneral, Samsung, Blue Star, Hitachi, Lloyd, and Carrier — covering both split and window AC units."
            }
        },
        {
            "@type": "Question",
            "name": "Does Unique Aircon handle commercial HVAC systems?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, we support all commercial HVAC systems including VRV/VRF, ductable, chiller, cassette, and packaged solutions for offices, malls, hospitals, and large commercial buildings."
            }
        },
        {
            "@type": "Question",
            "name": "Does Unique Aircon provide AMC services?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, Unique Aircon offers customized Annual Maintenance Contract (AMC) plans for both residential homes and commercial businesses, ensuring year-round AC performance and priority service."
            }
        },
        {
            "@type": "Question",
            "name": "Which areas in Kolkata does Unique Aircon cover?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We cover Jadavpur and all nearby South Kolkata zones including Tollygunge, Garia, Behala, Kasba, Ballygunge, Dhakuria with rapid response coverage."
            }
        }
    ]
}
</script>
@endverbatim
@endsection
@section('content')
<section class="about-hero">
    <div class="about-glow a"></div><div class="about-glow b"></div>
    <div class="container about-hero-grid">
        <div>
            <span class="pill">Trusted AC Experts in Kolkata</span>
            <h1>Delivering Reliable Cooling Solutions Across Kolkata</h1>
            <p>From domestic AC repair to advanced commercial HVAC systems, we provide professional installation, maintenance, and cooling solutions with expert technicians and genuine spare parts.</p>
            <div class="cta-row">
                <a class="primary-btn" href="{{ route('contact') }}">Book AC Service</a>
                <a class="secondary-btn" href="{{ route('services.index') }}">Explore Services</a>
            </div>
        </div>
        <div class="about-scene" aria-hidden="true">
            <div class="about-ac"></div>
            <div class="about-air a"></div><div class="about-air b"></div><div class="about-air c"></div>
            <div class="about-ui one">Cooling Stable</div>
            <div class="about-ui two">Diagnostics Active</div>
            <div class="about-tech"></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container intro-grid">
        <div>
            <h2>Built on Trust, Precision & Service Quality</h2>
            <p class="sub">Unique Aircon, based at 3/87 C. R Colony, Jadavpur, Kolkata 700032, has served homes and businesses with dependable cooling support focused on speed, transparency, and long-term performance.</p>
            <p class="sub">Our customer-first process combines clear diagnostics, genuine parts, and skilled workmanship to deliver reliable outcomes for both domestic and commercial clients.</p>
        </div>
        <div class="intro-counters">
            <article><h3>7+</h3><p>Years Experience</p></article>
            <article><h3>185+</h3><p>Happy Customers</p></article>
            <article><h3>16+</h3><p>Commercial Projects</p></article>
            <article><h3>24X7</h3><p>Emergency Support</p></article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container mission-grid">
        <article class="glass-card mission-card">
            <div class="info-icon info-icon-lg" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none"><path d="M12 3v3m0 12v3m9-9h-3M6 12H3m14.5-6.5-2.1 2.1m-6.8 6.8-2.1 2.1m10.9 0-2.1-2.1m-6.8-6.8-2.1-2.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="1.8" fill="currentColor"/></svg>
            </div>
            <h3>Mission</h3>
            <p>Provide fast, affordable, and professional cooling solutions with reliable after-service support.</p>
            <ul>
                <li>Transparent diagnostics and pricing</li>
                <li>Quick turnaround with quality workmanship</li>
            </ul>
        </article>
        <article class="glass-card mission-card">
            <div class="info-icon info-icon-lg" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none"><path d="M14.5 4.5c2.5-.6 4.6 1.5 4 4L13 14l-3 1 1-3 5.5-5.5ZM10 14l-3.5 3.5M5.5 13l1.5-1.5M9 17.5 10.5 16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <h3>Vision</h3>
            <p>Become the most trusted AC servicing and HVAC solutions company in Kolkata.</p>
            <ul>
                <li>Service excellence across residential and commercial projects</li>
                <li>Technology-led, customer-first HVAC support</li>
            </ul>
        </article>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Why Choose Us</h2>
        <div class="why-grid">
            <article class="why-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M14 7.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM4 20a6 6 0 0 1 12 0M17.5 11l2.5 2.5-3.5 3.5-2.5-2.5L17.5 11Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="why-content">
                    <h4>Certified Technicians</h4>
                    <p>Trained experts for accurate diagnosis and safe execution.</p>
                </div>
            </article>
            <article class="why-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M9 4h6v4a2 2 0 1 1 0 4v8H9v-8a2 2 0 1 1 0-4V4Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="why-content">
                    <h4>Genuine Spare Parts</h4>
                    <p>Authentic components for reliability and longer equipment life.</p>
                </div>
            </article>
            <article class="why-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="m13 3-7 10h5l-1 8 8-11h-5l0-7Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="why-content">
                    <h4>Same Day Service</h4>
                    <p>Rapid dispatch and priority scheduling in major Kolkata zones.</p>
                </div>
            </article>
            <article class="why-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M6 7h12M6 11h10M9 5c2 0 4 1.5 4 3.5S11 12 9 12h0l6 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="why-content">
                    <h4>Affordable Pricing</h4>
                    <p>Clear estimates with competitive rates and no hidden charges.</p>
                </div>
            </article>
            <article class="why-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M3 21h18M5 21V6a1 1 0 0 1 1-1h4v16M11 21V10a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v11M8 9h.01M8 12h.01M14 13h.01M17 13h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </div>
                <div class="why-content">
                    <h4>Commercial HVAC Expertise</h4>
                    <p>Scalable support for offices, retail, and industrial setups.</p>
                </div>
            </article>
            <article class="why-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M5 17h14M7 17v-4a5 5 0 1 1 10 0v4M10 20h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </div>
                <div class="why-content">
                    <h4>24/7 Customer Support</h4>
                    <p>Always-on assistance for emergencies and follow-up queries.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Our Growth Timeline</h2>
        <div class="timeline">
            <div><span>2010</span><p>Launched residential AC service operations in South Kolkata.</p></div>
            <div><span>2015</span><p>Expanded into commercial HVAC installation and maintenance.</p></div>
            <div><span>2020</span><p>Built dedicated rapid-response support and AMC workflows.</p></div>
            <div><span>2026</span><p>Serving Kolkata with premium, tech-enabled cooling solutions.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Service Expertise</h2>
        <div class="expert-grid">
            <article class="info-card">
                <div class="info-icon">🏠</div>
                <h3>Domestic Services</h3>
                <p>Home-focused cooling care for apartments, villas, and residential complexes.</p>
                <ul>
                    <li>Split AC, Window AC, Tower AC</li>
                    <li>Cassette AC, Panel AC</li>
                    <li>Installation, Repair, Maintenance</li>
                </ul>
            </article>
            <article class="info-card">
                <div class="info-icon">🏢</div>
                <h3>Commercial Services</h3>
                <p>Performance-driven HVAC support for offices, retail, and industrial operations.</p>
                <ul>
                    <li>VRV / VRF, Ductable, Packaged</li>
                    <li>Chiller & Commercial Panel AC</li>
                    <li>AMC, Preventive Maintenance, Support</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="section split-solution">
    <div class="container split-sol-grid">
        <article class="info-card">
            <div class="info-icon">❄️</div>
            <h3>Domestic Cooling Solutions</h3>
            <p>Efficient, clean, and comfort-focused solutions for homes and apartments.</p>
            <ul>
                <li>Noise-optimized operation</li>
                <li>Energy-efficient setup advice</li>
                <li>Rapid breakdown support</li>
            </ul>
        </article>
        <article class="info-card">
            <div class="info-icon">🧊</div>
            <h3>Commercial HVAC Systems</h3>
            <p>Scalable performance for offices, retail, and industrial environments.</p>
            <ul>
                <li>Airflow balancing and zoning</li>
                <li>Load-driven optimization</li>
                <li>Planned uptime maintenance</li>
            </ul>
        </article>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Our Technician Team</h2>
        <div class="team-grid">
            <article class="info-card team-card">
                <div class="info-icon">👨‍🔧</div>
                <h4>Senior Service Engineer</h4>
                <p>8+ Years • Inverter AC Specialist</p>
                <ul>
                    <li>Advanced fault diagnostics</li>
                    <li>PCB and cooling performance checks</li>
                </ul>
            </article>
            <article class="info-card team-card">
                <div class="info-icon">🛠️</div>
                <h4>HVAC Installation Lead</h4>
                <p>10+ Years • Commercial Projects</p>
                <ul>
                    <li>VRV / VRF commissioning</li>
                    <li>Project execution and QA compliance</li>
                </ul>
            </article>
            <article class="info-card team-card">
                <div class="info-icon">✅</div>
                <h4>Maintenance Expert</h4>
                <p>6+ Years • AMC & Preventive Care</p>
                <ul>
                    <li>Planned service schedules</li>
                    <li>Lifecycle optimization support</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container trust-badges">
        <h2>Certifications & Trust Badges</h2>
        <div class="badge-grid"><span>Verified Technicians</span><span>Genuine Parts Assurance</span><span>Quality Service Standard</span><span>Service Guarantee</span></div>
    </div>
</section>

<section class="section stats-band">
    <div class="container stats-grid">
        <article><h3>5000+</h3><p>Happy Customers</p></article>
        <article><h3>15+</h3><p>Years Experience</p></article>
        <article><h3>24/7</h3><p>Support</p></article>
        <article><h3>1000+</h3><p>Commercial Projects</p></article>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>What Customers Say</h2>
        <div class="test-grid">
            <article class="test-card"><div class="stars">★★★★★</div><p>Very professional and transparent pricing. Great experience.</p><strong>— Amitabha S.</strong></article>
            <article class="test-card"><div class="stars">★★★★★</div><p>Quick same-day service with genuine parts and clean work.</p><strong>— Priya K.</strong></article>
            <article class="test-card"><div class="stars">★★★★★</div><p>Excellent commercial AC support for our office floor.</p><strong>— Rahul D.</strong></article>
        </div>
    </div>
</section>

<section class="section areas-zone">
    <div class="container">
        <h2>Service Areas</h2>
        <p class="sub">Kolkata • Jadavpur • South Kolkata • Garia • Tollygunge • Kasba • Dhakuria</p>
        <div class="coverage-tags">
            <span>Kolkata</span><span>Jadavpur</span><span>South Kolkata</span><span>Garia</span><span>Tollygunge</span><span>Kasba</span><span>Dhakuria</span>
        </div>
    </div>
</section>

<section class="section about-cta">
    <div class="container cta-panel">
        <h2>Need Professional AC Service in Kolkata?</h2>
        <div class="quick-actions">
            <a class="primary-btn" href="tel:+918346904100">Call Now</a>
            <a class="secondary-btn" href="{{ route('contact') }}">Book Inspection</a>
            <a class="ghost-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Us</a>
        </div>
    </div>
</section>

<section class="section faq-zone">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-list">
            <details><summary>Do you provide same-day service?</summary><p>Yes, subject to slot availability in your service area.</p></details>
            <details><summary>Which AC brands do you support?</summary><p>Most leading brands including Daikin, Voltas, OGeneral, and others.</p></details>
            <details><summary>Do you handle commercial HVAC systems?</summary><p>Yes, we support VRV/VRF, ductable, chiller, and packaged solutions.</p></details>
            <details><summary>Do you provide AMC services?</summary><p>Yes, customized AMC plans are available for homes and businesses.</p></details>
            <details><summary>Which areas do you cover?</summary><p>Jadavpur and nearby South Kolkata zones with rapid response coverage.</p></details>
        </div>
    </div>
</section>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => 'Unique Aircon',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '3/87 C. R Colony, Jadavpur',
        'addressLocality' => 'Kolkata',
        'addressRegion' => 'West Bengal',
        'postalCode' => '700032',
        'addressCountry' => 'IN',
    ],
    'telephone' => '+918346904100',
    'areaServed' => ['Kolkata','Jadavpur','South Kolkata'],
]) !!}
</script>
@endsection


