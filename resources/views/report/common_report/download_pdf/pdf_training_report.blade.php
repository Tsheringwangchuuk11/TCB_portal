@extends('layouts.pdf')
@section('title', 'Training List Report')
@section('content')
    <p class="print-title text-center">Training  List Report</p>
    <table class="main">
        <thead>
            <tr>
                <th>#</th>
                <th>Citizen ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Contact No.</th>
                <th>Location</th>
                <th>Course Types</th>
                <th>Course Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($traineelists as $traineelist)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$traineelist->applicant_cid_no}}</td>
                    <td>{{$traineelist->applicant_name}}</td>
                    <td>
                        @if ($traineelist->applicant_gender=='M')
                            Male
                        @else
                        Female 
                        @endif
                    </td>
                    <td>
                        {{$traineelist->applicant_contact_no}}
                    </td>
                    <td>
                        {{$traineelist->dzongkhag_name}}
                    </td>
                    <td>
                        {{$traineelist->dropdown_name}}
                    </td>
                    <td>
                        <td>{{ date_format(date_create($traineelist->course_start_date), "F jS Y") }} to {{ date_format(date_create($traineelist->course_end_date), "F jS Y") }}</td> 
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-danger text-center">No data available to generate report.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection