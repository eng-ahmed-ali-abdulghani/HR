@extends('dachboard.layouts.app')

@section('title')
    Edit Your Contact Information
@endsection

@section('content')
    <div class="container">
        <form class="edit_contact main_form" method="POST" action="{{ route('contacts.update', $contact['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updating the record -->
            <div class="mb-3 w-100">
                <label for="contactaddressEn" class="form-label">English address</label>
                <input type="text" class="form-control" id="contactaddressEn" name="address_en"
                    value="{{ old('address_en', $contact['address_en']) }}">
                <span class="error-message text-danger" id="contactaddressEnError" style="display:none;">English address is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="contactaddressAr" class="form-label">Arabic address</label>
                <input type="text" class="form-control" id="contactaddressAr" name="address_ar"
                    value="{{ old('address_ar', $contact['address_ar']) }}">
                <span class="error-message text-danger" id="contactaddressArError" style="display:none;">Arabic address is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="contacthoursEn" class="form-label">English Hours</label>
                <input name="hours_en" type="text" class="form-control" id="contacthoursEn"
                    value="{{ old('hours_en', $contact['hours_en']) }}">
                <span class="error-message text-danger" id="hoursEnError" style="display:none;">English
                    Hours is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="contacthoursAr" class="form-label">Arabic Hours</label>
                <input name="hours_ar" type="text" class="form-control" id="contacthoursAr"
                    value="{{ old('hours_ar', $contact['hours_ar']) }}">
                <span class="error-message text-danger" id="hoursArError" style="display:none;">Arabic
                    Hours is required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="locationEn" class="form-label">English Location</label>
                <input name="location_en" type="text" class="form-control" id="locationEn"
                    value="{{ old('location_en', $contact['location_en']) }}">
                <span class="error-message text-danger" id="locationEnError" style="display:none;">English Location is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="locationAr" class="form-label">Arabic Location</label>
                <input name="location_ar" type="text" class="form-control" id="locationAr"
                    value="{{ old('location_ar', $contact['location_ar']) }}">
                <span class="error-message text-danger" id="locationArError" style="display:none;">Arabic Location is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="email" class="form-label">English Email</label>
                <input name="email" type="text" class="form-control" id="email"
                    value="{{ old('email', $contact['email']) }}">
                <span class="error-message text-danger" id="emailError" style="display:none;">Email is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" type="text" class="form-control" id="phone"
                    value="{{ old('phone', $contact['phone']) }}">
                <span class="error-message text-danger" id="PhoneError" style="display:none;">Phone is
                    required.</span>
            </div>


            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-success">Update</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.edit_contact');

            const addressEn = document.querySelector('#contactaddressEn');
            const addressAr = document.querySelector('#contactaddressAr');

            const hoursEn = document.querySelector('#contacthoursEn');
            const hoursAr = document.querySelector('#contacthoursAr');

            const locationEn = document.querySelector('#locationEn');
            const locationAr = document.querySelector('#locationAr');

            const email = document.querySelector('#email');
            const phone = document.querySelector('#phone');

            const addressEnError = document.getElementById('contactaddressEnError');
            const addressArError = document.getElementById('contactaddressArError');

            const locationEnError = document.getElementById('locationEnError');
            const locationArError = document.getElementById('locationArError');

            const emailError = document.getElementById('emailError');
            const PhoneError = document.getElementById('PhoneError');

            const HoursEnError = document.getElementById('hoursEnError');
            const HoursArError = document.getElementById('hoursArError');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate fields
                if (addressEn.value.trim() === '') {
                    addressEnError.style.display = 'block';
                    valid = false;
                } else {
                    addressEnError.style.display = 'none';
                }
                if (addressAr.value.trim() === '') {
                    addressArError.style.display = 'block';
                    valid = false;
                } else {
                    addressArError.style.display = 'none';
                }
                if (hoursEn.value.trim() === '') {
                    HoursEnError.style.display = 'block';
                    valid = false;
                } else {
                    HoursEnError.style.display = 'none';
                }
                if (hoursAr.value.trim() === '') {
                    HoursArError.style.display = 'block';
                    valid = false;
                } else {
                    HoursArError.style.display = 'none';
                }
                if (locationEn.value.trim() === '') {
                    locationEnError.style.display = 'block';
                    valid = false;
                } else {
                    locationEnError.style.display = 'none';
                }
                if (locationAr.value.trim() === '') {
                    locationArError.style.display = 'block';
                    valid = false;
                } else {
                    locationArError.style.display = 'none';
                }
                if (email.value.trim() === '') {
                    emailError.style.display = 'block';
                    valid = false;
                } else {
                    emailError.style.display = 'none';
                }
                if (phone.value.trim() === '') {
                    PhoneError.style.display = 'block';
                    valid = false;
                } else {
                    PhoneError.style.display = 'none';
                }


                if (!valid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
