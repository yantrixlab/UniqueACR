@php
    $fieldWrapperView = $getFieldWrapperView();
    $statePath = $getStatePath();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
    $isMultiple = $isMultiple();
    $id = $getId();
    $media = $getMediaItems();
@endphp

<x-dynamic-component :component="$fieldWrapperView" :field="$field">
    <div class="media-grid-select">
        @forelse ($media as $item)
            @php $inputId = $id . '-' . $item->id; @endphp
            <label for="{{ $inputId }}" class="media-grid-card">
                <input
                    type="{{ $isMultiple ? 'checkbox' : 'radio' }}"
                    id="{{ $inputId }}"
                    name="{{ $isMultiple ? $id . '[]' : $id }}"
                    value="{{ $item->id }}"
                    {{ $wireModelAttribute }}="{{ $statePath }}"
                    class="media-grid-input"
                />
                <span class="media-grid-thumb">
                    <img src="{{ $item->url }}" alt="{{ $item->title ?: $item->original_name }}" loading="lazy" />
                    <span class="media-grid-check">&#10003;</span>
                </span>
                <span class="media-grid-name">{{ \Illuminate\Support\Str::limit($item->title ?: $item->original_name, 24) }}</span>
            </label>
        @empty
            <p class="media-grid-empty">No images in the library yet — use the uploader below to add some.</p>
        @endforelse
    </div>

    <style>
        .media-grid-select {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 0.625rem;
            max-height: 320px;
            overflow-y: auto;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 0.65rem;
            background: rgba(255, 255, 255, 0.02);
        }
        .media-grid-card { position: relative; display: flex; flex-direction: column; gap: 0.3rem; cursor: pointer; }
        .media-grid-input { position: absolute; opacity: 0; width: 0; height: 0; }
        .media-grid-thumb {
            position: relative;
            display: block;
            border-radius: 0.5rem;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.08);
            aspect-ratio: 1 / 1;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .media-grid-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .media-grid-check {
            position: absolute;
            top: 0.3rem;
            right: 0.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.35rem;
            height: 1.35rem;
            border-radius: 999px;
            background: rgb(245, 158, 11);
            color: #1a1a1a;
            font-size: 0.7rem;
            font-weight: 700;
            opacity: 0;
            transform: scale(.6);
            transition: opacity 0.12s ease, transform 0.12s ease;
        }
        .media-grid-input:checked ~ .media-grid-thumb {
            border-color: rgb(245, 158, 11);
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.35);
        }
        .media-grid-input:checked ~ .media-grid-thumb .media-grid-check {
            opacity: 1;
            transform: scale(1);
        }
        .media-grid-input:focus-visible ~ .media-grid-thumb {
            outline: 2px solid rgb(245, 158, 11);
            outline-offset: 1px;
        }
        .media-grid-name {
            font-size: 0.7rem;
            line-height: 1.2;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .media-grid-empty {
            grid-column: 1 / -1;
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.5);
            text-align: center;
            padding: 1.5rem 0;
        }
    </style>
</x-dynamic-component>
