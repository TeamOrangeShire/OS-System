<!DOCTYPE html>
<html lang="en">
@php
     if($customer_id === 'none'){
        $fulname ='';
        $email = '';
     }else{
        $user = App\Models\CustomerAcc::where('customer_id', $customer_id)->first();
        $fullname = $user->customer_firstname . ' '. $user->customer_middlename[0]. '. '. $user->customer_lastname;
        $email = $user->customer_email;
     }
  
@endphp
<head>
    @include('homepage/Components/header', ['current_page'=>'Book Reservation - Orange Shire'])
    <link href="{{ asset('calendar/css/evo-calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('calendar/css/evo-calendar.orange-coral.min.css') }}" rel="stylesheet">
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
        @include('homepage/Components/nav', ['active'=>'reservation' , 'cookie_val'=>$customer_id])
        <!-- Navbar End -->



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


        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Book a Reservation</h1>
                    <p>Select room and select prefer date in the calendar to book reservation and proceed filling up the form below it</p>
                </div>
                <div class="row g-4 mb-4">
                    @php
                        $room = App\Models\Rooms::orderBy('room_number')->get();
                    @endphp
               <div class="col-md-6">
                <select class="form-control" name="" onchange="selectRoom(this)" id="">
                    <option value="none" disabled selected>Select Room to show calendar</option>
                   @foreach ($room as $r)
                   <option value="{{ $r->room_id }}">Room {{ $r->room_number }}</option>
                   @endforeach
                </select>
                  <div class="container h-80" >
                   @foreach ($room as $cal)
                   <div class="wow fadeInUp" style="height: 90vh; display:none" data-wow-delay="0.1s" id="calendars{{ $cal->room_id }}"></div>
                   @endforeach
                  </div>
               </div>
                      <div class="wow fadeInUp col-md-6" data-wow-delay="0.5s">
                        <p class="mb-4">Fill out the form to complete the reservation process.</p>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" value="{{ $fullname }}">
                                        <label for="name">Full Name (Autofill if Logged in)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email" value="{{ $email }}">
                                        <label for="email">Email (Autofill if Logged in)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Company Name(Optional)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Contact Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="room" placeholder="room">
                                        <label for="subject">Room</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="hidden" id="dateHidden">
                                        <input type="text" class="form-control" id="date" disabled placeholder="date">
                                        <label for="subject">Date</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select id="duration" class="form-control"  name="duration">
                                            <option value="" disabled selected>Select Duration</option>
                                            <option value="4 hours">1 Hour</option>
                                            <option value="4 hours">4 Hours</option>
                                            <option value="full day">Full Day</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                          </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="subject" placeholder="Subject" readonly>
                                        <label for="subject">Price_autosum</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
              
                </div>
            
                </div>

                
            </div>
        </div>
        <!-- Contact End -->
<script>
    
    function selectRoom(inputs){
            HideAllCalendars();
               const cal_name = 'calendars' + inputs.value;
               document.getElementById(cal_name).style.display = '';
               document.value = '';
               document.getElementById('room').value =  inputs.options[inputs.selectedIndex].text;
               
            }

            function HideAllCalendars(){
                const roomArray = @json($room_array);
                roomArray.forEach(function(room){
                const cal_name = 'calendars' + room;
                document.getElementById(cal_name).style.display = 'none';
            });
            }
</script>
        <!-- Footer Start -->
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
    <script>
        $(document).ready(function() {

            const rooms = @json($room_array);
            rooms.forEach(function(room) {

                const cal_name = '#calendars'+room;
                $(cal_name).evoCalendar({   
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

        $(cal_name).on('selectDate', function(event, newDate, oldDate) {
        var currentDate = new Date();
        var selectedDate = new Date(newDate);
        if (selectedDate <= currentDate) {
         
            document.getElementById('date').value = 'Not a valid date!';
            document.getElementById('dateHidden').value = 'Not a valid date!';
        } else {
           document.getElementById('date').value = newDate;
           document.getElementById('dateHidden').value = newDate;
        }
    });
    });

    });
        </script>
</body>

</html>