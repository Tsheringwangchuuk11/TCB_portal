@extends('public_view.main')
@section('page-title','New : Tourist Standard Restuarant Assessment')
@section('content')
<div class="card">
	<div class="card-header bg-success">
		<h3 class="card-title">Registration of Tourist Standard Restuarant</h3>
	</div>
	<form action="{{ url('') }}" method="POST" enctype="multipart/form-data">
		@csrf
		@foreach ($idInfos as $idInfo)
		<input type="hidden" name="module_name" value="{{ $idInfo->module_name }}">
		<input type="hidden" name="service_name" value="{{ $idInfo->service_name }}">
		@endforeach
		<div class="card-body">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">License Number <span class="text-danger">*</span> </label>
						<input type="number" class="form-control" name="license_number" id="" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
						<label for="">License Date <span class="text-danger">*</span> </label>
						<input type="date" class="form-control" name="license_date" id="" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">Name <span class="text-danger">*</span> </label>
						<input type="text" class="form-control" name="name" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
						<label for="">Owner <span class="text-danger">*</span> </label>
						<input type="text" class="form-control" name="accomodation" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">Address <span class="text-danger">*</span> </label>
						<input type="text" class="form-control" name="address" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
						<label for="">Contact No <span class="text-danger">*</span> </label>
						<input type="number" class="form-control" name="phone_number" id="" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">Fax <span class="text-danger">*</span> </label>
						<input type="text" class="form-control" name="fax" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
						<label for="">Email <span class="text-danger">*</span> </label>
						<input type="email" class="form-control" name="email" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">Internet Homepage <span class="text-danger">*</span> </label>
						<input type="text" class="form-control" name="internet" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
						<label for="">Number of Beds <span class="text-danger">*</span> </label>
						<input type="number" class="form-control" name="bed_no" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">Location <span class="text-danger">*</span> </label>
						<select class="form-control select2bs4" required>
							<option selected="selected">-Select-</option>
							
						</select>
					</div>
				</div>
			</div>

			<!-- staff -->
			<h5>Staff Details</h5>
			<div class="row">
				<div class="form-group col-md-3">
					<label>Area <span class="text-danger">*</span></label>
				</div>
				<div class="form-group col-md-3">
					<label>Division <span class="text-danger">*</span></label>
				</div>
				<div class="form-group col-md-3">
					<label for="">Name <span class="text-danger">*</span> </label>
				</div>
				<div class="form-group col-md-3">
					<label>Gender <span class="text-danger">*</span></label>
				</div>
			</div>
			<div class="row" id="row1">
				<div class="col-md-3">
					<div class="form-group">
						<select class="form-control" required>
							<option selected="selected">-select-</option>
							<option>Lodging</option>
							<option>Food & Beverage</option>
							<option>Recreation,Other</option>
							<option>Administration</option>
							<option>Sales & Marketing</option>
							<option>Pomec (Property Operation & Maintance)</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select class="form-control" required>
							<option selected="selected">-select-</option>
							<option>Reception</option>
							<option>Reservation</option>
							<option>Front-Office</option>
							<option>Housekeeping</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control" name="name" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select class="form-control" required>
							<option selected="selected">-select-</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</div>
				</div>
			</div>
			<div id="field_wrapper1"></div>
			<span class="btn btn-success btn-sm float-right" id="add1"> <i class="fas fa-plus fa-sm"> Add</i> </span>

			<div class="row">
				<div class="col-md-12">
					<p><span>Please attach additional sheets where necessary like pictures of the office.</span></p>
					<div class="mb-3 mt-2">
						<div class="form-group">
							<span class="btn btn-success fileinput-button btn-sm">
								<i class="fas fa-plus fa-sm"></i>
								<span>Add files...</span>
								<!-- The file input field used as target for the file upload widget -->
								<input id="fileuploaded" type="file" name="filename"> 
							</span>
							<div id="progress" class="progress">
								<div class="progress-bar bg-success"></div>
							</div>
							<div id="files" class="files"></div>
						</div>
					</div>
				</div>
			</div>

			<h5>Inspector’s Checklist</h5>
			<!-- General/Exterior/Location/Building/Rooms -->
			<div class="card">
				@foreach($checklistchapter as $list)
				<div class="card-header">
					<span>{{ $list->checklist_ch_name }}</span>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table" id="dataTable">
								<tbody>
									<tr>        
										<th>Area</th>
										<th>Criteria</th>
										<th>Checklist</th>
									</tr>
									<?php $area = App\Http\Controllers\Services\ServiceController::getCheckListArea($list->checklist_ch_id);?>
									@if($area)
									@foreach($area as $areas)
										<?php $standard = App\Http\Controllers\Services\ServiceController::getCheckListStandard($areas->checklist_area_id);?>
										@if($standard)
										@php ($i=1)
											@foreach($standard as $standards)
											<tr>
												@if($i==1)             
												<td rowspan="{{ $areas->total1 }}">{{ $areas->checklist_name }}</td>
												@endif
												<td>{{ $standards->checklist_standard }}</td> 
												<td><input type="checkbox"> <span class="text-danger">*</span></td>
												@php ($i++)
											</tr>
											@endforeach <!-- checklist standard forloop ends -->
										@endif <!-- checklist standard if ends -->
									@endforeach <!-- checklist area forloop ends -->
									@endif <!-- checklist area if ends -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
				@endforeach
				<!-- /.card-body -->
			</div>

			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="">Inspectors Name <span class="text-danger">*</span> </label>
						<input type="text" class="form-control" name="inspector_name" id="" autocomplete="off" required>
					</div>
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
						<label for="">Inspection Date <span class="text-danger">*</span> </label>
						<input type="date" class="form-control" name="inspector_date" id="" autocomplete="off" required>
					</div>
				</div>
			</div>

		</div> <!-- card body ends -->
		<div class="card-footer text-center">
			<button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
			<button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
		</div>    
	</form>
