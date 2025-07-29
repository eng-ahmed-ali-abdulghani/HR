@extends('dachboard.layouts.app')

@section('title')
    Create Skill
@endsection

@section('content')
    <div class="container">
        <form class="create_skill main_form" method="POST" action="{{ route('skills.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="skillNameEn" class="form-label">English Skill Name</label>
                <input type="text" class="form-control" id="skillNameEn" name="name_en">
                <span class="error-message text-danger" id="skillNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="skillNameAr" class="form-label">Arabic Skill Name</label>
                <input type="text" class="form-control" id="skillNameAr" name="name_ar">
                <span class="error-message text-danger" id="skillNameArError" style="display:none;">Arabic Name is
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
            const form = document.querySelector('.create_skill');
            const nameEn = document.querySelector('#skillNameEn');
            const nameAr = document.querySelector('#skillNameAr');

            const nameEnError = document.getElementById('skillNameEnError');
            const nameArError = document.getElementById('skillNameArError');


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

                // Prevent form subskill if validation fails
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

        });
    </script>
@endpush
