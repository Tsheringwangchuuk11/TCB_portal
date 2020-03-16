@extends('public_view.main')
@section('page-title','New : Tourist Standard Hotel Ownership Change')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Ownership Change For Tourist Hotels</h4>
  </div>
  <form action="{{ url('tourist_standard_hotels/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="">License Number </label>
          <input type="number" class="form-control" name="license_number" id="" required>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label>Registration Type</label>
          <select class="form-control select2bs4">
            <option value="1" selected="selected">-select-</option>
            <option value="">3 Star</option>
            <option value="2">4 Star</option>
            <option value="3">5 Star</option>
          </select>
        </div>
        <div class="form-group col-md-5">
          <label for="">License Date </label>
          <input type="date" class="form-control" name="license_date" id="" disabled>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Name </label>
          <input type="text" class="form-control" name="name" disabled>
        </div>
        <div class="form-group col-md-5">
          <label for="">Owner </label>
          <input type="text" class="form-control" name="accomodation" value="">
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Address </label>
          <input type="text" class="form-control" name="address" disabled>
        </div>
        <div class="form-group col-md-5">
          <label for="">Contact No </label>
          <input type="number" class="form-control" name="phone_number" id="" disabled>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Fax </label>
          <input type="text" class="form-control" name="fax" disabled>
        </div>
        <div class="form-group col-md-5">
          <label for="">Email </label>
          <input type="email" class="form-control" name="email" disabled>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Internet Homepage </label>
          <input type="text" class="form-control" name="internet" disabled>
        </div>
        <div class="form-group col-md-5">
          <label for="">Number of Beds </label>
          <input type="number" class="form-control" name="bed_no" disabled>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Location </label>
          <input type="text" class="form-control" name="location" disabled>
        </div>
      </div>
    </div>
    <div class="card-footer text-center">
      <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
      <button type="reset"class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
    </div>
  </form>
</div>
@endsection
