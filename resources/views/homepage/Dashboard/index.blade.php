
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
->where('log_status', 0)
->first();
$login_data = App\Models\CustomerLogs::where('customer_id', $user_id)->orderBy('created_at', 'desc')->limit(6)->get();
$tour = App\Models\Tour::where('customer_id', $user_id)->first();
@endphp
<body>
    @include('homepage.Dashboard.Components.nav', ['user_id'=>$user_id])
  <main id="main" class="main">
  

    <div class="pagetitle">
      <h1>Hi! {{ $customer->customer_firstname }}</h1>
      <small class="text-secondary">Welcome Back</small>
    </div><!-- End Page Title -->

    <section class="section shadow w-100 back-gradient rounded p-4 row mx-auto ">
      
         <div id="currentCredit" class="col col-lg-6 col-sm-6 justify-content-between d-flex flex-column">
           <div>
            <small class="text-white">Balance</small>
            <h1 class="text-white">₱{{ $customer->account_credits === null ? 0 : $customer->account_credits }}.00</h1>
           </div>
           <div>
            <small class="text-white">Date</small>
            <h3 class="text-white">{{Carbon\Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y')}}</h3>
           </div>

         </div>
         <div id="logStatus" class="col col-lg-6 col-sm-6 row p-2 ">
            <div class="status-log rounded mx-auto my-auto h-100 d-flex flex-column">
              <div class="border-bottom border-black h-50 w-100 p-2">
                  <p class="text-success"><i class="bi bi-box-arrow-in-right"></i> IN</p>
                  <p>{{$logStatus ? $logStatus->log_start_time : '???????'}}</p>
              </div>
              <div class="border-top border-black h-50 w-100 p-2">
                 <small>Status</small>
                 <h5 class="text-{{$logStatus ? 'success' : 'danger'}}">{{$logStatus ? 'Active' : 'Inactive'}}  <i class="bi bi-circle-fill" style="color: {{$logStatus ? '#39FF14' : '#FF3131'}}"></i></h5>
              </div>
            </div>
         </div>

    </section>

    <section class="mt-4 container d-flex justify-content-center">
       <div class="p-3 text-center">
        <button id="available"  onclick="startScan('{{ route('updateQRLog') }}', '{{ route('logintoshire') }}', 'global')" style="background-color:#212124; color:#fff" title="Scan"  data-bs-toggle="modal" data-bs-target="#ScanQr" class="btn text-center rounded-circle" >
          <i class="ri ri-qr-code-line fs-2"></i>
         </button>
         <p class="mt-1">Scan</p>
       </div>
       <div class="p-3 text-center">
        <button title="Profile"  style="background-color:#212124; color:#fff" onclick="goTo('{{ route('customerProfile') }}')" class="btn rounded-circle text-center" >
          <i class="bi bi-person fs-2"></i>
         </button>
         <p class="mt-1">Profile</p>
       </div>
       <div class="p-3 text-center">
        <button title="{{ $logStatus ? 'Log out to Shire' : 'Log in to Shire' }}"  style="background-color:#212124; color:#fff" onclick="goTo('{{ route('logintoshire') }}')" class="btn rounded-circle text-center" >
          <i class="bi bi-{{$logStatus ? 'person-dash' : 'person-check'}} fs-2"></i>
         </button>
         <p class="mt-1">{{ $logStatus ? 'Log out' : 'Log in' }}</p>
       </div>
       <div class="p-3 text-center">
        <button onclick="goTo('{{ route('customerSettings') }}')" style="background-color:#212124; color:#fff" title="Locked" class="btn  text-center rounded-circle" >
          <i class="bi bi-gear fs-2"></i>
         </button>
         <p>Settings</p>
       </div>
    </section>
   <section>
    
    <div class="card">
      <div class="card-body">
       <div class="d-flex justify-content-between ">
        <h5 class="card-title text-secondary">Recent Transactions</h5>
        <a class="card-title" href="">See All</a>
       </div>

        <!-- List group with custom content -->
        <ul class="list-group ">
      @foreach ($login_data as $log)
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold">Log in to Shire</div>
          {{$log->log_date}} ({{$log->log_start_time}} - {{$log->log_end_time}})
        </div>
        @php
            $timePass = PastTimeCalc($log->created_at);

            if($timePass[0]>0 && $timePass[2] == 0){
              $showTimePass = $timePass[0] . " Hrs Ago";
            }else if($timePass[2]>0){
              $showTimePass = $timePass[2] . " Days Ago";
            }else{
              $showTimePass = $timePass[1] . " Minutes Ago";
            }
        @endphp
        <span class="text-secondary">{{$showTimePass}}</span>
      </li>
   
      @endforeach
        </ul><!-- End with custom content -->

      </div>
    </div>

   </section>

  </main>
 
  <form method="post" id="scannedDataHolder">@csrf <input type="hidden" id="scannedQRCode" name="QRCode"><input type="hidden" name="cust_id" value="{{ $user_id }}"></form>
  <!-- End #main -->
  {{-- <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Orange Shire</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="coresupporthub.com">Core Support Hub Dev</a>
    </div> 
  </footer> --}}

  <div class="modal fade" id="ScanQr" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Scan QR-Code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>Scan only Orange Shire related QR-Code</p>
        <div class="mt-4 border border-4 border-info" id="qrScanner" style="display: none;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

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