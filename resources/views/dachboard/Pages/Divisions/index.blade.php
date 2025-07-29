@extends('dachboard.layouts.app')

@section('title')
    Your Divisions
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('divisions.create') }}">Create New
                    Division</a></button>
        </div>
        <div class="d-flex w-100  table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">English Title</th>
                        <th scope="col">Arabic Title</th>
                        <th scope="col">English Description</th>
                        <th scope="col">Arabic Description</th>
                        <th scope="col">English overview</th>
                        <th scope="col">Arabic overview</th>
                        <th scope="col">English approach</th>
                        <th scope="col">Arabic approach</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisions as $division)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="long-cell">{{ $division['name_en'] }}</td>
                            <td class="long-cell">{{ $division['name_ar'] }}</td>
                            <td class="long-cell">{{ $division['description_en'] }}</td>
                            <td class="long-cell">{{ $division['description_ar'] }}</td>

                            <td class="long-cell">{{ $division['overview_en'] }}</td>
                            <td class="long-cell">{{ $division['overview_ar'] }}</td>

                            <td class="long-cell">{{ $division['approach_en'] }}</td>
                            <td class="long-cell">{{ $division['approach_ar'] }}</td>
                            <td><img style="width: 50px; height:30px;" src="{{ $division['photo'] }}" alt=""></td>
                            <td><a class="me-3" href="{{ route('divisions.edit', $division['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $division['id'] }}"
                                    action="{{ route('divisions.destroy', $division['id']) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $division['id'] }})">
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
        function confirmDeletion(divisionId) {
            Swal.fire({
                title: 'Do you want to delete this Division?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the division
                    document.getElementById(`delete-form-${divisionId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
