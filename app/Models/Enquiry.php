<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'phone', 'email', 'message', 'source_type', 'source_id', 'preferred_date', 'preferred_time', 'status'])]
class Enquiry extends Model
{
    public const SERVICE_BOOKING = 'service_booking';

    protected $appends = ['requested_service'];

    protected $hidden = ['requestedServiceRecord'];

    protected function casts(): array
    {
        return [
            'preferred_date' => 'date:Y-m-d',
        ];
    }

    public function requestedServiceRecord(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'source_id');
    }

    /** Name of the service the customer chose (service bookings and service enquiries only). */
    protected function requestedService(): Attribute
    {
        return Attribute::get(fn (): ?string => in_array($this->source_type, [self::SERVICE_BOOKING, 'service'], true) && $this->source_id
            ? $this->requestedServiceRecord?->name
            : null);
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
