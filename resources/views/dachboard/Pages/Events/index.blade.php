@extends('dachboard.layouts.app')

@section('title')
    Your Events & News
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('events.create') }}">Create New
                    Event</a></button>
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
                        <th scope="col">Date</th>
                        <th scope="col">Division</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="long-cell">{{ $event['name_en'] }}</td>
                            <td class="long-cell">{{ $event['name_ar'] }}</td>
                            <td class="long-cell">{{ $event['description_en'] }}</td>
                            <td class="long-cell">{{ $event['description_ar'] }}</td>
                            <td>{{ $event['date'] }}</td>
                            <td class="long-cell">{{ $event['division_name'] }}</td>
                            <td><img style="width: 50px; height:30px;" src="{{ $event['photo'] }}" alt=""></td>
                            <td><a class="me-3" href="{{ route('events.edit', $event['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $event['id'] }}"
                                    action="{{ route('events.destroy', $event['id']) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $event['id'] }})">
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
        function confirmDeletion(eventId) {
            Swal.fire({
                title: 'Do you want to delete this Event?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the event
                    document.getElementById(`delete-form-${eventId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
