@extends('layouts.manager')
@section('page-title','Tour Operator Name Change')
@section('content')

<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Name Change of Tour Operator</h4>
  </div>
  <form action="{{ url('service-create/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <span for="">Name of the Tour Company</span>
            <input type="text" class="form-control" name="name" value="">
          </div>
        </div>
        <div class="col-md-4 offset-md-2">
          <div class="form-group">
            <span for="">Location </span>
            <input type="text" class="form-control" name="location" disabled>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <span for="">Name of the proprietor/s </span>
            <input type="text" class="form-control" name="proprietor" disabled>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <span for="">Telephone/Mobile No.</span>
            <input type="number" class="form-control" name="phone_number" id="" disabled>
          </div>
        </div>
      </div>
    </div> <!-- card body ends -->
    <div class="card-footer text-center">
      <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
      <button type="reset"class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
    </div>
  </form>
</div>

@endsection