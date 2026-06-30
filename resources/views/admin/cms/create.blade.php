@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
	<h1>
		CMS
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{ route('admin.cms-pages.index') }}">CMS</a></li>
		<li class="active">Create</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create</h3>
            </div>
                {{ Form::open(['url' => route('admin.cms-pages.store'), 'class' => 'form-horizontal', 'files' => true]) }}
                    @include('admin.cms.form')
                {{ Form::close() }}
          </div>
        </div>
	</div>
</section>
@stop
@section('js')
{{ Html::script("backend/bower_components/ckeditor/ckeditor.js") }}
<script type="text/javascript">
	$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('content');
    //bootstrap WYSIHTML5 - text editor
    // $('.textarea').wysihtml5()
  })
</script>
@stop

