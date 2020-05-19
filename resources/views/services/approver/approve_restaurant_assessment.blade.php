@extends('layouts.manager')
@section('page-title','Tourist Standard Restuarant Assessment')
@section('content') 
<form action="{{ url('verification/restaurant-assessment') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="formdata">
    @csrf
    <input type="hidden" name="service_id" value="{{ $applicantInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $applicantInfo->module_id }}" id="module_id">
<div class="card">
	<div class="card-header">
		 <h4 class="card-title">General Information</h4>
	</div>
	<div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Application No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">License Number <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">License Date <span class="text-danger">*</span> </label>
                    <input type="date" class="form-control" name="license_date" value="{{ $applicantInfo->license_date }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Restaurant Name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="tourist_standard_name" value="{{ $applicantInfo->company_title_name }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">CID No.<span class="text-danger">*</span> </label>
                <input type="text" class="form-control numeric-only" name="cid_no" value="{{ $applicantInfo->cid_no }}">
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Owner <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Address <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Contact No <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control numeric-only" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Fax <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="webpage_url"  value="{{ $applicantInfo->webpage_url }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Location <span class="text-danger">*</span> </label>
                    <select class="form-control select2bs4" name="location_id" style="width: 100%;">
                        <option value="">-Select-</option>
                    </select>
                </div>
            </div>
        </div>
   </div>
</div>
<div class="card">
        <div class="card-header">
             <h4 class="card-title">Staff Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Area</label>
                </div>
                <div class="form-group col-md-3">
                    <label>Division</label>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Name</label>
                </div>
                <div class="form-group col-md-3">
                    <label>Gender</label>
                </div>
            </div>
            <div id="row1">
                @forelse ($staffInfos as $staffInfo)
                <div class="row">
                    <div class="form-group col-md-3">
                        <select class="form-control" name="staff_area_id[]" id="staff_area_id">
                            <option value="">- Select -</option>
                            @foreach ($staffAreaLists as $staffAreaList)
                            <option value="{{ $staffAreaList->id }}" {{ old('staff_area_id', $staffAreaList->id) == $staffInfo->staff_area_id ? 'selected' : '' }}> {{ $staffAreaList->staff_area_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select class="form-control required" name="hotel_div_id[]" id="hotel_div_id">
                            <option value="">- Select -</option>
                            @foreach ($hotelDivisionLists as $hotelDivisionList)
                            <option value="{{ $hotelDivisionList->id }}" {{ old('hotel_div_id', $hotelDivisionList->id) == $staffInfo->hotel_div_id ? 'selected' : '' }}> {{ $hotelDivisionList->hotel_div_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" name="staff_name[]" autocomplete="off" value="{{$staffInfo->staff_name}}">
                    </div>
                    <div class="form-group col-md-3">
                        <select  name="staff_gender[]" class="form-control required">
                            <option value="">---SELECT---</option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                            <option value="{{ $k }}" {{ old('gender', $staffInfo->staff_gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                @empty
                <div class="form-group col-md-12">
                    <p>No data availlable</p>
                </div>
                @endforelse
                </div>
        </div>
    </div>
    @if ($checklistDtls->count() > 0)
    <h5>Checklist</h5>
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
                        <thead>
                            <tr>
                                <td>Area</td>
                                <td>Standard</td>
                                <td>Points</td>
                                <td>Points Entry</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $area = '';
                            $total=0;
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
                                            <td><input type="text" size="4" name="checklist_pts[]" value="" class="txt numeric-only"></td>
                                            @php
                                            $area = $chapterArea->checklist_area;
                                            ($total +=$checkListStandard->checklist_pts);
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
@endif
<div class="card">
	<div class="card-header">
		 <h4 class="card-title">Assessment Points</h4>
	</div>
	<div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Total:{{ $total }}</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Minimum Marks for Approval: 330 </label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Score Points:<span id="scorepoint"></span></label>
            </div>
        </div>
	</div>
</div>
<div class="card">
    <div class="card-header">
         <h4 class="card-title">File Attachment</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Title</label>
            </div>
            <div class="form-group col-md-6">
                <label>Download Files</label>
            </div>
            @forelse ($documentInfos as $documentInfo)
            <div class="form-group col-md-6">
                <span>{{ $documentInfo->document_name }}</span>
            </div>
            <div class="form-group col-md-6">
            <span><a href="{{ URL::to($documentInfo->upload_url) }}">{{ $documentInfo->document_name }}</a></span>
            </div>
            @empty
            <div class="form-group col-md-12">
                <p>No data availlable</p>
            </div>
            @endforelse                
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Remarks <span class="text-danger">*</span> </label>
                <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Inspection Date<span class="text-danger">*</span> </label>
                <input type="date" class="form-control" name="inspection_date">
            </div>
        </div>
    </div>
    <div class="card-footer text-center" >
        <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal"><li class="fas fa-times"></li> REJECT</button>
    </div>
</div>
<div class="modal fade" id="confirmModal">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Message</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Are you sure,you want to reject &hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button name="status"value="REJECTED" class="btn btn-outline-light" data-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
@section('scripts')
<script>
function calculateScorePoint() {
    var sum = 0;
    //iterate through each textboxes and add the values
    $(".txt").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
 //$("#scorepoint").html(sum.toFixed(2));
  $("#scorepoint").html(sum);
}
$("table").on("keyup", ".txt", function () {
    calculateScorePoint();
});
</script>
@endsection