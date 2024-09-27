<!DOCTYPE html>
<html lang="en">
    <head>
        @include('homepage/Components/header', ['current_page'=>'Reservations - Orange Shire'])
        <link href="{{ asset('calendar/css/evo-calendar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('calendar/css/evo-calendar.orange-coral.min.css') }}" rel="stylesheet">

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
        @include('homepage/Components/nav', ['active' => 'reservation' , 'cookie_val'=>$customer_id])
        <!-- Navbar End -->


            <!-- Header Start -->
            <div class="container-fluid page-header">
                <div class="container">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                        <h3 class="display-4 text-uppercase" style="color: #ffff;">Reservation</h3>
                        <div class="d-inline-flex text-black">
                            <p class="m-0 text-uppercase" style="font-weight: bold;"><a class="text-white" href="">Home</a></p>
                            <i class="fa fa-angle-double-right pt-1 px-3" style="font-weight: bold; color: #01a101;"></i>
                            <p class="m-0 text-uppercase" style="font-weight: bold; color: black;"> <a class="text-white" href=""> Pages </a></p>
                            <i class="fa fa-angle-double-right pt-1 px-3" style="font-weight: bold; color: #01a101;"></i>
                            <p class="m-0 text-uppercase" style="font-weight: bold; color: #ff5c40;">Reservation</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3" id="calendar">See Our Reservation Calendar</h1>
                    <p>Explore our reservation calendar to plan your next productive session at Orange Shire. Click to see availability and secure your preferred time slot.</p>
                </div>
                <div id="calendars"></div>
              <div class="container" style="width: 100%; display:flex; justify-content:center">
                <a class="btn btn-primary py-3 px-5 mt-3" href="{{route('book')}}"><i class="fa-solid fa-calendar-days"></i> Reserve a room</a>
              </div>
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <!-- Template Javascript -->
    <script src="calendar/js/evo-calendar.min.js"></script>
    <script src="js/main.js"></script>
    <script>

$(document).ready(function() {
    $('#calendars').evoCalendar({
        theme:"Orange Coral",
        calendarEvents: [
      {
        id: 'bHay68s', // Event's ID (required)
        name: "New Year", // Event name (required)
        date: "January/1/2020", // Event date (required)
        type: "holiday", // Event type (required)
        everyYear: true // Same event every year (optional)
      },
      {
        name: "Vacation Leave",
        badge: "02/13 - 02/15", // Event badge (optional)
        date: ["February/13/2020", "February/15/2020"], // Date range
        description: "Vacation leave for 3 days.", // Event description (optional)
        type: "event",
        color: "#63d867" // Event custom color (optional)
      }
    ]
    });
});
    </script>
</body>

</html>
