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
      <div class="row">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h5>Rooms</h5>

                    {{-- modal start --}}
                    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Room</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                              
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Room Number</label>
                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Room Number">
                                                               
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Room Capacity</label>
                                                                <input type="Number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Room Capacity">
                                                               
                                                            </div>
                                                           
                            
                                                           
                                                            <button type="submit" class="btn  btn-primary">Add Room</button>
                                                        </form>
                                                   
                                        </div>
                                    </div>
                               </div>
                              
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#exampleModalCenter">Add Room</button>
                {{-- modal end --}}

                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Number</th>
                                    <th>Room Name</th>
                                    <th>Room Capacity</th>      
                                    <th colspan="2">Action</th>

                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12324</td>
                                    <td>Room 1</td>
                                    <td>Meeting Room 1</td>
                                    <td>8 to 10 pax</td>
                                    <td></td>
                                    <td>                     {{-- modal start --}}
                                        <div id="exampleModalCenter2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Room Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                  
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Room Number</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Room Number">
                                                                                   
                                                                                </div>
                                                                                
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Room Capacity</label>
                                                                                    <input type="Number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Room Capacity">
                                                                                   
                                                                                </div>
                                                                               
                                                
                                                                               
                                                                                <button type="submit" class="btn  btn-primary">Add Room</button>
                                                                            </form>
                                                                       
                                                            </div>
                                                        </div>
                                                   </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="button" class="btn  btn-icon btn-success" data-toggle="modal" data-target="#exampleModalCenter2"><i class="feather icon-edit"></i></button>
                                    {{-- modal end --}}

                                        <button class="btn  btn-icon btn-danger" role="button"><i class="feather mr-2 icon-slash"></i></button> </td>
                                </tr>
                                <tr>
                                    <td>546546</td>
                                    <td>Room 2</td>
                                    <td>Meeting Room 2</td>
                                    <td>4 to 6 pax</td>
                                    <td></td>
                                    <td> <button class="btn  btn-icon btn-success" role="button"><i class="feather icon-edit"></i></button>  
                                        <button class="btn  btn-icon btn-danger" role="button"><i class="feather mr-2 icon-slash"></i></button> </td>
                                </tr>
                                <tr>
                                    <td>124564324</td>
                                    <td>Room 3</td>
                                    <td>Meeting Room 3</td>
                                    <td>4 to 6 pax</td>
                                    <td></td>
                                    <td> <button class="btn  btn-icon btn-success" role="button"><i class="feather icon-edit"></i></button>  
                                        <button class="btn  btn-icon btn-danger" role="button"><i class="feather mr-2 icon-slash"></i></button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>



    <div class="row">
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h5>Rooms Rate</h5>

                    {{-- modal start --}}
                    <div id="exampleModalCenter1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalCenterTitle1">Room Rate</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                              
                                    <div class="col-md-12">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Room Number</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Hourly</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">4 hours</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Full Day</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Weekly</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Monthly</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                               
                                            </div>
                                           
            
                                           
                                            <button type="submit" class="btn  btn-primary">Update Rates</button>
                                        </form>
                                    </div>
                                              
                               </div>
                              
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#exampleModalCenter1">Add Room Pricing</button>
                {{-- modal end --}}


                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Number</th>
                                    <th>Hourly</th>
                                    <th>4 Hours</th>
                                    <th>Full Day</th>      
                                    <th>Weekly</th>      
                                    <th>Monthly</th>      
                                    <th colspan="2">Action</th>

                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12324</td>
                                    <td>Room 1</td>
                                    <td>500</td>
                                    <td>1500</td>
                                    <td>2500</td>
                                    <td>n/a</td>
                                    <td>n/a</td>
                                    <td> {{-- modal start --}}
                                        <div id="exampleModalCenter4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Room Rates</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                  
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Room Number</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                                                                                   
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Hourly</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                                                                                   
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">4 hours</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                                                                   
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Full Day</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                                                                   
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Weekly</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                                                                   
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Monthly</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                                                                   
                                                                                </div>
                                                                               
                                                
                                                                               
                                                                                <button type="submit" class="btn  btn-primary">Update Rates</button>
                                                                            </form>
                                                                       
                                                            </div>
                                                        </div>
                                                   </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn  btn-icon btn-success" data-toggle="modal" data-target="#exampleModalCenter4"><i class="feather icon-edit"></i></button>
                                    {{-- modal end --}} 
                                        <button class="btn  btn-icon btn-danger" role="button"><i class="feather mr-2 icon-slash"></i></button> </td>
                                </tr>
                                <tr>
                                    <td>12324</td>
                                    <td>Room 1</td>
                                    <td>500</td>
                                    <td>1500</td>
                                    <td>2500</td>
                                    <td>n/a</td>
                                    <td>n/a</td>
                                    <td> <button class="btn  btn-icon btn-success" role="button"><i class="feather icon-edit"></i></button>  
                                        <button class="btn  btn-icon btn-danger" role="button"><i class="feather mr-2 icon-slash"></i></button> </td>
                                </tr>
                                <tr>
                                    <td>12324</td>
                                    <td>Room 1</td>
                                    <td>500</td>
                                    <td>1500</td>
                                    <td>2500</td>
                                    <td>n/a</td>
                                    <td>n/a</td>
                                    <td> <button class="btn  btn-icon btn-success" role="button"><i class="feather icon-edit"></i></button>  
                                        <button class="btn  btn-icon btn-danger" role="button"><i class="feather mr-2 icon-slash"></i></button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
       
        <!-- [ Main Content ] end -->
    </div>
</div>
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
