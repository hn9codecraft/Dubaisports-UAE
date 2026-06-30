<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Coupon Code</label>
		<div class="col-sm-8">
			{{ Form::text('coupon_code', old('coupon_code'), ['class' => 'form-control', 'required' ]) }}
		<span class='text-danger'>{{ $errors->first('coupon_code') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Start Date</label>
		<div class="col-sm-8">
			{{ Form::date('start_date', old('start_date'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('start_date') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">End Date</label>
		<div class="col-sm-8">
			{{ Form::date('end_date', old('end_date'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('end_date') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Percentage</label>
		<div class="col-sm-8">
			{{ Form::number('percentage', old('percentage'), ['class' => 'form-control' ]) }}
		<span class='text-danger'>{{ $errors->first('percentage') }}</span>
		</div>
	</div>
</div>
<div class="box-body">
</div>
<div class="box-footer text-center">
	<a type="button" href="{{ route('admin.coupons.index') }}" class="btn btn-flat btn-default">Cancel</a>
	<button type="submit" class="btn btn-flat btn-primary">Save</button>
</div>

