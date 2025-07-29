@extends('dachboard.layouts.app')

@section('title')
    Create Event & New
@endsection

@section('content')
    <div class="container">
        <form class="create_banner main_form" method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="bannerNameEn" class="form-label">English Event Title</label>
                <input type="text" class="form-control" id="bannerNameEn" name="name_en">
                <span class="error-message text-danger" id="bannerNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="bannerNameAr" class="form-label">Arabic Event Title</label>
                <input type="text" class="form-control" id="bannerNameAr" name="name_ar">
                <span class="error-message text-danger" id="bannerNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="bannerDescEn" class="form-label">English Event Description</label>
                <input name="description_en" type="text" class="form-control" id="bannerDescEn">
                <span class="error-message text-danger" id="bannerDescriptionEnError" style="display:none;">English
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="bannerDescAr" class="form-label">Arabic Event Description</label>
                <input name="description_ar" type="text" class="form-control" id="bannerDescAr">
                <span class="error-message text-danger" id="bannerDescriptionArError" style="display:none;">Arabic
                    Description is required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="eventDate" class="form-label">Date</label>
                <input name="date" type="date" class="form-control" id="eventDate">
                <span class="error-message text-danger" id="eventDateError" style="display:none;">Date is required.</span>
            </div>

            <!-- Dropdown for Divisions -->
            <div class="mb-3 w-100">
                <label for="divisionSelect" class="form-label">Select Division</label>
                <select class="form-control" id="divisionSelect" name="division_id">
                    <option value="">-- Select Division --</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division['id'] }}">{{ $division['name'] }}</option>
                    @endforeach
                </select>
                <span class="error-message text-danger" id="divisionSelectError" style="display:none;">Please select a
                    division.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="bannerPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="bannerPhoto" name="photo">
                <span class="error-message text-danger" id="photo-error" style="display:none;">Photo is required.</span>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.create_banner');
            const nameEn = document.querySelector('#bannerNameEn');
            const nameAr = document.querySelector('#bannerNameAr');
            const descriptionEn = document.querySelector('#bannerDescEn');
            const descriptionAr = document.querySelector('#bannerDescAr');
            const date = document.querySelector('#eventDate');
            const divisionSelect = document.querySelector('#divisionSelect');
            const photo = document.querySelector('#bannerPhoto');

            const nameEnError = document.getElementById('bannerNameEnError');
            const nameArError = document.getElementById('bannerNameArError');
            const descriptionEnError = document.getElementById('bannerDescriptionEnError');
            const descriptionArError = document.getElementById('bannerDescriptionArError');
            const eventDateError = document.getElementById('eventDateError');
            const divisionSelectError = document.getElementById('divisionSelectError');
            const photoError = document.getElementById('photo-error');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate Banner Name
                if (nameEn.value.trim() === '') {
                    nameEnError.style.display = 'block';
                    valid = false;
                } else {
                    nameEnError.style.display = 'none';
                }
                if (nameAr.value.trim() === '') {
                    nameArError.style.display = 'block';
                    valid = false;
                } else {
                    nameArError.style.display = 'none';
                }

                // Validate Banner Description
                if (descriptionEn.value.trim() === '') {
                    descriptionEnError.style.display = 'block';
                    valid = false;
                } else {
                    descriptionEnError.style.display = 'none';
                }
                if (descriptionAr.value.trim() === '') {
                    descriptionArError.style.display = 'block';
                    valid = false;
                } else {
                    descriptionArError.style.display = 'none';
                }

                // Validate Date
                if (date.value.trim() === '') {
                    eventDateError.style.display = 'block';
                    valid = false;
                } else {
                    eventDateError.style.display = 'none';
                }

                // Validate Division Selection
                if (divisionSelect.value === '') {
                    divisionSelectError.style.display = 'block';
                    valid = false;
                } else {
                    divisionSelectError.style.display = 'none';
                }

                // Validate Photo
                if (photo.files.length === 0) {
                    photoError.style.display = 'block';
                    valid = false;
                } else {
                    photoError.style.display = 'none';
                }

                // Prevent form submission if validation fails
                if (!valid) {
                    e.preventDefault();
                }
            });

            // Hide error message when user starts interacting
            divisionSelect.addEventListener('change', function() {
                if (divisionSelect.value !== '') {
                    divisionSelectError.style.display = 'none';
                }
            });
        });
    </script>
@endpush
