<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Blogs - Orange Shire'])

<style>
  
.page-header {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.295)), url(../img/pheader1.jpg), no-repeat center center;
  background-size: co;
}

</style>

</head>

<body style="background-color: #ffffff !important">

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('homepage/Components/nav', ['active'=>'blogs', 'cookie_val'=>$customer_id])
        <!-- Navbar End -->

            <!-- Header Start -->
            <div class="container-fluid page-header">
                <div class="container">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                        <h3 class="display-4 text-uppercase" style="color: #ffff;">Blog Post</h3> 
                        <div class="d-inline-flex text-black" >
                            <p class="m-0 text-uppercase" style="font-weight: bold;"><a class="text-white" href="">Home</a></p> 
                            <i class="fa fa-angle-double-right pt-1 px-3" style="font-weight: bold; color: #01a101;"></i>
                            <p class="m-0 text-uppercase" style="font-weight: bold; color: black;"> <a class="text-white" href=""> Pages </a></p> 
                            <i class="fa fa-angle-double-right pt-1 px-3" style="font-weight: bold; color: #01a101;"></i>
                            <p class="m-0 text-uppercase" style="font-weight: bold; color: #ff5c40;">Blog Post</p> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->


 

        <!-- Category Start -->
        <br><br><br>
        <div class="container-xxl py-5">
          <div class="container">
              <div class="row g-0 gx-5 align-items-end">
                  <div class="col-lg-6">
                      <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                          <h1 class="mb-3">Orange Shire Coworking Blog Posts</h1>
                      </div>
                  </div>
                  <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                      <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                          <li class="nav-item me-2">
                              <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                          </li>
                          <li class="nav-item me-2">
                              <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                          </li>
                          <li class="nav-item me-0">
                              <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="tab-content">
                  <div id="tab-1" class="tab-pane fade show p-0 active">
                    @php
                      $blogs = App\Models\Blog::all();
                    @endphp
                    @foreach ($blogs as $blog)
                    <div class="row g-4">
                      <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                          <div class="property-item rounded overflow-hidden">
                              <div class="position-relative overflow-hidden">
                                  <a href="{{ route('blogContentCustomer', ['id'=>$blog->blog_url_id]) }}"><img class="img-fluid" src="{{ asset('img/os_logo.png') }}" alt=""></a>
                              </div>
                              <div class="p-4 pb-0">
                                
                                  <a class="d-block h5 mb-2" href="{{ route('blogContentCustomer', ['id'=>$blog->blog_url_id]) }}">Golden Urban House For Sell</a>
                                  <p>123 Street, New York, USA</p>
                              </div>
                              <div class="d-flex border-top">
                                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-eye text-primary me-2"></i>100</small>
                                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-heart text-primary me-2"></i>30</small>
                                  <small class="flex-fill text-center py-2"><i class="fa fa-message text-primary me-2"></i>22</small>
                              </div>
                          </div>
                      </div>
                    
                  </div>
                    @endforeach
                  </div>
                  <div id="tab-2" class="tab-pane fade show p-0">
                     
                  </div>
                  <div id="tab-3" class="tab-pane fade show p-0">
                     
                  </div>
              </div>
          </div>
      </div>



        <!-- Call to Action Start -->
       
        <!-- Call to Action End -->


       @include('homepage/Components/footer')


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>