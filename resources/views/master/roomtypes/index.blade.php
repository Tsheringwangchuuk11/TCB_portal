@extends('layouts.manager')
@section('page-title', 'List of Room Types')
@section('buttons')
@if ($privileges["create"] == 1)
     <a href="javascript:void(0)" data-href="{{ url('master/room-types/create') }}"  class="btn  btn-sm btn-success  btn-flat add-new-roomtype"><i class="fa fa-plus" ></i> Add Room Type</a>
@endif
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
                                <th>Active Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="event_body_id">
                            @forelse ($roomtypeslists as $roomtypeslist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$roomtypeslist->room_name}}</td>
                                <td>
                                    @if ($roomtypeslist->is_active=="Y")
                                        Yes 
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($privileges["edit"] == 1)
                                    <a href="javascript:void(0)" data-href="{{ url('master/room-types/'. $roomtypeslist->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat edit-new-roomtype" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger  btn-flat" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <a data-form="#frmDelete-{!! $roomtypeslist->id !!}" data-title="Delete {!! $roomtypeslist->room_name !!}" data-message="Are you sure you want to delete this room types details ?"></a>
                                    </a>
                                    <form action="{{ url('master/room-types/' . $roomtypeslist->id) }}" method="POST" id="{{ 'frmDelete-'.$roomtypeslist->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-danger text-center">No data to be displayed</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <br>
                    <div class="float-right">
                        {{ $roomtypeslists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="room_type_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Room Types</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body roomtypes">
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
      $('.add-new-roomtype').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.roomtypes').load(dataURL,function(){
                $('#room_type_modal').modal({show:true});
            });
        });
        $('.edit-new-roomtype').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.roomtypes').load(dataURL,function(){
                $('#room_type_modal').modal({show:true});
            });
        }); 
    })
</script>
@endsection
