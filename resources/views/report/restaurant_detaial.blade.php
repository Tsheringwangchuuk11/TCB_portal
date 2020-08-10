@extends('layouts.manager')
@section('page-title', 'Restaurant Assessment Details')
@section('buttons')
<div class="card-tools pull-right">
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'/'.$application->module_id.'?print=pdf&'. Request::getQueryString()) }}" class="btn btn-sm btn-danger btn-flat" target="_blank"><i class="fa fa-print"></i> Print PDF</a>    
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'/'.$application->module_id.'?print=excel&'. Request::getQueryString()) }}" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fa fa-file-excel"></i></i> Export to Excel</a>    
    <a href="{{url('report/assessment-reports')}}" class="btn bg-olive btn-sm btn-flat"><i class="fa fa-reply"></i> Back</a>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Applicants Detail</h3>
            </div>    
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">              
                            <label for="">Application Number</label> :{{ $application->application_no }}
                        </div>         
                        </div>     
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>License Number</label> :{{ $application->license_no }}      
                            </div>        
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">License Date</label> :{{ $application->license_date }}
                            </div> 
                        </div>                 
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hotel Name</label> :{{ $application->company_title_name }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Owner Name</label> :{{$application->owner_name}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CID No.</label> :{{$application->cid_no}}
                            </div>
                        </div> 
                    </div>  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Address </label> :{{$application->address}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact Number </label> :{{$application->contact_no}}
                            </div>
                        </div>  
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email </label> :{{$application->email}}
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Internet Homepage</label> :{{$application->webpage_url}}
                            </div>
                        </div>   
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fax Number</label> : {{$application->fax}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Location</label> : {{$application->location_name}}
                            </div>            
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
            <h3 class="card-title">Staff Details</h3>
            </div>    
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Area </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Division</label>
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Name</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Gender</label>
                        </div>
                    </div>   
                </div>
                @foreach ($staffDetails as $staffDetail)
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                         {{$staffDetail->staff_area_name}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{$staffDetail->hotel_div_name}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{$staffDetail->staff_name}}
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group">
                        @if ($staffDetail->staff_gender==='M')
                            Male
                        @else
                            Female
                        @endif
                        </div>
                    </div>   
                </div>   
                @endforeach
            </div>
        </div>
    </div>  
</div>
@foreach ($data as $chapter)
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title"> {{$chapter->checklist_ch_name}}</h3>                                 
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>        
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table order-list table-bordered" id="">
                <thead>
                    <tr>
                        <th>Area</th>
                        <th>Standard</th>
                        <th>Points</th>
                        <th>Points Entry</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $area = '';
                    @endphp
                    @foreach ($chapter->chapterAreas as $chapterArea)
                        @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                @php
                                    $standardlengh=$checkListStandard->count();
                                @endphp
                                <tr>
                                    @if ($area != $chapterArea->checklist_area)
                                    <td rowspan="{{ sizeOf($chapterArea->checkListStandards) }}"> {{ $chapterArea->checklist_area }} </td>
                                    @endif
                                    <td><input type="hidden" name="checklist_id[]" value="{{ $checkListStandard->checklist_id }}">{{ $checkListStandard->checklist_standard }}</td>
                                    <td>{{ $checkListStandard->checklist_pts }}</td>
                                    <td>_________</td>
                                    @php
                                    $area = $chapterArea->checklist_area
                                    @endphp 
                                </tr>
                        @endforeach  
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach                    
@endsection