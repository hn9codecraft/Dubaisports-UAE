@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
	<h1>
		Master Option
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{ route('admin.master-options.index') }}">Master Option</a></li>
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
            {{ Form::model($data,['route' => ['admin.master-options.update', $data['id']], 'method' => 'PATCH', 'class' => 'form-horizontal', 'files' => true]) }}
            <input type="hidden" name="id" value="{{ $data['id'] }}">
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

				@if($errors)
						var detail_Errors = <?=json_encode($errors->toArray())?>;
						$.each(detail_Errors, function(id,msg){
							var id_arr = id.split('.');

						if (id_arr[3] == "value") {
							$('#'+id_arr[3]+id_arr[id_arr.length-2]).closest('div').find('span').text(msg[0]);
						}
						if (id_arr[3] == "master_option_attribute_id") {
							$('#'+id_arr[3]+id_arr[id_arr.length-2]).closest('div').find('span').text(msg[0]);
						}
					});
				@endif

		});

  </script>
@stop

