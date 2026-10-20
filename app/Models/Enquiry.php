<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'phone', 'email', 'message', 'source_type', 'source_id', 'preferred_date', 'preferred_time', 'status'])]
class Enquiry extends Model
{
    public const SERVICE_BOOKING = 'service_booking';

    protected function casts(): array
    {
        return [
            'preferred_date' => 'date:Y-m-d',
        ];
    }

    public function scopeBookings(Builder $query): Builder
    {
        return $query->where('source_type', self::SERVICE_BOOKING);
    }

    /** Every enquiry that is not a service booking (including ones with no source type). */
    public function scopeOtherEnquiries(Builder $query): Builder
    {
        return $query->where(fn (Builder $q) => $q
            ->whereNull('source_type')
            ->orWhere('source_type', '!=', self::SERVICE_BOOKING));
    }
}
