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
            <a class="d-flex align-items-center navbar-brand" href="#">
                <img src="{{ url('/images/logo.svg') }}" width="40" height="40" alt="Logo" class="me-2">
                <h3 class="text-dark mb-0"><span class="text-danger">Tech</span>Zone</h3>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2">{{ __('Home') }}</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">{{ __('Services') }}</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2">{{ __('Contact') }}</a></li>
            </ul>
            <div class="dropdown">
                <a href="#" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa-solid fa-cart-shopping"></i>
                {{ _('Cart') }}  
                </a>
                <div class="dropdown-menu">
                    <div class="p-5">
                        <div class="p-5">
                            <!-- Cart items will be here -->
                        </div>
                        <div class="d-grid p-2 gap-2 text-center">
                            <a class="btn btn-primary mb-2" href="#">{{ _('Checkout') }}</a>
                            <a class="text-decoration-none" href="#">{{ _('View Cart') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ms-2">
                <a href="{{ route('login') }}" class="btn btn-dark btn-sm">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-dark btn-sm">
                    <i class="fa-solid fa-user-plus"></i> Register
                </a>
            </div>

        </div>
    </div>
</header>