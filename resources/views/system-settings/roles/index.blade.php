@extends('layouts.manager')
@section('page-title', 'System Roles')
@section('buttons')
    @if ((int)$privileges["create"] == 1)
    <a href="{{ url('system/roles/create')}}" class="btn btn-success btn-sm btn-flat"><i class="fas fa-plus"></i> Add Role</a>
    @endif
@endsection
@section('content')
<div class="card">
	<div class="card-header">
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-striped table-bordered m-0">
				<thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Role</th>
                        <th class="text-center"><i class="fas fa-cog"></i> Action</th>
                    </tr>
				</thead>
				<tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{!! $role->name !!}</td>
                            <td class="text-center">
                                <a href="{{ url('system/roles/' . $role->id) }}" class="btn btn-primary btn-xs btn-flat" title="Detail"><i class="fas fa-list"></i> Detail</a>
                                @if ((int)$privileges->edit == 1)
                                <a href="{{ url('system/roles/' . $role->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                @endif
                                @if((int)$privileges->delete == 1)
                                <a href="#" class="formConfirm btn btn-xs btn-flat btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i> Delete
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
@include('layouts.include.confirm_delete')
@endsection