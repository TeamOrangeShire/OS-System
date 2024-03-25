
<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Subscriptions - Orange Shire'])

</head>

<body>

  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>My Subscriptions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Subscriptions</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!--Progress Bar Start-->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hybrid Pros</h5>
              <h6>Consumable Hours</h6>

              <!-- Progress Bars with labels-->
              <div class="progress mt-3" style="height: 40px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">22.5 hrs</div>
              </div>
              <button type="button" class="btn btn-primary py-1 px-3 me-2 mt-3">Continue</button>

            </div>
          </div>
        </div>

        
      </div>
    </section>
    <!--Progress Bar End-->

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->


  
</body>


</html>