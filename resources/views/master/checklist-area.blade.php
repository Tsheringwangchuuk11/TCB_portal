@extends('layouts.manager')
@section('page-title', 'List of Checklist Area')
@section('buttons')
@if ($privileges["create"] == 1)
<a href="javascript:void(0)" class="btn btn-success mb-2 float-right" id="create_new_checklist_area"> <i class="fas fa-plus"></i> Add Checklist Area</a>
@endif
@endsection
@section('content')
    <section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">Checklist Area List</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<i class="icon fas fa-check"></i>
						</div>
						@component('layouts.components.search')
							<div class="input-group input-group-md">
								<input class="form-control form-control-navbar" type="search" name="search_text" placeholder="Search" aria-label="Search">
							</div>
						@endcomponent
					<br><br>
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Module</th>
                                    <th>Checklist Chapter</th>
                                    <th>Checklist Area name</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="checklist_area_body_id">
							<input type="hidden" id="checklist_area_count" value="{{ $checklistAreaCount}}" />
							@if($checklistAreas)
                            @forelse($checklistAreas as $checklistArea)
                                <tr id="checklist_area_id_{{ $checklistArea->id }}">
                                    <input type="hidden" id="hidden_id_{{ $checklistArea->id }}" value="{{ $loop->iteration}}" />
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $checklistArea->checklistChapter->serviceModule->module_name}}</td>
                                    <td>{{ $checklistArea->checklistChapter->checklist_ch_name}}</td>
                                    <td>{{ $checklistArea->checklist_area }}</td>
                                    <td class="text-center">{!! $checklistArea->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                                    <td class="text-center">
										@if ($privileges["edit"] == 1)
                                        <a href="javascript:void(0)" id="edit_checklist_area" data-id="{{ $checklistArea->id }}" class="btn btn-sm btn-info" title="Edit"> <i class="fas fa-edit"></i></a>
										@endif
										@if((int)$privileges->delete == 1)
										<a href="#" class="form-confirm btn-sm btn btn-danger" title="Delete">
											<i class="fas fa-trash"></i>
											<a data-form="#frmDelete-{!! $checklistArea->id !!}" data-title="Delete {!! $checklistArea->checklist_area !!}" data-message="Are you sure you want to delete this checklist area?"></a>
										</a>
										<form action="{{ url('master/checklist-areas/' . $checklistArea->id) }}" method="POST" id="{{ 'frmDelete-'.$checklistArea->id }}">
											@csrf
											@method('DELETE')
										</form>
										@endif
									</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center">No checklist area to be displayed</td>
                                </tr>
                            @endforelse
							@endif
							</tbody>
						</table><br>
						<div class="float-right">
							{{ $checklistAreas->appends(['search_text' => Request::get('search_text')])->render() }}
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
                    <form action="{{ url('master/checklist-areas') }}" method="POST" id="checklistForm">
						@csrf						
						<div class="modal-body" id="frm_body">
							<input type="hidden" name="checklist_area_id" id="checklist_area_id" />
							<div class="form-group">
								<label for="" >Module *</label>
								<select name="service_module" class="form-control required module select2bs4" id="module">
									<option value="">---SELECT---</option>
									@foreach ($serviceModules as $serviceModule)
									<option value="{{ $serviceModule->id }}" {{ old('service_module') == $serviceModule->id ? 'selected' : '' }}>{{ $serviceModule->module_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="" >Checklist Chapter *</label>
								<select name="checklist" class="form-control checklist select2bs4" id="checklist" disabled>
									<option value="">---SELECT MODULE FIRST---</option>							
								</select>                               
							</div>							
                            <div class="form-group">
                                <label for="">Checklist Area Name*</label>
                                <input type="text" id= "checklist_area_name" name="checklist_area_name" class="form-control required">
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
                            <input type="button" id="btn-save" class="btn btn-outline-success btn-flat margin-r-5" value="create-checklist-area"/>
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
	  var totalChecklistCount = parseInt($('#checklist_area_count').val());
	   $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		 //select a module and accordingly get the chapter associated with it using ajax request
		 $('select.module').on('change', function(e){
			var selectedModule = $('option:selected', this).val();			
						
			//check if module is selected or not
			if (selectedModule.length > 0) {
				$.ajax({
					type: 'GET',
					url:"{{ url('master/checklist-areas/module') }}",
					dataType: 'JSON',
					data: { moduleId: selectedModule },
				
					beforeSend: function(){
						$('#ajax-loading-container').removeClass('hide');
					},
					complete: function() {
						$('#ajax-loading-container').addClass('hide');
					},

					success: function(data) {											
						$('select.checklist').empty().removeAttr('disabled', false);
						// $('select.checklist').append('<option value="">---SELECT ONE---</option>');
						for (i = 0; i < data.length; i++) {
							$('select.checklist').append('<option value="' + data[i].id + '" >' + data[i].checklist_ch_name + '</option>');												
						}
					}
				});				
			} else {
				$('select.checklist').empty().attr('disabled', true);
				$('select.checklist').append('<option value="">---SELECT MODULE FIRST---</option>');
			}			 			
		});


	  $('#btn-save').click(function(e){
		e.preventDefault();
		//create
		var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');
		$("#btn-save").attr("disabled", true);	
		var StartModule = $('#module option:selected').text();		
        var checklistName = $('#checklist option:selected').text();
		
		 $.ajax({
			  data: $('#checklistForm').serialize(),
			  url: "{{ route('checklist-areas.store') }}",
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  console.log(data);
				  if(data.error){
					  printErrorMsg(data.error);
				  }else{
                      var slNo = 0;
					  if(actionType == "create-checklist-area"){
						slNo = totalChecklistCount+1;
					  }else{
						slNo = $('#hidden_id_'+data.id).val();
                      }

					 var checklist = '<tr id="checklist_area_id_' + data.id + '"><td class="text-center">'+slNo+'</td><td>' + StartModule + '</td><td>' + checklistName + '</td><td>' + data.checklist_area + '</td><td class="text-center">' + (data.is_active == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>') + '</td>';
                        checklist += '<td class="text-center"><a href="javascript:void(0)" id="edit_checklist_area" data-id="' + data.id + '" class="btn btn-outline-info btn-sm" title="Edit">  <i class="fas fa-edit"></i></a> ';
                        checklist += '<a href="javascript:void(0)" id="delete_checklist_area" data-id="' + data.id + '"class ="btn btn-outline-danger delete_checklist_area btn-sm" title="Delete"><i class="fas fa-trash"></i></a></td></tr>';
						

					  if (actionType == "create-checklist-area") {
						  $('#checklist_area_body_id').append(checklist);
					  } else {
						  $("#checklist_area_id_" + data.id).replaceWith(checklist);
					  }
						$('#checklistForm').trigger("reset");
						$('#error_msg_id').hide();
						$("#module").val(null).trigger("change");
						$("#checklist").val(null).trigger("change");
						$('#ajax-crud-modal').modal('hide');
						$('#btn-save').html('Save Changes');
						$('#success_msg_id').html('');
						$('#success_msg_id').show();
						$('#success_msg_id').html('checklist name: '+data.checklist_area+' has been successfully saved!');
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


    $('#create_new_checklist_area').click(function () {
		$('#btn-save').removeAttr("disabled");
		 $('#btn-save').val("create-checklist-area");
		$('#checklistForm').trigger("reset");
		$('#module').val('').trigger('change');
		$('#checklist').val('').trigger('change');
        $('#checklistCrudModal').html("Add New Checklist Area");
        $('#ajax-crud-modal').modal('show');
    });
	//edit
    $('body').on('click', '#edit_checklist_area', function () {
	  var checklist_area_id = $(this).data('id');
	  $('#checklist').removeAttr('disabled', true);
	  $('#btn-save').removeAttr("disabled");
      $.get('/master/checklist-areas/'+checklist_area_id+'/edit', function (data) {		  
         $('#checklistCrudModal').html("Edit Checklist Area");
          $('#btn-save').val("edit_checklist_area");
          $('#ajax-crud-modal').modal('show');
		  $('#checklist_area_id').val(data.id);				
          $('#module').val(data.checklist_chapter.module_id).trigger('change');
          $('#checklist').val(data.checklist_ch_id).trigger('change');
          $('#checklist_area_name').val(data.checklist_area);
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
  });
</script>
@endsection