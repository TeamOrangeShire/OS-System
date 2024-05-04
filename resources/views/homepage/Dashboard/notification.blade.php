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
        $notif = App\Models\CustomerNotification::where('user_id', $user_id)->where('user_type', 'Customer');
        $notifUnread = $notif->where('notif_status', 0)->orderBy('created_at', 'desc')->get();
        $notifRead = $notif->where('notif_status', 1)->orderBy('created_at', 'desc')->get();
    @endphp
          <!-- List group with Advanced Contents -->
          <div class="list-group">
            @foreach ($notifUnread as $notif)
            @php
                $pastTime = PastTimeCalc($notif->created_at);

                if($pastTime[0]>=24){
                    $calcTime = $pastTime[2]. " days ago";
                }else{
                    $calcMinutes =$pastTime[1] % 60;
                    $calcTime = $pastTime[0]. " hrs, ". $calcMinutes . "mins ago";
                }
            @endphp
            <button class="list-group-item list-group-item-action active" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{!! $notif->notif_header !!}</h5>
                  <small>{{ $calcTime }}</small>
                </div>
                <p class="mb-1">{!! substr($notif->notif_message,0, 40). "...." !!}</p>
                <small>Unread</small>
            </button>
            @endforeach
            @foreach ($notifRead as $notif)
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">List group item heading</h5>
                  <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Some placeholder content in a paragraph.</p>
                <small class="text-muted">And some muted small print.</small>
              </a>
            @endforeach

     


  </main><!-- End #main -->




  <!-- script end for change password -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->


  
</body>


</html>