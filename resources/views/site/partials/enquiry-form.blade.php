@if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('enquiries.store') }}" class="card booking-form">
    @csrf
    <input type="hidden" name="source_type" value="service_booking">

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
            <option value="" disabled @selected(!old('service_type'))>Repair & Maintenance</option>
            <option value="Installation" @selected(old('service_type')==='Installation')>Installation</option>
            <option value="Uninstallation" @selected(old('service_type')==='Uninstallation')>Uninstallation</option>
            <option value="Repair" @selected(old('service_type')==='Repair')>Repair</option>
            <option value="Maintenance" @selected(old('service_type')==='Maintenance')>Maintenance</option>
            <option value="AMC" @selected(old('service_type')==='AMC')>AMC</option>
        </select>
    </label>

    <label>Address in Kolkata
        <textarea name="address" rows="3" placeholder="e.g. 3/87 C. R Colony, Jadavpur" required>{{ old('address') }}</textarea>
    </label>

    <label style="display:none">Email<input name="email" type="email" value="{{ old('email') }}"></label>
    <label style="display:none">Message<textarea name="message">{{ old('message','Website Booking Request') }}</textarea></label>

    <button class="btn" type="submit">Book Service Now</button>
</form>
