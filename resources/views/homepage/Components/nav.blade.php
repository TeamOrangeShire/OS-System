{{-- <div title="Scan QR" onclick="ScanDrag('{{ route('scanQr') }}')" class="QRCode-Fab btn btn-primary {{ $cookie_val === 'none' ? 'd-none' : '' }}" id="draggable">
 <img src="{{asset('img/qr_icon.png')}}" alt="QR" class="fab-image">
</div> --}}

<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center text-center c_primary">
            <div class="  me-2">
                <img class="img-fluid" src="{{ asset('img/os_logo.png') }}" alt="Icon" style="width: 43px; height: 40px;">
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

                <a href="{{ route('reservation') }}" class="nav-item nav-link {{ $active === 'reservation'? 'active' : '' }}">Reservation</a>
                <a href="{{ route('blogsCustomer') }}" class="nav-item nav-link {{ $active === 'blogs' ? 'active' : '' }}">Blogs</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ $active === 'contact'? 'active' : '' }}">Contact</a>
                <a href="{{ route('scanQr') }}" class="nav-item nav-link d-lg-none {{ $cookie_val === 'none' ? 'd-none' : ''}} ">Scan QR</a>
            @if($cookie_val === 'none')
        </div>
            <a href="{{route('customer_login')}}" class="btn btn-primary px-3 d-mb-4 d-lg-flex custom_login" >Log in/Sign up</a>

            @else
            <a href="{{ route('customerProfile') }}" class="nav-item nav-link d-lg-none">My Profile</a>
        </div>
              <div class="profile-menu">
                @php
                    $customer = App\Models\CustomerAcc::where('customer_id', $cookie_val)->first();
                @endphp
                <button class="user_account d-none d-lg-flex" style="background-image:url('{{ $customer->customer_profile_pic === 'none' ? asset('User/Customer/placeholder.png') : asset('User/Customer/'.$customer->customer_profile_pic) }}')"></button>
                <div class="profile-menu-content">
                    <a class="aref" href="{{ route('customerProfile') }}"><i class="fa-regular fa-user" style="color: #ff5c40; padding-right:20px;"></i> Profile</a>
                    <a class="aref" href="{{ route('customerSubscription') }}"><i class="fa-regular fa-bell" style="color: #ff5c40; padding-right:20px;"></i></i>Subscription</a>
                    <a class="aref" href="{{route('customerReservation')}}"><i class="fa-regular fa-calendar" style="color: #ff5c40; padding-right:20px;"></i>Reservation</a>
                    <a class="aref" href="{{ route('customerSettings') }}"><i class="fa-solid fa-sliders" style="color: #ff5c40; padding-right:20px;"></i>Settings</a>
                    <form method="POST" id="customer_logOut">
                        @csrf
                        <button type="button" class="aref" onclick="logOut('{{ route('customer_logOut') }}')"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ff5c40; padding-right:20px;"></i>Logout</button>
                    </form>
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
                    .profile-menu-content .aref:hover {
                        background-color: #999999;
                        color: #ffffff
                    }

                    .profile-menu-content .aref {
                        display: block;
                        padding: 10px;
                        text-decoration: none;
                        color: #333;
                        border: none;
                        width: 100%;
                        text-align: left;
                        background: transparent;
                    }

                    .profile-menu:hover .profile-menu-content {
                        display: block;
                    }
                </style>
            </div>
            @endif

          <script>
             function logOut(route) {
       event.preventDefault();
     var formData = $('form#customer_logOut').serialize();

     $.ajax({
         type: 'POST',
         url: route,
         data: formData,
         success: function(response) {
           location.reload();
         },
         error: function (xhr) {

             console.log(xhr.responseText);
         }
     });
 }
          </script>
        </div>
    </nav>
</div>
