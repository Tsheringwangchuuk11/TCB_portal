<!DOCTYPE html>
<html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>User | Log in</title>
     <!-- Tell the browser to be responsive to screen width -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Font Awesome -->
     <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
     <!-- Ionicons -->
     <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
     <!-- icheck bootstrap -->
     <link href="{{ asset('css/icheck-bootstrap.min.css') }}" rel="stylesheet">
     <!-- Theme style -->
     <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
     <!-- Google Font: Source Sans Pro --> 
     <link href="{{ asset('fonts/css/fontawesome.min.css') }}" rel="stylesheet" />
     <link href="{{ asset('fonts/css/solid.min.css') }}" rel="stylesheet" />
     <link href="{{ asset('fonts/css/regular.min.css') }}" rel="stylesheet" />
 </head>
 <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>User</b>Login</a>
        </div>
       <!-- /.login-logo -->
         <div class="card">
             <div class="card-body login-card-body">
                 <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                     <div class="input-group mb-3">
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                         @error('email')
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                         <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                         </div>
                     </div>

                    <div class="input-group mb-3">
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
                            <div class="icheck-primary">
                                 <input type="checkbox" id="remember">
                                 <label for="remember">
                                 Remember Me
                                 </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                 </form>
                 <div class="social-auth-links text-center mb-3"></div>
                <!-- /.social-auth-links -->
                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
             </div>
          <!-- /.login-card-body -->
         </div>
    </div>
     <!-- /.login-box -->
     <!-- jQuery -->
     <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
     <!-- Bootstrap 4 -->
     <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
     <!-- AdminLTE App -->
     <script src="{{ asset('js/adminlte.min.js') }}" type="text/javascript"></script>
 </body>
</html>
