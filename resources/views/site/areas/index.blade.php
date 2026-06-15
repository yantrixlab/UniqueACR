@extends('site.layouts.app')
@section('title', 'AC Service Areas in South Kolkata | All Zones – Cooling Kolkata')
@section('meta_description', 'Cooling Kolkata provides onsite AC repair, installation & maintenance across South Kolkata — Jadavpur, Garia, Tollygunge, Behala, Kasba, Ballygunge & more. Check your area.')
@section('meta_keywords', 'AC service South Kolkata, AC repair near me Kolkata, AC service areas Kolkata, Cooling Kolkata service zones')
@section('og_title', 'AC Service Areas in South Kolkata | Cooling Kolkata')
@section('og_description', 'Find out if Cooling Kolkata covers your area. We serve 16+ localities across 4 zones in South & Central Kolkata.')
@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>route('home')],
        ['@type'=>'ListItem','position'=>2,'name'=>'Service Areas','item'=>route('areas.index')],
    ],
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endsection
@section('content')

@php
$zoneIcons = [
    'South Kolkata & Jadavpur Zone'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
    'South-East & EM Bypass Zone'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
    'Central-South & Tollygunge Zone'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
    'Science City & Bhawanipore Zone'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
];
$zoneColors = [
    'South Kolkata & Jadavpur Zone'   => '#1a4fa0',
    'South-East & EM Bypass Zone'     => '#0e6e5a',
    'Central-South & Tollygunge Zone' => '#7a2b9e',
    'Science City & Bhawanipore Zone' => '#b84d00',
];
$allAreas = $zones->flatten();
@endphp

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#06205a 0%,#0f458f 60%,#1a6dcc 100%);padding:129px 0 2.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2220%22 cy=%2220%22 r=%2240%22 fill=%22none%22 stroke=%22white%22 stroke-opacity=%220.04%22/><circle cx=%2280%22 cy=%2280%22 r=%2260%22 fill=%22none%22 stroke=%22white%22 stroke-opacity=%220.04%22/></svg>') no-repeat center/cover;pointer-events:none;"></div>
    <div class="container" style="position:relative;">
        <nav style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:rgba(255,255,255,.65);margin-bottom:1.5rem;">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,.65);">Home</a>
            <span>›</span>
            <span style="color:#fff;">Service Areas</span>
        </nav>

        <div style="display:flex;flex-wrap:wrap;gap:2rem;align-items:flex-end;justify-content:space-between;">
            <div>
                <span style="display:inline-block;background:rgba(255,255,255,.12);color:#fff;font-size:.78rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;padding:.35rem .9rem;border-radius:999px;margin-bottom:1rem;">{{ $allAreas->count() }} Localities · 4 Zones</span>
                <h1 style="color:#fff;font-size:clamp(1.6rem,4vw,2.6rem);line-height:1.2;margin:0 0 .75rem;">AC Service Areas in<br>South &amp; Central Kolkata</h1>
                <p style="color:rgba(255,255,255,.75);max-width:520px;font-size:1rem;margin:0;">Same-day onsite AC repair, installation &amp; maintenance. Find your locality below.</p>
            </div>
            <div style="display:flex;gap:2rem;">
                <div style="text-align:center;">
                    <div style="color:#fff;font-size:2rem;font-weight:700;">{{ $allAreas->count() }}+</div>
                    <div style="color:rgba(255,255,255,.6);font-size:.8rem;">Localities</div>
                </div>
                <div style="text-align:center;">
                    <div style="color:#fff;font-size:2rem;font-weight:700;">4</div>
                    <div style="color:rgba(255,255,255,.6);font-size:.8rem;">Zones</div>
                </div>
                <div style="text-align:center;">
                    <div style="color:#fff;font-size:2rem;font-weight:700;">8km</div>
                    <div style="color:rgba(255,255,255,.6);font-size:.8rem;">Coverage</div>
                </div>
            </div>
        </div>

        {{-- Search Bar --}}
        <div style="margin-top:2rem;position:relative;max-width:560px;">
            <div style="position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#6b7fa3;pointer-events:none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <input
                id="areaSearch"
                type="text"
                placeholder="Search locality, zone or PIN code…"
                autocomplete="off"
                style="width:100%;padding:.85rem 1rem .85rem 2.75rem;border:none;border-radius:12px;font-size:.95rem;background:#fff;color:#08285f;box-shadow:0 4px 24px rgba(0,0,0,.18);outline:none;"
                oninput="filterAreas(this.value)"
            >
            <div id="searchClear" onclick="clearSearch()" style="display:none;position:absolute;right:1rem;top:50%;transform:translateY(-50%);cursor:pointer;color:#6b7fa3;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </div>
        </div>

        {{-- Search Results Count --}}
        <p id="searchCount" style="display:none;color:rgba(255,255,255,.7);font-size:.85rem;margin-top:.75rem;"></p>
    </div>
