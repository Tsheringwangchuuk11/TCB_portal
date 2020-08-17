
@extends('layouts.manager')
@section('page-title', 'Service Provider')
@section('buttons')
@if ($privileges["create"] == 1)
     <a href="javascript:void(0)" data-href="{{ url('master/service-provider/create') }}"  class="btn  btn-sm btn-success  btn-flat add-new-serviceprovider"><i class="fa fa-plus" ></i> Add Service Provider</a>
@endif
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Service Provider List</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Service Provider</th>
                                <th>Active Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($serviceproviderlists as $serviceproviderlist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$serviceproviderlist->service_provider_type}}</td>
                                <td>
                                    @if ($serviceproviderlist->is_active=="Y")
                                        Yes 
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($privileges["edit"] == 1)
                                    <a href="javascript:void(0)" data-href="{{ url('master/service-provider/'. $serviceproviderlist->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat  add-new-serviceprovider" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger  btn-flat" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <a data-form="#frmDelete-{!! $serviceproviderlist->id !!}" data-title="Delete {!! $serviceproviderlist->service_provider_type !!}" data-message="Are you sure you want to delete this service provider details ?"></a>
                                    </a>
                                    <form action="{{ url('master/service-provider/' . $serviceproviderlist->id) }}" method="POST" id="{{ 'frmDelete-'.$serviceproviderlist->id }}">
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
                        {{ $serviceproviderlists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="service_provider_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Service Provider</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body service_provider">
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
      $('.add-new-serviceprovider').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.service_provider').load(dataURL,function(){
                $('#service_provider_modal').modal({show:true});
            });
        });
    })
</script>
@endsection
