@extends('layouts.manager')
@section('page-title','Recommendation Letter For Existing Tourism Product')
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
                        <input type="text" class="form-control" name="applicant_name" id="" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">CID<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="cid_no" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" id="" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Contact Number <span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="contact_no" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="email" id="" autocomplete="off">
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
                <select  name="product_category" class="form-control" id="product_category">
                    <option value="">---SELECT---</option>
                    @foreach ($productTypes as $productType)
                    <option value="{{ $productType->id }}" {{ old('product_category') == $productType->id ? 'selected' : '' }}>{{ $productType->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Product Types <span class="text-danger">*</span> </label>
                <select  name="product_type_id" class="form-control" id="product_type_id">
                    <option value="">---SELECT---</option>
                </select>
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
                <label for="">Contribution to tourism industry<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contribution" autocomplete="off">  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Start Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="start_date" autocomplete="off">  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">End Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="end_date" autocomplete="off">  
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
                            <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Gewog<span class="text-danger"> *</span></label>
                        <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                            <option value=""> -Select-</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Village<span class="text-danger"> *</span></label>
                        <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                            <option value=""> -Select-</option>
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
        <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
    </div>
</div>
</form>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('#product_category').on('change',function(e) {
      var product_category = e.target.value;
      if(product_category){
         $("#product_type_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_product_types_master',
                           id: 'id',
                           name: 'product_name',
                     parent_id: product_category,
               parent_name_id: 'dropdown_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
                  $('select[name="product_type_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
            }
         });
      }else{
         $("#product_type_id option:gt(0)").remove();	
      }		 
   });

})
</script>
@endsection