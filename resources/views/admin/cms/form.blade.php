<div class="box-body">
	<div class="form-group">
		<label for="" class="col-sm-2 control-label">Title <span class="text-danger">*</span></label>
		<div class="col-sm-8">
			{{ Form::text('title', old('title'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('title') }}</span>
		</div>
	</div>
</div>
<div class="box-body pad">
	<div class="form-group">
		<label for="" class="col-sm-2 control-label">Content</label>
		<div class="col-sm-8">
			{{ Form::textarea('content', old('content'), ['class' => 'form-control', 'id' => 'content', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('content') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="" class="col-sm-2 control-label">Sort</label>
		<div class="col-sm-2">
			{{ Form::number('sort', old('sort'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('sort') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.cms-pages.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

