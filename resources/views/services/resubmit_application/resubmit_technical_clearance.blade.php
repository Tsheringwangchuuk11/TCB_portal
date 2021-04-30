@extends('layouts.enduser')
@section('page-title','Technical Clearance Registration')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Application Number<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="application_no" value="{{ old('application_no',$applicantInfo->application_no) }}" readonly="true">
                                <input type="hidden" class="form-control" name="dispatch_no" value="{{ old('dispatch_no',$applicantInfo->dispatch_no) }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Purpose<span class="text-danger"> *</span></label>
                                <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                                    <option value="">- Select -</option>
                                    @foreach ($purposes as $purpose)
                                    <option value="{{ $purpose->id }}" {{ old('application_type_id', $purpose->id) == $applicantInfo->application_type_id ? 'selected' : '' }}>{{$purpose->dropdown_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Accommodation Type<span class="text-danger"> *</span></label>
                                <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                                    <option value="">- Select -</option>
                                    @foreach ($accommodationtypes as $accommodationtype)
                                    <option value="{{ $accommodationtype->id }}" {{ old('star_category_id', $accommodationtype->id) == $applicantInfo->star_category_id ? 'selected' : '' }}>{{$accommodationtype->dropdown_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('name',$applicantInfo->applicant_name) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Citizen ID<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="cid_no" value="{{ old('cid_no', $applicantInfo->cid_no) }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No.<span class="text-danger"> *</span></label>
                                <input type="text" name="contact_no" class="form-control" value="{{ old('contact_no',$applicantInfo->contact_no) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="number" value="{{ old('number', $applicantInfo->number) }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                                <div class="input-group date" id="tentative_cons" data-target-input="nearest">
                                    <input type="text" name="tentative_cons" class="form-control datetimepicker-input" data-target="#tentative_cons" value="{{ old('tentative_cons', $applicantInfo->tentative_cons) }}">
                                    <div class="input-group-append" data-target="#tentative_cons" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>                           
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                                <div class="input-group date" id="tentative_com" data-target-input="nearest">
                                    <input type="text" name="tentative_com" class="form-control datetimepicker-input" data-target="#tentative_com" value="{{ old('tentative_com',$applicantInfo->tentative_com) }}">
                                    <div class="input-group-append" data-target="#tentative_com" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                                <div class="input-group date" id="drawing_date" data-target-input="nearest">
                                    <input type="text" name="drawing_date" class="form-control datetimepicker-input" data-target="#drawing_date" value="{{ old('drawing_date', $applicantInfo->drawing_date) }}">
                                    <div class="input-group-append" data-target="#drawing_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control email" value="{{ old('email',$applicantInfo->email) }}" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Proposed location for construction</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                        <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                            <option value=""> -Select-</option>
                            @foreach ($dzongkhagLists as $dzongkhagList)
                            <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $applicantInfo->dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Gewog<span class="text-danger"> *</span></label>
                        <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                            <option value="{{$applicantInfo->gewog_id}}">{{$applicantInfo->gewog_name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Village<span class="text-danger"> *</span></label>
                        <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                            <option value="{{$applicantInfo->establishment_village_id}}">{{$applicantInfo->village_name}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($applicantInfo->application_type_id==23)
        <div class="card">
            <div class="card-header">
                <h4 class="card-tile">New Owner Information</h4>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Owner Name <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="new_owner_name" value="{{ $applicantInfo->new_owner_name }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Citizen ID <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="new_cid_no" value="{{ $applicantInfo->new_cid_no }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Contact No.<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="new_contact_no" value="{{ $applicantInfo->new_contact_no }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Email <span class="text-danger"> *</span></label>
                            <input type="email" class="form-control" name="new_email" value="{{ $applicantInfo->new_email }}">
                        </div>
                    </div>
            </div>
        </div>
    @endif
    <div class="card">
    <div class="card-header">
        <h4 class="card-title">File Attachment</h4>
    </div>
    <div class="card-body">
        <h6> <strong>Required supporting documents:</strong></h6>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ml-3">
                    <div class="form-check">
                        <ol id="new_application" style="display:none">
                            <li>
                                <em><input type="checkbox" name="checkboxes" class="new_application">&nbsp;An application addressed to the Director General of TCB requesting the issuance
                                of technical clearance.</em>   
                                </em>
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="new_application">&nbsp; Architectural drawings 
                                </em>
                            </li>
                        </ol>
                        <ol id="renewal" style="display:none">
                            <li>
                                <em> <input type="checkbox" name="checkboxes"  class="renewal">&nbsp; An application addressed to the Director General of TCB with clear justification
                                on renewal of technical clearance.
                                </em> 
                            </li>
                            <li>  
                                <em>  <input type="checkbox" name="checkboxes"  class="renewal">&nbsp; Surrender the previous technical clearance issued to the proponent..</em>
                            </li>
                        </ol>
                        <ol id="change_design" style="display:none">
                            <li>
                                <em> <input type="checkbox" name="checkboxes"  class="change_design">&nbsp; An application addressed to the Director General of TCB with clear justification
                                for issuance of new technical clearance.
                                </em>  
                            </li>
                            <li> 
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="change_design">&nbsp; Submit the new architectural drawings
                                </em>  
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="change_design">&nbsp;  Surrender the previous technical clearance issued to the proponent.
                                </em>   
                            </li>
                        </ol>
                        <ol id="ownership_change" style="display:none">
                            <li>
                                <em> <input type="checkbox" name="checkboxes"  class="ownership_change">&nbsp; An application addressed to the Director General of TCB with clear justification
                                for change in ownership.
                                </em> 
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="ownership_change">&nbsp; Original copy of undertaking letter signed by both parties..
                                </em>   
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="ownership_change">&nbsp;  Surrender the previous technical clearance issued to the proponent.   
                                </em>   
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @include('services/fileupload/fileupload')
    </div>
    <!-- card body ends -->
    <div class="card-footer text-center">
        <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
        <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
    </div>
</div>
<form>
@endsection
@section('scripts')
	<script>
        $(document).ready(function(){
            $('#tentative_cons').datetimepicker({
                format: 'MM/DD/YYYY',
            });
            $('#tentative_com').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#drawing_date').datetimepicker({
                format: 'MM/DD/YYYY'
            });
        var application_type_id=$("#application_type_id").val();
        if(application_type_id == "20"){
            $("#new_application").show();
            $("#renewal").hide();
            $("#change_design").hide();
            $("#ownership_change").hide();
        } 
        else if(application_type_id == "21"){
            $("#new_application").hide();
            $("#renewal").show();
            $("#change_design").hide();
            $("#ownership_change").hide();
        } 
        else if(application_type_id == "22"){
            $("#new_application").hide();
            $("#renewal").hide();
            $("#change_design").show();
            $("#ownership_change").hide();           

        }
        else if(application_type_id == "23"){
            $("#new_application").hide();
            $("#renewal").hide();
            $("#change_design").hide();
            $("#ownership_change").show();
        }
    $.validator.addMethod('check_one', function (value) {
    var application_type_id=$("#application_type_id").val();
        if(application_type_id==20){
            var chck = $('input.new_application[type=checkbox]');
            var numItems = $('.new_application').length;
            chck.hasClass('new_application');
            return (chck.filter(':checked').length ==numItems);

        }else if(application_type_id==21){
            var chck = $('input.renewal[type=checkbox]');
            var numItems = $('.renewal').length;
            chck.hasClass('renewal');
            return (chck.filter(':checked').length ==numItems);

        }
        else if(application_type_id==22){
            var chck = $('input.change_design[type=checkbox]');
            var numItems = $('.change_design').length;
            chck.hasClass('change_design');
            return (chck.filter(':checked').length ==numItems);

        }else{
            var chck = $('input.ownership_change[type=checkbox]');
            var numItems = $('.ownership_change').length;
            chck.hasClass('ownership_change');
            return (chck.filter(':checked').length ==numItems);


        }
    }, 'Submit all the document mention above'); 
       $('#form_data').validate({
                 ignore: [],
                rules: {
                    application_type_id: {
                       required: true,
                    },
                    checkboxes: {
                             check_one: true,
                    },
                    dispatch_no: {
                        required: function(element) {
                            var a=$("#application_type_id").val();
                            if(a==21){
                                return $("#application_type_id").val() ==21;

                             }else if(a==22){
                                return $("#application_type_id").val() ==22;
 
                             }else{
                            return $("#application_type_id").val() ==23;
                             }
                        }
                    }, 
                    star_category_id: {
                       required: true,
                    },
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
                     },
                    applicant_name: {
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
                    number: {
                        required: true,
                        digits: true,                    
                    },
                    tentative_cons: {
                        required: true,
                    },
                    tentative_com: {
                        required: true,
                    },
                    drawing_date: {
                        required: true,
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
                    new_owner_name: {
                        required: function(element) {
                            return $("#application_type_id").val() ==23;
                        }
                    }, 
                    new_cid_no: {
                        required: function(element) {
                            return $("#application_type_id").val() ==23;
                        }
                    }, 
                    new_contact_no: {
                        required: function(element) {
                             return $("#application_type_id").val() ==23;
                        }
                    }, 
                    new_email: {
                        required: function(element) {
                            return $("#application_type_id").val() ==23;
                        }
                    }, 
                   },
                messages: {
                    application_type_id: {
                         required: "Please select the application type",
                    },
                    dispatch_no: {
                          required: "Please enter dispatch number",
                    },
                    star_category_id: {
                    required: "Choose accommodation type",
                    },
                    cid_no: {
                        required: "Please provide a cid number",
                        maxlength: "Your cid must be 11 characters long",
                        minlength: "Your cid must be at least 11 characters long",
                        digits: "This field accept only digits",
                    },
                    applicant_name: {
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
                    number: {
                        required: "Please provide number of bed",
                        digits: "This field accept only digits",
                    },
                    tentative_cons: {
                        required: "Please select the date",
                    },
                    tentative_com: {
                        required: "Please select the date",
                    },
                    drawing_date: {
                        required: "Please select the date",
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
});
	</script>
    @endsection





