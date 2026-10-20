<?php

namespace App\Http\Requests;

use App\Support\BookingSchedule;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:120'],
            'message' => ['required', 'string', 'max:2000'],
            'service_type' => ['nullable', 'string', 'max:80'],
            'address' => ['nullable', 'string', 'max:255'],
            'source_type' => ['nullable', 'in:service,product,general,service_booking'],
            'source_id' => ['nullable', 'integer'],
            'service_slug' => ['nullable', 'string', 'max:150'],
            'preferred_date' => [
                'nullable',
                'required_if:source_type,service_booking',
                'date_format:Y-m-d',
                'after_or_equal:'.BookingSchedule::today()->toDateString(),
                'before_or_equal:'.BookingSchedule::lastBookableDate()->toDateString(),
            ],
            'preferred_time' => [
                'nullable',
                'required_if:source_type,service_booking',
                Rule::in(array_keys(BookingSchedule::slots())),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'preferred_date.required_if' => 'Please select a visit date.',
            'preferred_date.after_or_equal' => 'Please select a visit date from today onwards.',
            'preferred_date.before_or_equal' => 'Please select a visit date within the next '.BookingSchedule::DAYS_AHEAD.' days.',
            'preferred_time.required_if' => 'Please select a preferred visit time.',
            'preferred_time.in' => 'Please select a valid visit time.',
        ];
    }

    /**
     * @return array<int, \Closure(Validator): void>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $date = $this->input('preferred_date');
                $slot = $this->input('preferred_time');

                if ($validator->errors()->hasAny(['preferred_date', 'preferred_time']) || ! $date || ! $slot) {
                    return;
                }

                if (! BookingSchedule::slotAvailableOn(CarbonImmutable::parse($date, BookingSchedule::TIMEZONE), $slot)) {
                    $validator->errors()->add('preferred_time', 'That time slot is no longer available today. Please choose a later slot or another date.');
                }
            },
        ];
    }

    /**
     * Returns the submitted slot as its human-readable label (e.g. "9 AM – 11 AM").
     */
    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        if (! empty($data['preferred_time'])) {
            $data['preferred_time'] = BookingSchedule::label($data['preferred_time']);
        }

        return $key === null ? $data : data_get($data, $key, $default);
    }
}
