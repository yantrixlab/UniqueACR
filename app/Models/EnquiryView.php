<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['enquiry_id', 'user_id'])]
class EnquiryView extends Model
{
    public function enquiry(): BelongsTo
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
