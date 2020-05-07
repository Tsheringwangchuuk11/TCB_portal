@extends('layouts.manager')
@section('page-title', 'Create User & Assign Role')
@section('content')
<form action="{{ url('system/users') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="col-md-12">	
		<div class="card card-secondary">
			<div class="card-header">
                <h3 class="card-title">General Information</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Name *</label>
							<input type="text" name="name" class="form-control required" value="{{ old('name')}}" />
						</div>
					</div>					
					<div class="col-md-6">
						<div class="form-group">
							<label for="username">Username (Email) *</label>
							<input type="text" name="username" class="form-control required email" value="{{ old('username')}}" autocomplete="off"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="password">Password *</label>
							<input type="password" name="password" class="form-control required password" value="{{ old('password')}}" autocomplete="off"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="confirm_password">Confirm Password *</label>
							<input type="password" name="confirm_password" class="form-control required confirmpassword" value="{{ old('confirm_password')}}" autocomplete="off"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputFile">Profile Picture (Max Size : 2 MB)</label>
							<div class="input-group">
								<div class="custom-file">
								<input type="file" class="custom-file-input" id="exampleInputFile">
								<label class="custom-file-label" for="exampleInputFile">Choose file</label>
								</div>
								<div class="input-group-append">
								<span class="input-group-text" id="">Upload</span>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div class="col-md-12">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Assign Roles *</h3>
			</div>
			<div class="card-body no-padding">
				<table id="user-roles" class="table table-striped table-condensed">
					<thead>
						<tr>
							<th class="col-md-1 text-center">#</th>
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
						@forelse($roles as $role)
						<tr>
							<td class="text-center">
								<input type="checkbox" value="{{$role->id}}" name="roles[]" />
							</td>
							<td>{{$role->name}}</td>
						</tr>
						@empty
						<tr>
							<td colspan="2">
								No roles found
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="card-footer text-center">
				<button type="submit" class="btn btn-success margin-r-5 btn-flat btn-sm"><i class="fas fa-check"></i> CREATE USER</button>
				<a href="{{ url('system/users') }}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-undo"></i> CANCEL</a>
			</div>
		</div>
	</div>
</div>
</form>
@endsection