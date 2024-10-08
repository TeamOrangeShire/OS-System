@if (session()->has('Admin_id'))
<!DOCTYPE html>
<html lang="en">

<head>

   <link href="{{ asset('calendar/css/evo-calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('calendar/css/evo-calendar.orange-coral.min.css') }}" rel="stylesheet">
    @include('admin.assets.header',['title' => 'Reservation'])
    <style>
        .tag-input {
    padding: 0.25rem;
    border-radius: 0.25rem;
}

.tag {
    background-color: #e9ecef;
    color: #495057;
    border-radius: 0.2rem;
    padding: 0.4rem 0.75rem;
    margin-right: 0.25rem;
    margin-bottom: 0.25rem;
    display: inline-flex;
    align-items: center;
}

.tag .remove-tag {
    margin-left: 0.5rem;
    cursor: pointer;
    font-weight: bold;
    color: #dc3545;
}
input[type="text"] {
    border: none;
    flex-grow: 1;
    padding: 5px;
    outline: none;
}

input[type="text"]::placeholder {
    color: #999;
}
.time-btn,.next-btn{
    transition: width 0.3s  ease-in-out;
}
.time-btn:hover{
    background-color:#fcfcfc;
    color:#495057;
    border-color: #999;
}
.time-btn{
    border-color: #999;
    background-color:#f53b23
}
/* Highlight the week row when hovering */
.ui-datepicker-calendar tr:hover {
    background-color: #e3f2fd; /* Light blue hover effect */
}

/* Custom style for the selected week (you can add a class on the selected week in JS) */
.selected-week {
    background-color: #ffeb3b !important; /* Yellow background for selected week */
}
.ui-datepicker .disabled a {
    background-color: #f4cccc !important; /* Light red for disabled dates */
    color: #888 !important; /* Gray out text */
    pointer-events: none; /* Disable clicking */
    opacity: 0.7;
}
.ui-datepicker .ui-state-active {
    background-color: #3bff3b !important; /* Yellow background for selected week */
}

    </style>
</head>
<body class="">
    <div class="lds-roller" id="roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	@include('admin.component.nav')
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
  @include('admin.component.header')
	<!-- [ Header ] end -->



<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->
      <div class="row">
                    <div class="col-12">

                        <div id="calendar"></div>

                    </div>
                </div>
                <br>


       <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                                <li class="nav-item" onclick="getPendingReservation()">
                                    <a class="nav-link active text-uppercase" id="profile-tab" data-toggle="tab"
                                        href="#pendingTable" role="tab" aria-controls="profile" aria-selected="false">Pending</a>
                                </li>
                                <li class="nav-item" onclick="getApprovedReservation()">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#approvedTable"
                                        role="tab" aria-controls="home" aria-selected="true">Approved</a>
                                </li>
                                <li class="nav-item" onclick="getActiveReservation()">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#activeTable"
                                        role="tab" aria-controls="home" aria-selected="true">Active</a>
                                </li>
                                <li class="nav-item" onclick="">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#completedTable"
                                        role="tab" aria-controls="home" aria-selected="true">Completed</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade  show active" id="pendingTable" role="tabpanel" aria-labelledby="home-tab">
                                    {{-- content --}}
                                    <!-- Table with stripped rows -->
                                    <table id="pendingDataTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Room</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>


                                    {{-- content end --}}
                                </div>
                                <div class="tab-pane fade" id="approvedTable" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <p class="mb-0">
                                    <section class="section">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- Table with stripped rows -->
                                                <table id="approvedDataTable" class="table table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Room</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="activeTable" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <p class="mb-0">
                                    <section class="section">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- Table with stripped rows -->
                                                <table id="activeDataTable" class="table table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Room</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                    </p>
                                </div>
                                <div class="tab-pane fade " id="completedTable" role="tabpanel" aria-labelledby="home-tab">

                                    {{-- content --}}



                                    <!-- Table with stripped rows -->
                                    <table id="completeDataTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Room</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    {{-- content end --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



        <!-- [ Main Content ] end -->
    </div>
</div>

