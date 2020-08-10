@extends('layouts.manager')
@section('page-title','Tourism Product Proposal')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
@csrf
<input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
<input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
<input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
<input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Proponent Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="applicant_name" id="" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">CID<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="cid_no" autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" id="" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Contact Number <span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="contact_no" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Product Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Type <span class="text-danger">*</span> </label>
                <select  name="type" class="form-control">
                    <option value="">---SELECT---</option>
                    @foreach (config()->get('settings.type') as $k => $v)
                    <option value="{{ $k }}" {{ old('type') == $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Location <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="location" autocomplete="off" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Objective<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="objective" autocomplete="off">  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Product description in detail<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="product_des" autocomplete="off">  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for=""> Project cost<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="project_cost" autocomplete="off">  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for=""> Product implementation timeline<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="timeline" autocomplete="off">  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Contribution to tourism industry<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contribution" autocomplete="off">  
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <button type="submit"class="btn btn-success btn-sm"><i class="fa fa-check fa-sm"></i> APPLY</button>
        <button type="reset"class="btn btn-danger btn-sm"><i class="fa fa-times fa-sm"></i> RESET</button>
    </div>
</div>
</form>
@endsection