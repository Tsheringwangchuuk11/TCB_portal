@extends('layouts.manager')
@section('page-title', 'Village Home Stay Assessment Details')
@section('buttons')
<div class="card-tools pull-right">
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'/'.$application->module_id.'?print=pdf&'. Request::getQueryString()) }}" class="btn btn-sm btn-danger btn-flat" target="_blank"><i class="fa fa-print"></i> Print PDF</a>    
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'?print=excel&'. Request::getQueryString()) }}" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fa fa-file-excel"></i></i> Export to Excel</a>    
    <a href="{{url('report/assessment-reports')}}" class="btn bg-olive btn-sm btn-flat"><i class="fa fa-reply"></i> Back to List</a>
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
                                <label for="">Name</label> :{{$application->applicant_name}} 
                            </div>
                        </div>  
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>CID No</label> :{{ $application->cid_no }}      
                            </div>        
                        </div>                  
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact No. </label> :{{ $application->contact_no }}
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label> :{{ $application->email }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""></label> Dzongkhag :{{$application->dzongkhag_name}}
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Gewog.</label> :{{$application->gewog_name}}
                            </div>
                        </div>   
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Chiwog</label> :{{$application->chiwog_name}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Village </label> :{{$application->village_name}}
                            </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Thram No.</label> :{{$application->thram_no}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">House No.</label> :{{$application->house_no}}
                            </div>
                        </div>   
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Distance from the nearest town/urban centre (hrs or kms) </label> : {{$application->town_distance}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Distance from the main road (hrs or kms) </label> : {{$application->road_distance}}
                            </div>            
                        </div>           
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">Condition of the pathway to house from the road point </label> : {{$application->condition}}
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
            <h3 class="card-title">Details Of The Family Members Residing In The Same House</h3>
            </div>    
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Name</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Relationship with the applicant</label>
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Age</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Gender</label>
                        </div>
                    </div>   
                </div>
                @foreach ($familyDetails as $familyDetail)
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                         {{$familyDetail->member_name}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{$familyDetail->relation_type}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{$familyDetail->member_age}}
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group">
                        @if ($familyDetail->member_gender==='M')
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
                        <th>Rating</th>
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
                                    <td>{{ $checkListStandard->checklist_standard }}</td>
                                    <td>{{ $checkListStandard->standard_code }}</td>
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