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
    @include('admin.assets.admintable')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/admin_css.css')}}">
    
    

</head>
<body class="">
    <div class="lds-roller" id="roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

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
                                        <form action="" id="planexistform" method="POST" >@csrf
                                            <div class="alert alert-danger" role="alert" id="planexist" style="display:none;">
                                                Plan Already Exits!
                                             </div>
                                            <div class="form-group">
                                                <label for="plan_name">Plan Name</label>
                                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Plan Name" name="service_name" required>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_hours">Hours</label>
                                                <input type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Plan Hours" name="service_hours" required>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_price">Price</label>
                                                <input type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Plan Price" name="service_price" required>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_promo">Promo</label>
                                                <select class="form-control"  name="service_id" required>
                                                    
                                                    @php
                                                    $promo = App\Models\Promos::where('promos_disable','!=',1)->get();
                                                @endphp
                                                @foreach ($promo as $info)
                                                    <option value="{{$info->promo_id}}">{{$info->promo_name}} {{$info->promo_percentage}}%</option>
                                                    @endforeach
                                                </select>                        
                                            </div>
            
                                           
                                            <button type="submit" onclick="planexist()" class="btn  btn-primary">Add Plan</button>
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
                        <table class="table datatable" >
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
                                        <button type="button" class="btn btn-icon btn-success"  data-toggle="modal" data-target="#exampleModalCenter5"  onclick="updatemodal(`{{$view->service_id}}`,`{{$view->service_name}}`,`{{$view->service_hours}}`,`{{$view->service_price}}`,`{{$view->promo_id}}`)"><i class="feather icon-edit"></i></button>  
                                        <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#disableplan" onclick="updatemodal2(`{{$view->service_id}}`)"><i class="feather icon-slash"></i></button> 
                                        @else
                                        <button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#exampleModalCenter5"  onclick="updatemodal(`{{$view->service_id}}`,`{{$view->service_name}}`,`{{$view->service_hours}}`,`{{$view->service_price}}`,`{{$view->promo_id}}`)"><i class="feather icon-edit"></i></button>  
                                        <button type="button" class="btn btn-icon btn-info" data-toggle="modal" data-target="#disableplan2" onclick="updatemodal2(`{{$view->service_id}}`)"><i class="feather icon-check-circle"></i></button> 
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
                    <form method="POST" id="editplanexistform" action="">@csrf
                        <div class="alert alert-danger" role="alert" id="editplanexist" style="display:none;">
                            Plan Already Exits!
                         </div>
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

                       
                        <button type="submit" onclick="editplanexist()" class="btn  btn-primary">Add Plan</button>
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
<div class="trans">
    <div class="wrapper" id="ex">
      <div class="popup-content1">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
          <circle class="checkmark_circle" cx="26" cy="26" r="25" fill="none"/>
          <path class="checkmark_check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8"/>
        </svg>
        <h3 class="h3">Disabled</h3>
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

        function planexist(){

            document.getElementById('roller').style.display='flex';
            event.preventDefault();
            var formData = $('form#planexistform').serialize();

            $.ajax({
                type: 'POST',
                url: "{{route('AddPlan')}}",
                data: formData,
                success: function(response) {
                if(response.status === 'exist'){
                    document.getElementById('roller').style.display='none';
                document.getElementById('planexist').style.display='';
                }else if(response.status === 'success'){
                    location.reload();
                
                }
                }, 
                error: function (xhr) {

                    console.log(xhr.responseText);
                }
            });
            }

        function editplanexist(){

            document.getElementById('roller').style.display='flex';
            event.preventDefault();
            var formData = $('form#editplanexistform').serialize();

            $.ajax({
                type: 'POST',
                url: "{{route('EditPlan')}}",
                data: formData,
                success: function(response) {
                if(response.status === 'exist'){
                    document.getElementById('roller').style.display='none';
                document.getElementById('editplanexist').style.display='';
                }else if(response.status === 'success'){
                    location.reload();
                
                }
                }, 
                error: function (xhr) {

                    console.log(xhr.responseText);
                }
            });
            }
     
    </script>
     @include('admin.assets.adminscript')

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