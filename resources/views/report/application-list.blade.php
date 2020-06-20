@extends('layouts.manager')
@section('page-title', 'List of Application Report')
@section('buttons')
    @component('layouts.components.download-button')
        <li><a href="{{	url('report/application-lists?print=excel&'. Request::getQueryString()) }}" target="_blank"><i class="fas fa-file-excel-o"></i> <font color= "green"> Export to Excel </font></a></li>
        <li><a href="{{	url('report/application-lists?print=pdf&'. Request::getQueryString()) }}"  target="_blank"><i class="fas fa-print"></i> <font color= "red">Print PDF</font></a></li>
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
        <div class="col-md-3 form-group">
            <select name="service" class="form-control select2bs4">
                <option value="">---SERVICE---</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ Request::get('service') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
        </div> 
        <div class="col-md-3 form-group">
            <select name="status" class="form-control select2bs4">
                <option value="">---STATUS---</option>
                @foreach ($statusTypes as $statusType)
                    <option value="{{ $statusType->id }}" {{ Request::get('statusType') == $statusType->id ? 'selected' : '' }}>{{ $statusType->status_name }}</option>
                @endforeach
            </select>
        </div>  
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="application_no" class="form-control" value="{{ Request::get('application_no') }}" placeholder="Application No."/>
            </div>
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
                <input type="text" name="applicant_name" class="form-control" value="{{ Request::get('applicant_name') }}" placeholder="Applicant Name"/>
            </div>
        </div>                                       
        @endcomponent                                            
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
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
                            <td colspan="8" class="text-danger text-center">No applications list to be displayed</td>
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