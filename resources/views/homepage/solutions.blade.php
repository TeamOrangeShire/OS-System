<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Solutions - Orange Shire'])

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
        @include('homepage/Components/nav', ['active'=>'solutions', 'cookie_val'=>$customer_id])
        <!-- Navbar End -->

            <!-- Header Start -->
            <div class="container-fluid page-header">
                <div class="container">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                        <h3 class="display-4 text-uppercase" style="color: #ffff;">Solutions</h3> 
                        <div class="d-inline-flex text-black" >
                            <p class="m-0 text-uppercase" style="font-weight: bold;"><a class="text-white" href="">Home</a></p> 
                            <i class="fa fa-angle-double-right pt-1 px-3" style="font-weight: bold; color: #01a101;"></i>
                            <p class="m-0 text-uppercase" style="font-weight: bold; color: black;"> <a class="text-white" href=""> Pages </a></p> 
                            <i class="fa fa-angle-double-right pt-1 px-3" style="font-weight: bold; color: #01a101;"></i>
                            <p class="m-0 text-uppercase" style="font-weight: bold; color: #ff5c40;">Solutions</p> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->


 

        <!-- Category Start -->
        <br><br><br>
        <div class="container-xxl py-5" style="margin-top: -70px;">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
                    <h1 class="mb-3">Solutions Just For You</h1>
                    <p>Experience the collaborative advantage with Orange Shires' tailored solutions and services, designed to empower coworking space users in achieving their business goals effortlessly.</p>
                </div>
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-2 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="#hotdesk" class="cat-item d-block bg-light text-center rounded p-3" >
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_s1.png" alt="Icon" >
                                </div>
                                <h6>Hot Desk</h6>
                            </div>
                        </a>
                    </div>
                 
                    <div class="col-lg-2 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a href="#hybrid_pros" class="cat-item d-block bg-light text-center rounded p-3" >
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_s2.png" alt="Icon">
                                </div>
                                <h6>Hybrid Pros</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a href="#fixed_desk" class="cat-item d-block bg-light text-center rounded p-3" >
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_s3.png" alt="Icon">
                                </div>
                                <h6>Fixed Desk</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="#private_rooms" class="cat-item d-block bg-light text-center rounded p-3" >
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_s4.png" alt="Icon">
                                </div>
                                <h6 style="font-size: 15px;"> Meeting Rooms</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="#others" class="cat-item d-block bg-light text-center rounded p-3" >
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_s5.png" alt="Icon">
                                </div>
                                <h6>Others</h6>
                            </div>
                        </a>
                    </div>
             
                </div>
            </div>
        </div> 
        <!-- Category End -->
        

<!-- About Start -->
<hr class="my-4">

<div class="container-sm py-5" id="hotdesk">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-4 pe-0">
                    <img class="img-fluid w-100" src="img/s1h.png">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-3">Hotdesk</h1>
                <p class="mb-3">Start working or studying in one of our hot desks in our main area.</p>
            </div>
        </div>
    </div>
</div>
<hr class="my-4">

<div class="container-sm py-5" id="hybrid_pros">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-3">Hybrid Pros</h1>
                <p class="mb-3">Get a cost-saving, multi-hour consumable plan if you plan to work, study, or review for the next several days or weeks.</p>
                <a class="btn btn-primary py-2 px-4 mt-2" href="#">Purchase Plan</a>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-4 pe-0">
                    <img class="img-fluid w-100" src="img/s1p.png" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="my-4">

<div class="container-sm py-5" id="fixed_desk">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-4 pe-0">
                    <img class="img-fluid w-100" src="img/s1f.png" style="max-width: 100%; height: auto;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-3">Fixed Desk</h1>
                <p class="mb-3">If you have a favorite desk you want to use exclusively for a week or more, reserving a fixed desk is perfect for you.</p>
            </div>
        </div>
    </div>
</div>
<hr class="my-4">

<div class="container-sm py-5" id="private_rooms">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-3">Meeting Rooms</h1>
                <p class="mb-3">This is perfect for private meetings, group study sessions, interviews, or even as a private office for your startup.</p>
                <a class="btn btn-primary py-2 px-4 mt-2" href="#">Book Reservation</a>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-4 pe-0">
                    <img class="img-fluid w-100" src="img/s1m.png" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="my-4">

<div class="container-sm py-5" id="others">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-4 pe-0">
                    <img class="img-fluid w-100" src="img/s1o.png" style="max-width: 100%; height: auto;">
                </div>
            </div>
            <div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-3">Others</h1>
                <p class="mb-3">Orange Shire is more than a coworking and co-studying space; it's a vibrant community hub in the heart of Bacolod City, dedicated to fostering innovation, connection, and professional growth.</p>
                <p class="mb-3">Our mission is to provide a dynamic environment where individuals and businesses thrive, creating a shared space for success and collaboration.</p>
                <ul class="list-unstyled mb-3">
                    <li><i class="fa fa-check text-primary me-2"></i>Unlimited Coffee</li>
                    <li><i class="fa fa-check text-primary me-2"></i>Fast Internet</li>
                    <li><i class="fa fa-check text-primary me-2"></i>Quiet Space</li>
                </ul>
                <a class="btn btn-primary py-2 px-3 mt-2" href="#">Contact Us</a>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">
<!-- About End -->




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