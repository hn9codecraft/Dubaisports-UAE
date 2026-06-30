<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Select Option</label>
		<div class="col-sm-8">
			{{ Form::select('category_group_id', $categoryGroups, old('category_group_id'), ['class' => 'form-control', 'placeholder' => 'Select Category Group' ]) }}
		<span class='text-danger'>{{ $errors->first('category_group_id') }}</span>
		</div>
	</div>
</div>
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
		<label for="inputEmail3" class="col-sm-4 control-label">Image</label>
		<div class="col-sm-8">
			{{ Form::file('image', old('image'), ['class' => 'form-control' ]) }}
			<span class='text-danger'>{{ $errors->first('image') }}</span>
			@if(isset($data) && $data['image'])
				<div class="image-area">
					<img src="{{ $data['image'] }}" height="100" width="100" alt="Preview">
					<!-- <a onclick="removeProfile({{ $data['image'] }})" class="remove-image" href="#" style="display: inline;">&#215;</a> -->
				</div>
			@endif
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Select Option</label>
		<div class="col-sm-8">
			{{ Form::select('option_ids[]', $masterOptions, old('option_ids[]'), ['class' => 'form-control select2', 'data-placeholder' => 'Select Option', 'multiple' => 'multiple' ]) }}
		<span class='text-danger'>{{ $errors->first('option_ids[]') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Status</label>
		<div class="col-sm-8" style="padding-top: 10px;">
		{{ Form::checkbox('status', old('status')) }}
		<span class='text-danger'>{{ $errors->first('sort') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.categories.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

