
<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage.Dashboard.Components.header', ['title'=>'Home Dashboard - Orange Shire'])
    <link rel="stylesheet" href="{{ asset('tour/tour_style.css') }}">
</head>
@php
$customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
$customer_ext = $customer->customer_ext === 'none' ?   '' : $customer->customer_ext;
$fullname = $customer->customer_firstname . " " . $customer->customer_middlename[0]. ". ". $customer->customer_lastname. " " . $customer_ext;
$logStatus = App\Models\CustomerLogs::
  where('customer_id', $user_id)
->where('log_date',Carbon\Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y'))
->where('log_status', 0)
->first();

$tour = App\Models\Tour::where('customer_id', $user_id)->first();
@endphp
<body>
    @include('homepage.Dashboard.Components.nav', ['user_id'=>$user_id])
  <main id="main" class="main">
  

    <div class="pagetitle">
      <h1>Welcome! {{ $customer->customer_firstname }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customerHome') }}">Home</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section shadow w-100 back-gradient rounded p-4 row mx-auto">
      
         <div id="currentCredit" class="col col-6">
            <h1 class="text-white">₱{{ $customer->account_credits === null ? 0 : $customer->account_credits }}.00</h1>
            <small class="text-white">Current Credit</small>
         </div>
         <div id="logStatus" class="col col-6 row">
            <h1 class="text-white">Status</h1>
            <p class="text-white">{{ $logStatus ? 'Logged In' : 'Not Logged In' }} <br> {{ $logStatus ? $logStatus->log_date : '---------' }} <br> {{ $logStatus ? $logStatus->log_start_time : '---------' }} </p>
         </div>

    </section>

    <section class="section mt-4 shadow rounded p-4  mx-auto">
        <p>Navigate Our App</p>
        <div  class="w-100 row gap-1 align-items-center">
           <button id="available" style="background-color:#212124; color:#fff" title="Home" onclick="detectGoto('{{ route('customerHome') }}',   '{{ route('home') }}')" class="btn  col-md-3 mx-auto mt-4 rounded shadow text-center" >
            <i class="bi bi-house-door fs-1"></i>
            <p>Home</p>
           </button>
           <button title="Profile"  style="background-color:#212124; color:#fff" onclick="goTo('{{ route('customerProfile') }}')" class="btn col-md-3 mx-auto mt-4 rounded shadow text-center" >
            <i class="bi bi-person fs-1"></i>
            <p>Profile</p>
           </button>
           <button title="{{ $logStatus ? 'Log out to Shire' : 'Log in to Shire' }}"  style="background-color:#212124; color:#fff" onclick="goTo('{{ route('logintoshire') }}')" class="btn col-md-3 mx-auto mt-4 rounded shadow text-center" >
            <i class="bi bi-lightning-fill fs-1"></i>
            <p>{{ $logStatus ? 'Log out to Shire' : 'Log in to Shire' }}</p>
           </button>
     
            <button style="background-color:#212124; color:#fff" id="unavailable" title="Locked" class="btn col-md-3 mx-auto mt-4 rounded shadow text-center position-relative" >
              <i class="bx bxs-bell fs-1"></i>
              <p>Subscription <i>(Not yet Available)</i></p>
              <div class="lock"> <i class="bx bxs-lock-alt fs-1"></i>
              <p>Subscription(Lock)</p></div>
             </button>
             <button   style="background-color:#212124; color:#fff" title="Locked" class="btn col-md-3 mx-auto mt-4 rounded shadow text-center position-relative" >
              <i class="bx bxs-calendar-edit fs-1"></i>
              <p>Reservation <i>(Not yet Available)</i></p>
              <div class="lock"> <i class="bx bxs-lock-alt fs-1"></i>
                <p>Reservation(Lock)</p></div>
             </button>
               <button  style="background-color:#212124; color:#fff" title="Locked" class="btn col-md-3 mx-auto mt-4 rounded shadow text-center position-relative" >
              <i class="bi bi-gear fs-1"></i>
              <p>Settings <i>(Not yet Available)</i></p>
              <div class="lock"> <i class="bx bxs-lock-alt fs-1"></i>
                <p>Settings(Lock)</p></div>
             </button>
           
        </div>
     </section>
 

  </main><!-- End #main -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Orange Shire</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="coresupporthub.com">Core Support Hub Dev</a>
    </div>
  </footer><!-- End Footer -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <form id="tour_status" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    <input type="hidden" name="location" value="home">
    <input type="hidden" id="status_route" value="{{ route('updateTour') }}">
  </form>
  @include('homepage.Dashboard.Components.scripts')

  @if ($tour->tour_home === 0)
  <script src="{{ asset('tour/home.js') }}"></script>
  @endif
  
</body>

</html>