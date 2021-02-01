@extends('layouts.manager')
@section('page-title', 'Visitor Origin')
@section('buttons')
    @if ($privileges["create"] == 1)
        <a href="javascript:void(0)" data-href="{{ url('statistical/origin/create') }}"  class="btn  btn-sm btn-success  btn-flat adddata"><i class="fa fa-plus" ></i> Add Origin</a>
    @endif
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Origin Detail List</h3>
                </div>
                <div class="card-body">
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Main Destionation</th>
                                <th>Vistor Types</th>
                                <th>Dzongkhag of Origin</th>
                                <th>Value</th>
                                <th>Year</th>
                                <th>Report Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($originLists as $originList)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$originList->main_destionation}}</td>
                                <td>{{$originList->visitor_types}}</td>
                                <td>{{$originList->dzo_of_origin}}</td>
                                <td>{{$originList->value}}</td>
                                <td>{{$originList->year}}</td>
                                <td>{{$originList->report_category}}</td>
                                <td>
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" data-href="{{ url('statistical/origin/'.$originList->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat editdata" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                        <a data-form="#frmDelete-{!! $originList->id !!}" data-title="Delete {!! $originList->visitor_types !!}" data-message="Are you sure you want to delete this {!! $originList->visitor_types !!} details ?"></a>
                                    </a>
                                    <form action="{{ url('statistical/origin/' .$originList->id) }}" method="POST" id="{{ 'frmDelete-'.$originList->id }}">
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
    <div class="modal fade" id="add_data_modal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Visitor Origin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body add_data_model_body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_data_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Visitor Origin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body edit_data_model_body">
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
    $('.adddata').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.add_data_model_body').load(dataURL,function(){
            $('#add_data_modal').modal({show:true});
        });
    });
    $('.editdata').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.edit_data_model_body').load(dataURL,function(){
            $('#edit_data_modal').modal({show:true});
        });
    });
    
</script>
@endsection
