<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Profile - Orange Shire'])
 <link rel="stylesheet" href="{{ asset('tour/tour_style.css') }}">
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
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customerHome') }}">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ $profile === "none" ? asset('User/Customer/placeholder.png') : asset('User/Customer/'. $profile) }}" alt="Profile" class="rounded-circle" style="width: 100px; height:100px;">
              <h2>{{ $fullname }}</h2>
             
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
             
              <div class="tab-content">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
         
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$fullname}}</div>
                  </div>

                
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">E-mail</div>
                    <div class="col-lg-9 col-md-8">{{$customer->customer_email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                    <div class="col-lg-9 col-md-8">{{$customer->customer_phone_num}}</div>
                  </div>

                </div>

           


            

              </div><!-- End Bordered Tabs -->

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

  
</body>


</html>