</section>

{{-- Zone Filter Tabs --}}
<div style="background:var(--card);border-bottom:1px solid var(--line);position:sticky;top:72px;z-index:40;">
    <div class="container">
        <div style="display:flex;gap:0;overflow-x:auto;scrollbar-width:none;" id="zoneTabs">
            <button onclick="filterZone('all')" data-zone="all" class="zone-tab zone-tab-active" style="padding:.9rem 1.25rem;font-size:.85rem;font-weight:600;border:none;background:none;cursor:pointer;white-space:nowrap;border-bottom:2px solid var(--accent);color:var(--accent);">All Zones</button>
            @foreach($zones as $zoneName => $areas)
            <button onclick="filterZone('{{ Str::slug($zoneName) }}')" data-zone="{{ Str::slug($zoneName) }}" class="zone-tab" style="padding:.9rem 1.25rem;font-size:.85rem;font-weight:500;border:none;background:none;cursor:pointer;white-space:nowrap;border-bottom:2px solid transparent;color:var(--body);">{{ $zoneName }}</button>
            @endforeach
        </div>
    </div>
</div>

{{-- No Results Message --}}
<div id="noResults" style="display:none;text-align:center;padding:4rem 1rem;">
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#9aa5b8" stroke-width="1.5" stroke-linecap="round" style="margin-bottom:1rem;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <h3 style="color:var(--text);margin-bottom:.5rem;">No areas found</h3>
    <p style="color:var(--body);">Try a different locality name or PIN code.</p>
</div>

{{-- Zone Sections --}}
@foreach($zones as $zoneName => $zoneAreas)
@php $zoneSlug = Str::slug($zoneName); $color = $zoneColors[$zoneName] ?? '#062d67'; @endphp
<section class="zone-section" data-zone="{{ $zoneSlug }}" style="padding:2.5rem 0;">
    <div class="container">
        {{-- Zone Header --}}
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem;">
            <div style="width:36px;height:36px;border-radius:10px;background:{{ $color }}18;color:{{ $color }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                {!! $zoneIcons[$zoneName] ?? '' !!}
            </div>
            <div>
                <h2 style="font-size:1.1rem;font-weight:700;color:var(--text);margin:0 0 .1rem;">{{ $zoneName }}</h2>
                <p style="font-size:.8rem;color:var(--body);margin:0;">{{ $zoneAreas->count() }} {{ Str::plural('locality', $zoneAreas->count()) }}</p>
            </div>
            <div style="flex:1;height:1px;background:var(--line);margin-left:.5rem;"></div>
        </div>

        {{-- Area Cards --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1rem;">
            @foreach($zoneAreas as $area)
            <a href="{{ route('areas.show', $area->slug) }}"
               class="area-card"
               data-name="{{ strtolower($area->name) }}"
               data-pin="{{ strtolower($area->pinCodesDisplay()) }}"
               data-zone="{{ $zoneSlug }}"
               style="display:block;background:var(--card);border:1px solid var(--line);border-radius:14px;padding:1.25rem 1.4rem;text-decoration:none;transition:all .18s ease;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;width:3px;height:100%;background:{{ $color }};border-radius:3px 0 0 3px;"></div>
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:.5rem;">
                    <div style="flex:1;">
                        <h3 style="font-size:.95rem;font-weight:700;color:var(--text);margin:0 0 .35rem;line-height:1.3;">{{ $area->name }}</h3>
                        <div style="display:flex;align-items:center;gap:.4rem;margin-bottom:.5rem;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="{{ $color }}" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span style="font-size:.78rem;color:{{ $color }};font-weight:600;">{{ $area->pinCodesDisplay() }}</span>
                        </div>
                        <span style="font-size:.75rem;color:var(--body);">{{ $area->distance_km }} from base</span>
                    </div>
                    <div style="width:28px;height:28px;border-radius:50%;background:{{ $color }}12;color:{{ $color }};display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:.1rem;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </div>
                </div>
                <div style="margin-top:.85rem;padding-top:.75rem;border-top:1px solid var(--line);">
                    <span style="font-size:.75rem;color:var(--body);">Same-day service available</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endforeach

{{-- CTA --}}
<section style="background:linear-gradient(135deg,#06205a,#0f458f);padding:3rem 0;margin-top:1rem;">
    <div class="container" style="text-align:center;">
        <h2 style="color:#fff;font-size:1.6rem;margin-bottom:.75rem;">Don't See Your Area?</h2>
        <p style="color:rgba(255,255,255,.75);max-width:480px;margin:0 auto 1.75rem;">We may still reach you. Call us or WhatsApp and our team will confirm availability within minutes.</p>
        <div style="display:flex;gap:.75rem;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('contact') }}" style="background:#fff;color:#06205a;font-weight:700;padding:.75rem 1.75rem;border-radius:9px;font-size:.9rem;">Book Service</a>
            <a href="tel:+918346904100" style="background:rgba(255,255,255,.12);color:#fff;font-weight:600;padding:.75rem 1.75rem;border-radius:9px;font-size:.9rem;border:1px solid rgba(255,255,255,.25);">Call Now</a>
            <a href="https://wa.me/918346904100" target="_blank" rel="noopener" style="background:#25d366;color:#fff;font-weight:600;padding:.75rem 1.75rem;border-radius:9px;font-size:.9rem;">WhatsApp Us</a>
        </div>
    </div>
</section>

<style>
.area-card:hover {
    border-color: #0f458f !important;
    box-shadow: 0 4px 20px rgba(6,45,103,.1);
    transform: translateY(-2px);
}
.zone-tab:hover { color: var(--accent) !important; }
.zone-tab-active { border-bottom-color: var(--accent) !important; color: var(--accent) !important; }
#areaSearch:focus { box-shadow: 0 4px 28px rgba(0,0,0,.22), 0 0 0 3px rgba(255,255,255,.25) !important; }
@media(max-width:600px) {
    .area-card { border-radius: 11px !important; }
}
</style>

<script>
function filterAreas(query) {
    const q = query.trim().toLowerCase();
    const cards = document.querySelectorAll('.area-card');
    const sections = document.querySelectorAll('.zone-section');
    const clearBtn = document.getElementById('searchClear');
    const countEl = document.getElementById('searchCount');
    const noResults = document.getElementById('noResults');

    clearBtn.style.display = q ? 'block' : 'none';
    countEl.style.display = q ? 'block' : 'none';

    // Reset zone filter when searching
    if (q) setActiveTab('all');

    let visible = 0;
    cards.forEach(card => {
        const name = card.dataset.name || '';
        const pin = card.dataset.pin || '';
        const match = !q || name.includes(q) || pin.includes(q);
        card.style.display = match ? 'block' : 'none';
        if (match) visible++;
    });

    sections.forEach(section => {
        const anyVisible = [...section.querySelectorAll('.area-card')].some(c => c.style.display !== 'none');
        section.style.display = anyVisible ? 'block' : 'none';
    });

    countEl.textContent = visible + ' area' + (visible !== 1 ? 's' : '') + ' found';
    noResults.style.display = visible === 0 ? 'block' : 'none';
}

function clearSearch() {
    const input = document.getElementById('areaSearch');
    input.value = '';
    filterAreas('');
    input.focus();
}

function filterZone(zone) {
    const cards = document.querySelectorAll('.area-card');
    const sections = document.querySelectorAll('.zone-section');
    const searchInput = document.getElementById('areaSearch');
    searchInput.value = '';
    document.getElementById('searchClear').style.display = 'none';
    document.getElementById('searchCount').style.display = 'none';
    document.getElementById('noResults').style.display = 'none';

    setActiveTab(zone);

    sections.forEach(section => {
        section.style.display = (zone === 'all' || section.dataset.zone === zone) ? 'block' : 'none';
    });
    cards.forEach(card => { card.style.display = 'block'; });
}

function setActiveTab(zone) {
    document.querySelectorAll('.zone-tab').forEach(tab => {
        const isActive = tab.dataset.zone === zone;
        tab.style.borderBottomColor = isActive ? 'var(--accent)' : 'transparent';
        tab.style.color = isActive ? 'var(--accent)' : 'var(--body)';
        tab.style.fontWeight = isActive ? '600' : '500';
    });
}
</script>

@endsection
