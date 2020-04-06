@extends('layouts.manager')
@section('page-title', 'Role & Permission')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header">
                <h3 class="card-title">Showing role details and permissions for <strong class="text-danger">{{ $role->name }}</strong></h3>
                <div class="card-tools pull-right">
                    <a href="{{ url('system/roles')}}" class="btn bg-olive btn-sm btn-flat"><i class="fas fa-reply"></i> Back to Role List</a>
                </div>
            </div>
            <div class="card-body">
                <table id="set-access" class="table table-condensed table-striped">
                    <thead>
                        <th>Main Module</th>
                        <th>Sub Module</th>
                        <th class="text-center">Show Menu</th>
                        <th class="text-center">Create</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </thead>
                    <tbody>
                        <?php $currentTopMenu = ''; ?>
                        @foreach($modules as $module)
                            @if($module->top_menu != $currentTopMenu && $currentTopMenu != '')
                            <thead>
                                <th><strong>Main</strong> Module</th>
                                <th><strong>Sub</strong> Module</th>
                                <th class="text-center"><strong>View</strong></th>
                                <th class="text-center"><strong>Create</strong></th>
                                <th class="text-center"><strong>Edit</strong></th>
                                <th class="text-center"><strong>Delete</strong></th>
                            </thead>
                            @endif
                            <tr>
                                <td>{{ $module->top_menu != $currentTopMenu ? $module->top_menu : '' }}</td>
                                <td>
                                    {{ $module->sub_menu }}
                                </td>
                                <td class="text-center">
                                    {!! $module->view == 1 ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-times text-red"></i>' !!}
                                </td>
                                <td class="text-center">
                                    {!! $module->create == 1 ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-times text-red"></i>' !!}
                                </td>
                                <td class="text-center">
                                    {!! $module->edit == 1 ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-times text-red"></i>' !!}
                                </td>
                                <td class="text-center">
                                    {!! $module->delete == 1 ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-times text-red"></i>' !!}
                                </td>
                            </tr>
                        <?php $currentTopMenu = $module->top_menu; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection