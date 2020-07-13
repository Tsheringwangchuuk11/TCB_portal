@extends('layouts.manager')
@section('page-title', 'List of Hotel Assement Report')
@section('buttons')
@component('layouts.components.download-button')
    <li><a href="{{	url('report/assessment-reports?print=excel&'. Request::getQueryString()) }}" target="_blank"><i class="fas fa-file-excel-o"></i> <font color= "green"> Export to Excel </font></a></li>
    <li><a href="{{	url('report/assessment-reports?print=pdf&'. Request::getQueryString()) }}"  target="_blank"><i class="fas fa-print"></i> <font color= "red">Print PDF</font></a></li>
@endcomponent 
@endsection
@section('content')
<div class="card">
    <div class="card-header">        
        @component('layouts.components.filter')    
        <div class="col-md-3 form-group">
            <select name="module" class="form-control select2bs4">
                <option value="">---MODULE---</option>
                @foreach ($serviceModules as $module)
                    <option value="{{ $module->id }}" {{ Request::get('module') == $module->id ? 'selected' : '' }}>{{ $module->module_name }}</option>
                @endforeach
            </select>
        </div>    
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="date" name="application_from" class="form-control datepicker" value="{{ Request::get('Application_from') }}" placeholder="Application From">
                    
                    <input type="date" name="application_to" class="form-control datepicker" value="{{ Request::get('Application_to') }}" placeholder="Application To">
                </div>
            </div>
        </div>        
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="application_no" class="form-control" value="{{ Request::get('application_no') }}" placeholder="Application No."/>
            </div>
        </div>                                               
        @endcomponent                                     
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Sl No.</th>
                        <th>Module Name</th>
                        <th>Application No.</th>
                        <th>CID.</th>
                        <th>Owner Name</th>
                        <th>Submitted Date</th>                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $application->module_name }}</td>
                            <td><a href="{{ url('report/assessment-reports',['application_no'=>$application->application_no,'moduleId'=>$application->module_id]) }}" title="See Detail">{{ $application->application_no}}</a></td>
                            <td>{{ $application->cid_no }}</td>
                            @if ($application->module_id===2)
                            <td>{{ $application->applicant_name }}</td>
                            @else
                            <td>{{ $application->owner_name }}</td>
                            @endif
                            <td>{{ $application->created_at }}</td>                                                                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">No applications to be displayed</td>
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