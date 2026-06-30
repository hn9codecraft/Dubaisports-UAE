@extends('frontend.layouts.layout')
@section('content')
<div id="products" class="spacing-y">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-md-0 mb-4">
                <div id="product_images" class="carousel slide inner_slider mb-4 position-sticky">
                    <div class="carousel-inner text-center">
                        <div class="carousel-item active">
                            <a href="#" data-src="{{ $product['main_image'] }}" class="fancybox-img"
                                data-fancybox="product">
                                <img src="{{ $product['main_image'] }}" title="product 1" class="img-fluid">
                            </a>
                        </div>
                        @if($product['other_images'])
                        @foreach($product['other_images'] as $otherImage)
                        <div class="carousel-item">
                            <a href="#" data-src="{{ env('APP_URL').$otherImage }}" class="fancybox-img"
                                data-fancybox="product">
                                <img src="{{ env('APP_URL').$otherImage }}" title="product 2" class="img-fluid">
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    @if($product['other_images'])
                    <a href="#product_images" class="carousel-control-prev prev-arrow" data-bs-slide="prev"><i
                            class="fa-solid fa-angle-left"></i></a>
                    <a href="#product_images" class="carousel-control-next next-arrow" data-bs-slide="next"><i
                            class="fa-solid fa-chevron-right"></i></a>
                    @endif
                    <div class="carousel-thumbs position-relative w-100 mt-4 carousel-indicators d-none d-md-flex m-0">
                        <a href="#product_images" class="active d-inline-block thumb-box mb-2" data-bs-slide-to="0">
                            <img src="{{ $product['main_image'] }}" title="product 1" class="img-fluid">
                        </a>
                        @if($product['other_images'])
                        @foreach($product['other_images'] as $key => $otherImage)
                        <a href="#product_images" class="d-inline-block thumb-box mb-2" data-bs-slide-to="{{ $key + 1 }}">
                            <img src="{{ env('APP_URL').$otherImage }}" title="tshirt black front"
                                class="img-fluid">
                        </a>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
            <livewire:front.product-basic-info :product="$product"/>
        </div>
    </div>
</div>
<div class="product-tab py-5 bg-light-gray border-top border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="producttab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link active fw-semibold border-0 fs-5" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#ProductDescription"
                            aria-controls="ProductDescription" aria-selected="false">Product Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link border-0 fw-semibold fs-5" id="Specification-tab"
                            data-bs-toggle="tab" data-bs-target="#Specification"
                            aria-controls="Specification" aria-selected="true">Specification</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link border-0 fw-semibold fs-5" id="Delivery-tab"
                            data-bs-toggle="tab" data-bs-target="#Delivery"
                            aria-controls="Delivery" aria-selected="true">Delivery, Warranty & Installation</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ProductDescription" role="tabpanel"
                        aria-labelledby="ProductDescription-tab" tabindex="0">
                        <div class="p-4">
                            {!! $product['description'] !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Specification" role="tabpanel"
                        aria-labelledby="Specification-tab" tabindex="0">
                        <div class="table-responsive p-4">
                            <table class="table table-striped table-bordered bg-white">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="40%"><strong> Title </strong></th>
                                        <th width="60%"><strong>Value</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product['productSpecification'] as $key => $specification)
                                        @if($specification['option'])
                                        <tr>
                                            <td width="40%"><strong>{{ $specification['option']['name'] }}</strong></td>
                                            <td width="60%"><span class="text-dark">
                                            @if(isset($specification['optionAttribute']))
                                            {{ $specification['optionAttribute']['value'] }}
                                            @endif
                                            </span></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Delivery" role="tabpanel"
                    aria-labelledby="Delivery-tab" tabindex="0">
                    <div class="p-4">
                        {!! $product['description_2'] !!}
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop 
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css">
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
@stop
