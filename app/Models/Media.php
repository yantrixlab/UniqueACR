<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'media_category_id',
        'title',
        'original_name',
        'file_name',
        'path',
        'disk',
        'mime_type',
        'size',
        'extension',
        'file_type',
        'alt_text',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'is_active' => 'bool',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MediaCategory::class, 'media_category_id');
    }

    public function getUrlAttribute(): string
    {
        if (Str::startsWith((string) $this->path, ['http://', 'https://'])) {
            return (string) $this->path;
        }

        return Storage::disk($this->disk ?: 'public')->url($this->path);
    }
}
