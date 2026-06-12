@extends('site.layouts.app')
@section('title','AC Products & Spare Parts in Kolkata | Cooling Kolkata')
@section('meta_description','Buy genuine AC products & spare parts in Kolkata – Voltas, LG, Daikin, Samsung & all brands. Authorized dealer with installation support. Call +91 8346904100.')
@section('meta_keywords','AC products Kolkata, AC spare parts Kolkata, split AC price Kolkata, voltas AC Kolkata, LG AC Kolkata, Daikin AC Kolkata, buy AC Kolkata')
@section('og_title','AC Products & Spare Parts in Kolkata | Cooling Kolkata')
@section('og_description','Genuine AC products & spare parts from top brands in Kolkata. Voltas, LG, Daikin, Samsung & more. Expert installation included.')
@section('content')
<section class="products-hero premium-products-hero">
    <div class="pp-glow one"></div><div class="pp-glow two"></div>
    <div class="container pp-hero-grid">
        <div>
            <span class="pill"><span class="svc-badge-dot"></span>Premium AC Products in Kolkata</span>
            <h1>AC Products & Spare Parts</h1>
            <p>Best AC products in Kolkata | Daikin, Voltas, OGeneral. Discover verified units, genuine components, and expert support from installation to after-sales service.</p>
            <div class="cta-row">
                <a class="primary-btn" href="#product-enquiry">Enquire Now</a>
                <a class="secondary-btn" href="#products-catalog">Explore Catalog</a>
            </div>
        </div>
        <div class="pp-hero-visual" aria-hidden="true">
            <div class="pp-icon-cloud">
                <span class="pp-icon-chip ac" title="AC Unit">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="6" width="18" height="10" rx="2"/><path d="M6 12h12" /><circle cx="18" cy="10" r="1.5"/></svg>
                </span>
                <span class="pp-icon-chip fan" title="Cooling Fan">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="2"/><path d="M12 4c3 0 4 2 3 4-1 2-3 2-4 1-1-1-1-3 1-5Z"/><path d="M20 12c0 3-2 4-4 3-2-1-2-3-1-4 1-1 3-1 5 1Z"/><path d="M12 20c-3 0-4-2-3-4 1-2 3-2 4-1 1 1 1 3-1 5Z"/><path d="M4 12c0-3 2-4 4-3 2 1 2 3 1 4-1 1-3 1-5-1Z"/></svg>
                </span>
                <span class="pp-icon-chip tool" title="Service Toolkit">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 8h16v10H4z"/><path d="M9 8V6h6v2"/><path d="M4 13h16"/></svg>
                </span>
                <span class="pp-icon-chip comp" title="Compressor">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="5" width="14" height="14" rx="3"/><circle cx="12" cy="12" r="3.5"/></svg>
                </span>
            </div>
            <article class="pp-float-card main"><span>Inverter AC</span><strong>Energy Efficient</strong></article>
            <article class="pp-float-card sub"><span>Same Day Delivery</span><strong>Kolkata Coverage</strong></article>
            <article class="pp-float-card badge"><span>Warranty</span><strong>Authorised Support</strong></article>
        </div>
    </div>
</section>

<section class="section pp-quick-search-section">
    <div class="container">
        <form method="GET" action="{{ route('products.index') }}" class="pp-quick-search-form" role="search" aria-label="Search products">
            <label for="quickProductSearch">Search Products</label>
            <div class="pp-quick-search-row">
                <input
                    id="quickProductSearch"
                    type="search"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Search AC by name, brand, or model"
                    autocomplete="off"
                >
                @if(!empty($filters['brand']))
                    <input type="hidden" name="brand" value="{{ $filters['brand'] }}">
                @endif
                @if(!empty($filters['category_id']))
                    <input type="hidden" name="category_id" value="{{ $filters['category_id'] }}">
                @endif
                @if(!empty($filters['min_price']))
                    <input type="hidden" name="min_price" value="{{ $filters['min_price'] }}">
                @endif
                @if(!empty($filters['max_price']))
                    <input type="hidden" name="max_price" value="{{ $filters['max_price'] }}">
                @endif
                @if(!empty($filters['sort']))
                    <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
                @endif
                <button type="submit" class="primary-btn">Search</button>
            </div>
        </form>
    </div>
