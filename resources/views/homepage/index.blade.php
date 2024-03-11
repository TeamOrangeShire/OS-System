<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Orange Shire'])
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
         @include('homepage/Components/nav', ['active'=>'home'])
        <!-- Navbar End -->

         @include('homepage/Components/cookies')
        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0 mt-4">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">A <span class="text-primary">Coworking</span> and <span class="text-primary">Costudying Space</span> in the heart of Bacolod City</h1>
                    <p class="animated fadeIn mb-4 pb-2">Join us at our vibrant coworking and costudying space, where productivity thrives amidst a supportive community, right in the heart of Bacolod City.</p>
                    <a href="{{ route('services') }}" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Browse Services</a>
                </div>
                <div class="col-md-6 animated fadeIn ">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/os_1.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/os_2.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/os_8.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/os_9.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                          <img class="img-fluid" src="img/os_3.jpg" alt="">
                      </div>
                      <div class="owl-carousel-item">
                        <img class="img-fluid" src="img/os_5.jpg" alt="">
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Search Start -->
        <!-- <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
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
        </div> -->
        <!-- Search End -->


        <!-- Category Start -->
        <br><br><br><br>
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Amenities</h1>
                    <p>Indulge in luxury with our premium amenities, ensuring a delightful experience for every customer.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_a1.png" alt="Icon">
                                </div>
                                <h6>Free Coffee</h6>
                            </div>
                        </a>
                    </div>
                 
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_a2.png" alt="Icon">
                                </div>
                                <h6>Unli Fast Internet</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_a3.png" alt="Icon">
                                </div>
                                <h6>Quiet Space</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/os_a4.png" alt="Icon">
                                </div>
                                <h6>Generator-ready</h6>
                            </div>
                        </a>
                    </div>
             
                </div>
            </div>
        </div> 
        <!-- Category End -->


        <!-- About Start -->
        <br><br>
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/os_6.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Where Passion Meets Purpose: The Orange Shire Experience</h1>
                        <p class="mb-4">Welcome to Orange Shire, a dynamic co-working and co-studying space situated in the heart of Bacolod City. Our vibrant hub is tailored to meet the diverse needs of students, teachers, board and bar exam reviewers, as well as hybrid professionals and freelancers. Nestled in this thriving city, Orange Shire provides a conducive environment for collaborative learning and innovation. Equipped with state-of-the-art facilities and flexible workspaces, our goal is to create a space where individuals from various backgrounds can come together to share ideas, knowledge, and expertise. Whether you're gearing up for exams, working on projects, or seeking a hub to enhance your professional skills, Orange Shire is the perfect blend of innovation and education. Join us on this exciting journey of collaboration, creativity, and continuous learning at Orange Shire.</p>

                        <a class="btn btn-primary py-3 px-5 mt-3" href="{{ route('contact') }}">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Property List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">Our Services</h1>
                            <p>Explore Orange Shire's suite of specialized services designed to enhance your coworking and costudying experience.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">All Services</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">Favorites</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">Promos</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_hotdesk.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Favorites</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Coworking area</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Hot Desk</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> Hourly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-hourglass-start" style="color: #ff5c40;"></i> 3 Hours</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i> Others</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_fixeddesk.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Featured</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Coworking Area</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Fixed Desk</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-calendar-week" style="color: #ff5c40;"></i> Weekly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-calendar-days" style="color: #ff5c40;"></i> Monthly</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <!-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div> -->
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Meeting Rooms</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Private Rooms</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> Hourly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-hourglass-start" style="color: #ff5c40;"></i> 4 Hours</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i> Others</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_8.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Favorites</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Consumable</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Hybrid Pros</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 30 Hours</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 50 Hours</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 70 Hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Featured</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Short Description</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Printer Services</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> B&W</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> Color</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> Scan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3"></div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Shop</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Others</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i>Other Services</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                <br>
                                <a class="btn btn-primary py-3 px-5" href="{{ route('services') }}">Browse More Services</a>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_hotdesk.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Favorites</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Coworking area</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Hot Desk</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> Hourly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-hourglass-start" style="color: #ff5c40;"></i> 3 Hours</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i> Others</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_fixeddesk.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Featured</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Coworking Area</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Fixed Desk</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-calendar-week" style="color: #ff5c40;"></i> Weekly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-calendar-days" style="color: #ff5c40;"></i> Monthly</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <!-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div> -->
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Meeting Rooms</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Private Rooms</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> Hourly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-hourglass-start" style="color: #ff5c40;"></i> 4 Hours</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i> Others</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_8.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Favorites</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Consumable</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Hybrid Pros</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 30 Hours</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 50 Hours</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 70 Hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Featured</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Short Description</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Printer Services</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> B&W</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> Color</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> Scan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3"></div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Shop</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Others</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i>Other Services</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                <br>
                                <a class="btn btn-primary py-3 px-5" href="{{ route('services') }}">Browse More Services</a>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_hotdesk.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Favorites</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Coworking area</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Hot Desk</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> Hourly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-hourglass-start" style="color: #ff5c40;"></i> 3 Hours</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i> Others</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_fixeddesk.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Featured</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Coworking Area</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Fixed Desk</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-calendar-week" style="color: #ff5c40;"></i> Weekly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-calendar-days" style="color: #ff5c40;"></i> Monthly</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <!-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div> -->
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Meeting Rooms</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Private Rooms</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> Hourly</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-hourglass-start" style="color: #ff5c40;"></i> 4 Hours</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i> Others</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_8.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Favorites</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Consumable</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Hybrid Pros</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 30 Hours</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 50 Hours</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-clock-rotate-left" style="color: #ff5c40;"></i> 70 Hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Featured</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Short Description</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Printer Services</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> B&W</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> Color</small>
                                        <small class="flex-fill text-center py-2"><i class="fa-solid fa-print" style="color: #ff5c40;"></i> Scan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="img/os_2.jpg" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3"></div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Shop</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2" href="">Others</a>
                                        <p>Description</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa-solid fa-list-check" style="color: #ff5c40;"></i>Other Services</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                <br>
                                <a class="btn btn-primary py-3 px-5" href="{{ route('services') }}">Browse More Services</a>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- Property List End -->


        <!-- Call to Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded w-100" src="img/os_loc.jpg" alt="">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3">Contact Us and Reserve Now!</h1>
                                    <p>Call us for more information about the promo you would like to avail and more.</p>
                                </div>
                                <a href="{{ route('contact') }}" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-phone-alt me-2"></i>Contact Us</a>
                                <a href="{{ route('reservation') }}" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Reserve Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->


        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">The Shire's Purpose</h1>
                    <p>Orange Shire is established to make a home for different types of learners, be it on the academe or in profession. Assembled by a group of people that values teamwork and collaboration, it is a place for costudying and coworking for all. <br>Come and experience the Shire life.</p>
                </div>
                <div class="row g-4" style="display: flex; justify-content: center;">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/os_c1.jfif" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Students and Teachers</h5>
                                <small>
                                    Orange Shire offers students and teachers a dynamic environment where learning and teaching intersect seamlessly. With versatile spaces for focused study, collaborative projects, and engaging workshops, Orange Shire fosters a vibrant educational community tailored to both learners and educators.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/os_c2.jfif" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Freelancers</h5>
                                <small>
                                    Freelancers at Orange Shire thrive in a flexible and supportive workspace designed to fuel productivity and creativity. From hot desks for spontaneous collaborations to private rooms for focused work, Orange Shire offers the ideal environment for freelancers to pursue their passions and projects.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/os_c3.jfif" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Board & BAR exam Reviewers</h5>
                                <small>Orange Shire provides a conducive space for board and bar exam reviewers to excel in their studies. With quiet areas for focused preparation and communal spaces for group discussions and knowledge sharing, Orange Shire offers a tailored environment to help reviewers achieve their goals with confidence.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/os_c4.jfif" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Hybrid Professionals</h5>
                                <small>
                                    Orange Shire caters to the needs of hybrid professionals, offering a dynamic setting that seamlessly blends work and learning. With adaptable workspaces and access to networking opportunities, Orange Shire empowers hybrid professionals to excel in both their professional endeavors and ongoing educational pursuits.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Our Clients Say!</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Client Name</h6>
                                    <small>Profession</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-2.jpg" style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Client Name</h6>
                                    <small>Profession</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-3.jpg" style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Client Name</h6>
                                    <small>Profession</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        

        <!-- Footer Start -->
      @include('homepage/Components/footer')
        <!-- Footer End -->


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