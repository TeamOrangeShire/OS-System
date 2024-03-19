@if (session()->has('Admin_id'))
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Admin Dashboard</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
	<link rel="icon" href="{{asset('assets/images/os_logo.png')}}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    

</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	@include('admin.nav')
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
  @include('admin.header')
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->
      
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pending Reservations </h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Room No.</th>
                                    <th colspan="2"> Action Buttons</th>



                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Reservation = App\Models\Reservation::all();
                            @endphp
                            @foreach ($Reservation as $res)
                                
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>mark@gmail.com</td>
                                <td>02/04/2024</td>
                                <td>3PM TO 6PM</td>
                                <td>1</td>
                                <td> 
                                    {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmmodal"  onclick="updatemodal(`{{$info->promo_id}}`"><i class="feather icon-check-circle"></i></button>   --}}
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declinemodal"><i class="feather icon-x-circle"></i></button>   </td>
                              </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- [ Main Content ] end -->
    </div>
</div>

{{-- confirm modal start --}}
<div id="confirmmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Reservation?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <p>Name: <span id="subscriptionName"></span></p>
                    <p>Email: <span id="subscriptionPlan"></span></p>
                    <p>Date: <span id="customerFullName"></span></p>
                    <p>Time: <span id="customerFullName"></span></p>
                    <p>Room: <span id="customerFullName"></span></p>

                    <div style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="confirmDisable()">Yes</button>
                        <button type="button" class="btn btn-secondary" onclick="cancel()">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- confirm modal end --}}

{{-- modal start decline --}}

<div id="declinemodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Decline Reservation?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
          
                <div class="col-md-12">
                   
                    <div class="form-group" style="text-align: center;">   
                        <label style="font-size: 17px; font-weight: bold;" for="reason_promo">Reason</label>
                        <select class="form-control" id="reasonlist" name="reasonlist">
                            <option value="Unpaid">Unpaid</option>
                            <option value="Customer Didn't Show">Customer Didn't Show Up</option>
                            <option value="Customer Cancelled">Customer Cancelled</option>
                        </select>                        
                    </div>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="confirmDisable()">Yes</button>
                    <button type="button" class="btn btn-secondary" onclick="cancel()">No</button>
                </div>
                
            </div>
           </div>
          
        </div>
    </div>
</div>
{{-- modal end --}}

<!-- [ Main Content ] end -->
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('assets/js/pages/dashboard-main.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>

</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif