@use('App\Support\BookingSchedule')
@php
    $bkDates = BookingSchedule::dates();
    $bkSlots = BookingSchedule::slots();
    $bkNow = BookingSchedule::now();
    $bkSlug = old('service_slug', request('service'));
    $bkSvc = is_string($bkSlug) && $bkSlug !== ''
        ? \App\Models\Service::query()->where('slug', $bkSlug)->where('is_active', true)->first()
        : null;
    $bkSvcText = $bkSvc ? strtolower($bkSvc->service_type.' '.$bkSvc->name) : '';
    $bkDerived = match (true) {
        $bkSvc === null => null,
        str_contains($bkSvcText, 'microwave') => 'Microwave Oven Repair',
        str_contains($bkSvcText, 'uninstall') => 'Uninstallation',
        str_contains($bkSvcText, 'install') => 'Installation',
        str_contains($bkSvcText, 'amc') => 'AMC',
        str_contains($bkSvcText, 'repair') => 'Repair',
        str_contains($bkSvcText, 'maint'), str_contains($bkSvcText, 'servic') => 'Maintenance',
        default => null,
    };
    $bkService = old('service_type', request('service_type')) ?: $bkDerived;

    $bkSelectedDate = old('preferred_date');
    if (! $bkSelectedDate) {
        foreach ($bkDates as $bkCandidate) {
            if (BookingSchedule::hasAnySlotOn($bkCandidate)) {
                $bkSelectedDate = $bkCandidate->toDateString();
                break;
            }
        }
    }
    $bkSelected = $bkSelectedDate ? \Carbon\CarbonImmutable::parse($bkSelectedDate, BookingSchedule::TIMEZONE) : null;
@endphp
<div id="booking-form">
@if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('enquiries.store') }}" class="card booking-form">
    @csrf
    <input type="hidden" name="source_type" value="service_booking">

    <div class="vp" data-visit-picker
         data-today="{{ $bkNow->toDateString() }}"
         data-now-minutes="{{ $bkNow->hour * 60 + $bkNow->minute }}"
         data-lead="{{ BookingSchedule::LEAD_MINUTES }}">

        @if($bkSvc)
            <input type="hidden" name="service_slug" value="{{ $bkSvc->slug }}" data-booking-service-input>
            <div class="vp-service" data-booking-service>
                <span class="vp-service-text">
                    <small>Booking for</small>
                    <strong>{{ $bkSvc->name }}</strong>
                </span>
                <button type="button" class="vp-service-clear" data-booking-service-clear aria-label="Remove {{ $bkSvc->name }} from this booking" title="Remove">&times;</button>
            </div>
        @endif

        <fieldset class="vp-field">
            <legend class="vp-legend">Select Visit Date</legend>
            <div class="vp-dates-wrap">
                <button type="button" class="vp-nav vp-prev" aria-label="Show earlier dates" hidden>
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <div class="vp-dates" role="radiogroup" aria-label="Visit date">
                    @foreach($bkDates as $i => $bkDate)
                        @php
                            $bkValue = $bkDate->toDateString();
                            $bkAvailable = BookingSchedule::hasAnySlotOn($bkDate);
                            $bkTop = match (true) {
                                $i === 0 => 'Today',
                                $i === 1 => 'Tomorrow',
                                default => $bkDate->format('D'),
                            };
                        @endphp
                        <input class="vp-radio" type="radio" name="preferred_date" id="vp-date-{{ $bkValue }}" value="{{ $bkValue }}"
                               @checked($bkSelectedDate === $bkValue) @disabled(! $bkAvailable) required>
                        <label class="vp-date" for="vp-date-{{ $bkValue }}">
                            <span class="vp-date-top">{{ $bkTop }}</span>
                            <span class="vp-date-num">{{ $bkDate->format('j') }}</span>
                            <span class="vp-date-mon">{{ $bkDate->format('M') }}</span>
                        </label>
                    @endforeach
                </div>
                <button type="button" class="vp-nav vp-next" aria-label="Show later dates">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
            </div>
        </fieldset>

        <fieldset class="vp-field">
            <legend class="vp-legend">Preferred Time</legend>
            <div class="vp-slots" role="radiogroup" aria-label="Visit time">
                @foreach($bkSlots as $bkKey => $bkSlot)
                    <input class="vp-radio" type="radio" name="preferred_time" id="vp-time-{{ $bkKey }}" value="{{ $bkKey }}"
                           data-start="{{ $bkSlot['start'] }}"
                           @checked(old('preferred_time') === $bkKey)
                           @disabled($bkSelected && ! BookingSchedule::slotAvailableOn($bkSelected, $bkKey)) required>
                    <label class="vp-slot" for="vp-time-{{ $bkKey }}">{{ $bkSlot['label'] }}</label>
                @endforeach
            </div>
        </fieldset>
    </div>

    <div class="form-row two">
        <label>Full Name
            <input name="name" value="{{ old('name') }}" placeholder="John Doe" required>
        </label>
        <label>Phone Number
            <input name="phone" value="{{ old('phone') }}" placeholder="+91 90000 00000" required>
        </label>
    </div>

    <label>Service Type
        <select name="service_type" required>
            <option value="" disabled @selected(!$bkService)>Repair & Maintenance</option>
            <option value="Installation" @selected($bkService==='Installation')>Installation</option>
            <option value="Uninstallation" @selected($bkService==='Uninstallation')>Uninstallation</option>
            <option value="Repair" @selected($bkService==='Repair')>Repair</option>
            <option value="Maintenance" @selected($bkService==='Maintenance')>Maintenance</option>
            <option value="AMC" @selected($bkService==='AMC')>AMC</option>
            <option value="Microwave Oven Repair" @selected($bkService==='Microwave Oven Repair')>Microwave Oven Repair</option>
        </select>
    </label>

    <label>Address in Kolkata
        <textarea name="address" rows="3" placeholder="e.g. 3/87 C. R Colony, Jadavpur" required>{{ old('address') }}</textarea>
    </label>

    <label style="display:none">Email<input name="email" type="email" value="{{ old('email') }}"></label>
    <label style="display:none">Message<textarea name="message">{{ old('message','Website Booking Request') }}</textarea></label>

    <button class="btn" type="submit">Book Service Now</button>
