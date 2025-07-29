@extends('dachboard.layouts.app')

@section('title')
    Your Skills
@endsection
@section('content')
    <div class="container">
        <div class="header-cont">
            {{-- <h1 class="text-center">Active Meeting</h1> --}}
            <button class="btn btn-outline-success createBtn mb-5"><a href="{{ route('skills.create') }}">Create New
                    skills</a></button>
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
                    @foreach ($skills as $skill)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="long-cell">{{ $skill->name_en }}</td>
                            <td class="long-cell">{{ $skill->name_ar }}</td>
                            <td><a class="me-3" href="{{ route('skills.edit', $skill->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form id="delete-form-{{ $skill->id }}"
                                    action="{{ route('skills.destroy', $skill->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="javascript:void(0)" style="color: red"
                                    onclick="confirmDeletion({{ $skill->id }})">
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
        function confirmDeletion(skillId) {
            Swal.fire({
                title: 'Do you want to delete this Skill?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form corresponding to the skill
                    document.getElementById(`delete-form-${skillId}`).submit();
                } else if (result.isDenied) {
                    Swal.fire('Deletion cancelled', '', 'info');
                }
            });
        }
    </script>
@endpush
