@extends('dachboard.layouts.app')

@section('title')
    Create Expert
@endsection

@section('content')
    <div class="container">
        <form class="create_expert main_form" method="POST" action="{{ route('experts.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="expertNameEn" class="form-label">English Expert Name</label>
                <input type="text" class="form-control" id="expertNameEn" name="name_en">
                <span class="error-message text-danger" id="expertNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="expertNameAr" class="form-label">Arabic Expert Name</label>
                <input type="text" class="form-control" id="expertNameAr" name="name_ar">
                <span class="error-message text-danger" id="expertNameArError" style="display:none;">Arabic Name is
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
            const form = document.querySelector('.create_expert');
            const nameEn = document.querySelector('#expertNameEn');
            const nameAr = document.querySelector('#expertNameAr');

            const nameEnError = document.getElementById('expertNameEnError');
            const nameArError = document.getElementById('expertNameArError');


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

                // Prevent form subexpert if validation fails
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
