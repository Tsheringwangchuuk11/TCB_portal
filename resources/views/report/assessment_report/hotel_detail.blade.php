@extends('layouts.manager')
@section('page-title', 'Hotel Assessment Details')
@section('buttons')
<div class="card-tools pull-right">
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'/'.$application->module_id.'?print=pdf&'. Request::getQueryString()) }}" class="btn btn-sm btn-danger btn-flat" target="_blank"><i class="fa fa-print"></i> Print PDF</a>    
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'/'.$application->module_id.'?print=excel&'. Request::getQueryString()) }}" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fa fa-file-excel"></i></i> Export to Excel</a>    
    <a href="{{url('report/assessment-reports')}}" class="btn bg-olive btn-sm btn-flat"><i class="fa fa-reply"></i> Back</a>
</div>
@endsection
@section('content')
<div class="row">
@php
    $scorepointtotal=0;
    $ratingpointtotal=0;
@endphp
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
                                <label for="">Registration Type</label> :{{$application->star_category_name}} 
                            </div>
                        </div>  
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>License No.</label> :{{ $application->license_no }}      
                            </div>        
                        </div>                  
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">License Date</label> :{{ $application->license_date }}
                            </div> 
                        </div>
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
                    </div>  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Citizen ID</label> :{{$application->cid_no}}
                            </div>
                        </div>   
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
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email </label> :{{$application->email}}
                            </div>
                        </div>
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
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                               <label for="">Manager Name</label> : {{$application->manager_name}}
                           </div>             
                        </div>  
                        <div class="col-md-4">
                            <div class="form-group">
                               <label for="">Manager Contact No.</label> : {{$application->manager_mobile_no}}
                           </div>             
                        </div>  
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Number of Beds</label> : {{$application->number}}
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
            <h3 class="card-title">Hotel Location</h3>
            </div>    
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="">Dzongkhag</label> : {{$application->dzongkhag_name}}
                       </div>             
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="">Gewog</label> : {{$application->gewog_name}}
                       </div>             
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Village</label> : {{ $application->village_name}}
                        </div>            
                    </div>        
                </div>
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
            <h3 class="card-title">Room Details</h3>
            </div>    
            <div class="card-body">
            @php
                $total=0;
            @endphp
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Room Types</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Number Of Rooms</label>
                        </div>
                    </div>   
                </div>
                @foreach ($roomDetails as $roomDetail)
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        {{$roomDetail->dropdown_name}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{$roomDetail->room_no}}
                        </div>
                    </div>   
                </div>   
                @php
                ($total +=$roomDetail->room_no);
                @endphp   
                @endforeach
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <b>Total number of rooms</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ $total }}
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
                <table id="staffDetail" class="table table-bordered table-hover">
                    <thead>
                        <th class="text-center">#</th>
                        <th>Citizen ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Designation</th>
                        <th>Qualification</th>
                        <th>Experience</th>
                        <th>Salary</th>
                        <th>Hospitility relating</th>
                    </thead>
                    <tbody>
                        @foreach ($staffInfos as $staffInfo)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $staffInfo->staff_cid_no }}</td>
                                <td>{{ $staffInfo->staff_name }}</td>
                                <td>
                                    @if ($staffInfo->staff_gender==='F')
                                        Female
                                    @else
                                        Male
                                    @endif
                                </td>
                                <td> {{ $staffInfo->staff_designation }}</td>
                                <td> {{ $staffInfo->qualification }}</td>
                                <td> {{ $staffInfo->experience }}</td>
                                <td>{{ $staffInfo->salary }}</td>
                                <td>
                                    @if ($staffInfo->hospitility_relating==="Y" )
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                             </tr>
                        @endforeach
                    </tbody>
                 </table>
            </div>
        </div>
    </div>  
</div>

@foreach ($data as $chapter)
@if (in_array($chapter->id,$chapterId)) 
<div class="card card-default collapsed-card">
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
                        <td>Area</td>
                        <td>Standard</td>
                        <td>Score points</td>
                        <td>Assessor’s score point</td>
                        <td>B/B* rating</td>
                        <td>Assessor’s B/B* rating</td>
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
                                    <td>
                                        @if ($checkListStandard->assessor_score_point!=0)
                                            {{ $checkListStandard->assessor_score_point }}
                                        @endif
                                    </td>
                                    <td>{{ $checkListStandard->standard_code }}</td>
                                    <td>
                                        @if ($checkListStandard->assessor_rating!=0)
                                           {{ $checkListStandard->assessor_rating }}
                                        @endif
                                    </td>
                                    @php
                                    $area = $chapterArea->checklist_area;
                                    ($scorepointtotal +=$checkListStandard->assessor_score_point);
                                    ($ratingpointtotal +=$checkListStandard->assessor_rating);
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
@endif
@endforeach     
<div class="card">
    <div class="card-header">
         <h4 class="card-title">Score Points and Basic Standards(B + B*) Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">
                    @if ($application->star_category_id==1)
                         Total Assessor’s score point(160-199)
                    @elseif($application->star_category_id==2)
                         Total Assessor’s score point(200-279)
                    @else
                        Total Assessor’s score point(280 +)
                    @endif
                    <span id="scorepoint">: &nbsp;{{ $scorepointtotal }}</span>			
                </label>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for=""> 
                    @if ($application->star_category_id==1)
                         Total Assessor’s B/B* rating (117 out of 120)
                    @elseif($application->star_category_id==2)
                         Total Assessor’s B/B* rating (145 out of 149)
                    @else
                        Total Assessor’s B/B* rating (162 out of 166)
                    @endif
                    <span id="bspoints">:&nbsp;{{ $ratingpointtotal }}</span>
                </label>
            </div>
        </div>
    </div>
</div>           
@endsection