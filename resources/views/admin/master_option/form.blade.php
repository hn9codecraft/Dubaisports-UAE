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
		<label for="inputEmail3" class="col-sm-4 control-label">Sort</label>
		<div class="col-sm-8">
			{{ Form::number('sort', old('sort'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('sort') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Status</label>
		<div class="col-sm-8" style="padding-top:10px;">
		{{ Form::checkbox('status', old('status')) }}
		<span class='text-danger'>{{ $errors->first('sort') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-header with-border">
	<h3 class="box-title">Option Attribute List</h3>
</div>
<div class="box-body" id="attributes">
	{{ Form::hidden('master_option_attribute_id', old('master_option_attribute_id'), ['id' => 'master_option_attribute_id']) }}
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-8">
			<div class="col-sm-8">
				{{ Form::text('value', old('value'), ['class' => 'form-control', 'id' => 'value', 'placeholder' => 'Enter value']) }}
				<span class='text-danger'>{{ $errors->first('value') }}</span>
			</div>
			<div class="row col-sm-4 mb-4" style="float:right;">
				<button class="btn btn-primary my-2 my-sm-0"  id="add_attribute" name="add_attribute">Add</button>
				<button class="btn btn-danger my-2 my-sm-0"  id="remove_attribute" name="remove_attribute">Remove</button>
			</div>
		</div>
	</div>
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.master-options.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

