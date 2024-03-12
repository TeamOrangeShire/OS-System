<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Services - Orange Shire'])
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
                    <img class="img-fluid" src="img/os_2.jpg" alt="">
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
                            <img class="img-fluid w-100" src="img/os_5.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Hotdesk</h1>
                        <p class="mb-4">Experience the synergy of innovation and collaboration with our premium hot desks tailored for dynamic professionals and learners like you. Our vibrant workspace fosters an environment where creativity thrives and ideas come to life. Equipped with state-of-the-art amenities, our hot desks provide the flexibility you need to work efficiently, while encouraging spontaneous interactions and knowledge exchange. <br><br>Join a community of like-minded individuals, each contributing their unique expertise to a melting pot of ideas. Elevate your collaborative endeavors in a space designed to inspire and empower. Discover the perfect blend of productivity and camaraderie at our hot desks, where success is not just a goal; it's a shared journey.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-xxl py-5" id="hybrid_pros">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_8.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Hybrid Pros</h1>
                        <p class="mb-4">Step into the future of work at our cutting-edge coworking space, tailor-made for dynamic hybrid professionals. A warm welcome awaits those embracing the versatility of both remote and in-person collaboration. Within our state-of-the-art facilities, discover the perfect harmony between focused productivity and collaborative synergy. Seamlessly transition between dedicated private workspaces and vibrant communal areas, fostering a dynamic environment conducive to modern work styles. Fueling your productivity is our commitment to providing lightning-fast internet connectivity, ensuring that your ideas flow seamlessly from conception to execution. Join our innovative community where adaptability meets collaboration, and success is amplified by the unparalleled speed of our cutting-edge connectivity infrastructure.</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Purchase Plan</a>
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
                        <p class="mb-4">Unlock a personalized and consistent workspace experience with our fixed desks, designed to be exclusively yours every time you step into our coworking haven. Once you've seized the opportunity to be part of our premium offering, these dedicated workstations become your go-to space, ensuring familiarity and comfort during every visit. Immerse yourself in a productive environment tailored to your needs, with fixed desks that adapt to your rhythm.
                            <br><br>Moreover, our commitment to providing a seamless work experience extends to our lightning-fast internet connection. Enjoy swift and reliable connectivity at your dedicated fixed desk, ensuring uninterrupted productivity and smooth collaboration. Embrace the future of work with a workspace that is uniquely yours and technologically advanced, where your success is enhanced by the consistency of your surroundings and the speed of our internet services.</p>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5" id="private_rooms">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/MR_3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Private Rooms</h1>
                        <p class="mb-4">Elevate your meeting experience with our exclusive private meeting rooms, ideal for professionals and companies seeking a sophisticated and tailored space. Choose from a range of options, each uniquely designed to accommodate your specific needs. Whether it's Room 1 for an intimate discussion, Room 2 for a collaborative session, or Room 3 for a larger presentation, our private meeting rooms offer versatility and professionalism. <br><br>Experience the epitome of comfort, equipped with modern amenities and seamless technology, ensuring your meetings are not only productive but also conducted in a refined and conducive atmosphere. Elevate your business gatherings with our private meeting rooms, where every choice reflects your commitment to excellence.</p>
                        
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Book Reservation</a>
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
                        <h1 class="mb-4">Printer Services</h1>
                        <p class="mb-4">Immerse yourself in a hassle-free printing experience at our coworking space, crafted to meet the urgent needs of students and professionals navigating dynamic schedules. Our efficient printing solutions guarantee swift turnarounds for last-minute assignments and on-the-go professional printing requirements. Skip the complications with straightforward walk-in service, providing a stress-free solution within the collaborative environment of our coworking space. Elevate your productivity without compromising quality – discover reliable, prompt printing services that seamlessly integrate with your dynamic workstyle at our coworking space.</p>
                       
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