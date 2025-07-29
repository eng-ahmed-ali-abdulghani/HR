@extends('dachboard.layouts.app')

@section('title')
    Your Careers
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('careers.create') }}">Create New
                    Career</a></button>
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
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($careers as $career)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $career['name_en'] }}</td>
                            <td>{{ $career['name_ar'] }}</td>
                            <td class="long-cell">{{ $career['description_en'] }}</td>
                            <td class="long-cell">{{ $career['description_ar'] }}</td>
                            <td><a class="me-3" href="{{ route('careers.edit', $career['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $career['id'] }}"
                                    action="{{ route('careers.destroy', $career['id']) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $career['id'] }})">
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
        function confirmDeletion(careerId) {
            Swal.fire({
                title: 'Do you want to delete this Career?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the career
                    document.getElementById(`delete-form-${careerId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
