@extends('dachboard.layouts.app')

@section('title')
    Your Partners
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('partners.create') }}">Create New
                    Partner</a></button>
        </div>
        <div class="d-flex w-100 justify-content-center  table-responsive">
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
                    @foreach ($partners as $partner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $partner['name_en'] }}</td>
                            <td>{{ $partner['name_ar'] }}</td>
                            <td class="long-cell">{{ $partner['description_en'] }}</td>
                            <td class="long-cell">{{ $partner['description_ar'] }}</td>
                            <td><img style="width: 50px; height:30px;" src="{{ $partner['photo'] }}" alt=""></td>
                            <td><a class="me-3" href="{{ route('partners.edit', $partner['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $partner['id'] }}"
                                    action="{{ route('partners.destroy', $partner['id']) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $partner['id'] }})">
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
        function confirmDeletion(partnerId) {
            Swal.fire({
                title: 'Do you want to delete this Partner?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the partner
                    document.getElementById(`delete-form-${partnerId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
