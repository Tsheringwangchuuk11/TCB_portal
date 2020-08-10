@extends('layouts.manager')
@section('page-title', 'List of room types')
@section('buttons')
<a href="javascript:void(0)" class="btn btn-success btn-flat mb-2 float-right" id="create-new-event"> <i class="fas fa-plus"></i> Add</a>
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Room Types List</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Room Types</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="event_body_id">
                            @forelse ($roomtypeslists as $roomtypeslist)
                            <tr>
                                <td class="text-center">{{ $roomtypeslist->id }}</td>
                                <td>{{$roomtypeslist->room_name}}</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" id="edit-event" data-id="{{ $roomtypeslist->id }}" class="btn  btn-sm btn-info">Edit</a>
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <a data-form="#frmDelete-{!! $roomtypeslist->id !!}" data-title="Delete {!! $roomtypeslist->room_name !!}" data-message="Are you sure you want to delete this event details?"></a>
                                    </a>
                                    <form action="{{ url('events/travel-fairs-event/' . $roomtypeslist->id) }}" method="POST" id="{{ 'frmDelete-'.$roomtypeslist->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-danger text-center">No events to be displayed</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <br>
                    <div class="float-right">
                        {{-- {{ $events->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
          $('#email').val(data.email); 
          $('#contact_person').val(data.contact_person); 
          $('#web_site').val(data.web_site); 
          $('#mobile_no').val(data.mobile_no); 
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
  $('#countryId').on('change',function(e) {
      var countryId = e.target.value;
      if(countryId==1){
         $("#displaydzongkhag").show();	
         $("#displayvillage").show();
         $("#displaylocation").hide();

      }else{
         $("#displaydzongkhag").hide();	
         $("#displayvillage").hide();
         $("#displaylocation").show();
      }		 
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
