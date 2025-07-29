@extends('dachboard.layouts.app')

@section('title')
    Your Visions
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('visions.create') }}">Create New
                    Visions</a></button>
        </div>
        <div class="d-flex w-100  table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">English Name</th>
                        <th scope="col">Arabic Name</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visions as $visions)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="long-cell">{{ $visions->name_en }}</td>
                            <td class="long-cell">{{ $visions->name_ar }}</td>
                            <td><a class="me-3" href="{{ route('visions.edit', $visions->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $visions->id }}"
                                    action="{{ route('visions.destroy', $visions->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $visions->id }})">
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
        function confirmDeletion(visionsId) {
            Swal.fire({
                title: 'Do you want to delete this Visions?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the visions
                    document.getElementById(`delete-form-${visionsId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
