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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pending Reservations </h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable"  style="text-align: center">
                            <thead>
                                <tr>
                               
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Room No.</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th colspan="2"> Action</th>

                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                        </table>
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
                                    <div class="col-md-6">
                                    <label for="datepicker">Start Date:</label>
                                    <input type="date" class="form-control" id="datepicker" placeholder="Select a date" name="start_date" data-date-val="${formattedDate}"> <!-- Use formattedDate -->
                                    <small id="dateError" class="form-text text-danger" style="display: none;"></small>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="datepicker">Start Time:</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Select a date">
                                    </div>
                                    </div>
                                    </div>
                                <button type="button" class="btn btn-secondary col-12" onclick="dynamicFuction('addEventForm', `{{route('submitAdminReservation')}}`,'add')">Submit</button>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{-- modal end --}}

<!-- [ Main Content ] end -->

@include('admin.assets.adminscript')
<script src="{{ asset('calendar/js/evo-calendar.min.js') }}"></script>
<script src="{{ asset('admins/adminreservation.js') }}"></script>



</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif