<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center text-center c_primary">
            <div class="icon  me-2">
                <img class="img-fluid" src="{{ asset('img/os_logo.png') }}" alt="Icon" style="width: 40px; height: 40px;">
            </div>
            <h1 class="m-0 text-primary">Orange Shire</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ $active === 'home'? 'active' : '' }}">Home</a>
                <a href="{{ route('solutions') }}" class="nav-item nav-link {{ $active === 'solutions'? 'active' : '' }}">Solutions</a>
                {{-- <div class="nav-item dropdown">
                    <a href="{{ route('services') }}" class="nav-link dropdown-toggle  {{ $active === 'services'? 'active' : '' }}" data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu rounded-0 m-0">   
                        <a href="" class="dropdown-item">Hot Desk</a>
                        <a href="" class="dropdown-item">Hybrid Pros</a>
                        <a href="" class="dropdown-item">Fixed Desk</a>
                        <a href="" class="dropdown-item">Private Rooms</a>
                        <a href="" class="dropdown-item">Printer Services</a>
                        <a href="" class="dropdown-item">Others</a>
                    </div>
                </div> --}}
                <a href="{{ route('reservation') }}" class="nav-item nav-link {{ $active === 'reservation'? 'active' : '' }}">Reservation</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ $active === 'contact'? 'active' : '' }}">Contact</a>
            </div>
            @if($cookie_val === 'none')
            <a href="{{route('customer_login')}}" class="btn btn-primary px-3 d-mb-4 d-lg-flex custom_login" >Log in/Sign up</a>
            @else
              <div class="profile-menu">
                <button class="user_account d-none d-lg-flex"></button>
                <div class="profile-menu-content">
                    <a href="#"><i class="fa-regular fa-user" style="color: #ff5c40; padding-right:20px;"></i> Profile</a>
                    <a href="#"><i class="fa-regular fa-bell" style="color: #ff5c40; padding-right:20px;"></i></i>Subscription</a>
                    <a href="{{route('reservation')}}"><i class="fa-regular fa-calendar" style="color: #ff5c40; padding-right:20px;"></i>Reservation</a>
                    <a href="{{route('solutions')}}"><i class="fa-solid fa-laptop-file" style="color: #ff5c40; padding-right:20px;"></i>Solutions</a>
                    <a href="#"><i class="fa-solid fa-sliders" style="color: #ff5c40; padding-right:20px;"></i>Settings</a>
                    <a href="#"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ff5c40; padding-right:20px;"></i>Logout</a>
                </div>
                <style>
                    /* Add any additional styles here */
            
                    .profile-menu {
                        position: relative;
                        display: inline-block;
                        cursor: pointer;
                    }
            
                    .profile-menu-content {
                        display: none;
                        position: absolute;
                        background-color: #fff;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        border-radius: 4px;
                        min-width: 160px;
                        margin-left:-80px;
                        z-index: 1;
                    }
                    .profile-menu-content a:hover {
                        background-color: #999999;
                        color: #ffffff
                    }
            
                    .profile-menu-content a {
                        display: block;
                        padding: 10px;
                        text-decoration: none;
                        color: #333;
                    }
                     
                    .profile-menu:hover .profile-menu-content {
                        display: block;
                    }
                </style>
            </div>
            @endif
     
          
        </div>
    </nav>
</div>  