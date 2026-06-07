@php
    $fieldWrapperView = $getFieldWrapperView();
    $isMultiple = $isMultiple();
    $selected = $getSelectedMedia();
@endphp

<x-dynamic-component :component="$fieldWrapperView" :field="$field">
    <div class="media-picker-field">
        <div class="media-picker-preview">
            @forelse ($selected as $item)
                <span class="media-picker-preview-thumb">
                    <img src="{{ $item->url }}" alt="{{ $item->title ?: $item->original_name }}" loading="lazy" />
                </span>
            @empty
                <span class="media-picker-preview-empty">
                    {{ $isMultiple ? 'No images selected yet.' : 'No image selected yet.' }}
                </span>
            @endforelse
        </div>

        <div class="media-picker-action">
            {{ $getAction('pickImages') }}
        </div>
    </div>

    <style>
        .media-picker-field {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .media-picker-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
            min-height: 4.5rem;
            flex: 1 1 auto;
        }
        .media-picker-preview-thumb {
            display: block;
            width: 4.5rem;
            height: 4.5rem;
            border-radius: 0.5rem;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }
        .media-picker-preview-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .media-picker-preview-empty {
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.5);
        }
        .media-picker-action {
            flex-shrink: 0;
        }
    </style>
</x-dynamic-component>
