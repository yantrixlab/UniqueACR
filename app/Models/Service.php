<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['service_category_id', 'name', 'slug', 'service_type', 'segment', 'price', 'description', 'image_path', 'is_active', 'is_featured'])]
class Service extends Model
{
    protected function casts(): array
    {
        return [
            'price'       => 'decimal:2',
            'is_active'   => 'bool',
            'is_featured' => 'bool',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}
