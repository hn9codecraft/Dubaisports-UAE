<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Title</label>
		<div class="col-sm-8">
			{{ Form::text('title', old('title'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('title') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Sort</label>
		<div class="col-sm-8">
			{{ Form::number('sort', old('sort'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('sort') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Icon</label>
		<div class="col-sm-8">
			{{ Form::file('icon', old('icon'), ['class' => 'form-control' ]) }}
			<span class='text-danger'>{{ $errors->first('icon') }}</span>
			@if(isset($data) && $data['icon'])
			<div class="icon-area">
				<img src="{{ $data['icon'] }}" height="100" width="100" alt="Preview">
			</div>
			<!-- <a onclick="removeProfile({{ $data['icon'] }})" class="remove-image" href="#" style="display: inline; height:20px; width: 20px;">&#215;</a> -->
			@endif
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Status</label>
		<div class="col-sm-8">
		{{ Form::checkbox('status', old('status')) }}
		<span class='text-danger'>{{ $errors->first('status') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.category-groups.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

