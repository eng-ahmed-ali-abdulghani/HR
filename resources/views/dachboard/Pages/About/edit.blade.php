@extends('dachboard.layouts.app')

@section('title')
    Edit About
@endsection

@section('content')
    <div class="container">
        <form class="edit_about main_form" method="POST" action="{{ route('abouts.update', $about['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use the PUT method for updating -->
            <div class="mb-3 w-100">
                <label for="aboutNameEn" class="form-label">English About Title</label>
                <input type="text" class="form-control" id="aboutNameEn" name="name_en" value="{{ $about['name_en'] }}">
                <span class="error-message text-danger" id="aboutNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="aboutNameAr" class="form-label">Arabic About Title</label>
                <input type="text" class="form-control" id="aboutNameAr" name="name_ar" value="{{ $about['name_ar'] }}">
                <span class="error-message text-danger" id="aboutNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="aboutDescEn" class="form-label">English About Description</label>
                <input name="description_en" type="text" class="form-control" id="aboutDescEn"
                    value="{{ $about['description_en'] }}">
                <span class="error-message text-danger" id="aboutDescriptionEnError" style="display:none;">English
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="aboutDescAr" class="form-label">Arabic About Description</label>
                <input name="description_ar" type="text" class="form-control" id="aboutDescAr"
                    value="{{ $about['description_ar'] }}">
                <span class="error-message text-danger" id="aboutDescriptionArError" style="display:none;">Arabic
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="aboutPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="aboutPhoto" name="photo">
                @if ($about['photo'])
                    <p>Current photo: <img src="{{ $about['photo'] }}" alt="about image" width="100"></p>
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
            const form = document.querySelector('.edit_about');
            const nameEn = document.querySelector('#aboutNameEn');
            const nameAr = document.querySelector('#aboutNameAr');
            const descriptionEn = document.querySelector('#aboutDescEn');
            const descriptionAr = document.querySelector('#aboutDescAr');
            const photo = document.querySelector('#aboutPhoto');
            const nameEnError = document.getElementById('aboutNameEnError');
            const nameArError = document.getElementById('aboutNameArError');
            const descriptionEnError = document.getElementById('aboutDescriptionEnError');
            const descriptionArError = document.getElementById('aboutDescriptionArError');
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
