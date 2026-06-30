@extends('frontend.layouts.layout')
@section('content')
<div class="d-flex flex-column">
<livewire:service-offer/>
<!-- <div class="offer-banner">
    <a href="https://dubaisportsuae.com/terms-condition">
    <img src="{{ env('APP_URL').'front/images/offer-banner.png' }}" class="img-fluid w-100" alt="">
    </a>
</div> -->
<div class="banner__slider order-lg-last order-first">
    <div class="slider stick-dots">
        @if($banners)
            @foreach($banners as $key => $banner)
            <div class="slide">
                <div class="slide__img overflow-hidden">
                    <a href="https://dubaisportsuae.com/terms-condition">
                    <img src="{{ $banner['image'] }}" class="full-image img-fluid animated w-100"
                        data-animation-in="zoomInImage" />  
                    </a>
                </div>
                @if($banner['title_fade_in'] == 'Left')
                <div class="slide__content slide__content__left" data-animation-in="fadeInLeft">
                @else
                <div class="slide__content slide__content__right" data-animation-in="fadeInRight">
                @endif
                    <div class="slide__content_details text-xl-start text-lg-start text-center">
                        {!! $banner['title'] !!}
                        <!-- <h2 class="animated">Being the Best <span class="d-block"><span
                                    class="text-primary">Fitness</span> Products</span></h2>
                        <h5 class="animated">Best Quality Equipments and Range of Products</h5> -->
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        <!-- <div class="slide">
            <div class="slide__img overflow-hidden">
                <img src="{{ env('APP_URL').'front/images/banner2.jpg' }}" class="full-image img-fluid animated"
                    data-animation-in="zoomInImage" />
            </div>
            <div class="slide__content slide__content__right" data-animation-in="fadeInRight">
                <div class="slide__content_details text-xl-start text-lg-start text-center">
                    <h2 class="animated">Being the Best <span class="d-block"><span
                                class="text-primary">Fitness</span> Products</span></h2>
                    <h5 class="animated">Best Quality Equipments and Range of Products</h5>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="slide__img overflow-hidden">
                <img src="{{ env('APP_URL').'front/images/banner3.jpg' }}" class="full-image img-fluid animated"
                    data-animation-in="zoomInImage" />
            </div>
            <div class="slide__content slide__content__right" data-animation-in="fadeInRight">
                <div class="slide__content_details text-xl-start text-lg-start text-center">
                    <h2 class="animated">Being the Best <span class="d-block"><span
                                class="text-primary">Fitness</span> Products</span></h2>
                    <h5 class="animated">Best Quality Equipments and Range of Products</h5>
                </div>
            </div>
        </div> -->
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
            fill="none" stroke="currentColor">
            <circle r="20" cy="22" cx="22" id="test">
        </symbol>
    </svg>
</div>
</div>
<div class="product-list spacing-y" id="#product-list">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-0 text-center">Best Seller <span class="text-primary">Products</span></h2>
        </div>
        <livewire:front.home-product-list :type="'best_seller'"/>
    </div>
</div>

<div class="product-list bg-light spacing-y" id="#product-list">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-0 text-center">Popular <span class="text-primary">Products</span></h2>
        </div>
        <livewire:front.home-product-list :type="'popular_product'"/>
    </div>
</div>

<div class="product-list spacing-y" id="#product-list">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-0 text-center">New <span class="text-primary">Listing</span></h2>
        </div>
        <livewire:front.home-product-list :type="'new'"/>
    </div>
</div>
<div id="ShopByBrand" class="shop-by-brand bg-light spacing-y">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-0 text-center">Shop By <span class="text-primary">Brands</span></h2>
        </div>
        <div class="brands-slider">
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/Fit-Plus.png' }}" alt="brands" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/Spirit.png' }}" alt="brands" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/California.png' }}" alt="brands" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/PowerPlus.png' }}" alt="brands" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/power.png' }}" alt="brands" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/Florex.png' }}" alt="brands" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/Woodpack.png' }}" alt="brands" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/brands/Super-Gym.png' }}" alt="brands" class="img-fluid">
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"><img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/fitplus.png' }}" alt="fit plus"></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"> <img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/supergym.png' }}" alt="super gym"></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"> <img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/ivanko.png' }}" alt="ivanko"></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"> <img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/florex.png' }}" alt="florex"></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"> <img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/spirit.png' }}" alt="spirit"></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"><img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/fitplus.png'}}" alt=""></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"> <img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/fitplus.png' }}" alt=""></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="box-brand bg-white border text-center">
                    <a href="#" class="d-block text-center">
                        <span class="brand position-relative d-block">
                            <span class="brand-logo mx-auto"> <img class="img-fluid" src="{{ env('APP_URL').'front/images/brands/fitplus.png' }}" alt=""></span>
                            </span>
                    </a>
                </div>
            </div>
        </div> -->
    </div>
</div>
<div class="inner-banner">
    <img src="{{ env('APP_URL').'front/images/company_banner.jpg' }}" alt="company_banner" class="img-fluid w-100">
</div>
<div id="Distributors" class="distributors-logo bg-light pb-0 spacing-y">
    <div class="container">
        <div class="page-header">
            <h2 class="mb-0 text-center">Our <span class="text-primary">Clients</span></h2>
        </div>
        <div class="distributors-slider">
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/danube_properties.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/dubai_petroleum.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/dubai_south.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/enoc.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/khansaheb.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/lapita.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/marriott.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/naresco_contracting.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/Nshama.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/radisson.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/rta.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <div class="client-logo">
                <img src="{{ env('APP_URL').'front/images/client/savills.png' }}" alt="cluttons" class="img-fluid">
            </div>
            <!-- <div class="client-logo">
                <img src="images/client/wasl_properties.jpg" alt="cluttons" class="img-fluid">
            </div> -->
        </div>
    </div>
</div>
<div class="commercial bg-light spacing-y">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="commercial-box">
                        <img src="{{ env('APP_URL').'front/images/black_body.jpg' }}" class="img-fluid w-100" alt="subscription">
                        <div class="commercial-content">
                            <h4 class="text-white d-block"><span class="text-primary d-block">COMMERCIAL</span> FITNESS
                                SOLUTIONS</h4>
                            <a href="{{ route('front.quote.get') }}" class="btn btn-primary fw-semibold">GET A QOUTE</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="commercial-box">
                        <img src="{{ env('APP_URL').'front/images/service.jpg' }}" class="img-fluid w-100" alt="service">
                        <div class="commercial-content">
                            <h4 class="text-white d-block"><span class="text-primary d-block">AMC & </span> EQUIPMENT SERVICE
                            </h4>
                            <a href="{{ route('front.quote.get') }}" class="btn btn-primary fw-semibold">BOOK AN APPOINMENTS</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="commercial-box">
                        <img src="{{ env('APP_URL').'front/images/subscription.jpg' }}" class="img-fluid w-100" alt="black_body">
                        <div class="commercial-content">
                            <h4 class="text-white d-block"><span class="text-primary d-block">SAUNA & STEAM</span>ROOM SOLUTIONS</h4>
                            <a href="{{ route('front.quote.get') }}" class="btn btn-primary fw-semibold">GET A QOUTE</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="commercial-box">
                        <img src="{{ env('APP_URL').'front/images/body_image.jpg' }}" class="img-fluid w-100" alt="body_image">
                        <div class="commercial-content">
                            <h4 class="text-white d-block"><span class="text-primary d-block">OUTDOOR FITNESS AND</span> KIDS PLAY SOLUTIONS</h4>
                            <a href="{{ route('front.quote.get') }}" class="btn btn-primary fw-semibold">GET A QOUTE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
