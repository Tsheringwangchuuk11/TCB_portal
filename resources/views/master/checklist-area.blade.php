@extends('layouts.manager')
@section('page-title', 'List of Checklist Areas')
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
						<h3 class="card-title">Checklist Area's Details</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<i class="icon fas fa-check"></i>
						</div>
                        <div class="alert alert-danger alert-dismissible" id="valid_msg_id" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <i class="icon fas fa-info"></i>
                        </div>
                        <div class="form-inline ml-3 float-right">
                            <input class="form-control" type="search" name="search" placeholder="Search" id="searchId" aria-label="Search">
                        </div>
					<br><br>
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer"># <span id="id_icon"></span></th>
									<th class="sorting" data-sorting_type="asc" data-column_name="module_name" style="cursor: pointer">Module <span id="module_name_icon"></span></th>
                                    <th class="sorting" data-sorting_type="asc" data-column_name="checklist_ch_name" style="cursor: pointer">Checklist Chapter <span id="checklist_ch_name_icon"></span></th>
                                    <th class="sorting" data-sorting_type="asc" data-column_name="checklist_area" style="cursor: pointer">Checklist Area <span id="checklist_area_icon"></span></th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="checklist_area_body_id">
							<input type="hidden" id="checklist_area_count" value="{{ $checklistAreaCount}}" />
                            @include('master.includes.checklist_area_data')
							</tbody>
						</table>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                        <br>
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
                                <label for="" >Module <code>*</code></label>
								<select name="service_module" class="form-control required module select2bs4" id="module">
									<option value="">---SELECT---</option>
									@foreach ($serviceModules as $serviceModule)
									<option value="{{ $serviceModule->id }}" {{ old('service_module') == $serviceModule->id ? 'selected' : '' }}>{{ $serviceModule->module_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
                                <label for="" >Checklist Chapter <code>*</code></label>
								<select name="checklist_chapter" class="form-control checklist select2bs4" id="checklist_chapter" disabled>
									<option value="">---SELECT MODULE FIRST---</option>
								</select>
							</div>
                            <div class="form-group">
                                <label for="">Checklist Area <code>*</code></label>
                                <input type="text" id= "checklist_area" name="checklist_area" class="form-control required">
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
				getChapterDropdownLists(selectedModule, 0);
			} else {
				$('select.checklist').empty().attr('disabled', true);
				$('select.checklist').append('<option value="">---SELECT MODULE FIRST---</option>');
			}
		});

        function getChapterDropdownLists(selectedModuleId, chapterId){
            $.ajax({
                type: 'GET',
                url:"{{ url('master/checklist-areas/module') }}",
                dataType: 'JSON',
                data: { moduleId: selectedModuleId },

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
                    if (chapterId != 0){
                        $("#checklist_chapter").select2("trigger", "select", {
                            data: { id: chapterId }
                        });
                    }

                }
            });
        }

	  $('#btn-save').click(function(e){
		e.preventDefault();
		//create
		var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');

		var StartModule = $('#module option:selected').text();
        var checklistName = $('#checklist_chapter option:selected').text();

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

						$('#checklistForm').trigger("reset");
						$('#error_msg_id').hide();
						$("#module").val(null).trigger("change");
						$("#checklist_chapter").val(null).trigger("change");
						$('#ajax-crud-modal').modal('hide');
						$('#btn-save').html('Save Changes');
						$('#success_msg_id').html('');
						$('#success_msg_id').show();
						$('#success_msg_id').html('Checklist Area: '+data.checklist_area+' has been successfully saved!');
						$("#success_msg_id").fadeTo(2000, 500).slideUp(500, function(){
							$("#success_msg_id").slideUp(500);
						});

                      var query = $('#searchId').val();
                      var column_name = $('#hidden_column_name').val();
                      var sort_type = $('#hidden_sort_type').val();
                      var page = $('#hidden_page').val();
                      fetch_data(page, sort_type, column_name, query);
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
		 $('#btn-save').val("Create Checklist Area");
		$('#checklistForm').trigger("reset");
		$('#module').val('').trigger('change');
		$('#checklist_chapter').val('').trigger('change');
        $('#checklistCrudModal').html("Add New Checklist Area");
        $('#ajax-crud-modal').modal('show');
    });
	//edit
    $('body').on('click', '#edit_checklist_area', function () {
	  var checklist_area_id = $(this).data('id');
	  $('#checklist_chapter').removeAttr('disabled', true);
	  $('#btn-save').removeAttr("disabled");
      $.get('/master/checklist-areas/'+checklist_area_id+'/edit', function (data) {
         $('#checklistCrudModal').html("Edit Checklist Area");
          $('#btn-save').val("Edit Checklist Area");
          $('#ajax-crud-modal').modal('show');
		  $('#checklist_area_id').val(data.id);
          $('#module').val(data.checklist_chapter.module_id).trigger('change');
          getChapterDropdownLists(data.checklist_chapter.module_id,data.checklist_ch_id);
          $('#checklist_area').val(data.checklist_area);
		  (data.is_active == 0? $('#status2').prop("checked", true):$('#status1').prop("checked", true));

      })
   });
      $('body').on('click', '#delete_checklist', function () {
          var checklist_area_id = $(this).data("id");

          if(confirm("Are You sure want to delete !")){
              $.ajax({
                  type: "DELETE",
                  url: "{{ url('master/checklist-areas')}}"+'/'+checklist_area_id,
                  success: function (data) {
                      if(data.isAreaUsed){
                          $('#valid_msg_id').html('');
                          $('#valid_msg_id').show();
                          $('#valid_msg_id').html('Checklist Area: '+data.checklist_area+' cannot be deleted! It has already used in the Checklist Standard.');
                          $("#valid_msg_id").fadeTo(2000, 500).slideUp(500, function(){
                              $("#valid_msg_id").slideUp(500);
                          });
                      }else {
                          $("#checklist_area_id_" +checklist_area_id).remove();
                          $('#success_msg_id').html('');
                          $('#success_msg_id').show();
                          $('#success_msg_id').html('Checklist Area: '+data.checklist_area+' has been successfully deleted!');
                          $("#success_msg_id").fadeTo(2000, 500).slideUp(500, function(){
                              $("#success_msg_id").slideUp(500);
                          });
                      }

                  },
                  error: function (data) {
                      console.log('Error:', data);
                  }
              });
          }

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
          $('#module_name_icon').html('');
          $('#checklist_ch_name_icon').html('');
          $('#checklist_area_icon').html('');
      }
      function fetch_data(page, sort_type, sort_by, query)
      {
          //alert(page+':'+sort_type+':'+sort_by+':'+query);
          $.ajax({
              url:"/master/checklist-areas?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&search_text="+query,
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
