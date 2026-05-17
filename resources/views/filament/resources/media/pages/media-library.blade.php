<x-filament-panels::page>
    <style>
        .media-lib { color: #e5e7eb; }
        .media-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; }
        .media-title { margin:0; font-size:30px; font-weight:700; letter-spacing:-0.02em; }
        .media-upload-top { background:#2563eb; color:#fff; border:none; border-radius:10px; padding:10px 16px; font-weight:600; cursor:pointer; }
        .media-upload-top:hover { background:#1d4ed8; }

        .media-dropzone { border:1px dashed #374151; background:#111827; border-radius:14px; padding:34px 20px; text-align:center; }
        .media-drop-icon { width:56px; height:56px; border-radius:14px; margin:0 auto 14px; background:rgba(37,99,235,.2); color:#60a5fa; display:flex; align-items:center; justify-content:center; }
        .media-drop-icon svg { width:28px; height:28px; }
        .media-drop-title { margin:0; font-size:28px; font-weight:700; }
        .media-drop-sub { margin:6px 0 0; color:#9ca3af; font-size:14px; }
        .media-select-link { margin-top:12px; background:none; border:none; color:#60a5fa; font-weight:600; cursor:pointer; }
        .media-upload-action { margin-top:16px; }
        .media-upload-action button { background:#059669; color:#fff; border:none; border-radius:8px; padding:8px 14px; font-weight:600; cursor:pointer; }

        .media-toolbar { display:flex; justify-content:space-between; align-items:center; gap:12px; margin:20px 0 14px; border-bottom:1px solid #374151; padding-bottom:10px; flex-wrap:wrap; }
        .media-tabs { display:flex; gap:14px; }
        .media-tab { background:none; border:none; color:#9ca3af; font-weight:600; padding:0; cursor:pointer; }
        .media-tab.active { color:#60a5fa; }
        .media-controls { display:flex; gap:10px; align-items:center; }
        .media-input, .media-select { background:#111827; border:1px solid #374151; color:#fff; border-radius:8px; padding:8px 10px; font-size:14px; }

        .media-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:14px; }
        .media-card { background:#111827; border:1px solid #374151; border-radius:12px; overflow:hidden; }
        .media-thumb { height:140px; background:#1f2937; display:flex; align-items:center; justify-content:center; }
        .media-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
        .media-thumb .doc-icon { width:42px; height:42px; color:#9ca3af; }
        .media-meta { padding:10px; }
        .media-name { margin:0; font-size:14px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .media-size { margin:4px 0 8px; color:#9ca3af; font-size:12px; }
        .media-actions { display:flex; gap:8px; }
        .media-btn { border:1px solid #4b5563; background:#111827; color:#e5e7eb; border-radius:8px; padding:6px 10px; font-size:12px; font-weight:600; cursor:pointer; }
        .media-btn:hover { background:#1f2937; }
        .media-btn-danger { border-color:#7f1d1d; color:#fca5a5; }
        .media-empty { background:#111827; border:1px solid #374151; border-radius:12px; text-align:center; padding:40px 20px; color:#9ca3af; }
    </style>

    <div class="media-lib" x-data>
        <div class="media-head">
            <h2 class="media-title">Media Library</h2>
            <button type="button" class="media-upload-top" x-on:click="$refs.fileInput.click()">Upload Files</button>
        </div>

        <div class="media-dropzone">
            <div class="media-drop-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 16V4m0 0-4 4m4-4 4 4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 14v4a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p class="media-drop-title">Drop files to upload</p>
            <p class="media-drop-sub">Support for JPG, PNG, GIF, PDF, DOCX, XLSX, ZIP up to 50MB</p>

            <input x-ref="fileInput" type="file" multiple class="sr-only" wire:model="uploads" />
            <button type="button" class="media-select-link" x-on:click="$refs.fileInput.click()">Select files from your device</button>

            @if (!empty($uploads))
                <div class="media-upload-action">
                    <button type="button" wire:click="uploadFiles">Upload Selected</button>
                </div>
            @endif
        </div>

        <div class="media-toolbar">
            <div class="media-tabs">
                <button wire:click="$set('tab', 'all')" class="media-tab {{ $tab === 'all' ? 'active' : '' }}">All Assets</button>
                <button wire:click="$set('tab', 'images')" class="media-tab {{ $tab === 'images' ? 'active' : '' }}">Images</button>
                <button wire:click="$set('tab', 'files')" class="media-tab {{ $tab === 'files' ? 'active' : '' }}">Files</button>
            </div>
            <div class="media-controls">
                <input type="text" wire:model.live.debounce.300ms="search" class="media-input" placeholder="Search assets" />
                <select wire:model.live="sortBy" class="media-select">
                    <option value="latest">Date Modified</option>
                    <option value="oldest">Date Oldest</option>
                    <option value="name">Name</option>
                </select>
            </div>
        </div>

        @if ($mediaItems->isEmpty())
            <div class="media-empty">No media files found.</div>
        @else
            <div class="media-grid">
                @foreach ($mediaItems as $item)
                    <article class="media-card">
                        <div class="media-thumb">
                            @if ($item->file_type === 'image')
                                <img src="{{ $item->url }}" alt="{{ $item->title }}">
                            @else
                                <svg class="doc-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7z" stroke-linejoin="round"/>
                                    <path d="M14 2v5h5" stroke-linejoin="round"/>
                                </svg>
                            @endif
                        </div>
                        <div class="media-meta">
                            <p class="media-name">{{ $item->title ?: $item->original_name }}</p>
                            <p class="media-size">{{ number_format($item->size / 1024, 1) }} KB</p>
                            <div class="media-actions">
                                <button type="button" class="media-btn" x-on:click="navigator.clipboard.writeText('{{ $item->url }}')">Copy URL</button>
                                <button type="button" class="media-btn media-btn-danger" wire:click="removeMedia({{ $item->id }})" wire:confirm="Remove this media file?">Remove</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-filament-panels::page>

