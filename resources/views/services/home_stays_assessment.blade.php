@extends('layouts.manager')
@section('page-title','Village Home Stay Assessment')
@section('content')
<form action="{{ url('application/save-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="formdata">
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
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Name<span class="text-danger"> *</span></label>
					<input type="text" class="form-control required" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group ">
					<label for="">CID No.<span class="text-danger"> *</span></label>
					<input type="text" class="form-control numeric-only required" name="cid_no"  value="{{ old('cid_no') }}" autocomplete="off">
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Contact No.<span class="text-danger"> *</span> </label>
					<input type="text" class="form-control numeric-only required" name="contact_no" value="{{ old('contact_no') }}" autocomplete="off">
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control email required" name="email" value="{{ old('email') }}" autocomplete="off">
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Dzongkhag<span class="text-danger"> *</span></label>
					<select class="form-control select2bs4 required" name="dzongkhag_id" id="dzongkhag_id" style="width: 100%;">
						<option value=""> -Select-</option>
						@foreach ($dzongkhagLists as $dzongkhagList)
						<option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
						@endforeach
					</select>
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Gewog<span class="text-danger"> *</span></label>
						<select  name="gewog_id" class="form-control select2bs4" id="gewog_id" style="width: 100%;">
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
					<input type="text" class="form-control required" name="village_id" required>
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Thram No.<span class="text-danger"> *</span> </label>
					<input type="text" class="form-control required" name="thram_no" value="{{ old('thram_no') }}"  required>
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">House No.<span class="text-danger"> *</span></label>
					<input type="text" class="form-control required" name="house_no" value="{{ old('house_no') }}"  required>
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
					<input type="text" class="form-control required" name="town_distance" autocomplete="off" required>
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Distance from the main road (hrs or kms)<span class="text-danger"> *</span></label>
					<input type="text" class="form-control required" name="road_distance" autocomplete="off" required>
				  </div>
				</div>
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Condition of the pathway to house from the road point<span class="text-danger"> *</span></label>
					<input type="text" class="form-control required" name="condition" autocomplete="off" required>
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
						<select class="form-control required" name="relation_type_id[]" id="hotel_div_id">
							<option value="">- Select -</option>
							@foreach ($relationTypes as $relationType)
							<option value="{{ $relationType->id }}"> {{ $relationType->relation_type }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-3">
						<input type="text" class="form-control required" name="member_age[]" autocomplete="off" id="staff_name">
					</div>
					<div class="form-group col-md-2">
						<select class="form-control required" name="member_gender[]" id="staff_gender">
							<option value="">- Select -</option>
							@foreach (config()->get('settings.gender') as $k => $v)
							<option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div id="adddiv"></div>
			<span class="btn btn-success btn-sm float-right" id="add"> <i class="fas fa-plus fa-sm">Add</i> </span>
		</div>
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
				<em>Pictures of buildings</em>
			  </li>
			  <li>
				<em>No objection letter from the head of the family </em>
			  </li>
			  <li>
				<em>Authentication letter from the gewog</em>
			  </li>
			  <li>
				<em>Recommendation letter from the dzongkhag and the letter of undertaking</em>
			  </li>
			</ol>
			@include('services/fileupload/fileupload')
		</div>
		<div class="card-footer text-center" >
			<button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
			<button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
		  </div>
	</div>
</form>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){ 
      id=1;
      $("#add").click(function(){
        $("#row").clone().attr('id', 'row'+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
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
    var url="{{ url('application/get-homestaychapters') }}";
		var options = {target:'#showdivid',
        url:url,
        type:'POST',
        data: $("#formdata").serialize()};
        $("#formdata").ajaxSubmit(options);
  }
window.onload=loadChecklistDetails();
});
</script>
@endsection