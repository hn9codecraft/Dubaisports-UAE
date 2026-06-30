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

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-size: cover; background-image:url({{asset('assets/homepage.jpg')}})">
<div class="login-box">
  <div class="login-logo" style="color: #ee544c">
    <a href="#" style="color: #3c8dbc"><b>{{ env('APP_NAME') }} | </b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('admin.login') }}" method="post">
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
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="{{ route('admin.password.request') }}">I forgot my password</a><br>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- jQuery 3 -->
{{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
<!-- Bootstrap 3.3.7 -->
{{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
<!-- iCheck -->
{{ Html::script('plugins/iCheck/icheck.min.js') }}
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
