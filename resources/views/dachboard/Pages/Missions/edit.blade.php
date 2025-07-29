@extends('dachboard.layouts.app')

@section('title')
    Edit Mission
@endsection

@section('content')
    <div class="container">
        <form class="edit_mission main_form" method="POST" action="{{ route('missions.update', $mission->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 w-100">
                <label for="missionNameEn" class="form-label">English Mission Name</label>
                <input type="text" class="form-control" id="missionNameEn" name="name_en"
                    value="{{ old('name_en', $mission->name_en) }}">
                <span class="error-message text-danger" id="missionNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="missionNameAr" class="form-label">Arabic Mission Name</label>
                <input type="text" class="form-control" id="missionNameAr" name="name_ar"
                    value="{{ old('name_ar', $mission->name_ar) }}">
                <span class="error-message text-danger" id="missionNameArError" style="display:none;">Arabic Name is
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
            const form = document.querySelector('.edit_mission');
            const nameEn = document.querySelector('#missionNameEn');
            const nameAr = document.querySelector('#missionNameAr');

            const nameEnError = document.getElementById('missionNameEnError');
            const nameArError = document.getElementById('missionNameArError');

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

        });
    </script>
@endpush
