@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
	<h1>
		Category
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{ route('admin.categories.index') }}">Category Group</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit</h3>
            </div>
            {{ Form::model($data,['route' => ['admin.categories.update', $data['id']], 'method' => 'PATCH', 'class' => 'form-horizontal', 'files' => true]) }}
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            @include('admin.category.form')
            {{ Form::close() }}
          </div>
        </div>
	</div>
</section>
@stop
@section('css')
{{ Html::style('backend/bower_components/select2/dist/css/select2.min.css') }}
<style>
.select2-container--default .select2-selection--multiple {
	border-radius: 0px !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3c8dbc !important;
    border: 1px solid #3c8dbc !important;
    border-radius: 4px !important;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 4px;
    color: #fff !important;
    padding: 0 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
	color: #fff !important;
}
.image-area {
  padding-top: 5px;
}
</style>
@stop
@section('js')
{{ Html::script('backend/bower_components/select2/dist/js/select2.full.min.js') }}
<script type="text/javascript">
	$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	});
</script>
@stop

