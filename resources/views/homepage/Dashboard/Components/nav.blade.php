<div class="snackbar" id="snackbar" style="display: none">
  <span class="snackbarContent" id="snackbarContent"></span>
</div>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('customerHome') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('img/os_logo.png') }}" alt="">
        <span class="d-none d-lg-block">Orange Shire</span>
      </a>
      <i id="burger" class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

  
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

     
@php
    $notif = App\Models\CustomerNotification::where('user_id', $user_id)->where('user_type', 'Customer');
    $notifCount = $notif->where('notif_status', 0)->get()->count();
    $notifMessage = $notif->get();
@endphp
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">{{ $notifCount }}</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have {{ $notifCount }} new notifications
              <a href="{{ route('customerNotification') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
  
            <li>
              <hr class="dropdown-divider">
            </li>

            @foreach ($notifMessage as $notif)
            @php
                switch ($notif->notif_label) {
                  case 'Success':
                    $label = 'check-circle';
                    $color = 'success';
                    break;
                  case 'Pending':
                    $label = 'exclamation-circle';
                    $color = 'warning';
                    break;
                }
                $timeAgo = PastTimeCalc($notif->created_at);
                if($timeAgo[1] >= 60){
                  $timeInMinutes = $timeAgo[1] % 60;
                }else{
                  $timeInMinutes = $timeAgo[1];
                }
            @endphp
            <li class="notification-item">
              <i class="bi bi-{{ $label }} text-{{ $color }}"></i>
              <div>
                <h4>{!! $notif->notif_header !!}</h4>
                <p>{!! substr($notif->notif_message, 0, 40). "...." . "(Status: ".$notif->notif_label.")" !!}</p>
                <p>{{ $timeAgo[0] }} hrs. and {{ $timeInMinutes }} mins ago </p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            @endforeach
          
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        

        <li class="nav-item dropdown pe-3">
           @php
               $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
               $profile_pic = $customer->customer_profile_pic;
               $fullname = $customer->customer_firstname . " ". $customer->customer_middlename[0]. ". " .$customer->customer_lastname;
               $semi_full = FirstNameFormat($customer->customer_firstname). ". ". $customer->customer_lastname;
           @endphp
          <a id="profilebtn" class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ $profile_pic === 'none' ? asset('User/Customer/placeholder.png') : asset('User/Customer/'. $profile_pic) }}" alt="Profile" class="rounded-circle" style="width: 30px; height:30px;">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ $semi_full }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ $fullname }}</h6>
              <span>Account Balance: ₱{{ $customer->account_credits === null ? '0' : $customer->account_credits }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
          
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('customerProfile') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('customerSettings') }}">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form method="POST" id="customer_logOut">
                @csrf
              <button type="button" onclick="logOut('{{ route('customer_logOut') }}', '{{ route('home') }}', '{{ route('customer_login') }}')" class="dropdown-item d-flex align-items-center" >
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


      <li class="nav-heading">Account Details</li>
      <li class="nav-item">
        <a class="nav-link " href="{{ route('customerHome') }}">
          <i class="bi bi-house-door"></i>
          <span>Home</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('customerProfile') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('logintoshire') }}">
          <i class="bi bi-lightning-fill"></i>
          <span>Login to Shire</span>
        </a>
      </li>

      <li class="nav-item ">
        <a class="nav-link disable" href="{{ /*route('customerSubscription')*/'#' }}">
          <i class="bx bxs-bell disable"></i>
          <span>My Subscriptions <small>(Unavailable)</small></span>
        </a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link disable" href="{{ /*route('customerReservation')*/ '#'}}">
          <i class="bx bxs-calendar-edit disable"></i>
          <span>My Reservation <small>(Unavailable)</small></span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link disable" href="{{ /*route('customerSettings')*/ '#' }}">
          <i class="bi bi-gear disable"></i>
          <span>Settings <small>(Unavailable)</small></span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->
  
  <div id="loadingDiv" style="display: none;" class="loadingDiv">
    <div id="loading" class="loader"></div>
  </div>