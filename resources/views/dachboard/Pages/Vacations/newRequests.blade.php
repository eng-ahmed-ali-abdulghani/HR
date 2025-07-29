@extends('dachboard.layouts.app')

@section('content')
    {{-- @php
        dd($vacations);
    @endphp --}}
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="title-box">
                <h2 class="pages_heading">New Vacation Requests</h2>
            </div>
        </div>
        <div class="d-flex w-100 table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col ">#</th>
                        <th class="long-cell" scope="col">Code</th>
                        <th class="long-cell" scope="col">Name</th>
                        <th class="long-cell" scope="col">title</th>
                        <th class="long-cell" scope="col">Type</th>
                        <th class="long-cell" scope="col">Reason</th>
                        <th class="long-cell" scope="col">Alternative</th>
                        <th class="long-cell" scope="col">Date</th>
                        <th class="long-cell" scope="col">Note</th>
                        <th class="long-cell" scope="col">Period</th>
                        <th class="long-cell" scope="col">Leader Approve</th>
                        <th class="long-cell" scope="col">Control</th>
                    </tr>
                </thead>
                <tbody id="stock-table-body">
                    @foreach ($vacations as $vacation)
                        <tr>
                            {{-- <td>{{ $vacation->id }}</td> --}}
                            <td>{{ $loop->iteration }}</td>
                            <td class="long-cell">{{ $vacation->user->code }}</td>
                            <td class="long-cell">{{ $vacation->user->username }}</td>
                            <td class="long-cell">{{ $vacation->user->title }}</td>
                            <td class="long-cell">{{ $vacation->type->name }}</td>
                            <td class="long-cell">{{ $vacation->reason->name }}</td>
                            <td class="long-cell">{{ $vacation->alternative ? $vacation->alternative->username : '' }}</td>
                            <td class="long-cell">{{ $vacation->date }}</td>
                            <td class="long-cell">{{ $vacation->note }}</td>
                            <td class="long-cell">{{ $vacation->day == '1' ? 'full' : 'half' }}</td>
                            <td class="long-cell">
                                {!! $vacation->leader_approve == '1'
                                    ? '<i class="fa-solid fa-check" style="color: #008f64;"></i>'
                                    : ($vacation->leader_approve == '0'
                                        ? '<i class="fa-solid fa-xmark" style="color: #ff0000;"></i>'
                                        : '<i class="fa-solid fa-minus"></i>') !!}
                            </td>

                            <td class="long-cell">{{ $vacation->statu->name_en }}</td>
                            {{-- <td class="long-cell"><a href=""></a> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <!-- Pagination Section -->
        <div id="pagination-container">
            {{ $stocks->links('vendor.pagination.bootstrap-5') }}
        </div> --}}
    </div>
@endsection
