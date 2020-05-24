@extends('layouts.manager')
@section('page-title', 'List of Hotel Assement Report')
@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Assement List</h3> 
        @component('layouts.include.download-button')
        <li><a href="{{	url('report/assessment-reports?print=excel&'. Request::getQueryString()) }}" target="_blank"><i class="fas fa-file-excel-o"></i> <font color= "green"> Export to Excel </font></a></li>
        <li><a href="{{	url('report/assessment-reports?print=pdf&'. Request::getQueryString()) }}"  target="_blank"><i class="fas fa-print"></i> <font color= "red">Print PDF</font></a></li>
    @endcomponent                              
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
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td class="text-center">{{ $loop->iteration}}</td>
                            <td><a href="{{ url('report/assessment-reports/' . $application->application_no) }}" title="See Detail">{{$application->application_no}}</a></td>
                            <td>{{$application->license_no}}</td>
                            <td>{{$application->owner_name}}</td>
                            <td>{{$application->created_at}}</td>                                                                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-danger text-center">No aplications to be displayed</td>
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
@endsection