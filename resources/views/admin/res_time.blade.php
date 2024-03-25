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
    {{-- new add --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/admin_css.css')}}">

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
                    <h5>Reservation Time </h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#addtime">Add Available Time</button>

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reservation Time</th>
                                    <th>Suffix</th>
                                   
                                    <th colspan="2"> Action Buttons</th>



                                </tr>
                            </thead>
                            <tbody>
                              
                                
                            <tr>
                                <td>1</td>
                                <td>9am</td>
                                <td>am</td>
                                <td> 
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editmodal"><i class="feather icon-edit"></i></button>  
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declinemodal"><i class="feather icon-slash"></i></button>   </td>
                              </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
      
          
       
        <!-- [ Main Content ] end -->
    </div>
</div>

                {{-- Edit Reservation Time modal --}}
                <div id="editmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Reservation Time</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                          
                                <div class="col-md-12">
                                    <form action="" id="editpromoexistform" method="POST">@csrf
                                        <div class="alert alert-danger" role="alert" id="editpromoexist" style="display:none;">
                                            Promo Already Exits!
                                         </div>
                                        <div class="form-group">
                                            <input type="hidden" name="promo_id" id="promo_id" >
                                            <label for="plan_name">Reservation Time</label>
                                            <select id="select_time" class="form-control">
                                                <option value="09:00">09:00</option>
                                                <option value="10:00">10:00</option>
                                                <option value="11:00">11:00</option>
                                                <option value="12:00">12:00</option>
                                                <option value="01:00">01:00</option>
                                                <option value="02:00">02:00</option>
                                                <option value="03:00">03:00</option>
                                                <option value="04:00">04:00</option>
                                            </select>
                                                                                       
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_hours">Suffix</label>
                                                <select name="Suffix" id="timesuffix" class="form-control">
                                                    
                                                    <option value="AM"> AM</option>
                                                    <option value="PM"> PM</option>

                                                </select>                                           
                                        </div>

                                        <button type="submit" onclick="editpromoexist()" class="btn  btn-primary" >Add Time</button>
                                    </form>
                                </div>
                           </div>
                          
                        </div>
                    </div>
                </div>
                {{-- Edit Reservation Time modal end --}}

                {{-- ADD Reservation Time modal --}}
                <div id="addtime" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add Reservation Time</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                          
                                <div class="col-md-12">
                                    <form action="" id="editpromoexistform" method="POST">@csrf
                                        <div class="alert alert-danger" role="alert" id="editpromoexist" style="display:none;">
                                            Promo Already Exits!
                                         </div>
                                        <div class="form-group">
                                            <input type="hidden" name="promo_id" id="promo_id" >
                                            <label for="plan_name">Reservation Time</label>
                                            <select class="form-control">
                                                <option value="09:00">09:00</option>
                                                <option value="10:00">10:00</option>
                                                <option value="11:00">11:00</option>
                                                <option value="12:00">12:00</option>
                                                <option value="01:00">01:00</option>
                                                <option value="02:00">02:00</option>
                                                <option value="03:00">03:00</option>
                                                <option value="04:00">04:00</option>
                                            </select>                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_hours">Suffix</label>
                                            <select name="Suffix" class="form-control">
                                                    
                                                <option value="AM"> AM</option>
                                                <option value="PM"> PM</option>

                                            </select>                                              
                                        </div>

                                        <button type="submit" onclick="editpromoexist()" class="btn  btn-primary" >Add Time</button>
                                    </form>
                                </div>
                           </div>
                          
                        </div>
                    </div>
                </div>
                {{-- modal end --}}


<!-- [ Main Content ] end -->
   
  

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