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
                    <h5>Promos</h5>
                    <h5>Add New Promo</h5>
                    {{-- modal start --}}
                    <div id="exampleModalCenter2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalCenterTitle1">Add New Promo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{route('AddPromo')}}" method="POST">@csrf
                                                <div class="form-group">
                                                    <label for="promos_name">Promo Name</label>
                                                    <input type="text" class="form-control" id="promos_name" name="promo_name" placeholder="Promo Name">
                                                   
                                                </div>
                                                <div class="form-group">
                                                    <label for="percent_age">Percentage</label>
                                                    <input type="number" class="form-control" id="percent_age" name="promo_percentage" placeholder="Promo Percentage">
                                                </div>
                
                                               
                                                <button type="submit" class="btn  btn-primary">Add Promo</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#exampleModalCenter2">Add New Promo</button>
                {{-- modal end --}}

                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Promo Name</th>
                                    <th>Percentage</th>      
                                    <th>Edit</th>        
  
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $promo = App\Models\Promos::all();
                            @endphp
                             @foreach ($promo as $info)
                                <tr>
                                    <td>{{$info->promo_id}}</td>
                                    <td>{{$info->promo_name}}</td>
                                    <td>{{$info->promo_percentage}}</td>
                                    <td><button type="button" class="btn  btn-icon btn-success" data-toggle="modal" data-target="#exampleModalCenter" onclick="updatemodal(`{{$info->promo_id}}`,`{{$info->promo_name}}`,`{{$info->promo_percentage}}`)"><i class="feather icon-edit"></i></button>

                                        <button type="button" class="btn  btn-icon btn-danger"><i class="feather icon-trash"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- modal --}}
                <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Promo Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                          
                                <div class="col-md-12">
                                    <form action="{{route('EditPromo')}}" method="POST">@csrf
                                        <div class="form-group">
                                            <input type="hidden" name="promo_id" id="promo_id" >
                                            <label for="plan_name">Promo Name</label>
                                            <input type="text" class="form-control" id="promo_name" aria-describedby="emailHelp" name="promo_name" placeholder="Promo Name" >
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_hours">Percentage</label>
                                            <input type="number" class="form-control" id="promo_percentage" aria-describedby="emailHelp" name="promo_percentage" placeholder="Promo Percentage" >
                                           
                                        </div>

                                        <button type="submit" class="btn  btn-primary" >Add Plan</button>
                                    </form>
                                </div>
                           </div>
                          
                        </div>
                    </div>
                </div>
                {{-- modal end --}}
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
        function updatemodal(id,name,percentage){
            const promo_id =document.getElementById('promo_id');
            const promo_name =document.getElementById('promo_name');
            const promo_percentage =document.getElementById('promo_percentage');

            promo_id.value=id;
            promo_name.value=name;
            promo_percentage.value=percentage;

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
