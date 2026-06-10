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

<section class="section pp-featured-carousel">
    <div class="container">
        <div class="section-head">
            <div><h2>Featured Products</h2><p class="sub">Top picks selected for performance and long-term reliability.</p></div>
        </div>
        <div class="products-grid-page featured-same-grid">
            @foreach($products->take(6) as $featured)
                @php
                    $imgPath = $featured->images[0] ?? '';
                    $img = $imgPath
                        ? (\Illuminate\Support\Str::startsWith($imgPath, ['http://', 'https://', 'data:'])
                            ? $imgPath
                            : asset('storage/' . ltrim($imgPath, '/')))
                        : '';
                @endphp
                <article class="product-item-card premium-product-card product-clickable" data-url="{{ route('products.show', $featured->slug) }}">
                    <a class="product-image-wrap" href="{{ route('products.show', $featured->slug) }}">
                        <img loading="lazy" src="{{ $img }}" alt="{{ $featured->name }}" onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 900 520%22><defs><linearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22><stop offset=%220%25%22 stop-color=%22%23e8eef8%22/><stop offset=%22100%25%22 stop-color=%22%23d9e5f6%22/></linearGradient></defs><rect width=%22900%22 height=%22520%22 fill=%22url(%23g)%22/><rect x=%22335%22 y=%22195%22 width=%22230%22 height=%22130%22 rx=%2218%22 fill=%22%23ffffff%22 stroke=%22%23b7cceb%22/><rect x=%22365%22 y=%22238%22 width=%22170%22 height=%2224%22 rx=%2212%22 fill=%22%238ec3f5%22/><circle cx=%22520%22 cy=%22222%22 r=%2212%22 fill=%22%233c7cc0%22/></svg>';">
                        <span class="card-top-tag">{{ $featured->is_featured ? 'Premium Pick' : 'Value Choice' }}</span>
                    </a>
                    <div class="product-card-body">
                        <div class="product-top-meta premium-meta">
                            <span class="brand-chip">{{ $featured->brand }}</span>
                            <h3 class="card-price-heading">₹{{ number_format($featured->price, 0) }}</h3>
                        </div>
                        <h3><a href="{{ route('products.show', $featured->slug) }}">{{ $featured->name }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit($featured->description, 95) }}</p>
                        <div class="stock-chip">{{ $featured->stock > 0 ? 'In Stock' : 'Pre-order Available' }}</div>
                        <div class="card-btn-row">
                            <button type="button" class="primary-btn open-enquiry" data-product-id="{{ $featured->id }}" data-product-name="{{ $featured->name }}">Enquire Now</button>
                            <a class="outline-btn wa-icon-btn" target="_blank" rel="noopener" aria-label="WhatsApp" href="https://wa.me/918346904100?text={{ rawurlencode('I am interested in '.$featured->name) }}">
                                <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="#25D366" d="M16 3C8.8 3 3 8.8 3 16c0 2.5.7 4.9 2 7L3 29l6.2-1.9c2 1.1 4.3 1.8 6.8 1.8 7.2 0 13-5.8 13-13S23.2 3 16 3Z"/><path fill="#fff" d="M22.5 19.2c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.1-.2.2-.4.2-.7 0-2-.9-3.3-1.7-4.6-3.9-.3-.4 0-.6.2-.8.2-.2.3-.4.5-.6.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.8-.9-2.4-.2-.6-.4-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.3 0 1.3 1 2.6 1.1 2.8.1.2 2 3.1 4.9 4.3 2.9 1.2 2.9.8 3.4.8.5 0 1.7-.7 1.9-1.4.2-.7.2-1.3.1-1.4 0-.1-.3-.2-.6-.4Z"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section products-listing-section" id="products-catalog">
    <div class="container products-layout">
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

        <div>
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
                            <p>{{ \Illuminate\Support\Str::limit($product->description, 95) }}</p>
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