</section>

<section class="section pp-trust-strip">
    <div class="container pp-trust-grid">
        <article><h3>15+ Years</h3><p>AC industry experience</p></article>
        <article><h3>5000+</h3><p>Happy customers</p></article>
        <article><h3>3+ Brands</h3><p>Daikin, Voltas, OGeneral</p></article>
        <article><h3>Fast Service</h3><p>Installation & support</p></article>
        <article><h3>Warranty</h3><p>Genuine products assurance</p></article>
    </div>
</section>


<section class="section products-listing-section" id="products-catalog">
    <div class="products-layout" style="max-width:100%;padding:0 40px;">
        <aside class="products-filters" id="filtersDrawer">
            <div class="filters-head">
                <h3>Filters</h3>
                <button type="button" class="ghost-btn filters-close" id="closeFilters">Close</button>
            </div>
            <form method="GET" action="{{ route('products.index') }}" id="productsFilterForm" class="filters-form">
                <label>Search Product
                    <input type="search" name="search" value="{{ $filters['search'] }}" placeholder="Search by name">
                </label>
                <label>Brand
                    <select name="brand">
                        <option value="">All Brands</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand }}" @selected($filters['brand'] === $brand)>{{ $brand }}</option>
                        @endforeach
                    </select>
                </label>
                <label>Category
                    <select name="category_id">
                        <option value="">All Categories</option>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" @selected((string)$filters['category_id'] === (string)$id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="price-range-grid">
                    <label>Min Price
                        <input type="number" name="min_price" min="{{ (int) $minPrice }}" value="{{ $filters['min_price'] }}" placeholder="{{ (int) $minPrice }}">
                    </label>
                    <label>Max Price
                        <input type="number" name="max_price" max="{{ (int) $maxPrice }}" value="{{ $filters['max_price'] }}" placeholder="{{ (int) $maxPrice }}">
                    </label>
                </div>
                <label>Sort By
                    <select name="sort">
                        <option value="latest" @selected($filters['sort'] === 'latest')>Latest</option>
                        <option value="featured" @selected($filters['sort'] === 'featured')>Featured</option>
                        <option value="price_asc" @selected($filters['sort'] === 'price_asc')>Price Low → High</option>
                        <option value="price_desc" @selected($filters['sort'] === 'price_desc')>Price High → Low</option>
                    </select>
                </label>
                <div class="filters-actions">
                    <button type="submit" class="primary-btn">Apply Filters</button>
                    <a href="{{ route('products.index') }}" class="ghost-btn">Reset</a>
                </div>
            </form>
        </aside>

        <div class="products-content">

            @if($featuredProducts->isNotEmpty())
            <div class="fs-wrap" id="featuredSlider" aria-label="Featured products">

                {{-- Slide counter top-right --}}
                @if($featuredProducts->count() > 1)
                <div class="fs-counter">
                    <span id="fsCountCurrent">1</span> / {{ $featuredProducts->count() }}
                </div>
                @endif

                <div class="fs-track" id="fsTrack">
                @foreach($featuredProducts as $fi => $featured)
                @php
                    $imgPath = $featured->images[0] ?? '';
                    $img = $imgPath
                        ? (\Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://', 'data:'])
                            ? $imgPath
                            : asset('storage/' . ltrim($imgPath, '/')))
                        : '';
                    $waText = rawurlencode('I am interested in '.$featured->name);
                    $fallback = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 900 520'><rect width='900' height='520' fill='%23e8eef8'/><rect x='335' y='195' width='230' height='130' rx='18' fill='%23ffffff' stroke='%23b7cceb'/><rect x='365' y='238' width='170' height='24' rx='12' fill='%238ec3f5'/></svg>";
                @endphp
                <div class="fs-slide {{ $fi === 0 ? 'active' : '' }}" data-index="{{ $fi }}" aria-hidden="{{ $fi === 0 ? 'false' : 'true' }}">
                    {{-- Left: image panel --}}
                    <div class="fs-img-panel">
                        <a href="{{ route('products.show', $featured->slug) }}" class="fs-img-link" tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                            @if($img)
                                <img src="{{ $img }}" alt="{{ $featured->name }}" loading="{{ $fi === 0 ? 'eager' : 'lazy' }}"
                                     class="fs-img" onerror="this.src='{{ $fallback }}'">
                            @else
                                <div class="fs-img-ph">
                                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none"><rect x="8" y="20" width="48" height="30" rx="6" fill="#cbd5e1"/><rect x="18" y="30" width="28" height="6" rx="3" fill="#94a3b8"/></svg>
                                </div>
                            @endif
                        </a>
                        {{-- featured ribbon --}}
                        <div class="fs-ribbon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            Featured
                        </div>
                    </div>

                    {{-- Right: info panel --}}
                    <div class="fs-info-panel">
                        <div class="fs-tags-row">
                            <span class="fs-brand">{{ $featured->brand }}</span>
                            <span class="fs-stock-badge {{ $featured->stock > 0 ? 'in' : 'pre' }}">
                                {{ $featured->stock > 0 ? '● In Stock' : '○ Pre-order' }}
                            </span>
                        </div>

                        <h2 class="fs-name">
                            <a href="{{ route('products.show', $featured->slug) }}" tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                                {{ $featured->name }}
                            </a>
                        </h2>

                        <p class="fs-desc">{{ \Illuminate\Support\Str::limit(strip_tags($featured->description), 100) }}</p>

                        <div class="fs-price-row">
                            @if($featured->discount_price && $featured->discount_price < $featured->price)
                                <span class="fs-price-old">₹{{ number_format($featured->price, 0) }}</span>
                                <span class="fs-price-now">₹{{ number_format($featured->discount_price, 0) }}</span>
                            @else
                                <span class="fs-price-now">₹{{ number_format($featured->price, 0) }}</span>
                            @endif
                        </div>

                        <div class="fs-cta-row">
                            <button type="button" class="fs-btn-enquire open-enquiry"
                                    data-product-id="{{ $featured->id }}"
                                    data-product-name="{{ $featured->name }}"
                                    tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                                Enquire Now
                            </button>
                            <a class="fs-btn-wa"
                               href="https://wa.me/918346904100?text={{ $waText }}"
                               target="_blank" rel="noopener"
                               tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                                <svg viewBox="0 0 32 32" width="18" height="18" aria-hidden="true"><path fill="#fff" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#25D366" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8l.5-.6c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.4c-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4-.1-.1-.4-.2-.7-.4Z"/></svg>
                                WhatsApp
                            </a>
                            <a class="fs-btn-details" href="{{ route('products.show', $featured->slug) }}" tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                                View Details
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>

                @if($featuredProducts->count() > 1)
                {{-- Arrows --}}
                <button class="fs-arrow fs-prev" id="fsPrev" aria-label="Previous">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button class="fs-arrow fs-next" id="fsNext" aria-label="Next">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
                {{-- Dots --}}
                <div class="fs-dots" id="fsDots">
                    @foreach($featuredProducts as $fi => $f)
                    <button class="fs-dot {{ $fi === 0 ? 'active' : '' }}" data-goto="{{ $fi }}" aria-label="Slide {{ $fi+1 }}"></button>
                    @endforeach
                </div>
                @endif

                {{-- Progress bar --}}
                <div class="fs-progress"><div class="fs-progress-fill" id="fsProgressFill"></div></div>
            </div>

            <style>
            /* ── Wrapper ── */
            .fs-wrap{position:relative;border-radius:16px;overflow:hidden;margin-bottom:28px;box-shadow:0 4px 32px rgba(0,0,0,.10);background:#fff;}
            .fs-track{display:grid;grid-template-columns:1fr;grid-template-rows:1fr;}

            /* ── Slide transition ── */
            .fs-slide{grid-area:1/1;display:grid;grid-template-columns:55% 45%;min-height:380px;opacity:0;transform:translateX(40px);transition:opacity .5s cubic-bezier(.4,0,.2,1),transform .5s cubic-bezier(.4,0,.2,1);pointer-events:none;will-change:opacity,transform;}
            .fs-slide.active{opacity:1;transform:translateX(0);pointer-events:auto;z-index:2;}
            .fs-slide.exit-left{opacity:0;transform:translateX(-40px);z-index:1;}

            /* ── Image panel ── */
            .fs-img-panel{position:relative;overflow:hidden;background:#f1f5f9;}
            .fs-img-link{display:block;width:100%;height:100%;}
            .fs-img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 7s ease;}
            .fs-slide.active .fs-img{transform:scale(1.05);}
            .fs-img-ph{width:100%;height:100%;min-height:380px;display:flex;align-items:center;justify-content:center;background:#f1f5f9;}

            /* ── Ribbon ── */
            .fs-ribbon{position:absolute;top:20px;left:20px;background:linear-gradient(135deg,#f59e0b,#f97316);color:#fff;font-size:.7rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:5px 14px;border-radius:30px;display:inline-flex;align-items:center;gap:5px;box-shadow:0 3px 12px rgba(249,115,22,.35);}

            /* ── Counter ── */
            .fs-counter{position:absolute;top:18px;right:18px;z-index:10;background:rgba(0,0,0,.45);backdrop-filter:blur(6px);color:#fff;font-size:.75rem;font-weight:600;padding:4px 12px;border-radius:20px;}

            /* ── Info panel ── */
            .fs-info-panel{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;gap:16px;background:#fff;}
            .fs-tags-row{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
            .fs-brand{background:#eff6ff;color:#1d4ed8;font-size:.75rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;padding:4px 12px;border-radius:6px;}
            .fs-stock-badge{font-size:.75rem;font-weight:600;}
            .fs-stock-badge.in{color:#16a34a;}
            .fs-stock-badge.pre{color:#d97706;}

            /* ── Name & desc ── */
            .fs-name{font-size:1.5rem;font-weight:800;color:#0f172a;line-height:1.2;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
            .fs-name a{color:inherit;text-decoration:none;}
            .fs-name a:hover{color:#1d4ed8;}
            .fs-desc{font-size:.9rem;color:#64748b;line-height:1.55;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}

            /* ── Price ── */
            .fs-price-row{display:flex;align-items:baseline;gap:10px;}
            .fs-price-now{font-size:2rem;font-weight:900;color:#1d4ed8;letter-spacing:-.03em;}
            .fs-price-old{font-size:1rem;color:#94a3b8;text-decoration:line-through;}

            /* ── CTA row ── */
            .fs-cta-row{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
            .fs-btn-enquire{background:#1d4ed8;color:#fff;border:none;padding:11px 24px;border-radius:10px;font-size:.88rem;font-weight:700;cursor:pointer;transition:background .2s,transform .2s,box-shadow .2s;box-shadow:0 4px 14px rgba(29,78,216,.3);}
            .fs-btn-enquire:hover{background:#1e40af;transform:translateY(-2px);box-shadow:0 6px 20px rgba(29,78,216,.4);}
            .fs-btn-wa{display:inline-flex;align-items:center;gap:7px;background:#25D366;color:#fff;text-decoration:none;padding:11px 18px;border-radius:10px;font-size:.88rem;font-weight:700;transition:background .2s,transform .2s;box-shadow:0 4px 14px rgba(37,211,102,.25);}
            .fs-btn-wa:hover{background:#16a34a;transform:translateY(-2px);}
            .fs-btn-details{display:inline-flex;align-items:center;gap:4px;color:#1d4ed8;font-size:.85rem;font-weight:600;text-decoration:none;padding:4px 0;border-bottom:1.5px solid transparent;transition:border-color .2s;}
            .fs-btn-details:hover{border-bottom-color:#1d4ed8;}

            /* ── Arrows ── */
            .fs-arrow{position:absolute;top:50%;transform:translateY(-50%);width:40px;height:40px;border-radius:50%;border:1.5px solid #e2e8f0;background:#fff;color:#334155;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,border-color .2s,transform .2s;z-index:10;box-shadow:0 2px 8px rgba(0,0,0,.08);}
            .fs-arrow:hover{background:#f8fafc;border-color:#1d4ed8;color:#1d4ed8;transform:translateY(-50%) scale(1.08);}
            .fs-prev{left:12px;}.fs-next{right:12px;}

            /* ── Dots ── */
            .fs-dots{position:absolute;bottom:16px;right:24px;display:flex;gap:6px;z-index:10;}
            .fs-dot{width:7px;height:7px;border-radius:50%;border:none;background:#cbd5e1;cursor:pointer;padding:0;transition:background .3s,width .3s,border-radius .3s;}
            .fs-dot.active{background:#1d4ed8;width:22px;border-radius:4px;}

            /* ── Progress ── */
            .fs-progress{position:absolute;bottom:0;left:0;right:0;height:3px;background:#f1f5f9;}
            .fs-progress-fill{height:100%;width:0;background:linear-gradient(90deg,#1d4ed8,#60a5fa);transition:width linear;}

            /* ── Mobile ── */
            @media(max-width:768px){
                .fs-slide{grid-template-columns:1fr;grid-template-rows:240px auto;min-height:auto;}
                .fs-info-panel{padding:22px 20px 48px;}
                .fs-name{font-size:1.15rem;}
                .fs-price-now{font-size:1.5rem;}
                .fs-btn-details{display:none;}
                .fs-dots{right:50%;transform:translateX(50%);}
                .fs-prev{left:8px;}.fs-next{right:8px;}
                .fs-arrow{top:120px;}
            }
            </style>
            @endif

            <div class="products-toolbar">
                <button type="button" class="ghost-btn filters-open" id="openFilters">Filter & Search</button>
                <p>{{ $products->total() }} products found</p>
            </div>

            <div class="products-grid-page">
                @forelse($products as $product)
                    <article class="product-item-card premium-product-card product-clickable" data-url="{{ route('products.show', $product->slug) }}">
                        @php
                            $imgPath = $product->images[0] ?? '';
                            $img = $imgPath
                                ? (\Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://', 'data:'])
                                    ? $imgPath
                                    : asset('storage/' . ltrim($imgPath, '/')))
                                : 'https://images.unsplash.com/photo-1581275237725-2f7f9f89f4f2?q=80&w=800&auto=format&fit=crop';
                            $whatsappText = rawurlencode("I am interested in {$product->name}");
                        @endphp
                        <a class="product-image-wrap" href="{{ route('products.show', $product->slug) }}">
                            <img loading="lazy" src="{{ $img }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 900 520%22><defs><linearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22><stop offset=%220%25%22 stop-color=%22%23e8eef8%22/><stop offset=%22100%25%22 stop-color=%22%23d9e5f6%22/></linearGradient></defs><rect width=%22900%22 height=%22520%22 fill=%22url(%23g)%22/><rect x=%22335%22 y=%22195%22 width=%22230%22 height=%22130%22 rx=%2218%22 fill=%22%23ffffff%22 stroke=%22%23b7cceb%22/><rect x=%22365%22 y=%22238%22 width=%22170%22 height=%2224%22 rx=%2212%22 fill=%22%238ec3f5%22/><circle cx=%22520%22 cy=%22222%22 r=%2212%22 fill=%22%233c7cc0%22/></svg>';">
                            <span class="card-top-tag">{{ $product->is_featured ? 'Premium Pick' : 'Value Choice' }}</span>
                        </a>
                        <div class="product-card-body">
                            <div class="product-top-meta premium-meta">
                                <span class="brand-chip">{{ $product->brand }}</span>
                                <h3 class="card-price-heading">₹{{ number_format($product->price, 0) }}</h3>
                            </div>
                            <h3><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 95) }}</p>
                            <div class="stock-chip">{{ $product->stock > 0 ? 'In Stock' : 'Pre-order Available' }}</div>
                            <div class="card-btn-row">
                                <button type="button" class="primary-btn open-enquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">Enquire Now</button>
                                <a class="outline-btn wa-icon-btn" target="_blank" rel="noopener" aria-label="WhatsApp" href="https://wa.me/918346904100?text={{ $whatsappText }}">
                                    <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="#25D366" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <article class="product-item-card"><div class="product-card-body"><h3>No products found</h3><p>Try changing your filters.</p></div></article>
                @endforelse
            </div>

            <div class="pagination-wrap">{{ $products->links() }}</div>
        </div>
    </div>
</section>

<section class="section pp-cta-banner">
    <div class="container pp-cta-card">
        <div>
            <h2>Need Help Choosing the Right AC?</h2>
            <p>Get product guidance from experienced technicians before you buy.</p>
        </div>
        <div class="quick-actions">
            <a class="primary-btn" href="tel:+918346904100">Call Now</a>
            <a class="secondary-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp</a>
            <a class="ghost-btn" href="#product-enquiry">Enquiry</a>
        </div>
    </div>
</section>

<section class="section trust-block">
    <div class="container">
        <h2>What Customers Say</h2>
        <div class="test-grid">
            <article class="test-card"><div class="stars">★★★★★</div><p>Got the right AC model suggestion and very smooth installation support.</p><strong>— Sourav M.</strong></article>
            <article class="test-card"><div class="stars">★★★★★</div><p>Transparent pricing and quick response on product enquiry.</p><strong>— Nidhi P.</strong></article>
            <article class="test-card"><div class="stars">★★★★★</div><p>Good quality spare parts and reliable after-sales service.</p><strong>— Rajat D.</strong></article>
        </div>
    </div>
</section>

<section class="section faq-zone">
    <div class="container">
        <h2>Products FAQ</h2>
        <div class="faq-list">
            <details><summary>Do you support AC installation after purchase?</summary><p>Yes, we provide professional installation and post-installation checks.</p></details>
            <details><summary>Do products come with warranty?</summary><p>Yes, brand warranty applies along with service guidance from our team.</p></details>
            <details><summary>Can I buy spare parts only?</summary><p>Yes, we also supply genuine AC spare parts for supported brands.</p></details>
            <details><summary>Do you provide same-day product consultation?</summary><p>Yes, our support team can guide you quickly via call or WhatsApp.</p></details>
            <details><summary>Which brands are available?</summary><p>Daikin, Voltas, OGeneral and other selected premium options.</p></details>
        </div>
    </div>
</section>

<section class="section svc-final-cta">
    <div class="container cta-panel">
        <h2>Ready to Buy the Right AC in Kolkata?</h2>
        <p>Speak with our product experts and get the best model for your space and budget.</p>
        <div class="quick-actions">
            <a class="primary-btn" href="#product-enquiry">Book Enquiry</a>
            <a class="secondary-btn" href="tel:+918346904100">Call Now</a>
            <a class="ghost-btn" href="https://wa.me/918346904100" target="_blank" rel="noopener">WhatsApp Us</a>
        </div>
    </div>
</section>

<div class="enquiry-modal" id="productEnquiryModal" aria-hidden="true">
    <div class="enquiry-modal-card" id="product-enquiry">
        <button type="button" class="modal-close" id="closeEnquiryModal">×</button>
        <h3>Product Enquiry</h3>
        <p>Share your details and we will call you shortly.</p>
        <form method="POST" action="{{ route('enquiries.store') }}" class="enquiry-modal-form">
            @csrf
            <input type="hidden" name="source_type" value="product">
            <input type="hidden" name="source_id" id="enquirySourceId">
            <label>Name<input type="text" name="name" required></label>
            <label>Phone<input type="text" name="phone" required></label>
            <label>Email<input type="email" name="email"></label>
            <label>Message<textarea name="message" id="enquiryMessage" required></textarea></label>
            <button class="primary-btn" type="submit">Submit Enquiry</button>
        </form>
    </div>
</div>

<script>
(() => {
  const drawer = document.getElementById('filtersDrawer');
  const openBtn = document.getElementById('openFilters');
  const closeBtn = document.getElementById('closeFilters');
  openBtn?.addEventListener('click', () => drawer.classList.add('open'));
  closeBtn?.addEventListener('click', () => drawer.classList.remove('open'));

  const modal = document.getElementById('productEnquiryModal');
  const sourceInput = document.getElementById('enquirySourceId');
  const messageInput = document.getElementById('enquiryMessage');
  const closeModal = document.getElementById('closeEnquiryModal');

  document.querySelectorAll('.open-enquiry').forEach((button) => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-product-id');
      const name = button.getAttribute('data-product-name');
      sourceInput.value = id;
      messageInput.value = `I am interested in ${name}. Please share details.`;
      modal.classList.add('show');
      modal.setAttribute('aria-hidden', 'false');
    });
  });

  closeModal?.addEventListener('click', () => {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
  });
  modal?.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.remove('show');
      modal.setAttribute('aria-hidden', 'true');
    }
  });

  // Featured slider
  (() => {
    const slides = document.querySelectorAll('.fs-slide');
    const dots   = document.querySelectorAll('.fs-dot');
    const fill   = document.getElementById('fsProgressFill');
    const DURATION = 5000;
    if (!slides.length) return;

    let current = 0, timer = null, fillTimer = null, paused = false;

    function goTo(next) {
      slides[current].classList.remove('active');
      slides[current].classList.add('exit-left');
      slides[current].setAttribute('aria-hidden', 'true');
      slides[current].querySelectorAll('[tabindex]').forEach(el => el.setAttribute('tabindex', '-1'));
      setTimeout(() => slides[current]?.classList.remove('exit-left'), 600);

      if (dots.length) {
        dots[current].classList.remove('active');
        dots[current].setAttribute('aria-selected', 'false');
        dots[next].classList.add('active');
        dots[next].setAttribute('aria-selected', 'true');
      }

      current = next;
      slides[current].classList.add('active');
      slides[current].setAttribute('aria-hidden', 'false');
      slides[current].querySelectorAll('[tabindex]').forEach(el => el.setAttribute('tabindex', '0'));
      const counter = document.getElementById('fsCountCurrent');
      if (counter) counter.textContent = current + 1;
      resetProgress();
    }

    function nextSlide() { goTo((current + 1) % slides.length); }
    function prevSlide() { goTo((current - 1 + slides.length) % slides.length); }

    function resetProgress() {
      if (!fill) return;
      clearTimeout(fillTimer);
      fill.style.transition = 'none';
      fill.style.width = '0%';
      requestAnimationFrame(() => requestAnimationFrame(() => {
        fill.style.transition = `width ${DURATION}ms linear`;
        fill.style.width = '100%';
      }));
    }

    function startAuto() {
      clearInterval(timer);
      timer = setInterval(() => { if (!paused) nextSlide(); }, DURATION);
      resetProgress();
    }

    slides[0]?.classList.add('active');
    if (slides.length > 1) {
      document.getElementById('fsNext')?.addEventListener('click', () => { nextSlide(); startAuto(); });
      document.getElementById('fsPrev')?.addEventListener('click', () => { prevSlide(); startAuto(); });
      dots.forEach(d => d.addEventListener('click', () => { goTo(+d.dataset.goto); startAuto(); }));
      const wrap = document.getElementById('featuredSlider');
      wrap?.addEventListener('mouseenter', () => { paused = true; fill && (fill.style.animationPlayState = 'paused'); });
      wrap?.addEventListener('mouseleave', () => { paused = false; });
      startAuto();
    }
  })();

  document.querySelectorAll('.product-clickable').forEach((card) => {
    card.addEventListener('click', (e) => {
      if (e.target.closest('a,button,input,select,textarea,label,form')) return;
      const url = card.getAttribute('data-url');
      if (url) window.location.href = url;
    });
  });
})();
</script>
@endsection

