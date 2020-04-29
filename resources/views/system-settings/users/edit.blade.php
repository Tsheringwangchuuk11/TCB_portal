@extends('layouts.manager')
@section('page-title', 'Edit User')
@section('content')
<form action="{{ url('system/users/' . $user->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
	<div class="col-md-4">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">General Information</h3>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="name">Name *</label>
					<input type="text" name="name" class="form-control required" value="{{ old('name', $user->name) }}" />
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Username & Password *</h3>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="username">Username (Email) *</label>
					<input type="text" name="username" class="form-control required email" value="{{ old('username', $user->email) }}" />
				</div>
				<div class="form-group">
			        <span class="profile-picture">
			        	<label for="main_photo">Current Profile Picture</label>
			        	<img src="{{ asset($user->avatar ? get_image($user->avatar, 80, 80) : asset('images/no-image.jpg')) }}" class="img-responsive" />
			        </span>
			    </div>
				<div class="form-group">
					<label for="confirm_password">Profile Picture (Max Size : 2 MB)</label>
					<input type="file" name="profile_pic" class="form-control" />
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Assign Roles *</h3>
			</div>
			<div class="card-body no-padding">
				<table id="user-roles" class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th class="col-md-1 text-center">#</th>
							<th>Role *</th>
						</tr>
					</thead>
					<tbody>
						@foreach($roles as $role)
						<tr>
							<td class="text-center">
								<input type="checkbox" value="{{ $role->id }}" name="roles[]" {{ in_array($role->id, $rolesAssigned) ? 'checked' : ''}} />
							</td>
							<td>{{ $role->name }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="card-footer text-center">
				<button type="submit" class="btn btn-success btn-flat btn-sm"><i class="fas fa-check"></i> UPDATE USER</button>
				<a href="{{ url('system/users') }}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-undo"></i> CANCEL</a>
			</div>
		</div>
	</div>
</div>
</form>
@endsection