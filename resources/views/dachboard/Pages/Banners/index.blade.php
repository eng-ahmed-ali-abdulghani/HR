@extends('dachboard.layouts.app')

@section('title')
    Your Banners
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('banners.create') }}">Create New
                    Banner</a></button>
        </div>
        <div class="d-flex w-100 table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">English Title</th>
                        <th scope="col">Arabic Title</th>
                        <th scope="col">English Description</th>
                        <th scope="col">Arabic Description</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $banner['name_en'] }}</td>
                            <td>{{ $banner['name_ar'] }}</td>
                            <td class="long-cell">{{ $banner['description_en'] }}</td>
                            <td class="long-cell">{{ $banner['description_ar'] }}</td>
                            <td><img style="width: 50px; height:30px;" src="{{ $banner['photo'] }}" alt=""></td>
                            <td><a class="me-3" href="{{ route('banners.edit', $banner['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $banner['id'] }}"
                                    action="{{ route('banners.destroy', $banner['id']) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $banner['id'] }})">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function confirmDeletion(bannerId) {
            Swal.fire({
                title: 'Do you want to delete this banner?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the banner
                    document.getElementById(`delete-form-${bannerId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
