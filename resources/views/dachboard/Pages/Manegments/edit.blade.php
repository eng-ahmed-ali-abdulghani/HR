@extends('dachboard.layouts.app')

@section('title')
    Edit manegment
@endsection

@section('content')
    <div class="container">
        <form class="edit_manegment main_form" method="POST" action="{{ route('manegments.update', $manegment['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updating the record -->
            <div class="mb-3 w-100">
                <label for="manegmentNameEn" class="form-label">English Manegment Name</label>
                <input type="text" class="form-control" id="manegmentNameEn" name="name_en"
                    value="{{ old('name_en', $manegment['name_en']) }}">
                <span class="error-message text-danger" id="manegmentNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="manegmentNameAr" class="form-label">Arabic Manegment Name</label>
                <input type="text" class="form-control" id="manegmentNameAr" name="name_ar"
                    value="{{ old('name_ar', $manegment['name_ar']) }}">
                <span class="error-message text-danger" id="manegmentNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="titleEn" class="form-label">English Manegment title</label>
                <input name="title_en" type="text" class="form-control" id="titleEn"
                    value="{{ old('title_en', $manegment['title_en']) }}">
                <span class="error-message text-danger" id="titleEnError" style="display:none;">English title is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="titleAr" class="form-label">Arabic Manegment title</label>
                <input name="title_ar" type="text" class="form-control" id="titleAr"
                    value="{{ old('title_ar', $manegment['title_ar']) }}">
                <span class="error-message text-danger" id="titleArError" style="display:none;">Arabic title is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="manegmentDescEn" class="form-label">English Manegment Description</label>
                <input name="description_en" type="text" class="form-control" id="manegmentDescEn"
                    value="{{ old('description_en', $manegment['description_en']) }}">
                <span class="error-message text-danger" id="manegmentDescriptionEnError" style="display:none;">English
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="manegmentDescAr" class="form-label">Arabic Manegment Description</label>
                <input name="description_ar" type="text" class="form-control" id="manegmentDescAr"
                    value="{{ old('description_ar', $manegment['description_ar']) }}">
                <span class="error-message text-danger" id="manegmentDescriptionArError" style="display:none;">Arabic
                    Description is required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="manegmentPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="manegmentPhoto" name="photo">
                @if ($manegment['photo'])
                    <img src="{{ $manegment['photo'] }}" alt="manegment Photo" width="150" class="mt-2">
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
            const form = document.querySelector('.edit_manegment');
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

                // Validate fields
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


                if (!photo.files.length && !{{ $manegment['photo'] ? 1 : 0 }}) {
                    photoError.style.display = 'block';
                    valid = false;
                } else {
                    photoError.style.display = 'none';
                }

                if (!valid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
