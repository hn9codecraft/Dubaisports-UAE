<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> {{ env('APP_NAME') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">
  <!-- Bootstrap 3.3.7 -->
  {{ Html::style('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
  <!-- Font Awesome -->
  {{ Html::style('backend/bower_components/font-awesome/css/font-awesome.min.css') }}
  <!-- Ionicons -->
  {{ Html::style('backend/bower_components/Ionicons/css/ionicons.min.css') }}
  <!-- Theme style -->
  {{ Html::style('backend/dist/css/AdminLTE.min.css') }}
  {{ Html::style('backend/dist/css/style.css') }}
  <!-- iCheck -->
  {{ Html::style('backend/plugins/iCheck/square/blue.css') }}
    <style>
        .login-box {
            width: 400px;
        }
    </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-size: cover; background-image:url({{asset('assets/homepage.jpg')}})">
<div class="login-box">
  <div class="login-logo" style="color: #ee544c">
    <a href="#" style="color: #3c8dbc; font-size: 30px;"><b>{{ env('APP_NAME') }} | </b>Reset Password</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('admin.password.email') }}" method="post">
        @csrf

      <div class="form-group has-feedback">
        <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-12">
          <!-- <div class="checkbox icheck" style="padding-left: 20px">
            <label>
              <input type="checkbox" name="remember_me"> Remember Me
            </label>
          </div> -->
          <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
{{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
<!-- Bootstrap 3.3.7 -->
{{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
<!-- iCheck -->
{{ Html::script('plugins/iCheck/icheck.min.js') }}
</body>
</html>
