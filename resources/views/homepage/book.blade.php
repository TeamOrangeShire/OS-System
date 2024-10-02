<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Book Reservation - Orange Shire'])
    <link href="{{ asset('calendar/css/evo-calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('calendar/css/evo-calendar.orange-coral.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
          <button type="button" id="closeReservation" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row w-100">
                <div class="col-12 col-md-4">
                    <h3> Details</h3>

                    <p> <i class="fa-regular fa-clock"></i> Time: <span id="selectedTimeModal"></span></p>
                    <p><i class="fa-solid fa-calendar-check"></i> Date: <span id="selectedDateModal"></span></p>
                    <br>
                    <h5>Reminders</h5>
                    <p> <i class="fa fa-info"></i> Please ensure all details are correct before submitting your reservation. Choose whether you're reserving an office room or a hot desk. Select the date, time, and duration of your booking. Don’t forget to provide your contact information, and if applicable, include any specific room preferences or special requests. Double-check your details to avoid any mistakes. Once everything is complete, click the submit button to confirm your reservation. </p>
                </div>

                <form id="submitReservationForm" class="col-12 col-md-8">
                    @csrf
                    <input type="hidden" id="startDateReservation" name="startDate">
                    <input type="hidden" id="startTimeReservation" name="startTime">
                    <input type="hidden" name="endTime" id="endTimeReservation">
                    <h3> Fill up form </h3>
                    <div class="d-flex flex-column gap-1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="eg Jose Rizal">
                        </div>
                        <div class="form-group mt-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="eg youremail@domain.com">
                        </div>
                        <div class="form-group mt-2">
                            <label for="contact">Contact</label>
                            <input type="number" class="form-control" id="contact" name="contact" required placeholder="eg 09XXXXXXXX">
                        </div>
                        <div class="d-flex w-100 justify-content-end" id="addGuestBtnDiv">
                            <button id="addGuestBtn" type="button" class="btn btn-primary rounded-pill" >Guest Email/s(Optional)</button>
                        </div>
                        <div class="mb-3 mt-3 d-none form-group" id="addGuestDiv">
                            <label for="addGuestInput" class="form-label">Notify up to 13 emails for the reservation</label>
                            <textarea class="form-control" id="addGuestInput" name="guestemails" rows="3"></textarea>
                            <small>Please use comman(,) or spaces to seperate emails</small>
                          </div>

                          <div class="mb-3 mt-2 form-group">
                            <label for="addGuestInput" class="form-label">Do you have some request in your reservation?</label>
                            <textarea class="form-control" name="reservationRequest" rows="3"></textarea>
                          </div>

                        <div class="form-group">
                            <label for="selectReserve">What do you want to reserve?</label>
                            <select required class="form-select" name="reserveType" aria-label="What do you want to reserve?" id="selectReserve">
                                <option value="" selected disabled>-----Reserve-----</option>
                            </select>
                        </div>

                        <div class="form-group mt-2 d-none" id="selectPaxDiv">
                            <label for="selectPax">How many people are in your group?</label>
                            <select name="pax" class="form-select" aria-label="How Many People?" id="selectPax">
                            </select>

                        </div>
                        <div class="form-group mt-2 d-none" id="selectPaxHotdeskDiv">
                            <label for="selectPax">How many people are in your group?</label>
                            <input name="paxhotdesk" value="1" type="number" class="form-control"  id="selectPaxHotdesk">
                        </div>

                        <div class="form-group mt-2 d-none" id="selectRoomRatesDiv">
                            <label for="selectPax"> Meeting Room Rates </label>
                            <select name="rates" class="form-select" aria-label="RoomRates" id="selectRoomRates">

                            </select>
                        </div>


                        <div class="form-group mt-2 d-none" id="hotdeskDiv">
                            <label for="selectHotdesk">Hotdesk Plans</label>
                            <select name="hotdesk" class="form-select" aria-label="How Many People?" id="selectHotdesk">

                            </select>
                        </div>

                        <div class="form-group mt-2 d-none" id="selectEndDateDiv">
                            <label for="selectEndDate"> Reservation End Date </label>
                            <input name="endDates" type="date" class="form-control" id="selectEndDate">
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="submitReservation" class="btn btn-primary d-flex align-items-center gap-2">Submit Reservation</button>
        </div>
      </div>
    </div>
  </div>
        @include('homepage/Components/footer')

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
