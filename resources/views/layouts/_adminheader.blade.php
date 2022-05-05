<header>
    <nav class="navbar bg-white navbar-light">
        <button class="btn rounded-circle ms-3" id="sidebarToggler" type="button">
            <i class="fa fa-bars"></i>
        </button>    
        <div class="dropdown me-3">
            <a href="#" id="userDropdown" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                admin  
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> {{__('Profile')}}</a></li>
                <li><a class="dropdown-item" href="{{route('recent.orders')}}"><i class="fa fa-fw fa-basket-shopping"></i> {{ __('My orders') }}</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button class="dropdown-item" type="submit"><i class="fa fa-fw fa-sign-out"></i> {{__('Logout')}}</button>
                    </form>   
                </li>
            </ul>
        </div>
    </nav>
</header>