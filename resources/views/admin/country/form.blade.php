<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-8">
			{{ Form::text('name', old('name'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('name') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Iso Code</label>
		<div class="col-sm-8">
			{{ Form::text('iso_code', old('iso_code'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('iso_code') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.countries.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

