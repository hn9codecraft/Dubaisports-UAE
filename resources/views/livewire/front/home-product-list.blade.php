<div class="product-slider">
    @foreach($products as $product)
    <div class="card mx-3 position-relative">
        <a href="{{ route('front.products.show', $product['slug']) }}" class="product-img"><img src="{{ $product['main_image'] }}" alt="produsct"
                class="card-img-top img-fluid"></a>
        <livewire:front.wishlist :page="'product_list'" :productId="$product['id']"/>
        <div class="card-body bg-light-gray border-top">
            @if($product['category'])
            <span class="d-block mb-1">{{ $product['category']['title'] }}</span>
            @endif
            <p class="fw-semibold mb-1 product-heading"><a href="{{ route('front.products.show', $product['slug']) }}">{{ $product['title'] }}</a></p>
            {!! Helper::priceRender($product['id']) !!}
        </div>
    </div>
    @endforeach
</div>
