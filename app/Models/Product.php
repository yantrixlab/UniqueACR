<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'product_category_id',
    'name',
    'slug',
    'brand',
    'price',
    'discount_price',
    'stock',
    'description',
    'specifications',
    'images',
    'is_featured',
    'meta_title',
    'meta_description',
    'is_active',
])]
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'images' => 'array',
            'specifications' => 'array',
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'is_featured' => 'bool',
            'is_active' => 'bool',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
