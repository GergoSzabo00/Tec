<header>
    <nav class="navbar bg-white navbar-light">
        <div class="container">    
            <div class="ms-auto">
                <div class="dropdown">
                    <a href="#" id="userDropdown" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        admin  
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{route('logout')}}">
                                <input type="hidden" name="_token" value="Iszoelg6hHOoXOTRpNLWBPrtnxqjkIWzcDoCVG6p">
                                <button class="dropdown-item" type="submit"><i class="fa fa-sign-out"></i> Logout</button>
                            </form>   
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>