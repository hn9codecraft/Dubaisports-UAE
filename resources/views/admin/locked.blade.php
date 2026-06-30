
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ env('APP_NAME') }} | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  {{ Html::style('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
  <!-- Font Awesome -->
  {{ Html::style('backend/bower_components/font-awesome/css/font-awesome.min.css') }}
  <!-- Ionicons -->
  {{ Html::style('backend/bower_components/Ionicons/css/ionicons.min.css') }}
  <!-- Theme style -->
  {{ Html::style('backend/dist/css/AdminLTE.min.css') }}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b>{{ env('APP_NAME') }} | </b>Admin</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">{{ $user['name'] }}</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{ asset('backend/dist/img/user1-128x128.jpg') }}" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="{{ route('admin.login') }}" method="POST">
       @csrf
      <div class="input-group">
        <div>
                  <input id="email" type="hidden" class="form-control" name="email" placeholder="E-mail Address" value="{{ $user['email'] }}" required autofocus>
        </div>
              <div>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
              </div>
        <!-- <input type="password" class="form-control" placeholder="password"> -->

        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your password to retrieve your session
  </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
{{ Html::script('backend/bower_components/jquery/dist/jquery.min.js') }}
<!-- Bootstrap 3.3.7 -->
{{ Html::script('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
</body>
</html>
