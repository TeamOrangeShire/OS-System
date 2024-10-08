<div class="snackbar" id="snackbar" style="display: none">
  <span class="snackbarContent" id="snackbarContent"></span>
</div>
@include('homepage.Dashboard.Components.select_type', ['user_id'=> $user_id])
@php
    $CheckType = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
@endphp
@if($CheckType->customer_type === null)
  <script>
    window.onload = function(){    
          const selectType = new bootstrap.Modal(document.getElementById('selectType'));
          selectType.show();
    }
  </script>
@endif
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
    $logStatus = App\Models\CustomerLogs::
  where('customer_id', $user_id)
->where('log_date',Carbon\Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y'))
->where('log_status', 0)
->first();

@endphp
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">{{ $notifCount }}</span>
          </a><!-- End Notification Icon -->
           <form id="readAllForm" method="POST">
            @csrf
            <input type="hidden" name="cust_id" value="{{ $user_id }}">
           </form>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have {{ $notifCount }} new notifications
              <a href="#" onclick="ReadAllForm()"><span class="badge rounded-pill bg-primary p-2 ms-2">Read all</span></a>
            </li>
             <script>
              function ReadAllForm(){
                const formData = $('form#readAllForm').serialize();
                $.ajax({
                  type:"POST",
                  url: "{{ route('readAllCustomer') }}",
                  data:formData,
                  success: function(response){
                    SnackBar("All Notifications are read");
                    location.reload();
                  },error: function(xhr){
                    console.log(xhr.responseText);
                  }
                })
              }
             </script>
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
                <p>{!! substr($notif->notif_message, 0, 40). "...." !!}</p>
                <p>{{ $timeAgo[0] }} hrs. and {{ $timeInMinutes }} mins ago </p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            @endforeach
          
            <li class="dropdown-footer">
              <a href="{{ route('customerNotification') }}">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        

        <li class="nav-item dropdown pe-3">
           @php
               $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
               $profile_pic = $customer->customer_profile_pic;
               $fullname = $customer->customer_firstname . " ";

if ($customer->customer_middlename !== null) {
    $fullname .= $customer->customer_middlename[0] . ". ";
}

$fullname .= $customer->customer_lastname;
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

            {{-- <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li> --}}
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
        <a class="nav-link " href="{{ route('logintoshire') }}">
          <i class="bi bi-lightning-fill"></i>
          <span>{{ $logStatus ? 'Log out to Shire' : 'Log in to Shire' }}</span>
        </a>
      </li>

      <li class="nav-item ">
        <a class="nav-link disable" href="{{ /*route('customerSubscription')*/'#' }}">
          <i class="bx bxs-bell "></i>
          <span>My Subscriptions <small>(Coming Soon)</small></span>
        </a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link disable" href="{{ /*route('customerReservation')*/ '#'}}">
          <i class="bx bxs-calendar-edit "></i>
          <span>My Reservation <small>(Coming Soon)</small></span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('customerSettings') }}">
          <i class="bi bi-gear "></i>
          <span>Settings</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->
  
  <div id="loadingDiv" style="display: none;" class="loadingDiv">
    <div id="loading" class="loader"></div>
  </div>