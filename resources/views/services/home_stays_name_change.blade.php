@extends('public_view.main')
@section('page-title','New : Home Stay Name Change')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Village Home Stay Name Change</h4>
  </div>  
  <form action="{{ url('home-stay-registation/store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h6 class="" style="color:#312e70">Applicant’s details</h6>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group ">
                <label for="">CID No.</label>
                <input type="number" class="form-control" name="cid" id="cid" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Contact No. </label>
                <input type="number" class="form-control" name="phone_number" id="phone_number" value="">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Dzongkhag</label>
                <select class="form-control select2bs4" style="width: 100%;" value="">
                  <option value="1" selected="selected">-select-</option>
                  <option value="">Thimphu</option>
                  <option value="2">Paro</option>
                </select>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Gewog</label>
                <select class="form-control select2bs4" style="width: 100%;">
                  <option value="1" selected="selected" value="">-select-</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Chiwog</label>
                <select class="form-control select2bs4" style="width: 100%;">
                  <option value="1" selected="selected" value="">-select-</option>
                </select>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Village </label>
                <input type="text" class="form-control" name="village" value="">
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
                <input type="text" class="form-control" name="distance1" value="" disabled>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Distance from the main road (hrs or kms)</label>
                <input type="text" class="form-control" name="distance2" value="" disabled>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Condition of the pathway to house from the road point</label>
                <input type="text" class="form-control" name="distance3" value="" disabled>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer" align="center">
      <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
      <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
    </div>
  </div>
</form>
@endsection