{{-- modal start --}}
<div id="addEvent" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3 border-right">
                                    <h4>Reservation Details</h4>
                                    <span><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12l3 -2" /><path d="M12 7v5" /></svg>
                                    Time <span id="formTimeLabel"></span>
                                    </span><br>
                                    <span><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-due"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                    Date <span id="formDateLabel"></span></span>
                                </div>
                                <div class="col-9">
                                <form method="POST" id="addEventForm">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" class="form-control border" id="customer_name" name="customer_name" placeholder="Enter Customer Name">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="exampleInputnumber1">Contact No.</label>
                                             <input type="Number" class="form-control" id="exampleInputnumber1" name="customer_num" aria-describedby="emailHelp" placeholder="Enter Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"  name="customer_email" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Guest Email(optional)</label>
                                <div class="tag-input" id="mail">
                                    <input type="text" class="form-control border" id="emailInput" name="emailInput" placeholder="Enter email and press Enter">
                                    <input type="text" name="multipleEmail" id="multipleEmail" hidden>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="customer_request">Any customer request upon Reservation?</label>
                                    <textarea name="customer_request" id="customer_request" class="form-control" cols="30" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-4">
                                    <label for="">Rooms</label>
                                    <select class="form-control" id="roomList"  name="room_id">

                                    </select>
                                    </div>
                                    <div class="col-md-8" >
                                      <div class="row" id="reserveContainer">

                                      </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="form-group" hidden>
                                    <div class="row">
                                    <input type="text" name="preselect" id="preselect">
                                    <div class="col-md-6">
                                    <label for="datepicker">Start Date:</label>
                                    <input type="text" class="form-control border" id="dateSelected" placeholder="Select a date" name="dateSelected"> <!-- Use formattedDate -->
                                    <small id="dateError" class="form-text text-danger" style="display: none;"></small>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="datepicker">Start Time:</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Select a date">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                    <label for="">End Date</label>
                                    <input type="text" id="dateSelected2" name="dateSelected2" class="form-control" placeholder="Select End Date">
                                    </div>
                                <button type="button" class="btn btn-secondary col-12" id="addSched" onclick="dynamicFuction('addEventForm', `{{route('submitAdminReservation')}}`,'add')">Submit</button>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{-- modal end --}}
<div id="viewReservation" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Reservation Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="acceptReserveForm" method="POST">
                                @csrf
                                <input type="text" name="r_id" id="r_id" hidden>
                            <div class="row p-2" id="reserveCard">
                                <div class="col-12 text-center mb-4"><h1 id="cardTitle"></h1></div>
                                <div class="col-6">
                                     Customer Name: <h6 id="namelabel"></h6>
                                </div>
                                <div class="col-6">
                                     Customer Email: <h6 id="emaillabel"></h6>
                                </div>
                                  <div class="col-6">
                                    Phone Number: <h6 id="numberLabel"></h6>
                                </div>
                                <div class="col-6">
                                    Room Rate: <h6 id="roomrateLabel"></h6>
                                </div>
                                <div class="col-6">
                                     Start Date: <h6 id="startDatelabel"></h6>
                                </div>
                                <div class="col-6">
                                   End Date: <h6 id="endDatelabel"></h6>
                                </div>
                                <div class="col-6">
                                    Start Time: <h6 id="startTimelabel"></h6>
                                </div>
                                <div class="col-6">
                                    End Time: <h6 id="endTimelabel"></h6>
                                </div>
                                <br>
                                <br>
                                <div id="innerCard1" class="row" style="display: none">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-success" onclick="dynamicFuction('acceptReserveForm','{{route('submitAdminReservation')}}','accept')">Accept</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-danger" onclick="cancelReservation()">Cancel</button>
                                    </div>
                                </div>
                                <div id="innerCard2" class="row" style="display: none">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning" onclick="reschedReserve()">Reschedule</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-danger" onclick="cancelReservation()">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                         </div>
                    </div>
                </div>
