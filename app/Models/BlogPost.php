<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['author_id', 'title', 'slug', 'focus_keyword', 'content', 'featured_image', 'meta_title', 'meta_description', 'meta_keywords', 'published_at', 'is_published'])]
class BlogPost extends Model
{
    protected function casts(): array
    {
        return [
            'is_published' => 'bool',
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
