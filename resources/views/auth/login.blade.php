<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TCB | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('css/molhr_favicon.png') }}" type="image/x-icon"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg text-lg text-dark">Login</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="login_name" type="text" class="form-control {{ $errors->has('user_id') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('user_id') ?: old('email')}}" required autofocus  placeholder="Username">
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
                <div class="row">
                    <div class="col-8">
                        <p class="mb-1">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">I forgot my password</a><br>
                            @endif
                        </p>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
