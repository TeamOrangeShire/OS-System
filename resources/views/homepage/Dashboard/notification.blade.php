<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Profile - Orange Shire'])

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
      <h1>Notifications</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customerHome') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customerProfile') }}">Profile</a></li>
          <li class="breadcrumb-item active">Notification</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    @php
        $notification = App\Models\CustomerNotification::where('user_id', $user_id)->where('user_type', 'Customer')->get();
        
    @endphp
          <!-- List group with Advanced Contents -->
          <div class="list-group">
            @foreach ($notification as $notif)
            @php
                $pastTime = PastTimeCalc($notif->created_at);

                if($pastTime[0]>=24){
                    $calcTime = $pastTime[2]. " days ago";
                }else{
                    $calcMinutes =$pastTime[1] % 60;
                    $calcTime = $pastTime[0]. " hrs, ". $calcMinutes . "mins ago";
                }
            @endphp
            <button class="list-group-item list-group-item-action {{ $notif->notif_status === 1? '' : 'active' }}" {{ $notif->notif_status === 1 ? '' : 'aria-current="true"' }}>
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{!! $notif->notif_header !!}</h5>
                  <small>{{ $calcTime }}</small>
                </div>
                <p class="mb-1">{!! substr($notif->notif_message,0, 40). "...." !!}</p>
                <small>{{ $notif->notif_status === 0 ? 'Unread' : 'Read' }}</small>
            </button>
            @endforeach
        
     


  </main><!-- End #main -->




  <!-- script end for change password -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->


  
</body>


</html>