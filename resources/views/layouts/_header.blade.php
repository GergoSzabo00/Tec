<header class="border-bottom">
    <div class="bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="languageDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Selected language
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdownMenuLink">
                        <li><a href="#" class="dropdown-item">Other language</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex navbar flex-wrap align-items-center justify-content-center justify-content-lg-start p-2">
            <a class="d-flex align-items-center navbar-brand" href="{{route('home')}}">
                <img src="{{ url('/images/logo.svg') }}" width="40" height="40" alt="Logo" class="me-2">
                <h3 class="text-dark mb-0"><span class="text-danger">Tech</span>Zone</h3>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2">{{ __('Home') }}</a></li>
                @auth
                    @if(Auth::user()->is_admin == 1)
                        <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link px-2">{{ __('Administration') }}</a></li>
                    @endif
                @endauth
                <li class="nav-item"><a href="#" class="nav-link px-2">{{ __('Services') }}</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">{{ __('Contact') }}</a></li>
            </ul>
            <div class="dropdown">
                <a href="#" class="btn btn-sm" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <i class="fa-solid fa-cart-shopping"></i>
                    {{__('Cart')}}
                    <span id="cartItemCountText" class="badge bg-primary rounded-pill"></span>
                </a>
                <div class="dropdown-menu cart-dropdown">
                    <div class="p-2">
                        <div id="cartItemsDropdown" class="cart-items">
                        </div>
                        <hr>
                        <div>
                            <p>{{__('Subtotal')}}<span class="subtotal text-primary float-end"></span></p>
                            <p>{{__('Shipping cost')}}<span class="shippingCost text-primary float-end"></span></p>
                            <hr>
                            <p class="fs-4">{{__('Total')}}<span class="totalPrice text-primary float-end"></span></p>
                        </div>
                        <div class="d-grid p-2 gap-2 text-center">
                            <a class="btn btn-primary checkoutBtn" href="{{route('checkout')}}">{{ __('Checkout') }}</a>
                            <a class="text-decoration-none" href="{{ route('cart') }}">{{ __('View Cart') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @auth
                <div class="ms-2">
                    <div class="dropdown">
                        <a href="#" id="userDropdown" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            @if(Auth::user()->is_admin == 1)
                                admin
                            @else
                                {{ Auth::user()->customer_info->firstname }}
                            @endif  
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> {{ __('Profile') }}</a></li>
                            <li><a class="dropdown-item" href="{{route('recent.orders')}}"><i class="fa fa-fw fa-basket-shopping"></i> {{ __('My orders') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fa fa-fw fa-sign-out"></i> {{ __('Logout') }}</button>
                                </form>   
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="ms-2">
                    <a href="{{ route('login') }}" class="btn btn-dark btn-sm">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-dark btn-sm">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>