<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Get In Touch</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>21st Lacson Street, Bacolod City</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+63966 065 8143</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>TheOrangeShire@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/orangeshire?igsh=MzRlODBiNWFlZA=="><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/people/Orange-Shire-Coworking/61554372145450/"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Quick Links</h5>
                <a class="btn btn-link text-white-50" href="{{ route('home') }}">Home</a>
                <a class="btn btn-link text-white-50" href="{{ route('contact') }}">Contact Us</a>
                <a class="btn btn-link text-white-50" href="{{ route('solutions') }}">Our Services</a>
                <a class="btn btn-link text-white-50" href="{{ route('reservation') }}">Reservation</a>
                
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Photo Gallery</h5>
                <div class="row g-2 pt-2">
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('img/os_1.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('img/os_2.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('img/os_3.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('img/os_8.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('img/os_5.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('img/os_6.jpg') }}" alt="">
                    </div>
                </div>
            </div>
           <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Stay Updated</h5>
                <p>Sign up to recieve future updates about new promos and services at Orange Shire</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="{{ route('home') }}">Orange Shire</a>, All Right Reserved. 
                    
                    
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="">Cookies</a>
                        <a href="">Help</a>
                        <a href="">FQAs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>