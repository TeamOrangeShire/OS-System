@if (session()->has('Admin_id'))

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.assets.header')
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
	@include('admin.component.nav')
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
  @include('admin.component.header')
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
                    {{-- <button class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#addcustomermodal" type="submit">Add New Customer</button> --}}
                    <br>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">

                    <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                 $Customer = App\Models\CustomerAcc::all();
                                 $num= 1;
                                 
                                @endphp
                                @foreach ($Customer as $cus)
                               @php
                                $cus_fullname = $cus->customer_firstname .' '.$cus->customer_middlename.' '.$cus->customer_lastname;
                                   
                               @endphp
                                <tr>
                                    <td>{{$num}}</td>
                                   <td>{{$cus_fullname}}</td>
                                    <td>{{$cus->customer_email}}</td>
                                    <td>{{$cus->customer_type}}</td>
                                    <td>
                                        <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#infomodal"  onclick="view('{{$cus->customer_id}}','{{$cus_fullname}}','{{$cus->customer_email}}','{{$cus->customer_phone_num}}','{{$cus->customer_type}}','{{$cus->account_credits}}')"> <i class="feather icon-info"> </i></button>
                                        {{-- <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#declinemodal" ><i class="feather icon-x-circle"></i></button>   </td> --}}
                                    </td>
                                </tr>
                                @php
                                    $num++
                                @endphp
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
                        <label for="phone"><strong>Phone Number:</strong></label> <br>
                        <p class="" name="cus_num" id="cus_num"></p> 
                       
                    </div>

                </div>

                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                       
                        <label for="email"><strong>User Type: </strong></label>
                        <p class="" name="user_type" id="user_type"></p> <span type="button" class="badge badge-primary" data-toggle="modal" data-target="#usertype" onclick="user_type()">Change Type</span>      
                        <br><br>
                        <label for="email"><strong>Credit Balance: </strong></label> 
                        <p class="" name="cus_credit" id="cus_credit"></p> <span type="button" class="badge badge-primary" data-toggle="modal" data-target="#credit" onclick="addCredit()">Update Credit</span>      
                    
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
                <button type="submit" class="btn btn-primary" name="operation" value="add">Add</button>
                <button type="submit" class="btn btn-primary" name="operation" value="minus">Deduct</button>
              
            </div>
             </form>
            </div>
            
        </div>
    </div>
</div>
{{-- modal end info--}} 
   
    {{-- modal start user type info --}}
    <div id="usertype" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Customer Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('changeType')}}" method="POST">
                        @csrf
                  <div class="container">
                    <div class="row" style="">
                        <div class="col-sm-12">
                        <br>
                        <input type="hidden" name="cus_id" id="cus_id2">
                        <label for="customer_name_type"> <strong>Customer Name: </strong> </label> <br>
                        <p class="" name="cname" id="customer_name_type">  </p> 
                    </div>
                    </div>
                <div class="row">
                    <div class="col-sm-12">
                      
                            <br>
                            <div class="form-group">
                                <label for="">User Type</label>
                                <select class="form-control" name="customer_type" id="customer_type">
                                    <option value="Student">Student</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Reviewer">Reviewer</option>
                                    <option value="Professional">Professional</option>
                                </select>
                            </div>  
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
                                <label for="">Username</label>
                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Username" required>
                               
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Email" required>
                               
                            </div>

                            <!-- Cleaned Mobile Number -->

                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="number" class="form-control" id="" aria-describedby="emailHelp" placeholder="Phone Number" required>
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" id="" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="">Repeat Password</label>
                                <input type="password" class="form-control" id="" placeholder="Repeat Password" required>
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
 function view(id,fullname,email,number,customer_type,credit){
            
            document.getElementById('cus_id').value=id;
            document.getElementById('cus_name').textContent=fullname;
            document.getElementById('cus_email').textContent=email;
            document.getElementById('cus_num').textContent=number;
            document.getElementById('user_type').textContent=customer_type;
            document.getElementById('cus_credit').textContent=credit;
           

    }
    function addCredit(){
        document.getElementById('cus_id1').value=document.getElementById('cus_id').value;
        document.getElementById('cus_name1').textContent=document.getElementById('cus_name').textContent;
        document.getElementById('cus_credit1').textContent=document.getElementById('cus_credit').textContent;
    }

    function user_type(){
        document.getElementById('cus_id2').value=document.getElementById('cus_id').value;
        document.getElementById('customer_name_type').textContent=document.getElementById('cus_name').textContent;
        document.getElementById('customer_type').value=document.getElementById('user_type').textContent;
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

@include('admin.assets.adminscript')

  
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