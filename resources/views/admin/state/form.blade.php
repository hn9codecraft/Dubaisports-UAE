<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Country</label>
		<div class="col-sm-8">
			{{ Form::select('country_id', ['' => 'Select Country'] + $countries, old('country_id'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('country_id') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-8">
			{{ Form::text('name', old('name'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('name') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Delivery Charge</label>
		<div class="col-sm-8">
			{{ Form::number('delivery_charge', old('delivery_charge'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('delivery_charge') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.states.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

