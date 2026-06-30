<div>
<div class="top-product-list d-flex align-items-center justify-content-between pb-3">
    <div class="d-flex search-bar" role="search">
        <input class="form-control border-end-0" wire:model="keyword" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit"><span class="custom-icon custom-search"><span
                    class="path1"></span><span class="path2"></span></span></button>
    </div>
    <ul class="viewport border border-primary list-unstyled mb-0 d-flex">
        <li><a href="#" class="grid-view active"><i class="fa-solid fa-table-cells-large fa-lg"></i></a>
        </li>
        <li> <a href="#" class="list-view"><i class="fa-solid fa-list fa-lg"></i></a></li>
    </ul>
</div>
<ul class="filter-list flex-wrap list-unstyled d-flex align-items-center">
    @if($optionAttributes)
    @foreach($optionAttributes as $optionAttribute)
    <li class="me-3 mb-1">
        <span class="d-flex align-items-center bg-light rounded p-2">
            <badge class="badge text-info p-0 fw-semibold">{{ $optionAttribute['value'] }} </badge>
            <a wire:click="removeSelection({{ $optionAttribute['id'] }})" class="ps-2"><i class="fa-solid fa-xmark fa-sm"></i></a>
        </span>
    </li>
    @endforeach
    <li class="me-3 mb-1">
        <a wire:click="clearFilters" class="btn btn-info btn-sm py-1 px-2"><i class="fa-solid fa-trash  fa-sm"></i> Clear</a>
    </li>
    @endif
</ul>
<div class="row listing-product">
    @foreach($products as $product)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card position-relative">
            <a href="{{ route('front.products.show',$product['slug']) }}" class="product-img"><img src="{{ $product['main_image'] }}"
                    alt="produsct" class="card-img-top img-fluid"></a>
            <livewire:front.wishlist :page="'product_list'" :productId="$product['id']"/>
            <div class="card-body bg-light-gray border-top">
                <span class="d-block mb-1">{!! Helper::getProductBrand($product['id']) !!}</span>
                <p class="fw-semibold mb-1 product-heading"><a href="{{ route('front.products.show',$product['slug']) }}">{{ $product['title'] }}</a>
                </p>
                {!! Helper::priceRender($product['id']) !!}
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>

