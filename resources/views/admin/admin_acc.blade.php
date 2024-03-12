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
                <div class="card-header">
                    <h5>Admin Account</h5>
                     {{-- modal start --}}
                     <div id="exampleModalCenter1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalCenterTitle1">Add New Admin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                                <div class="row">
                                                    
                                                    <div class="col-md-12">
                                                        <form method="POST" action="{{route('CreateAdmin')}}">@csrf
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleInputEmail1">First Name</label>
                                                                    <input type="text" class="form-control" id="exampleInputEmail1" name="FirstName" aria-describedby="emailHelp" placeholder="First Name">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleInputEmail1">Middle Name</label>
                                                                    <input type="text" class="form-control" id="exampleInputEmail1" name="MiddleName" aria-describedby="emailHelp" placeholder="Middle Name">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="exampleInputEmail1">Last Name</label>
                                                                    <input type="text" class="form-control" id="exampleInputEmail1" name="LastName" aria-describedby="emailHelp" placeholder="Last Name">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="exampleInputEmail1">Ext.</label>
                                                                    <select class="form-control" id="exampleFormControlSelect1" name="Ext">
                                                                        <option value="Jr.">Jr.</option>
                                                                        <option value="Sr.">Sr.</option>
                                                                        <option value="II">II</option>
                                                                        <option value="III">III</option>
                                                                        <option value="IV">IV</option>
                                                                        <option value="V">V</option>
                                                                        <option value="Jra.">Jra.</option>
                                                                        <option value="Esq.">Esq.</option>
                                                                    </select>                                                                 </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Username</label>
                                                                <input type="text" class="form-control" id="exampleInputEmail1" name="AdminName" aria-describedby="emailHelp" placeholder="Username">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Password</label>
                                                                <input type="password" class="form-control" id="confirm_password1" name="AdminPass" placeholder="Password" required oninput="confirm_password()">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Repeat Password</label>
                                                                <input type="password" class="form-control" id="confirm_password2" name="AdminPass2" placeholder="Repeat Password" required oninput="confirm_password()">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary" id="submit_pass">Create</button>
                                                        </form>
                                                    </div>
                                                    
                                                </div>

                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#exampleModalCenter1">Add New Admin</button>
                {{-- modal end --}}

                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Ext.</th>
                                    <th>Username</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $admin_info = App\Models\AdminAcc::all();
                            @endphp
                             @foreach ($admin_info as $info)
                             <tr>
                                <td>{{$info->admin_id}}</td>
                                <td>{{$info->admin_firstname}}</td>
                                <td>{{$info->admin_middlename}}</td>
                                <td>{{$info->admin_lastname}}</td>
                                <td>{{$info->admin_ext}}</td>
                                <td>{{$info->admin_username}}</td>
                            </tr>
                             @endforeach
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
    <script>
        function confirm_password(){
            const password1 = document.getElementById('confirm_password1');
            const password2 = document.getElementById('confirm_password2');
            const submit = document.getElementById('submit_pass');

            if(password1.value === password2.value){
                submit.disabled= false;
                password1.style.border='2px solid #66CDAA';
                password2.style.border='2px solid #66CDAA';
                // console.log('match');
            }else{
                submit.disabled= true;
                password1.style.border='2px solid #ff0000';
                password2.style.border='2px solid #ff0000';
                // console.log('not match');
            }
        }

    </script>
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('assets/js/pages/dashboard-main.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>

</body>

</html>
