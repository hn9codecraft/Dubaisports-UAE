@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
	<h1>
		Product
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{ route('admin.products.index') }}">Products</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit</h3>
            </div>
            {{ Form::model($data,['route' => ['admin.products.update', $data['id']], 'method' => 'PATCH', 'class' => 'form-horizontal', 'files' => true]) }}
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            @include('admin.product.form')
            {{ Form::close() }}
          </div>
        </div>
	</div>
</section>
@stop
@section('js')
{{ Html::script("backend/bower_components/ckeditor/ckeditor.js") }}
<script type="text/javascript">
  function removeOtherImage(path, index, productId) {
    var token = '{{ csrf_token() }}';
    $.ajax({
        url: '{{ route("admin.products.otherimage.delete") }}',
        data: { path, productId, index, _token: token },
        type: "POST",
        success: function(data){
            if(data.success) {
              $('.remove_'+ index).hide();
              toastr.success(data.message);
            } else {
              toastr.error(data.message);
            }
        }
    });
  }
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('product_details');
    CKEDITOR.replace('product_description');
    CKEDITOR.replace('product_other_details');
    //bootstrap WYSIHTML5 - text editor
    // $('.textarea').wysihtml5()
  })
</script>
@stop

