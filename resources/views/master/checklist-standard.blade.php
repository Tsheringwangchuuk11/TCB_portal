@extends('layouts.manager')
@section('page-title', 'List of Checklist Stanadard')
@section('content')
    <section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Checklist Standards</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<i class="icon fas fa-check"></i>
						</div>
						@if ($privileges["create"] == 1)
						<a href="javascript:void(0)" class="btn btn-success mb-2 float-right" id="create_new_checklist_standard">Add Checklist Standard</a>
						@endif
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="text-center">#</th>
                                    <th>Checklist Area</th>
                                    <th>Checklist Standard Name</th>
                                    <th>Checklist Points</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="checklist_standard_body_id">
							<input type="hidden" id="checklist_standard_count" value="{{ $checklistStandardCount}}" />
							@if($checklistStandards)
                            @forelse($checklistStandards as $checklistStandard)
                                <tr id="checklist_standard_id_{{ $checklistStandard->id }}">
                                    <input type="hidden" id="hidden_id_{{ $checklistStandard->id }}" value="{{ $loop->iteration}}" />
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $checklistStandard->checklistArea->checklist_area}}</td>
                                    <td>{{ $checklistStandard->checklist_standard }}</td>
                                    <td>{{ $checklistStandard->checklist_pts }}</td>
                                    <td class="text-center">{!! $checklistStandard->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                                    <td class="text-center">
										@if ($privileges["edit"] == 1)
                                        <a href="javascript:void(0)" id="edit_checklist_standard" data-id="{{ $checklistStandard->id }}" class="btn btn-sm btn-info">Edit</a>
										@endif
										@if ($privileges["delete"] == 1)
										<a href="javascript:void(0)" id="delete_checklist_standard" data-id="{{ $checklistStandard->id }}" class="btn btn-sm btn-danger delete_checklist_standard">Delete</a>
										@endif
									</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center">No checklist standard to be displayed</td>
                                </tr>
                            @endforelse
							@endif
							</tbody>
						</table><br>
						<div class="float-right">
							{{ $checklistStandards->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="alert alert-danger" id="error_msg_id" style="display:none" >
					<ul></ul>
				</div>
				<div class="modal-header">
					<h4 class="modal-title" id="checklistStandardCrudModal"></h4>
				</div>
				<div class="modal-body">
					<form action="{{ url('master/checklist-standards') }}" method="POST" id="checklistStandardForm">
						@csrf
						<div class="modal-body" id="frm_body">
							<input type="hidden" name="checklist_standard_id" id="checklist_standard_id" />
								<div class="form-group">
									<label for="" >Checklist Area *</label>
									<select name="checklist_area" class="form-control required select2bs4" id="checklistArea">
										<option value="">---SELECT---</option>
										@foreach ($checklistAreas as $checklistArea)
										<option value="{{ $checklistArea->id }}" {{ old('checklist_area') == $checklistArea->id ? 'selected' : '' }}>{{ $checklistArea->checklist_area }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="">Checklist Standard Name*</label>
									<input type="text" id= "checklist_standard_name" name="checklist_standard_name" class="form-control required">
								</div>
								<div class="form-group">
									<label for="">Checklist Point</label>
									<input type="text" id= "checklist_point" name="checklist_point" class="form-control numeric-only">
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
								<div class="box-body no-padding">
									<strong class="font-weight-bold">Standard Mapping</strong>
									<table id="sub-module" class="table table-condensed table-striped">
										<thead>
											<th class="text-center">#</th>
											<th>Star Category *</th>
											<th>Basic Standard *</th>
											<th>Mandatory</th>
											<th>Status</th>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">
													<a href="#" class="delete-table-row btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
												</td>
												<td>
													<select name="checklist[AAAAA][star_category]" id="star" class="form-control resetKeyForNew required select star">
														<option value="">Select Star Category</option>
														@foreach ($starCategories as $starCategory)
															<option value="{{ $starCategory->id }}" data-id={{ $starCategory->id }} data-name="{{ $starCategory->star_category_name }}">{{ $starCategory->star_category_name }}</option>
														@endforeach
													</select>
												</td>
												<td>
													<select name="checklist[AAAAA][basic_standard]" class="form-control resetKeyForNew select required">
														<option value="">Select Basic Standard</option>
														@foreach ($basicStandards as $basicStandard)
															<option value="{{ $basicStandard->id }}" data-id={{ $basicStandard->id }} data-name="{{ $basicStandard->standard_code }}">{{ $basicStandard->standard_code }}</option>
														@endforeach
													</select>
												</td>
												<td class="text-center">
													<label>
														<input type="checkbox" name="checklist[AAAAA][mandatory]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1"/>
														<input type="hidden" name="checklist[AAAAA][mandatory]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="0"/>
														<span class="lbl"></span>
													</label>
												</td>
												<td width="20%">
													<select  name="checklist[AAAAA][status]" class="form-control resetKeyForNew select">
														<option value="">-Select-</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													  </select>
												</td>
											</tr>
											<tr class="notremovefornew">
												<td colspan="4"></td>
												<td class="text-center">
													<a href="#" class="add-table-row btn bg-purple btn-sm"><i class="fa fa-plus"></i> Add New Row</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="button" id="btn-save" class="btn btn-success btn-flat margin-r-5" value="create-checklist-standard"/>
							<button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
{{-- <script type="text/javascript" src="{{ asset('js/checklist.js') }}"></script> --}}
<script>
  $(document).ready(function () {
	  var totalChecklistStandardCount = parseInt($('#checklist_standard_count').val());
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
        var checklistArea = $('#checklistArea option:selected').text();
        // var checklistArea = $('#checklistArea option:selected').text();
		 $.ajax({
			  data: $('#checklistStandardForm').serialize(),
			  url: "{{ route('checklist-standards.store') }}",
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  if(data.error){
					  printErrorMsg(data.error);
				  }else{
                      var slNo = 0;
					  if(actionType == "create-checklist-standard"){
						slNo = totalChecklistStandardCount+1;
					  }else{
						slNo = $('#hidden_id_'+data.id).val();
                      }

					 var checklist = '<tr id="checklist_standard_id_' + data.id + '"><td class="text-center">'+slNo+'</td><td>' + checklistArea + '</td><td>' + data.checklist_standard + '</td><td>' + data.checklist_pts + '</td><td class="text-center">' + (data.is_active == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>') + '</td>';
                        checklist += '<td class="text-center"><a href="javascript:void(0)" id="edit_checklist_standard" data-id="' + data.id + '" class="btn btn-info btn-sm"> Edit</a> ';
                        checklist += '<a href="javascript:void(0)" id="delete_checklist_standard" data-id="' + data.id + '" class="btn btn-danger delete_checklist_standard btn-sm"> Delete</a></td></tr>';

					  if (actionType == "create-checklist-standard") {
						  $('#checklist_standard_body_id').append(checklist);
					  } else {
						  $("#checklist_standard_id_" + data.id).replaceWith(checklist);
					  }
						$('#checklistStandardForm').trigger("reset");
						$('#error_msg_id').hide();
						// $('#star option:selected').empty();
						$('#ajax-crud-modal').modal('hide');
						$('#btn-save').html('Save Changes');
						$('#success_msg_id').html('');
						$('#success_msg_id').show();
						$('#success_msg_id').html('checklist Standard Name: '+data.checklist_standard+' has been successfully saved!');
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


    $('#create_new_checklist_standard').click(function () {
		$('#btn-save').removeAttr("disabled");
		 $('#btn-save').val("create-checklist-standard");
		$('#checklistStandardForm').trigger("reset");
		starTypeIdArray.pop();
        $('#checklistStandardCrudModal').html("Add New Checklist Standard");
        $('#ajax-crud-modal').modal('show');
    });
	//edit
    $('body').on('click', '#edit_checklist_standard', function () {
      var checklist_standard_id = $(this).data('id');
	  $('#btn-save').removeAttr("disabled");
      $.get('/master/checklist-standards/'+checklist_standard_id+'/edit', function (data) {
         $('#checklistStandardCrudModal').html("Edit Checklist Standard");
          $('#btn-save').val("edit_checklist_standard");
          $('#ajax-crud-modal').modal('show');
		  $('#checklist_standard_id').val(data.id);
          $('#checklistArea').val(data.checklist_area_id);
          $('#checklist_standard_name').val(data.checklist_standard);
          $('#checklist_point').val(data.checklist_pts);
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
	 $('body').on('click', '.delete_checklist_standard', function () {
        var checklist_standard_id = $(this).data("id");

        if(confirm("Are You sure want to delete !")){
			$.ajax({
				type: "DELETE",
				url: "{{ url('master/checklist-standards')}}"+'/'+checklist_standard_id,
				success: function (data) {
					$("#checklist_standard_id_" + checklist_standard_id).remove();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		}
	});

	var checklist;
    var currentRow;
    var starTypeIdArray = new Array(); //stores the star type id as an array
    $(document).on('change', 'select.star', function(e) {
        currentRow = $(this).closest('tr');
        checklist = $('option:selected', this).val();

        if (checklist != '') {
            if(jQuery.inArray(checklist, starTypeIdArray ) < 0) {   // checks whether the array has the particular selected star array in it
                starTypeIdArray.push(checklist);
            } else {
                $('#alertMessage').find('p.alert-message').html("The selected data is already in the list. Select other");
                $('#alertMessage').modal('show');
				currentRow.closest('tr').find('select.star').val("");
                return false;
            }
		}
		// starTypeIdArray.pop();
    });
  });
</script>
@endsection