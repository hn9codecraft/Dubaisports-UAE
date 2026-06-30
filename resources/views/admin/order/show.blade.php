@extends('admin.layouts.layout')
@section('content')
<section class="content-header">
    <h1>
        Order
        <small>#{{ $data['id'] }}</small>
    </h1>
</section>

<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                @if($data['user'])
                <i class="fa fa-globe"></i> {{ $data['user']['first_name'] }} {{ $data['user']['last_name'] }} - ( M: {{ $data['user']['phone'] }} )
                @endif
                <small class="pull-right">Date: {{ date('m/d/Y', strtotime($data['created_at'])) }}</small>
            </h2>
        </div>
    </div>

    <div class="row invoice-info">
        <!-- <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>Admin, Inc.</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (804) 123-5432<br>
                Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1d74737b725d7c71707c6e7c7878796e6968797472337e7270">[email&#160;protected]</a>
            </address>
        </div> -->
        @if($data['address'])
        <div class="col-sm-4 invoice-col">
            To
            <address>
                @php
                    $address = json_decode($data['address'], true);
                    $country = Helper::getCountry($address['country_id']);
                    $state = Helper::getState($address['state_id'] ?? "");
                @endphp
                <!-- <strong>John Doe</strong><br> -->
                {{ $address['address_line_1'] }}, {{ $address['address_line_2'] }}<br>
                {{ $address['city'] }}, @if($state) {{ $state['name'] }} @endif, @if($country) {{ $country['iso_code'] }} @endif<br>
                <!-- Phone: (555) 539-1037<br> -->
                <!-- Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3953565157175d565c795c41585449555c175a5654">[email&#160;protected]</a> -->
            </address>
        </div>
        @endif
        <div class="col-sm-4 invoice-col">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Update Status</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="updateSttate" name="status" placeholder="Update Order Status">
                            <option value="In Process" @if($data['status'] == 'In Process') selected @endif>In Process</option>
                            <option value="Shipped" @if($data['status'] == 'Shipped') selected @endif>Shipped</option>
                            <option value="Delivered" @if($data['status'] == 'Delivered') selected @endif>Delivered</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 invoice-col">
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Payment Mode:</b> {{ $data['getPayment']['payment_type'] }}<br>
            <b>Delivery Mode:</b> {{ $data['delivery_type'] }}<br>
            @if(!empty($data['getPayment']['txn_id']))
            <b>Transaction Id:</b> {{ $data['getPayment']['txn_id'] }}<br>
            @endif
        </div>
    </div>
    <br/>
    <div class="clearfix"></div>
    <div class="row mt-5">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(json_decode($data['products'], true) as $product)
                    <tr>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['product']['title'] }}</td>
                        <td>{{ $product['product']['id'] }}</td>
                        <td> - </td>
                        <td>@if(isset($product['productDiscountPrice'])) {{ $product['productDiscountPrice'] }} @else {{ $product['price'] }} @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <!-- <p class="lead">Payment Methods:</p>
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                {{ $data['shipping_note'] }}
            </p> -->
        </div>
        <div class="col-xs-6">
            <p class="lead">Amount Due {{ date('m/d/Y', strtotime($data['getPayment']['created_at'])) }}</p>
            <div class="table-responsive">
                <table class="table">
                    <!-- <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                    </tr> -->
                    <tr>
                        <th>Tax (5%)</th>
                        <td>AED {{ number_format($data['vat'], 2) }}</td>
                    </tr>
                    <tr>
                        <th>Shipping:</th>
                        <td>AED {{ number_format($data['delivery_charge'], 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>AED {{ number_format($data['getPayment']['price'], 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <!-- <div class="row no-print">
        <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>
            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button>
        </div>
    </div> -->
</section>
@stop
@section('js')
<script>
    $('#updateSttate').on('change', function(){
        var status = $(this).val();
        var token = "{{ csrf_token() }}";
        $.ajax({
            url: '{{ route("admin.orders.update", $data["id"]) }}',
            type: "PUT",
            data: { _token: token, status },
            success: function(data){
                if(data.code == 200) {
                    toastr.success('Order status has been updated!');
                }
            }
        });
    });
    
</script>
@stop