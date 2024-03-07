<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Services - Orange Shire'])
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('homepage/Components/nav', ['active'=>'services'])
        <!-- Navbar End -->


        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0 mt-4">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Services</h1> 
                        <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid" src="img/os_7.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Search Start -->
        <!--<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Property Type</option>
                                    <option value="1">Property Type 1</option>
                                    <option value="2">Property Type 2</option>
                                    <option value="3">Property Type 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Location</option>
                                    <option value="1">Location 1</option>
                                    <option value="2">Location 2</option>
                                    <option value="3">Location 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- Search End -->


        <!-- About Start -->
        <div class="container-xxl py-5" id="hotdesk">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Hotdesk</h1>
                        <p class="mb-4">Orange Shire is more than a coworking and costudying space; it's a vibrant community hub in the heart of Bacolod City, dedicated to fostering innovation, connection, and professional growth. Our mission is to provide a dynamic environment where individuals and businesses thrive, creating a shared space for success and collaboration.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Unli Coffee</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Fast Internet</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Quite Space</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-xxl py-5" id="hybrid_pros">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Hybrid Pros</h1>
                        <p class="mb-4">Orange Shire is more than a coworking and costudying space; it's a vibrant community hub in the heart of Bacolod City, dedicated to fostering innovation, connection, and professional growth. Our mission is to provide a dynamic environment where individuals and businesses thrive, creating a shared space for success and collaboration.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Unli Coffee</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Fast Internet</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Quite Space</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

          
        <div class="container-xxl py-5" id="fixed_desk">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Fixed Desk</h1>
                        <p class="mb-4">Orange Shire is more than a coworking and costudying space; it's a vibrant community hub in the heart of Bacolod City, dedicated to fostering innovation, connection, and professional growth. Our mission is to provide a dynamic environment where individuals and businesses thrive, creating a shared space for success and collaboration.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Unli Coffee</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Fast Internet</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Quite Space</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5" id="private_rooms">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Private Rooms</h1>
                        <p class="mb-4">Orange Shire is more than a coworking and costudying space; it's a vibrant community hub in the heart of Bacolod City, dedicated to fostering innovation, connection, and professional growth. Our mission is to provide a dynamic environment where individuals and businesses thrive, creating a shared space for success and collaboration.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Unli Coffee</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Fast Internet</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Quite Space</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5" id="printer_service">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Printer Service</h1>
                        <p class="mb-4">Orange Shire is more than a coworking and costudying space; it's a vibrant community hub in the heart of Bacolod City, dedicated to fostering innovation, connection, and professional growth. Our mission is to provide a dynamic environment where individuals and businesses thrive, creating a shared space for success and collaboration.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Unli Coffee</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Fast Internet</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Quite Space</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5" id="others">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Others</h1>
                        <p class="mb-4">Orange Shire is more than a coworking and costudying space; it's a vibrant community hub in the heart of Bacolod City, dedicated to fostering innovation, connection, and professional growth. Our mission is to provide a dynamic environment where individuals and businesses thrive, creating a shared space for success and collaboration.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Unli Coffee</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Fast Internet</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Quite Space</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Call to Action Start -->
       
        <!-- Call to Action End -->


       @include('homepage/Components/footer')


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

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