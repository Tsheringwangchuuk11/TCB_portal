@extends('layouts.manager')
@section('page-title', 'Edit Menu and Sub Menu')
@section('content')
<form action="{{ url('system/modules/' . $module->id) }}" method="POST">
@csrf
@method('PUT')
	<div class="col-md-12">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Update Menu</h3>
			</div>
			<div class="card-body">	
				<div class="row">
					<div class="col-md-5">			
						<div class="form-group">
							<label for="name">Main Menu Name *</label>
							<input type="text" name="main_module_name" class="form-control required" value="{{old('main_module_name', $module->name)}}" />
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
						<div class="form-group">
							<label for="name">Menu Icon *</label>
							<input type="text" name="module_icon" class="form-control required" value="{{old('module_icon', $module->icon)}}" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label for="name">Display Order *</label>
							<input type="text" name="module_display_order" class="form-control required" value="{{old('module_display_order', $module->display_order)}}" />
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Update Sub Menu</h3>
			</div>
			<div class="card-body p-0">
				<table id="sub-module" class="table table-condensed table-striped">
					<thead>
						<th class="text-center">#</th>
						<th>Sub Menu Name *</th>
						<th>Route *</th>
						<th>Order *</th>
					</thead>
					<tbody>
						@foreach($module->systemSubMenus as $subModule)
							<tr>
								<td class="text-center">
									<a href="#" class="delete-table-row btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
								</td>
								<td>
									<input type="hidden" name="submodules[AAAA{{$subModule->id}}][sub_module_id]" class="resetKeyForNew" value="{{ $subModule->id }}" />
									<input type="text" name="submodules[AAAA{{$subModule->id}}][sub_module_name]" class="required form-control input-sm resetKeyForNew" value="{{ $subModule->name }}" />
								</td>
								<td>
									<input type="text" name="submodules[AAAA{{$subModule->id}}][route]" class="required form-control input-sm resetKeyForNew" value="{{ $subModule->route }}" />
								</td>
								<td width="25%">
									<input type="text" name="submodules[AAAA{{$subModule->id}}][display_order]" class="required form-control number input-sm resetKeyForNew" value="{{ $subModule->display_order }}" />
								</td>
							</tr>
						@endforeach
						@if ($module->systemSubMenus->isEmpty())
							<tr>
								<td class="text-center">
									<a href="#" class="delete-table-row btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
								</td>
								<td>
									<input type="hidden" name="submodules[AAAAA][sub_module_id]" class="resetKeyForNew" />
									<input type="text" name="submodules[AAAAA][sub_module_name]" class="required form-control input-sm resetKeyForNew" />
								</td>
								<td>
									<input type="text" name="submodules[AAAAA][route]" class="required form-control input-sm resetKeyForNew" />
								</td>
								<td width="25%">
									<input type="text" name="submodules[AAAAA][display_order]" class="required form-control number input-sm resetKeyForNew" />
								</td>
							</tr>
						@endif
						<tr class="notremovefornew">
							<td colspan="3"></td>
							<td class="text-center">
								<a href="#" class="add-table-row btn bg-purple btn-sm"><i class="fas fa-plus"></i> Add New Row</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer text-center">
				<button type="submit" class="btn btn-success btn-flat btn-sm"><i class="fas fa-check"></i> UPDATE MENU</button>
				<a href="{{ url('system/modules') }}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-undo"></i> CANCEL</a>
			</div>								
		</div>
	</div>		
</form>
@endsection
