<x-filament-panels::page>
    <div class="space-y-6" x-data>
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold tracking-tight text-white">Media Library</h2>
            <button
                type="button"
                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500"
                x-on:click="$refs.fileInput.click()"
            >
                Upload Files
            </button>
        </div>

        <div class="rounded-xl border border-dashed border-gray-600 bg-gray-900/60 p-10 text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-blue-500/20 text-blue-400">
                <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 16V4m0 0-4 4m4-4 4 4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 14v4a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p class="text-2xl font-semibold text-white">Drop files to upload</p>
            <p class="mt-1 text-sm text-gray-300">Support for JPG, PNG, GIF, PDF, DOCX, XLSX, ZIP up to 50MB</p>

            <input
                x-ref="fileInput"
                type="file"
                multiple
                class="sr-only"
                wire:model="uploads"
            />

            <button
                type="button"
                class="mt-5 text-sm font-semibold text-blue-400 hover:text-blue-300"
                x-on:click="$refs.fileInput.click()"
            >
                Select files from your device
            </button>

            @error('uploads') <p class="mt-3 text-sm text-red-400">{{ $message }}</p> @enderror
            @error('uploads.*') <p class="mt-3 text-sm text-red-400">{{ $message }}</p> @enderror

            @if (!empty($uploads))
                <div class="mt-4">
                    <button
                        type="button"
                        wire:click="uploadFiles"
                        class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500"
                    >
                        Upload Selected
                    </button>
                </div>
            @endif
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-gray-700 pb-3">
            <div class="flex items-center gap-6 text-sm font-medium">
                <button wire:click="$set('tab', 'all')" class="{{ $tab === 'all' ? 'text-blue-400' : 'text-gray-400 hover:text-gray-200' }}">All Assets</button>
                <button wire:click="$set('tab', 'images')" class="{{ $tab === 'images' ? 'text-blue-400' : 'text-gray-400 hover:text-gray-200' }}">Images</button>
                <button wire:click="$set('tab', 'files')" class="{{ $tab === 'files' ? 'text-blue-400' : 'text-gray-400 hover:text-gray-200' }}">Files</button>
            </div>

            <div class="flex items-center gap-3">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search assets"
                    class="rounded-lg border border-gray-700 bg-gray-900 px-3 py-2 text-sm text-white placeholder:text-gray-500"
                />
                <select wire:model.live="sortBy" class="rounded-lg border border-gray-700 bg-gray-900 px-3 py-2 text-sm text-white">
                    <option value="latest">Date Modified</option>
                    <option value="oldest">Date Oldest</option>
                    <option value="name">Name</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 xl:grid-cols-4">
            @forelse ($mediaItems as $item)
                <article class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">
                    <div class="aspect-[16/10] bg-gray-800">
                        @if ($item->file_type === 'image')
                            <img src="{{ $item->url }}" alt="{{ $item->title }}" class="h-full w-full object-cover" />
                        @else
                            <div class="flex h-full items-center justify-center text-gray-400">
                                <svg viewBox="0 0 24 24" class="h-12 w-12" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7z" stroke-linejoin="round"/>
                                    <path d="M14 2v5h5" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2 p-3">
                        <h3 class="truncate text-sm font-semibold text-white">{{ $item->title ?: $item->original_name }}</h3>
                        <p class="text-xs text-gray-400">{{ number_format($item->size / 1024, 1) }} KB</p>
                        <div class="flex items-center gap-2">
                            <button
                                type="button"
                                class="inline-flex items-center rounded-md border border-gray-600 px-3 py-1.5 text-xs font-medium text-gray-100 hover:bg-gray-800"
                                x-on:click="navigator.clipboard.writeText('{{ $item->url }}')"
                            >
                                Copy URL
                            </button>
                            <button
                                type="button"
                                wire:click="removeMedia({{ $item->id }})"
                                wire:confirm="Remove this media file?"
                                class="inline-flex items-center rounded-md border border-red-800 px-3 py-1.5 text-xs font-medium text-red-300 hover:bg-red-900/30"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-xl border border-gray-700 bg-gray-900 p-10 text-center text-gray-400">
                    No media files found.
                </div>
            @endforelse
        </div>
    </div>
</x-filament-panels::page>
