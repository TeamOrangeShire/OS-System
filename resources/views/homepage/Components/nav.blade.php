<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center text-center c_primary">
            <div class="icon  me-2">
                <img class="img-fluid" src="img/os_logo.png" alt="Icon" style="width: 40px; height: 40px;">
            </div>
            <h1 class="m-0 text-primary">Orange Shire</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ $active === 'home'? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ $active === 'about'? 'active' : '' }}">About</a>
                <div class="nav-item dropdown">
                    <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu rounded-0 m-0">   
                        <a href="{{ route('hotdesk') }}" class="dropdown-item">Hot Desk</a>
                        <a href="property-type.html" class="dropdown-item">Hybrid Pros</a>
                        <a href="property-agent.html" class="dropdown-item">Fixed Desk</a>
                        <a href="property-agent.html" class="dropdown-item">Private Rooms</a>
                        <a href="property-agent.html" class="dropdown-item">Printer Services</a>
                        <a href="property-agent.html" class="dropdown-item">Others</a>
                    </div>
                </div>
                <a href="{{ route('reservation') }}" class="nav-item nav-link {{ $active === 'reservation'? 'active' : '' }}">Reservation</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ $active === 'contact'? 'active' : '' }}">Contact</a>
            </div>
            <a href="{{route('customer_login')}}" class="btn btn-primary px-3 d-none d-lg-flex">Log in/Sign up</a>
        </div>
    </nav>
</div>