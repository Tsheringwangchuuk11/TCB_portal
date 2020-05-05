@extends('layouts.manager')
@section('page-title','Tourist Standard Restuarant Name Change')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h3 class="card-title">Name Change for Tourist Standard Restuarant</h3>
  </div>
  <form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">License Number </label>
            <input type="text" class="form-control" name="license_no" readonly="true">
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">License Date </label>
            <input type="date" class="form-control" name="license_date" readonly="true">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Name </label>
            <input type="text" class="form-control" name="name">
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Owner <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="owner" readonly="true">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Address </label>
            <input type="text" class="form-control" name="address" readonly="true">
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Contact No </label>
            <input type="number" class="form-control" name="contact_no" readonly="true">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Fax </label>
            <input type="text" class="form-control" name="fax" readonly="true">
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Email </label>
            <input type="email" class="form-control" name="email" readonly="true">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Internet Homepage </label>
            <input type="text" class="form-control" name="internet_url" readonly="true">
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Number of Beds </label>
            <input type="number" class="form-control" name="bed_no" readonly="true">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Location </label>
            <input type="text" class="form-control" name="location" disabled>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Inspectors Name </label>
            <input type="text" class="form-control" name="inspector_name" disabled>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Inspection Date </label>
            <input type="date" class="form-control" name="inspector_date" disabled>
          </div>
        </div>
      </div>

    </div> <!-- card body ends -->
    <div class="card-footer text-center">
      <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
      <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
    </div>    
  </form>
</div>
@endsection
