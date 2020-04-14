@extends('layouts.manager')
@section('page-title','New : Technical Clearance')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Technical Clearance Registration</h4>
  </div>
  <form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @foreach ($idInfos as $idInfo)
    <input type="hidden" name="service_id" value="{{ $idInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfo->module_id }}" id="service_id">
    @endforeach 
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="" >Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="name" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">CID No.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="cid_no" id="cid_no" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Proposed location for construction.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="proposed_location" autocomplete="off" >
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control" onchange="gewogdropdown(this.value);">
                  <option value="" selected="selected"></option>
                  @foreach ($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->dzongkhag_id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                  @endforeach
                </select>
              </div>                                       
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Gewog<span class="text-danger"> *</span></label>
                <select  name="gewog" class="form-control custom-select required" id="gewog">
                </select>                                    
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group ">
                <label for="">Thromde<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="location_name" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Contact No.<span class="text-danger"> *</span></label>
                <input type="text" name="contact_no" class="form-control required" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="bed_no" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                <input type="text" name="tentative_cons" class="form-control required" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="tentative_com" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="drawing_date" autocomplete="off" >
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Email<span class="text-danger"> *</span></label>
                <input type="email" name="email" class="form-control required" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Note:</label>
                <span>Please kindly submit architectural drawing (soft copy) to <a href="ipdd@tourism.gov.bt">ipdd@tourism.gov.bt</a><span>                                    
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
        <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
      </div>
    </form>
  </div>
  @endsection







