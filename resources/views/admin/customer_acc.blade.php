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
                <div class="card-header">
                    
                    <h5>Customer Account</h5> 
                    <button class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#addcustomermodal" type="submit">Add New Customer</button>
                    <br>
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
                                   
                                    <th>Username</th>
                                    <th>Email</th>
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
                                    <td>
                                        <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#infomodal"  onclick="view('{{$cus->customer_id}}','{{$cus_fullname}}','{{$cus->customer_email}}','{{$cus->customer_number}}','{{$cus->account_credits}}')"> <i class="feather icon-info"> </i></button>
                                        <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#declinemodal" ><i class="feather icon-x-circle"></i></button>   </td>
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
       
    {{-- modal start info --}}
<div id="infomodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Info</h5>
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div class="row">
            
                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                       <input type="hidden" id="cus_id">
                        <label for="customer_name"> <strong>Customer Name: </strong> </label> <br>
                        <p class="" name="cname" id="cus_name">  </p> 
                        <input type="hidden" name="" id="customer_id">
                        <label for="email"><strong>Email:</strong></label> <br>
                        <p class="" name="cemail" id="cus_email">  </p> 
                       
                    </div>

                </div>

                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                        <label for="phone"><strong>Phone Number:</strong></label> <br>
                        <p class="" name="cnum" id="cus_num">  </p> 
                        <label for="email"><strong>Credit Balance: </strong></label> <br>
                        <p class="" name="cus_credit" id="cus_credit"></p> <span type="button" class="badge badge-primary" data-toggle="modal" data-target="#credit" onclick="addCredit()">Add Credit</span>      
                    </div>
                </div>

            </div>
          

            </div>
       
        </div>
    </div>
</div>
{{-- modal end info--}}
   
    {{-- modal start info --}}
    <div id="credit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Customer Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('addCredit')}}" method="POST">
                        @csrf
                  
                    <div style="margin-left: 40px;">
                        <br>
                        <input type="hidden" name="cus_id" id="cus_id1">
                        <label for="customer_name1"> <strong>Customer Name: </strong> </label> <br>
                        <p class="" name="cname" id="cus_name1">  </p> 
                       
                    </div>
                <div class="row">
                
                    <div class="col-sm-6">
                        <div style="margin-left: 40px;">
                            <br>
                            <label for="email"><strong>Credit Balance: </strong></label> <br>
                            <p class=""  id="cus_credit1"></p> 
                        </div>
    
                    </div>
    
                    <div class="col-sm-6">
                        <div style="margin-left: 40px;">
                            <br>
                            <label for="email"><strong>Credit Balance: </strong></label> <br>
                            <input type="number" name="cus_credit" id="" class="form-control col-sm-8" style="font-size: 90%;">    
                        </div>
                    </div>
    
                </div>
                <br>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                 </form>
                </div>
                
            </div>
        </div>
    </div>
    {{-- modal end info--}}
        <!-- [ Main Content ] end -->
    </div>
</div>

{{-- add customer modal start --}}
<div id="addcustomermodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="modal-title" id="exampleModalCenterTitle">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required>
                               
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                               
                            </div>

                            <!-- Cleaned Mobile Number -->

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone Number" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Repeat Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Repeat Password" required>
                            </div>
                           
                            <button type="submit" class="btn  btn-primary">Create</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<script>
 function view(id,fullname,email,number,credit){
            
            document.getElementById('cus_id').value=id;
            document.getElementById('cus_name').textContent=fullname;
            document.getElementById('cus_email').textContent=email;
            document.getElementById('cus_num').textContent=number;
            document.getElementById('cus_credit').textContent=credit;

    }
    function addCredit(){
        document.getElementById('cus_id1').value=document.getElementById('cus_id').value;
        document.getElementById('cus_name1').textContent=document.getElementById('cus_name').textContent;
        document.getElementById('cus_credit1').textContent=document.getElementById('cus_credit').textContent;
    }




    function validatePhoneNumber(event) {
      const phoneNumberInput = event.target;
      let phoneNumber = phoneNumberInput.value;
  
      phoneNumber = phoneNumber.replace(/\D/g, '');
  
      if (phoneNumber.length > 10) {
        phoneNumber = phoneNumber.slice(0, 10);
      }
  
      if (phoneNumber.length > 0 && phoneNumber.charAt(0) !== '9') {
      phoneNumberInput.setCustomValidity("Please Enter Valid Phone Number.");
    } else if (phoneNumber.length !== 10) {
      phoneNumberInput.setCustomValidity("Phone number must be exactly 10 digits.");
    } else {
      phoneNumberInput.setCustomValidity("");
    }
  
      phoneNumberInput.value = phoneNumber;
    }
  
    document.addEventListener("DOMContentLoaded", function () {
       const phoneInputs = document.querySelectorAll('input[placeholder="Phone Number"]');
       if (phoneInputs.length > 0) {
          phoneInputs.forEach(function(phoneInput) {
            phoneInput.addEventListener('input', validatePhoneNumber);
            validatePhoneNumber({ target: phoneInput });
          });
       }
    });

  </script>
  
{{-- add customer modal end --}}
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