</form>
</div>

<script>
(function () {
    document.addEventListener('click', function (e) {
        if (e.target.closest('[data-booking-service-clear]')) {
            var box = document.querySelector('[data-booking-service]');
            var input = document.querySelector('[data-booking-service-input]');
            if (box) { box.remove(); }
            if (input) { input.remove(); }
            return;
        }
        var trigger = e.target.closest('[data-service-type]');
        var select = document.querySelector('#booking-form select[name="service_type"]');
        if (trigger && select) { select.value = trigger.getAttribute('data-service-type'); }
    });

    document.querySelectorAll('[data-visit-picker]').forEach(function (root) {
        var strip = root.querySelector('.vp-dates');
        var prev = root.querySelector('.vp-prev');
        var next = root.querySelector('.vp-next');
        var dateInputs = root.querySelectorAll('input[name="preferred_date"]');
        var slotInputs = root.querySelectorAll('input[name="preferred_time"]');
        var today = root.getAttribute('data-today');
        var lead = parseInt(root.getAttribute('data-lead'), 10);
        var renderMinutes = parseInt(root.getAttribute('data-now-minutes'), 10);
        var loadedAt = Date.now();

        function selectedDate() {
            var checked = root.querySelector('input[name="preferred_date"]:checked');
            return checked ? checked.value : null;
        }

        function updateSlots() {
            var isToday = selectedDate() === today;
            var nowMinutes = renderMinutes + Math.floor((Date.now() - loadedAt) / 60000);
            slotInputs.forEach(function (input) {
                var blocked = isToday && (parseInt(input.getAttribute('data-start'), 10) * 60 <= nowMinutes + lead);
                input.disabled = blocked;
                if (blocked && input.checked) { input.checked = false; }
            });
        }

        function updateArrows() {
            var max = strip.scrollWidth - strip.clientWidth - 2;
            prev.hidden = strip.scrollLeft <= 2;
            next.hidden = strip.scrollLeft >= max;
        }

        function centerSelected(smooth) {
            var checked = root.querySelector('input[name="preferred_date"]:checked');
            var chip = checked && checked.nextElementSibling;
            if (!chip) { return; }
            strip.scrollTo({
                left: chip.offsetLeft - (strip.clientWidth - chip.offsetWidth) / 2,
                behavior: smooth ? 'smooth' : 'auto'
            });
        }

        dateInputs.forEach(function (input) {
            input.addEventListener('change', function () { updateSlots(); centerSelected(true); });
        });
        prev.addEventListener('click', function () { strip.scrollBy({ left: -strip.clientWidth * 0.8, behavior: 'smooth' }); });
        next.addEventListener('click', function () { strip.scrollBy({ left: strip.clientWidth * 0.8, behavior: 'smooth' }); });
        strip.addEventListener('scroll', updateArrows, { passive: true });
        window.addEventListener('resize', updateArrows);

        updateSlots();
        centerSelected(false);
        updateArrows();
    });
})();
</script>
