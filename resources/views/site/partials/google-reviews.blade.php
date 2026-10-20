@php
    $grSettings = \App\Models\Setting::googleReviews();
    $grReviews = \App\Models\Testimonial::forDisplay($limit ?? 6);
    $grRating = is_numeric($grSettings['rating'] ?? null) ? min(5.0, max(0.0, (float) $grSettings['rating'])) : null;
    $grCount = is_numeric($grSettings['review_count'] ?? null) ? (int) $grSettings['review_count'] : null;
    $grShowSummary = ! empty($grSettings['show_summary']) && $grRating;
    $grUrl = fn (?string $url) => preg_match('#^https?://#i', (string) $url) ? $url : null;
    $grProfileUrl = $grUrl($grSettings['profile_url'] ?? null);
    $grWriteUrl = $grUrl($grSettings['write_review_url'] ?? null);
    $grGoogleG = '<svg class="gr-g" viewBox="0 0 48 48" aria-hidden="true"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>';
@endphp
@if($grReviews->isNotEmpty())
<section class="section gr" aria-labelledby="gr-heading">
    <div class="container">
        <div class="gr-head">
            <div>
                <h2 id="gr-heading">{{ $heading ?? 'What Our Customers Say' }}</h2>
                <p class="gr-sub">Real feedback from homes and businesses across Kolkata.</p>
            </div>

            @if($grShowSummary)
                <div class="gr-summary">
                    {!! $grGoogleG !!}
                    <div>
                        <div class="gr-score-row">
                            <span class="gr-score">{{ number_format($grRating, 1) }}</span>
                            <span class="gr-stars" style="--pct: {{ round($grRating / 5 * 100) }}%" role="img" aria-label="Rated {{ number_format($grRating, 1) }} out of 5">★★★★★</span>
                        </div>
                        @if($grCount)
                            <div class="gr-count">Based on {{ number_format($grCount) }} Google reviews</div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="gr-track">
            @foreach($grReviews as $review)
                @php
                    $grHue = crc32($review->name) % 360;
                    $grText = \Illuminate\Support\Str::limit(trim($review->message), 260);
                    $grTruncated = mb_strlen(trim($review->message)) > 260;
                    $grReviewUrl = $grUrl($review->review_url);
                    $grDetail = collect([$review->designation, $review->reviewed_at?->diffForHumans()])->filter()->implode(' · ');
                @endphp
                <article class="gr-card">
                    <header class="gr-card-head">
                        <span class="gr-avatar" style="background: hsl({{ $grHue }} 55% 42%)" aria-hidden="true">{{ mb_strtoupper(mb_substr(trim($review->name), 0, 1)) }}</span>
                        <div class="gr-who">
                            <strong>{{ $review->name }}</strong>
                            @if($grDetail !== '')<small>{{ $grDetail }}</small>@endif
                        </div>
                        @if($review->source === \App\Models\Testimonial::SOURCE_GOOGLE)
                            <span title="Posted on Google">{!! $grGoogleG !!}</span>
                        @endif
                    </header>
                    <div class="gr-stars" style="--pct: {{ min(100, max(0, (int) $review->rating * 20)) }}%" role="img" aria-label="Rated {{ (int) $review->rating }} out of 5">★★★★★</div>
                    <p>{{ $grText }}</p>
                    @if($grTruncated && $grReviewUrl)
                        <a class="gr-more" href="{{ $grReviewUrl }}" target="_blank" rel="noopener noreferrer">Read full review</a>
                    @endif
                </article>
            @endforeach
        </div>

        @if($grProfileUrl || $grWriteUrl)
            <div class="gr-actions">
                @if($grProfileUrl)
                    <a class="outline-btn" href="{{ $grProfileUrl }}" target="_blank" rel="noopener noreferrer" data-track="cta_click" data-track-label="Google Reviews - See all">See all reviews</a>
                @endif
                @if($grWriteUrl)
                    <a class="primary-btn" href="{{ $grWriteUrl }}" target="_blank" rel="noopener noreferrer" data-track="cta_click" data-track-label="Google Reviews - Write review">Review us on Google</a>
                @endif
            </div>
        @endif
    </div>
</section>
@endif
