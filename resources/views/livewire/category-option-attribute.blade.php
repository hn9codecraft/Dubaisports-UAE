<div>
    <div class="box-body">
        <div class="form-group">
            <label class="col-sm-2 control-label">Category <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="form-control" name="category_id" wire:model="categoryId" wire:change="getoption($event.target.value)" class="mt-1" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $key => $category)
                    <option value="{{ $key }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @if($options)
    <div class="box-body">
        <div class="form-group row">
        <label class="col-sm-2 control-label">Select Default Option</label>
        @foreach($options as $option)
            <div class="col-md-2">
                <label class="control-label">{{ $option['name'] }}</label>
                <div style="padding-left:20px;">
                    @foreach($option['attribute_values'] as $key => $attributeValue)
                        <p style="margin-bottom:0px;">{{ Form::radio('option_'.$option['id'], $option['id'].'_'.$attributeValue['id']) }} {{ $attributeValue['value'] }}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
        </div>
    </div>
    @endif
</div>
