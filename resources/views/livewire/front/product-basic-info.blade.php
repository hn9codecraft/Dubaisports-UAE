<div class="col-md-6">
    <div class="page-header mb-0 pb-0 pb-1 border-bottom border-2 d-flex align-items-start align-items-lg-center justify-content-md-between mb-4 flex-lg-row flex-column-reverse">
        <h2 class="product-heading mb-0">{{ $product['title'] }} </h2>
        <!-- <span class="text-primary">Treadmill</span> -->
        <div class="brands mb-lg-0 mb-2">
            @if($brand)
            <span class="badge bg-dark d-inline-block p-2 mr-2 mb-1"><i class="fas fa-check-circle me-1"
                    aria-hidden="true"></i> {{ $brand->name }} </span>
            @elseif(!empty(Helper::getProductBrand($product['id'])))
            <span class="badge bg-dark d-inline-block p-2 mr-2 mb-1"><i class="fas fa-check-circle me-1"
                    aria-hidden="true"></i> {!! Helper::getProductBrand($product['id']) !!} </span>
            @endif
            @if($productStock > 0)
            <span class="badge bg-success d-inline-block p-2 mb-1"><i class="fas fa-check-circle me-1"
                    aria-hidden="true"></i> In stock</span>
            @else
            <span class="badge bg-danger d-inline-block p-2 mb-1"><i class="fas fa-time-circle me-1"
                    aria-hidden="true"></i> Out stock</span>
            @endif
        </div>
    </div>
    <div class="price-calculator">
        <div class="quantity mb-4">
            <h5 class="mb-3">Quantity
                <a href="javascript:void()" class="text-primary" data-bs-toggle="popover"
                    data-bs-trigger="focus" data-bs-content="Quntity is based on available products">
                    <i class="fas fa-info-circle fa-sm" aria-hidden="true"></i>
                </a>
            </h5>
            <div class="qty d-flex">
                <button type="button" wire:click="incrementQty" class="btn btn-info me-2"> <i
                        class="fa-solid fa-plus"></i> </button>
                <input type="text" wire:change="qtyChange($event.target.value)" value="{{ $productQty }}"
                    class="form-control text-center fw-bold border border-secondary qty">
                <button type="button" wire:click="decrementQty" class="btn btn-info ms-2"><i
                        class="fa-solid fa-minus"></i></button>
            </div>
            @if($productStock < 1)
                <div class="stock">
                    <p class="text-primary my-2">( {{ $productStock }} product - <strong> Out of Stock</strong>)</p>
                </div>
            @elseif($productStock == $productQty) 
                <div class="stock">
                    <p class="text-primary my-2">(Max. Product qty limit reached)</p>
                </div>
            @endif
        </div>
        @if($additionalPriceEnabled)
            <div class="b-md-4 mb-3">
                <h5 class="mb-3">Weights/Sizes
                    <a href="javascript:void()" class="text-primary" data-bs-toggle="popover"
                    data-bs-trigger="focus" data-bs-content="Weight">
                    <i class="fas fa-info-circle fa-sm" aria-hidden="true"></i>
                </a>
                </h5>
                @foreach($additionalPriceList as $addPricekey => $additionalPrice)
                    <a wire:click="selectOption({{ $addPricekey }})" class="btn btn-outline-dark @if($selectedPriceOptionId == $addPricekey) active @endif px-3 py-2">{{ $additionalPrice['title'] }}</a>
                @endforeach
            </div>
        @endif
        <div class="product-details mb-4">
            <h5>Product Details
                <a href="javascript:void()" class="text-primary" data-bs-toggle="popover"
                    data-bs-trigger="focus" data-bs-content="product all details">
                    <i class="fas fa-info-circle fa-sm" aria-hidden="true"></i>
                </a>
            </h5>
            {!! $product['details'] !!}
        </div>
        <div class="price-details mb-4">
            <h5>Total Price inclusive of VAT
                <a href="javascript:void()" class="text-primary" data-bs-toggle="popover"
                    data-bs-trigger="focus" data-bs-content="The total price inclusive of VAT">
                    <i class="fas fa-info-circle fa-sm" aria-hidden="true"></i>
                </a>
            </h5>
            <div class="price d-flex align-items-center mb-3 flex-wrap">
                <h3 class="fs-1 mb-0 fw-bold">AED {{ number_format($productDiscountPrice,2) }} </h3>
                @if($product['discount_percentage'] > 0)
                    <del class="text-primary fs-5 ms-3">AED {{ number_format($productPrice,2) }}</del>
                    <span class="ms-md-4 ms-0 fw-semibold fs-5 text-success">({{ $product['discount_percentage'] }}% OFF)</span>
                @endif
            </div>
            @php
                $vatRate = 5;
                $basePrice = $productDiscountPrice ?? $productPrice;

                // Extract VAT from VAT-included price
                $vatAmount = ($basePrice * $vatRate) / (100 + $vatRate);
            @endphp
            <p class="mb-2 text-muted">
                Price includes <strong>5% VAT</strong> (AED {{ number_format($vatAmount, 2) }})
            </p>
        </div> 
        @if($brand)
        <div class="brand-section my-3 d-flex align-items-center flex-wrap">
            <span class="text-muted fw-bold me-2" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1;">Brand:</span>
            <a href="{{ $brand->link ?? '#' }}" target="_blank" class="d-inline-flex align-items-center text-decoration-none me-2">
                @if($brand->image)
                    <img src="{{ $brand->image }}" alt="{{ $brand->name }}" style="height: 35px; object-fit: contain; background: white; padding: 2px; border: 1px solid #ddd; border-radius: 4px;" class="me-2">
                @endif
                <strong class="text-danger fs-5 hover-underline" style="color: #dc3545 !important; line-height: 1;">{{ $brand->name }}</strong>
            </a>
            @if($brand->description)
                <a href="javascript:void(0)" class="text-danger d-inline-flex align-items-center justify-content-center" 
                   data-bs-toggle="popover" 
                   data-bs-trigger="focus" 
                   data-bs-placement="top" 
                   data-bs-content="{{ $brand->description }}"
                   title="About {{ $brand->name }}">
                    <i class="fas fa-info-circle fa-sm" aria-hidden="true"></i>
                </a>
            @endif
        </div>
        @endif
        <p class="mb-2"><strong>Note:</strong> Next Day Delivery is only available for Dubai and Abu
            Dhabi</p>
        <div class="shopping-now mobile-sticky my-lg-4 d-flex">
        <h3 class="fs-4 mb-0 fw-bold d-md-none d-inline-block w-100 me-2 align-self-center">AED {{ number_format($productPrice,2) }} </h3>
            <a wire:click="addToCart" class="@if($productStock <= 0) disabled @endif btn btn-primary w-50 sd-w-100 px-lg-4 px-2 py-3 fw-semibold mb-lg-0 mb-md-3 me-md-3"><i
                    class="fa-solid fa-cart-shopping fa-lg me-2"></i> ADD TO CART</a>
            <livewire:front.wishlist :page="'product_info'" :productId="$product['id']"/>
        </div>
        <div class="shopping-now my-lg-4 d-lg-flex d-md-flex d-block">
            <a href="/quote" class="btn btn-info px-lg-4 px-2 py-3 w-50 sd-w-100 fw-semibold mb-lg-0 mb-3 me-md-3"><i
                    class="fa-solid fa-phone me-2"></i> CONTACT US</a>
            <a href="https://alvo.chat/2yjn" class="btn btn-success px-lg-4 px-2 py-3 w-50  sd-w-100  fw-semibold mb-lg-0 mb-3 me-md-3"><i
                    class="fa-brands fa-whatsapp fa-lg me-2"></i> WHATSAPP</a>
        </div>

            <!-- <h5 class="mb-3">Services
                <a href="javascript:void()" class="text-primary" data-bs-toggle="popover"
                    data-bs-trigger="focus" data-bs-content="Quntity is here">
                    <i class="fas fa-info-circle fa-sm" aria-hidden="true"></i>
                </a>
            </h5> -->
                <livewire:service-offer />

    </div>
</div>
