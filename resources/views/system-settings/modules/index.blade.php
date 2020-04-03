@extends('layouts.manager')
@section('page-title', 'System Modules')
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="box box-default">
			<div class="box-header">
                <h3 class="box-title">List of Modules</h3>
                <div class="box-tools pull-right">
                    @if ((int)$priviliges["create"] == 1)
                        <a href="{{ url('system/modules/create')}}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> Add Module</a>
                    @endif
                </div>
            </div>
			<div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Icon</th>
                                <th>Modules</th>
                                <th class="text-center"><i class="fa fa-asterisk"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($modules as $module)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center"><i class="fa {{ $module->icon }}"></i></td>
                                <td>{!! $module->name !!}</td>
                                <td class="text-center">
                                    @if ((int)$priviliges->edit == 1)
                                    <a href="{{ url('system/modules/' . $module->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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
	</div>
</div>
@include('layouts.includes.confirm_delete')
@endsection