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
		<label for="inputEmail3" class="col-sm-4 control-label">Banner Title Fade In Position</label>
		<div class="col-sm-8">
			{{ Form::select('title_fade_in', ['Left' => 'Left', 'Right' => 'Right'], old('title_fade_in'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('title_fade_in') }}</span>
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
			<div class="icon-area">
				<img src="{{ $data['image'] }}" height="100" width="100" alt="Preview">
			</div>
			<!-- <a onclick="removeProfile({{ $data['icon'] }})" class="remove-image" href="#" style="display: inline; height:20px; width: 20px;">&#215;</a> -->
			@endif
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.banners.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

