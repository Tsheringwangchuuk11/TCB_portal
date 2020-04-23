@extends('layouts.manager')
@section('page-title','New : Home Stay Ownership Change')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Village Home Stay Ownership Change</h4>
  </div> 
  <form action="{{ url('application/save-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    @foreach ($idInfos as $idInfo)
    <input type="hidden" name="service_id" value="{{ $idInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfo->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfo->module_name }}" id="module_name">
    @endforeach 
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h5>Personal Details</h6>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group ">
                <label for="">CID No.</label>
                <input type="text" class="form-control numeric_only" name="cid_no">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Contact No. </label>
                <input type="number" class="form-control" name="contact_no">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Dzongkhag</label>
                <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4" style="width: 100%;">
                  <option value=""> -Select-</option>
                  @foreach ($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Gewog</label>
                <select  name="location_id" class="form-control select2bs4" id="location_id" style="width: 100%;">
                </select> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Chiwog</label>
                <select class="form-control select2bs4" name="chiwog" style="width: 100%;">
                  <option value="">-select-</option>
                </select>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Village </label>
                <input type="text" class="form-control" name="village">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Thram No. </label>
                <input type="text" class="form-control" name="thram_no" value="">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">House No. </label>
                <input type="text" class="form-control" name="house_no" value="">
              </div>
            </div>
          </div>
          <h6 class="" style="color:#312e70">Locations</h6>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Distance from the nearest town/urban centre (hrs or kms)</label>
                <input type="text" class="form-control" name="town_distance">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Distance from the main road (hrs or kms)</label>
                <input type="text" class="form-control" name="road_distance">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Condition of the pathway to house from the road point</label>
                <input type="text" class="form-control" name="condition">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-center">
      <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
      <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
    </div>
  </div>
</form>
@endsection