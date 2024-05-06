<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'View Notification - Orange Shire'])

</head>

<body>

  @php
  $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
  $profile = $customer->customer_profile_pic;
@endphp
  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav', ['user_id'=>$user_id])
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Notification</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customerProfile') }}">Profile</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customerNotification') }}">Notification</a></li>
          <li class="breadcrumb-item active">View</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
   @php
    $notification = App\Models\CustomerNotification::where('notif_id', $notif)->first();
   @endphp
    <div class="container w-100 p-4 border border-2 border-secondary shadow rounded">
     <h3 class="text-center">{{ $notification->notif_header }}</h3>
      <div class="container rounded w-100 border border-1 p-3 text-left">
        @php
            switch($notification->notif_table){
              case 'customer_logs':
                 $notif_data = App\Models\CustomerLogs::where('log_id', $notification->notif_table_id)->first();
                 $columns = ['Date', 'Start Time', 'End Time', 'Status', 'Payment', 'Transaction'];
                 $data = [$notif_data->log_date, $notif_data->log_start_time, $notif_data->log_end_time, 'Paid', explode('-',$notif_data->log_transaction)[0], explode( '-', $notif_data->log_transaction)[0] === 2 ? 'Credit':'Walkin' ];
                 break;
              default:
                 break;
            }
            $counter = 0;
        @endphp
        @foreach ($columns as $tags)
            <p>{{ $tags }}: {{ $data[$counter] }}</p>
            @php
                $counter++;
            @endphp
        @endforeach
      </div>
    </div>

  </main><!-- End #main -->




  <!-- script end for change password -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->


  
</body>


</html>