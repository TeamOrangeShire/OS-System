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
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->

<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Log History</h5>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#insertmodal">Insert Log</button>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              
                <li class="nav-item">
                    <a class="nav-link active text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Log History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Customer Log</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Guest Log</a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#unregister" role="tab" aria-controls="contact" aria-selected="false">Guest List</a>
                </li>
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
                                            <td style="display:grid; place-items:center;">
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
                                                <td style="display:grid; place-items:center;">
                                                    <button type="button" class="btn btn-warning" onclick="accept_log('{{$cus->log_id}}')">Confirm</button>
                                                </td>
                                                @elseif ($cus->log_status === 2)
                                                <td>
                                                    Completed
                                                </td>
                                                <td style="display:grid; place-items:center;">
                                                    <i class="feather icon-check btn btn-icon btn-success"></i>
                                                </td>
                                                @else
                                                <td>
                                                    Active
                                                </td>
                                                <td style="display:grid; place-items:center;">
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
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Log Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                        
                                        $UnregisteredCustomer = App\Models\CustomerLogUnregister::orderBy('created_at','desc')->get();
                                       @endphp
                                          @foreach ($UnregisteredCustomer as $uncus)
                                          @php
                                          $uncus_status = $uncus->un_log_transaction===null?['']:explode('-',$uncus->un_log_transaction);
                                          $unFullname = App\Models\UnregisterAcc::where('un_id',$uncus->un_id)->first();
                                          $unrFullname = $unFullname->un_firstname .' '.$unFullname->un_middlename.' '.$unFullname->un_lastname;

                                          @endphp
                                        <tr >
                                            <td>{{$unrFullname}}</td>
                                            <td>{{$unFullname->un_email}}</td>
                                            <td>{{$unFullname->un_contact}}</td>
                                            <td>{{$uncus->un_log_date}}</td>
                                            <td>{{$uncus->un_log_start_time}}</td>
                                            <td>{{$uncus->un_log_end_time}}</td>
                                                @if ($uncus->un_log_status === 1)
                                                <td>
                                                    Pending
                                                </td>
                                                <td style="display:grid; place-items:center;">
                                                    <button type="button" class="btn btn-warning" onclick="out('{{$uncus->unregister_id}}')">Confirm</i></button>
                                                </td>
                                                @elseif ($uncus->un_log_status === 2)
                                                <td >
                                                    Completed
                                                </td>
                                                <td style="display:grid; place-items:center;">
                                                    <i class="feather icon-check btn btn-icon btn-success"></i>
                                                </td>
                                                @else
                                                <td>
                                                    Active
                                                </td>
                                                <td style="display:grid; place-items:center;">
                                                    <button class="btn btn-primary" onclick="out('{{$uncus->unregister_id}}')">Logout</button>
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
                    {{-- end content --}}
                </div>
                  <div class="tab-pane fade " id="unregister" role="tabpanel" aria-labelledby="home-tab">
 
                    {{-- content --}}
                    <style>
                        .clickable:hover{
                            cursor:pointer;
                            text-decoration:underline;
                            color: #ff5c40;
                        }
                    </style>
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
                                            <th>Status</th>
                                            <th style="display: none;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                        $UnCustomer = App\Models\UnregisterAcc::all();
                                       @endphp
                                          @foreach ($UnCustomer as $Uncus)
                                          @php
                                           $Uncus_fullname = $Uncus->un_firstname .' '.$Uncus->un_middlename.' '.$Uncus->un_lastname;
                                          @endphp
                                        <tr>
                                            <td onclick="editType('{{$Uncus->un_id}}','{{$Uncus->un_firstname}}','{{$Uncus->un_middlename}}','{{$Uncus->un_lastname}}','{{$Uncus->un_email}}','{{$Uncus->un_contact}}','{{$Uncus->un_ext}}','{{$Uncus->un_type}}')" class="clickable" data-toggle="modal" data-target="#editType"> {{$Uncus_fullname}}</td>
                                            <td>{{$Uncus->un_email}}</td>
                                            <td>{{$Uncus->un_contact }}</td>
                                            <td style="display: none;"></td>
                                            @php
                                                 $UnCustomer = App\Models\CustomerLogUnregister::where('un_id', $Uncus->un_id)->where('un_log_status', 0)->first();
                                                $count = $UnCustomer ? 1 : 0;
                                            @endphp
                                            @if ($count > 0)
                                                 <td>
                                                    Active
                                                </td>
                                                <td style="display:grid; place-items:center;">
                                                    <button class=" btn btn-primary" onclick="out('{{$UnCustomer->unregister_id}}')">Logout</button>
                                                </td>
                                                @else
                                                <td id='unstatus{{$Uncus->un_id}}'>
                                                    Logged Out
                                                </td>
                                                <td style="display:grid; place-items:center;" id='un_login{{$Uncus->un_id}}'>
                                                    <button class=" btn btn-success" onclick="login('{{$Uncus->un_id}}')">Login</button>
                                                </td>
                                                @endif
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  
                              </div>
                            </div>
                          </section>
    
                        
                 
                    {{-- content end --}}

                  </div>
            </div>
        </div>
    </div>
