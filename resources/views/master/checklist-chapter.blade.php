@extends('layouts.manager')
@section('page-title', 'List of Checklist Chapter')
@section('buttons')
@if ($privileges["create"] == 1)
<a href="javascript:void(0)" class="btn btn-success mb-2" id="create_new_checklist"><i class="fas fa-plus"></i> Add Checklist Chapter</a>
@endif
@endsection
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
						{{--@component('layouts.components.search')
							<div class="input-group input-group-md">
							  <input class="form-control form-control-navbar" type="search" name="search_text" placeholder="Search" aria-label="Search">
							</div>
						  @endcomponent--}}
                        <div class="form-inline ml-3 float-right">
                            <input class="form-control" type="search" name="search" placeholder="Search" id="searchId" aria-label="Search">
                        </div>
						  <br><br>
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer"># <span id="id_icon"></span></th>
                                    <th>Module</th>
                                    <th class="sorting" data-sorting_type="asc" data-column_name="checklist_ch_name" style="cursor: pointer">Chapter Name <span id="chapter_name_icon"></span></th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="checklist_body_id">
							<input type="hidden" id="checklist_count" value="{{ $checklistChapterCount}}" />
                            @include('master.includes.checklist_chapter_data')
                        </tbody>
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    <br>
                   {{-- <div class="float-right">
                        {{ $checklistChapters->appends(['search_text' => Request::get('search_text')])->render() }}
                    </div>--}}
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
                            <select name="service_module" class="form-control module select2bs4  required" id="module">
                                <option>---SELECT---</option>
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
                        <input type="button" id="btn-save" class="btn btn-outline-success btn-flat margin-r-5" value="reate-checklist"/>
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
                        checklist += '<td class="text-center"><a href="javascript:void(0)" id="edit_checklist" data-id="' + data.id + '" class="btn btn-outline-info btn-sm" title="Edit"><i class="fas fa-edit"></i></a> ';
                        checklist += '<a href="javascript:void(0)" id="delete_checklist" data-id="' + data.id + '" class="btn btn-outline-danger delete_checklist btn-sm" title="Delete"><i class="fas fa-trash"></i></a></td></tr>';

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
        $('#module').trigger('change');
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
		  $('#module').val(data.module_id).trigger('change');
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
      function clear_icon()
      {
          $('#id_icon').html('');
          $('#chapter_name_icon').html('');
      }
      function fetch_data(page, sort_type, sort_by, query)
      {
          $.ajax({
              url:"/master/checklist-chapters?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&search_text="+query,
              success:function(data)
              {
                  $('tbody').html('');
                  $('tbody').html(data);
              }
          })
      }
      $(document).on('keyup', '#searchId', function(){
          var query = $('#searchId').val();
          var column_name = $('#hidden_column_name').val();
          var sort_type = $('#hidden_sort_type').val();
          var page = $('#hidden_page').val();
          fetch_data(page, sort_type, column_name, query);
      });
      $(document).on('click', '.sorting', function(){
          var column_name = $(this).data('column_name');
          var order_type = $(this).data('sorting_type');
          var reverse_order = '';
          if(order_type == 'asc')
          {
              $(this).data('sorting_type', 'desc');
              reverse_order = 'desc';
              clear_icon();
              $('#'+column_name+'_icon').html('<span class="fas fa-long-arrow-alt-down"></span>');
          }
          if(order_type == 'desc')
          {
              $(this).data('sorting_type', 'asc');
              reverse_order = 'asc';
              clear_icon
              $('#'+column_name+'_icon').html('<span class="fas fa-long-arrow-alt-up"></span>');
          }
          $('#hidden_column_name').val(column_name);
          $('#hidden_sort_type').val(reverse_order);
          var page = $('#hidden_page').val();
          var query = $('#searchId').val();
          fetch_data(page, reverse_order, column_name, query);
      });
      $(document).on('click', '.pagination a', function(event){
          event.preventDefault();
          var page = $(this).attr('href').split('page=')[1];
          $('#hidden_page').val(page);
          var column_name = $('#hidden_column_name').val();
          var sort_type = $('#hidden_sort_type').val();

          var query = $('#searchId').val();

          $('li').removeClass('active');
          $(this).parent().addClass('active');
          fetch_data(page, sort_type, column_name, query);
      });
  });
</script>
@endsection
