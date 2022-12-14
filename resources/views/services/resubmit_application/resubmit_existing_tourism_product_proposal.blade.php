@extends('layouts.enduser')
@section('page-title','Recommendation Letter For New Tourism Product')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Proponent Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Application No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="application_no" value="{{$applicantInfo->application_no}}" readonly="true">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Citizen ID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" value="{{$applicantInfo->cid_no}}" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="applicant_name" value="{{$applicantInfo->applicant_name}}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" value="{{$applicantInfo->address}}" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Contact Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="contact_no" value="{{$applicantInfo->contact_no}}"  autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="email" value="{{$applicantInfo->email}}"  autocomplete="off">
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
            <input type="hidden" class="form-control" name="record_id" value="{{ $productInfo->id }}">
            <div class="form-group col-md-5">
                <label for="">Product Category<span class="text-danger">*</span> </label>
                <select  name="product_category" class="form-control" id="product_category">
                    <option value="">---SELECT---</option>
                    @foreach ($productTypes as $productType)
                    <option value="{{ $productType->id }}" {{ old('product_category', $productInfo->dropdown_id) == $productType->id ? 'selected' : '' }}> {{ $productType->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Product Types <span class="text-danger">*</span> </label>
                <select  name="product_type_id" class="form-control" id="product_type_id">
                <option value="{{$productInfo->product_type_id}}">{{$productInfo->product_name}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Objective<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="objective" value="{{$productInfo->objective}}" autocomplete="off">  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Product description in detail<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="product_des" value="{{$productInfo->product_des}}" autocomplete="off">  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for=""> Project cost<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="project_cost" value="{{$productInfo->project_cost}}" autocomplete="off">  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Start Date<span class="text-danger">*</span></label>
                <div class="input-group date" id="start_date" data-target-input="nearest">
                    <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#start_date" value="{{ $applicantInfo->start_date}}">
                    <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">End Date<span class="text-danger">*</span></label>
                <div class="input-group date" id="end_date" data-target-input="nearest">
                    <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#end_date" value="{{ $applicantInfo->end_date}}">
                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div> 
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Contribution to tourism industry<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contribution" value="{{$productInfo->contribution}}" autocomplete="off">  
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Product Location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $productInfo->dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value="">{{ $productInfo->gewog_name }} </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $productInfo->village_id }}">{{ $productInfo->village_name }} </option>
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
        <h6> <strong>Required supporting documents:</strong></h6>
        <ol>
            <li>
                <em>An application addressed to the Director General of TCB requesting the issuance
                of technical clearance.</em>   
                </em>
            </li>
            <li>
                <em>
                Architectural drawings 
                </em>
            </li>
        </ol>
        @include('services/fileupload/fileupload')
    </div>
    <!-- card body ends -->
    <div class="card-footer text-center">
        <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
        <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
    </div>
</div>
</form>
@endsection
@section('scripts')
  <script>
    $(document).ready(function(){
        $('#start_date').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $('#end_date').datetimepicker({
            format: 'DD/MM/YYYY',
        });
    });
  </script>  
@endsection