</div>

{{-- modal start info --}}
<div id="editType" class="custom-modal" tabindex="-1" role="dialog" aria-labelledby="customModalTitle" aria-hidden="true">
    <div class="custom-modal-dialog custom-modal-fullscreen" role="document">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5 class="custom-modal-title" id="customModalTitle">Update Guest</h5>
                <button type="button" class="custom-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="custom-modal-body">
              
                   <form class="needs-validation" novalidate method="POST" action="{{route('editType')}}">
            @csrf
            <div class="form-row">
                <div class="col-md-6 mb-6">
                      <input type="hidden" name="Un_id_type" id="Un_id_type">
                    <label for="validationTooltip01">First name</label>
                    <input type="text" class="form-control" id="unfirstname" name="unfirstname" placeholder="First name" value="" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="validationTooltip02">Middle name</label>
                    <input type="text" class="form-control" id="unmiddlename" name="unmiddlename" placeholder="Middle name" value="" >
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="validationTooltip03">Last name</label>
                    <input type="text" class="form-control" id="unlastname" name="unlastname" placeholder="Last name" value="" >
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="">Ext.</label>
                            <select class="form-control" id="unext" name="unext">
                                   <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="Jra.">Jra.</option>
                                    <option value="Esq.">Esq.</option>
                            </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip04">Email</label>
                    <input type="text" class="form-control" id="unemail" name="unemail" placeholder="Email" >
                    <div class="invalid-tooltip">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip05">Number</label>
                    <input type="Number" class="form-control" id="unnumber" name="unnumber" placeholder="Number" >
                    <div class="invalid-tooltip">
                        Please provide a valid state.
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6 mb-3">
                      <div class="form-group">
                                <label for="">User Type</label>
                                <select class="form-control" name="Un_customer_type" id="Un_customer_type">
                                    <option value="Student">Student</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Reviewer">Reviewer</option>
                                    <option value="Professional">Professional</option>
                                </select>
                            </div>  
                </div>
                 <div class="col-md-6 ">
                 
                     <button class="btn  btn-primary" type="submit" style="margin-top: 4%;">Update Guest</button>
                   
                </div>
            </div>
           
        </form>

            </div>
        </div>
    </div>
</div>
{{-- modal end info--}} 

{{-- modal start info --}}
<div id="out" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('UnregisterLogout')}}" method="POST">
                    @csrf
              
                 <div class="row">
                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                        <label for="email"><strong>Hours</strong></label> <br>
                        <p class=""  id="hours"></p> 
                    </div>

                </div>

                <div class="col-sm-6">
                     <div style="margin-left: 40px;">
                        <br>
                        <label for="email"><strong>Payment : </strong></label> <br>
                        <p class=""  id="payment"></p> 
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                        <label for="email"><strong>Start time: </strong></label> <br>
                        <p class=""  id="start"></p> 
                    </div>

                </div>

                <div class="col-sm-6">
                     <div style="margin-left: 40px;">
                        <br>
                        <label for="email"><strong>End time: </strong></label> <br>
                        <p class=""  id="end"></p> 
                    </div>
                </div>

            </div>
            <br>
            <input type="hidden" id="un_id" name="un_id">
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success">Accept Payment</button>
            </div>
             </form>
            </div>
            
        </div>
    </div>
