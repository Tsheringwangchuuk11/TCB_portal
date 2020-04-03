@extends('layouts.manager')
@section('page-title', 'Change Password')
@section('content')
<form action="{{ url('change-password') }}" method="POST">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="box  box-default">
            <div class="box-header">
                <h3 class="box-title">Update Your Password</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Old Password</label>
                    <input type="password" name="old_password" class="form-control required" value="" />
                </div>
                <div class="form-group">
                    <label for="name">New Password</label>
                    <input type="password" name="new_password" class="form-control required" value="" />
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control required" value="" />
                </div>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-success btn-flat btn-sm"><i class="fa fa-upload"></i> UPDATE PASSWORD</button>
                <a href="{{ url('dashboard') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-undo"></i> CANCEL</a>
            </div>
        </div>
    </div>
</div>
</form>
@endsection