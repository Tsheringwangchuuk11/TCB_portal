@extends('layouts.manager')
@section('page-title', 'Showing User Details')
@section('content')
<form action="{{ url('system/resend-verification-codes/' . $user->id) }}" method="POST">
@csrf
@method('PUT')
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Resend Verification Code</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="text" class="form-control required email" name="email" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control required password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control required confirmpassword">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-upload"></i> RESEND CODE</button>
                    <a href="{{ url('system/resend-verification-codes') }}" class="btn btn-flat btn-danger"><i class="fa fa-undo"></i> CANCEL</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection