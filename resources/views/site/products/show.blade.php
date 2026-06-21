@extends('site.layouts.app')
@section('title', ($product->meta_title ?: $product->name) . ' | Buy in Kolkata – Unique Aircon')
@section('meta_description', $product->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 155, '') ?: 'Buy ' . $product->name . ' in Kolkata from Unique Aircon. Genuine product, expert installation support. Call +91 8346904100.')
@section('og_title', ($product->meta_title ?: $product->name) . ' | Unique Aircon Kolkata')
@section('og_description', \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 160, '') ?: 'Buy ' . $product->name . ' in Kolkata. Genuine parts, expert installation. Unique Aircon.')
@section('og_image', !empty($product->images[0]) ? asset('storage/' . ltrim($product->images[0], '/')) : asset('upload/web_image_res/home_hero_right.webp'))
@section('schema')
<script type="application/ld+json">{!! json_encode(array_filter([
    '@context'    => 'https://schema.org',
    '@type'       => 'Product',
    'name'        => $product->name,
    'description' => strip_tags($product->description ?? ''),
    'brand'       => $product->brand ? ['@type' => 'Brand', 'name' => $product->brand] : null,
    'offers'      => [
        '@type'         => 'Offer',
        'price'         => $product->price > 0 ? (string)$product->price : '0',
        'priceCurrency' => 'INR',
        'availability'  => $product->in_stock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
        'seller'        => [
            '@type' => 'Organization',
            'name'  => 'Unique Aircon',
        ],
    ],
]), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
@endsection
@section('content')

@php
    $images = collect((array)($product->images ?: []))
        ->map(fn($p) => \Illuminate\Support\Str::startsWith($p, ['http://','https://','data:'])
            ? $p : asset('storage/' . ltrim($p, '/')))
        ->filter()->values()->all();
    if (empty($images)) {
        $images = ['https://images.unsplash.com/photo-1581275237725-2f7f9f89f4f2?q=80&w=1200&auto=format&fit=crop'];
    }
@endphp

<section class="pd-page">
    <div class="container pd-wrapper">

        {{-- Gallery --}}
        <div class="pd-gallery" id="pdGallery">
            <div class="pd-main-img-wrap">
                <img id="pdMainImg" src="{{ $images[0] }}" alt="{{ $product->name }}" loading="eager" title="Click to zoom">
            </div>
            @if(count($images) > 1)
                <div class="pd-thumbs">
                    @foreach($images as $i => $img)
                        <button type="button" class="pd-thumb {{ $i === 0 ? 'active' : '' }}" onclick="pdManualSwitch(this,'{{ $img }}',{{ $i }})">
                            <img src="{{ $img }}" alt="{{ $product->name }} view {{ $i + 1 }}" loading="lazy">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Zoom lightbox --}}
        <div id="pdZoomOverlay" onclick="pdZoomClose(event)">
            <button id="pdZoomCloseBtn" onclick="pdZoomHide()" aria-label="Close zoom">&times;</button>
            <img id="pdZoomImg" src="" alt="{{ $product->name }}">
        </div>

        {{-- Info --}}
        <div class="pd-info">

            {{-- Breadcrumb --}}
            <nav class="pd-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('products.index') }}">Products</a>
                @if($product->category)
                    <span>/</span><span>{{ $product->category->name }}</span>
                @endif
                <span>/</span><span class="pd-bc-current">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</span>
            </nav>

            {{-- Brand + badges --}}
            <div class="pd-meta-row">
                <span class="brand-chip">{{ $product->brand }}</span>
                @if($product->is_featured)
                    <span class="pd-badge featured">Featured</span>
                @endif
                <span class="pd-badge {{ $product->stock > 0 ? 'instock' : 'outstock' }}">
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="pd-title">{{ $product->name }}</h1>

            {{-- Price --}}
            <div class="pd-price-row">
                <span class="pd-price">₹{{ number_format($product->price, 0) }}</span>
                @if($product->discount_price)
                    <span class="pd-price-original">₹{{ number_format($product->discount_price, 0) }}</span>
                    @php
                        $saving = round((($product->discount_price - $product->price) / $product->discount_price) * 100);
                    @endphp
                    @if($saving > 0)
                        <span class="pd-saving">{{ $saving }}% off</span>
                    @endif
                @endif
            </div>

            {{-- Description --}}
            <div class="pd-description prose">
                {!! $product->description !!}
            </div>

            {{-- Specifications --}}
            @if(!empty($product->specifications))
                <div class="pd-specs">
                    <h3 class="pd-specs-title">Specifications</h3>
                    <dl class="pd-specs-grid">
                        @foreach((array)$product->specifications as $key => $value)
                            <dt>{{ ucfirst((string)$key) }}</dt>
                            <dd>{{ is_array($value) ? implode(', ', $value) : $value }}</dd>
                        @endforeach
                    </dl>
                </div>
            @endif

            {{-- CTAs --}}
            <div class="pd-cta-row">
                <a class="primary-btn" href="{{ route('contact') }}" data-track="product_enquiry_click" data-track-label="{{ $product->name }}">Enquire Now</a>
                <a class="secondary-btn" target="_blank" rel="noopener"
                   href="https://wa.me/918346904100?text={{ rawurlencode('I am interested in '.$product->name) }}"
                   data-track="product_whatsapp_click" data-track-label="{{ $product->name }}">
                    <svg viewBox="0 0 32 32" width="18" height="18" aria-hidden="true" style="vertical-align:middle;margin-right:5px"><path fill="#25D366" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/></svg>
                    WhatsApp
                </a>
            </div>

            {{-- Trust strip --}}
            <div class="pd-trust">
                <span>✓ Genuine Product</span>
                <span>✓ Expert Support</span>
                <span>✓ Fast Delivery</span>
            </div>
        </div>
    </div>
