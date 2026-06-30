@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
   <h1>
      Dashboard
      <small>Control panel</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-lg-3 col-xs-6">
         <div class="small-box bg-aqua">
            <div class="inner">
               <h3>{{ $users }}</h3>
               <p>Users</p>
            </div>
            <div class="icon">
               <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-3 col-xs-6">
         <div class="small-box bg-green">
            <div class="inner">
               <h3>{{ $products }}</h3>
               <p>Products</p>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.products.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
      </div>
   </div>
</section>
@stop
@section('css')
{{  Html::style('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}
@stop

@section('js')
{{ Html::script('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}
{{ Html::script('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@stop