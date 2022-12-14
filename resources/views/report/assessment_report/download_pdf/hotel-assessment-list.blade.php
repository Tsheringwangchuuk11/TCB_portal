@extends('layouts.pdf')
@section('title', 'Hotel Assessment List')
@section('content')
    <p class="print-title text-center">Hotel Assessment List</p>
    <table class="main">
        <thead>
            <tr>
                <th class="text-center">Sl No.</th>
                <th>Application No.</th>
                <th>CID</th>
                <th>Owner Name</th>
                <th>Submitted Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
                <tr>
                    <td class="text-center">{{ $loop->iteration}}</td>
                    <td>{{$application->application_no}}</td>
                    <td>{{$application->cid_no}}</td>
                    @if ($application->module_id===2)
                    <td>{{$application->applicant_name}}</td>
                    @else
                    <td>{{$application->owner_name}}</td>
                    @endif
                    <td>{{$application->created_at}}</td> 
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-danger text-center">No hotel assessment to be displayed</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <table class="result">
        <tbody>
            <tr>
                <td><span class="bold">No. of Records:</span> {{ $applications->count() }}</td>
            </tr>
        </tbody>
    </table>
@endsection