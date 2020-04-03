@extends('layouts.manager')
@section('page-title', 'Edit Role and Permissions')
@section('page-action')
@endsection
@section('content')
<form action="{{ url('system/roles/' . $role->id) }}" method="POST">
@csrf
@method('PUT')
<div class="row">
	<div class="col-md-3">
		<div class="box box-default">
            <div class="box-header">
                <h3 class="box-title">Update Role</h3>
            </div>
			<div class="box-body">
				<div class="form-group">
					<label for="name">Role Name</label>
					<input type="text" name="role_name" class="form-control required" value="{{old('role_name', $role->name)}}" />
				</div>
				<div class="form-group">
					<label for="name">Role Description</label>
					<textarea name="role_description" class="form-control">{{old('role_description', $role->description)}}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-default">
			<div class="box-header">
                <h3 class="box-title">Add / Edit Permissions</h3>
                <div class="box-tools pull-right">
                    <a href="{{ url('system/roles')}}" class="btn bg-olive btn-sm btn-flat"><i class="fa fa-reply"></i> Back to Role List</a>
                </div>
			</div>
			<div class="box-body no-padding">
				<table id="set-access" class="table table-condensed table-striped">
					<thead>
						<th>Main Module</th>
						<th>Sub Module</th>
						<th class="text-center">All</th>
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
								<th class="text-center"><strong>All</strong></th>
								<th class="text-center"><strong>View</strong></th>
								<th class="text-center"><strong>Create</strong></th>
								<th class="text-center"><strong>Edit</strong></th>
								<th class="text-center"><strong>Delete</strong></th>
							</thead>
							@endif
							<tr>
								<td>{{ $module->top_menu != $currentTopMenu ? $module->top_menu : '' }}</td>
								<td>
									<input type="hidden" name="permission_role[menu-{{$module->sub_menu_id}}][sub_menu_id]" value="{{ $module->sub_menu_id }}" {{ (int)$module->view == 1 || (int)$module->create == 1 || (int)$module->edit == 1 || (int)$module->delete == 1 ? '' : 'disabled'}} class="module-id resetKeyForNew" />
									{{ $module->sub_menu }}
								</td>
								<td class="text-center">
									<label>
										<input type="checkbox" name="all" class="all-priviliges ace ace-checkbox-2" value="1" {{ (int)$module->view == 1 && (int)$module->create == 1 && (int)$module->edit == 1 && (int)$module->delete == 1 ? 'checked' : '' }}/>
										<span class="lbl"></span>
									</label>
								</td>
								<td class="text-center">
									<label>
										<input type="checkbox" name="permission_role[menu-{{$module->sub_menu_id}}][view]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1" {{ (int)$module->view == 1 ? 'checked' : '' }} />
										<span class="lbl"></span>
									</label>
								</td>
								<td class="text-center">
									<label>
										<input type="checkbox" name="permission_role[menu-{{$module->sub_menu_id}}][create]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1" {{ (int)$module->create == 1 ? 'checked' : '' }} />
										<span class="lbl"></span>
									</label>
								</td>
								<td class="text-center">
									<label>
										<input type="checkbox" name="permission_role[menu-{{$module->sub_menu_id}}][edit]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1" {{ (int)$module->edit == 1 ? 'checked' : '' }} />
										<span class="lbl"></span>
									</label>
								</td>
								<td class="text-center">
									<label>
										<input type="checkbox" name="permission_role[menu-{{$module->sub_menu_id}}][delete]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1" {{ (int)$module->delete == 1 ? 'checked' : '' }} />
										<span class="lbl"></span>
									</label>
								</td>
							</tr>
						<?php $currentTopMenu = $module->top_menu; ?>
						@endforeach
					</tbody>
				</table>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-success btn-flat btn-sm"><i class="fa fa-upload"></i> UPDATE ROLE</button>
                <a href="{{ url('system/roles') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-undo"></i> CANCEL</a>
            </div>
		</div>
	</div>
</div>
</form>
@endsection
@section('extra_scripts')
<script>
$(document).ready(function(){
	$('.all-priviliges').on('click',function(){
		if( $(this).is(':checked') ) {
			$(this).closest('tr').find('input[type="hidden"].module-id').prop('disabled', false);
			$(this).closest('tr').find('input[type="checkbox"].check-perm').prop('checked', true);
		} else {
			$(this).closest('tr').find('input[type="checkbox"].check-perm').prop('checked', false);
			$(this).closest('tr').find('input[type="hidden"].module-id').prop('disabled', true);
		}
	});

	$('.check-perm').on('click',function(){
		var curRow=$(this).closest('tr');
		var element=curRow.find('input[type="hidden"].module-id');
		var checkedCounter=0;
		if($(this).is(':checked')){
			if(element.is(':disabled')){
				element.prop('disabled', false);
			}
		}else{
			curRow.find('input[type="checkbox"].check-perm').not($(this)).each(function(){
				if($(this).is(':checked')){
					checkedCounter+=1;
				}
			});
			if(checkedCounter==0){
				element.prop('disabled',true);
				curRow.find('input[type="checkbox"].all-priviliges').prop('checked', false);
			}
		}
	});
});
</script>
@endsection