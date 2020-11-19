@extends('layouts.pdf')
@section('title', 'Application List')
@section('content')
    <p class="print-title text-center">Application List</p>
    <table class="main">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Application No.</th>
                <th>Module Name</th>
                <th>Services</th>
                <th>Applicant Name</th>
                <th>Applicant CID</th>
                <th>Status</th>
                <th>Submitted Date</th> 
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $application->application_no }}</td>
                    <td>{{ $application->module_name }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->applicant_name }}</td>
                    <td>{{ $application->cid_no }}</td>                                                                            
                    <td>{{ $application->status_name }}</td>                                                                            
                    <td>{{ $application->created_at }}</td>  
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-danger text-center">No application to be displayed</td>
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