</div>
{{-- modal end info--}} 

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
<div id="insertmodal" class="custom-modal" tabindex="-1" role="dialog" aria-labelledby="customModalTitle" aria-hidden="true">
    <div class="custom-modal-dialog custom-modal-fullscreen" role="document">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5 class="custom-modal-title" id="customModalTitle">Insert Log</h5>
                <button type="button" class="custom-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="custom-modal-body">
              
                   <form class="needs-validation" novalidate method="POST" action="{{route('AcceptUnregisterLog')}}">
            @csrf
            <div class="form-row">
                <div class="col-md-6 mb-6">
                  
                    <label for="validationTooltip01">First name</label>
                    <input type="text" class="form-control" id="" name="firstname" placeholder="First name" value="" required>
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="validationTooltip02">Middle name</label>
                    <input type="text" class="form-control" id="" name="middlename" placeholder="Middle name" value="" >
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="validationTooltip03">Last name</label>
                    <input type="text" class="form-control" id="" name="lastname" placeholder="Last name" value="" >
                    <div class="valid-tooltip">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <label for="">Ext.</label>
                            <select class="form-control" id="" name="ext">
                                   <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="Jra.">Jra.</option>
                                    <option value="Esq.">Esq.</option>
                            </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip04">Email</label>
                    <input type="text" class="form-control" id="" name="email" placeholder="Email" >
                    <div class="invalid-tooltip">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip05">Number</label>
                    <input type="Number" class="form-control" id="" name="number" placeholder="Number" >
                    <div class="invalid-tooltip">
                        Please provide a valid state.
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6 mb-3">
                      <div class="form-group">
                                <label for="">User Type</label>
                                <select class="form-control" name="customer_type" id="">
                                    <option value="Student">Student</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Reviewer">Reviewer</option>
                                    <option value="Professional">Professional</option>
                                </select>
                            </div>  
                </div>
                 <div class="col-md-6 ">
                 
                     <button class="btn  btn-primary" type="submit" style="margin-top: 4%;">Insert Log</button>
                   
                </div>
            </div>
           
        </form>

            </div>
        </div>
    </div>
</div>


<form action="" method="POST" id="acceplog"> 
@csrf
<input type="hidden" name="pending_log" id="pending_log">
</form>
<form action="" method="POST" id="acceplog_unregister"> 
@csrf
<input type="hidden" name="unregister_id" id="unregister_id">
</form>
<form action="" method="POST" id="login_unregister"> 
@csrf
<input type="hidden" name="login_id" id="login_id">
</form>
<!-- [ Main Content ] end -->
    <script>
function editType(id,first,mid,last,email,contact,ext,type){
     document.getElementById('Un_id_type').value=id;
     document.getElementById('unfirstname').value=first;
     document.getElementById('unmiddlename').value=mid;
     document.getElementById('unlastname').value=last;
      document.getElementById('unemail').value=email;
       document.getElementById('unnumber').value=contact;
        document.getElementById('unext').value=ext;
          document.getElementById('Un_customer_type').value=type;
}


        function out(id){
             
          alertify.confirm("Confirm Logout","Are you sure you want to logout this customer?", function() {
        document.getElementById('roller').style.display='flex';
        document.getElementById('unregister_id').value=id;
        var formData = $("form#acceplog_unregister").serialize();    
        console.log(formData);    
        $.ajax({
            type: 'POST',
            url: "{{route('accept_unregistered')}}",
            data: formData,
            success: function(response) {
                  document.getElementById('roller').style.display='none';
                  document.getElementById('un_id').value=id;
             document.getElementById('payment').textContent=response.payment;
             document.getElementById('start').textContent=response.start;
             document.getElementById('end').textContent=response.end;
              document.getElementById('hours').textContent=response.hours +':'+ response.minutes;

            }, 
            error: function (xhr) {

                console.log(xhr.responseText);
            }
        });
        $('#out').modal('toggle');
    }, function() {
      
        alertify.error('Cancel');
     
    });

       
        }
         function login(id){
             
          alertify.confirm("Confirm Logout","Are you sure you want to login this customer?", function() {
        document.getElementById('roller').style.display='flex';
        document.getElementById('login_id').value=id;
        var formData = $("form#login_unregister").serialize();    
        console.log(formData);    
        $.ajax({
            type: 'POST',
            url: "{{route('UnregisterLogin')}}",
            data: formData,
            success: function(response) {
               document.getElementById('roller').style.display='none';
               const element='un_login'+id;
                const unstatus='unstatus'+id;
                 document.getElementById(unstatus).textContent='Active';
               document.getElementById(element).innerHTML='';
                document.getElementById(element).innerHTML=` <button class=" btn btn-primary" onclick="out('${response.id}')">Logout</button>`;
              
                                               
            }, 
            error: function (xhr) {

                console.log(xhr.responseText);
            }
        });
    }, function() {
      
        alertify.error('Cancel');
     
    });
        }


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
function accept_unregistered(id){
    document.getElementById('pending_log').value=id;
document.getElementById('roller').style.display='flex';
event.preventDefault();
 var formData = $('form#unregister_acceplog').serialize();

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