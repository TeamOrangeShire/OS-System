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
       <div id="result"></div>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
       
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Log in History</h5>
              
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>
                        Date
                      </th>
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
                <!-- End Table with stripped rows -->
  
              </div>
            </div>
  
          </div>
        </div>
      </section>
  </main><!-- End #main -->




  <!-- script end for change password -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->


  
</body>


</html>