<ul class="navbar-nav flex-nowrap ms-auto">
    <li class="nav-item dropdown d-sm-none no-arrow">
        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
        <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
            <form class="me-auto navbar-search w-100">
                <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                    <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                </div>
            </form>
        </div>
    </li>   
    <li class="nav-item dropdown no-arrow mx-1 d-none d-lg-block">        
        <div class="nav-item dropdown no-arrow nav-link">
            <a href="{{ route('front.home')}}" target="_blank" class="btn btn-warning fw-bold"> Visit Website </a>
        </div>
    </li>   
    <div class="d-none d-sm-block topbar-divider"></div>
    <li class="nav-item dropdown no-arrow">
        <div class="nav-item dropdown no-arrow">
            <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="{{ route('admin.dashboard')}}">
                <img class="border rounded-circle img-profile" src="{{ asset('backend/img/avatars/avatar1.jpeg')}}">
                <span class="d-none d-lg-inline ms-2 text-gray-600 small"><i class="fas fa-angle-down"></i></span>
            </a>
            <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                <a class="dropdown-item" href="{{ route('admin.business.index')}}"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                <!-- <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a> -->
                <div class="dropdown-divider">
                    
                </div>
                <a class="dropdown-item" 
                href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                                            ><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </div>
    </li>
</ul>