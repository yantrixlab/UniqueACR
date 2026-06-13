<!doctype html>
<html lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Primary SEO --}}
    <title>@yield('title', 'AC Repair Kolkata | AC Service, Installation & Maintenance – Cooling Kolkata')</title>
    <meta name="description" content="@yield('meta_description', 'Expert AC repair in Kolkata – same-day AC servicing, installation & maintenance for Voltas, LG, Daikin & all brands. Certified technicians, transparent pricing. Call +91 8346904100.')">
    <meta name="keywords" content="@yield('meta_keywords', 'AC repair Kolkata, AC repair kolkata near me, voltas ac repair Kolkata, lg ac repair Kolkata, best ac repair Kolkata, AC service Kolkata, AC servicing Kolkata, AC installation Kolkata, AC maintenance Kolkata, AC repair service near me, AC servicing near me, ac servicing price, lg ac repair, ac repair in Kolkata, ac repair shop near me')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Cooling Kolkata">
    <meta name="geo.region" content="IN-WB">
    <meta name="geo.placename" content="Kolkata">
    <meta name="geo.position" content="22.4987;88.3714">
    <meta name="ICBM" content="22.4987, 88.3714">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Cooling Kolkata">
    <meta property="og:title" content="@yield('og_title', 'AC Repair Kolkata | AC Service, Installation & Maintenance – Cooling Kolkata')">
    <meta property="og:description" content="@yield('og_description', 'Expert AC repair in Kolkata – same-day AC servicing, installation & maintenance for Voltas, LG, Daikin & all brands. Certified technicians, transparent pricing. Call +91 8346904100.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('upload/web_image_res/home_hero_right.webp'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Cooling Kolkata – AC Repair & Servicing in Kolkata">
    <meta property="og:locale" content="en_IN">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'AC Repair Kolkata | AC Service, Installation & Maintenance – Cooling Kolkata')">
    <meta name="twitter:description" content="@yield('og_description', 'Expert AC repair in Kolkata – same-day AC servicing, installation & maintenance for Voltas, LG, Daikin & all brands.')">
    <meta name="twitter:image" content="@yield('og_image', asset('upload/web_image_res/home_hero_right.webp'))">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-title" content="Cooling Kolkata">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="/site/app.css">

    {{-- LocalBusiness + HVAC Structured Data --}}
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => ['LocalBusiness','HVACBusiness'],
                '@id'         => url('/').'#business',
                'name'        => 'Cooling Kolkata',
                'alternateName' => 'Cooling Kolkata',
                'description' => 'Professional AC repair, AC servicing, AC installation and AC maintenance in Kolkata. Certified technicians for Voltas, LG, Daikin, Samsung and all major brands.',
                'url'         => url('/'),
                'telephone'   => '+918346904100',
                'email'       => 'uniquerac24@gmail.com',
                'priceRange'  => '₹₹',
                'currenciesAccepted' => 'INR',
                'paymentAccepted'    => 'Cash, UPI, Net Banking',
                'areaServed'  => [
                    ['@type'=>'City','name'=>'Kolkata'],
                    ['@type'=>'AdministrativeArea','name'=>'West Bengal'],
                ],
                'address' => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => '3/87 C. R Colony, Jadavpur',
                    'addressLocality' => 'Kolkata',
                    'addressRegion'   => 'West Bengal',
                    'postalCode'      => '700032',
                    'addressCountry'  => 'IN',
                ],
                'geo' => ['@type'=>'GeoCoordinates','latitude'=>22.4987,'longitude'=>88.3714],
                'openingHoursSpecification' => [[
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                    'opens'     => '09:00',
                    'closes'    => '20:00',
                ]],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name'  => 'AC Services Kolkata',
                    'itemListElement' => [
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'AC Repair Kolkata']],
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'AC Servicing Kolkata']],
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'AC Installation Kolkata']],
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'AC Maintenance Kolkata']],
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'Voltas AC Repair Kolkata']],
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'LG AC Repair Kolkata']],
                    ],
                ],
                'sameAs' => ['https://wa.me/918346904100'],
            ],
            [
                '@type'  => 'WebSite',
                '@id'    => url('/').'#website',
                'url'    => url('/'),
                'name'   => 'Cooling Kolkata',
                'potentialAction' => [
                    '@type'       => 'SearchAction',
                    'target'      => url('/services').'?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ],
    ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>

    @yield('schema')
</head>
<body>
<header class="topbar">
    <div class="container nav-wrap">
        <button class="mob-menu-btn" id="mobMenuBtn" aria-label="Open menu" aria-expanded="false" aria-controls="mobSidePanel">
            <span class="mob-menu-bar"></span>
            <span class="mob-menu-bar"></span>
            <span class="mob-menu-bar"></span>
        </button>
        <a class="logo" href="{{ route('home') }}">Cooling Kolkata</a>
        <nav class="main-nav">
            <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Services</a>
            <a class="{{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
            <a class="{{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
            <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
            <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </nav>
        <div class="nav-actions">
            <a class="quote-btn" href="{{ route('contact') }}">Get Quote</a>
        </div>
    </div>
</header>

{{-- Mobile side panel --}}
<div class="mob-overlay" id="mobOverlay" aria-hidden="true"></div>
<aside class="mob-side-panel" id="mobSidePanel" aria-label="Mobile navigation" aria-hidden="true">
    <div class="mob-panel-header">
        <a class="logo" href="{{ route('home') }}">Cooling Kolkata</a>
        <button class="mob-close-btn" id="mobCloseBtn" aria-label="Close menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
    <nav class="mob-panel-nav">
        <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Home
        </a>
        <a class="{{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            Services
        </a>
        <a class="{{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            Products
        </a>
        <a class="{{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            Blog
        </a>
        <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
            About
        </a>
        <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.8a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            Contact
        </a>
    </nav>
    <div class="mob-panel-footer">
        <a class="quote-btn" href="{{ route('contact') }}">Get Quote</a>
    </div>
</aside>

<script>
(function () {
    var btn = document.getElementById('mobMenuBtn');
    var panel = document.getElementById('mobSidePanel');
    var overlay = document.getElementById('mobOverlay');
    var closeBtn = document.getElementById('mobCloseBtn');

    function openPanel() {
        panel.classList.add('open');
        overlay.classList.add('open');
        panel.setAttribute('aria-hidden', 'false');
        overlay.setAttribute('aria-hidden', 'false');
        btn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }
    function closePanel() {
        panel.classList.remove('open');
        overlay.classList.remove('open');
        panel.setAttribute('aria-hidden', 'true');
        overlay.setAttribute('aria-hidden', 'true');
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    btn.addEventListener('click', openPanel);
    closeBtn.addEventListener('click', closePanel);
    overlay.addEventListener('click', closePanel);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closePanel(); });
})();
</script>

@yield('content')

<div class="floating-stack">
    {{-- Call Button --}}
    <div class="float-wrap float-wrap-call">
        <span class="float-ripple"></span>
        <span class="float-ripple ripple-delay"></span>
        <a href="tel:+918346904100" class="float-btn float-call" aria-label="Call now">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.56 21 3 13.44 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2Z" fill="currentColor"/>
            </svg>
        </a>
    </div>

    {{-- WhatsApp Button --}}
    <div class="float-wrap float-wrap-wa">
        <span class="float-ripple"></span>
        <span class="float-ripple ripple-delay"></span>
        <a href="https://wa.me/918346904100" target="_blank" rel="noopener" class="float-btn float-wa" aria-label="WhatsApp">
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347Z"/>
                <path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.656 1.438 5.168L2 22l4.978-1.41A9.956 9.956 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2Zm0 18a7.95 7.95 0 0 1-4.076-1.117l-.292-.174-3.035.86.86-3.036-.19-.303A7.96 7.96 0 0 1 4 12c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8Z"/>
            </svg>
        </a>
    </div>
</div>

<footer class="footer">
    <div class="container footer-grid">
        <div>
            <h4>? Cooling Kolkata</h4>
            <p>Providing Kolkata with top-tier air conditioning and refrigeration services.</p>
            <p>3/87 C. R Colony, Jadavpur, Kolkata - 700032</p>
            <p>+91 8346904100<br>uniquerac24@gmail.com</p>
        </div>
        <div>
            <h5>Services</h5>
            <a href="{{ route('services.index', ['segment' => 'domestic']) }}">Domestic Services</a>
            <a href="{{ route('services.index', ['segment' => 'commercial']) }}">Commercial HVAC</a>
            <a href="{{ route('services.index') }}">Maintenance</a>
        </div>
        <div>
            <h5>Service Areas</h5>
            <a href="{{ route('areas.index') }}">All Areas</a>
            <a href="{{ route('areas.show', 'jadavpur') }}">Jadavpur</a>
            <a href="{{ route('areas.show', 'garia-patuli-baishnabghata') }}">Garia & Patuli</a>
            <a href="{{ route('areas.show', 'tollygunge-ranikuthi-netaji-nagar') }}">Tollygunge</a>
            <a href="{{ route('areas.show', 'gariahat-golpark-ballygunge') }}">Ballygunge</a>
            <a href="{{ route('areas.show', 'ruby-kasba-rajdanga-haltu') }}">Kasba & Ruby</a>
            <a href="{{ route('areas.show', 'behala') }}">Behala</a>
        </div>
        <div>
            <h5>Company</h5>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
            <a href="{{ route('terms') }}">Terms of Service</a>
            <a href="{{ route('contact') }}">Contact</a>
            <!-- <a href="{{ url('/admin/login') }}">Admin</a> -->
        </div>
    </div>
    <div class="copyright">© {{ date('Y') }} Cooling Kolkata. All rights reserved.</div>
</footer>

</body>
</html>


