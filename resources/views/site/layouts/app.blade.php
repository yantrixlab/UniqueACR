<!doctype html>
<html lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Unique Air Conditioning & Refrigeration')</title>
    <meta name="description" content="AC service Kolkata, AC repair Jadavpur, AC installation near me.">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Unique Air Conditioning & Refrigeration')">
    <meta property="og:description" content="AC service Kolkata, AC repair Jadavpur, AC installation near me.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="/site/app.css">
    <script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org','@type' => 'LocalBusiness','name' => 'Unique Air Conditioning & Refrigeration','address' => ['@type' => 'PostalAddress','streetAddress' => '3/87 C. R Colony, Jadavpur','addressLocality' => 'Kolkata','addressRegion' => 'West Bengal','postalCode' => '700032','addressCountry' => 'IN'],'telephone' => '+918346904100','email' => 'uniquerac24@gmail.com']) !!}</script>
</head>
<body>
<header class="topbar">
    <div class="container nav-wrap">
        <a class="logo" href="{{ route('home') }}"><span class="logo-mark">?</span> Unique Air</a>
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
            <h4>? Unique Air</h4>
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
            <h5>Company</h5>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
            <a href="{{ route('terms') }}">Terms of Service</a>
            <a href="{{ route('contact') }}">Contact</a>
            <!-- <a href="{{ url('/admin/login') }}">Admin</a> -->
        </div>
    </div>
    <div class="copyright">© {{ date('Y') }} Unique Air Conditioning & Refrigeration. All rights reserved.</div>
</footer>

</body>
</html>
