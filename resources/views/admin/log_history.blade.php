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
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                <div class="card-header">
                        <h5>Insert Log</h5>
                    </div>
                    <div class="card-body">
                <div class="card-body">
                    
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="validationTooltip01">First name</label>
                                <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationTooltip02">Middle name</label>
                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Middle name" value="" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationTooltip03">Last name</label>
                                <input type="text" class="form-control" id="validationTooltip03" placeholder="Last name" value="" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                 <label for="exampleFormControlSelect1">Ext.</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Sr.</option>
                                            <option>Jr.</option>
                                        </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationTooltip04">Email</label>
                                <input type="text" class="form-control" id="validationTooltip04" placeholder="Email" required>
                                <div class="invalid-tooltip">
                                    Please provide a valid city.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationTooltip05">Number</label>
                                <input type="Number" class="form-control" id="validationTooltip05" placeholder="Number" required>
                                <div class="invalid-tooltip">
                                    Please provide a valid state.
                                </div>
                            </div>
                        
                        </div>
                        <button class="btn  btn-primary" type="submit">Insert Log</button>
                    </form>
                </div>
            </div>
        </div>
       
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <h5>Log History</h5>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Albert</td>
                                    <td>@gmail.com</td>
                                    <td>09999999999</td>
                                    <td>
                                        <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="feather icon-info"></i></button>
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title h4" id="myLargeModalLabel">Large Modal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form class="form-inline">
                                                            <div class="form-group mx-sm-3 mb-2">
                                                                <label for="inputPassword2" class="sr-only">Time In</label>
                                                                <input type="time" class="form-control" id="" placeholder="Time In">
                                                            </div>
                                                            <button type="submit" class="btn  btn-icon btn-success"><i class="feather icon-check-circle"></i></button>
                                                        </form>
                                                        <br>
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Subscription Records</h5>
                                                                    
                                                                </div>
                                                                <div class="card-body table-border-style">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Date</th>
                                                                                    <th>Start</th>
                                                                                    <th>End</th>
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>2</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>3</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>4</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
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
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jiffy</td>
                                    <td>@gmail.com</td>
                                    <td>09999999999</td>
                                    <td>
                                        <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="feather icon-info"></i></button>
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title h4" id="myLargeModalLabel">Large Modal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form class="form-inline">
                                                            <div class="form-group mx-sm-3 mb-2">
                                                                <label for="inputPassword2" class="sr-only">Time In</label>
                                                                <input type="time" class="form-control" id="" placeholder="Time In">
                                                            </div>
                                                            <button type="submit" class="btn  btn-icon btn-success"><i class="feather icon-check-circle"></i></button>
                                                        </form>
                                                        <br>
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Subscription Records</h5>
                                                                    
                                                                </div>
                                                                <div class="card-body table-border-style">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Date</th>
                                                                                    <th>Start</th>
                                                                                    <th>End</th>
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>2</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>3</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>4</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
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
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Super mario</td>
                                    <td>@gmail.com</td>
                                    <td>09999999999</td>
                                    <td>
                                        <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="feather icon-info"></i></button>
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title h4" id="myLargeModalLabel">Large Modal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form class="form-inline">
                                                            <div class="form-group mx-sm-3 mb-2">
                                                                <label for="inputPassword2" class="sr-only">Time In</label>
                                                                <input type="time" class="form-control" id="" placeholder="Time In">
                                                            </div>
                                                            <button type="submit" class="btn  btn-icon btn-success"><i class="feather icon-check-circle"></i></button>
                                                        </form>
                                                        <br>
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Subscription Records</h5>
                                                                    
                                                                </div>
                                                                <div class="card-body table-border-style">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Date</th>
                                                                                    <th>Start</th>
                                                                                    <th>End</th>
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>2</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>3</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>4</td>
                                                                                    <td>2024/03/07</td>
                                                                                    <td>11:42 am</td>
                                                                                    <td>12:42 pm</td>
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
                                    </td>
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
