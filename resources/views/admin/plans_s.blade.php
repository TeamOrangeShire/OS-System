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
                    
                    <h5>Subscription Plans</h5>
                    {{-- modal start add plan--}}
                    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Plan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                              
                                    <div class="col-md-12">
                                        <form action="{{route('AddPlan')}}" method="POST" >@csrf
                                            <div class="form-group">
                                                <label for="plan_name">Plan Name</label>
                                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Plan Name" name="service_name">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_hours">Hours</label>
                                                <input type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Plan Hours" name="service_hours">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_price">Price</label>
                                                <input type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Plan Price" name="service_price">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_promo">Promo</label>
                                                <select class="form-control"  name="service_id">
                                                    
                                                    @php
                                                    $promo = App\Models\Promos::all();
                                                @endphp
                                                @foreach ($promo as $info)
                                                    <option value="{{$info->promo_id}}">{{$info->promo_name}} {{$info->promo_percentage}}%</option>
                                                    @endforeach
                                                </select>                        
                                            </div>
            
                                           
                                            <button type="submit" class="btn  btn-primary">Add Plan</button>
                                        </form>
                                    </div>
                               </div>
                              
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#exampleModalCenter">Add Plan</button>

                    {{-- modal end --}}
                 
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Plan Name</th>
                                    <th>Hours</th>
                                    <th>Price</th>
                                    <th>Promo</th>
                                    <th colspan="2">Action</th>

                            
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Service = App\Models\ServiceHP::all();
                                
                            @endphp
                            @foreach ($Service as $view)
                                <tr>
                                    <td>{{$view->service_id}}</td>
                                    <td>{{$view->service_name}}</td>
                                    <td>{{$view->service_hours}}</td>
                                    <td>{{$view->service_price}}</td>
                                    @php
                                        $promo_id =$view->promo_id;
                                        $selec_promo = App\Models\Promos::where('promo_id',$promo_id)->first();
                                      $promo_name = $selec_promo->promo_name;
                                    @endphp
                                    <td>{{$promo_name}}</td>
                                    <td> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter5" onclick="updatemodal(`{{$view->service_id}}`,`{{$view->service_name}}`,`{{$view->service_hours}}`,`{{$view->service_price}}`,`{{$view->promo_id}}`)"><i class="feather icon-edit"></i></button>  
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#disableplan"><i class="feather icon-slash"></i></button> </td>
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

{{-- modal start edit--}}
<div id="exampleModalCenter5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Plan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
          
                <div class="col-md-12">
                    <form method="POST" action="{{route('EditPlan')}}">@csrf
                        <div class="form-group">
                            <input type="hidden" name="plan_id" id="plan_id">
                            <label for="plan_name">Plan Name</label>
                            <input type="text" class="form-control" id="plan_name" name="plan_name" aria-describedby="emailHelp" placeholder="Plan Name">
                           
                        </div>
                        <div class="form-group">
                            <label for="plan_hours">Hours</label>
                            <input type="number" class="form-control" id="plan_hours" name="plan_hours" aria-describedby="emailHelp" placeholder="Plan Hours">
                           
                        </div>
                        <div class="form-group">
                            <label for="plan_price">Price</label>
                            <input type="number" class="form-control" id="plan_price" name="plan_price" aria-describedby="emailHelp" placeholder="Plan Price">
                           
                        </div>
                        <div class="form-group">
                            <label for="plan_promo">Promo</label>
                            <select class="form-control" id="promolist" name="promolist">
                                @php
                                $promos = App\Models\Promos::all();
                            @endphp
                             @foreach ($promos as $detail)
                                <option value="{{$detail->promo_id}}">{{$detail->promo_name}} {{$detail->promo_percentage}}%</option>
                                @endforeach
                            </select>                        
                        </div>

                       
                        <button type="submit" class="btn  btn-primary">Add Plan</button>
                    </form>
                </div>
           </div>
          
        </div>
    </div>
</div>
{{-- modal end --}}

{{-- modal start disable --}}

<div id="disableplan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Are you Sure you want to disable this plan?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
          
                <div class="col-md-12">
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
    <script>
        function updatemodal(id,name,hour,price,promo_id){
            const plan_id =document.getElementById('plan_id');
            const plan_name =document.getElementById('plan_name');
            const plan_hours =document.getElementById('plan_hours');
            const plan_price =document.getElementById('plan_price');
            const prom =document.getElementById('promolist');

            plan_id.value=id;
            plan_name.value=name;
            plan_hours.value=hour;
            plan_price.value=price;
            prom.value=promo_id;
          
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
