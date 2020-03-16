@extends('public_view.main')
@section('page-title','New : Tourism Product Proposal')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h3 class="card-title">Tourism Product Proposal Form</h3>
  </div>
  <form action="{{ url('tourism_product_proposal/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
     <h5>Proponent Details</h5>
     <div class="form-row">
      <div class="form-group col-md-5">
        <label for="">Name <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="name" id="" autocomplete="off" required>
      </div>
      <div class="form-group col-md-5 offset-md-2">
        <label for="">Address <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="address" id="" autocomplete="off" required>
      </div>
      <div class="form-group col-md-5">
        <label for="">Contact Number <span class="text-danger">*</span> </label>
        <input type="number" class="form-control" name="contact_no" autocomplete="off" required>
      </div>
    </div>

    <h5>Product Details</h5>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="">Type <span class="text-danger">*</span> </label>
        <select class="form-control select2bs4" required>
          <option value="" selected="selected">-select-</option>
          <option value="1">Implementing modality</option>
          <option value="2">Product summary</option>
          <option value="3">Activities and/or results framework</option>
        </select>
      </div>
      <div class="form-group col-md-5 offset-md-2">
        <label for="">Location <span class="text-danger">*</span> </label>
        <input type="text" class="form-control" name="address" id="" autocomplete="off" required>
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <button type="submit"class="btn btn-success btn-sm"><i class="fa fa-check fa-sm"></i> APPLY</button>
    <button type="reset"class="btn btn-danger btn-sm"><i class="fa fa-times fa-sm"></i> RESET</button>
  </div>
</form>
</div>
@endsection