@extends('layouts.manager')
@section('page-title','Tour Operator Assessment')
@section('content')
<form action="{{ url('verification/tour-operator-assessment') }}" method="POST" files="true" id="form_Id" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Application Number<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                  </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="tourist_standard_name" value="{{ $applicantInfo->company_title_name }}">
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Owner Citizen ID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">License No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">License Date.<span class="text-danger">*</span> </label>
                      <div class="input-group date" id="license_date" data-target-input="nearest">
                        <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ $applicantInfo->license_date}}">
                        <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                    
                </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="webpage_url"  value="{{ $applicantInfo->webpage_url }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Email<span class="text-danger">*</span> </label>
                      <input type="email" class="form-control" name="email"  value="{{ $applicantInfo->email }}">
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
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $applicantInfo->dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value="">{{ $applicantInfo->gewog_name }} </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $applicantInfo->establishment_village_id }}">{{ $applicantInfo->village_name }} </option>
                    </select>
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
                                <input type="hidden" name="area[]" value="{{$chapterArea->id}}">
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
<div class="card">
    <div class="card-header">
         <h4 class="card-title">File Attachment</h4>
    </div>
    <div class="card-body">
        @include('services/fileupload/fileupload')
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Remarks <span class="text-danger">*</span> </label>
                <textarea type="text" class="form-control" id="remarks" name="remarks" row="3"></textarea>
                <div id="remarks_error" class="text-danger"></div>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Inspection Date<span class="text-danger">*</span> </label>
                <div class="input-group date" id="inspection_date" data-target-input="nearest">
                    <input type="text" name="inspection_date" class="form-control datetimepicker-input" data-target="#inspection_date">
                    <div class="input-group-append" data-target="#inspection_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <div class="card-footer text-center">
            <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
            <button name="status" value="RESUBMIT"  class="btn btn-warning" onclick="return requiredRemarks(this.value)"><li class="fas fa-ban"></li> RESUBMIT</button>
            <button name="status"value="REJECTED" class="btn btn-danger" onclick="return requiredRemarks()"> <li class="fas fa-times"></li> REJECT</button>
        </div>
    </div>
</div>
<form>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
    $('#license_date').datetimepicker({
        format: 'MM/DD/YYYY',
    });
    $('#inspection_date').datetimepicker({
        format: 'MM/DD/YYYY',
    });
});
function requiredRemarks(status) {
   $("#remarks_error").html('');
   if($("#remarks").val() ==""){
       if(status=="RESUBMIT"){
        $("#remarks_error").html('Please provide reason for resubmit!');
       }else{
        $("#remarks_error").html('Please provide reason for rejection!');
       }
       return false;
   }
}
</script>
@endsection
