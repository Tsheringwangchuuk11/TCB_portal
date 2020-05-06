@extends('layouts.manager')
@section('page-title', 'List of Checklist Chapter')
@section('content')
    <section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">Checklist Chapter List</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<i class="icon fas fa-check"></i>
						</div>
						@if ($privileges["create"] == 1)
						<a href="javascript:void(0)" class="btn btn-success mb-2 float-right" id="create_new_checklist">Add Checklist Chapter</a>
						@endif
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="text-center">#</th>
                                    <th>Module</th>
                                    <th>Chapter Name</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="checklist_body_id">
							<input type="hidden" id="checklist_count" value="{{ $checklistChapterCount}}" />
							@if($checklistChapters)
                            @forelse($checklistChapters as $checklistChapter)
                                <tr id="checklist_id_{{ $checklistChapter->id }}">
                                    <input type="hidden" id="hidden_id_{{ $checklistChapter->id }}" value="{{ $loop->iteration}}" />
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $checklistChapter->serviceModule->module_name}}</td>
                                    <td>{{ $checklistChapter->checklist_ch_name }}</td>
                                    <td class="text-center">{!! $checklistChapter->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                                    <td class="text-center">
										@if ($privileges["edit"] == 1)
                                        <a href="javascript:void(0)" id="edit_checklist" data-id="{{ $checklistChapter->id }}" class="btn btn-sm btn-outline-info"> <i class="fas fa-edit"></i>Edit</a>
										@endif
										@if((int)$privileges->delete == 1)
										<a href="#" class="form-confirm  btn btn-sm btn-outline-danger" title="Delete">
											<i class="fas fa-trash"></i> Delete
											<a data-form="#frmDelete-{!! $checklistChapter->id !!}" data-title="Delete {!! $checklistChapter->checklist_ch_name !!}" data-message="Are you sure you want to delete this checklist chapter?"></a>
										</a>
										<form action="{{ url('master/checklist-chapters/' . $checklistChapter->id) }}" method="POST" id="{{ 'frmDelete-'.$checklistChapter->id }}">
											@csrf
											@method('DELETE')
										</form>
										@endif
									</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">No checklist chapter to be displayed</td>
                                </tr>
                            @endforelse
							@endif
							</tbody>
						</table><br>
						<div class="float-right">
							{{ $checklistChapters->links() }}
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
					<h4 class="modal-title" id="checklistCrudModal"></h4>
				</div>
				<div class="modal-body">
                    <form action="{{ url('master/checklist-chapters') }}" method="POST" id="checklistForm">
                        @csrf
                        <div class="modal-body" id="frm_body">
                            <input type="hidden" name="checklist_id" id="checklist_id" />
                            <div class="form-group">
                                <label for="" >Module *</label>
                                <select name="service_module" class="form-control module required select2bs4" id="module">
                                    <option value="">---SELECT---</option>
                                    @foreach ($serviceModules as $serviceModule)
                                    <option value="{{ $serviceModule->id }}" {{ old('service_module') == $serviceModule->id ? 'selected' : '' }}>{{ $serviceModule->module_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Chapter Name*</label>
                                <input type="text" id= "checklist_name" name="checklist_name" class="form-control required">
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
                            <input type="button" id="btn-save" class="btn btn-outline-success btn-flat margin-r-5" value="create-checklist"/>
                            <button type="button" class="btn btn-flat btn-close btn-outline-danger float-left" data-dismiss="modal">Close</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
	@include('layouts.include.confirm-delete')
@endsection
@section('scripts')
<script>
  $(document).ready(function () {
	  var totalChecklistCount = parseInt($('#checklist_count').val());
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
        var moduleName = $('#module option:selected').text();
		 $.ajax({
			  data: $('#checklistForm').serialize(),
			  url: "{{ route('checklist-chapters.store') }}",
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  if(data.error){
					  printErrorMsg(data.error);
				  }else{
                      var slNo = 0;
					  if(actionType == "create-checklist"){
						
						slNo = totalChecklistCount+1;
					  }else{
						slNo = $('#hidden_id_'+data.id).val();
                      }

					 var checklist = '<tr id="checklist_id_' + data.id + '"><td class="text-center">'+slNo+'</td><td>' + moduleName + '</td><td>' + data.checklist_ch_name + '</td><td class="text-center">' + (data.is_active == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>') + '</td>';
                        checklist += '<td class="text-center"><a href="javascript:void(0)" id="edit_checklist" data-id="' + data.id + '" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Edit</a> ';
                        checklist += '<a href="javascript:void(0)" id="delete_checklist" data-id="' + data.id + '" class="btn btn-outline-danger delete_checklist btn-sm"><i class="fas fa-trash"></i> Delete</a></td></tr>';

					  if (actionType == "create-checklist") {
						  $('#checklist_body_id').append(checklist);
					  } else {
						  $("#checklist_id_" + data.id).replaceWith(checklist);
					  }
						$('#checklistForm').trigger("reset");
						$("#module").val(null).trigger("change");
						$('#error_msg_id').hide();
						$('#ajax-crud-modal').modal('hide');
						$('#btn-save').html('Save Changes');
						
						$('#success_msg_id').html('');
						$('#success_msg_id').show();
						$('#success_msg_id').html('checklist name: '+data.checklist_ch_name+' has been successfully saved!');
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


    $('#create_new_checklist').click(function () {
		$('#btn-save').removeAttr("disabled");
		 $('#btn-save').val("create-checklist");
        $('#checklistForm').trigger("reset");
        $('#checklistCrudModal').html("Add New Checklist");
        $('#ajax-crud-modal').modal('show');
    });
	//edit
    $('body').on('click', '#edit_checklist', function () {
      var checklist_id = $(this).data('id');
	  $('#btn-save').removeAttr("disabled");
      $.get('/master/checklist-chapters/'+checklist_id+'/edit', function (data) {
         $('#checklistCrudModal').html("Edit Checklist");
          $('#btn-save').val("edit_checklist");
          $('#ajax-crud-modal').modal('show');
		  $('#checklist_id').val(data.id);
          $('#module').val(data.module_id);
          $('#checklist_name').val(data.checklist_ch_name);
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
	// //delete
	//  $('body').on('click', '.delete_checklist', function () {
    //     var checklist_id = $(this).data("id");

    //     if(confirm("Are You sure want to delete !")){
	// 		$.ajax({
	// 			type: "DELETE",
	// 			url: "{{ url('master/checklist-chapters')}}"+'/'+checklist_id,
	// 			success: function (data) {
	// 				$("#checklist_id_" + checklist_id).remove();
	// 			},
	// 			error: function (data) {
	// 				console.log('Error:', data);
	// 			}
	// 		});
	// 	}
    // });
  });
</script>
@endsection
