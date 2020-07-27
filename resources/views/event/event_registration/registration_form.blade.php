@extends('layouts.manager')
@section('page-title', 'List of Events')
@section('buttons')
@if ($privileges["create"] == 1)
<a href="javascript:void(0)" class="btn btn-success btn-flat mb-2 float-right" id="create-new-event"> <i class="fas fa-plus"></i> Add Events</a>
@endif
@endsection
@section('content')
    <section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Event List</h3>
					</div>
					<div class="card-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
                                    <th>Event Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
							</thead>
							<tbody id="event_body_id">
							@forelse ($events as $event)
								<tr>
									<td>{{ $event->id }}</td>
									<td>{{$event->event_name}}</td>
									<td>{{$event->start_date}}</td>
									<td>{{$event->end_date}}</td>
								<td class="text-center">
									@if ($privileges["edit"] == 1)
									<a href="javascript:void(0)" id="edit-event" data-id="{{ $event->id }}" class="btn  btn-sm btn-info">Edit</a>
									@endif
									@if((int)$privileges->delete == 1)
									<a href="#" class="form-confirm  btn btn-sm btn-danger" title="Delete">
										<i class="fas fa-trash"></i>
										<a data-form="#frmDelete-{!! $event->id !!}" data-title="Delete {!! $event->event_name !!}" data-message="Are you sure you want to delete this event details?"></a>
									</a>
									<form action="{{ url('events/travel-fairs-event/' . $event->id) }}" method="POST" id="{{ 'frmDelete-'.$event->id }}">
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
							{{-- {{ $events->links() }} --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
<div class="modal fade" id="event-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
    <div class="modal-header">
		<h4 class="modal-title" id="eventModal"></h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
    </div>
    <div class="modal-body">
        <form id="eventForm" name="eventForm" class="form-horizontal" method="POST">
		   <input type="hidden" name="event_id" id="event_id">
		   <div class="row"> 
           <div class="col-md-5">
			<div class="form-group">
				<label for="">Event Name*</label>
				<input type="text" id= "eventName" name="event_name" class="form-control">
			</div>
		</div>
 
		<div class="col-md-5 offset-md-2">
			<div class="form-group">
				<label for="">To Country*</label>
				<select  name="country_id" class="form-control select2bs4" style="width: 100%;" id="countryId">
					<option value=""> -Select-</option>
					@foreach ($countries as $country)
					  <option value="{{ $country->id }}">{{ $country->country_name }}</option>
					@endforeach
				  </select>
			</div>
			</div>
		   </div>
		   <div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label for="">Location*</label>
					<input type="text" id= "eventlocation" name="event_location" class="form-control">
				</div>
			</div>
			<div class="col-md-5 offset-md-2">
				<div class="form-group">
					<label for="">Event Start Date*</label>
					<input type="date" id= "eventstartDate" name="start_date" class="form-control">
				</div>
			</div>
		   </div>
		   <div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label for="">Event End Date*</label>
					<input type="date" id= "eventendDate" name="end_date" class="form-control">
				</div>
			</div>
			<div class="col-md-5 offset-md-2">
				<div class="form-group">
					<label for="">Late Date Of Registration*</label>
					<input type="date" id= "eventlastDate" name="last_date" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Event Details*</label>
					<textarea type="text" class="form-control" name="event_dtls" id="eventDtl" row="3"></textarea>
				</div>
			</div>
		</div>
		<div class="modal-footer" style="margin-bottom:-14px;">
			<button type="button" id="btn-save" class="btn btn-success btn-flat margin-r-5" value="create">Create-Event</button>
			<button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
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

    $('#create-new-event').click(function () {
        $('#btn-save').val("create-event");
        $('#eventForm').trigger("reset");
        $('#eventModal').html("Add New Event");
        $('#event-modal').modal('show');
    });
 
    $('body').on('click', '#edit-event', function () {
	  var event_id = $(this).data('id');
      $.get('/events/travel-fairs-event/'+event_id+'/edit', function (data) {
         $('#eventModal').html("Edit Event Registration");
          $('#btn-save').val("edit-event");
          $('#event-modal').modal('show');
          $('#event_id').val(data.id);
		  $('#eventName').val(data.event_name);
		  $('#countryId').val(data.country_id).trigger('change');
		  $('#eventstartDate').val(data.start_date);
		  $('#eventendDate').val(data.end_date);
		  $('#eventlastDate').val(data.last_date); 		  
		  $('#eventlocation').val(data.event_location); 
		  $('#eventDtl').val(data.event_dtls);  
      })
   });

    $('body').on('click', '.delete-post', function () {
        var event_id = $(this).data("id");
        confirm("Are You sure want to delete !");
        $.ajax({
            type: "DELETE",
            url: "{{ url('ajax-posts')}}"+'/'+event_id,
            success: function (data) {
                $("#event_id_" + event_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
  });
 
    $('#btn-save').click(function(e){
		e.preventDefault();
      var actionType = $('#btn-save').val();
	  $('#btn-save').html('Sending..');
	  $("#btn-save").attr("disabled", true);
      $.ajax({
          data: $('#eventForm').serialize(),
          url: "{{ route('travel-fairs-event.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var event = '<tr id="event_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.event_name + '</td><td>' + data.start_date + '</td><td>'+ data.end_date + '</td>';
              event += '<td class="text-center"><a href="javascript:void(0)" id="edit-event" data-id="' + data.id + '" class="btn btn-sm btn-info">Edit</a> <a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td></tr>';
              if (actionType == "create-event") {
                  $('#event_body_id').prepend(event);
              } else {
                  $("#event_id_" + data.id).replaceWith(event);
              }
 
              $('#eventForm').trigger("reset");
              $('#event-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
	});
</script>
@endsection
