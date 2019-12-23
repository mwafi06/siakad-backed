<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/themes/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/themes/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="/themes/css/login.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b>Admin</b>LTE</a>
    </div>
    {!! general()->flashMessage() !!}
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form action="{{ url(route('auth.doLogin')) }}" method="post" class="form-login">
                @csrf
                <p class="login-box-msg">Sign in to start your session</p>
                <div class="input-group mb-3">
                    <input type="username" class="form-control" placeholder="Email" name="username" value="{{ old('username') }}" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 captcha">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding: 0;min-width: 125px;">{!! captcha_img() !!}</span>
                    </div>
                    <input type="text" class="form-control numeric" placeholder="Captcha" name="captcha">
                    <div class="input-group-append">
                        <div class="input-group-text refresh">
                            <span class="fas fa-sync"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        @if(isset($redirect) && !!$redirect)
                            <input type="hidden" name="redirect" value="{{ rawurldecode($redirect) }}" >
                        @endif
                        <button type="submit" class="btn btn-primary btn-block submit"><i class="fas fa-spinner fa-pulse login-loading"></i> Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/themes/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/themes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/themes/js/adminlte.min.js"></script>

<script src="/themes/js/login.js"></script>

</body>
</html>
