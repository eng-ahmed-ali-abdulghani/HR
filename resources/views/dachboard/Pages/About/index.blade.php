@extends('dachboard.layouts.app')

@section('title')
    Your Abouts
@endsection
@section('content')
    <div class="container">
        {{-- <div class="header-cont">
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('abouts.create') }}">Create New
                    About</a></button>
        </div> --}}
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
                    @foreach ($abouts as $about)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $about['name_en'] }}</td>
                            <td>{{ $about['name_ar'] }}</td>
                            <td class="long-cell">{{ $about['description_en'] }}</td>
                            <td class="long-cell">{{ $about['description_ar'] }}</td>
                            <td><img style="width: 50px; height:30px;" src="{{ $about['photo'] }}" alt=""></td>
                            <td><a class="me-3" href="{{ route('abouts.edit', $about['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                {{-- <form id="delete-form-{{ $about['id'] }}"
                                    action="{{ route('abouts.destroy', $about['id']) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $about['id'] }})">
                                    <i class="fa-solid fa-trash"></i>
                                </a> --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
{{-- @push('scripts')
    <script>
        function confirmDeletion(aboutId) {
            Swal.fire({
                title: 'Do you want to delete this about?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the about
                    document.getElementById(`delete-form-${aboutId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush --}}
