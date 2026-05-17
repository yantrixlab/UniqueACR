<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'designation', 'rating', 'message', 'is_active'])]
class Testimonial extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'bool',
        ];
    }
}
