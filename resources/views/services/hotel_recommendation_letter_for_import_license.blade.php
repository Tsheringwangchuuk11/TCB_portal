@extends('layouts.manager')
@section('page-title','Recommendation for import license')
@section('content')
<form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="formdata">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Company Information</h4>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">License Number <span class="text-danger"> *</span> </label>
                        <input type="text" class="form-control" name="license_no" onchange="getOwnerChangeDetails(this.value)">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">License Date </label>
                        <input type="text" class="form-control" name="license_date" id="license_date">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Hotel Name </label>
                        <input type="text" class="form-control" name="company_title_name" id="company_title_name">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Owner Name</label>
                        <input type="text" class="form-control" name="old_owner" id="old_owner">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">CID No. </label>
                        <input type="text" class="form-control" name="old_cid_no" id="old_cid_no">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Email </label>
                        <input type="email" class="form-control" name="old_email" id="old_email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Contact No. </label>
                        <input type="text" class="form-control" name="old_contact_no" id="old_contact_no">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Location </label>
                        <input type="hidden" class="form-control" name="location_id" id="location_id">
                        <input type="text" class="form-control" name="location_name" id="location_name">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Purpose<span class="text-danger">*</span> </label>
                        <textarea type="text" class="form-control" row="3" name="purpose"></textarea>
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
                    <em>
                    Copy of Proforma Invoice
                    </em>
                </li>
                <li>
                    <em>
                    Valid license copy
                    </em>
                </li>
                <li>
                    <em>
                    Tax clearance(for established hoteliers)               
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
        $(document).ready(function () {
            $('.select2bs4').on('change', function () {
                $(this).valid();
            });
        });
        $(document).ready(function(){ 
            id=1;
            $("#add").click(function(){
                $("#rowId").clone().attr('id', 'rowId'+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
                $addRow ='<span id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
                +'<span id="remove" onClick="removeForm('+id+')"' 
                +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
                +'<div id="line'+id+'"></div>';
                $('#adddiv').append($addRow);
                id++;

            });
        });
        function removeForm(id){  
            if (confirm('Are you sure you want to delete this form?')){
                $('#rowId'+id).remove();
                $('#remove'+id).remove();
                $('#line'+id).remove();
            }
        }

        $(document).ready(function(){
            $('#recommendation_type').on('change',function(e) {
                var recommendation_type=e.target.value;
                if(recommendation_type == "3" || recommendation_type == "5"){
                    $("#personalDtl").hide();
                    $("#licenseId").hide();
                    $("#workerId").show();
                } 
                else{
                    $("#personalDtl").show();
                    $("#licenseId").show();
                    $("#workerId").show();

                } 
            });
         });
    </script>
@endsection



