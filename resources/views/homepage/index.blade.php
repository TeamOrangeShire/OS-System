<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Orange Shire'])
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
         @include('homepage/Components/nav', ['active'=>'home', 'cookie_val'=>$customer_id])
        <!-- Navbar End -->

   
        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0 mt-2">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row  ">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">A <span class="text-primary">Coworking</span> and <span class="text-primary">Costudying Space</span> in the heart of Bacolod City</h1>
                    <p class="animated fadeIn mb-4 pb-2">Experience the vibrant atmosphere of our coworking and co-studying space, where productivity thrives amidst a supportive community, right in the heart of Bacolod City.</p>
                    <a href="{{ route('solutions') }}" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Browse Solutions</a>
                </div>
                <div class="col-md-5 animated fadeIn">
                    <div class="owl-carousel header-carousel" style="top: 2rem;">
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

        <!-- AMENITIES Start -->
        <br><br><br><br>
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3">Amenities</h1>
                    <p>Discover a welcoming coworking space that prioritizes your comfort, offering well-equipped workspaces, <br> collaborative meeting areas, and modern amenities to elevate your work experience.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="d-block bg-light text-center rounded p-3">
                            <div class="rounded p-4">
                                <div class=" mb-3">
                                    <img class="img-fluid" src="img/freecoff.jpg" alt="Icon" style="width: 100%;">
                                </div>
                                <h6>Free Brewed Coffee and Tea</h6>
                            </div>
                        </a>
                    </div>
                 
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class=" d-block bg-light text-center rounded p-3">
                            <div class="rounded p-4">
                                <div class=" mb-3">
                                    <img class="img-fluid" src="img/freewifi.jpg" alt="Icon" style="width: 100%;">
                                </div>
                                <h6>Fast Internet</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class=" d-block bg-light text-center rounded p-3">
                            <div class="rounded p-4">
                                <div class=" mb-3">
                                    <img class="img-fluid" src="img/aircon.png" style="width: 100%;">
                                </div>
                                <h6>Airconditioned Spaces</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class=" d-block bg-light text-center rounded p-3">
                            <div class="rounded p-4">
                                <div class=" mb-3">
                                    <img class="img-fluid" src="img/gene.png" alt="Icon" style="width: 100%;">
                                </div>
                                <h6>Generator-ready</h6>
                            </div>
                        </a>
                    </div>
             
                </div>
            </div>
        </div> 
        <!-- AMENITIES End -->


        <!-- About Start -->
        {{-- <br><br>
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
        </div> --}}
        <!-- About End -->




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
                                <div class="d-grid gap-2 d-md-block">
                                     <a href="{{ route('contact') }}" class="btn btn-primary py-3 px-4"><i class="fa fa-phone-alt me-2"></i>Contact Us</a>
                                <a href="{{ route('reservation') }}#calendars" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Reserve Now</a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->


        <!-- Shire's Purpose Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4" style="display: flex; justify-content: center;">
                    <div class="container-xxl py-5" style="margin-bottom: -100px;">
                        <div class="container">
                            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                                <h1 class="mb-3">Why visit the Shire</h1>
                                {{-- <p>Orange Shire is established to make a home for different types of learners, be it on the academe or in profession. Assembled by a group of people that values teamwork and collaboration, it is a place for costudying and coworking for all. <br>Come and experience the Shire life.</p> --}}
                            </div>
                            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                                <div class="testimonial-item bg-light rounded p-3">
                                    <div class="bg-white rounded p-4">
                                        <div class="position-relative">
                                            <img class="img-fluid" src="img/teacher.png" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Students and Teachers</h5>
                                            <small>
                                                The Shire is a place where you can focus on your studies, review for exams, work on your thesis, study with your groupmates, prepare for classes, check and score test papers and more.</small>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="testimonial-item bg-light rounded p-3">
                                    <div class="bg-white rounded p-4">
                                       
                                        <div class="position-relative">
                                            <img class="img-fluid" src="img/freelance.png" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Freelancers</h5>
                                            <small>
                                                Work days or nights at the Shire, connect to our fast internet, get comfortable for the next few hours in one of our hot desks, get a cup of hot brewed coffee to keep you sharp and be able to focus on work.</small>
                                        </div>

                                    </div>
                                </div>
                                <div class="testimonial-item bg-light rounded p-3">
                                    <div class="bg-white rounded p-4">
                                       
                                        <div class="position-relative">
                                            <img class="img-fluid" src="img/review.png" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Board and Bar exam Reviewers</h5>
                                            <small>The Shire is the best place for you to focus on reviewing for that upcoming board or bar exam. Get from one of our multi-hour consumable plans to set you up for the next few weeks to do your exam reviews at the Shire.</small>
                                        </div>

                                    </div>
                                </div>
                                <div class="testimonial-item bg-light rounded p-3">
                                    <div class="bg-white rounded p-4">
                                       
                                        <div class="position-relative">
                                            <img class="img-fluid" src="img/remote.png" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Remote Workers</h5>
                                            <small>
                                                Tired of working from home for several weeks at a time and feeling that cabin fever? Step out of the house once in a while and visit the Shire. Set up in one of our hot desks, meet new friends, and maybe go on breaks to take some walks around the neighborhood.</small>
                                        </div>

                                    </div>
                                </div>
                                <div class="testimonial-item bg-light rounded p-3">
                                    <div class="bg-white rounded p-4">
                                       
                                        <div class="position-relative">
                                            <img class="img-fluid" src="img/startup.png" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Startup Entrepreneurs</h5>
                                            <small>
                                                Starting a new business? Starting up in a coworking space like Orange Shire is a great way to be efficient. For a relatively low cost, you work in an air conditioned space, with fast internet, free coffee and tea and you can even register your business address at the Shire. We can even hook you up with potential business partners.
                                            </small>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                     {{-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/os_c1.jfif" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Students and Teachers</h5>
                                <small>
                                    The Shire is a place where you can focus on your studies, review for exams, work on your thesis, study with your groupmates, prepare for classes, check and score test papers and more.</small>
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
                                    Work days or nights at the Shire, connect to our fast internet, get comfortable for the next few hours in one of our hot desks, get a cup of hot brewed coffee to keep you sharp and be able to focus on work.</small>
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
                                <h5 class="fw-bold mb-0">Board and Bar exam Reviewers</h5>
                                <small>The Shire is the best place for you to focus on reviewing for that upcoming board or bar exam. Get from one of our multi-hour consumable plans to set you up for the next few weeks to do your exam reviews at the Shire.</small>
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
                                <h5 class="fw-bold mb-0">Remote Workers</h5>
                                <small>
                                    Tired of working from home for several weeks at a time and feeling that cabin fever? Step out of the house once in a while and visit the Shire. Set up in one of our hot desks, meet new friends, and maybe go on breaks to take some walks around the neighborhood.</small>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- Shire's Purpose Start -->


        <!-- Testimonial Start -->
        {{-- <div class="container-xxl py-5">
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
        </div> --}}
        <!-- Testimonial End -->
        

        <!-- Footer Start -->
      @include('homepage/Components/footer')
        <!-- Footer End -->


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