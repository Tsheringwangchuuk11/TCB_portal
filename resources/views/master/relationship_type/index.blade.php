@extends('layouts.manager')
@section('page-title', 'Relationship Type')
@section('buttons')
@if ($privileges["create"] == 1)
     <a href="javascript:void(0)" data-href="{{ url('master/relationship/create') }}"  class="btn  btn-sm btn-success  btn-flat add-new-relationship"><i class="fa fa-plus" ></i> Add Relationship Type</a>
@endif
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Relationship Types List</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Relationship Types</th>
                                <th>Active Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($relationshiplists as $relationshiplist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$relationshiplist->relation_type}}</td>
                                <td>
                                    @if ($relationshiplist->is_active=="Y")
                                        Yes 
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($privileges["edit"] == 1)
                                    <a href="javascript:void(0)" data-href="{{ url('master/relationship/'. $relationshiplist->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat add-new-relationship" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger  btn-flat" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <a data-form="#frmDelete-{!! $relationshiplist->id !!}" data-title="Delete {!! $relationshiplist->relation_type !!}" data-message="Are you sure you want to delete this relationship types details ?"></a>
                                    </a>
                                    <form action="{{ url('master/relationship/' . $relationshiplist->id) }}" method="POST" id="{{ 'frmDelete-'.$relationshiplist->id }}">
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
                        {{ $relationshiplists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="relationship_type_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Relationship Types</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body relationship_type">
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
      $('.add-new-relationship').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.relationship_type').load(dataURL,function(){
                $('#relationship_type_modal').modal({show:true});
            });
        });
    })
</script>
@endsection
