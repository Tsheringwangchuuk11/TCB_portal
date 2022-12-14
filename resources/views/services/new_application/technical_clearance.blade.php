@extends('layouts.enduser')
@section('page-title','Issuance Of Technical Clearance')
@section('content')
<form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="form_data">
@csrf
<input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
<input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
<input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
<input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<input type="hidden" name="record_id" id="record_id">
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
                            <label for="" >Purpose<span class="text-danger"> *</span></label>
                            <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                                <option value="">- Select -</option>
                                @foreach ($purposes as $purpose)
                                <option value="{{$purpose->id}}">{{$purpose->dropdown_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2" style="display: none" id="dispatchNumberId">
                        <div class="form-group">
                            <label for="">Dispatch Number<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="dispatch_no" value="{{ old('dispatch_no') }}" id="dispatch_no" onchange="getTechCleranceDetails()">
                        </div>
                        <div class="alert alert-danger alert-dismissible" id="alertTraineeMgsId" style="display: none">
                            <i class="fa fa-info-circle fa-lg"></i><strong><span id="showTraineeMsg"></span> Your dispatch number is incorrect</strong>
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
                                <option value="{{$accommodationtype->id}}">{{$accommodationtype->dropdown_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Citizen ID<span class="text-danger"> * </span></label>
                            <input type="text" class="form-control" name="cid_no" value="{{ old('cid_no') }}" autocomplete="off" id="cid_no" onchange="api_webservices(this.value)" maxlength="11">
                            <span id="webserviceError" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="" >Name of the promoter/business<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off" id="applicant_name">
                        </div>
                    </div>
                    
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Contact No.<span class="text-danger"> *</span></label>
                            <input type="text" name="contact_no" class="form-control" value="{{ old('contact_no') }}" id="contact_no" autocomplete="off" maxlength="8">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Email<span class="text-danger"> *</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">No. of rooms proposed<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="number" value="{{ old('number') }}" id="number" autocomplete="off" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Tentative construction date<span class="text-danger"> *</span> </label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" name="tentative_cons" class="form-control datetimepicker-input" id="tentative_cons" data-target="#tentative_cons" value="{{ old('tentative_cons') }}">
                                <div class="input-group-append" data-target="#tentative_cons" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" name="tentative_com" class="form-control datetimepicker-input" id="tentative_com" data-target="#tentative_com" value="{{ old('tentative_com') }}">
                                <div class="input-group-append" data-target="#tentative_com" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                       
                         </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" name="drawing_date" class="form-control datetimepicker-input" id="drawing_date" data-target="#drawing_date" value="{{ old('drawing_date') }}">
                                <div class="input-group-append" data-target="#drawing_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
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
            <div class="col-md-4">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value=""> -Select-</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value=""> -Select-</option>
                    </select>
                </div>
            </div>
        </div>
	<div class="row">
	   <div class="form-group col-md-4">
		<label for="">Thram Number[new]</label>
		<input type="text" class="form-control" name="n_thramno">
	  </div>
	  <div class="form-group col-md-4">
                <label for="">Plot Number[new]</label>
                <input type="text" class="form-control" name="n_plotno">
          </div>
	</div>
    </div>
</div>
<div class="card"  id="newowner" style="display: none">
    <div class="card-header">
        <h4 class="card-tile">New Owner Information</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Owner Name <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="new_owner_name">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">CID No. <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="new_cid_no">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Contact No.<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="new_contact_no">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Email <span class="text-danger"> *</span></label>
                    <input type="email" class="form-control" name="new_email">
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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ml-3">
                    <div class="form-check">
                        <ol id="new_application" style="display:none">
                            <li>
                                <em><input type="checkbox" name="checkboxes" class="new_application">&nbsp;Copy of lagthram.</em>   
                                </em>
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="new_application">&nbsp; Architectural drawings (Include only floor plan and elevations) 
                                </em>
                            </li>
                        </ol>
                        <ol id="renewal" style="display:none">
                            <li>
                                <em> <input type="checkbox" name="checkboxes"  class="renewal">&nbsp; Copy of lagthram.
                                </em> 
                            </li>
                            <li>  
                                <em>  <input type="checkbox" name="checkboxes"  class="renewal">&nbsp; Attach previous technical clearance issued to the proponent.</em>
                            </li>
			    <li>
				<em> <input type="checkbox" name="checkboxes" class="renewal">&nbsp; Valid copy of construction permit issued by relevant Thromde/Dzongkhag.</em>
			    </li>
                        </ol>
                        <ol id="change_design" style="display:none">
                            <li>
                                <em> <input type="checkbox" name="checkboxes"  class="change_design">&nbsp; Copy of lagthram
                                </em>  
                            </li>
                            <li> 
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="change_design">&nbsp; Attach new architectural drawings
                                </em>  
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="change_design">&nbsp; Attach previous technical clearance issued to the proponent.
                                </em>   
                            </li>
                        </ol>
                        <ol id="ownership_change" style="display:none">
                            <li>
                                <em> <input type="checkbox" name="checkboxes"  class="ownership_change">&nbsp; Lagthram of new owner.
                                </em> 
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="ownership_change">&nbsp; Copy of undertaking letter signed by both parties..
                                </em>   
                            </li>
                            <li>
                                <em>
                                    <input type="checkbox" name="checkboxes"  class="ownership_change">&nbsp; Attach previous technical clearance issued to the proponent.   
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
</form>
@endsection
@section('scripts')
<script>

$(document).ready(function(){
    $('.select2bs4').on('change', function () {
      $(this).valid();
     });
    $('#tentative_cons').datetimepicker({
        format: 'MM/DD/YYYY',
    });
    $('#tentative_com').datetimepicker({
        format: 'MM/DD/YYYY'
    });
    $('#drawing_date').datetimepicker({
        format: 'MM/DD/YYYY',
    });
    $('#application_type_id').on('change',function(e) {
            $('#cid_no').val('');
            $("#star_category_id").val("").trigger("change.select2");        
            $('#contact_no').val('');
            $('#email').val(''); 
            $('#number').val('');
            $('#tentative_cons').val(''); 
            $('#tentative_com').val('');
            $('#drawing_date').val('');
            $("#dzongkhag_id").val("").trigger("change.select2");        
            $("#gewog_id").val("").trigger("change.select2");        
            $("#village_id").val("").trigger("change.select2");        
            $("#dispatch_no").val('');
            $('#applicant_name').val(''); 
            $('input:checkbox').removeAttr('checked');

        var application_type_id=e.target.value;
        if(application_type_id == "20"){
            $('input').prop('readonly', false); 
            $('select').prop('disabled', false); 
            $("#new_application").show();
            $("#renewal").hide();
            $("#change_design").hide();
            $("#ownership_change").hide();
            $("#dispatchNumberId").hide();
            $("#newowner").hide();
        } 
        else if(application_type_id == "21"){
            $("#new_application").hide();
            $("#renewal").show();
            $("#change_design").hide();
            $("#ownership_change").hide();
            $("#dispatchNumberId").show();
            $("#newowner").hide();
        } 
        else if(application_type_id == "22"){
            $("#new_application").hide();
            $("#renewal").hide();
            $("#change_design").show();
            $("#ownership_change").hide();           
            $("#dispatchNumberId").show();
            $("#newowner").hide();

        }
        else if(application_type_id == "23"){
            $("#new_application").hide();
            $("#renewal").hide();
            $("#change_design").hide();
            $("#ownership_change").show();
            $("#dispatchNumberId").show();
            $("#newowner").show();
        }
    });
});  
        
           
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
                     }  
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
function getTechCleranceDetails(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        var dispatchNo=$("#dispatch_no").val();
        var application_type_id=$("#application_type_id").val();
            $.ajax({
                url:'/application/get-tech-clearance-dtls/'+dispatchNo,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    if(data !=false){
                    $('#record_id').val(data.id);
                    $('#star_category_id').val(data.accomodation_type_id).trigger("change");
                    $('#cid_no').val(data.cid_no);
                    $('#applicant_name').val(data.name);
                    $('#contact_no').val(data.contact_no);
                    $('#email').val(data.email);
                    $('#number').val(data.proposed_rooms_no);
                    $('#tentative_cons').val(data.tentative_cons);
                    $('#tentative_com').val(data.tentative_com);
                    $('#drawing_date').val(data.drawing_date);
                    $('#dzongkhag_id').val(data.dzongkhag_id).trigger("change");
                    $('#gewog_id').val(data.gewog_id);
                    getGewogDropDown(data.dzongkhag_id,data.gewog_id,data.village_id);
                    }else{
                        $('#alertTraineeMgsId').show().delay(3000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        $("#dispatch_no").val('');
                    }
                } 
            });
        }
        function getGewogDropDown(dzongkhag_id,gewog_id,village_id){
            if(dzongkhag_id){
            $("#gewog_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_gewog_masters',
                           id: 'id',
                           name: 'gewog_name',
                     parent_id: dzongkhag_id,
               parent_name_id: 'dzongkhag_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
                   $('select[name="gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
               $('#gewog_id').val(gewog_id).trigger("change");
               getvillageDroDown(gewog_id,village_id);                  
             }
         });

        }else{
         $("#gewog_id option:gt(0)").remove();	
         $("#village_id option:gt(0)").remove();
        }
        }

        function getvillageDroDown(gewog_id,villageId){
        if(gewog_id){
         $("#village_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_village_masters',
                           id: 'id',
                           name: 'village_name',
                     parent_id: gewog_id,
               parent_name_id: 'gewog_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
                  $('select[name="establishment_village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
               $('#village_id').val(villageId).trigger("change");
            }
         });
        }else{
         $("#village_id option:gt(0)").remove();	
      }
    }
</script>
@endsection



