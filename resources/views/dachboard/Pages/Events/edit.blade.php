@extends('dachboard.layouts.app')

@section('title')
    Edit Event
@endsection

@section('content')
    <div class="container">
        <form class="edit_banner main_form" method="POST" action="{{ route('events.update', $event['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 w-100">
                <label for="bannerNameEn" class="form-label">English Event Title</label>
                <input type="text" class="form-control" id="bannerNameEn" name="name_en"
                    value="{{ old('name_en', $event['name_en']) }}">
                <span class="error-message text-danger" id="bannerNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="bannerNameAr" class="form-label">Arabic Event Title</label>
                <input type="text" class="form-control" id="bannerNameAr" name="name_ar"
                    value="{{ old('name_ar', $event['name_ar']) }}">
                <span class="error-message text-danger" id="bannerNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="bannerDescEn" class="form-label">English Event Description</label>
                <input name="description_en" type="text" class="form-control" id="bannerDescEn"
                    value="{{ old('description_en', $event['description_en']) }}">
                <span class="error-message text-danger" id="bannerDescriptionEnError" style="display:none;">English
                    Description is required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="bannerDescAr" class="form-label">Arabic Event Description</label>
                <input name="description_ar" type="text" class="form-control" id="bannerDescAr"
                    value="{{ old('description_ar', $event['description_ar']) }}">
                <span class="error-message text-danger" id="bannerDescriptionArError" style="display:none;">Arabic
                    Description is required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="eventDate" class="form-label">Date</label>
                <input name="date" type="date" class="form-control" id="eventDate"
                    value="{{ old('date', $event['date']) }}">
                <span class="error-message text-danger" id="eventDateError" style="display:none;">Date is required.</span>
            </div>

            {{-- Divisions dropdown --}}
            <div class="mb-3 w-100">
                <label for="division" class="form-label">Choose Division</label>
                <select class="form-control" id="division" name="division_id">
                    <option value="">Select Division</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division['id'] }}"
                            {{ old('division_id', $event['division_id']) == $division['id'] ? 'selected' : '' }}>
                            {{ $division['name'] }}
                        </option>
                    @endforeach
                </select>
                <span class="error-message text-danger" id="divisionError" style="display:none;">Division is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="bannerPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="bannerPhoto" name="photo">
                @if ($event['photo'])
                    <p>Current photo: <img src="{{ $event['photo'] }}" alt="Event image" width="100"></p>
                @endif
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
            const form = document.querySelector('.edit_banner');
            const nameEn = document.querySelector('#bannerNameEn');
            const nameAr = document.querySelector('#bannerNameAr');
            const descriptionEn = document.querySelector('#bannerDescEn');
            const descriptionAr = document.querySelector('#bannerDescAr');
            const date = document.querySelector('#eventDate');
            const division = document.querySelector('#division');
            const photo = document.querySelector('#bannerPhoto');

            const nameEnError = document.getElementById('bannerNameEnError');
            const nameArError = document.getElementById('bannerNameArError');
            const descriptionEnError = document.getElementById('bannerDescriptionEnError');
            const descriptionArError = document.getElementById('bannerDescriptionArError');
            const eventDateError = document.getElementById('eventDateError');
            const divisionError = document.getElementById('divisionError');
            const photoError = document.getElementById('photo-error');

            form.addEventListener('submit', function(e) {
                let valid = true;

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

                if (date.value.trim() === '') {
                    eventDateError.style.display = 'block';
                    valid = false;
                } else {
                    eventDateError.style.display = 'none';
                }

                if (division.value === '') {
                    divisionError.style.display = 'block';
                    valid = false;
                } else {
                    divisionError.style.display = 'none';
                }

                if (photo.files.length === 0 && !document.querySelector('img')) {
                    photoError.style.display = 'block';
                    valid = false;
                } else {
                    photoError.style.display = 'none';
                }

                if (!valid) {
                    e.preventDefault();
                }
            });

            nameEn.addEventListener('input', function() {
                if (nameEn.value.trim() !== '') {
                    nameEnError.style.display = 'none';
                }
            });

            nameAr.addEventListener('input', function() {
                if (nameAr.value.trim() !== '') {
                    nameArError.style.display = 'none';
                }
            });

            descriptionEn.addEventListener('input', function() {
                if (descriptionEn.value.trim() !== '') {
                    descriptionEnError.style.display = 'none';
                }
            });

            descriptionAr.addEventListener('input', function() {
                if (descriptionAr.value.trim() !== '') {
                    descriptionArError.style.display = 'none';
                }
            });

            division.addEventListener('change', function() {
                if (division.value !== '') {
                    divisionError.style.display = 'none';
                }
            });

            photo.addEventListener('input', function() {
                if (photo.files.length > 0) {
                    photoError.style.display = 'none';
                }
            });
        });
    </script>
@endpush
