@extends('layouts.manager')
@section('page-title','Recommendation Letter For New Tourism Product')
@section('content')
<form action="{{ url('verification/existing-tourism-product-development') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_data">
@csrf
<input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
<input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
<input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">

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
                    <input type="text" class="form-control" name="application_no" value="{{$applicantInfo->application_no}}" disabled>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Citizen ID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" value="{{$applicantInfo->cid_no}}" autocomplete="off" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="name" value="{{$applicantInfo->applicant_name}}" autocomplete="off" disabled>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" value="{{$applicantInfo->address}}" autocomplete="off" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Contact Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="contact_no" value="{{$applicantInfo->contact_no}}"  autocomplete="off" disabled>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="email" value="{{$applicantInfo->email}}"  autocomplete="off" disabled>
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
                <label for="">Product Category<span class="text-danger">*</span> </label>
                <select  name="product_category" class="form-control" id="product_category" disabled>
                    <option value="">---SELECT---</option>
                    @foreach ($productTypes as $productType)
                    <option value="{{ $productType->id }}" {{ old('product_category', $productInfo->dropdown_id) == $productType->id ? 'selected' : '' }}> {{ $productType->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Product Types <span class="text-danger">*</span> </label>
                <select  name="product_type_id" class="form-control" id="product_type_id" disabled>
                <option value="{{$productInfo->product_type_id}}">{{$productInfo->product_name}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Objective<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="objective" value="{{$productInfo->objective}}" autocomplete="off" disabled>  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Product description in detail<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="product_des" value="{{$productInfo->product_des}}" autocomplete="off" disabled>  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for=""> Project cost<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="project_cost" value="{{$productInfo->project_cost}}" autocomplete="off" disabled>  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Start Date<span class="text-danger">*</span></label>
                <div class="input-group date" id="start_date" data-target-input="nearest">
                    <input type="text" name="start_date" class="form-control" value="{{ $productInfo->start_date }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">End Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="end_date" value="{{$productInfo->end_date}}" autocomplete="off">  
                <div class="input-group date" id="end_date" data-target-input="nearest">
                    <input type="text" name="end_date" class="form-control" value="{{ $productInfo->end_date }}" disabled>
                </div>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Contribution to tourism industry<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contribution" value="{{$productInfo->contribution}}" autocomplete="off" disabled>  
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
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;" disabled>
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
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;" disabled>
                        <option value="">{{ $productInfo->gewog_name }} </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;" disabled>
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
        @include('services/fileupload/fileupload')
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Remarks <span class="text-danger">*</span> </label>
                <textarea type="text" class="form-control" id="remarks" name="remarks" row="3" disabled></textarea>
                <div id="remarks_error" class="text-danger"></div>
            </div>
        </div>
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
    function requiredRemarks(status) {
			$("#remarks_error").html('');
			if($("#remarks").val() ==""){
				if(status=="RESUBMIT"){
					$("#remarks_error").html('Please provide reason for resubmit!');
				}else{
					$("#remarks_error").html('Please provide reason for rejection!');
				}
				return false;
			}
		}
</script>
@endsection