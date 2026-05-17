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
    <link rel="stylesheet" href="{{ asset('site/app.css') }}">
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
            <button id="themeToggle" class="ghost-btn theme-icon-btn" type="button" aria-label="Toggle theme">
                <span class="theme-icon sun" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="4.3" stroke="currentColor" stroke-width="1.8"/><path d="M12 2.8v2.3M12 18.9v2.3M21.2 12h-2.3M5.1 12H2.8M18.5 5.5l-1.6 1.6M7.1 16.9l-1.6 1.6M18.5 18.5l-1.6-1.6M7.1 7.1 5.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </span>
                <span class="theme-icon moon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M20 14.5A8.5 8.5 0 1 1 9.5 4a7 7 0 1 0 10.5 10.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                </span>
            </button>
            <a class="quote-btn" href="{{ route('contact') }}">Get Quote</a>
        </div>
    </div>
</header>

@yield('content')

<div class="floating-stack">
    <a href="tel:+918346904100" class="float-btn float-call" aria-label="Call now">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5.2 4.8c.5-.5 1.3-.5 1.8 0l2.1 2.1c.5.5.5 1.3 0 1.8l-1 1c.8 1.6 2.1 3 3.7 3.8l1-1c.5-.5 1.3-.5 1.8 0l2.1 2.1c.5.5.5 1.3 0 1.8l-1 1a3 3 0 0 1-3.1.7c-2.8-1-5.3-3-7.2-5.6-1.9-2.6-2.9-5.4-2.9-8.1a3 3 0 0 1 .9-2.2l.8-.8Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
    <a href="https://wa.me/918346904100" target="_blank" rel="noopener" class="float-btn float-wa" aria-label="WhatsApp">
        <svg viewBox="0 0 32 32" aria-hidden="true">
            <path fill="currentColor" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/>
            <path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/>
        </svg>
    </a>
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
            <a href="{{ url('/admin/login') }}">Admin</a>
        </div>
    </div>
    <div class="copyright">© {{ date('Y') }} Unique Air Conditioning & Refrigeration. All rights reserved.</div>
</footer>

<script>
const k='site_theme';const d=localStorage.getItem(k)||'light';document.documentElement.setAttribute('data-theme',d);document.getElementById('themeToggle').onclick=()=>{const n=document.documentElement.getAttribute('data-theme')==='light'?'dark':'light';document.documentElement.setAttribute('data-theme',n);localStorage.setItem(k,n);};
</script>
</body>
</html>
