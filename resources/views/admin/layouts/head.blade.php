<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ env('APP_NAME') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">
  <!-- Bootstrap 3.3.7 -->
  {{ Html::style("backend/bower_components/bootstrap/dist/css/bootstrap.min.css") }}
  <!-- Font Awesome -->
  {{ Html::style("backend/bower_components/font-awesome/css/font-awesome.min.css") }}
  <!-- Ionicons -->
  {{ Html::style("backend/bower_components/Ionicons/css/ionicons.min.css") }}
  <!-- Theme style -->
  {{ Html::style("backend/dist/css/AdminLTE.min.css") }}
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  {{ Html::style("backend/dist/css/skins/_all-skins.min.css") }}
  <!-- Morris chart -->
  {{ Html::style("backend/bower_components/morris.js/morris.css") }}
  <!-- jvectormap -->
  {{ Html::style("backend/bower_components/jvectormap/jquery-jvectormap.css") }}
  <!-- Date Picker -->
  {{ Html::style("backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css") }}
  <!-- Daterange picker -->
  {{ Html::style("backend/bower_components/bootstrap-daterangepicker/daterangepicker.css") }}
  <!-- iCheck for checkboxes and radio inputs -->
  {{ Html::style("backend/plugins/iCheck/all.css") }}
  <!-- bootstrap wysihtml5 - text editor -->
  {{ Html::style("backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}
  {{ Html::style('backend/plugins/toster/toster.min.css') }}
  {{ Html::style('backend/dist/css/style.css') }}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  {{ Html::style("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic") }}
  @yield('css')
  @livewireStyles
  <style type="text/css">
    .pulseWarning {
      display: none !important;
    }
    .form-group {
        margin: 0px !important;
    }
  </style>
</head>