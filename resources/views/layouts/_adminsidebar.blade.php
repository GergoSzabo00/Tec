<nav class="navbar-dark bg-dark">
    <ul class="navbar-nav sidebar" id="sidebar">
        <a href="#" class="sidebar-brand d-flex align-items-center justify-content-center p-3">
            <img class="logo" src={{url('/images/logo.svg')}} width="40" height="40" alt="Logo">
            <div class="sidebar-brand-text">TechZone</div>
        </a>
        <hr class="bg-light mx-3 my-1">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <i class="fa fa-fw fa-shop"></i> 
                <span>{{__('Visit shop')}}</span>
            </a>
        </li>
        <hr class="bg-light mx-3 my-1">
        <li class="nav-item">
            <a class="nav-link{{request()->routeIs('admin') ? ' active': ''}}" href="{{route('admin')}}">
                <i class="fa fa-fw fa-chart-line"></i>
                <span>{{__('Analytics')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-fw fa-basket-shopping"></i>
                <span>{{__('Orders')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed{{request()->routeIs('manufacturers') || request()->routeIs('manufacturer.create') ? ' active': ''}}" href="#collapseManufacturers" role="button" data-bs-toggle="collapse" data-bs-target="#collapseManufacturers" aria-expanded="false" aria-controls="collapseManufacturers">
                <i class="fa fa-fw fa-screwdriver-wrench"></i>
                <span>{{__('Manufacturers')}}</span>
            </a>
            <div class="collapse" id="collapseManufacturers" data-bs-parent="#sidebar">
                <div class="card bg-black">
                    <a href="{{route('manufacturers')}}" class="nav-link{{request()->routeIs('manufacturers') ? ' active': ''}}">
                        <i class="fa fa-fw fa-list-ul"></i> {{__('All Manufacturers')}}
                    </a>
                    <a href="{{route('manufacturer.create')}}" class="nav-link{{request()->routeIs('manufacturer.create') ? ' active': ''}}">
                        <i class="fa fa-fw fa-circle-plus"></i> {{__('Add Manufacturer')}}
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#collapseCategories" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseCategories">
                <i class="fa fa-fw fa-tags"></i>
                <span>{{__('Categories')}}</span>
            </a>
            <div class="collapse" id="collapseCategories" data-bs-parent="#sidebar">
                <div class="card bg-black">
                    <a href="#" class="nav-link">
                        <i class="fa fa-fw fa-list-ul"></i> {{__('All Categories')}}
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fa fa-fw fa-circle-plus"></i> {{__('Add Category')}}
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed{{request()->routeIs('product.create') ? ' active': ''}}" href="#collapseProducts" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseProducts">
                <i class="fa fa-fw fa-box"></i>
                <span>{{__('Products')}}</span>
            </a>
            <div class="collapse" id="collapseProducts" data-bs-parent="#sidebar">
                <div class="card bg-black">
                    <a href="#" class="nav-link">
                        <i class="fa fa-fw fa-list-ul"></i> {{__('All Products')}}
                    </a>
                    <a href="{{route('product.create')}}" class="nav-link{{request()->routeIs('product.create') ? ' active': ''}}">
                        <i class="fa fa-fw fa-circle-plus"></i> {{__('Add Product')}}
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-fw fa-users"></i>
                <span>{{__('Users')}}</span>
            </a>
        </li>
        <hr class="bg-light mx-3 my-1">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-fw fa-cog"></i>
                <span>{{__('Store settings')}}</span>
            </a>
        </li>
    </ul>
</nav>