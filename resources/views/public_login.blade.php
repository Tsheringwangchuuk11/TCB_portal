<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TCB | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('css/tcb_favicon.png') }}" type="image/x-icon"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
     <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
  {{--     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
    <style>
        .logo {
            height: 180px;
            width: 180px;
        }
        .login-box {
            padding-top:0px;
        }
        .login-logo {
            margin-bottom:0px;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"> <img src="{{ asset('css/tcb_favicon.png') }}" class="img-responsive logo"></a>
    </div>
    <div class="card" id="login-card-body">
        <div class="card-body login-card-body">
            <p class="login-box-msg text-lg text-dark">Login</p>
            <form method="POST" action="{{ url('/enduser_dashboard') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="login_name" type="text" class="form-control {{ $errors->has('user_id') || $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('user_id') ?: old('email')}}" required autofocus  placeholder="UserId Or Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if ($errors->has('user_id') || $errors->has('phone_no') || $errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_id') ?: $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
					<div class="col-md-12 col-lg-12">
                    @if (Route::has('password.request'))
						<a href="{{ route('password.request') }}" class="link float-right mr-3"  onclick="forgotPassword()">Forgot Password ?</a>
                    @endif
                    </div>
				</div>
				<hr>
				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-block">Sign In</button>
				</div>
                <br>
                <div class="text-center">
                    <p>Not a member? <a href="#" onclick="showForm('R')">Register</a></p>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<form id="register-form">
	@csrf
	<div class="col-md-12">
		<div class="card card-secondary" id="register-card-body" style="display:none;">
			<div class="card-header" style="margin-top: -14px;">
                <h3 class="card-title">Register</h3>
			</div>
			<div class="card-body">
            <input type="hidden" value="2" name="roles[]">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
                            <label for="name">Name <code>*</code></label>
							<input type="text" name="user_name" id="user_name" class="form-control required" value="{{ old('name')}}" autocomplete="off" />
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
						<div class="form-group">
                            <label for="name">Mobile No. <code>*</code></label>
							<input type="text" name="phone_no" id="phone_no" class="form-control required" value="{{ old('name')}}" autocomplete="off" maxlength="8"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
                            <label for="name">Email <code>*</code></label>
							<input type="email" name="email" id="email" class="form-control required" value="{{ old('name')}}" autocomplete="off"/>
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
						<div class="form-group">
                            <label for="username">User Id <code>*</code></label>
							<input type="text" name="user_id" id="user_id" class="form-control required" value="{{ old('username')}}" autocomplete="off"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
                            <label for="password">Password <code>*</code></label>
							<input type="password" name="password" id="password" class="form-control required password" value="{{ old('password')}}" autocomplete="off"/>
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
						<div class="form-group">
                            <label for="confirm_password">Confirm Password <code>*</code></label>
							<input type="password" name="confirm_password" id="confirm_password" class="form-control required confirmpassword" value="{{ old('confirm_password')}}" autocomplete="off"/>
						</div>
					</div>
				</div>
			</div>
            <div class="text-center">
                <button class="btn btn-success" id="submit">Submit</button>
			</div>
            <hr>
            <div class="text-center">
                <p>Already a member? <a href="#" onclick="showForm('L')">Login</a></p>
            </div>
		</div>
	</div>
</form>
  

<!-- /.login-box -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
function showForm(param)
{
    if(param == "R")
    {
        $("#register-card-body").show();
        $("#login-card-body").hide();
    }
    else
    {
        $("#login-card-body").show();
        $("#register-card-body").hide();
    }

}

$('#register-form').on('submit',function(e){
    e.preventDefault();

    let user_name = $('#user_name').val();
    let phone_no = $('#phone_no').val();
    let email = $('#email').val();
    let user_id = $('#user_id').val();
    let password = $('#password').val();

    $.ajax({
        url: "/register",
        type:"POST",
        data:{
        "_token": "{{ csrf_token() }}",
        user_name:user_name,
        phone_no:phone_no,
        email:email,
        user_id:user_id,
        password:password,
        },
        success:function(response){
        console.log(response);
        if (response) {
            $('#success-message').text(response.success); 
            $("#register-form")[0].reset(); 
        }
        }
    });
});
</script>
</body>
</html>
