@extends('layouts.manager')
@section('page-title', 'Showing User Details')
@section('content')
<form action="{{ url('system/resend-verification-codes/' . $user->id) }}" method="POST">
@csrf
@method('PUT')
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Resend Verification Code</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="text" class="form-control required email" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control required password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control required confirmpassword">
                            </div>
                        </div>  
                    </div>                                                                             
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-check"></i> RESEND CODE</button>
                    <a href="{{ url('system/resend-verification-codes') }}" class="btn btn-flat btn-danger"><i class="fa fa-undo"></i> CANCEL</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection