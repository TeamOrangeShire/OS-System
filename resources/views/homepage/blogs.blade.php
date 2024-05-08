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
       <div class="container d-flex align-items-center justify-content-center">
        <style>
            .loaderss {
  --col1: rgba(228, 19, 141, 0.925);
  --col2: rgb(255, 179, 80);
  font-size: 2em;
  font-weight: 600;
  perspective: 800px;
  position: relative;
}

.loaderss::after,
.loaderss::before,
.loaderss .text::after,
.loaderss .text::before {
  perspective: 800px;
  animation: anim 2s ease-in-out infinite, dotMove 10s ease-out alternate infinite, move 10s linear infinite 1s;
  ;
  content: '●';
  color: var(--col1);
  position: absolute;
  translate: -60px 500px;
  width: 5px;
  height: 5px;
}

.loaderss::before {
  animation-delay: 3s;
  color: var(--col1);
}

.loaderss .text::before {
  color: var(--col2);
  animation-delay: 2s;
}

.loaderss .text::after {
  color: var(--col2);
}

.loaderss .text {
  animation: anim 20s linear infinite, move 10s linear infinite 1s;
  color: transparent;
  background-image: linear-gradient(90deg, 
  var(--col1) 0%,
  var(--col2) 100%);
  background-clip: text;
  background-size: 100%;
  background-repeat: no-repeat;
  transform: skew(5deg, -5deg);
  -webkit-background-clip: text;
  position: relative;
}

@keyframes anim {
  0%, 100% {
    text-shadow: 2px 0px 2px rgba(179, 158, 158, .5);
  }

  50% {
    background-size: 0%;
    background-position-x: left;
    text-shadow: 2px 10px 6px rgba(179, 158, 158, 1);
  }
}

@keyframes move {
  50% {
    translate: 0px 0px;
    rotate: x 60deg;
    transform: skew(-5deg, 5deg);
  }
}

@keyframes dotMove {
  0%, 100% {
    translate: -60px 300px;
  }

  50% {
    translate: 160px -250px;
    scale: .5;
    opacity: .85;
  }
}
        </style>
        <div class="loaderss">
            <p class="text">
             "Blog Post" Coming Soon!!!!
            </p>
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