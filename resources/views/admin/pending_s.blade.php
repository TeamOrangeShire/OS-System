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
                    <h5>Pending Subscriptions</h5>
                    
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover"  style="text-align: center">
                            <thead>
                                <tr>
                                   
                                    <th>Subscription</th>
                                    <th>Name</th>
        
                                    <th colspan="2"> Confirm/Decline</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Subscriptions = App\Models\Subscriptions::where('sub_start',NULL )->where('sub_status',0 )->where('sub_cancel','!=',1 )->get();
                            @endphp
                            @foreach ($Subscriptions as $sub )
                            <tr>
                                <td>
                                    @php
                                        $service_id = $sub->service_id;
                                    $ServiceHP = App\Models\ServiceHP::where('service_id',$service_id)->first();
                                    @endphp
                                    {{$ServiceHP->service_name}} / {{$ServiceHP->service_hours}}hrs
                                </td>
                                <td>
                                @php
                                    $cus_id = $sub->customer_id;
                                    $Customer = App\Models\CustomerAcc::where('customer_id',$cus_id)->first();
                                    $cus_fullname = $Customer->customer_firstname .' '.$Customer->customer_middlename.' '.$Customer->customer_lastname;
                                    $cus_email = $Customer->customer_email;
                                    $cus_number = $Customer->customer_phone_num;
                               @endphp
                                    {{$cus_fullname}}
                                </td>
                               
                                
    
                                <td> <button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#confirmmodal"  onclick="confirmplan('{{$sub->sub_id}}','{{$ServiceHP->service_name}}','{{$ServiceHP->service_hours}}','{{$cus_fullname}}','{{$cus_email}}','{{$cus_number}}')"><i class="feather icon-check-circle"></i></button>  
                                    <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#declinemodal" onclick="declineplan('{{$sub->sub_id}}','{{$ServiceHP->service_name}}','{{$ServiceHP->service_hours}}','{{$cus_fullname}}','{{$cus_email}}','{{$cus_number}}')"><i class="feather icon-x-circle"></i></button>   </td>
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
            <form action="{{route('ConfirmSubscription')}}" method="POST">@csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Subscription?</h5>
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('ConfirmSubscription')}}" method="POST">
                    @csrf
            <div class="row">
            
                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                        <input type="hidden" name="sub_id" id="sub_id">
                        <label for="customer_name"> <strong>Customer Name: </strong> </label> <br>
                        <p class="" name="cname" id="cus_name">  </p> 
                        <label for="email"><strong>Email:</strong></label> <br>
                        <p class="" name="cemail" id="cus_email">  </p> 
                        <label for="phone"><strong>Phone Number:</strong></label> <br>
                        <p class="" name="cnum" id="cus_num">  </p> 
                    </div>

                </div>

                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                        <label for="customer_name"> <strong>Subcription: </strong> </label> <br>
                        <p class="" name="cname" id="servicename">  </p> 
                        <label for="email"><strong>Hours: </strong></label> <br>
                        <p class="" name="cemail" id="hours">  </p> 
                        
                    </div>
                </div>

            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </form>

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
            <form action="{{route('CancelPendingSubscription')}}" method="POST">@csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Decline this Subscription?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="sub_id" id="sub_id2">
                    <p>Subscription: <input type="text" id="subscriptionName2" style="border: none;"></p>
                    <p>Hours: <input type="text" id="subscriptionhours" style="border: none;"></p>
                 </div>
               
                <div class="col-md-6">
                    <p>Customer Name: <input type="text" id="customerFullName2" style="border: none;"></p>
                    <p>Email: <input type="text" id="customeremail" style="border: none;"></p>
                    <p>Number: <input type="text" id="customernumber" style="border: none;"></p>
                 </div>
                </div>
        <div class="form-group">   
            <label style="font-size: 17px; font-weight: bold;" for="reason_promo">Reason</label>
            <select class="form-control" id="reasonlist" name="reasonlist">
                <option value="Unpaid">Unpaid</option>
                <option value="Customer Didn't Show">Customer Didn't Show Up</option>
                <option value="Customer Cancelled">Customer Cancelled</option>
            </select>
            <br>   
            <div style="text-align: center;">
                <button type="submit" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>                     
        </div>
           </div>
        </form>
        </div>
    </div>
</div>
{{-- modal end --}}

    <script>
            function confirmplan(id,servicename,hours,fullname,email,number){
            
            document.getElementById('sub_id').value=id;
            document.getElementById('servicename').textContent=servicename;
            document.getElementById('hours').textContent=hours;
            document.getElementById('cus_name').textContent=fullname;
            document.getElementById('cus_email').textContent=email;
            document.getElementById('cus_num').textContent=number;
           
            
     

    }
    </script>
    <script>
        function declineplan(id,servicename,hours,fullname,email,number){
   
       document.getElementById('sub_id2').value=id;
       document.getElementById('subscriptionName2').value=servicename;
       document.getElementById('subscriptionhours').value=hours;
       document.getElementById('customerFullName2').value=fullname;
       document.getElementById('customeremail').value=email;
       document.getElementById('customernumber').value=number;

   }
   </script>
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