</section>

<style>
.pd-page { padding: 2.5rem 0 3rem; background: #f4f7fb; }
.pd-wrapper { display: grid; grid-template-columns: 480px 1fr; gap: 2.5rem; align-items: start; }

/* Gallery */
.pd-gallery { position: sticky; top: 90px; }
.pd-main-img-wrap {
    border-radius: 16px; overflow: hidden; background: #fff;
    border: 1px solid rgba(122,153,198,.25);
    box-shadow: 0 4px 24px rgba(60,100,180,.07);
}
.pd-main-img-wrap img { width: 100%; height: 400px; object-fit: contain; display: block; padding: 16px; }
.pd-thumbs { display: flex; gap: 8px; margin-top: 10px; flex-wrap: wrap; }
.pd-thumb {
    border: 2px solid rgba(122,153,198,.25); border-radius: 10px;
    overflow: hidden; cursor: pointer; background: #fff; padding: 0;
    width: 72px; height: 72px; transition: border-color .15s;
}
.pd-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
.pd-thumb.active, .pd-thumb:hover { border-color: var(--accent, #2563eb); }

/* Info */
.pd-info { display: flex; flex-direction: column; gap: 1.1rem; }
.pd-breadcrumb { display: flex; align-items: center; gap: 6px; font-size: .82rem; color: #7a99c6; flex-wrap: wrap; }
.pd-breadcrumb a { color: var(--accent, #2563eb); text-decoration: none; }
.pd-breadcrumb a:hover { text-decoration: underline; }
.pd-bc-current { color: #35557f; font-weight: 500; }

.pd-meta-row { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.pd-badge { font-size: .72rem; font-weight: 700; padding: 3px 10px; border-radius: 999px; letter-spacing: .03em; text-transform: uppercase; }
.pd-badge.featured { background: #fef3c7; color: #92400e; }
.pd-badge.instock { background: #dcfce7; color: #166534; }
.pd-badge.outstock { background: #fee2e2; color: #991b1b; }

.pd-title { font-size: 1.45rem; font-weight: 700; color: #1a2e4a; line-height: 1.35; margin: 0; }

.pd-price-row { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
.pd-price { font-size: 1.6rem; font-weight: 800; color: var(--accent, #2563eb); }
.pd-price-original { font-size: 1rem; color: #9fb3cc; text-decoration: line-through; }
.pd-saving { font-size: .8rem; font-weight: 700; background: #dcfce7; color: #166534; padding: 2px 10px; border-radius: 999px; }

/* Description prose */
.pd-description { font-size: .95rem; color: #4a6280; line-height: 1.75; }
.pd-description h2, .pd-description h3 { color: #1a2e4a; font-weight: 700; margin: 1rem 0 .4rem; }
.pd-description h2 { font-size: 1.1rem; }
.pd-description h3 { font-size: 1rem; }
.pd-description p { margin: 0 0 .6rem; }
.pd-description ul, .pd-description ol { padding-left: 1.4rem; margin: .4rem 0 .8rem; }
.pd-description li { margin-bottom: .3rem; }
.pd-description strong { color: #1a2e4a; font-weight: 600; }
.pd-description a { color: var(--accent, #2563eb); }
.pd-description blockquote { border-left: 3px solid var(--accent,#2563eb); margin: .8rem 0; padding: .4rem 1rem; background: #f0f5ff; border-radius: 0 8px 8px 0; color: #35557f; }

/* Specs */
.pd-specs { background: #fff; border: 1px solid rgba(122,153,198,.2); border-radius: 12px; padding: 1.1rem 1.3rem; }
.pd-specs-title { font-size: .9rem; font-weight: 700; color: #1a2e4a; margin: 0 0 .8rem; text-transform: uppercase; letter-spacing: .05em; }
.pd-specs-grid { display: grid; grid-template-columns: auto 1fr; gap: .4rem 1.2rem; margin: 0; }
.pd-specs-grid dt { font-weight: 600; color: #35557f; font-size: .88rem; white-space: nowrap; }
.pd-specs-grid dd { color: #4a6280; font-size: .88rem; margin: 0; }

/* CTA */
.pd-cta-row { display: flex; gap: 12px; flex-wrap: wrap; }
.pd-cta-row .primary-btn, .pd-cta-row .secondary-btn { min-width: 150px; text-align: center; }

/* Trust */
.pd-trust { display: flex; gap: 16px; flex-wrap: wrap; font-size: .82rem; color: #5d7295; padding-top: .4rem; border-top: 1px solid rgba(122,153,198,.18); }
.pd-trust span { display: flex; align-items: center; gap: 4px; }

/* Zoom lightbox */
#pdZoomOverlay {
    display: none; position: fixed; inset: 0; z-index: 1200;
    background: rgba(0,0,0,.88); align-items: center; justify-content: center;
    cursor: zoom-out; animation: pdFadeIn .18s ease;
}
#pdZoomOverlay.open { display: flex; }
#pdZoomOverlay img {
    max-width: 90vw; max-height: 90vh; object-fit: contain;
    border-radius: 10px; box-shadow: 0 12px 60px rgba(0,0,0,.6);
    cursor: default;
}
#pdZoomCloseBtn {
    position: absolute; top: 16px; right: 20px; font-size: 2.2rem;
    line-height: 1; color: #fff; background: none; border: none;
    cursor: pointer; opacity: .8; transition: opacity .15s;
}
#pdZoomCloseBtn:hover { opacity: 1; }
#pdMainImg { cursor: zoom-in; }
@keyframes pdFadeIn { from { opacity: 0; } to { opacity: 1; } }

/* Responsive */
@media (max-width: 900px) {
    .pd-wrapper { grid-template-columns: 1fr; }
    .pd-gallery { position: static; }
    .pd-main-img-wrap img { height: 300px; }
    .pd-title { font-size: 1.2rem; }
}
</style>

<script>
(function () {
    var thumbs = Array.from(document.querySelectorAll('.pd-thumb'));
    var mainImg = document.getElementById('pdMainImg');
    var gallery = document.getElementById('pdGallery');
    var currentIdx = 0;
    var timer = null;
    var INTERVAL = 5000;

    function pdSwitch(idx) {
        if (!thumbs.length) return;
        idx = ((idx % thumbs.length) + thumbs.length) % thumbs.length;
        currentIdx = idx;
        var btn = thumbs[idx];
        mainImg.src = btn.querySelector('img').src;
        thumbs.forEach(function (t) { t.classList.remove('active'); });
        btn.classList.add('active');
    }

    window.pdManualSwitch = function (btn, src, idx) {
        clearInterval(timer);
        pdSwitch(idx);
        startTimer();
    };

    function startTimer() {
        if (thumbs.length < 2) return;
        timer = setInterval(function () { pdSwitch(currentIdx + 1); }, INTERVAL);
    }

    if (gallery) {
        gallery.addEventListener('mouseenter', function () { clearInterval(timer); });
        gallery.addEventListener('mouseleave', startTimer);
    }

    startTimer();

    // Zoom lightbox
    var overlay = document.getElementById('pdZoomOverlay');
    var zoomImg = document.getElementById('pdZoomImg');

    mainImg.addEventListener('click', function () {
        zoomImg.src = mainImg.src;
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    });

    window.pdZoomClose = function (e) {
        if (e.target === overlay) pdZoomHide();
    };
    window.pdZoomHide = function () {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    };
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') pdZoomHide();
    });

    if (typeof gtag === 'function') {
        gtag('event', 'view_item', {
            label: @json($product->name),
            category: 'product',
        });
    }
})();
</script>

@if($relatedProducts->isNotEmpty())
@php $categoryType = $product->category?->type ?? 'ac_products'; @endphp
<section class="section pd-related-section">
    <div class="container">
        <h2 class="pd-related-title">
            {{ $categoryType === 'spare_parts' ? 'Other Spare Parts' : 'Other AC Products' }}
        </h2>
        <div class="pd-related-grid">
            @foreach($relatedProducts as $rel)
            @php
                $relImg = !empty($rel->images[0])
                    ? asset('storage/' . ltrim($rel->images[0], '/'))
                    : null;
                $relPrice = (float)$rel->price > 0 ? '₹' . number_format((float)$rel->price, 0) : 'Custom';
            @endphp
            <a class="pd-related-card" href="{{ route('products.show', $rel->slug) }}" data-track="select_product" data-track-label="{{ $rel->name }} (Related)">
                <div class="pd-related-img">
                    @if($relImg)
                        <img src="{{ $relImg }}" alt="{{ $rel->name }}" loading="lazy">
                    @else
                        <div class="pd-related-placeholder">
                            <svg viewBox="0 0 120 80" aria-hidden="true"><rect x="10" y="20" width="100" height="40" rx="8" fill="#3c7cc0"/><rect x="20" y="32" width="80" height="16" rx="8" fill="#8ec3f5"/><circle cx="95" cy="28" r="6" fill="#1a4e8a"/></svg>
                        </div>
                    @endif
                </div>
                <div class="pd-related-body">
                    @if($rel->brand)
                        <span class="brand-chip">{{ $rel->brand }}</span>
                    @endif
                    <h3>{{ $rel->name }}</h3>
                    <p class="pd-related-price">{{ $relPrice }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => strip_tags($product->meta_description ?: $product->description),
    'brand' => ['@type' => 'Brand', 'name' => $product->brand],
    'offers' => [
        '@type' => 'Offer',
        'priceCurrency' => 'INR',
        'price' => (float) $product->price,
        'availability' => $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
    ],
]) !!}
</script>
@endsection

