@extends('layouts.manager')
@section('page-title', 'Resend Verification Code')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header">
                @component('layouts.components.filter')
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}" placeholder="Name"/>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Username [Email]"/>
                        </div>
                    </div>
                @endcomponent
            </div>
			<div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-center">Account Active</th>
                                <th class="text-center"><i class="fa fa-asterisk"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $users->firstItem() + ($loop->iteration - 1) }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">{!! $user->isActive() == 1 ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-times text-red"></i>' !!}</td>
                                    <td class="text-center">
                                        @if ((int)$privileges->edit== 1)
                                            <a href="{{ url('system/resend-verification-codes/' . $user->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat margin-r-5"><i class="fa fa-edit"></i> Resend Code</a>
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
	</div>
</div>
@endsection
