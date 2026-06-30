@extends('frontend.layouts.layout')
@section('content')
<div class="spacing-y">
<div class="container">
    <div class="page-header">
        <h2 class="mb-0 text-center">Wishlist <span class="text-primary">@if($products) List @else is empty. @endif</span></h2>
    </div>
    <div class="row listing-product">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card position-relative">
                <a href="{{ route('front.products.show',$product['id']) }}" class="product-img"><img src="{{ $product['main_image'] }}"
                        alt="produsct" class="card-img-top img-fluid p-2"></a>
                <div class="card-body bg-light-gray border-top">
                    <span class="d-block mb-1">{{ $product['category']['title'] }}</span>
                    <p class="fw-semibold mb-1 product-heading"><a href="{{ route('front.products.show',$product['id']) }}">{{ $product['title'] }}</a>
                    </p>
                    <p class="text-primary fw-bold product-price d-flex align-items-center flex-wrap">AED {{ number_format($product['discounted_price'],2) }}
                        @if($product['discount_percentage'] > 0)
                            <del class="text-secondary ms-1">AED {{ number_format($product['price'],2) }}</del>
                            <small class="badge ms-1 bg-primary px-2">{{ $product['discount_percentage'] }}% OFF</small>
                        @endif
                    </p>
                    <a href="{{ route('addToCart', [$product['id']]) }}" class="btn btn-info btn-sm px-3 d-inline-block fw-semibold">Add to Cart</a>
                    <a href="{{ route('removeWishlistItem', [$product['id']]) }}" class="btn btn-outline-primary d-inline-block fw-semibold ms-2 px-2 py-3"><i class="fa-solid fa-trash fa-lg"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@stop
