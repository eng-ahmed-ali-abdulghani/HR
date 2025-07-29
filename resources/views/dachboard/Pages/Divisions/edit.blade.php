@extends('dachboard.layouts.app')

@section('title')
    Edit Division
@endsection

@section('content')
    <div class="container">
        <form class="edit_division main_form" method="POST" action="{{ route('divisions.update', $division['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updating the record -->
            <div class="mb-3 w-100">
                <label for="divisionNameEn" class="form-label">English Division Title</label>
                <input type="text" class="form-control" id="divisionNameEn" name="name_en"
                    value="{{ old('name_en', $division['name_en']) }}">
                <span class="error-message text-danger" id="divisionNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionNameAr" class="form-label">Arabic Division Title</label>
                <input type="text" class="form-control" id="divisionNameAr" name="name_ar"
                    value="{{ old('name_ar', $division['name_ar']) }}">
                <span class="error-message text-danger" id="divisionNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionDescEn" class="form-label">English Division Description</label>
                <input name="description_en" type="text" class="form-control" id="divisionDescEn"
                    value="{{ old('description_en', $division['description_en']) }}">
                <span class="error-message text-danger" id="divisionDescriptionEnError" style="display:none;">English
                    Description is required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionDescAr" class="form-label">Arabic Division Description</label>
                <input name="description_ar" type="text" class="form-control" id="divisionDescAr"
                    value="{{ old('description_ar', $division['description_ar']) }}">
                <span class="error-message text-danger" id="divisionDescriptionArError" style="display:none;">Arabic
                    Description is required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="overviewEn" class="form-label">English Division Overview</label>
                <input name="overview_en" type="text" class="form-control" id="overviewEn"
                    value="{{ old('overview_en', $division['overview_en']) }}">
                <span class="error-message text-danger" id="overviewEnError" style="display:none;">English Overview is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="overviewAr" class="form-label">Arabic Division Overview</label>
                <input name="overview_ar" type="text" class="form-control" id="overviewAr"
                    value="{{ old('overview_ar', $division['overview_ar']) }}">
                <span class="error-message text-danger" id="overviewArError" style="display:none;">Arabic Overview is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="approachEn" class="form-label">English Division Approach</label>
                <input name="approach_en" type="text" class="form-control" id="approachEn"
                    value="{{ old('approach_en', $division['approach_en']) }}">
                <span class="error-message text-danger" id="approachEnError" style="display:none;">English Approach is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="approachAr" class="form-label">Arabic Division Approach</label>
                <input name="approach_ar" type="text" class="form-control" id="approachAr"
                    value="{{ old('approach_ar', $division['approach_ar']) }}">
                <span class="error-message text-danger" id="approachArError" style="display:none;">Arabic Approach is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="divisionPhoto" name="photo">
                @if ($division['photo'])
                    <img src="{{ $division['photo'] }}" alt="Division Photo" width="150" class="mt-2">
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
            const form = document.querySelector('.edit_division');
            const nameEn = document.querySelector('#divisionNameEn');
            const nameAr = document.querySelector('#divisionNameAr');
            const descriptionEn = document.querySelector('#divisionDescEn');
            const descriptionAr = document.querySelector('#divisionDescAr');
            const overviewEn = document.querySelector('#overviewEn');
            const overviewAr = document.querySelector('#overviewAr');
            const approachEn = document.querySelector('#approachEn');
            const approachAr = document.querySelector('#approachAr');
            const photo = document.querySelector('#divisionPhoto');
            const nameEnError = document.getElementById('divisionNameEnError');
            const nameArError = document.getElementById('divisionNameArError');
            const overviewEnError = document.getElementById('overviewEnError');
            const overviewArError = document.getElementById('overviewArError');
            const approachEnError = document.getElementById('approachEnError');
            const approachArError = document.getElementById('approachArError');
            const descriptionEnError = document.getElementById('divisionDescriptionEnError');
            const descriptionArError = document.getElementById('divisionDescriptionArError');
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
                if (overviewEn.value.trim() === '') {
                    overviewEnError.style.display = 'block';
                    valid = false;
                } else {
                    overviewEnError.style.display = 'none';
                }
                if (overviewAr.value.trim() === '') {
                    overviewArError.style.display = 'block';
                    valid = false;
                } else {
                    overviewArError.style.display = 'none';
                }
                if (approachEn.value.trim() === '') {
                    approachEnError.style.display = 'block';
                    valid = false;
                } else {
                    approachEnError.style.display = 'none';
                }
                if (approachAr.value.trim() === '') {
                    approachArError.style.display = 'block';
                    valid = false;
                } else {
                    approachArError.style.display = 'none';
                }

                if (!photo.files.length && !{{ $division['photo'] ? 1 : 0 }}) {
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
