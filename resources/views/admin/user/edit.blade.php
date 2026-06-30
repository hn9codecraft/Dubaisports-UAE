@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
	<h1>
		User
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{ route('admin.users.index') }}">User</a></li>
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
            {{ Form::model($data,['route' => ['admin.users.update', $data['id']], 'method' => 'PATCH', 'class' => 'form-horizontal', 'files' => true]) }}
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            @include('admin.user.form')
            {{ Form::close() }}
          </div>
        </div>
	</div>
</section>
@stop

