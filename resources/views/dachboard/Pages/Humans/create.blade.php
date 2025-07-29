@extends('dachboard.layouts.app')

@section('title')
    Create Human Focus
@endsection

@section('content')
    <div class="container">
        <form class="create_human main_form" method="POST" action="{{ route('humans.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="humanNameEn" class="form-label">English Human Focus Name</label>
                <input type="text" class="form-control" id="humanNameEn" name="name_en">
                <span class="error-message text-danger" id="humanNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="humanNameAr" class="form-label">Arabic Human Focus Name</label>
                <input type="text" class="form-control" id="humanNameAr" name="name_ar">
                <span class="error-message text-danger" id="humanNameArError" style="display:none;">Arabic Name is
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
            const form = document.querySelector('.create_human');
            const nameEn = document.querySelector('#humanNameEn');
            const nameAr = document.querySelector('#humanNameAr');

            const nameEnError = document.getElementById('humanNameEnError');
            const nameArError = document.getElementById('humanNameArError');


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

                // Prevent form subhuman if validation fails
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
