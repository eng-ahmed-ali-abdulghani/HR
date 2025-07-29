@extends('dachboard.layouts.app')

@section('title')
    Your Contact Information
@endsection
@section('content')
    <div class="container">
        <div class="d-flex w-100  table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">English address</th>
                        <th scope="col">Arabic address</th>
                        <th scope="col">English hours</th>
                        <th scope="col">Arabic hours</th>
                        <th scope="col">English location</th>
                        <th scope="col">Arabic location</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="long-cell">{{ $contact['address_en'] }}</td>
                            <td class="long-cell">{{ $contact['address_ar'] }}</td>
                            <td class="long-cell">{{ $contact['hours_en'] }}</td>
                            <td class="long-cell">{{ $contact['hours_ar'] }}</td>

                            <td class="long-cell">{{ $contact['location_en'] }}</td>
                            <td class="long-cell">{{ $contact['location_ar'] }}</td>

                            <td class="long-cell">{{ $contact['email'] }}</td>
                            <td class="long-cell">{{ $contact['phone'] }}</td>
                            <td><a class="me-3" href="{{ route('contacts.edit', $contact['id']) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
