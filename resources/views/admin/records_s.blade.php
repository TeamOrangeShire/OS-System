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

        <div class="col-sm-12">
            <h5 class="mb-3">Subscription Records</h5>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Records</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Completed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Canceled</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                           
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-header"  style="position: relative;">
                                        <h5>Subscription Records</h5>
                                        <button type="submit" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;">Print Records</button>
                                        <div class="input-group m-t-15">
                                            <input type="text" name="task-insert" class="form-control" id="Project" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">
                                                    <i class="feather icon-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Subscription ID</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Hours left</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @php
                                        
                                        $CancelledSubs = App\Models\Subscriptions::where('sub_status', '!=', 1)->where('sub_status', '!=', 0)->get();
                                                    
                                                @endphp
                                                @foreach ($CancelledSubs as $cancelled)
                    
                                                    <tr>
                                                        <td> {{$cancelled->sub_id}} </td>
                                                        <td> {{$cancelled->sub_start}} </td>
                                                        <td> {{$cancelled->sub_end}}   </td>
                                                        <td> {{$cancelled->sub_time}}  </td>

                                                    </tr>
                                                    @endforeach
                                                    </tr>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-header"  style="position: relative;">
                                        <h5>Completed Subscription</h5>
                                        <button type="submit" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;">Print Records</button>
                                        <div class="input-group m-t-15">
                                            <input type="text" name="task-insert" class="form-control" id="Project" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">
                                                    <i class="feather icon-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Subscription ID</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Hours left</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @php
                                        
                                        $CancelledSubs = App\Models\Subscriptions::where('sub_status', 2)->get();
                                                    
                                                @endphp
                                                @foreach ($CancelledSubs as $cancelled)
                    
                                                    <tr>
                                                        <td> {{$cancelled->sub_id}} </td>
                                                        <td> {{$cancelled->sub_start}} </td>
                                                        <td> {{$cancelled->sub_end}}   </td>
                                                        <td> {{$cancelled->sub_time}}  </td>
                                        
                    
                    
                                                    </tr>
                                                    @endforeach
                                                    </tr>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-header"  style="position: relative;">
                                        <h5>Cancelled Subscription</h5>
                                        <button type="submit" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;">Print Records</button>
                                        <div class="input-group m-t-15">
                                            <input type="text" name="task-insert" class="form-control" id="Project" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">
                                                    <i class="feather icon-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Subscription ID</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Hours left</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @php
                                        
                                        $CancelledSubs = App\Models\Subscriptions::where('sub_status', 3)->get();
                                                    
                                                @endphp
                                                @foreach ($CancelledSubs as $cancelled)
                    
                                                    <tr>
                                                        <td> {{$cancelled->sub_id}} </td>
                                                        <td> {{$cancelled->sub_start}} </td>
                                                        <td> {{$cancelled->sub_end}}   </td>
                                                        <td> {{$cancelled->sub_time}}  </td>
                                        
                    
                    
                                                    </tr>
                                                    @endforeach
                                                    </tr>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        
       
        <!-- [ Main Content ] end -->
    </div>
</div>
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