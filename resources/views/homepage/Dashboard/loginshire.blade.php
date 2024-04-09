<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'Customer Login - Orange Shire'])

</head>

<body>

  @php
  $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
  $customer_ext = $customer->customer_ext === 'none' ?   '' : $customer->customer_ext;
  $fullname = $customer->customer_firstname . " " . $customer->customer_middlename[0]. ". ". $customer->customer_lastname. " " . $customer_ext;
  $profile = $customer->customer_profile_pic;
@endphp
  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav', ['user_id'=>$user_id])
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Log In to Shire</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customerProfile') }}">Profile</a></li>
          <li class="breadcrumb-item active">Log in</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <button type="button" onclick="startScan()" class="btn btn-primary mb-4"><i class="bx bx-qr-scan"></i> Scan QR Code</button>
                  <div id="qrScanner" style="display: none;"></div>
       <div class="card">
        <div class="card-body">
          <h5 class="card-title">Customer Type: {{$customer->customer_type}}</h5>

          <!-- Default Tabs -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="true">Status</button>
            </li>
            <li class="nav-item" role="presentation">
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
                  <p class="card-text">End Time: <span id="login_end"></span></p>
                  <p class="card-text">Total Hours: <span id="login_total"></span></p>
                  <p class="card-text">Payment: <span id="login_payment"></span></p>
                  <p class="card-text">Mode of Payment: <span id="login_mode"></span></p>
                  <p class="card-text">Status: <span id="login_final_status"></span></p>
                
                </div>
              </div>
            </div>
            <div class="tab-pane fade table-responsive" id="history" role="tabpanel" aria-labelledby="history-tab">
              
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Total Hours</th>
                      <th>Payment</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $logs = App\Models\CustomerLogs::where('customer_id', $user_id)->orderBy('created_at', 'desc')->get();
                @endphp
                @foreach ($logs as $l)
                <tr>
                  <td>{{ $l->log_date }}</td>
                  <td>{{ $l->log_start_time }}</td>
                  <td>{{ $l->log_end_time }}</td>
                  <td>none</td>
                  <td>none</td>
                </tr>
                @endforeach
               
                  
                  </tbody>
                </table>
            </div>
          
          </div><!-- End Default Tabs -->

        </div>
      </div>
    
  </main><!-- End #main -->




  <!-- script end for change password -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')
  <script>
    
    window.onload = function() {
      LoginStatusFetch("{{ route('getCustomerLoginStatus') }}", "{{ $customer->customer_type }}");
    };
  </script>
  <!-- Template Main JS File -->


  
</body>


</html>