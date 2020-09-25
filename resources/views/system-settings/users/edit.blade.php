@extends('layouts.manager')
@section('page-title', 'Edit User')
@section('buttons')
    <a href="{{ url('system/users')}}" class="btn bg-olive btn-sm btn-flat"><i class="fas fa-reply"></i> Back to User List</a>
@endsection
@section('content')
<form action="{{ url('system/users/' . $user->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
	<div class="col-md-12">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">General Information</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
                            <label for="">Name <code>*</code></label>
							<input type="text" name="user_name" class="form-control required" value="{{ old('name', $user->user_name) }}" />
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
						<div class="form-group">
                            <label for="">Phone No. <code>*</code></label>
							<input type="text" name="phone_no" class="form-control required" value="{{ old('phone_no', $user->phone_no) }}" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
                            <label for="">Email <code>*</code></label>
							<input type="email" name="email" class="form-control required email" value="{{ old('email', $user->email) }}" />
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
						<div class="form-group">
                            <label for="">User Id <code>*</code></label>
							<input type="text" name="user_id" class="form-control required" value="{{ old('user_id', $user->user_id) }}" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							{{--<span class="profile-picture">
								<label for="main_photo">Current Profile Picture</label>
								<img src="{{ URL::to('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
							</span>--}}
                            <label for="dzongkhag">Dzongkhag</label>
                            <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhag" style="width: 100%;">
                                <option value=""> -Select-</option>
                                @foreach ($dzongkhagLists as $dzongkhagList)
                                    <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $user->location_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                                @endforeach
                            </select>
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
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
				<table id="user-roles" class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Role *</th>
						</tr>
					</thead>
					<tbody>
						@foreach($roles as $role)
						<tr>
							<td class="text-center">
								<input type="checkbox" value="{{ $role->id }}" name="roles[]" {{ in_array($role->id, $rolesAssigned) ? 'checked' : ''}} />
							</td>
							<td class="text-center">{{ $role->name }}</td>
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
