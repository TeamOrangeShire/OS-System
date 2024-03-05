<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center text-center c_primary">
            <div class="icon p-2 me-2">
                <img class="img-fluid" src="img/os_logo.png" alt="Icon" style="width: 30px; height: 30px;">
            </div>
            <h1 class="m-0 text-primary">Orange Shire</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('contact') }}" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu rounded-0 m-0">   
                        <a href="property-list.html" class="dropdown-item">Hot Desk</a>
                        <a href="property-type.html" class="dropdown-item">Hybrid Pros</a>
                        <a href="property-agent.html" class="dropdown-item">Fixed Desk</a>
                        <a href="property-agent.html" class="dropdown-item">Private Rooms</a>
                        <a href="property-agent.html" class="dropdown-item">Printer Services</a>
                        <a href="property-agent.html" class="dropdown-item">Others</a>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="nav-item nav-link">Reservation</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary px-3 d-none d-lg-flex">Sign Up / Sign In</a>
        </div>
    </nav>
</div>