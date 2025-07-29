@extends('dachboard.layouts.app')

@section('title')
    Create Career
@endsection

@section('content')
    <div class="container">
        <form class="create_career main_form" method="POST" action="{{ route('careers.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="careerNameEn" class="form-label">English Career Title</label>
                <input type="text" class="form-control" id="careerNameEn" name="name_en">
                <span class="error-message text-danger" id="careerNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="careerNameAr" class="form-label">Arabic Career Title</label>
                <input type="text" class="form-control" id="careerNameAr" name="name_ar">
                <span class="error-message text-danger" id="careerNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="careerDescEn" class="form-label">English Career Description</label>
                <input name="description_en" type="text" class="form-control" id="careerDescEn">
                <span class="error-message text-danger" id="careerDescriptionEnError" style="display:none;">English
                    Description is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="careerDescAr" class="form-label">Arabic Career Description</label>
                <input name="description_ar" type="text" class="form-control" id="careerDescAr">
                <span class="error-message text-danger" id="careerDescriptionArError" style="display:none;">Arabic
                    Description is
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
            const form = document.querySelector('.create_career');
            const nameEn = document.querySelector('#careerNameEn');
            const nameAr = document.querySelector('#careerNameAr');
            const descriptionEn = document.querySelector('#careerDescEn');
            const descriptionAr = document.querySelector('#careerDescAr');
            const nameEnError = document.getElementById('careerNameEnError');
            const nameArError = document.getElementById('careerNameArError');
            const descriptionEnError = document.getElementById('careerDescriptionEnError');
            const descriptionArError = document.getElementById('careerDescriptionArError');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate Meeting Name
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

                // Validate Meeting Date
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
        });
    </script>
@endpush
