@extends('layouts.manager')
@section('page-title', 'System Modules')
@section('buttons')
    @if ((int)$privileges["create"] == 1)
        <a href="{{ url('system/modules/create')}}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Add Module</a>
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
                        <th class="text-center">Icon</th>
                        <th>Modules</th>
                        <th class="text-center"><i class="fas fa-cog"></i> Action</th>
                    </tr>
				</thead>
				<tbody>
                    @forelse($modules as $module)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center"><i class="fa {{ $module->icon }}"></i></td>
                            <td>{!! $module->name !!}</td>
                            <td class="text-center">
                                @if ((int)$privileges->edit == 1)
                                <a href="{{ url('system/modules/' . $module->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-danger text-center">No modules to be displayed</td>
                        </tr>
                    @endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@include('layouts.include.confirm_delete')
@endsection