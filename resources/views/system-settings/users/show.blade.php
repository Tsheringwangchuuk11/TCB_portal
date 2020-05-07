@extends('layouts.manager')
@section('page-title', 'Showing User Details')
@section('buttons')
    <a href="{{ url('change-password')}}" class="btn bg-olive btn-sm btn-flat"><i class="fas fa-key"></i> Change Password</a>
    <a href="{{ url('system/users')}}" class="btn bg-olive btn-sm btn-flat"><i class="fas fa-reply"></i> Back to User List</a>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">User Details</h3>
            </div>
            <div class="card-body card-profile">                                  							
                <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->avatar ? get_image($user->avatar, 128, 128) : asset('images/no-image.jpg')) }}" alt="User profile picture">
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ $user->mobile_no }}</p>
                <div class="row">
                    <div class="col-md-6">                        
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Last Login</b> <a class="pull-right">{{ $user->last_login }}</a>
                            </li>
                        </ul>
                        <hr>
                        @if ($canUpdate === 1)
                            <a href="{{ url('system/users/' . $user->id . '/edit') }}" class="btn btn-success btn-block btn-flat"><b><i class="fas fa-edit"></i> Edit Record</b></a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h3 class="card-title">Assigned Role(s)</h3>
                        <div class="card-body no-padding">
                            <table class="table table-striped">
                                <thead>
                                    <th class="text-center">#</th>
                                    <th>Role(s)</th>
                                </thead>
                                <tbody>
                                    @foreach ($user->roles as $role)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="">{{ $role->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Login Audit</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Login Date & Time</th>
                            <th>IP Address</th>
                            <th>Browser / Operating System</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->userLogs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('M d, Y - H:i') }}</td>
                            <td>{{ $log->login_ip }}</td>
                            <td>{{ $log->user_agent }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection