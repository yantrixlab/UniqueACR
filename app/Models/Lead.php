<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'phone', 'email', 'answers', 'status'])]
class Lead extends Model
{
    protected function casts(): array
    {
        return [
            'answers' => 'array',
        ];
    }
}
