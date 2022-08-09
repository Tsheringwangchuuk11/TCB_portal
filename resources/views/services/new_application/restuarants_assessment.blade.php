@extends('layouts.enduser')
@section('page-title','Assessment And Registration Of Tourist Standard Restaurants')
@section('content') 
<form action="{{ url('application/save-application') }}" method="POST" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">General Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">License Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="license_no" value="{{ old('license_no') }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">License Date <span class="text-danger">*</span> </label>
                        <div class="input-group date" id="license_date" data-target-input="nearest">
                            <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ old('license_date') }}">
                            <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Restaurant Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="company_title_name" value="{{ old('company_title_name') }}">
                    </div>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Citizen ID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" id="cid_no" value="{{ old('cid_no') }}" onchange="api_webservices(this.value)">
                    <span id="webserviceError" class="text-danger"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name of Owner <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="owner_name" value="{{ old('owner_name') }}" id="applicant_name">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Contact No <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no') }}" id="contact_no">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Fax </label>
                        <input type="text" class="form-control" name="fax" value="{{ old('fax') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="webpage_url" value="{{ old('webpage_url') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Restuarant Location</h4>
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
            <h4 class="card-title">Staff Details</h4>
        </div>
            <table id="staffDetail" class="table table-condensed table-striped">
                <thead>
                    <th width="1%"  class="text-center">#</th>
                    <th width="15%">CID</th>
                    <th width="20%">Name</th>
                    <th width="15%">Gender</th>
                    <th>Designation</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th width="10%">Salary</th>
                    <th>Hospitility relating</th>
                </thead>
                <tbody>
                    <tr>
                        <td width="1%" class="text-center">
                            <a href="#" class="delete-table-row btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                        </td>
                        <td width="15%">
                            <input type="text" name="staff_cid_no[]" class="form-control">
                        </td>
                        <td width="20%">
                            <input type="text" name="staff_name[]" class="form-control" />
                        </td>
                        <td width="15%">
                            <select class="form-control input-sm" name="staff_gender[]">
                                <option value=""> </option>
                                @foreach (config()->get('settings.gender') as $k => $v)
                                <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="staff_designation[]" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" name="qualification[]" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" name="experience[]" class="form-control input-sm">
                        </td>
                        <td width="10%">
                            <input type="text" name="salary[]" class="form-control input-sm" />
                        </td>
                        <td>
                            <select class="form-control input-sm" name="hospitility_relating[]">
                                <option value=""> </option>
                                @foreach (config()->get('settings.hospitility_relating') as $k => $v)
                                <option value="{{ $k }}" {{ old('hospitility_relating') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="notremovefornew">
                        <td class="text-right" colspan="9">
                            <a href="#" class="add-table-row btn bg-purple btn-sm"><i class="fa fa-plus"></i> Add New Row</a>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div id="showdivid"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol>
                <li>
                    <em>Please attach additional sheets where necessary like pictures of the office</em>   
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
                format: 'DD/MM/YYYY'
            });
        });
        $(document).ready(function () {
            function loadChecklistDetails() {
                var url="{{ url('application/get-checklist') }}";
                    var options = {target:'#showdivid',
                    url:url,
                    type:'POST',
                    data: $("#form_data").serialize()};
                    $("#form_data").ajaxSubmit(options);
            }
           window.onload=loadChecklistDetails();
         });

         $.validator.addMethod('checkScorepoint', function (value) {
                    return (value >= 330);
            }, 'Your score point should be minimum 330');
        
        $('#form_data').validate({
                rules: {
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
                     },
                     license_date: {
                        required: true,
                    },
                    company_title_name: {
                        required: true,
                    },
                    license_no: {
                        required: true,
                    },
                    owner_name: {
                        required: true,
                    },
                    address: {
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
                    webpage_url: {
                        required: true,
                        url: true,
                        normalizer: function( value ) {
                        var url = value;
                        // Check if it doesn't start with http:// or https:// or ftp://
                        if ( url && url.substr( 0, 7 ) !== "http://"
                            && url.substr( 0, 8 ) !== "https://"
                            && url.substr( 0, 6 ) !== "ftp://" ) {
                        // then prefix with http://
                        url = "http://" + url;
                        }
                        // Return the new url
                        return url;
                        }
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
                     scorepoint: {
                        checkScorepoint: true,
                    }, 
                   },
                messages: {
                    cid_no: {
                        required: "Please provide a cid number",
                        maxlength: "Your cid must be 11 characters long",
                        minlength: "Your cid must be at least 11 characters long",
                        digits: "This field accept only digits",
                    },
                    owner_name: {
                        required: "Enter the name",
                    },
                    contact_no: {
                        required: "Please provide a contact number",
                        digits: "This field accept only digits",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    webpage_url: {
                        required: "Please enter webpage_url",
                    },
                    company_title_name: {
                        required: "Please enter company name",
                    },
                    license_date: {
                        required: "Please enter license date",
                    },
                    license_no: {
                        required: "Please enter license number",
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
    </script>
@endsection
