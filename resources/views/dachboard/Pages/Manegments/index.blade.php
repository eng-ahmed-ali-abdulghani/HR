@extends('dachboard.layouts.app')

@section('title')
    Your Manegments
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('manegments.create') }}">Create New
                    Manegment</a></button>
        </div>
        <div class="d-flex w-100  table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">English Name</th>
                        <th scope="col">Arabic Name</th>
                        <th scope="col">English title</th>
                        <th scope="col">Arabic title</th>
                        <th scope="col">English Description</th>
                        <th scope="col">Arabic Description</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manegments as $manegment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="long-cell">{{ $manegment['name_en'] }}</td>
                            <td class="long-cell">{{ $manegment['name_ar'] }}</td>
                            <td class="long-cell">{{ $manegment['description_en'] }}</td>
                            <td class="long-cell">{{ $manegment['description_ar'] }}</td>

                            <td class="long-cell">{{ $manegment['title_en'] }}</td>
                            <td class="long-cell">{{ $manegment['title_ar'] }}</td>

                            <td><img style="width: 50px; height:30px;" src="{{ $manegment['photo'] }}" alt=""></td>
                            <td><a class="me-3" href="{{ route('manegments.edit', $manegment['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $manegment['id'] }}"
                                    action="{{ route('manegments.destroy', $manegment['id']) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $manegment['id'] }})">
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
        function confirmDeletion(manegmentId) {
            Swal.fire({
                title: 'Do you want to delete this Manegment?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the manegment
                    document.getElementById(`delete-form-${manegmentId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
