@extends('frontend.layouts.layout')
@section('content')
<div class="order-details spacing-y">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-5 text-center">My <span class="text-primary">Orders</span> </h2>
        </div>
        <div class="row">
            @include('frontend.layouts.customer_sidebar')
            <div class="col-md-9">
            @if($orders)
                @foreach($orders as $key => $order)
                @php
                    $products = json_decode($order['products'], true);
                    $address = json_decode($order['address'], true);
                    
                    $statusColor = 'bg-secondary';
                    if ($order['status'] == 'In Process') $statusColor = 'bg-warning text-dark';
                    if ($order['status'] == 'Shipped') $statusColor = 'bg-info text-dark';
                    if ($order['status'] == 'Delivered') $statusColor = 'bg-success';
                @endphp
                <div class="order-card p-4 mb-4 bg-white border border-secondary shadow-sm rounded">
                    <!-- Header -->
                    <div class="d-flex flex-wrap justify-content-between border-bottom pb-3 mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">Order #{{ $order['id'] }}</h5>
                            <small class="text-muted"><i class="fa-regular fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($order['created_at'])->format('d M, Y h:i A') }}</small>
                        </div>
                        <div class="text-md-end mt-3 mt-md-0">
                            <span class="badge {{ $statusColor }} fs-6 px-3 py-2 rounded-pill">{{ $order['status'] }}</span>
                            <div class="mt-2 fw-bold fs-5 text-primary">AED {{ number_format($order['get_payment']['price'] ?? 0, 2) }}</div>
                        </div>
                    </div>
                    
                    <!-- Address Section -->
                    @if($address)
                    <div class="mb-4 bg-light p-3 rounded border border-light">
                        <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-location-dot text-primary me-2"></i> Delivery Address</h6>
                        <p class="mb-0 text-secondary">
                            {{ $address['address_line_1'] ?? '' }}
                            @if(!empty($address['address_line_2']))
                                , {{ $address['address_line_2'] }}
                            @endif
                            @if(!empty($address['city']))
                                <br>{{ $address['city'] }}
                            @endif
                        </p>
                    </div>
                    @endif
                    
                    <!-- Order Summary (Products) -->
                    <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-box-open text-primary me-2"></i> Order Summary</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_array($products))
                                    @foreach($products as $item)
                                    <tr class="border-bottom">
                                        <td class="py-3">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item['product']['main_image'] ?? '' }}" alt="product" class="img-fluid border rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                                <div>
                                                    <p class="mb-0 fw-semibold text-dark">{{ $item['product']['title'] ?? 'Product Name' }}</p>
                                                    @if(!empty($item['selectedVariant']))
                                                        <small class="text-muted d-block mt-1">Variant: {{ $item['selectedVariant'] }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold text-secondary">{{ $item['quantity'] ?? 1 }}</td>
                                        <td class="text-end fw-semibold text-dark">AED {{ number_format(($item['productDiscountPrice'] ?? $item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            @else
            @endif
            </div>
        </div>
    </div>
</div>
@stop