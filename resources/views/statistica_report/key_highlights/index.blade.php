@extends('layouts.manager')
@section('page-title', 'Key Highlights')
@section('buttons')
    @if ($privileges["create"] == 1)
        <a href="javascript:void(0)" data-href="{{ url('statistical/key-highlights/create') }}"  class="btn  btn-sm btn-success  btn-flat addkeyhighligts"><i class="fa fa-plus" ></i> Add Key highlights</a>
    @endif
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Key highlights Detail List</h3>
                </div>
                <div class="card-body">
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Key highlight Types</th>
                                <th>Total Number</th>
                                <th>Year</th>
                                <th>Publish Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keyhighligtslists as $keyhighligtslist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$keyhighligtslist->dropdown_name}}</td>
                                <td>{{$keyhighligtslist->total_no}}</td>
                                <td>{{$keyhighligtslist->year}}</td>
                                <td>
                                    @if ($keyhighligtslist->is_publish=='N')
                                        No
                                    @else
                                         Yes  
                                    @endif
                                </td>
                                <td>
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" data-href="{{ url('statistical/key-highlights/'.$keyhighligtslist->key_highlight_id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat editkeyhighligts" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                        <a data-form="#frmDelete-{!! $keyhighligtslist->key_highlight_id !!}" data-title="Delete {!! $keyhighligtslist->dropdown_name !!}" data-message="Are you sure you want to delete this {!! $keyhighligtslist->dropdown_name !!} details ?"></a>
                                    </a>
                                    <form action="{{ url('statistical/key-highlights/' .$keyhighligtslist->key_highlight_id) }}" method="POST" id="{{ 'frmDelete-'.$keyhighligtslist->key_highlight_id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addkeyhighligts_modal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Key Highlights</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body addkeyhighligts_modal_model_body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editkeyhighligts_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Key Highlights</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body editkeyhighligts_modal_model_body">
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
        $('#datatableId').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
            });
    })
    $('.addkeyhighligts').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.addkeyhighligts_modal_model_body').load(dataURL,function(){
            $('#addkeyhighligts_modal').modal({show:true});
        });
    });
    $('.editkeyhighligts').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.editkeyhighligts_modal_model_body').load(dataURL,function(){
            $('#editkeyhighligts_modal').modal({show:true});
        });
    });
    
</script>
@endsection
