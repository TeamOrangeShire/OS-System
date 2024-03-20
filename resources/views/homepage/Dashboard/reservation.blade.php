
<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Reservation - Orange Shire'])

</head>

<body>

  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>My Reservation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Reservation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->



  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->

  
</body>


</html>