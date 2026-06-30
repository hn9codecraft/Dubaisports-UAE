<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">First Name</label>
		<div class="col-sm-8">
			{{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('first_name') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Last Name</label>
		<div class="col-sm-8">
			{{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('last_name') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-8">
			{{ Form::email('email', old('email'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('email') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Password</label>
		<div class="col-sm-8">
			{{ Form::password('password', ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('password') }}</span>
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
	<a type="button" href="{{ route('admin.users.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

