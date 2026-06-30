<div>
    <div class="box box-info">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Product <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <select class="form-control" wire:model="productId" wire:change="getReport" class="mt-1" required>
                        <option value="">Select Product</option>
                        @foreach($products as $key => $product)
                        <option value="{{ $key }}">{{ $product }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Type <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <select class="form-control" wire:model="type" class="mt-1" required>
                        <option value="">Select Type</option>
                        <option value="Credit">Credit</option>
                        <option value="Debit">Debit</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Qty <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="number" wire:model="qty" class="form-control" placeholder="Enter Qty" required/>
                </div>
            </div>
        </div>
        <div class="box-footer text-center">
            <a wire:click="submit" class="btn btn-flat btn-primary">Save</a>
        </div>
    </div>
    @if($histories)
    <div class="box box-info">
        <div class="box-header">
            <h4>Product Stock History</h4>
            <div class="box-header">
                <h4>Product Stock History</h4>
                <h4>Available Stock : <b>{{ $totalQty }}</b></h4>
                <a href="javascript:void(0);" wire:click="clearStockHistory" class="btn btn-danger icon-btn p-5">Clear Stock History</a>
            </div>
        </div>
        <div class="box-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                    <tr class="btn-primary">
                        <th>Product</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                    <tr>
                        <td>{{ $history['product']['title'] }}</td>
                        <td>{{ $history['type'] }}</td>
                        <td>{{ $history['qty'] }}</td>
                        <td>{{ $history['note'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="btn-primary">
                        <th>Product</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Note</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @endif
</div>
