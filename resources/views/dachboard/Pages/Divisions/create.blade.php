@extends('dachboard.layouts.app')

@section('title')
    Create Division
@endsection

@section('content')
    <div class="container">
        <form class="create_division main_form" method="POST" action="{{ route('divisions.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="divisionNameEn" class="form-label">English Division Title</label>
                <input type="text" class="form-control" id="divisionNameEn" name="name_en">
                <span class="error-message text-danger" id="divisionNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionNameAr" class="form-label">Arabic Division Title</label>
                <input type="text" class="form-control" id="divisionNameAr" name="name_ar">
                <span class="error-message text-danger" id="divisionNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionDescEn" class="form-label">English Division Description</label>
                <input name="description_en" type="text" class="form-control" id="divisionDescEn">
                <span class="error-message text-danger" id="divisionDescriptionEnError" style="display:none;">English
                    Description is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionDescAr" class="form-label">Arabic Division Description</label>
                <input name="description_ar" type="text" class="form-control" id="divisionDescAr">
                <span class="error-message text-danger" id="divisionDescriptionArError" style="display:none;">Arabic
                    Description is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="overviewEn" class="form-label">English Division overview</label>
                <input name="overview_en" type="text" class="form-control" id="overviewEn">
                <span class="error-message text-danger" id="overviewEnError" style="display:none;">English
                    Overview is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="overviewAr" class="form-label">Arabic Division overview</label>
                <input name="overview_ar" type="text" class="form-control" id="overviewAr">
                <span class="error-message text-danger" id="overviewArError" style="display:none;">Arabic
                    Overview is
                    required.</span>
            </div>

            <div class="mb-3 w-100">
                <label for="approachEn" class="form-label">English Division approach</label>
                <input name="approach_en" type="text" class="form-control" id="approachEn">
                <span class="error-message text-danger" id="approachEnError" style="display:none;">English
                    Approach is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="approachAr" class="form-label">Arabic Division approach</label>
                <input name="approach_ar" type="text" class="form-control" id="approachAr">
                <span class="error-message text-danger" id="approachArError" style="display:none;">Arabic
                    Approach is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="divisionPhoto" class="form-label">Choose Photo</label>
                <input type="file" class="form-control" id="divisionPhoto" name="photo">
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
            const form = document.querySelector('.create_division');
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

                // Validate  Overview
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

                // Validate  Approach
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


            overviewEn.addEventListener('input', function() {
                if (overviewEn.value.trim() !== '') {
                    overviewEnError.style.display = 'none';
                }
            });
            overviewAr.addEventListener('input', function() {
                if (overviewAr.value.trim() !== '') {
                    overviewArError.style.display = 'none';
                }
            });

            approachEn.addEventListener('input', function() {
                if (approachEn.value.trim() !== '') {
                    approachEnError.style.display = 'none';
                }
            });
            approachAr.addEventListener('input', function() {
                if (approachAr.value.trim() !== '') {
                    approachArError.style.display = 'none';
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
