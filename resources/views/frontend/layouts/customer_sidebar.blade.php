<div class="col-md-3 mb-4">
    <div class="card border border-secondary shadow-sm rounded">
        <div class="card-body p-0">
            <div class="list-group list-group-flush rounded">
                <a href="{{ route('front.customer.profile') }}" class="list-group-item list-group-item-action {{ request()->routeIs('front.customer.profile') ? 'bg-primary text-white' : '' }}">
                    <i class="fa-solid fa-user me-2"></i> My Profile
                </a>
                <a href="{{ route('front.orders.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('front.orders.index') ? 'bg-primary text-white' : '' }}">
                    <i class="fa-solid fa-box-open me-2"></i> Orders
                </a>
                <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action {{ request()->routeIs('wishlist') ? 'bg-primary text-white' : '' }}">
                    <i class="fa-solid fa-heart me-2"></i> Wishlist
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action text-danger">
                    <i class="fa-solid fa-sign-out-alt me-2"></i> Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
