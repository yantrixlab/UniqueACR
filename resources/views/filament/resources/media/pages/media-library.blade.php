<x-filament-panels::page>
    <style>
        .media-lib { color: #e5e7eb; }
        .media-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; flex-wrap:wrap; gap:10px; }
        .media-title { margin:0; font-size:30px; font-weight:700; letter-spacing:-0.02em; }
        .media-head-actions { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
        .media-upload-top { background:#2563eb; color:#fff; border:none; border-radius:10px; padding:10px 16px; font-weight:600; cursor:pointer; }
        .media-upload-top:hover { background:#1d4ed8; }

        /* Backup / Restore buttons */
        .media-btn-export { background:#065f46; color:#6ee7b7; border:1px solid #047857; border-radius:10px; padding:9px 15px; font-weight:600; cursor:pointer; font-size:13px; display:inline-flex; align-items:center; gap:6px; text-decoration:none; }
        .media-btn-export:hover { background:#047857; color:#fff; }
        .media-btn-import { background:#1e1b4b; color:#a5b4fc; border:1px solid #3730a3; border-radius:10px; padding:9px 15px; font-weight:600; cursor:pointer; font-size:13px; display:inline-flex; align-items:center; gap:6px; }
        .media-btn-import:hover { background:#3730a3; color:#fff; }
        .media-btn-scan { background:#1c1917; color:#fb923c; border:1px solid #c2410c; border-radius:10px; padding:9px 15px; font-weight:600; cursor:pointer; font-size:13px; display:inline-flex; align-items:center; gap:6px; }
        .media-btn-scan:hover { background:#c2410c; color:#fff; }
        .media-btn-scan:disabled { opacity:.6; cursor:not-allowed; }
        .media-import-form { display:inline; }
        .media-notice { border-radius:10px; padding:11px 16px; margin-bottom:14px; font-size:14px; font-weight:500; }
        .media-notice-success { background:#064e3b; color:#6ee7b7; border:1px solid #047857; }
        .media-notice-error   { background:#450a0a; color:#fca5a5; border:1px solid #991b1b; }

        .media-dropzone { border:1px dashed #374151; background:#111827; border-radius:14px; padding:34px 20px; text-align:center; }
        .media-dropzone.dragover { border-color:#60a5fa; background:#0f1b33; }
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

    <div class="media-lib" x-data="{
        isDragging: false,
        handleDrop(event) {
            const files = Array.from(event.dataTransfer.files || []);
            if (!files.length) return;
            this.isDragging = false;
            $wire.uploadMultiple('uploads', files, () => {}, () => {}, () => {});
        }
    }">
        {{-- Flash notices --}}
        @php
            $importSuccess = session('import_success') ?: (isset($errors) && $errors->has('zip_file') ? null : null);
            $importError   = session('import_error') ?? ($errors->has('zip_file') ? $errors->first('zip_file') : null);
        @endphp
        @if($importSuccess ?? false)
            <div class="media-notice media-notice-success" style="font-size:13px;margin-bottom:10px;">✅ {{ $importSuccess }}</div>
        @endif
        @if($importError ?? false)
            <div class="media-notice media-notice-error" style="font-size:13px;margin-bottom:10px;">❌ {{ $importError }}</div>
        @endif

        <div class="media-head">
            <h2 class="media-title">Media Library</h2>
            <div class="media-head-actions"
                 x-data="{
                    serverBackup: null,
                    restoring: false,
                    init() {
                        fetch('{{ route('admin.media.backup-status') }}')
                            .then(r => r.json())
                            .then(d => { this.serverBackup = d; });
                    }
                 }">

                {{-- Export ZIP --}}
                <a href="{{ route('admin.media.export') }}"
                   class="media-btn-export"
                   title="Download all media files as a ZIP backup. A copy is also kept on the server for one-click restore.">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Export ZIP
                </a>

                {{-- Restore from server backup (primary — no upload needed) --}}
                <template x-if="serverBackup && serverBackup.exists">
                    <form method="POST" action="{{ route('admin.media.restore-from-server') }}" x-ref="serverRestoreForm">
                        @csrf
                        <button type="submit"
                                class="media-btn-restore-server"
                                x-on:click="restoring = true"
                                :disabled="restoring"
                                :title="`Restore from server backup (${serverBackup.size}, saved ${serverBackup.modified})`">
                            <template x-if="!restoring">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/></svg>
                            </template>
                            <template x-if="restoring">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="animation:spin 1s linear infinite"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                            </template>
                            <span x-text="restoring ? 'Restoring…' : 'Restore from Server'"></span>
                            <span x-text="`(${serverBackup.size})`" style="opacity:.7;font-size:11px;"></span>
                        </button>
                    </form>
                </template>

                {{-- Chunked ZIP Import — bypasses PHP upload_max_filesize entirely --}}
                <div x-data="chunkUploader('{{ route('admin.media.chunk-upload') }}','{{ route('admin.media.chunk-assemble') }}','{{ csrf_token() }}')"
                     style="display:inline-flex;align-items:center;gap:8px;">

                    <input type="file" accept=".zip" class="sr-only" x-ref="zipInput"
                           x-on:change="startUpload($event.target.files[0])">

                    <button type="button" class="media-btn-import"
                            x-on:click="$refs.zipInput.click()"
                            :disabled="uploading"
                            title="Upload & restore a ZIP backup — splits into small chunks to bypass server upload limits">
                        <template x-if="!uploading">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </template>
                        <span x-text="uploading ? label : 'Import ZIP'"></span>
                    </button>

                    {{-- Progress bar --}}
                    <div x-show="uploading" style="width:120px;background:#374151;border-radius:4px;height:6px;overflow:hidden;">
                        <div :style="`width:${progress}%;background:#60a5fa;height:100%;transition:width .3s`"></div>
                    </div>
                    <span x-show="uploading" x-text="progress + '%'" style="font-size:12px;color:#9ca3af;min-width:32px;"></span>
                </div>

                <script>
                function chunkUploader(uploadUrl, assembleUrl, csrfToken) {
                    return {
                        uploading: false,
                        progress: 0,
                        label: 'Uploading…',
                        // 1 MB per chunk — safe even on servers with upload_max_filesize = 2M
                        // Raw binary body bypasses upload_max_filesize entirely anyway
                        CHUNK_SIZE: 1 * 1024 * 1024,

                        async startUpload(file) {
                            if (!file) return;
                            this.uploading = true;
                            this.progress = 0;
                            this.label = 'Uploading…';

                            const uuid   = crypto.randomUUID();
                            const total  = Math.ceil(file.size / this.CHUNK_SIZE);
                            let uploaded = 0;

                            for (let i = 0; i < total; i++) {
                                const start     = i * this.CHUNK_SIZE;
                                const chunkBlob = file.slice(start, start + this.CHUNK_SIZE);
                                const chunkBuf  = await chunkBlob.arrayBuffer();

                                // Send as raw binary body — NOT multipart file upload.
                                // This means upload_max_filesize does NOT apply at all.
                                const res = await fetch(
                                    `${uploadUrl}?uuid=${uuid}&index=${i}&total=${total}`,
                                    {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Content-Type': 'application/octet-stream',
                                        },
                                        body: chunkBuf,
                                    }
                                );

                                if (!res.ok) {
                                    const err = await res.json().catch(() => ({}));
                                    alert('❌ Chunk ' + i + ' failed: ' + (err.error ?? res.status));
                                    this.uploading = false;
                                    return;
                                }

                                uploaded++;
                                this.progress = Math.round((uploaded / total) * 88);
                            }

                            // All chunks sent — assemble & restore
                            this.label = 'Restoring…';
                            this.progress = 92;

                            const fd = new FormData();
                            fd.append('_token', csrfToken);
                            fd.append('uuid', uuid);
                            fd.append('total', total);
                            fd.append('force', '1');

                            const res2 = await fetch(assembleUrl, { method: 'POST', body: fd });
                            let data = {};
                            try { data = await res2.json(); } catch (e) { data = { ok: false, message: 'Server error during restore. Check logs.' }; }

                            this.progress = 100;
                            this.uploading = false;

                            alert((data.ok ? '✅ ' : '❌ ') + (data.message ?? 'No response from server.'));
                            if (data.ok) window.location.reload();
                        }
                    }
                }
                </script>

                {{-- Scan disk & sync DB — zero-upload restore --}}
                <button type="button"
                        class="media-btn-scan"
                        wire:click="scanAndSync"
                        wire:loading.attr="disabled"
                        wire:target="scanAndSync"
                        title="Scan storage/media/ on disk and add any files missing from the library — no upload needed">
                    <span wire:loading.remove wire:target="scanAndSync">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/><path d="M11 8v6M8 11h6"/></svg>
                    </span>
                    <span wire:loading wire:target="scanAndSync">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    </span>
                    <span wire:loading.remove wire:target="scanAndSync">Scan & Sync</span>
                    <span wire:loading wire:target="scanAndSync">Scanning…</span>
                </button>

                {{-- Upload Files --}}
                <button type="button" class="media-upload-top" x-on:click="$refs.fileInput.click()">Upload Files</button>
            </div>
        </div>

        <style>
        @keyframes spin { to { transform: rotate(360deg); } }
        .media-btn-restore-server {
            background: #1e3a5f; color: #60a5fa;
            border: 1px solid #2563eb; border-radius: 10px;
            padding: 9px 15px; font-weight: 600; cursor: pointer;
            font-size: 13px; display: inline-flex; align-items: center; gap: 6px;
            transition: background .2s;
        }
        .media-btn-restore-server:hover:not(:disabled) { background: #1d4ed8; color: #fff; }
        .media-btn-restore-server:disabled { opacity: .6; cursor: not-allowed; }
        </style>

        <div class="media-dropzone"
             :class="{ 'dragover': isDragging }"
             x-on:dragenter.prevent="isDragging = true"
             x-on:dragover.prevent="isDragging = true"
             x-on:dragleave.prevent="isDragging = false"
             x-on:drop.prevent="handleDrop($event)">
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
