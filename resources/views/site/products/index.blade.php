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
                @endphp
                <div class="fs-slide {{ $fi === 0 ? 'active' : '' }}" data-index="{{ $fi }}" aria-hidden="{{ $fi === 0 ? 'false' : 'true' }}">

                    {{-- Full-bleed background image with Ken Burns --}}
                    @if($img)
                        <img src="{{ $img }}" alt="{{ $featured->name }}"
                             class="fs-bg-img" loading="{{ $fi === 0 ? 'eager' : 'lazy' }}"
                             onerror="this.style.display='none'">
                    @endif

                    {{-- Dark gradient scrim so text is always readable --}}
                    <div class="fs-scrim"></div>

                    {{-- Featured pill top-left --}}
                    <div class="fs-ribbon">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        Featured
                    </div>

                    {{-- Content: bottom-left for title/desc/btns, bottom-right for price --}}
                    <div class="fs-content">
                        <div class="fs-left">
                            <div class="fs-brand-row">
                                <span class="fs-brand">{{ $featured->brand }}</span>
                                <span class="fs-stock {{ $featured->stock > 0 ? 'in' : 'pre' }}">
                                    {{ $featured->stock > 0 ? '● In Stock' : '○ Pre-order' }}
                                </span>
                            </div>
                            <h2 class="fs-name">
                                <a href="{{ route('products.show', $featured->slug) }}" tabindex="{{ $fi === 0 ? '0' : '-1' }}">{{ $featured->name }}</a>
                            </h2>
                            <p class="fs-desc">{{ \Illuminate\Support\Str::limit(strip_tags($featured->description ?? ''), 90) }}</p>
                            <div class="fs-btns">
                                <button type="button" class="fs-btn-enq open-enquiry"
                                        data-product-id="{{ $featured->id }}"
                                        data-product-name="{{ $featured->name }}"
                                        tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                                    Enquire Now
                                </button>
                                <a class="fs-btn-wa"
                                   href="https://wa.me/918346904100?text={{ $waText }}"
                                   target="_blank" rel="noopener"
                                   tabindex="{{ $fi === 0 ? '0' : '-1' }}">
                                    <svg viewBox="0 0 32 32" width="17" height="17" aria-hidden="true"><path fill="#fff" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#25D366" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8l.5-.6c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.4c-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4-.1-.1-.4-.2-.7-.4Z"/></svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                        <div class="fs-right">
                            @if($featured->discount_price && $featured->discount_price < $featured->price)
                                <div class="fs-price-old">₹{{ number_format($featured->price, 0) }}</div>
                                <div class="fs-price-now">₹{{ number_format($featured->discount_price, 0) }}</div>
                            @else
                                <div class="fs-price-now">₹{{ number_format($featured->price, 0) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                </div>

                @if($featuredProducts->count() > 1)
                <button class="fs-arrow fs-prev" id="fsPrev" aria-label="Previous slide">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button class="fs-arrow fs-next" id="fsNext" aria-label="Next slide">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
                <div class="fs-dots" id="fsDots">
                    @foreach($featuredProducts as $fi => $f)
                    <button class="fs-dot {{ $fi === 0 ? 'active' : '' }}" data-goto="{{ $fi }}" aria-label="Slide {{ $fi+1 }}"></button>
                    @endforeach
                </div>
                @endif

                <div class="fs-progress"><div class="fs-progress-fill" id="fsProgressFill"></div></div>
            </div>

            <style>
            /* Wrapper */
            .fs-wrap{position:relative;border-radius:16px;overflow:hidden;margin-bottom:28px;box-shadow:0 8px 40px rgba(0,0,0,.22);background:#111;height:420px;}

            /* Track — stacks all slides on top of each other */
            .fs-track{position:absolute;inset:0;}

            /* Each slide fills the wrapper */
            .fs-slide{position:absolute;inset:0;opacity:0;transition:opacity .7s cubic-bezier(.4,0,.2,1);pointer-events:none;z-index:1;}
            .fs-slide.active{opacity:1;pointer-events:auto;z-index:2;}

            /* Full-bleed background image with Ken Burns zoom */
            .fs-bg-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;transform:scale(1);transition:transform 7s ease;will-change:transform;}
            .fs-slide.active .fs-bg-img{transform:scale(1.06);}

            /* Dark gradient: transparent top → dark bottom */
            .fs-scrim{position:absolute;inset:0;background:linear-gradient(to bottom, rgba(0,0,0,.08) 0%, rgba(0,0,0,.18) 35%, rgba(0,0,0,.72) 75%, rgba(0,0,0,.88) 100%);}

            /* Featured pill */
            .fs-ribbon{position:absolute;top:20px;left:22px;z-index:5;background:linear-gradient(135deg,#f59e0b,#f97316);color:#fff;font-size:.68rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;padding:5px 13px;border-radius:30px;display:inline-flex;align-items:center;gap:5px;box-shadow:0 3px 14px rgba(249,115,22,.4);}

            /* Content bar — sits at the bottom, split left/right */
            .fs-content{position:absolute;bottom:0;left:0;right:0;z-index:5;display:flex;align-items:flex-end;justify-content:space-between;gap:20px;padding:28px 30px 30px;}

            /* Left: brand, name, desc, buttons */
            .fs-left{flex:1;min-width:0;}
            .fs-brand-row{display:flex;align-items:center;gap:10px;margin-bottom:6px;}
            .fs-brand{background:rgba(255,255,255,.15);backdrop-filter:blur(6px);color:#fff;font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:3px 11px;border-radius:4px;border:1px solid rgba(255,255,255,.2);}
            .fs-stock{font-size:.72rem;font-weight:600;color:rgba(255,255,255,.8);}
            .fs-stock.in{color:#4ade80;}
            .fs-stock.pre{color:#fbbf24;}

            .fs-name{font-size:1.55rem;font-weight:800;color:#fff;line-height:1.2;margin:0 0 5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-shadow:0 2px 8px rgba(0,0,0,.5);}
            .fs-name a{color:inherit;text-decoration:none;}
            .fs-name a:hover{text-decoration:underline;text-underline-offset:3px;}

            .fs-desc{font-size:.85rem;color:rgba(255,255,255,.78);margin:0 0 14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-shadow:0 1px 4px rgba(0,0,0,.5);}

            /* Buttons row */
            .fs-btns{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
            .fs-btn-enq{background:#111;color:#fff;border:none;padding:10px 22px;border-radius:8px;font-size:.875rem;font-weight:700;cursor:pointer;transition:background .2s,transform .15s;letter-spacing:.01em;}
            .fs-btn-enq:hover{background:#222;transform:translateY(-1px);}
            .fs-btn-wa{display:inline-flex;align-items:center;gap:7px;background:rgba(37,211,102,.12);color:#fff;text-decoration:none;padding:10px 18px;border-radius:8px;font-size:.875rem;font-weight:700;border:1.5px solid rgba(37,211,102,.55);transition:background .2s,transform .15s;backdrop-filter:blur(4px);}
            .fs-btn-wa:hover{background:rgba(37,211,102,.25);transform:translateY(-1px);}

            /* Right: price */
            .fs-right{flex-shrink:0;text-align:right;}
            .fs-price-now{font-size:2.1rem;font-weight:900;color:#fff;letter-spacing:-.03em;line-height:1;text-shadow:0 2px 10px rgba(0,0,0,.5);}
            .fs-price-old{font-size:.9rem;color:rgba(255,255,255,.5);text-decoration:line-through;margin-bottom:2px;}

            /* Arrows */
            .fs-arrow{position:absolute;top:50%;transform:translateY(-50%);width:42px;height:42px;border-radius:50%;border:1.5px solid rgba(255,255,255,.3);background:rgba(0,0,0,.35);backdrop-filter:blur(8px);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,border-color .2s,transform .2s;z-index:10;}
            .fs-arrow:hover{background:rgba(0,0,0,.6);border-color:rgba(255,255,255,.7);transform:translateY(-50%) scale(1.08);}
            .fs-prev{left:14px;}.fs-next{right:14px;}

            /* Dots — bottom right */
            .fs-dots{position:absolute;bottom:22px;right:24px;display:flex;gap:7px;z-index:10;}
            .fs-dot{width:8px;height:8px;border-radius:50%;border:1.5px solid rgba(255,255,255,.6);background:transparent;cursor:pointer;padding:0;transition:background .3s,width .3s,border-radius .3s,border-color .3s;}
            .fs-dot.active{background:#fff;border-color:#fff;width:24px;border-radius:4px;}

            /* Progress bar */
            .fs-progress{position:absolute;bottom:0;left:0;right:0;height:3px;background:rgba(255,255,255,.12);z-index:10;}
            .fs-progress-fill{height:100%;width:0;background:rgba(255,255,255,.7);transition:width linear;}

            /* Mobile */
            @media(max-width:640px){
                .fs-wrap{height:380px;border-radius:12px;}
                .fs-content{padding:20px 16px 24px;gap:12px;}
                .fs-name{font-size:1.1rem;}
                .fs-desc{display:none;}
                .fs-price-now{font-size:1.5rem;}
                .fs-prev{left:8px;}.fs-next{right:8px;}
                .fs-dots{right:50%;transform:translateX(50%);}
                .fs-btn-enq,.fs-btn-wa{padding:9px 14px;font-size:.8rem;}
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
      if (next === current) return;

      // Deactivate current
      slides[current].classList.remove('active');
      slides[current].setAttribute('aria-hidden', 'true');
      slides[current].querySelectorAll('[tabindex]').forEach(el => el.setAttribute('tabindex', '-1'));

      // Update dots
      if (dots.length) {
        dots[current].classList.remove('active');
        dots[next].classList.add('active');
      }

      // Activate next
      current = next;
      slides[current].classList.add('active');
      slides[current].setAttribute('aria-hidden', 'false');
      slides[current].querySelectorAll('[tabindex]').forEach(el => el.setAttribute('tabindex', '0'));
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

