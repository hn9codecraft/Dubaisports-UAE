@extends('frontend.layouts.layout')
@section('content')
<div class="order-details spacing-y">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-0 text-center">My <span class="text-primary">Order</span> </h2>
        </div>
        <div class="row">
            @if($orders)
                @foreach($orders as $key => $order)
                @php
                    $products = json_decode($order['products'], true);
                @endphp
                <div class="order-flow p-3 mb-5 bg-light border border-secondary rounded">
                    <div class="row mb-3 border-bottom mb-3 pb-3 border-secondary align-items-center">
                        <div class="col-md-1">
                            <img src="{{ $products[array_key_first($products)]['product']['main_image'] }}" alt="product_1" class="img-fluid border">
                        </div>
                        <div class="col-md-8">
                            <p class="fw-semibold mb-1 fs-5 product-heading"><span class="text-secondary">Order ID:</span>  {{ $order['id'] }}</a></p>
                            <p class="fw-semibold mb-1 fs-5 product-heading"><span class="text-secondary">Order name:</span> {{ $products[array_key_first($products)]['product']['title'] }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="fw-bold product-price d-flex fs-5 mb-1 justify-content-end align-items-center"><span class="fw-semibold me-2">Total </span></p>
                            <p class="fw-bold product-price d-flex fs-5 mb-1 justify-content-end align-items-center">  <span class="text-primary fs-4 fw-semibold">AED {{ number_format($order['get_payment']['price'], 2) }}</span></p>
                        </div>
                    </div>
                    <div class="p-md-5 p-4">
                        <ul class="order_status list-unstyled d-flex align-items-center justify-content-between">
                            <li class="text-center  position-relative @if($order['status'] == 'In Process') checked @endif">
                                <i class="fa-solid fa-check fa-2x bg-white rounded-circle"></i>
                                <h4 class="my-4 fs-5 fw-semibold">Order confirmed</h4>
                            </li>
                            <li  class="text-center  position-relative @if($order['status'] == 'Shipped') checked @endif">
                                <i class="fa-solid fa-dolly fa-2x bg-white rounded-circle"></i>
                                <h4 class="my-4 fs-5 fw-semibold">Order Shipping </h4>
                            </li>
                            <li  class="text-center  position-relative @if($order['status'] == 'Delivered') checked @endif">
                                <i class="fa-solid fa-truck-fast fa-2x bg-white rounded-circle"></i>
                                <h4 class="my-4 fs-5 fw-semibold">Order Deliverd</h4>
                            </li>

                        </ul>
                    </div>
                </div>
                @endforeach
            @else
            @endif
        </div>
    </div>
</div>
@stop