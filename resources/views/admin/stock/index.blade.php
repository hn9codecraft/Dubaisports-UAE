@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
     <h1>
		Stock 
        <small>lists</small>
     </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <livewire:stock-livewire/>
        </div>
    </div>
</section>
@stop
@section('css')
{{  Html::style('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}
{{  Html::style('backend/plugins/sweetalert/sweetalert.css') }}
{{  Html::style('backend/bower_components/select2/dist/css/select2.min.css') }}
@stop
@section('js')
{{ Html::script('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}
{{ Html::script('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}
{{ Html::script('backend/plugins/sweetalert/sweetalert.min.js') }}
{{ Html::script('backend/bower_components/select2/dist/js/select2.full.min.js') }}
<script>
    $('#dataTable').DataTable();
</script>
@stop