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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
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
                        $room = App\Models\Rooms::orderBy('room_number')->where('rooms_disable', '!=', 1)->get();
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
                   <div class="wow fadeInUp mt-4" style="height: 90vh; display:none" data-wow-delay="0.1s" id="calendars{{ $cal->room_id }}"></div>
                   @endforeach
                  </div>
               </div>
                      <div class="wow fadeInUp col-md-6" data-wow-delay="0.5s">
                        <p class="mb-4">Fill out the form to complete the reservation process.</p>
                        <form method="post" id="reservation">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                                        <input type="text" disabled class="form-control" id="name" placeholder="Your Name" value="{{ $fullname }}">
                                        <label for="name">Full Name (Autofill if Logged in)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" disabled class="form-control" id="email" placeholder="Your Email" value="{{ $email }}">
                                        <label for="email">Email (Autofill if Logged in)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="company_name" placeholder="Subject">
                                        <label for="subject">Company Name(Optional)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" oninput="CheckingContact(this)" id="contact" name="contact" placeholder="Subject">
                                        <label for="subject">Contact Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" disabled id="room" placeholder="room">
                                        <label for="subject">Room</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="hidden" id="dateHidden" name="date">
                                        <input type="text" class="form-control" id="date" disabled placeholder="date">
                                        <label for="subject">Select Date in the Calendar</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                     
                                        <select id="duration" class="form-control" onchange="CheckTime(this)"  name="duration">
                                            <option value="" disabled selected>No Data Yet</option>
                                             
                                          </select>
                                          <label for="duration">Duration</label>
                                    </div>
                                </div>
                                <div class="col-12" style="display: none" id="divTime">
                                    <div class="form-floating">
                                        <input type="hidden" name="hiddenTime" id="hiddenTime">
                                        <input type="text" disabled class="form-control" id="vis_time" value="No Selected Time" name="vis_time" placeholder="Subject">
                                        <label for="vis_time">Time</label>
                                    </div>
                                </div>
                              
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" id="submitReservation" onclick="SaveReservation()" disabled type="submit">Fill the Form</button>
                                </div>
                            </div>
                        </form>
              
                        <div class="time-div wow fadeInRight" id="div-time-1" style="display : none ;">
                           <div class="time-layer">
                            <button value="09AM-10AM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn" >9:00AM - 10:00AM</button>
                            <button value="10AM-11AM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">10:00AM - 11:00AM</button>
                            <button value="11AM-12PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">11:00AM - 12:00PM</button>
                            <button value="12PM-01PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">12:00PM - 1:00PM</button>
                           </div>
                           <div class="time-layer">
                            <button value="01PM-02PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">1:00PM - 2:00PM</button>
                            <button value="02PM-03PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">2:00PM - 3:00PM</button>
                            <button value="03PM-04PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">3:00PM - 4:00PM</button>
                            <button value="04PM-05PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">4:00PM - 5:00PM</button>
                           </div>
                           <div class="time-layer">
                            <button value="05PM-06PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">5:00PM - 6:00PM</button>
                            <button value="06PM-07PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">6:00PM - 7:00PM</button>
                            <button value="07PM-08PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">7:00PM - 8:00PM</button>
                            <button value="08PM-09PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">8:00PM - 9:00PM</button>
                           </div>
                           <div class="time-layer">
                            <button value="09PM-10PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">9:00PM - 10:00PM</button>
                            <button value="10PM-11PM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">10:00PM - 11:00PM</button>
                            <button value="11PM-12AM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">11:00PM - 12:00AM</button>
                            <button value="12AM-01AM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">12:00AM - 1:00AM</button>
                           </div>
                           <div class="time-layer">
                            <button value="01AM-02AM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">1:00AM - 2:00AM</button>
                            <button value="02AM-03AM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">2:00AM - 3:00AM</button>
                            <button value="03AM-04AM-1" onclick="TimeButtonCheck(this)" class="comic-button t-btn">3:00AM - 4:00AM</0button>    
                           </div>
                        </div>

                        <div class="time-div wow fadeInRight" id="div-time-4" style="display: none" >
                            <div class="time-layer">
                             <button value="09AM-01PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn" >9:00AM - 1:00PM</button>
                             <button value="10AM-02PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">10:00AM - 2:00PM</button>
                             <button  value="11AM-03PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">11:00AM - 3:00PM</button>
                             <button  value="12PM-04PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">12:00PM - 4:00PM</button>
                            </div>
                            <div class="time-layer">
                             <button  value="01PM-05PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">1:00PM - 5:00PM</button>
                             <button  value="02PM-06PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">2:00PM - 6:00PM</button>
                             <button  value="03PM-07PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">3:00PM - 7:00PM</button>
                             <button  value="04PM-08PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">4:00PM - 8:00PM</button>
                            </div>
                            <div class="time-layer">
                             <button  value="05PM-09PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">5:00PM - 9:00PM</button>
                             <button  value="06PM-10PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">6:00PM - 10:00PM</button>
                             <button  value="07PM-11PM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">7:00PM - 11:00PM</button>
                             <button  value="08PM-12AM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">8:00PM - 12:00AM</button>
                            </div>
                            <div class="time-layer">
                                <button  value="09PM-01AM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">9:00PM - 1:00AM</button>
                                <button value="10PM-02AM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">10:00PM - 2:00AM</button>
                                <button  value="11PM-03AM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">11:00PM - 3:00AM</button>
                                <button  value="12PM-04AM-4" onclick="TimeButtonCheck(this)" class="comic-button t-btn">12:00AM - 4:00AM</button>
                            </div>
                           
                        
                         </div>
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
               document.getElementById('room').value =  inputs.options[inputs.selectedIndex].text;
               SelectRate(inputs.value);
            }

            function HideAllCalendars(){
                const roomArray = @json($room_array);
                roomArray.forEach(function(room){
                const cal_name = 'calendars' + room;
                document.getElementById(cal_name).style.display = 'none';
            });
            }

            function SelectRate(data){
                const url = "{{ route('getRoomRates') }}?room_id="+ data;
                const duration = document.getElementById('duration');
                axios.get(url)
               .then(function (response) {
               const rate_id = response.data.rate_id;
               const rate_name = response.data.rate_name;
               const rate_price = response.data.rate_price;
               let html = '';
               html += '<option disabled selected>Choose Duration/Price</option>';
               for(let i = 0; i<rate_id.length; i++){
                html += "<option value='"+rate_id[i]+ "'" + ">" + rate_name[i] + "/₱" + rate_price[i] + "</option>";
               }
               duration.innerHTML = html;
            
          })
           .catch(function (error) {
      
            console.error('Error:', error);
            })
          .then(function () {
         
          });
            }
           
            function CheckingContact(input){
            
    if (input.value.length > 11) {
        input.value = input.value.slice(0, 11); // Limit input to 12 characters
    }
                if(document.getElementById('contact').value === '' || document.getElementById('contact').value.length < 11 || document.getElementById('submitReservation').textContent === 'Invalid Date! Choose Future dates'){
                    document.getElementById('submitReservation').disabled = true;
                    document.getElementById('submitReservation').textContent ='Invalid Date! Choose Future dates';
                }else if(input.value.length === 11  ){
                    document.getElementById('submitReservation').disabled = true;
                }else{
                    document.getElementById('submitReservation').disabled = false;
                }

           }


           function CheckTime(select){
            const rate_id = select.value;
            const date = document.getElementById('dateHidden').value;
            const url = "{{ route('checkTime') }}?date="+ date + "&rate_id=" + rate_id; 
            axios.get(url)
               .then(function (response) {
                
                const startTime = response.data.timeStart;
                const endTime = response.data.timeEnd;
              
               if(response.data.rate === 4){
                document.getElementById('div-time-4').style.display = '';
                document.getElementById('divTime').style.display = '';
                document.getElementById('div-time-1').style.display = 'none';
                 }else if(response.data.rate === 1){
                document.getElementById('div-time-1').style.display = '';
                document.getElementById('divTime').style.display = '';
                document.getElementById('div-time-4').style.display = 'none';
               }else{
                 document.getElementById('div-time-1').style.display = 'none';
                 document.getElementById('divTime').style.display = 'none';
                 document.getElementById('div-time-4').style.display = 'none';
               }
             })
           .catch(function (error) {
      
            console.error('Error:', error);
            })
          .then(function () {
         
          });
           }
            
        

            function SaveReservation() {
                document.getElementById('reservationLoading').style.display = 'flex';
                event.preventDefault();
     var formData = $('form#reservation').serialize();
 
     $.ajax({
         type: 'POST',
         url: "{{ route('saveReservation') }}",
         data: formData,
         success: function(response) {
        if(response.status === 'success'){
            document.getElementById('reservationLoading').style.display = 'none';
        }
         
         },
         error: function (xhr) {
             console.log(xhr.responseText);
         }
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
            theme: "Orange Coral",
            sidebarDisplayDefault: false,
            eventListToggler:false,
            eventDisplayDefault:false,
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

        // Close event page when the calendar loads
        $(cal_name).on('initComplete', function() {
            $(cal_name).find('.calendarClose').click();
        });

        // Update date input fields when a date is selected
        $(cal_name).on('selectDate', function(event, newDate, oldDate) {
            var currentDate = new Date();
            var selectedDate = new Date(newDate);
            if (selectedDate <= currentDate) {
                document.getElementById('date').value = 'Not a valid date!';
                document.getElementById('dateHidden').value = 'Not a valid date!';
                document.getElementById('submitReservation').disabled = true;
                document.getElementById('submitReservation').textContent = 'Invalid Date! Choose Future dates';
            } else {
                document.getElementById('date').value = newDate;
                document.getElementById('dateHidden').value = newDate;
              
                CheckTimeRestrictions(newDate);
                if(document.getElementById('contact').value === '' || document.getElementById('contact').value.length < 11){
                    document.getElementById('submitReservation').disabled = true;
                    document.getElementById('submitReservation').textContent = 'Please Make Sure Contact Number is valid';
                }else{
                    document.getElementById('submitReservation').textContent = 'Submit Reservation';
                    document.getElementById('submitReservation').disabled = false;
                }
            }
        });
    });
});

