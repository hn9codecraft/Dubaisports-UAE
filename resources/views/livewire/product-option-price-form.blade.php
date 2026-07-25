<div>
    <div class="box-body">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Enable Option Price</label>
            <div class="col-sm-8" style="padding-top: 10px;">
            <input type="checkbox" wire:model="enableOptionPrice" />
            <input type="hidden" name="additional_price_enable" value="{{ $enableOptionPrice }}" />
            </div>
        </div>
    </div>
    @if($enableOptionPrice == '1')
    <div class="box-body">
        <div class="form-group">
            <div class="box-header with-border">
                <h3 class="box-title">Option Price List</h3>
                <a class="btn btn-primary my-2 my-sm-0" style="float:right;"  wire:click="add">Add</a>
            </div>
            @foreach($optionPriceList as $key => $optionPrice)
            <div class="row" style="padding-top: 5px;">
                <div class="form-group col-md-4">
                    <label class="col-sm-4 control-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.lazy="optionPriceList.{{$key}}.title" class="form-control" placeholder="e.g. 10 Pair Hex Dumbbells"/>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-sm-4 control-label">Slug</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model.lazy="optionPriceList.{{$key}}.slug" class="form-control" placeholder="e.g. 1-to-10-kgs"/>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="col-sm-4 control-label">Price</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" wire:model="optionPriceList.{{$key}}.price" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a class="btn btn-danger my-2 my-sm-0" wire:click="remove({{$key}})">Remove</a>
                </div>
            </div>
            @endforeach
            <input type="hidden" name="price_list" value="{{ json_encode($optionPriceList) }}" />
        </div>
    </div>
    @endif
</div>
