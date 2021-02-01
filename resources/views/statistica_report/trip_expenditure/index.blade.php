@extends('layouts.manager')
@section('page-title', 'Trip Expenditure')
@section('buttons')
    @if ($privileges["create"] == 1)
        <a href="javascript:void(0)" data-href="{{ url('statistical/trip-expenditure/create') }}"  class="btn  btn-sm btn-success  btn-flat adddata"><i class="fa fa-plus" ></i> Add Trip Expenditure</a>
    @endif
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trip Expenditure Detail List</h3>
                </div>
                <div class="card-body">
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Purpose</th>
                                <th>Expenditure Items</th>
                                <th>Trip Types</th>
                                <th>Value</th>
                                <th>Year</th>
                                <th>Report Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tripexpenditureLists as $tripexpenditureList)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$tripexpenditureList->purpose}}</td>
                                <td>{{$tripexpenditureList->exp_item}}</td>
                                <td>{{$tripexpenditureList->trip_types}}</td>
                                <td>{{$tripexpenditureList->value}}</td>
                                <td>{{$tripexpenditureList->year}}</td>
                                <td>{{$tripexpenditureList->report_category}}</td>
                                <td class="btn-group">
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" data-href="{{ url('statistical/trip-expenditure/'.$tripexpenditureList->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat editdata" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                        <a data-form="#frmDelete-{!! $tripexpenditureList->id !!}" data-title="Delete {!! $tripexpenditureList->exp_item !!}" data-message="Are you sure you want to delete this {!! $tripexpenditureList->exp_item !!} details ?"></a>
                                    </a>
                                    <form action="{{ url('statistical/trip-expenditure/' .$tripexpenditureList->id) }}" method="POST" id="{{ 'frmDelete-'.$tripexpenditureList->id }}">
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
                    <h4 class="modal-title">Trip Expenditure</h4>
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
                    <h4 class="modal-title">Trip Expenditure</h4>
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
