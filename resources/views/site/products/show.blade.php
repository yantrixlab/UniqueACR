@extends('site.layouts.app')
@section('title', $product->meta_title ?: ($product->name . ' | Unique Air'))
@section('content')
<section class="section product-detail-page">
    <div class="container product-detail-grid">
        <div class="detail-gallery">
            @php $images = $product->images ?: ['https://images.unsplash.com/photo-1581275237725-2f7f9f89f4f2?q=80&w=1200&auto=format&fit=crop']; @endphp
            <img src="{{ $images[0] }}" alt="{{ $product->name }}" loading="eager">
            @if(count($images) > 1)
                <div class="detail-thumbs">
                    @foreach($images as $img)
                        <img src="{{ $img }}" alt="{{ $product->name }} thumbnail" loading="lazy">
                    @endforeach
                </div>
            @endif
        </div>
        <div class="detail-content">
            <span class="brand-chip">{{ $product->brand }}</span>
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <div class="price-row detail-price">
                <strong>₹{{ number_format($product->price, 0) }}</strong>
                @if($product->discount_price)
                    <span>₹{{ number_format($product->discount_price, 0) }}</span>
                @endif
            </div>
            @if(!empty($product->specifications))
                <h3>Specifications</h3>
                <ul class="spec-list">
                    @foreach($product->specifications as $key => $value)
                        <li><strong>{{ ucfirst((string)$key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="detail-cta-row">
                <a class="primary-btn" href="{{ route('contact') }}">Enquire Now</a>
                <a class="secondary-btn" target="_blank" rel="noopener" href="https://wa.me/918346904100?text={{ rawurlencode('I am interested in '.$product->name) }}">WhatsApp Now</a>
            </div>
        </div>
    </div>
</section>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => $product->meta_description ?: $product->description,
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
