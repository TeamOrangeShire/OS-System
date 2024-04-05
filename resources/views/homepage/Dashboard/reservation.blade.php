
<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Reservation - Orange Shire'])
 <script src="https://kit.fontawesome.com/33f625dcbc.js" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.20/css/uikit.min.css">
 <style>
  .uk-timeline .uk-timeline-item .uk-card {
max-height: 180px;
}

.uk-timeline .uk-timeline-item {
display: flex;
position: relative;
}

.uk-timeline .uk-timeline-item::before {
background: #fff3d9;
content: "";
height: 100%;
left: 19px;
position: absolute;
top: 20px;
width: 2px;
z-index: -1;
}

.uk-timeline .uk-timeline-item .uk-timeline-icon .uk-badge {
margin-top: 20px;
width: 5px;
height: 22px;
}

.uk-timeline .uk-timeline-item .uk-timeline-content {
-ms-flex: 1 1 auto;
flex: 1 1 auto;
padding: 0 0 0 1rem;
}
p{
  font-size:15px;
}
</style>
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

    <!--schedule alert start-->
    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: 100%;">
      <div class="row">
        <i class="fa-regular fa-calendar-check col-md-1 mt-2" style="color: #ff5c40; font-size:50px"></i>
        <p class="col-md-5 p-2 mt-3" style="font-size:15px">You have a reservation on April 5, 2024, 1:00 - 4:00 pm, Room 2.</p>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <!--schedule alert end-->

    <!--reservation logs start-->
      <div class="card">
        <div class="card-body">
          <div class="uk-container uk-padding">
            <div class="uk-timeline">
                <div class="uk-timeline-item">
                    <div class="uk-timeline-icon">
                        <span class="uk-badge"><span uk-icon="check"></span></span>
                    </div>
                    <div class="uk-timeline-content">
                        <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <h3 class="uk-card-title"><time datetime="2020-07-08">April 3</time></h3>
                                    <span class="uk-label uk-label-success uk-margin-auto-left">Feature</span>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                  <p class="uk-text-success">Room 2 reservation completed.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-timeline-item">
                    <div class="uk-timeline-icon">
                        <span class="uk-badge"><span uk-icon="check"></span></span>
                    </div>
                    <div class="uk-timeline-content">
                        <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <h3 class="uk-card-title"><time datetime="2020-07-07">March 25</time></h3>
                                    <span class="uk-label uk-label-warning uk-margin-auto-left">Test</span>
                                </div>
                            </div>
                            <div class="uk-card-body" >
                                  <p>Room 2 Reservation expired.</p>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="uk-timeline-item">
                    <div class="uk-timeline-icon">
                        <span class="uk-badge"><span uk-icon="check"></span></span>
                    </div>
                    <div class="uk-timeline-content">
                        <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <h3 class="uk-card-title"><time datetime="2020-07-06">January 18</time></h3>
                                    <span class="uk-label uk-label-danger uk-margin-auto-left">Fix</span>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <p>Room 2 Reservation cancelled.</p>
                            </div>
                        </div>
                                        <a href="#"><span class="uk-margin-small-right" uk-icon="triangle-down"></span>Load more</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    <!--reservation logs end-->

  </main><!-- End #main -->
  


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.20/js/uikit.min.js"></script>
</body>


</html>