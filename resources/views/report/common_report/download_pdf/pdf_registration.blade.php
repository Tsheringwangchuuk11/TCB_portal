@extends('layouts.pdf')
@section('title', 'Registration List Report')
@section('content')
    <p class="print-title text-center">Registration Report List</p>
    <table class="main">
        <thead>
            <tr>
                <th>#</th>
                <th>Citizen ID</th>
                <th>Name</th>
                <th>License No.</th>
                <th>Star Category</th>
                <th>Hotel Name</th>
                <th>Validity Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registrationlists as $registrationlist)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$registrationlist->cid_no}}</td>
                <td>{{$registrationlist->owner_name}}</td>
                <td>{{$registrationlist->license_no}}</td>
                <td>{{$registrationlist->star_category_name}}</td>
                <td>{{$registrationlist->tourist_standard_name}}</td>
                <td>{{$registrationlist->validaty_date}}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-danger text-center">No data available to generate report.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection