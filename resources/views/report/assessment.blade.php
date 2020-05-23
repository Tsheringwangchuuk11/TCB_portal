@extends('layouts.manager')
@section('page-title', 'List of Hotel Assement Report')
@section('buttons')
    @component('layouts.include.download-button')
        <li><a href="{{	url('report/assessment-reports?print=excel&'. Request::getQueryString()) }}" class="text-green" target="_blank"><i class="fas fa-file-excel-o"></i> Export to Excel</a></li>
        <li><a href="{{	url('report/assessment-reports?print=pdf&'. Request::getQueryString()) }}" class="text-red" target="_blank"><i class="fas fa-print"></i> Print PDF</a></li>
    @endcomponent   
@endsection
@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Assement List</h3>                              
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Application No.</th>
                        <th>License No.</th>
                        <th>Owner Name</th>
                        <th>Submitted Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td class="text-center">{{ $loop->iteration}}</td>
                            <td>{{$application->application_no}}</td>
                            <td>{{$application->license_no}}</td>
                            <td>{{$application->owner_name}}</td>
                            <td>{{$application->created_at}}</td>                                                 
                            <td class="text-center">
                                <a href="{{ url('report/assessment-reports/' . $application->application_no) }}" class="btn btn-outline-primary btn-sm" title="Detail"><i class="fas fa-list"></i></a>                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">No aplications to be displayed</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer float-right">
        {{ $applications->links() }}
    </div>
</div>
@include('layouts.include.confirm-delete')
@endsection