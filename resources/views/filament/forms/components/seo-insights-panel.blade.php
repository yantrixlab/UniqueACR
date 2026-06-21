@php
    $score = $analysis['score'] ?? 0;
    $grade = $analysis['grade'] ?? '';
    $gradeColor = $analysis['gradeColor'] ?? 'red';
    $colors = [
        'green' => '#22c55e',
        'amber' => '#f59e0b',
        'red' => '#ef4444',
    ];
    $ringColor = $colors[$gradeColor] ?? $colors['red'];
    $circumference = 2 * pi() * 26;
    $offset = $circumference - ($circumference * $score / 100);

    $previewTitle = $title ?: 'Your SEO title will appear here';
    $previewDescription = $description ?: 'Add a meta description so it appears here, just like it will in Google search results.';
    $permalink = $slug ? url('/blog/' . $slug) : url('/blog/your-post-slug');

    $statusDot = [
        'good' => '#22c55e',
        'ok' => '#f59e0b',
        'bad' => '#ef4444',
    ];
@endphp

<div class="seo-insights-panel">
    <div class="seo-insights-serp">
        <div class="seo-insights-serp-favicon">U</div>
        <div class="seo-insights-serp-body">
            <div class="seo-insights-serp-url">{{ $permalink }}</div>
            <div class="seo-insights-serp-title">{{ \Illuminate\Support\Str::limit($previewTitle, 65) }}</div>
            <div class="seo-insights-serp-desc">{{ \Illuminate\Support\Str::limit($previewDescription, 155) }}</div>
        </div>
    </div>

    <div class="seo-insights-score-row">
        <svg viewBox="0 0 60 60" class="seo-insights-ring">
            <circle cx="30" cy="30" r="26" fill="none" stroke="rgba(148,163,184,.25)" stroke-width="6" />
            <circle cx="30" cy="30" r="26" fill="none" stroke="{{ $ringColor }}" stroke-width="6"
                    stroke-linecap="round"
                    stroke-dasharray="{{ $circumference }}"
                    stroke-dashoffset="{{ $offset }}"
                    transform="rotate(-90 30 30)" />
            <text x="30" y="34" text-anchor="middle" font-size="16" font-weight="700" fill="currentColor">{{ $score }}</text>
        </svg>
        <div>
            <div class="seo-insights-grade" style="color: {{ $ringColor }};">{{ $grade }}</div>
            <div class="seo-insights-grade-sub">SEO &amp; readability score</div>
        </div>
    </div>

    <div class="seo-insights-group">
        <div class="seo-insights-group-title">SEO Analysis</div>
        @foreach($analysis['seo'] ?? [] as $check)
            <div class="seo-insights-check">
                <span class="seo-insights-dot" style="background: {{ $statusDot[$check['status']] ?? $statusDot['bad'] }};"></span>
                <span class="seo-insights-check-text">{{ $check['message'] }}</span>
            </div>
        @endforeach
    </div>

    <div class="seo-insights-group">
        <div class="seo-insights-group-title">Readability</div>
        @foreach($analysis['readability'] ?? [] as $check)
            <div class="seo-insights-check">
                <span class="seo-insights-dot" style="background: {{ $statusDot[$check['status']] ?? $statusDot['bad'] }};"></span>
                <span class="seo-insights-check-text">{{ $check['message'] }}</span>
            </div>
        @endforeach
    </div>

    <style>
        .seo-insights-panel {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .seo-insights-serp {
            display: flex;
            gap: .65rem;
            padding: .85rem .9rem;
            border-radius: .65rem;
            background: rgba(148, 163, 184, .08);
            border: 1px solid rgba(148, 163, 184, .2);
        }
        .seo-insights-serp-favicon {
            flex-shrink: 0;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            background: #2563eb;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            font-weight: 700;
        }
        .seo-insights-serp-body {
            min-width: 0;
            flex: 1;
        }
        .seo-insights-serp-url {
            font-size: .72rem;
            color: #16a34a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .seo-insights-serp-title {
            font-size: .92rem;
            color: #1a73e8;
            line-height: 1.3;
            margin-top: .1rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .seo-insights-serp-desc {
            font-size: .78rem;
            color: rgba(148, 163, 184, .9);
            line-height: 1.4;
            margin-top: .2rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .seo-insights-score-row {
            display: flex;
            align-items: center;
            gap: .85rem;
        }
        .seo-insights-ring {
            width: 3.5rem;
            height: 3.5rem;
            flex-shrink: 0;
        }
        .seo-insights-grade {
            font-size: .95rem;
            font-weight: 700;
        }
        .seo-insights-grade-sub {
            font-size: .72rem;
            color: rgba(148, 163, 184, .85);
            margin-top: .1rem;
        }
        .seo-insights-group-title {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: rgba(148, 163, 184, .9);
            margin-bottom: .5rem;
        }
        .seo-insights-check {
            display: flex;
            align-items: flex-start;
            gap: .5rem;
            padding: .3rem 0;
            font-size: .8rem;
            line-height: 1.4;
        }
        .seo-insights-dot {
            flex-shrink: 0;
            width: .5rem;
            height: .5rem;
            border-radius: 50%;
            margin-top: .35rem;
        }
        .seo-insights-check-text {
            color: rgba(148, 163, 184, .95);
        }
    </style>
</div>
