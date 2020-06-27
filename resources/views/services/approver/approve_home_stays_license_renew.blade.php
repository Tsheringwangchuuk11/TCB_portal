@extends('layouts.manager')
@section('page-title','Home Stay License Renew')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Personal  Details</h4>
    </div>
    <form action="{{  url('verification/village-home-stay-license-renew') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
        <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group ">
                                <label for="">Application No</label>
                                <input type="text" class="form-control numeric-only" name="application_no"  value="{{ $applicantInfo->application_no }}" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group ">
                                <label for="">CID No.</label>
                                <input type="text" class="form-control numeric-only" name="cid_no"  value="{{ $applicantInfo->cid_no }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ $applicantInfo->applicant_name }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No. </label>
                                <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Dzongkhag</label>
                                <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                    @foreach ($dzongkhagLists as $dzongkhagList)
                                      <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $applicantInfo->dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Gewog</label>
                                <input type="text" class="form-control" name="gewog_name" value="{{ $applicantInfo->gewog_name }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Chiwog</label>
                                <input type="text" class="form-control" name="chiwog_name" value="{{ $applicantInfo->chiwog_name }}">
                                <input type="hidden" class="form-control" name="chiwog_id" value="{{ $applicantInfo->chiwog_id }}">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Village </label>
                                <input type="text" class="form-control" name="village_name" value="{{ $applicantInfo->village_name }}">
                                <input type="hidden" class="form-control" name="village_id" value="{{ $applicantInfo->village_id }}">

                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Thram No. </label>
                                <input type="text" class="form-control" name="thram_no" value="{{ $applicantInfo->thram_no }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">House No. </label>
                                <input type="text" class="form-control" name="house_no" value="{{ $applicantInfo->house_no }}">
                            </div>
                        </div>
                    </div>
                    <h6 class="" style="color:#312e70">Locations</h6>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Distance from the nearest town/urban centre (hrs or kms)</label>
                                <input type="text" class="form-control" name="town_distance" value="{{ $applicantInfo->town_distance }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Distance from the main road (hrs or kms)</label>
                                <input type="text" class="form-control" name="road_distance"  value="{{ $applicantInfo->road_distance }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Condition of the pathway to house from the road point</label>
                                <input type="text" class="form-control" name="condition" value="{{ $applicantInfo->condition }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Validaty Date</label>
                                <input type="date" class="form-control" name="validaty_date" value="{{ $applicantInfo->date }}">
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Remarks <span class="text-danger">*</span> </label>
                            <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
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


