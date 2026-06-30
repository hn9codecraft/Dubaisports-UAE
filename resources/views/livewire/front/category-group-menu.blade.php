<div>
<nav class="navbar navbar-expand-xl py-0 bg-white position-relative">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" class="btn btn-primary" data-bs-toggle="offcanvas"
                        href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i
                            class="fa-solid fa-bars me-1"></i> All</a>
                </li>
                @foreach($categoryGroups as $categoryGroup)
                <li class="nav-item dropdown position-static">
                    @if($categoryGroup['categories'])
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ $categoryGroup['title'] }}</a>
                    @else
                    <a class="nav-link dropdown-toggle" href="/{{$categoryGroup['slug']}}" aria-expanded="false">{{ $categoryGroup['title'] }}</a>
                    @endif
                    @if($categoryGroup['categories'])
                    <div class="dropdown-menu bg-light">
                        <div class="container">
                            <div class="row align-items-center justify-content-center">
                                @foreach($categoryGroup['categories'] as $category)
                                    <div class="col-md-auto">
                                        <a class="dropdown-item border"href="{{ route('front.category.products', [$categoryGroup['slug'], $category['slug']]) }}">
                                            <img src="{{ $category['image'] }}" alt="product_1" class="img-fluid p-2">
                                            <span class="d-block p-2 bg-white border-top text-center">{{ $category['title'] }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </li>
                @endforeach
                <li class="nav-item align-self-end d-md-inline-block d-none">
                    <a class="btn btn-success text-white px-4 text-uppercase py-2" href="https://alvo.chat/2yjn"><i class="fa-brands fa-whatsapp fa-lg me-1"></i> Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- <div class="offcanvas offcanvas-start py-4" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header border-bottom pb-1">
        <h5 class="mb-0 offcanvas-title fs-6" id="offcanvasExampleLabel"><a href="#">Shop By Category</a></h5>
        <button type="button" class="btn-close close-btn position-absolute bg-primary" data-bs-dismiss="offcanvas"
            aria-label="Close"><i class="fa-solid fa-xmark fs-2x text-white"></i></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="list-unstyled">
            @foreach($categoryGroups as $categoryGroup)
            <li>
                <a href="#" class="py-2 px-4 border-bottom d-block">{{ $categoryGroup['title'] }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div> -->
<div class="offcanvas offcanvas-start py-4" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header border-bottom pb-1">
            <h5 class="mb-0 offcanvas-title fs-6" id="offcanvasExampleLabel"><a href="#">Shop By Category</a></h5>
            <button type="button" class="btn-close close-btn position-absolute bg-primary" data-bs-dismiss="offcanvas"
                aria-label="Close"><i class="fa-solid fa-xmark fs-2x text-white"></i></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="navbar-nav all_product">
                <li class="nav-item">
                    <a class="nav-link" class="btn btn-primary" data-bs-toggle="offcanvas"
                        href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i
                            class="fa-solid fa-bars me-1"></i> <span class="d-xl-inline-block d-none">All</span> </a>
                </li>
                @foreach($categoryGroups as $categoryGroup)
                <li class="nav-item dropdown">
                    @if($categoryGroup['categories'])
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ $categoryGroup['title'] }}</a>
                    @else
                    <a class="nav-link" href="/{{$categoryGroup['slug']}}" aria-expanded="false">{{ $categoryGroup['title'] }}</a>
                    @endif
                    @if($categoryGroup['categories'])
                    <ul class="dropdown-menu bg-light position-static w-100 mb-0 py-0">
                        @foreach($categoryGroup['categories'] as $category)
                        <li class="nav-item">
                            <a class="d-block px-3 py-2 border-bottom" href="{{ route('front.category.products', [$categoryGroup['slug'], $category['slug']]) }}">{{ $category['title'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
                <li class="nav-item align-self-end">
                    <a class="btn btn-success text-white px-4 text-uppercase py-2" href="https://alvo.chat/2yjn"><i class="fa-brands fa-whatsapp fa-lg me-1"></i> Contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>