</div>
{{-- end modal --}}
{{-- start modal --}}
<div id="viewCancelReservation" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Cancel Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="cancelationForm" method="POST">
                                @csrf
                            <input type="text" name="c_r_id" id="c_r_id" class="form-control" hidden>
                            <div class="row">
                                  <div class="col-12 text-center mb-4"><h1 id="cancel_cardTitle"></h1></div>
                                 <div class="col-6">
                                     Customer Name:
                                     <input type="text" class="form-control" id="cancel_namelabel" name="cancel_namelabel" readonly>
                                </div>
                                <div class="col-6">
                                     Customer Email:
                                     <input type="text" class="form-control" id="cancel_emaillabel" name="cancel_emaillabel" readonly>
                                </div>
                                <br>
                                <label for="" class="mt-2">Reason  for cancellation</label>
                                <textarea name="cancelReason" id="" cols="20" rows="10" class="form-control"></textarea>
                            </div>
                            </form>
                        </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="dynamicFuction('cancelationForm','{{route('submitAdminReservation')}}','cancel')">Submit</button>
                        </div>
                    </div>
                </div>
</div>
{{-- end modal --}}
{{-- start modal --}}
<div id="viewReschedReservation" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Reschedule Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                         <form action="" id="reschedForm" method="POST">
                                @csrf
                            <input type="text" name="re_r_id" id="re_r_id" class="form-control" hidden>
                            <div class="row">
                                  <div class="col-12 text-center mb-4"><h1 id="resched_cardTitle"></h1></div>
                                <div class="col-6 mb-1">
                                     Customer Name:
                                     <input type="text" class="form-control" id="resched_namelabel" name="resched_namelabel" readonly>
                                </div>
                                <div class="col-6 mb-1">
                                     Customer Email:
                                     <input type="text" class="form-control" id="resched_emaillabel" name="resched_emaillabel" readonly>
                                </div>
                                <div class="col-6 mb-1">
                                     Customer Number:
                                     <input type="text" class="form-control" id="resched_number" name="resched_number" readonly>
                                </div>
                                <div class="col-6 mb-1">
                                    Previous Selected Rate:
                                     <input type="text" class="form-control" id="resched_rate" name="resched_rate" readonly>
                                </div>
                                <div class="col-12 mb-1">
                                    Select Room:
                                    <select id="roomSelect" class="form-control" name="roomSelect">
                                    <option value="">Select Room</option> <!-- Default option -->
                                    </select>
                                </div>
                                <div class="col-12 mb-1">
                                    Select Rate:
                                    <select id="rateSelect" name="rateSelect" class="form-control" >
                                    <option value="">Select Rate</option> <!-- Default option -->
                                    </select>
                                </div>
                                <div id="reschedField"></div>
                                <div class="col-6 mb-1">
                                    Select Start Date:
                                     <input type="text" id="reschedDate" name="reschedDate" class="form-control" placeholder="Select Start Date">
                                </div>
                                <div class="col-6 mb-1">
                                    Select End Date:
                                     <input type="text" id="reschedDate2" name="reschedDate2" class="form-control" placeholder="Select End Date">
                                </div>
                                <br>
                                <label for="" class="mt-2">Reason  for rescheduling</label>
                                <textarea name="reschedReason" id="" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                            </form>
                        </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="reschedBtn" onclick="dynamicFuction('reschedForm','{{route('submitAdminReservation')}}','resched')">Submit</button>
                        </div>
                    </div>
                </div>
</div>


<div class="modal fade" id="cancelActiveReservation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Cancel Reservation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-mute">This reservation is currently active are you sure do you want to cancel it?</p>

          <div class="form-group">
            <label for="cancelReasonSelect">Select Prebuilt Reasons</label>
            <select name="" class="form-select" id="selectActiveCancellationReason">

            </select>
          </div>
          <form id="confirmCancellationActive">
            @csrf
            <input type="hidden" id="reservationIdActiveCancellation" name="id">
          <div class="form-group">
            <label for="cancellationReasonActive">Cancellation Reason</label>
            <textarea class="form-control" id="cancellationReasonActive" name="reason" required rows="3"></textarea>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="submitReservationActiveCancellation" class="btn btn-danger">Submit</button>
        </div>
      </div>
    </div>
  </div>


<!-- [ Main Content ] end -->

@include('admin.assets.adminscript')
<script src="{{ asset('calendar/js/evo-calendar.min.js') }}"></script>
<script src="{{ asset('admins/adminreservation.js') }}"></script>
<script src="/admins/reservation.js"></script>


</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif
