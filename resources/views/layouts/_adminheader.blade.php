<header>
    <div class="bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="languageDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fi fi-{{config('app.available_locales')[App::currentLocale()]['icon']}}"></i>
                        {{__('languages.'.App::currentLocale().'')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdownMenuLink">
                        @foreach(config('app.available_locales') as $key => $value)
                        <li>
                            <a href="{{route('set.locale', $key)}}" class="dropdown-item">
                                <i class="fi fi-{{$value['icon']}}"></i>
                                {{__('languages.'.$key.'')}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar bg-white navbar-light">
        <button class="btn rounded-circle ms-3" id="sidebarToggler" type="button">
            <i class="fa fa-bars"></i>
        </button>    
        <div class="dropdown me-3">
            <a href="#" id="userDropdown" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                admin  
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fa fa-fw fa-user"></i> {{__('Profile')}}</a></li>
                <li><a class="dropdown-item" href="{{route('addresses')}}"><i class="fa fa-fw fa-building"></i> {{__('Addresses')}}</a></li>
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