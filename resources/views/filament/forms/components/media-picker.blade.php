@php
    $fieldWrapperView = $getFieldWrapperView();
    $statePath = $getStatePath();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
    $isMultiple = $isMultiple();
    $id = $getId();
    $media = $getMediaItems();
@endphp

<x-dynamic-component :component="$fieldWrapperView" :field="$field">
    <div
        x-data="{
            open: {{ $media->isNotEmpty() ? 'true' : 'false' }},
        }"
        class="media-picker"
    >
        <button
            type="button"
            x-on:click="open = ! open"
            class="media-picker-toggle"
        >
            <span x-show="! open">Browse image library ({{ $media->count() }})</span>
            <span x-show="open" x-cloak>Hide image library</span>
        </button>

        <div x-show="open" x-cloak class="media-picker-grid">
            @forelse ($media as $item)
                @php $inputId = $id . '-' . $item->id; @endphp
                <label for="{{ $inputId }}" class="media-picker-card">
                    <input
                        type="{{ $isMultiple ? 'checkbox' : 'radio' }}"
                        id="{{ $inputId }}"
                        name="{{ $id }}"
                        value="{{ $item->id }}"
                        {{ $wireModelAttribute }}="{{ $statePath }}"
                        class="media-picker-input"
                    />
                    <span class="media-picker-thumb">
                        <img src="{{ $item->url }}" alt="{{ $item->title ?: $item->original_name }}" loading="lazy" />
                        <span class="media-picker-check">&#10003;</span>
                    </span>
                    <span class="media-picker-name">{{ \Illuminate\Support\Str::limit($item->title ?: $item->original_name, 24) }}</span>
                </label>
            @empty
                <p class="media-picker-empty">No images in the library yet — upload one below to get started.</p>
            @endforelse
        </div>
    </div>

    <style>
        .media-picker { display: flex; flex-direction: column; gap: 0.625rem; }
        .media-picker-toggle {
            align-self: flex-start;
            font-size: 0.8125rem;
            font-weight: 600;
            padding: 0.4rem 0.85rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(245, 158, 11, 0.4);
            color: rgb(245, 158, 11);
            background: rgba(245, 158, 11, 0.08);
            cursor: pointer;
            transition: background-color 0.15s ease;
        }
        .media-picker-toggle:hover { background: rgba(245, 158, 11, 0.16); }
        .media-picker-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 0.625rem;
            max-height: 360px;
            overflow-y: auto;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 0.65rem;
            background: rgba(255, 255, 255, 0.02);
        }
        .media-picker-card { position: relative; display: flex; flex-direction: column; gap: 0.3rem; cursor: pointer; }
        .media-picker-input { position: absolute; opacity: 0; width: 0; height: 0; }
        .media-picker-thumb {
            position: relative;
            display: block;
            border-radius: 0.5rem;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.08);
            aspect-ratio: 1 / 1;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .media-picker-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .media-picker-check {
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
        .media-picker-input:checked ~ .media-picker-thumb {
            border-color: rgb(245, 158, 11);
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.35);
        }
        .media-picker-input:checked ~ .media-picker-thumb .media-picker-check {
            opacity: 1;
            transform: scale(1);
        }
        .media-picker-input:focus-visible ~ .media-picker-thumb {
            outline: 2px solid rgb(245, 158, 11);
            outline-offset: 1px;
        }
        .media-picker-name {
            font-size: 0.7rem;
            line-height: 1.2;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .media-picker-empty {
            grid-column: 1 / -1;
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.5);
            text-align: center;
            padding: 1.5rem 0;
        }
    </style>
</x-dynamic-component>
