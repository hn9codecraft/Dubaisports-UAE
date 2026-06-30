<div class="d-flex align-items-center justify-content-between py-xl-0 py-4 position-relative">
    <button class="navbar-toggler collapsed p-2 border-0 d-xl-none d-block" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="hamburger-menu">
                    <span class="bar-top"></span>
                    <span class="bar-middle"></span>
                    <span class="bar-bottom"></span>
                </span>
            </button>
        <a href="{{ route('home') }}" class="site-logo"> <img src="{{ asset('front/images/site_logo.png') }}" alt="site logo" width="300"
                height="36"></a>
    <div class="d-xl-flex d-none search-bar" role="search">
        <input class="form-control border-end-0" wire:model="keyword" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit"><span class="custom-icon custom-search"><span
                    class="path1"></span><span class="path2"></span></span></button>
        @if($keyword)
        <div class="search-item position-absolute top-100 bg-white left-0">
            <div class="row g-0">
                <div class="col-md-5">
                    <div class="p-3">
                        <h6 class="mb-2">Matching Category</h6>
                        <ul class="list-unstyled ">
                            @if($categories)
                                @foreach($categories as $category)
                                <li><a href="{{ route('front.category.products', [$category['category_group']['slug'], $category['slug']]) }}">
                                        <span class="suggestion-name">{{ $category['title'] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                        <h6 class="mb-2">Matching Brand</h6>
                        <ul class="list-unstyled ">
                            @if($brands)
                                @foreach($brands as $brand)
                                <li><a href="#">
                                        <span class="suggestion-name">{{ $brand['value'] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 bg-light">
                    <div class="p-3 h-100">
                        <h6 class="mb-2">Recommeded Product</h6>
                        @if($products)
                        @foreach($products as $product)
                        <a href="{{ route('front.products.show',$product['slug']) }}" tabindex="0">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <img src="{{ $product['main_image'] }}" alt="product_1" class="img-fluid">
                            </div>
                            <div class="col-md-9">
                                <span class="d-block mb-1">{{ $product['category']['title'] }}</span>
                                <p class="fw-semibold mb-1 product-heading">{{ $product['title'] }}</p>
                                <p class="text-primary fw-bold product-price d-flex align-items-center flex-wrap">AED {{ number_format($product['discounted_price'],2) }}
                                    @if($product['discount_percentage'] > 0)
                                        <del class="text-secondary ms-1">AED {{ number_format($product['price'],2) }}</del>
                                        <small class="badge ms-1 bg-primary px-2">({{ $product['discount_percentage'] }}% OFF)</small>
                                    @endif
                                </p>
                            </div>
                        </div>
                        </a>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <ul class="user-link d-flex align-items-center list-unstyled mb-0">
        <li class="d-xl-none d-inline-block "><a href="#"
                    class="d-flex position-relative border-0 border-secondary px-lg-3 px-0 search-icon"><span
                        class="custom-icon custom-search"><span class="path1"></span><span
                            class="path2"></span></span></a></li>
        <li class="d-lg-inline-block d-none"><a href="tel:+971526054947" class="d-flex position-relative border-end border-secondary"><span
                    class="custom-icon custom-telephone me-2"><span class="path1"></span><span
                        class="path2"></span></span><span class="link-content d-xl-inline-block d-none">+971 526054947</span></a></li>
        <li class="d-lg-inline-block d-none position-realtive">
            @guest
            <a href="{{ route('login') }}" class="d-flex position-relative border-end border-secondary"><span
                    class="custom-icon custom-account me-lg-2"><span class="path1"></span><span
                        class="path2"></span></span><span class="link-content d-xl-inline-block d-none">Sign In</span></a>
            @else
            <a href="{{ route('logout') }}" data-bs-toggle="dropdown" class="dropdown dropdown-toggle d-flex position-relative border-end border-secondary"><span
                    class="custom-icon custom-account me-2"><span class="path1"></span><span
                        class="path2"></span></span><span class="link-content d-xl-inline-block d-none">Hello, {{ Auth::user()->first_name }}</span></a>
            @endguest
            <ul class="dropdown-menu ms-3 mt-1 shadow">
                <li class="p-0 border-bottom">
                    <a href="/orders" class="d-block py-2 px-1">
                        <i class="fa-solid fa-right-from-bracket mx-2"></i><span class="link-content d-xl-inline-block d-none">My Order</span>
                    </a>
                </li>
                <li class="p-0">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="d-block py-2 px-1">
                    <i class="fa-solid fa-right-from-bracket mx-2"></i>  <span class="link-content d-xl-inline-block d-none">logout</span
                ></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>

        </li>
        @auth
        <li class="d-lg-inline-block d-none"> <a href="{{ route('wishlist') }}" class="d-flex position-relative border-end border-secondary"><span
                    class="custom-icon custom-wishlistsvg me-2"><span class="path1"></span><span
                        class="path2"></span></span><span class="link-content d-xl-inline-block d-none">Wishlist</span></a>
        </li>

        @endauth
        <li class="d-block"> <a href="{{ route('front.cart.index') }}" class="d-flex position-relative shoppingcart-icon border-lg-end border-0 border-secondary me-lg-3 me-0 px-lg-3 ps-3 pe-0"><span
                    class="custom-icon custom-cart me-2"><span class="path1"></span><span
                        class="path2"></span></span><span class="link-content d-xl-inline-block d-none">Cart</span>
                @if(isset($cart) && sizeof($cart) > 0)
                <span class="badge rounded-pill bg-primary ms-1 cart-badge">{{ sizeof($cart) }}</span>
                @endif
            </a></li>
        <li  class="d-lg-inline-block d-none">
            <span class="dark-switch">
                <span class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch"
                        id="flexSwitchCheckChecked">
                </span>
            </span>
        </li>
    </ul>
</div>
