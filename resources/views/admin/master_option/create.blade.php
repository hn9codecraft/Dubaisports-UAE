@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
	<h1>
		Master Option
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{ route('admin.master-options.index') }}">Master Option</a></li>
		<li class="active">Create</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-8">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create</h3>
            </div>
            {{ Form::open(['url' => route('admin.master-options.store'), 'class' => 'form-horizontal', 'files' => true]) }}
              @include('admin.master_option.form')
            {{ Form::close() }}
          </div>
        </div>
	</div>
</section>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

{{ Html::script('backend/plugins/dynamicform/jquery-dynamic-form.js') }}
  <script type="text/javascript">
    $(document).ready(function(){

				var dynamic_form =$("#attributes").dynamicForm("#add_attribute", "#remove_attribute", {
						limit:20,
						normalizeFullForm: false
				});

				dynamic_form.inject( <?=json_encode(old('attributes.attributes', $attributes))?> );
		});

  </script>
@stop

