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
                               
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th>Room No.</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th colspan="2"> Action Buttons</th>



                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Reservation = App\Models\Reservations::where('res_status',0)->get();
                            @endphp
                            @foreach ($Reservation as $res)
                                
                            <tr>
                               
                                <td>@php
                                    $cus_id = $res->customer_id;
                                    
                                    $cus_info = App\Models\CustomerAcc::where('customer_id',$cus_id)->first();
                                    $full_name = $cus_info->customer_firstname.' '.$cus_info->customer_lastname;
                                    $time = $res->res_start.'-'.$res->res_end;
                                @endphp
                                {{$full_name}} </td>
                                <td>{{$cus_info->customer_email}}</td>
                                <td>{{$cus_info->customer_phone_num}}</td>
                                <td>@php
                                    $rprice_id = $res->rprice_id;
                                    $rprice_info = App\Models\RoomPricing::where('rprice_id',$rprice_id)->first();
                                    $room_id = $rprice_info->room_id;
                                    $room_info = App\Models\Rooms::where('room_id',$room_id)->first();
                                    $room_name = $room_info->room_number;
                                    $timeplace = FilterTime($time);
                                @endphp
                                {{$room_name}}
                                 </td>
                                <td>{{$res->res_date}}</td>
                                <td>{{$timeplace}}</td>
                               
                                <td> 
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmmodal"  onclick="confirmres(`{{$res->res_id}}`,'{{$full_name}}','{{$timeplace}}','{{$room_name}}','{{$res->res_date}}')"><i class="feather icon-check-circle"></i></button>  
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
            <form action="{{route('ConfirmReservation')}}" method="POST">
                @csrf
          
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Reservation?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <input type="hidden" name="r_id" id="r_id" style="border: none;">
                    <p>Name: <input type="text" name="CusName" id="CusName" style="border: none;"></p>
                    <p>Date: <input type="text" name="" id="Rdate" style="border: none;"></p>
                    <p>Time: <input type="text" name="" id="Rtime" style="border: none;"></p>
                    <p>Room: <input type="text" name="" id="Rroom" style="border: none;"></p>

                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary" >Yes</button>
                        <button type="button" class="btn btn-secondary">No</button>
                    </div>
                </div>
            </div>
        </form>
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
    <script>
           function confirmres(id,name,time,room,date){
            document.getElementById('r_id').value=id;
            document.getElementById('CusName').value=name;
            document.getElementById('Rtime').value=time;
            document.getElementById('Rroom').value=room;
            document.getElementById('Rdate').value=date;
          
        }
    </script>
    <!-- Required Js -->
    <script src="{{asset('js/main.js')}}"></script>

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