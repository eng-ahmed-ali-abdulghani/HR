@extends('dachboard.layouts.app')

@section('title')
    Edit Banner
@endsection

@section('content')
    <div class="container">
        <form class="edit_banner main_form" method="POST" action="{{ route('webanners.update', $banner['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use the PUT method for updating -->
            <div class="mb-3 w-100">
                <label for="bannerNameEn" class="form-label">English Banner Title</label>
                <input type="text" class="form-control" id="bannerNameEn" name="name_en" value="{{ $banner['name_en'] }}">
                <span class="error-message text-danger" id="bannerNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="bannerNameAr" class="form-label">Arabic Banner Title</label>
                <input type="text" class="form-control" id="bannerNameAr" name="name_ar"
                    value="{{ $banner['name_ar'] }}">
                <span class="error-message text-danger" id="bannerNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="bannerDescEn" class="form-label">English Banner Description</label>
                <input name="description_en" type="text" class="form-control" id="bannerDescEn"
                    value="{{ $banner['description_en'] }}">
                <span class="error-message text-danger" id="bannerDescriptionEnError" style="display:none;">English
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="bannerDescAr" class="form-label">Arabic Banner Description</label>
                <input name="description_ar" type="text" class="form-control" id="bannerDescAr"
                    value="{{ $banner['description_ar'] }}">
                <span class="error-message text-danger" id="bannerDescriptionArError" style="display:none;">Arabic
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="bannerPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="bannerPhoto" name="photo">
                @if ($banner['photo'])
                    <p>Current photo: <img src="{{ $banner['photo'] }}" alt="banner image" width="100"></p>
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
            const form = document.querySelector('.edit_banner');
            const nameEn = document.querySelector('#bannerNameEn');
            const nameAr = document.querySelector('#bannerNameAr');
            const descriptionEn = document.querySelector('#bannerDescEn');
            const descriptionAr = document.querySelector('#bannerDescAr');
            const photo = document.querySelector('#bannerPhoto');
            const nameEnError = document.getElementById('bannerNameEnError');
            const nameArError = document.getElementById('bannerNameArError');
            const descriptionEnError = document.getElementById('bannerDescriptionEnError');
            const descriptionArError = document.getElementById('bannerDescriptionArError');
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
