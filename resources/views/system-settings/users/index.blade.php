@extends('layouts.manager')
@section('page-title', 'Users')
@section('buttons')
@if ((int)$privileges["create"] == 1)
    <a href="{{ url('system/users/create')}}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> Add User</a>
@endif
@endsection
@section('content')
<div class="card">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-striped table-bordered m-0">
				<thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Last Login</th>
                        <th class="text-center">Account Active</th>
                        <th class="text-center"><i class="fas fa-cog"></i> Action</th>
                    </tr>
				</thead>
				<tbody>
                    <?php $count=1; ?>
                    @forelse($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->last_login }}</td>
                            <td class="text-center">{!! $user->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                            <td class="text-center">
                                <a href="#" class="formConfirm btn btn-xs btn-flat {{ $user->isActive() == 1 ? 'btn-danger' : 'btn-success' }}">
                                    <i class="fa fa-times"></i> @if ($user->isActive() == 1) Disable @else Enable @endif
                                    <a data-form="#frmDelete-{!! $user->id !!}" data-title="Disable {!! $user->name !!}" data-message="Are you sure you want to @if ($user->isActive() == 1) disable @else enable @endif this user?"></a>
                                </a>
                                <form action={{ url("system/users/disable-toggle") }} method="POST" style="display: none" id="{{ 'frmDelete-' . $user->id }}">
                                    @csrf
                                    <input type="hidden" name="id", value="{{ $user->id }}">
                                </form>
                                <a href="{{ url('system/users/' . $user->id) }}" class="btn btn-primary btn-xs btn-flat" title="Detail"><i class="fas fa-list"></i> Detail</a>
                                @if ((int)$privileges["edit"] == 1)
                                    <a href="{{ url('system/users/' . $user->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                @endif
                                <a href="{{ url('system/users/reset-password/' . $user->id) }}" class="btn btn-warning btn-xs btn-flat"><i class="fas fa-list"></i> Reset Password</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">No users to be displayed</td>
                        </tr>
                    @endforelse
				</tbody>
			</table>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! $users->appends(['name' => Request::get('name'), 'email' => Request::get('email')])->render() !!}
        </div>
	</div>
</div>
@include('layouts.include.confirm_delete')
@endsection
