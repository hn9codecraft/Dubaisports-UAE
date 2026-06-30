<div class="row">
    <x-loading-indicator />
    <div class="col-md-3">
        <div id="filter-sidebar">
            <div class="filter_side_bar card border-0">
                <div class="card-header bg-primary border border-primary">
                    <h4 class="mb-0 text-white fs-5">Filter</h4>
                </div>
                <div class="card-body border">
                    <div class="accordion border-bottom py-2" id="accordion_for_sidebar_first">
                        <div class="accordion-item bg-transparent border-0">
                            <h2 class="accordion-header">
                                <button aria-controls="Category_accordion" aria-expanded="false"
                                class="accordion-button p-2 fw-semibold collaps bg-transparent text-dark"
                                data-bs-target="#Category_accordion" data-bs-toggle="collapse"
                                type="button">{{ \Str::upper('Categories') }}</button>
                            </h2>
                            <div aria-labelledby="accordion_for_sidebar_first"
                                class="accordian-main-filter accordion-collapse collapse show"
                                data-bs-parent="#listgroup" id="Category_accordion">
                                <div class="accordion-body p-0">
                                    <ul class="list-unstyled">
                                        @foreach($categories as $key => $category)
                                        <li class="pt-2 ps-3" wire:key="categorykey-{{ $key }}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" wire:model="selectedCategories" value="category-{{ $category['id'] }}">
                                                <label class="form-check-label ps-1 cursor-pointer categorie_label">{{ $category['title'] }}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- Product List Container -->
                    @foreach($masterOptions as $key => $masterOption)
                    <div class="accordion @if(array_key_last($masterOptions) != $key) border-bottom @endif py-2" id="accordion_for_sidebar_second">
                        <div class="accordion-item bg-transparent border-0">
                            <h2 class="accordion-header" id="{{ $masterOption['id'] }}_{{ \Str::snake($masterOption['name']) }}">
                                <button aria-controls="{{ $masterOption['id'] }}_{{ \Str::snake($masterOption['name']) }}_accordion" aria-expanded="false"
                                    class="accordion-button p-2 fw-semibold collaps bg-transparent text-dark"
                                    data-bs-target="#{{ $masterOption['id'] }}_{{ \Str::snake($masterOption['name']) }}_accordion" data-bs-toggle="collapse"
                                    type="button">{{ \Str::upper($masterOption['name']) }}</button>
                            </h2>
                            <div aria-labelledby="{{ $masterOption['id'] }}_{{ \Str::snake($masterOption['name']) }}" class="accordion-collapse collapse show"
                                data-bs-parent="#productlistgroup" id="{{ $masterOption['id'] }}_{{ \Str::snake($masterOption['name']) }}_accordion">
                                <div class="accordion-body p-0">
                                    <ul class="list-unstyled">
                                        @foreach($masterOption['attribute_values'] as $attribute_value)
                                        <li class="pt-2 ps-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" wire:model="optionAttributeIds" value="attribute-{{ $attribute_value['id'] }}">
                                                <label for="{{ $attribute_value['id'] }}" class="form-check-label ps-1 cursor-pointer categorie_label">{{ $attribute_value['value'] }}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="accordion position-relative" id="accordion_for_sidebar_five">
                        <div class="accordion-item bg-transparent  border-0">
                            <h2 class="accordion-header" id="headingsix"><button aria-controls="Price"
                                    aria-expanded="false"
                                    class="accordion-button px-2 pt-3 pb-2 fw-semibold  collaps bg-transparent text-dark"
                                    data-bs-target="#Price" data-bs-toggle="collapse"
                                    type="button">Price</button>
                            </h2>
                            <div aria-labelledby="headingsix" class="accordion-collapse collapse show"
                                data-bs-parent="#productlistgroup">
                                <div class="accordion-body p-0 my-2 px-2">
                                    <div class="price-input">
                                        <div class="field">
                                        <!-- <span>Min</span> -->
                                        <input type="number" class="input-min" wire:model="minPrice" placeholder="Min">
                                        </div>
                                        <div class="separator">-</div>
                                        <div class="field">
                                        <!-- <span>Max</span> -->
                                        <input type="number" class="input-max" wire:model="maxPrice" placeholder="Max">
                                        </div>
                                        <div class="pt-2 mx-2" style="cursor: pointer;">
                                            <a wire:click="renderProducts" class="text-primary"><h4>GO<h4/></a>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="10000" wire:model="minPrice" step="100">
                                        <input type="range" class="range-max" min="0" max="10000" wire:model="maxPrice" step="100">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 product-list" >
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
            @if($products)
            @foreach($products as $product)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card position-relative">
                        <a href="{{ route('front.products.show',$product['slug']) }}" class="product-img"><img src="{{ $product['main_image'] }}"
                                alt="produsct" class="card-img-top img-fluid"></a>
                        <div class="card-body bg-light-gray border-top">
                            <span class="d-block mb-1">{!! Helper::getProductBrand($product['id']) !!}</span>
                            <p class="fw-semibold mb-1 product-heading"><a href="{{ route('front.products.show',$product['slug']) }}">{{ $product['title'] }}</a>
                            </p>
                            {!! Helper::priceRender($product['id']) !!}
                        </div>
                    </div>
                </div>
            @endforeach
            @else
            <div class="col-md-6 col-lg-4 mb-4">
                <h4>No records found.</h4>
            </div>
            @endif
        </div>
    </div>
</div>