<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'Customer Login - Orange Shire'])
 <link rel="stylesheet" href="{{ asset('tour/tour_style.css') }}">
</head>

<body>

  @php
  $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
  $customer_ext = $customer->customer_ext === 'none' ?   '' : $customer->customer_ext;
  $profile = $customer->customer_profile_pic;
  
  $tour = App\Models\Tour::where('customer_id', $user_id)->first();
  $logStatus = App\Models\CustomerLogs::
  where('customer_id', $user_id)
->where('log_status', 0)
->first();

@endphp
<div class="custom-success" onclick="CloseDataModals('custom_success')" style="display: {{ $status === 'success' ? 'flex' : 'none' }}" id="custom_success">
  <div class="success-content text-center">
     <img src="{{ asset('customer_dashboards/img/success.gif') }}" alt="success">
     <h3 class="text-success">Log Out Successfully</h3>
     <p><strong>{{ $customer->customer_type }}</strong></p>
     <p id="succ_date"></p>
     <p id="succ_time"></p>
     <p id="succ_total_time"></p>
     <p id="succ_payment"></p>
     <p id="succ_status"></p>   
     <i>Thank you for visiting  Orange Shire Coworking!</i>   
     <i>&trade; All Rights Reserved Orange Shire &trade;</i>
     <button type="button"  onclick="LogHistory('{{ route('getHistoryData') }}?cust_id={{ $user_id }}', '{{ route('getLogInfo') }}', '{{ $customer->customer_type }}', 'click_button','{{ route('logintoshire') }}')" class="btn btn-success mt-2">Okay</button>
  </div>
</div>

<div class="custom-success" onclick="CloseDataModals('custom_error')" style="display:{{ $status === 'not_enough' ? 'flex' : 'none' }}" id="custom_error">
  <div class="success-content text-center">
     <img src="{{ asset('customer_dashboards/img/ewallet.gif') }}" alt="error">
     <h3 class="text-success">Not Enough Credit to Pay</h3>
     <i>Please Make Sure to top up in our establishment to replenish your Orange Shire Credits</i>   
     <i>&trade; All Rights Reserved Orange Shire &trade;</i>
     <button onclick="CloseDataModals('custom_error')" class="btn btn-success mt-2">Scan Again</button>
  </div>
</div>

<div class="custom-success" style="display:{{ $status === 'already_login' ? 'flex' : 'none' }}" onclick="CloseDataModals('custom_login')" id="custom_login">
  <div class="success-content text-center">
     <img src="{{ asset('customer_dashboards/img/work.gif') }}" alt="error">
     <h3 class="text-success">Oppss... Something Went Wrong</h3>
     <i>It looks like you are still logged in or you have an unpaid transaction</i>   
     <i>&trade; All Rights Reserved Orange Shire &trade;</i>
     <button onclick="CloseDataModals('custom_login')" class="btn btn-success mt-2">Scan Again</button>
  </div>
