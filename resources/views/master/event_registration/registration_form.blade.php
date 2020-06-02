@extends('layouts.manager')
@section('page-title', 'List of Events')
@section('content')
    <section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">Event List</h3>
					</div>
					<div class="card-body">
						<div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<i class="icon fas fa-check"></i>
						</div>
						@if ($privileges["create"] == 1)
						<a href="javascript:void(0)" class="btn btn-success mb-2 float-right" id="create_new_event">Add Events</a>
						@endif
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="text-center">Sl.No</th>
                                    <th>Event Name</th>
                                    <th>Location</th>
                                    <th>Country</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="event_body_id">
							@forelse ($events as $event)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{$event->event_name}}</td>
									<td>{{$event->location}}</td>
									<td>{{$event->country_id}}</td>
								<td class="text-center">
									@if ($privileges["edit"] == 1)
									<a href="javascript:void(0)" id="edit_eventlist" data-id="{{ $event->id }}" class="btn btn-sm btn-outline-info" title="Edit"> <i class="fas fa-edit"></i></a>
									@endif
									@if((int)$privileges->delete == 1)
									<a href="#" class="form-confirm  btn btn-sm btn-outline-danger" title="Delete">
										<i class="fas fa-trash"></i>
										<a data-form="#frmDelete-{!! $event->id !!}" data-title="Delete {!! $event->event_name !!}" data-message="Are you sure you want to delete this event details?"></a>
									</a>
									<form action="{{ url('master/checklist-chapters/' . $event->id) }}" method="POST" id="{{ 'frmDelete-'.$event->id }}">
										@csrf
										@method('DELETE')
									</form>
									@endif
								</td>
								</tr>
							@empty
							<tr>
								<td colspan="5" class="text-danger text-center">No events to be displayed</td>
							</tr>
							@endforelse
							</tbody> 
						</table><br>
						<div class="float-right">
							{{ $events->links() }}
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
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
				</div>
				<div class="modal-body">
                    <form action="{{ url('master/travel-fairs-event') }}" method="POST" id="eventlistForm">
                        @csrf
                        <div class="modal-body" id="frm_body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Event Name*</label>
										<input type="text" id= "event_name" name="event_name" class="form-control required">
									</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label for="">To Country*</label>
									<input type="text" id= "country_id" name="country_id" class="form-control required">
								</div>
								</div>
							</div>
							
                           <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Location*</label>
									<input type="text" id= "location" name="location" class="form-control required">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Event Start Date*</label>
									<input type="date" id= "start_date" name="start_date" class="form-control required">
								</div>
							</div>
						   </div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Event End Date*</label>
										<input type="date" id= "end_date" name="end_date" class="form-control required">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Lat Date Of Registration*</label>
										<input type="date" id= "last_date" name="last_date" class="form-control required">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Event Details*</label>
										<textarea type="text" class="form-control" name="event_dtls" row="3"></textarea>
									</div>
								</div>
							</div>
                        </div>
						<div class="modal-footer" style="margin-bottom:-14px;">
							<button type="button" id="btn-save" class="btn btn-outline-success btn-flat margin-r-5" data-dismiss="modal">Create-Event</button>
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
	   $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	  $('#btn-save').click(function(e){
		 $.ajax({
			  data: $('#eventlistForm').serialize(),
			  url: "{{ route('travel-fairs-event.store') }}",
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				if(data.error){
					  printErrorMsg(data.error);
				  }else{
						$('#success_msg_id').show();
						$('#success_msg_id').html('Event Name: '+data.event_name+' has been successfully saved!');
						$("#success_msg_id").fadeTo(2000, 500).slideUp(500, function(){
							$("#success_msg_id").slideUp(500);
						});
				    }
			  }
		  });
	  });
    $('#create_new_event').click(function () {
        $('#ajax-crud-modal').modal('show');
	});
  });
  function printErrorMsg(msg){
		$('#error_msg_id').find('ul').html('');
		$('#error_msg_id').show();
		$.each( msg, function( key, value ) {
			$("#error_msg_id").find("ul").append('<li>'+value+'</li>');
		});
		$('#btn-save').html('Save Changes');
	}
</script>
@endsection
