@extends('dachboard.layouts.app')

@section('title')
    Create Manegment
@endsection

@section('content')
    <div class="container">
        <form class="create_manegment main_form" method="POST" action="{{ route('manegments.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="manegmentNameEn" class="form-label">English Manegment Name</label>
                <input type="text" class="form-control" id="manegmentNameEn" name="name_en">
                <span class="error-message text-danger" id="manegmentNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="manegmentNameAr" class="form-label">Arabic Manegment Name</label>
                <input type="text" class="form-control" id="manegmentNameAr" name="name_ar">
                <span class="error-message text-danger" id="manegmentNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="titleEn" class="form-label">English Manegment title</label>
                <input name="title_en" type="text" class="form-control" id="titleEn">
                <span class="error-message text-danger" id="titleEnError" style="display:none;">English
                    title is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="titleAr" class="form-label">Arabic Manegment title</label>
                <input name="title_ar" type="text" class="form-control" id="titleAr">
                <span class="error-message text-danger" id="titleArError" style="display:none;">Arabic
                    title is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="manegmentDescEn" class="form-label">English Manegment Description</label>
                <input name="description_en" type="text" class="form-control" id="manegmentDescEn">
                <span class="error-message text-danger" id="manegmentDescriptionEnError" style="display:none;">English
                    Description is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="manegmentDescAr" class="form-label">Arabic Manegment Description</label>
                <input name="description_ar" type="text" class="form-control" id="manegmentDescAr">
                <span class="error-message text-danger" id="manegmentDescriptionArError" style="display:none;">Arabic
                    Description is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="manegmentPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="manegmentPhoto" name="photo">
                <span class="error-message text-danger" id="photo-error" style="display:none;">Photo is
                    required.</span>
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
            const form = document.querySelector('.create_manegment');
            const nameEn = document.querySelector('#manegmentNameEn');
            const nameAr = document.querySelector('#manegmentNameAr');

            const descriptionEn = document.querySelector('#manegmentDescEn');
            const descriptionAr = document.querySelector('#manegmentDescAr');

            const titleEn = document.querySelector('#titleEn');
            const titleAr = document.querySelector('#titleAr');


            const photo = document.querySelector('#manegmentPhoto');

            const nameEnError = document.getElementById('manegmentNameEnError');
            const nameArError = document.getElementById('manegmentNameArError');

            const titleEnError = document.getElementById('titleEnError');
            const titleArError = document.getElementById('titleArError');


            const descriptionEnError = document.getElementById('manegmentDescriptionEnError');
            const descriptionArError = document.getElementById('manegmentDescriptionArError');
            const photoError = document.getElementById('photo-error');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate  Name
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

                // Validate Meeting Description
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

                // Validate  title
                if (titleEn.value.trim() === '') {
                    titleEnError.style.display = 'block';
                    valid = false;
                } else {
                    titleEnError.style.display = 'none';
                }
                if (titleAr.value.trim() === '') {
                    titleArError.style.display = 'block';
                    valid = false;
                } else {
                    titleArError.style.display = 'none';
                }

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


            titleEn.addEventListener('input', function() {
                if (titleEn.value.trim() !== '') {
                    titleEnError.style.display = 'none';
                }
            });
            titleAr.addEventListener('input', function() {
                if (titleAr.value.trim() !== '') {
                    titleArError.style.display = 'none';
                }
            });

            photo.addEventListener('input', function() {
                if (photo.files.length === 0) {
                    photoError.style.display = 'none';
                }
            });
        });
    </script>
@endpush
