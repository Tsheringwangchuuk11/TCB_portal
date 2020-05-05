@extends('layouts.manager')
@section('page-title', 'Edit Role and Permissions')
@section('page-action')
@endsection
@section('content')
<form action="{{ url('system/roles/' . $role->id) }}" method="POST">
	@csrf
	@method('PUT')
	<div class="col-md-12">
		<div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Update Role</h3>
            </div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label for="name">Role Name</label>
							<input type="text" name="role_name" class="form-control required" value="{{old('role_name', $role->name)}}" />
						</div>
					</div>
					<div class="col-md-7">
						<div class="form-group">
							<label for="name">Role Description</label>
							<textarea name="role_description" class="form-control">{{old('role_description', $role->description)}}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card card-secondary">
			<div class="card-header">
                <h3 class="card-title">Add / Edit Permissions</h3>
                <div class="card-tools pull-right">
                    <a href="{{ url('system/roles')}}" class="btn bg-olive btn-sm btn-flat"><i class="fas fa-reply"></i> Back to Role List</a>
                </div>
			</div>
			<div class="card-body no-padding">
				<table id="set-access" class="table table-condensed table-striped">
					<thead>
						<th>Main Module</th>
						<th>Sub Module</th>
						<th class="text-center">All</th>
						<th class="text-center">View</th>
						<th class="text-center">Create</th>
						<th class="text-center">Edit</th>
						<th class="text-center">Delete</th>
					</thead>
					<tbody>
							<?php $currentTopMenu = ''; ?>
							@foreach($modules as $module)
							<tr>
								<td><strong>{{ $module->top_menu != $currentTopMenu ? $module->top_menu : '' }}</strong></td>
								<td>
									<input type="hidden" name="permission_role[menu-{{$module->sub_menu_id}}][sub_menu_id]" value="{{ $module->sub_menu_id }}" {{ (int)$module->view == 1 || (int)$module->create == 1 || (int)$module->edit == 1 || (int)$module->delete == 1 ? '' : 'disabled'}} class="module-id resetKeyForNew" />
									{{ $module->sub_menu }}
								</td>
								@if($module->flag == 'M')
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
								@else
								<td class="text-center"></td>
								<td class="text-center">
									<label>
										<input type="checkbox" name="permission_role[menu-{{$module->sub_menu_id}}][view]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1" {{ (int)$module->view == 1 ? 'checked' : '' }} />
										<span class="lbl"></span>
									</label>
								</td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								@endif
							</tr>
						<?php $currentTopMenu = $module->top_menu; ?>
						@endforeach
					</tbody>
				</table>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success btn-flat btn-sm"><i class="fas fa-check"></i> UPDATE ROLE</button>
                <a href="{{ url('system/roles') }}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-undo"></i> CANCEL</a>
            </div>
		</div>
	</div>
</form>
@endsection
@section('scripts')
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