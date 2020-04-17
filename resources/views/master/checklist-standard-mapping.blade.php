@extends('layouts.manager')
@section('page-title', 'List of Standard Mapping')
@section('content')
    <section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Standard Mappings</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<i class="icon fas fa-check"></i>
						</div>
						<a href="javascript:void(0)" class="btn btn-success mb-2 float-right" id="create_new_standard_mapping">Add Standard Mapping</a>
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="text-center">#</th>
                                    <th>Star Category</th>
                                    <th>Checklist Standard</th>
                                    <th>Basic Standard</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="standard_mapping_body_id">
							<input type="hidden" id="standard_mapping_count" value="{{ $standardMappingCount}}" />
							@if($standardMappings)
                            @forelse($standardMappings as $standardMapping)
                                <tr id="standard_mapping_id_{{ $standardMapping->id }}">
                                    <input type="hidden" id="hidden_id_{{ $standardMapping->id }}" value="{{ $loop->iteration}}" />
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $standardMapping->starCategory->star_category_name}}</td>
                                    <td>{{ $standardMapping->checklistStandard->checklist_standard}}</td>
                                    <td>{{ $standardMapping->basicStandard->standard_code}}</td>
                                    <td class="text-center">{!! $standardMapping->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" id="edit_standard_mapping" data-id="{{ $standardMapping->id }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="javascript:void(0)" id="delete_standard_mapping" data-id="{{ $standardMapping->id }}" class="btn btn-sm btn-danger delete_standard_mapping">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center">No checklist standard mapping to be displayed</td>
                                </tr>
                            @endforelse
							@endif
							</tbody>
						</table><br>
						<div class="float-right">
							{{ $standardMappings->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="alert alert-danger" id="error_msg_id" style="display:none" >
					<ul></ul>
				</div>
				<div class="modal-header">
					<h4 class="modal-title" id="standardMappingCrudModal"></h4>
				</div>
				<div class="modal-body">
                    <form action="{{ url('master/checklist-standard-mappings') }}" method="POST" id="standardMappingForm">
                        @csrf
                        <div class="modal-body" id="frm_body">
                            <input type="hidden" name="standard_mapping_id" id="standard_mapping_id" />
                            <div class="form-group">
                                <label for="" >Star Category *</label>
                                <select name="star_category" class="form-control required select2" id="starCategory">
                                    <option value="">---SELECT---</option>
                                    @foreach ($starCategories as $starCategory)
                                    <option value="{{ $starCategory->id }}" {{ old('star_category') == $starCategory->id ? 'selected' : '' }}>{{ $starCategory->star_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" >Checklist Standard *</label>
                                <select name="checklist_standard" class="form-control required select2" id="checklistStandard">
                                    <option value="">---SELECT---</option>
                                    @foreach ($checklistStandards as $checklistStandard)
                                    <option value="{{ $checklistStandard->id }}" {{ old('checklist_standard') == $checklistStandard->id ? 'selected' : '' }}>{{ $checklistStandard->checklist_standard }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" >Basic Standard *</label>
                                <select name="basic_standard" class="form-control required select2" id="basicStandard">
                                    <option value="">---SELECT---</option>
                                    @foreach ($basicStandards as $basicStandard)
                                    <option value="{{ $basicStandard->id }}" {{ old('basic_standard') == $basicStandard->id ? 'selected' : '' }}>{{ $basicStandard->standard_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label><br>
                                <label>
                                    <input type="radio" id="status1" name="status" value="yes" class="flat-red" {{ old('status') == null || old('status') == 'yes' ? 'checked' : '' }}/>
                                    Yes
                                </label>
                                <label>
                                    <input type="radio" id="status2" name="status" value="no" class="flat-red" {{ old('status') == 'no' ? 'checked' : '' }} />
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-bottom:-14px;">
                            <input type="button" id="btn-save" class="btn btn-success btn-flat margin-r-5" value="create-standard-mapping"/>
                            <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function () {
	  var totalStandardMappingCount = parseInt($('#standard_mapping_count').val());
	   $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	  $('#btn-save').click(function(e){
		e.preventDefault();
		//create
		var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');
		$("#btn-save").attr("disabled", true);
        var starCategory = $('#starCategory option:selected').text();
        var checklistStandard = $('#checklistStandard option:selected').text();
        var basicStandard = $('#basicStandard option:selected').text();
		 $.ajax({
			  data: $('#standardMappingForm').serialize(),
			  url: "{{ route('checklist-standard-mappings.store') }}",
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  if(data.error){
					  printErrorMsg(data.error);
				  }else{
                      var slNo = 0;
					  if(actionType == "create-standard-mapping"){
						slNo = totalStandardMappingCount+1;
					  }else{
						slNo = $('#hidden_id_'+data.id).val();
                      }

					 var checklist = '<tr id="standard_mapping_id_' + data.id + '"><td class="text-center">'+slNo+'</td><td>' + starCategory + '</td><td>' + checklistStandard + '</td><td>' + basicStandard + '</td><td class="text-center">' + (data.is_active == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>') + '</td>';
                        checklist += '<td class="text-center"><a href="javascript:void(0)" id="edit_standard_mapping" data-id="' + data.id + '" class="btn btn-info btn-sm"> Edit</a> ';
                        checklist += '<a href="javascript:void(0)" id="delete_standard_mapping" data-id="' + data.id + '" class="btn btn-danger delete_standard_mapping btn-sm"> Delete</a></td></tr>';

					  if (actionType == "create-standard-mapping") {
						  $('#standard_mapping_body_id').append(checklist);
					  } else {
						  $("#standard_mapping_id_" + data.id).replaceWith(checklist);
					  }
						$('#standardMappingForm').trigger("reset");
						$('#error_msg_id').hide();
						$('#ajax-crud-modal').modal('hide');
						$('#btn-save').html('Save Changes');
						$('#success_msg_id').html('');
						$('#success_msg_id').show();
						$('#success_msg_id').html('standard mapping: '+ starCategory +' has been successfully saved!');
						$("#success_msg_id").fadeTo(2000, 500).slideUp(500, function(){
							$("#success_msg_id").slideUp(500);
						});
				  }

			  },
			  error: function (data) {
				  console.log('Error:', data);
				  $('#btn-save').html('Save Changes');
			  }
		  });
	  });


    $('#create_new_standard_mapping').click(function () {
		$('#btn-save').removeAttr("disabled");
		 $('#btn-save').val("create-standard-mapping");
        $('#standardMappingForm').trigger("reset");
        $('#standardMappingCrudModal').html("Add New Stanadrd Mapping");
        $('#ajax-crud-modal').modal('show');
    });
	//edit
    $('body').on('click', '#edit_standard_mapping', function () {
      var standard_mapping_id = $(this).data('id');
	  $('#btn-save').removeAttr("disabled");
      $.get('/master/checklist-standard-mappings/'+standard_mapping_id+'/edit', function (data) {
         $('#standardMappingCrudModal').html("Edit Standard Mapping");
          $('#btn-save').val("edit_standard_mapping");
          $('#ajax-crud-modal').modal('show');
		  $('#standard_mapping_id').val(data.id);
          $('#starCategory').val(data.star_category_id);
          $('#checklistStandard').val(data.checklist_id);
          $('#basicStandard').val(data.standard_id);
		  (data.is_active == 0? $('#status2').prop("checked", true):$('#status1').prop("checked", true));

      })
   });
	function printErrorMsg(msg){
		$('#error_msg_id').find('ul').html('');
		$('#error_msg_id').show();
		$.each( msg, function( key, value ) {
			$("#error_msg_id").find("ul").append('<li>'+value+'</li>');
		});
		$('#btn-save').html('Save Changes');
	}
	//delete
	 $('body').on('click', '.delete_standard_mapping', function () {
        var standard_mapping_id = $(this).data("id");

        if(confirm("Are You sure want to delete !")){
			$.ajax({
				type: "DELETE",
				url: "{{ url('master/checklist-standard-mappings')}}"+'/'+standard_mapping_id,
				success: function (data) {
					$("#standard_mapping_id_" + standard_mapping_id).remove();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		}
    });
  });
</script>
@endsection