</div>


  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav', ['user_id'=>$user_id])
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ $logStatus ? 'Log Out' : 'Log In' }} to Shire</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customerHome') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customerProfile') }}">Profile</a></li>
          <li class="breadcrumb-item active">{{ $logStatus ? 'Log Out' : 'Log In' }}  </li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <form method="post" id="scannedDataHolder">@csrf <input type="hidden" id="scannedQRCode" name="QRCode"><input type="hidden" name="cust_id" value="{{ $user_id }}"></form>
    <button id="scanner" type="button" onclick="startScan('{{ route('updateQRLog') }}', '{{ route('getCustomerLoginStatus') }}', 'login')" class="btn btn-primary mb-4"><i class="bx bx-qr-scan"></i> {{ $logStatus ? 'Scan to Log out' : 'Scan to Log in'}}</button>
      <div id="qrScanner" style="display: none;"></div>
       <div class="card">
        <div class="card-body">
          <h5 class="card-title">Customer Type: {{$customer->customer_type}}</h5>

          <!-- Default Tabs -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li id="nav_status" class="nav-item" role="presentation">
              <button class="nav-link active" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="true">Status</button>
            </li>
            <li id="nav_history" class="nav-item" role="presentation">
              <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">History</button>
            </li>
          </ul>
          <div class="tab-content pt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="status" role="tabpanel" aria-labelledby="status-tab">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><i class="ri-time-line"></i> Log In Status</h5>
                  <p class="card-text">Login Status: <span id="login_status"></span></p>
                  <p class="card-text">Date: <span id="login_date"></span></p>
                  <p class="card-text">Start Time: <span id="login_start"></span></p>
                  <i class="card-text">Other Details will be shown after log out</i>
                </div>
              </div>
            </div>
            <div class="tab-pane fade table-responsive" id="history" role="tabpanel" aria-labelledby="history-tab">
              
                <table class="table w-100" id="historyBody">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Total Hours</th>
                      <th>More Info</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
            </div>
          
          </div><!-- End Default Tabs -->

        </div>
      </div>
    
  </main><!-- End #main -->

  <div class="modal fade" id="MoreInfoLog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Log Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="card-text">Login Status: <span id="i_login_status"></span></p>
          <p class="card-text">Date: <span id="i_login_date"></span></p>
          <p class="card-text">Start Time: <span id="i_login_start"></span></p>
          <p class="card-text">End Time: <span id="i_login_end"></span></p>
          <p class="card-text">Total Hours: <span id="i_login_total"></span></p>
          <p class="card-text">Payment: <span id="i_login_payment"></span></p>
          <p class="card-text">Mode of Payment: <span id="i_login_mode"></span></p>
          <p class="card-text">Status: <span id="i_login_final_status"></span></p>
          <p class="card-text">Date & Time Paid: <span id="i_paid_status"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button"  data-bs-dismiss="modal" class="btn btn-primary">Okay</button>
        </div>
      </div>
    </div>
  </div>


  <!-- script end for change password -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <form id="tour_status" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    <input type="hidden" name="location" value="login">
    <input type="hidden" id="status_route" value="{{ route('updateTour') }}">
  </form>
  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')
  
  @if ($tour->tour_login === 0)
  <script src="{{ asset('tour/login.js') }}"></script>
  @endif

  <script>
    
    window.onload = function() {
      LoginStatusFetch("{{ route('getCustomerLoginStatus') }}");
      const stats = '{{ $status }}';
      const l_data = '{{ $log_data }}';
      console.log(stats);
      console.log(l_data);
      if(stats === 'success'){
        DisplaySuccessModal(l_data);
      }else{
        LogHistory("{{ route('getHistoryData') }}?cust_id={{ $user_id }}", "{{ route('getLogInfo') }}", "{{ $customer->customer_type }}", 'redirect', 'dummy');
      }

    
    }
    function  DisplaySuccessModal(ids){
 
      const url = "{{ route('getLogDetails') }}?log_id=" + ids;
      axios.get(url)
            .then(function (response) {
           
            const fetchData = response.data.log_details;
           
            const date = document.getElementById('succ_date');
            const time = document.getElementById('succ_time');
            const total = document.getElementById('succ_total_time');
            const payment = document.getElementById('succ_payment');
            const status = document.getElementById('succ_status');
        
            const diff = timeDifference(fetchData.log_start_time, fetchData.log_end_time);

            const checkStatus = fetchData.log_transaction.split('-');
            date.innerHTML = '<strong>Date: ' + fetchData.log_date + '</strong>';
            time.innerHTML = '<strong>' + fetchData.log_start_time + ' - ' + fetchData.log_end_time + '</strong>';
            total.innerHTML = '<strong>Total Time: ' + diff.hours + 'Hrs & ' + diff.minutes + 'minutes</strong>';
            payment.innerHTML = '<strong>Cost: ₱' + PaymentCalc(diff.hours, diff.minutes, '{{ $customer->customer_type }}') + '</strong>';
            if(checkStatus[1] === '2'){
              status.innerHTML = '<strong>Account Credit - Paid</strong>';
            }else{
              if(fetchData.log_status == 2){
                status.innerHTML = '<strong>Cash - Paid</strong>';
              } else{
                status.innerHTML = '<strong>Cash - Unpaid</strong>';
              }
           
            }
           
            })
           .catch(function (error) {
            console.error(error);
            });
    };
  </script>



  
</body>


</html>