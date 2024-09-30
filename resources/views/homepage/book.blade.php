<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Book Reservation - Orange Shire'])
    <link href="{{ asset('calendar/css/evo-calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('calendar/css/evo-calendar.orange-coral.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/booking.css">
</head>
<style>
    .select{
        transition: width 0.3s ease-in-out;
    }
    .nextBtn{
        transition: width 0.3s ease-in-out;
    }
</style>
<body>
    <div class="reservationLoading" id="reservationLoading">
        <div class="loader"></div>
      </div>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->



        <!-- Navbar Start -->
        @include('homepage/Components/nav', ['active'=>'reservation' , 'cookie_val'=>$customer_id])
        <!-- Navbar End -->


        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Book a Reservation</h1>
                    <p>Select room and select prefer date in the calendar to book reservation and proceed filling up the form below it</p>
                </div>

                <div class="row">
                    <div class=" col-md-9 col-12 ">
                        <div id="calendars"></div>
                    </div>
                    <div class="col-md-3 col-12 d-flex flex-column" style="height: 80vh;overflow-y: auto;" id="reservationButtons">

                    </div>

                </div>

                </div>


            </div>
        </div>


        <!-- Modal -->
<div class="modal fade" id="reserveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Complete Reservation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row w-100">
                <div class="col-12 col-md-4">
                    <h3> Details</h3>

                    <p> <i class="fa-regular fa-clock"></i> Time</p>
                    <p><i class="fa-solid fa-calendar-check"></i> Date</p>
                    <br>
                    <h5>Reminders</h5>
                    <p> <i class="fa fa-info"></i> Please ensure all details are correct before submitting your reservation. Choose whether you're reserving an office room or a hot desk. Select the date, time, and duration of your booking. Don’t forget to provide your contact information, and if applicable, include any specific room preferences or special requests. Double-check your details to avoid any mistakes. Once everything is complete, click the submit button to confirm your reservation. </p>
                </div>

                <div class="col-12 col-md-8">
                    <h3> Fill up form </h3>
                    <div class="d-flex flex-column gap-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                            <label for="name">Your Name</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                            <label for="name">Email</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                            <label for="name">Contact</label>
                        </div>
                        <div class="d-flex w-100 justify-content-end">
                            <button type="button" class="btn btn-primary rounded-pill" data-bs-dismiss="modal">Add Guest Emails</button>
                        </div>

                        <div class="form-group">
                            <label for="selectReserve">What do you want to reserve?</label>
                            <select class="form-select" aria-label="What do you want to reserve?" id="selectReserve">
                                <option selected disabled>-----Reserve-----</option>
                                <option value="1">Hotdesk</option>
                                <option value="2">Room</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
        @include('homepage/Components/footer')
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('calendar/js/evo-calendar.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="/js/booking.js"></script>
</body>

</html>
