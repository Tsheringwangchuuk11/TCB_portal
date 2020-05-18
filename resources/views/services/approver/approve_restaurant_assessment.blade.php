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
                    <label for="">License Number <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">License Date <span class="text-danger">*</span> </label>
                    <input type="date" class="form-control" name="license_date" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="name" autocomplete="off">
                </div>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">CID No.<span class="text-danger">*</span> </label>
                <input type="text" class="form-control numeric-only" name="cid_no" autocomplete="off">
                <span class="text-danger">{{ $errors->first('cid_no') }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Owner <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Address <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="address" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Contact No <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control numeric-only" name="contact_no" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Fax <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="fax" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" name="email" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="internet_url" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
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
                <label>Area <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-3">
                <label>Division <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-3">
                <label for="">Name <span class="text-danger">*</span> </label>
            </div>
            <div class="form-group col-md-3">
                <label>Gender <span class="text-danger">*</span></label>
            </div>
        </div>
        <div class="row" id="row1">
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" name="staff_area_id[]" required>
                        <option value="">-Select-</option>
                        @foreach ($staffAreaLists as $staffAreaList)
                            <option value="{{ $staffAreaList->id }}"> {{ $staffAreaList->staff_area_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" name="hotel_div_id[]" required>
                        <option value="">-Select-</option>
                         @foreach ($hotelDivisionLists as $hotelDivisionList)
                            <option value="{{ $hotelDivisionList->id }}"> {{ $hotelDivisionList->hotel_div_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="staff_name[]" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select class="form-control" name="staff_gender[]" required>
                        <option value="">-Select-</option>
                        @foreach (config()->get('settings.gender') as $k => $v)
                        <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
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