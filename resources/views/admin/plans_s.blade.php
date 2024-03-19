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
                                                    $promo = App\Models\Promos::where('promos_disable','!=',1)->get();
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
                                      $promo_name = $selec_promo->promo_name.' '.$selec_promo->promo_percentage;
                                      
                                    @endphp
                                    <td>{{$promo_name}}%</td>
                                    <td>
                                        @php
                                            $s_status = $view->service_disable;
                                        @endphp
                                        @if ($s_status == 0)
                                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#exampleModalCenter5"  onclick="updatemodal(`{{$view->service_id}}`,`{{$view->service_name}}`,`{{$view->service_hours}}`,`{{$view->service_price}}`,`{{$view->promo_id}}`)"><i class="feather icon-edit"></i></button>  
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#disableplan" onclick="updatemodal2(`{{$view->service_id}}`)"><i class="feather icon-slash"></i></button> 
                                        @else
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter5"  onclick="updatemodal(`{{$view->service_id}}`,`{{$view->service_name}}`,`{{$view->service_hours}}`,`{{$view->service_price}}`,`{{$view->promo_id}}`)"><i class="feather icon-edit"></i></button>  
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#disableplan2" onclick="updatemodal2(`{{$view->service_id}}`)"><i class="feather icon-check-circle"></i></button> 
                                        @endif
                                          
                                    
                                    
                                    </td>
                                </tr>
                               
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                $promos = App\Models\Promos::where('promos_disable','!=',1)->get();
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


      {{-- disable Modal start --}}
<div id="disableplan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('DisablePlan')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Disable This Plan?</h6>
                
                <input type="hidden" value="" name="planid" id="disable_service">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="disableplan2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('EnablePlan')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Enable This Plan?</h6>
                
                <input type="hidden" value="" id="enable_service" name="planid">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- disable modal end --}} 

{{-- Enable notif end --}}
@if (session('enabled'))
<style>
 .main-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust the last value (0.5) for the desired transparency */
    z-index: 999; /* Ensure it overlays other content */
}

.popup-content {
    display: flex;
    flex-flow: column;
    align-items: center;
}

h3,
.check-container {
    opacity: 0;
    animation: fadeIn 0.75s ease-out forwards;
}

h3 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 115%;
    display: flex;
    justify-content: center;
    align-items: center;
    transform: translate(-50%, -50%);
    z-index: 1000; /* Ensure it overlays the check container */
    color: white; /* Change text color as needed */
}

.check-container {
    width: 6.25rem;
    height: 7.5rem;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: space-between;
}
.check-container .check-background {
  width: 100%;
  height: calc(100% - 1.25rem);
  background: linear-gradient(to bottom right, #5de593, #41d67c);
  box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  transform: scale(0.84);
  border-radius: 50%;
  animation: animateContainer 0.75s ease-out forwards 0.75s;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
}
.check-container .check-background svg {
  width: 65%;
  transform: translateY(0.25rem);
  stroke-dasharray: 80;
  stroke-dashoffset: 80;
  animation: animateCheck 0.35s forwards 1.25s ease-out;
}
.check-container .check-shadow {
  bottom: calc(-15% - 5px);
  left: 0;
  border-radius: 50%;
  background: radial-gradient(closest-side, #49da83, transparent);
  animation: animateShadow 0.75s ease-out forwards 0.75s;
}

@keyframes animateContainer {
  0% {
    opacity: 0;
    transform: scale(0);
    box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  }
  25% {
    opacity: 1;
    transform: scale(0.9);
    box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  }
  43.75% {
    transform: scale(1.15);
    box-shadow: 0px 0px 0px 43.334px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  }
  62.5% {
    transform: scale(1);
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 21.667px rgba(255, 255, 255, 0.25) inset;
  }
  81.25% {
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
  }
  100% {
    opacity: 1;
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
  }
}
@keyframes animateCheck {
  from {
    stroke-dashoffset: 80;
  }
  to {
    stroke-dashoffset: 0;
  }
}
@keyframes animateShadow {
  0% {
    opacity: 0;
    width: 100%;
    height: 15%;
  }
  25% {
    opacity: 0.25;
  }
  43.75% {
    width: 40%;
    height: 7%;
    opacity: 0.35;
  }
  100% {
    width: 85%;
    height: 15%;
    opacity: 0.25;
  }
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.5);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>
<div class="main-container" id="check">
    <div class="popup-content">
        <h3>Enabled</h3>
        <div class="check-container">
            <div class="check-background">
                <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="check-shadow"></div>
        </div>
    </div>
</div>

<script>
    setTimeout(() =>  {
     document.getElementById('check').style.display='none';   
    }, 3000);
    document.getElementById('check').addEventListener('click',function(){
        document.getElementById('check').style.display='none';   
    });
</script>
@endif
{{-- end enable notif --}}


{{-- start disable notif --}}
@if (session('disabled'))
<style>
.wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.5); /* Adjust the last value (0.5) for the desired transparency */
  z-index: 999; /* Ensure it overlays other content */
  opacity: 0;
  animation: fadeIn 0.75s ease-out forwards; /* Added fadeIn animation */
}

.popup-content {
  display: flex;
  flex-flow: column;
  align-items: center;
}

h3 {
  opacity: 0;
  animation: fadeIn 0.75s ease-out forwards; /* Added fadeIn animation */
  color: white; /* Change text color as needed */
  margin-top: 20px; /* Adjust as needed */
}

.checkmark {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  box-shadow: inset 0px 0px 0px #7ac142;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both, fadeIn 0.75s ease-out forwards; /* Added fadeIn animation */
}

.checkmark_circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #ec1f1f;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark_check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}

@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 100px #ec1f1f;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

</style>
    
<div class="wrapper" id="ex">
    <div class="popup-content">
      <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
        <circle class="checkmark_circle" cx="26" cy="26" r="25" fill="none"/>
        <path class="checkmark_check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8"/>
      </svg>
      <h3>Disabled</h3>
    </div>
  </div>
  <script>
    setTimeout(() =>  {
     document.getElementById('ex').style.display='none';   
    }, 3000);
    document.getElementById('ex').addEventListener('click',function(){
        document.getElementById('ex').style.display='none';   
    });
</script>
      
    @endif
    {{-- end disable notif --}}

        <!-- [ Main Content ] end -->
    </div>
</div>

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
        function updatemodal2(id){
            document.getElementById('disable_service').value=id;
            document.getElementById('enable_service').value=id;
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
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif