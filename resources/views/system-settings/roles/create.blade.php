@extends('layouts.manager')
@section('page-title', 'Create Role and Permissions')
@section('content')
<form action="{{ url('system/roles') }}" method="POST">
@csrf
<div class="row">
	<div class="col-md-3">
		<div class="box box-default">
			<div class="box-header">
                <h3 class="box-title">Add Module</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
					<label for="name">Role Name</label>
					<input type="text" name="role_name" class="form-control required" value="{{old('role_name')}}" />
				</div>
				<div class="form-group">
					<label for="name">Role Description</label>
					<textarea name="role_description" class="form-control" rows="6">{{old('role_description')}}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-default">
			<div class="box-header">
				<h3 class="box-title">Add Permission</h3>
			</div>
			<div class="box-body no-padding">
				<table id="set-access" class="table table-condensed">
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
                            @if($module->name != $currentTopMenu && $currentTopMenu != '')
                            <thead>
                                <tr>
                                    <th>Main Module</th>
                                    <th>Sub Module</th>
                                    <th class="text-center"><strong>All</strong></th>
                                    <th class="text-center"><strong>View</strong></th>
                                    <th class="text-center"><strong>Create</strong></th>
                                    <th class="text-center"><strong>Edit</strong></th>
                                    <th class="text-center"><strong>Delete</strong></th>
                                </tr>
                            </thead>
							@endif
							@foreach($module->systemSubMenus as $subMenu)
								<tr>
									<td>
									{{ $module->name != $currentTopMenu ? $module->name : '' }}
									</td>
									<td>
									<input type="hidden" name="permission_role[menu-{{$subMenu->id}}][sub_menu_id]" value="{{ $subMenu->id }}" disabled="disabled" class="module-id resetKeyForNew" />
									{{ $subMenu->name }}
									</td>
									<td class="text-center">
										<label>
											<input type="checkbox" name="all" class="all-priviliges" value="1"/>
											<span class="lbl"></span>
										</label>
									</td>
									<td class="text-center">
										<label>
											<input type="checkbox" name="permission_role[menu-{{$subMenu->id}}][view]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1"/>
											<span class="lbl"></span>
										</label>
									</td>
									<td class="text-center">
										<label>
											<input type="checkbox" name="permission_role[menu-{{$subMenu->id}}][create]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1"/>
											<span class="lbl"></span>
										</label>
									</td>
									<td class="text-center">
										<label>
											<input type="checkbox" name="permission_role[menu-{{$subMenu->id}}][edit]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1"/>
											<span class="lbl"></span>
										</label>
									</td>
									<td class="text-center">
										<label>
											<input type="checkbox" name="permission_role[menu-{{$subMenu->id}}][delete]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1"/>
											<span class="lbl"></span>
										</label>
									</td>
								</tr>
							<?php $currentTopMenu = $module->name; ?>
							@endforeach
						@endforeach
					</tbody>
				</table>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-success btn-flat btn-sm"><i class="fa fa-upload"></i> CREATE ROLE</button>
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