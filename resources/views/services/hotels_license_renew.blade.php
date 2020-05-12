@extends('layouts.manager')
@section('page-title','Tourist Standard Hotel License Renew')
@section('content')
<div class="card">
    <div class="card-header bg-success">
        <h4 class="card-title">Tourist Standard Hotel License Renew</h4>
    </div>
    <form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
        <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
        <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
        <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">License Number <span class="text-danger"> *</span> </label>
                            <input type="text" class="form-control" name="license_number" onchange="getOwnerChangeDetails(this.value)">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label>Registration Type</label>
                            <input type="text" class="form-control" name="star_category_name" id="star_category_name" readonly="true">
                            <input type="hidden" class="form-control" name="star_category_id" id="star_category_id">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">License Date <span class="text-danger"> *</span> </label>
                            <input type="date" class="form-control" name="license_date">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Hotel Name </label>
                            <input type="text" class="form-control" name="company_title_name" id="company_title_name" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Owner Name</label>
                            <input type="text" class="form-control" name="owner_name" id="owner_name" readonly="true">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Address </label>
                            <input type="text" class="form-control" name="address" id="address"readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">CID No. </label>
                            <input type="text" class="form-control" name="cid_no" id="cid_no" readonly="true">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Contact No. </label>
                            <input type="text" class="form-control" name="contact_no" id="contact_no" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5 ">
                            <label for="">Fax </label>
                            <input type="text" class="form-control" name="fax" id="fax" readonly="true">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Email </label>
                            <input type="email" class="form-control" name="email" id="email" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Internet Homepage </label>
                            <input type="text" class="form-control" name="webpage_url" id="webpage_url" readonly="true">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Number of Beds </label>
                            <input type="number" class="form-control" name="number" id="number" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Location </label>
                            <input type="text" class="form-control" name="location_id" id="location_id" readonly="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success">
                <li class="fas fa-check"></li>
                APPLY
            </button>
            <button type="reset"class="btn btn-danger">
                <li class="fas fa-times"></li>
                RESET
            </button>
        </div>
    </form>
</div>
@endsection
<script>
    function getOwnerChangeDetails(licenseNo){
        $.ajax({
               url:'/application/get-ownership-details/'+licenseNo,
               type: "GET",
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
               dataType: "json",
               success:function(data) {
                $('#star_category_name').val(data.star_category_name);
                $('#star_category_id').val(data.star_category_id);
                $('#company_title_name').val(data.company_title_name);
                $('#owner_name').val(data.owner_name);
                $('#cid_no').val(data.cid_no);
                $('#contact_no').val(data.contact_no);
                $('#address').val(data.address);
                $('#fax').val(data.fax);
                $('#email').val(data.email);
                $('#webpage_url').val(data.webpage_url);
                $('#number').val(data.number);
                $('#location_id').val(data.location_id);
               } 
            });
        }
</script>