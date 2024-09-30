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
#calendar .evo-calendar-sidebar {
    display: none;
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
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="addEventForm">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1">Customer Name</label>
                                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Cutomer Name">
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
                                <label for="exampleInputEmail1">Guest Email(optional):</label>
                                <div class="tag-input" id="mail">
                                    <input type="text" class="form-control" id="emailInput" name="emailInput" placeholder="Enter email and press Enter">
                                    <input type="text" name="multipleEmail" id="multipleEmail" hidden>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6">
                                    <label for="datepicker">Start Date:</label>
                                    <input type="date" class="form-control" id="datepicker" placeholder="Select a date" name="start_date" data-date-val="${formattedDate}"> <!-- Use formattedDate -->
                                    <small id="dateError" class="form-text text-danger" style="display: none;"></small>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="datepicker">Start Time:</label>
                                    <input type="time" class="form-control" id="" name="start_time" placeholder="Select a date">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6">
                                    <label for="datepicker">End Date:</label>
                                    <input type="date" class="form-control" id="datepicker2" name="end_date" placeholder="Select a date"> <!-- Use formattedDate -->
                                    <small id="dateError2" class="form-text text-danger" style="display: none;"></small>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="datepicker">End Time:</label>
                                    <input type="time" class="form-control" id="" name="end_time">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Rooms</label>
                                    <select class="form-control" id="roomList"  name="room_id">
                                    
                                    </select>
                                    </div>
                                <button type="button" class="btn btn-secondary col-12" onclick="dynamicFuction('addEventForm', `{{route('reservationData')}}`,'add')">Submit</button>
                            </form>
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