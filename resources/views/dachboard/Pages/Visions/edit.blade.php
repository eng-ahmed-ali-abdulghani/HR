@extends('dachboard.layouts.app')

@section('title')
    Edit Vision
@endsection

@section('content')
    <div class="container">
        <form class="edit_vision main_form" method="POST" action="{{ route('visions.update', $vision->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 w-100">
                <label for="visionNameEn" class="form-label">English Vision Name</label>
                <input type="text" class="form-control" id="visionNameEn" name="name_en"
                    value="{{ old('name_en', $vision->name_en) }}">
                <span class="error-message text-danger" id="visionNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="visionNameAr" class="form-label">Arabic Vision Name</label>
                <input type="text" class="form-control" id="visionNameAr" name="name_ar"
                    value="{{ old('name_ar', $vision->name_ar) }}">
                <span class="error-message text-danger" id="visionNameArError" style="display:none;">Arabic Name is
                    required.</span>
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
            const form = document.querySelector('.edit_vision');
            const nameEn = document.querySelector('#visionNameEn');
            const nameAr = document.querySelector('#visionNameAr');

            const nameEnError = document.getElementById('visionNameEnError');
            const nameArError = document.getElementById('visionNameArError');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate English Name
                if (nameEn.value.trim() === '') {
                    nameEnError.style.display = 'block';
                    valid = false;
                } else {
                    nameEnError.style.display = 'none';
                }

                // Validate Arabic Name
                if (nameAr.value.trim() === '') {
                    nameArError.style.display = 'block';
                    valid = false;
                } else {
                    nameArError.style.display = 'none';
                }

                // Prevent form subvision if validation fails
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
