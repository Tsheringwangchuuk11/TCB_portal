@extends('layouts.manager')
@section('page-title', 'Showing User Details')
@section('buttons')
    <a href="{{ url('change-password')}}" class="btn bg-success btn-sm btn-flat"><i class="fas fa-key"></i> Change Password</a>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <form action="{{ url('update-profile/'.$user->id) }}" method="POST">        
            {{ csrf_field() }}    
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control required" name="user_name" value="{{old('user_name', $user->user_name)}}">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control required" name="email" value="{{old('email', $user->email)}}">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success margin-r-5 btn-flat btn-sm"><i class="fas fa-check"></i> UPADTE</button>
                        <a href="{{ url('dashboard') }}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-undo"></i> CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card card-secondary">
            <div class="card-body card-profile">
                <div class="text-center">
                    <img class="img-circle elevation-21 text-center" src="{{ asset(auth()->user()->avatar ? get_image(auth()->user()->avatar, 128, 128) : asset('img/user-photo/no-image.jpg')) }}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->user_name }}</h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                    <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                    <b>Last Login</b> <a class="pull-right">{{ $user->last_login }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="box-title">Assigned Role(s)</h3>
            </div>
            <div class="box-body no-padding">
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
<div class="row">
    <div class="col-md-12">
        <div class="card no-padding">
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
                        @foreach ($userLogs as $log)
                            <tr>
                                <td>{{ $log->created_at->format('M d, Y - H:i') }}</td>
                                <td>{{ $log->login_ip }}</td>
                                <td>{{ $log->user_agent }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                {{ $userLogs->render() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection