@extends('layouts.manager')
@section('page-title','Village Home Stay Assessment')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Personal Details</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Application No.<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="application_no" value="{{ old('application_no', $applicantInfo->application_no) }}" readonly="true">
					</div>
				</div>
				<div class="form-group col-md-5 offset-md-2">
                    <label>Registration Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;" readonly="true">
                        <option value="">- Select -</option>
                        @foreach ($applicationTypes as $applicationType)
                        <option value="{{ $applicationType->id }}" {{ old('application_type_id', $applicantInfo->application_type_id) == $applicationType->id ? 'selected' : '' }}> {{ $applicationType->dropdown_name }}</option>
                        @endforeach
                    </select>
                </div>
			  </div>
			  <div class="row">
                <div class="form-group col-md-5">
                    <label>Home Stay Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="company_title_name" value="{{ old('company_title_name',$applicantInfo->company_title_name) }}">
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
					  <label for="">Name<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name', $applicantInfo->applicant_name) }}" autocomplete="off">
					</div>
				  </div>
            </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group ">
					  <label for="">CID No.<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="cid_no"  value="{{ old('cid_no',$applicantInfo->cid_no) }}" autocomplete="off">
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Contact No.<span class="text-danger"> *</span> </label>
					<input type="text" class="form-control" name="contact_no" value="{{ old('contact_no',$applicantInfo->contact_no) }}" autocomplete="off">
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Email<span class="text-danger"> *</span></label>
					  <input type="email" class="form-control" name="email" value="{{ old('email',$applicantInfo->email) }}" autocomplete="off">
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
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
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Gewog<span class="text-danger"> *</span></label>
						  <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
						  <option value="{{$applicantInfo->gewog_id}}">{{$applicantInfo->gewog_name}}</option>
						  </select>                
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Chiwog<span class="text-danger"> *</span></label>
					<select  name="chiwog_id" class="form-control select2bs4 " id="chiwog_id" style="width: 100%;">
						<option value="{{$applicantInfo->chiwog_id}}">{{$applicantInfo->chiwog_name}}</option>
					</select>
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Village <span class="text-danger"> *</span></label>
					  <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
						<option value="{{$applicantInfo->establishment_village_id}}"> {{$applicantInfo->village_name}}</option>
					</select>
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Thram No.<span class="text-danger"> *</span> </label>
					<input type="text" class="form-control" name="thram_no" value="{{ old('thram_no',$applicantInfo->thram_no) }}">
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">House No.<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="house_no" value="{{ old('house_no',$applicantInfo->house_no) }}">
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
					<input type="text" class="form-control" name="town_distance" value="{{ $applicantInfo->town_distance }}">
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Distance from the main road (hrs or kms)<span class="text-danger"> *</span></label>
					<input type="text" class="form-control" name="road_distance" value="{{ $applicantInfo->road_distance }}">
				  </div>
				</div>
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Condition of the pathway to house from the road point<span class="text-danger"> *</span></label>
					<input type="text" class="form-control" name="condition" value="{{ $applicantInfo->condition }}">
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
            <div class="parent_div" id="parent_div">
                @forelse ($membersDetls as $membersDetl)
                    <div class="row membertypes" id="record{{ $loop->index }}">
                        <input type="hidden" class="form-control member_record_id" name="member_record_id[]" value="{{$membersDetl->id}}">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="member_name[]" value="{{ $membersDetl->member_name }}">
                        </div>
                        <div class="form-group col-md-3">
                            <select class="form-control" name="relation_type_id[]">
                                <option value="">- Select -</option>
                                @foreach ($relationTypes as $relationType)
                                <option value="{{ $relationType->id }}" {{ old('relation_type_id', $relationType->id) == $membersDetl->relation_type_id ? 'selected' : '' }}>{{ $relationType->dropdown_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="date" class="form-control" name="member_dob[]" autocomplete="off" value="{{ $membersDetl->member_dob }}" autocomplete="off">
                        </div>
                        <div class="form-group col-md-2">
                            <select class="form-control" name="member_gender[]">
                                <option value="">- Select -</option>
                                @foreach (config()->get('settings.gender') as $k => $v)
                                <option value="{{ $k }}" {{ old('gender', $membersDetl->member_gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($loop->index >=1)
                    <span id="remove{{ $loop->index }}" class="btn-group" style=" margin-top:-50px; float:right">
                        <span id="remove" onclick="removeMember('{{ $membersDetl->id }}','{{ $loop->index }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span>
                    </span>
                    <div id="line{{ $loop->index }}"></div>
                    @endif
                @empty
                    <div class="row membertypes" id="record">
                        <input type="hidden" class="form-control member_record_id" name="member_record_id[]">
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
                @endforelse
                <div id="adddiv"></div>
                <span class="btn bg-purple btn-sm float-right" onclick="addMoreMember(this)"> <i class="fas fa-plus fa-sm"> Add New Row</i></span><br>
            </div>
		</div>
	</div>
    @if ($checklistDtls->count() > 0)
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Self Assessment Check List</h4>
            </div>
            <div class="card-body">
                @php
                    $i = 0;
                @endphp
                @foreach ($checklistDtls as $chapter)
                    <div class="card collapsed-card">
                        <div class="card-header" data-card-widget="collapse">
                            <span>{{$chapter->checklist_ch_name}}</span>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table order-list table-bordered" id="">
                                    <thead>
                                        <tr>
                                            <td>Area</td>
                                            <td>Standard</td>
                                            <td>Rating</td>
                                            <td>Check</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $area = '';
                                        @endphp
                                        @foreach ($chapter->chapterAreas as $chapterArea)
                                        @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                            <tr>
                                                @if ($area != $chapterArea->checklist_area)
                                                <td rowspan="{{ sizeOf($chapterArea->checkListStandards) }}">{{ $chapterArea->checklist_area }}</td>
                                                @endif
                                                <td>{{ $checkListStandard->checklist_standard }}
                                                    <input type="hidden" name="checklist_id[]" class="checklist" value="{{$checkListStandard->checklist_id}}">
                                                </td>
                                            
                                            
                                                    @if (in_array( $checkListStandard->checklist_id, $checklistrec))
                                                        <td>{{ $checkListStandard->standard_code }}
                                                            <input type="hidden" name="checklist_record_id[]" value="{{ $checklistrecords[$i]->id }}">
                                                        </td>
                                                        <td>
                                                                <input type="checkbox" name="check" checked>
                                                                <input type="hidden" name="checkvalue[]" value="1" class="chk">
                                                        </td>
                                                        @else
                                                            <td>{{ $checkListStandard->standard_code }}
                                                                <input type="hidden" name="checklist_record_id[]" value="">	
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="check">
                                                                <input type="hidden" name="checkvalue[]" value="0" class="chk">
                                                            </td>
                                                    @endif
                                                @php
                                                $area = $chapterArea->checklist_area;
                                                @endphp 
                                            </tr>
                                        @endforeach  
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                            <ol>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp;<em> Family tree</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp; <em>Pictures of buildings</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp; Pictures of toilet/ bath rooms</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp;<em> Pictures of guest room </em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp; <em>Pictures of kitchen</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp;<em> Pictures of waste management</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp;<em> Pictures of dining room / living room </em>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center" >
            <button type="submit"class="btn btn-success">
                <li class="fas fa-check"></li>
                APPLY
            </button>
            <button type="reset" class="btn btn-danger">
                <li class="fas fa-times"></li>
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
        id=1;
        function addMoreMember(this_id){
            var parentdivId = $(this_id).parents("div.parent_div").attr('id');
            curRow = $('#'+parentdivId).find('div.membertypes').attr('id');
            $("#"+curRow).clone().attr('id', curRow+id).after("#id").appendTo("#adddiv").find("input[type='text'],select,input[type='date']").val("");
            $addRow ='<span id="remove'+curRow+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
            +'<span id="remove" onClick="removeForm('+id+',curRow)"' 
            +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
            +'<div id="line'+curRow+id+'"></div>';
            $('#adddiv').append($addRow);
            $('#'+curRow+id).find('input.member_record_id').val(""); 
            id++;
        }

        function removeForm(id,curRow){ 
            if (confirm('Are you sure you want to delete this form?')){
                $('#'+curRow+id).remove();
                $('#remove'+curRow+id).remove();
                $('#line'+curRow+id).remove();
            }
        }
        function removeMember(roomId,rowId){
            if (confirm('Are you sure you want to delete this form?')){
                $.ajax({
                    url:'/application/delete-data-record',
                    type:"GET",
                    data: {
                        recordId: roomId,
                        table_name: 't_member_applications',
                    },
                success: function (data) {
                    if(data =='1'){
                        $('#record'+rowId).remove();
                        $('#remove'+rowId).remove();
                        $('#line'+rowId).remove();
                    }else{
                        alert("Some thing went wrong");
                    }
                }
            });
            }
        }
        //check and umcheck script for checklist   
        $('input[type="checkbox"]').on('change', function(){
                if($(this).is(":checked")){ // checkbox checked
                currentRow = $(this).closest("tr");
                var currentVal=currentRow.find('.chk').val('1');
                }
                if($(this).is(":unchecked")){ // checkbox unchecked
                currentRow = $(this).closest("tr");
                var currentVal=currentRow.find('.chk').val('0');
                }
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
                             check_one: false,
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
	</script>
@endsection

