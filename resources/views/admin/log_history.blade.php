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
    
     {{-- new add --}}
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
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->

<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Basic Tabs</h5>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              
                <li class="nav-item">
                    <a class="nav-link active text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Log History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Customer Log</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li> --}}
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                   
                    {{-- content --}}
                    
                        <section class="section">
                            <div class="row">
                              <div class="col-lg-12">
                      
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                      <thead>
                                        <tr>
                                       
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th style="display: none;"></th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                        $Customer = App\Models\CustomerAcc::all();
                                        
                                        
                                       @endphp
                                          @foreach ($Customer as $cus)
                                          @php
                                           $cus_fullname = $cus->customer_firstname .' '.$cus->customer_middlename.' '.$cus->customer_lastname;
                                              
                                          @endphp
                                        <tr>
                                            <td>{{$cus_fullname}}</td>
                                            <td>{{$cus->customer_email}}</td>
                                            <td>{{$cus->customer_phone_num }}</td>
                                            <td style="display: none;"></td>
                                            <td>
                                                <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="log('{{$cus->customer_id}}','{{$cus_fullname}}')"><i class="feather icon-info"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  
                              </div>
                            </div>
                          </section>
    
                        
                 
                    {{-- content end --}}

                </div>
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <p class="mb-0">

                        <section class="section">
                            <div class="row">
                              <div class="col-lg-12">
                      
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                      <thead>
                                        <tr>
                                       
                                            <th>Fullname</th>
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                        
                                        $Customer = App\Models\CustomerLogs::Where('log_date',Carbon\Carbon::now('Asia/Hong_Kong')->format('d/m/Y'))->orderBy('created_at','desc')->get();
                                        
                                        
                                       @endphp
                                          @foreach ($Customer as $cus)
                                          @php
                                          $cus_id = $cus->customer_id;
                                          $cus_info = App\Models\CustomerAcc::where('customer_id',$cus_id)->first();
                                           $cus_fullname = $cus_info->customer_firstname .' '.$cus_info->customer_middlename.' '.$cus_info->customer_lastname;
                                            $payment = $cus->log_transaction===null?['']:explode('-',$cus->log_transaction);
                                          @endphp
                                        <tr>
                                            <td>{{$cus_fullname}}</td>
                                            <td>{{$cus->log_date}}</td>
                                            <td>{{$cus->log_start_time}}</td>
                                            <td>{{$cus->log_end_time}}</td>
                                            <td>{{$payment[0]}}</td>
                                                @if ($cus->log_status === 1)
                                                <td>
                                                    Pending
                                                </td>
                                                <td>
                                                    <button type="button" class="btn  btn-icon btn-warning" onclick="accept_log('{{$cus->log_id}}')"><i class="feather icon-clock"></i></button>
                                                </td>
                                                @elseif ($cus->log_status === 2)
                                                <td>
                                                    Completed
                                                </td>
                                                <td>
                                                    <i class="feather icon-check btn btn-icon btn-success"></i>
                                                </td>
                                                @else
                                                <td>
                                                    Active
                                                </td>
                                                <td>
                                                    <i class="feather icon-zap btn btn-icon btn-primary"></i>
                                                </td>
                                                @endif
                                          
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  
                              </div>
                            </div>
                          </section>

                    </p>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    {{-- content --}}
                    {{-- end content --}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Log History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                        <div class="card-header col-md-6">
                            <h5>Log history</h5>
                           <input type="hidden" name="" id="cus_id">
                        </div>
                        <div class="card-header col-md-6">
                            <h5>Customer name:</h5><h5 id="cus_name"></h5>
                        </div>
                    </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <td>Status</td>
                                            <th id="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cust_log">
                                       
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
<!-- [ Main Content ] end -->
</div>
</div>

{{-- insert modal start --}}
<div id="insertmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header" >
        <h5 class="modal-title" id="exampleModalCenterTitle">Insert Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <form class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-6">
                    <label for="validationTooltip01">First name</label>
                    <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="validationTooltip02">Middle name</label>
                    <input type="text" class="form-control" id="validationTooltip02" placeholder="Middle name" value="" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="validationTooltip03">Last name</label>
                    <input type="text" class="form-control" id="validationTooltip03" placeholder="Last name" value="" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
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

<form action="" method="POST" id="acceplog"> 
@csrf
<input type="hidden" name="pending_log" id="pending_log">
</form>
<!-- [ Main Content ] end -->
    <script>
        function log(id,fullname){
            document.getElementById('cus_id').value=id;
            document.getElementById('cus_name').textContent=fullname;

            const url="{{route('getlog')}}?id="+id;
            const tablelog= document.getElementById('cust_log');
            tablelog.innerHTML='';
            let html='';
            axios.get(url)
        .then(function (response) {
         
            for(let i = 0;i<response.data.logs.length;i++){

                const fetchData = response.data.logs[i];
                if(fetchData.log_status === 1){
                    
                    html += `<tr>
                             <td>${fetchData.log_date}</td>
                             <td>${fetchData.log_start_time}</td>
                             <td>${fetchData.log_end_time}</td>
                             <td>Pending</td>
                             <td>
                                <button type="button" class="btn  btn-icon btn-warning" data-toggle="modal" data-target="" onclick="accept('${fetchData.log_id}','${fullname}')"><i class="feather icon-clock"></i></button>
                            </td>
                        </tr>`;
                }else if(fetchData.log_status === 2){
                    
                    html += `<tr>
                             <td>${fetchData.log_date}</td>
                             <td>${fetchData.log_start_time}</td>
                             <td>${fetchData.log_end_time}</td>
                            <td>Completed</td>
                            <td>
                            <i class="feather icon-check btn btn-icon btn-success"></i>
                            </td>
                        </tr>`;
                }else{
                   
                    html += `<tr>
                             <td>${fetchData.log_date}</td>
                             <td>${fetchData.log_start_time}</td>
                             <td>${fetchData.log_end_time}</td>
                            <td>Active</td>
                            <td>
                                <i class="feather icon-zap btn btn-icon btn-primary"></i>
                            </td>
                        </tr>`;
                }
                
               
            }
            tablelog.innerHTML=html;
        })
       .catch(function (error) {
        console.error(error);
        });
        }

        function accept(id){
document.getElementById('pending_log').value=id;
document.getElementById('roller').style.display='flex';
event.preventDefault();
 var formData = $('form#acceplog').serialize();

 $.ajax({
     type: 'POST',
     url: "{{route('acceptLog')}}",
     data: formData,
     success: function(response) {
       if(response.status === 'exist'){
        document.getElementById('roller').style.display='none';
      
       }else if(response.status === 'success'){
        location.reload();
       
       }
     }, 
     error: function (xhr) {

         console.log(xhr.responseText);
     }
 });
}
function accept_log(id){
    document.getElementById('pending_log').value=id;
document.getElementById('roller').style.display='flex';
event.preventDefault();
 var formData = $('form#acceplog').serialize();

 $.ajax({
     type: 'POST',
     url: "{{route('acceptLog')}}",
     data: formData,
     success: function(response) {
       if(response.status === 'exist'){
        document.getElementById('roller').style.display='none';
      
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