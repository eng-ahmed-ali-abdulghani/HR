@extends('dachboard.layouts.app')

@section('title')
    Edit Profile
@endsection

@section('content')
    <div class="container">
        <form class="edit_profile main_form" method="POST" action="{{ route('profiles.update', $profile->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 w-100">
                <label for="profileNameEn" class="form-label">English Profile Name</label>
                <input type="text" class="form-control" id="profileNameEn" name="name_en"
                    value="{{ old('name_en', $profile->name_en) }}">
                <span class="error-message text-danger" id="profileNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="profileNameAr" class="form-label">Arabic Profile Name</label>
                <input type="text" class="form-control" id="profileNameAr" name="name_ar"
                    value="{{ old('name_ar', $profile->name_ar) }}">
                <span class="error-message text-danger" id="profileNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="year" name="year"
                    value="{{ old('year', $profile->year) }}">
                <span class="error-message text-danger" id="yearError" style="display:none;">Year is required.</span>
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
            const form = document.querySelector('.edit_profile');
            const nameEn = document.querySelector('#profileNameEn');
            const nameAr = document.querySelector('#profileNameAr');
            const year = document.querySelector('#year');

            const nameEnError = document.getElementById('profileNameEnError');
            const nameArError = document.getElementById('profileNameArError');
            const yearError = document.getElementById('yearError');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate English Name
                if (nameEn.value.trim() === '') {
                    nameEnError.style.display = 'block';
                    valid = false;
                } else {
                    nameEnError.style.display = 'none';
                }

                // Validate Arabic Name
                if (nameAr.value.trim() === '') {
                    nameArError.style.display = 'block';
                    valid = false;
                } else {
                    nameArError.style.display = 'none';
                }

                // Validate Year
                if (year.value.trim() === '') {
                    yearError.style.display = 'block';
                    valid = false;
                } else {
                    yearError.style.display = 'none';
                }

                // Prevent form submission if validation fails
                if (!valid) {
                    e.preventDefault();
                }
            });

            // Hide error message when user starts typing
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
            year.addEventListener('input', function() {
                if (year.value.trim() !== '') {
                    yearError.style.display = 'none';
                }
            });

        });
    </script>
@endpush
