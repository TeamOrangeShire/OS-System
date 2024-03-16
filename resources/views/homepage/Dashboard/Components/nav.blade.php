<!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-mini">
         OS:
        </a>
        <a href="#" class="simple-text logo-normal">
        {{ $name }}
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          
          <li class="{{ $active === 'profile' ? 'active' : '' }}">
            <a href="{{ route('customerProfile') }}">
              <i class="now-ui-icons users_single-02"></i>
              <p>Profile</p>
            </a>
          </li>
        
          <li class="{{ $active === 'subscription' ? 'active' : '' }}">
            <a href="{{ route('customerSubscription') }}">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>My Subscription</p>
            </a>
          </li>

          <li class="{{ $active === 'reservation' ? 'active' : '' }}">
            <a href="{{ route('customerReservation') }}">
              <i class="now-ui-icons ui-1_calendar-60"></i>
              <p>My Reservation</p>
            </a>
          </li>


          <li class="{{ $active === 'settings' ? 'active' : '' }}">
            <a href="{{ route('customerSettings') }}">
              <i class="now-ui-icons ui-1_settings-gear-63"></i>
              <p>Setting</p>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">{{ $label }}</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           
            <ul class="navbar-nav">
           
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Profile</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('customerProfile') }}"><i class="fa-solid fa-user"></i>My Profile</a>
                  <a class="dropdown-item" href="{{ route('home') }}"><i class="fa-solid fa-house"></i>Back to homepage</a>
                  <a class="dropdown-item" href="{{ route('contact') }}"><i class="fa-regular fa-address-book"></i>Contact Us</a>
                  <a class="dropdown-item" href=""><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                </div>
              </li>
          
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->