@extends('layouts.manager')
@section('page-title', 'Resend Verification Code')
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
                        <th class="text-center">Account Active</th>
                        <th class="text-center"><i class="fas fa-cog"></i> Action</th>
                    </tr>
				</thead>
				<tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-center">{{ $users->firstItem() + ($loop->iteration - 1) }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{!! $user->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                            <td class="text-center">
                                @if ((int)$privileges->edit== 1)
                                    <a href="{{ url('system/resend-verification-codes/' . $user->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat margin-r-5"><i class="fas fa-edit"></i> Resend Code</a>
                                @endif
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
            {{ $users->appends(['name' => Request::get('name'), 'email' => Request::get('email')])->render() }}
        </div>
	</div>
</div>
@include('layouts.include.confirm_delete')
@endsection