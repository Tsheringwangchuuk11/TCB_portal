@extends('layouts.manager')
@section('page-title', 'Tour Operator Assessment Details')
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
                 <h4 class="card-title">General Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                          <label for="">Application Number<span class="text-danger">*</span> </label>
                          <input type="text" class="form-control" name="application_no" value="{{ $application->application_no }}" readonly="true">
                        </div>
                      </div>
                    <div class="col-md-5 offset-md-2">
                      <div class="form-group">
                        <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="tourist_standard_name" value="{{ $application->company_title_name }}">
                      </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="owner_name" value="{{ $application->owner_name }}">
                      </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                          <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                          <input type="text" class="form-control" name="contact_no" value="{{ $application->contact_no }}">
                        </div>
                      </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="">Owner Citizen ID<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="cid_no" value="{{ $application->cid_no }}">
                      </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                          <label for="">License No.<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="license_no" value="{{ $application->license_no }}">
                        </div>
                      </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                          <label for="">License Date.<span class="text-danger">*</span> </label>
                          <input type="date" class="form-control" name="license_date"  value="{{ $application->license_date }}">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="webpage_url"  value="{{ $application->webpage_url }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                          <label for="">Email<span class="text-danger">*</span> </label>
                          <input type="email" class="form-control" name="email"  value="{{ $application->email }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Company Location</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="dzongkhag_name"  value="{{ $application->dzongkhag_name }}">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Gewog<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="gewog_name"  value="{{ $application->gewog_name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Village<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="village_name"  value="{{ $application->village_name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($checklistDtls->count() > 0)
        <div class="card">
            <div class="card-header">
               <h4 class="card-title">Self Assessment Check List</h4>
            </div>
        <div class="card-body">
            @php
                    $i = 0;
            @endphp
        @foreach ($checklistDtls as $chapter)
            <div class="card collapsed-card">
                <div class="card-header" data-card-widget="collapse">
                    <span>{{$chapter->checklist_ch_name}}</span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table order-list table-bordered" id="">
                                @php
                                $area = '';
                                @endphp
                                @foreach ($chapter->chapterAreas as $chapterArea)
                                <tr>
                                    @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                            @if ($area != $chapterArea->checklist_area)
                                            <td>{{ $chapterArea->checklist_area }}</td>
                                            @endif
                                                @if (in_array( $checkListStandard->checklist_id, $checklistrec))
                                                <td>{{ $checkListStandard->checklist_standard }}
                                                    <input type="radio" name="check{{ $chapterArea->id }}" value="{{ $checkListStandard->checklist_id}}" {{ $checklistrecords[$i]->checklist_id  ==  $checkListStandard->checklist_id ? 'checked':'' }}>
    
                                                </td>
                                                   @php 
                                                    ($i++) 
                                                    @endphp 
                                                    @else
                                                    <td>{{ $checkListStandard->checklist_standard }}
                                                        <input type="radio" name="check{{$chapterArea->id}}" value="{{$checkListStandard->checklist_id}}">
                                                    </td>
                                                    @endif
                                            @php
                                            $area = $chapterArea->checklist_area;
                                            @endphp 
                                    @endforeach  
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                        <button type="button" class="btn btn-tool float-right" data-card-widget="collapse">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        </div>
    @endif
</div>                   
@endsection
