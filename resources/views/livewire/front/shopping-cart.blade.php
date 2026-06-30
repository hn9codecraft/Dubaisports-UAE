<div class="shopping-cart spacing-y">
    <div class="container">
        <div wire:loading wire:target="removeProduct, applyDiscount">
            <div style="display: flex; justify-content: center; align-items: center; background-color: black; position: fixed;
                top: 0px; left: 0px; z-index: 9999; width: 100%; height: 100%; opacity: .75;
            ">
                <div class="la-square-jelly-box">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        @if($carts) 
        <div class="page-header">
            <h2 class="mb-0 text-center">Shopping <span class="text-primary">Cart</span></h2>
        </div>
        <div class="row g-md-4 g-0">
            <div class="col-md-9 shopping-box mb-md-0 mb-4">
                <div class="row shopping-header d-md-flex d-none p-3">
                    <div class="col-md-2">
                        <h5 class="mb-0">Product Images</h5>
                    </div>
                    <div class="col-md-5">
                        <h5 class="mb-0">Product Details</h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="mb-0">Quantity</h5>
                    </div>
                    <div class="col-md-2 text-end">
                        <h5 class="mb-0">Price</h5>
                    </div>
                </div>
                @if($carts)
                    @foreach($carts as $key => $cart)
                    <div class="row py-4 px-3 text-md-start text-center">
                        <div class="col-md-2 mb-md-0 mb-4">
                            <a href="#" data-src="{{ $cart['product']['main_image'] }}"
                                class="fancybox-img shopping-img d-inline-block border rounded" data-fancybox="product">
                                <img src="{{ $cart['product']['main_image'] }}" alt="produsct"
                                    class="card-img-top img-fluid rounded">
                            </a>
                        </div>
                        <div class="col-md-5 mb-md-0 mb-4">
                            <a href="#" class="fw-semibold fs-5 text-primary mb-2">{{ $cart['product']['title'] }}</a>
                            <span class="d-block w-100">Brand : <strong>{!! Helper::getProductBrand($cart['product']['id']) !!}</strong></span>
                            <!-- <span class="d-block w-100">Model Number : <strong>ICON-PETL-38817</strong></span> -->
                            <div class="mt-2">
                                <a href="{{ route('front.products.show', $cart['product']['slug']) }}" class="btn btn-outline-secondary btn-sm me-2"><i class="fa-solid fa-pen-to-square me-2"></i> Edit</a>
                                <a wire:click="removeProduct({{ $key }})" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-trash me-2"></i>Remove</a>
                            </div>
                        </div> 
                        <div class="col-md-3 mb-md-0 mb-4">
                            <div class="qty d-flex justify-content-center justify-content-md-start">
                                <button type="button" wire:click="incrementQty({{ $key }})" class="btn btn-info me-2"> <i
                                        class="fa-solid fa-plus"></i> </button>
                                <input type="text" value="{{ $cart['quantity'] }}"
                                    class="form-control text-center fw-bold border border-secondary qty">
                                <button type="button" wire:click="decrementQty({{ $key }})" class="btn btn-info ms-2"><i
                                        class="fa-solid fa-minus"></i></button>
                            </div>
                            @if($cart['stocks'] <= 3)
                            <p class="text-primary my-2">(Only {{ $cart['stocks'] }} Products Left)</p>
                            @endif
                        </div>
                        <div class="col-md-2 mb-md-0 text-md-end">
                            <div class="price d-flex align-items-center justify-content-md-end justify-content-center mb-3">
                                <h4 class="mb-0 fw-semibold text-primary">AED {{ number_format($cart['productDiscountPrice'],2) }}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="col-md-3">
                <div class="card order-summery">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Order summary</h5>
                    </div>
                    <div class="card-body">
                        <!-- <p class="mb-1">Add 25AED for <strong>FREE DELIVERY</strong> </p> -->
                        <!-- <div class="progress mb-4">
                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> -->
                        <h6>Coupon Code</h6>
                        <div class="d-flex coupon mb-4">
                            <input class="form-control flex-grow-1 w-auto border-end-0" type="text" wire:model="couponCode" placeholder="coupon" aria-label="coupon">
                            <button class="btn btn-primary" wire:click="applyDiscount()">Apply</button>
                        </div>

                        @php
                            $vatRate = 5;
                            $vat = ($totalAmount * $vatRate) / (100 + $vatRate);
                            $subTotalExclVat = $totalAmount - $vat;
                        @endphp
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between mb-1"><span>Sub-Total</span> <span class="fw-semibold">AED {{ number_format($subTotalExclVat, 2) }} </span></li>
                            @if($discount > 0)
                            <li class="d-flex justify-content-between mb-1 text-danger"><span>Coupon Discount</span> <span class="fw-semibold"> - AED {{ $discount }}</span></li>
                            @endif
                            <li class="d-flex justify-content-between mb-1"><span>Vat(5%)</span> <span class="fw-semibold">AED {{ number_format($vat, 2) }}</span></li>
                            <li class="d-flex justify-content-between fs-4 "><span class="fw-semibold">Total</span> <span class="fw-semibold">AED {{ number_format($totalAmount, 2) }}</span></li>
                        </ul>
                        <div class="checkout-btn">
                            <a href="{{ route('home') }}" class="btn btn-info mb-3 w-100">
                                Continue Shopping</a>
                            <a href="{{ route('front.checkout.index') }}" class="btn btn-primary  w-100">
                                Proceed to Secure Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h5 class="mb-0">YOUR BAG IS EMPTY</h5>
                <a href="{{ route('home') }}" class="btn btn-primary  w-100">LETS ADD SOME ITEMS</a>
            </div>
        </div>
        @endif
    </div>
</div>