</div>
@endsection
@section('page_scripts')
<!-- room type -->
<script>
	$(document).ready(function(){
		id=1;
		$("#add").click(function(){
			$("#row").clone().attr('id', 'row'+id).after("#id").appendTo("#field_wrapper");
			$addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
			+'<span id="remove" onClick="removeForm('+id+')"' 
			+'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
			+'<div id="line'+id+'"></div>';
			$('#field_wrapper').append($addRow);
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
</script>
<!-- staff -->
<script>
	$(document).ready(function(){
		id=1;
		$("#add1").click(function(){
			$("#row1").clone().attr('id', 'row1'+id).after("#id").appendTo("#field_wrapper1");
			$addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
			+'<span id="remove" onClick="removeForm1('+id+')"' 
			+'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
			+'<div id="line'+id+'"></div>';
			$('#field_wrapper1').append($addRow);
			id++;
		});
	});

	function removeForm1(id){  
		if (confirm('Are you sure you want to delete this form?')){
			$('#row1'+id).remove();
			$('#remove'+id).remove();
			$('#line'+id).remove();
		}
	}
</script>

<!-- fileupload -->
<script>
	var count=0, deleteId;
	$(function () {
		'use strict';
		$('#fileuploaded').fileupload({
			add: function(e, data) {
				data.submit();
			},
			url: "{{ url('documentattach') }}",
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			autoUpload: true,
			dataType : 'json',
			success: function (data) {
				jQuery.each(data.data, function(index, row) {
					$('#files').append('<div class="image_wrap">'
						+'<input type="hidden" name="files['+row.document_id+']" value="'+row.document_id+'"/><strong>'+row.document_name+'</strong>'
						+' <span onClick="deletefile(this.id,\'' + row.document_id + '\',\'' + row.upload_url + '\')" id="deleteId'+count+'" class="delete-line btn btn-danger btn-sm" data-file_id="'+row.document_id+'">'
						+'<i class="fas fa-trash-alt"></i> Delete</span></div><br />');	
					count++;					    
				});
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress .progress-bar').css(
					'width',
					progress + '%'
					);
			}
		});
	});

	function deletefile(id,fileId,url){			
		if (confirm('Are you sure you want to delete this file?')){
			var id = id;
			var fileId = fileId;
			var url = url;
			$.ajax({
				url  : "{{ url('deletefile') }}",
				type : "POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data : {id : fileId, url : url },					   
				success: function(data) {
					if (data == "success")
						{ $('#'+id).parent('div').remove(); }
					else
						{ alert('Something went wrong when deleteing the file, please try again'); }						
				}
			});
		}
	}
</script>
@endsection
