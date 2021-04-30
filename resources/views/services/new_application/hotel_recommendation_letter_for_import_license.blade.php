@extends('layouts.enduser')
@section('page-title','Recommendation for import license')
@section('content')
<form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="form_data">
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
                        <input type="text" class="form-control" name="license_no">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">License Date <span class="text-danger"> *</span></label>
                        <div class="input-group date" id="license_date" data-target-input="nearest">
                            <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ old('license_date') }}">
                            <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Hotel Name <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="company_title_name" id="company_title_name">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Citizen ID<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no" id="cid_no">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Owner Name <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="owner_name" id="owner_name">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Email <span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="contact_no" id="contact_no">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Company Location</h4>
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
            <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
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
            $('#license_date').datetimepicker({
                format: 'MM/DD/YYYY',
            });
        });
        $(document).ready(function(){
            $('#form_data').validate({
                rules: {
                    license_no: {
                       required: true,
                    },
                    license_date: {
                        required: true,
                    },
                    company_title_name: {
                       required: true,
                    },
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
                     },
                    owner_name: {
                        required: true,
                    },
                    contact_no: {
                        required: true,
                        digits: true,                    
                    },
                    email: {
                        required: true,
                        email: true,                    
                    },
                    dzongkhag_id: {
                        required: true,
                    },
                    gewog_id: {
                        required: true,
                    },
                    establishment_village_id: {
                        required: true,
                    },
                    remarks: {
                        required: true,
                    },
                   },
                messages: {
                    license_no: {
                         required: "Please enter the license number",
                    },
                    license_date: {
                          required: "Please enter license date",
                    },
                    company_title_name: {
                    required: "Please enter the company name",
                    },
                    cid_no: {
                        required: "Please provide a cid number",
                        maxlength: "Your cid must be 11 characters long",
                        minlength: "Your cid must be at least 11 characters long",
                        digits: "This field accept only digits",
                    },
                    owner_name: {
                        required: "Enter the owner name",
                    },
                    contact_no: {
                        required: "Please provide a contact number",
                        digits: "This field accept only digits",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    dzongkhag_id: {
                        required: "Please select dzongkhag",
                    },
                    gewog_id: {
                        required: "Please select gewog",
                    },
                    establishment_village_id: {
                        required: "Please select village",
                    },
                    remarks: {
                        required: "Please enter remarks",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
         });
    </script>
@endsection



