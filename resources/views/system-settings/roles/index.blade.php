@extends('layouts.manager')
@section('page-title', 'System Roles')
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="box box-default">
			<div class="box-header">
                <h3 class="box-title">List of Roles</h3>
                <div class="box-tools pull-right">
                    @if ((int)$priviliges["create"] == 1)
                        <a href="{{ url('system/roles/create')}}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> Add Role</a>
                    @endif
                </div>
            </div>
			<div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Role</th>
                                <th class="text-center"><i class="fa fa-asterisk"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{!! $role->name !!}</td>
                                <td class="text-center">
                                    <a href="{{ url('system/roles/' . $role->id) }}" class="btn btn-primary btn-xs btn-flat" title="Detail"><i class="fa fa-list"></i> Detail</a>
                                    @if ((int)$priviliges->edit == 1)
                                    <a href="{{ url('system/roles/' . $role->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                    @endif
                                    @if((int)$priviliges->delete == 1)
									<a href="#" class="formConfirm btn btn-xs btn-flat btn-danger" title="Delete">
										<i class="fa fa-trash"></i> Delete
										<a data-form="#frmDelete-{!! $role->id !!}" data-title="Delete {!! $role->name !!}" data-message="Are you sure you want to delete this role?"></a>
									</a>
                                    <form action="{{ url('system/roles/' . $role->id) }}" method="POST" id="{{ 'frmDelete-'.$role->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
									@endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-danger text-center">No roles to be displayed</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
@include('layouts.includes.confirm_delete')
@endsection