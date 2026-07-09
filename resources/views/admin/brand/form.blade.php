<div class="box-body">
	<div class="form-group">
		<label for="name" class="col-sm-4 control-label">Name *</label>
		<div class="col-sm-8">
			{{ Form::text('name', old('name'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('name') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="description" class="col-sm-4 control-label">Description</label>
		<div class="col-sm-8">
			{{ Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 4 ]) }}
		<span class='text-danger'>{{ $errors->first('description') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="link" class="col-sm-4 control-label">Link</label>
		<div class="col-sm-8">
			{{ Form::text('link', old('link'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('link') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="image" class="col-sm-4 control-label">Image *</label>
		<div class="col-sm-8">
			{{ Form::file('image', ['class' => 'form-control' ]) }}
			<span class='text-danger'>{{ $errors->first('image') }}</span>
			@if(isset($data) && $data['image'])
			<div class="icon-area" style="margin-top: 10px;">
				<img src="{{ $data['image'] }}" height="100" width="100" alt="Preview">
			</div>
			@endif
		</div>
	</div>
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.brands.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>
