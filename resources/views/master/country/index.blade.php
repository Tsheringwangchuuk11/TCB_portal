@extends('layouts.manager')
@section('page-title', 'Country')
@section('buttons')
@if ($privileges["create"] == 1)
     <a href="javascript:void(0)" data-href="{{ url('master/country/create') }}"  class="btn  btn-sm btn-success  btn-flat add-new-country"><i class="fa fa-plus" ></i> Add Country</a>
@endif
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Country List</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Country Name</th>
                                <th>Active Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($countrylists as $countrylist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$countrylist->country_name}}</td>
                                <td>
                                    @if ($countrylist->is_active=="Y")
                                        Yes 
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($privileges["edit"] == 1)
                                    <a href="javascript:void(0)" data-href="{{ url('master/country/'. $countrylist->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat add-new-country" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger  btn-flat" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <a data-form="#frmDelete-{!! $countrylist->id !!}" data-title="Delete {!! $countrylist->country_name !!}" data-message="Are you sure you want to delete this country details ?"></a>
                                    </a>
                                    <form action="{{ url('master/country/' . $countrylist->id) }}" method="POST" id="{{ 'frmDelete-'.$countrylist->id }}">
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
                        {{ $countrylists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="country_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Country</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body country">
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
      $('.add-new-country').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.country').load(dataURL,function(){
                $('#country_modal').modal({show:true});
            });
        });
    })
</script>
@endsection
