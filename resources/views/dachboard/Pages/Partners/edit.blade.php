@extends('dachboard.layouts.app')

@section('title')
    Edit Partner
@endsection

@section('content')
    <div class="container">
        <form class="edit_partner main_form" method="POST" action="{{ route('partners.update', $partner['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use the PUT method for updating -->
            <div class="mb-3 w-100">
                <label for="partnerNameEn" class="form-label">English Partner Title</label>
                <input type="text" class="form-control" id="partnerNameEn" name="name_en"
                    value="{{ $partner['name_en'] }}">
                <span class="error-message text-danger" id="partnerNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="partnerNameAr" class="form-label">Arabic Partner Title</label>
                <input type="text" class="form-control" id="partnerNameAr" name="name_ar"
                    value="{{ $partner['name_ar'] }}">
                <span class="error-message text-danger" id="partnerNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="partnerDescEn" class="form-label">English Partner Description</label>
                <input name="description_en" type="text" class="form-control" id="partnerDescEn"
                    value="{{ $partner['description_en'] }}">
                <span class="error-message text-danger" id="partnerDescriptionEnError" style="display:none;">English
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="partnerDescAr" class="form-label">Arabic Partner Description</label>
                <input name="description_ar" type="text" class="form-control" id="partnerDescAr"
                    value="{{ $partner['description_ar'] }}">
                <span class="error-message text-danger" id="partnerDescriptionArError" style="display:none;">Arabic
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="partnerPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="partnerPhoto" name="photo">
                @if ($partner['photo'])
                    <p>Current photo: <img src="{{ $partner['photo'] }}" alt="partner image" width="100"></p>
                @endif
                <span class="error-message text-danger" id="photo-error" style="display:none;">Photo is required.</span>
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
            const form = document.querySelector('.edit_partner');
            const nameEn = document.querySelector('#partnerNameEn');
            const nameAr = document.querySelector('#partnerNameAr');
            const descriptionEn = document.querySelector('#partnerDescEn');
            const descriptionAr = document.querySelector('#partnerDescAr');
            const photo = document.querySelector('#partnerPhoto');
            const nameEnError = document.getElementById('partnerNameEnError');
            const nameArError = document.getElementById('partnerNameArError');
            const descriptionEnError = document.getElementById('partnerDescriptionEnError');
            const descriptionArError = document.getElementById('partnerDescriptionArError');
            const photoError = document.getElementById('photo-error');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate Name
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

                // Validate Description
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

                // Photo is not required for editing, only validate if present
                if (photo.files.length === 0 && !document.querySelector('img')) {
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

            photo.addEventListener('input', function() {
                if (photo.files.length > 0) {
                    photoError.style.display = 'none';
                }
            });
        });
    </script>
@endpush