function CheckTimeRestrictions(date){
    const url = "{{ route('getTimeDate') }}?date=" + date;
            axios.get(url)
               .then(function (response) {
                const btns = document.querySelectorAll('.t-btn');
                btns.forEach(function(button) {
                           button.disabled = false;
                 });
              if(response.data.status === "exist"){
                  let Time = []; 
                  
                  for(let i = 0; i < response.data.time.length; i++){
                    Time.push(FilterTime(response.data.time[i]));
                  }
                  const btns = document.querySelectorAll('.t-btn');

                btns.forEach(function(button) {
                for(let t = 0; t<Time.length; t++){
                    if(button.textContent === Time[t]){
                        button.disabled = true;
                    }
                }
                });
              }else{
                const btns = document.querySelectorAll('.t-btn');
                btns.forEach(function(button) {
                           button.disabled = false;
                        });
              }

             })
           .catch(function (error) {
      
            console.error('Error:', error);
            })
          .then(function () {
         
          });
}

function FilterTime(time){
   const start = addSuffix(time.substring(0,2));
   const end = addSuffix(time.substring(3,5));

   return start + ' - ' + end;
}

function addSuffix(time){
    if(time[0]=== "0"){
        var initial = time[1];
    } else {
        var initial = time;
    }

    if(parseInt(initial) < 12 && initial != "0"){
        var format = initial + ":00AM";
    } else if(initial === "0"){
        var format = "12:00AM";
    } else if(parseInt(initial) < 12){
        var format = initial + ":00AM"; 
    } else if(parseInt(initial) === 12){
        var format = "12:00PM";
    } else {
        const adjust = parseInt(initial) - 12;
        var format = adjust + ":00PM";
    }

    return format;
}


        </script>
</body>

</html>