@extends('layouts.manager')
@section('page-title', 'Event')
@section('buttons')
@if ($privileges["create"] == 1)
     <a href="javascript:void(0)" data-href="{{ url('events/travel-fairs-event/create') }}"  class="btn  btn-sm btn-success  btn-flat add-new-event"><i class="fa fa-plus" ></i> Add Events</a>
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
                                <th>Country</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{$event->event_name}}</td>
                                <td>{{$event->country_name}}</td>
                                <td>{{$event->start_date}}</td>
                                <td>{{$event->end_date}}</td>
                                <td class="text-center">
                                    @if ($privileges["edit"] == 1)
                                    <a href="javascript:void(0)" data-href="{{ url('events/travel-fairs-event/'. $event->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat add-new-event" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger  btn-flat" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <a data-form="#frmDelete-{!! $event->id !!}" data-title="Delete {!! $event->event_name !!}" data-message="Are you sure you want to delete this event details ?"></a>
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
                    </table>
                    <br>
                    {{-- <div class="float-right">
                        {{ $countrylists->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="event_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body event">
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.include.confirm-delete')
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
      $('.add-new-event').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.event').load(dataURL,function(){
                $('#event_modal').modal({show:true});
            });
        });
    })
</script>
@endsection
