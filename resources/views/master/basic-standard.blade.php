@extends('layouts.manager')
@section('page-title', 'List of Basic Stanadard')
@section('content')
    <section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Basic Standards</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<i class="icon fas fa-check"></i>
						</div>
						@if ($privileges["create"] == 1)
						<a href="javascript:void(0)" class="btn btn-success mb-2 float-right" id="create_new_basic_stanadard">Add Basic Standard</a>
						@endif
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="text-center">#</th>
                                    <th>Basic Standard Code</th>
                                    <th>Basic Standard Desc</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="basic_standard_body_id">
							<input type="hidden" id="basic_standard_count" value="{{ $basicStandardCount}}" />
							@if($basicStandards)
                            @forelse($basicStandards as $basicStandard)
                                <tr id="basic_standard_id_{{ $basicStandard->id }}">
                                    <input type="hidden" id="hidden_id_{{ $basicStandard->id }}" value="{{ $loop->iteration}}" />
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $basicStandard->standard_code }}</td>
                                    <td>{{ $basicStandard->standard_desc }}</td>
                                    <td class="text-center">
										@if ($privileges["edit"] == 1)
                                        <a href="javascript:void(0)" id="edit_basic_standard" data-id="{{ $basicStandard->id }}" class="btn btn-sm btn-info">Edit</a>
										@endif
										@if ($privileges["delete"] == 1)
										<a href="javascript:void(0)" id="delete_basic_standard" data-id="{{ $basicStandard->id }}" class="btn btn-sm btn-danger delete_basic_standard">Delete</a>
										@endif
									</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-danger text-center">No basic standard to be displayed</td>
                                </tr>
                            @endforelse
							@endif
							</tbody>
						</table><br>
						<div class="float-right">
							{{ $basicStandards->links() }}
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
					<h4 class="modal-title" id="basicStandardCrudModal"></h4>
				</div>
				<div class="modal-body">
                    <form action="{{ url('master/basic-standards') }}" method="POST" id="basicStandardForm">
                        @csrf
                        <div class="modal-body" id="frm_body">
                            <input type="hidden" name="basic_standard_id" id="basic_standard_id" />
                            <div class="form-group">
                                <label for="">Basic Standard Code*</label>
                                <input type="text" id= "standard_code" name="standard_code" class="form-control required">
							</div>
							<div class="form-group">
                                <label for="">Basic Standard Desc*</label>
                                <input type="text" id= "standard_desc" name="standard_desc" class="form-control required">
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-bottom:-14px;">
                            <input type="button" id="btn-save" class="btn btn-success btn-flat margin-r-5" value="create-basic-standard"/>
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
	  var totalBasicStandardCount = parseInt($('#basic_standard_count').val());
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
		 $.ajax({
			  data: $('#basicStandardForm').serialize(),
			  url: "{{ route('basic-standards.store') }}",
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  if(data.error){
					  printErrorMsg(data.error);
				  }else{
                      var slNo = 0;
					  if(actionType == "create-basic-standard"){
						slNo = totalBasicStandardCount+1;
					  }else{
						slNo = $('#hidden_id_'+data.id).val();
                      }

					 var checklist = '<tr id="basic_standard_id_' + data.id + '"><td class="text-center">'+slNo+'</td><td>' + data.standard_code + '</td><td>' + data.standard_desc + '</td>';
                        checklist += '<td class="text-center"><a href="javascript:void(0)" id="edit_basic_standard" data-id="' + data.id + '" class="btn btn-info btn-sm"> Edit</a> ';
                        checklist += '<a href="javascript:void(0)" id="delete_basic_standard" data-id="' + data.id + '" class="btn btn-danger delete_basic_standard btn-sm"> Delete</a></td></tr>';

					  if (actionType == "create-basic-standard") {
						  $('#basic_standard_body_id').append(checklist);
					  } else {
						  $("#basic_standard_id_" + data.id).replaceWith(checklist);
					  }
						$('#basicStandardForm').trigger("reset");
						$('#error_msg_id').hide();
						$('#ajax-crud-modal').modal('hide');
						$('#btn-save').html('Save Changes');
						$('#success_msg_id').html('');
						$('#success_msg_id').show();
						$('#success_msg_id').html('basic standard code: '+data.standard_code+' has been successfully saved!');
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


    $('#create_new_basic_stanadard').click(function () {
		$('#btn-save').removeAttr("disabled");
		 $('#btn-save').val("create-basic-standard");
        $('#basicStandardForm').trigger("reset");
        $('#basicStandardCrudModal').html("Add New Basic Standard");
        $('#ajax-crud-modal').modal('show');
    });
	//edit
    $('body').on('click', '#edit_basic_standard', function () {
      var basic_standard_id = $(this).data('id');
	  $('#btn-save').removeAttr("disabled");
      $.get('/master/basic-standards/'+basic_standard_id+'/edit', function (data) {
         $('#basicStandardCrudModal').html("Edit Basic Standard");
          $('#btn-save').val("edit_basic_standard");
          $('#ajax-crud-modal').modal('show');
		  $('#basic_standard_id').val(data.id);
          $('#standard_code').val(data.standard_code);
          $('#standard_desc').val(data.standard_desc);

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
	 $('body').on('click', '.delete_basic_standard', function () {
        var basic_standard_id = $(this).data("id");

        if(confirm("Are You sure want to delete !")){
			$.ajax({
				type: "DELETE",
				url: "{{ url('master/basic-standards')}}"+'/'+basic_standard_id,
				success: function (data) {
					$("#basic_standard_id_" + basic_standard_id).remove();
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