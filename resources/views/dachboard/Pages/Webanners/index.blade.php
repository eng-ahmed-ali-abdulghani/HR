@extends('dachboard.layouts.app')

@section('title')
    Who We Are Banner
@endsection
@section('content')
    <div class="container">
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
                            <td class="long-cell">{{ $banner['name_en'] }}</td>
                            <td class="long-cell">{{ $banner['name_ar'] }}</td>
                            <td class="long-cell">{{ $banner['description_en'] }}</td>
                            <td class="long-cell">{{ $banner['description_ar'] }}</td>
                            <td><img style="width: 50px; height:30px;" src="{{ $banner['photo'] }}" alt=""></td>
                            <td><a class="me-3" href="{{ route('webanners.edit', $banner['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
