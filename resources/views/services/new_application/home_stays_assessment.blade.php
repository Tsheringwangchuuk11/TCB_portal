@extends('layouts.enduser')
@section('page-title','Assessment And Registration Of Village Home Stays')
@section('content')
<form action="{{ url('application/save-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Personal Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Registration Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                        <option value="">- Select -</option>
                        @foreach ($applicationTypes as $applicationType)
                        <option value="{{$applicationType->id}}"  {{ old('application_type_id') == $applicationType->id ? 'selected' : '' }}>{{$applicationType->dropdown_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label>Home Stay Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="company_title_name" value="{{ old('company_title_name') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group ">
                        <label for="">Citizen ID<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no"  id="cid_no" value="{{ old('cid_no') }}" onchange="api_webservices(this.value)" maxlength="11">
                        <span id="webserviceError" class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Name of Owner<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="applicant_name" id="applicant_name" value="{{ old('applicant_name') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Contact No.<span class="text-danger"> *</span> </label>
                        <input type="text" class="form-control" name="contact_no" id="contact_name" value="{{ old('contact_no') }}" maxlength="8">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                        <select class="form-control select2bs4 dzongkhagdropdown" name="dzongkhag_id" id="dzongkhag_id" style="width: 100%;">
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
                        <label for="">Chiwog<span class="text-danger"> *</span></label>
                        <select  name="chiwog_id" class="form-control select2bs4" id="chiwog_id" style="width: 100%;">
                            <option value=""> -Select-</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Village <span class="text-danger"> *</span></label>
                        <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                            <option value=""> -Select-</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Thram No.<span class="text-danger"> *</span> </label>
                        <input type="text" class="form-control" name="thram_no" value="{{ old('thram_no') }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">House No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="house_no" value="{{ old('house_no') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Locations</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Distance from the nearest town/urban centre (hrs or kms)<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="town_distance" value="{{ old('town_distance') }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Distance from the main road (hrs or kms)<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="road_distance" value="{{ old('road_distance') }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Condition of the pathway to house from the road point<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="condition" value="{{ old('condition') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Details Of The Family Members Residing In The Same House</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Name <span class="text-danger">*</span></label>
                </div>
                <div class="form-group col-md-3">
                    <label>Relationship with the applicant <span class="text-danger">*</span></label>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Age <span class="text-danger">*</span> </label>
                </div>
                <div class="form-group col-md-3">
                    <label>Gender <span class="text-danger">*</span></label>
                </div>
            </div>
            <div id="row">
                <div class="row">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" name="member_name[]">
                    </div>
                    <div class="form-group col-md-3">
                        <select class="form-control" name="relation_type_id[]">
                            <option value="">- Select -</option>
                            @foreach ($relationTypes as $relationType)
                            <option value="{{ $relationType->id }}"> {{ $relationType->dropdown_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                       <input type="date" class="form-control" name="member_dob[]" autocomplete="off">
                   </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" name="member_gender[]">
                            <option value="">- Select -</option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                            <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="adddiv"></div>
            <span class="btn bg-purple btn-sm float-right" id="add"> <i class="fas fa-plus fa-sm">Add New Row</i> </span>
        </div>
    </div>
    <div id="showdivid"></div>
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
                        <div class="row">
                            <div class="col-md-4">
                            1.&nbsp;<input type="checkbox" name="checkboxes"  class="check-one" id="family_tree_checkbox" onclick="family_tree_check()">&nbsp;<em> Family tree</em> 
                            </div>
                            <div class="col-md-2">
                                <em id="family_tree_files_div" style="display:none;">
                                    <span class="btn bg-purple fileinput-button btn-sm">
                                        <i class="fas fa-plus fa-sm"></i>
                                        <span>Add file...</span>
                                        <input id="family_tree_upload" type="file" name="filename"> 
                                    </span>
                                </em>
                            </div>
                            <div class="col-md-6" id="family_tree_files"></div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                            2.&nbsp;<input type="checkbox" name="checkboxes"  class="check-one" id="house_checkbox" onclick="house_check()">&nbsp; <em>Pictures of house</em>
                            </div>
                            <div class="col-md-2">
                                <em id="house_pic_files_div" style="display:none;">
                                    <span class="btn bg-purple fileinput-button btn-sm">
                                        <i class="fas fa-plus fa-sm"></i>
                                        <span>Add file...</span>
                                        <input id="house_pic_upload" type="file" name="filename"> 
                                    </span>
                                </em>
                            </div>
                            <div class="col-md-6" id="house_pic_files"></div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                            3.&nbsp;<input type="checkbox" name="checkboxes"  class="check-one" id="toilet_bath_checkbox" onclick="toilet_bath_check()">&nbsp; Pictures of toilet/ bath rooms</em>
                            </div>
                            <div class="col-md-2">
                                <em id="toilet_bath_files_div" style="display:none;">
                                    <span class="btn bg-purple fileinput-button btn-sm">
                                        <i class="fas fa-plus fa-sm"></i>
                                        <span>Add file...</span>
                                        <input id="toilet_bath_upload" type="file" name="filename"> 
                                    </span>
                                </em>
                            </div>
                            <div class="col-md-6" id="toilet_bath_files"></div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                            4.&nbsp;<input type="checkbox" name="checkboxes"  class="check-one" id="guest_room_checkbox" onclick="guest_room_check()">&nbsp;<em> Pictures of guest room </em>
                            </div>
                            <div class="col-md-2">
                                <em id="guest_room_files_div" style="display:none;">
                                    <span class="btn bg-purple fileinput-button btn-sm">
                                        <i class="fas fa-plus fa-sm"></i>
                                        <span>Add file...</span>
                                        <input id="guest_room_upload" type="file" name="filename"> 
                                    </span>
                                </em>
                            </div>
                            <div class="col-md-6" id="guest_room_files"></div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                            5.&nbsp;<input type="checkbox" name="checkboxes"  class="check-one" id="kitchen_checkbox" onclick="kitchen_check()">&nbsp; <em>Pictures of kitchen</em>
                            </div>
                            <div class="col-md-2">
                                <em id="kitchen_files_div" style="display:none;">
                                    <span class="btn bg-purple fileinput-button btn-sm">
                                        <i class="fas fa-plus fa-sm"></i>
                                        <span>Add file...</span>
                                        <input id="kitchen_file_upload" type="file" name="filename"> 
                                    </span>
                                </em>
                            </div>
                            <div class="col-md-6" id="kitchen_files"></div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                            6.&nbsp;<input type="checkbox" name="checkboxes"  class="check-one" id="waste_checkbox" onclick="waste_check()">&nbsp;<em> Pictures of waste management</em>
                            </div>
                            <div class="col-md-2">
                                <em id="waste_files_div" style="display:none;">
                                    <span class="btn bg-purple fileinput-button btn-sm">
                                        <i class="fas fa-plus fa-sm"></i>
                                        <span>Add file...</span>
                                        <input id="waste_file_upload" type="file" name="filename"> 
                                    </span>
                                </em>
                            </div>
                            <div class="col-md-6" id="waste_files"></div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                            7.&nbsp;<input type="checkbox" name="checkboxes"  class="check-one" id="dining_living_checkbox" onclick="dining_living_check()">&nbsp;<em> Pictures of dining room / living room </em>
                            </div>
                            <div class="col-md-2">
                                <em id="dining_living_files_div" style="display:none;">
                                    <span class="btn bg-purple fileinput-button btn-sm">
                                        <i class="fas fa-plus fa-sm"></i>
                                        <span>Add file...</span>
                                        <input id="dining_living_file_upload" type="file" name="filename"> 
                                    </span>
                                </em>
                            </div>
                            <div class="col-md-6" id="dining_living_files"></div>
                        </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center" >
            <button type="submit"class="btn btn-success">
                <li class="fas fa-check"></li>
                APPLY
            </button>
            <button type="reset" class="btn btn-danger">
                <li class="fas fa-ban"></li>
                RESET
            </button>
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
				$("#row").clone().attr('id', 'row'+id).after("#id").appendTo("#adddiv").find("input[type='text'],select,input[type='date']").val("");
				$addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
				+'<span id="remove" onClick="removeForm('+id+')"' 
				+'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
				+'<div id="line'+id+'"></div>';
				$('#adddiv').append($addRow);
				id++;
			});
		});
	
		function removeForm(id){  
			if (confirm('Are you sure you want to delete this form?')){
				$('#row'+id).remove();
				$('#remove'+id).remove();
				$('#line'+id).remove();
			}
		}
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

        // document check list validation
        var chck = $('input[type=checkbox]');
        var numItems = $('.check-one').length;
        chck.hasClass('check-one');
        $.validator.addMethod('check_one', function (value) {
            return (chck.filter(':checked').length ==numItems);
        }, 'Submit all the document mention above'); 

        // form validation
        $('#form_data').validate({
                rules: {
                    application_type_id: {
                       required: true,
                    },
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
                     },
                     checkboxes: {
                             check_one: true,
                    },
                    company_title_name: {
                        required: true,
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
                    dzongkhag_id: {
                        required: true,
                    },
                    gewog_id: {
                        required: true,
                    },
                    chiwog_id: {
                        required: true,
                    },
                    establishment_village_id: {
                        required: true,
                    },
                    thram_no: {
                        required: true,
                    },
                    house_no: {
                        required: true,
                    },
                    town_distance: {
                        required: true,
                    },
                    road_distance: {
                        required: true,
                    },
                    condition: {
                        required: true,
                    },
                    
                   },
                messages: {
                    application_type_id: {
                         required: "Please select the application type",
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
                    company_title_name: {
                        required: "Please enter home stay name",
                    },
                    dzongkhag_id: {
                        required: "Please select dzongkhag",
                    },
                    gewog_id: {
                        required: "Please select gewog",
                    },
                    chiwog_id: {
                        required: "Please select gewog",
                    },
                    establishment_village_id: {
                        required: "Please select village",
                    },
                    thram_no: {
                        required:"Please enter the thram number",
                    },
                    house_no: {
                        required: "Please enter the house number",
                    },
                    town_distance: {
                        required: "Please enter the town distance",
                    },
                    road_distance: {
                        required: "Please enter the road distance",
                    },
                    condition: {
                        required: "Please condtions",
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

         function family_tree_check()
         {
            if($('#family_tree_checkbox').is(':checked'))
            {
                $('#family_tree_files_div').show();
            }
            else
            {
                $('#family_tree_files_div').hide();
            }
         }

         function house_check()
         {
            if($('#house_checkbox').is(':checked'))
            {
                $('#house_pic_files_div').show();
            }
            else
            {
                $('#house_pic_files_div').hide();
            }
         }

         function toilet_bath_check()
         {
            if($('#toilet_bath_checkbox').is(':checked'))
            {
                $('#toilet_bath_files_div').show();
            }
            else
            {
                $('#toilet_bath_files_div').hide();
            }
         }

         function guest_room_check()
         {
            if($('#guest_room_checkbox').is(':checked'))
            {
                $('#guest_room_files_div').show();
            }
            else
            {
                $('#guest_room_files_div').hide();
            }
         }

         function kitchen_check()
         {
            if($('#kitchen_checkbox').is(':checked'))
            {
                $('#kitchen_files_div').show();
            }
            else
            {
                $('#kitchen_files_div').hide();
            }
         }

         function waste_check()
         {
            if($('#waste_checkbox').is(':checked'))
            {
                $('#waste_files_div').show();
            }
            else
            {
                $('#waste_files_div').hide();
            }
         }

         function dining_living_check()
         {
            if($('#dining_living_checkbox').is(':checked'))
            {
                $('#dining_living_files_div').show();
            }
            else
            {
                $('#dining_living_files_div').hide();
            }
         }
	</script>
@endsection
