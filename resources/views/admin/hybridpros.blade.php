@if (session()->has('Admin_id'))

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.assets.header', ['title'=>'Subscription Plans'])
    <style>
           .card-radio {
            cursor: pointer;
        }

        .card-radio input[type="radio"] {
            display: none;
        }

        .card-radio input[type="radio"]:checked + .card {
            border-color: #007bff;
            background-color: #e7f3ff;
        }

        .card-radio input[type="radio"]:checked + .card .card-body {
            color: #007bff;
        }
        .acc_btn:hover{
            cursor: pointer;
            text-decoration: underline;
        }
           .mainLoader{
            width: 100%;
            justify-content: center;
           }
           .loader {
                          width: 40px;
                          aspect-ratio: 1;
                          display: grid;
                        }
                        .loader:before,
                        .loader:after {
                          content: "";
                          background: orange;
                          transform-origin: left;
                          animation: l24 2s infinite;
                        }
                        .loader:before {
                          transform-origin:right;
                          --s:-1;
                        }
                        @keyframes l24 {
                           0%,
                           10%   {transform:translate(0,0)  scale(1)}
                           33%   {transform:translate(calc(var(--s,1)*50%),0)  scale(1)}
                           66%   {transform:translate(calc(var(--s,1)*50%),calc(var(--s,1)*-50%))  scale(1)}
                           90%,
                           100%  {transform:translate(calc(var(--s,1)*50%),calc(var(--s,1)*-50%))  scale(0.5,2)}
                        }
    </style>
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
       <div class="d-flex justify-content-end w-100 mb-4">
        <div class="d-flex gap-4">
            <form id="searchCustomer" method="GET" class="form-inline">
                @csrf
                <input class="form-control mr-sm-2" type="search" placeholder="Search Customer Name" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" onclick="SearchCustomer('{{ route('HybridSearchCustomer') }}')" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                  </svg></button>
            </form>
            <button type="button" class="btn  btn-primary"  data-toggle="modal" data-target="#exampleModalCenter">See All Plans</button>
            <button type="button" class="btn  btn-primary" onclick="ClearInputs(['customer_name', 'phoneNumber', 'email'])" data-toggle="modal" data-target="#registerCustomer">Register Customer</button>
        </div>
       </div>
      <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header" >

                    <h5>Hybrid Pros</h5>


                </div>
                <div class="card-body table-border-style">

                    <div class="accordion " id="customerList">
                      <div class="mainLoader" id="mainLoader" style="display: flex;">
                        <div class="loader"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- [ Main Content ] end -->
    </div>
</div>

    <!-- Required Js -->

      <div id="registerCustomer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Purchase Plan</h5>
                    <button type="button" id="closeRegisterModal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">

                    <div class="col-md-12">
                        <form  id="customerRegistration" method="POST" >
                            @csrf
                            <div class="d-flex w-100 justify-content-between">
                                <h5>Customer Information: </h5>
                                <button type="button" onclick="CustomerExist('{{ route('HybridCustomerExist') }}','{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" id="btnExist" class="btn btn-success">Select Existing Customer</button>
                                <button type="button" onclick="CustomerNew()" id="btnNew" style="display: none" class="btn btn-success">Insert New</button>
                            </div>
                           <div class="pl-4 mt-4 mb-4" id="insertnewcustomer">
                            <div class="form-group">
                                <label for="customername">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name"  aria-describedby="emailHelp" placeholder="Customer Name" name="customername" required>
                                <small class="text-danger" style="display:none" id="customer_name_e">Please Provide a name</small>
                            </div>
                            <div class="form-group">
                                <label for="phonenumber">Phone Number</label>
                                <input type="number" class="form-control" id="phoneNumber"  aria-describedby="emailHelp" placeholder="Phone Number" name="phonenumber" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email"  aria-describedby="emailHelp" placeholder="Email" name="email" required>

                            </div>
                           </div>

                           <div class="pl-4 mt-4 mb-4" id="insertexisting" style="display: none">
                            <table id="customers" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                           </div>

                           <h5>Select Plan:</h5>
                           <div class="pl-4 mt-4">
                            <div class="form-group">
                                <select class="form-control"  name="select_plan" id="select_plan" required>
                                <option value="0" disabled selected>------Select Plan------</option>
                                @php
                                    $plans = App\Models\ServiceHP::where('service_disable','!=',1)->get();
                                @endphp

                                @foreach ($plans as $plan)
                                    <option value="{{$plan->service_id}}">{{$plan->service_name}} (₱{{ $plan->service_price }})</option>
                                @endforeach
                                </select>
                                <small style="display: none" id="select_plan_e" class="text-danger">Please Select a Plan</small>
                            </div>
                           </div>

                           <div class="d-flex justify-content-end w-100">
                            <button type="button" onclick="RegisterCustomer('{{ route('HybridRegisterCustomer') }}', '{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" class="btn  btn-primary">Register a customer</button>
                           </div>


                        </form>
                    </div>
               </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
              <button type="button" id="editProfileFormClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="editCustomerForm" method="post">
                @csrf
                <input type="hidden" name="updateCustomerId" id="updateCustomerId">
                <div class="pl-4 mt-4 mb-4">
                    <div class="form-group">
                        <label for="customername">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name_edit"  aria-describedby="emailHelp" placeholder="Customer Name" name="customername" required>
                        <small class="text-danger" style="display:none" id="customer_name_edit_e">Please Provide a name</small>
                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Phone Number</label>
                        <input type="number" class="form-control" id="phoneNumber_edit"  aria-describedby="emailHelp" placeholder="Phone Number" name="phonenumber" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email_edit"  aria-describedby="emailHelp" placeholder="Email" name="email" required>

                    </div>
                   </div>
               </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" onclick="UpdateCustomerProfile('{{ route('HybridUpdateProfile') }}', '{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editCustomerPlan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Plan Status</h1>
              <button type="button" id="editPlanFormClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="updatePlanForm" method="POST">
                @csrf
                <input type="hidden" name="hp_id" id="updateHp_id">
                <p class="fs-6">Plan Purchased: <span id="planEditName"></span> <span data-bs-toggle="modal" data-bs-target="#changePlan"
                     class="ml-4 badge text-bg-primary p-1 acc_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                      </svg> Change Plan
                </span></p>
                <p class="fs-6">Date Purchased: <span id="planPurchaseDate"></span> <span onclick="editPurchaseDate()" class="acc_btn" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                  </svg></span></p>
                  <input type="hidden" id="inpPlanPurchaseDate" name="inpPlanPurchaseDate" class="form-control">
                <p class="fs-6">Expiration Date: <span id="planExpirationDate"></span> <span onclick="editExpDate()" class="acc_btn" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                  </svg></span></p>
                <input type="hidden" id="inpPlanExpDate" name="expirationDate" class="form-control">
                <p class="fs-6">Time Remaining: <span id="planTimeRemaining"></span> <span class="acc_btn" onclick="editTimeRemaining()" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                  </svg></span></p>
                  <input type="hidden" id="inpPlanTimeRemaining" name="timeRemaining" class="form-control">
                  <p id="planStatus" class="fs-6">Status: </p>
                  <input type="hidden" name="active_status" id="editPlanActiveStatus">
                  <div class="gap-4" style="display: none" id="editActiveStatus">
                   <button type="button" id="editStatusInactive" onclick="SetActivePlan(0)" class="btn btn-outline-danger">Inactive</button>
                   <button type="button" id="editStatusActive" onclick="SetActivePlan(1)" class="btn btn-outline-success">Active</button>
                  </div>
               </form>

               <div id="viewLogs">

                <h4 class="text-primary">Log Sessions</h4>
                <table id="hybridLogHistory" class="table table-striped" style="width:100%;">
                    <thead>
                    <tr>
                    <th>Log Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Consume Time</th>
                    <th>Remaining Time</th>
                    <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    </table>
               </div>

                <div  id="transferPlan" style="display:none" >
                  <div class="d-flex w-100 justify-content-between">
                    <h4 class="text-primary">Select Other Customer to transfer plan</h4>
                    <button type="button" id="cancelSelectionCustomer" onclick="RemoveSelect()" style="display: none" class="btn btn-primary">Cancel Selection</button>
                  </div>
                    <table id="transferCustomerList" class="table table-striped" style="width:100%;">
                        <thead>
                        <tr>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Select</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        </table>
                        <h4 class="text-primary mt-3">Register New Customer and transfer plan</h4>
                        <form method="post" id="registerTransferCustomer" class="pl-4 mt-4 mb-4" >
                            <input type="hidden" name="hph_id" id="transferCustomerHPH_ID">
                            @csrf
                            <div class="form-group">
                                <label for="other_customer_name">Customer Name</label>
                                <input oninput="RemoveSelect()" type="text" class="form-control" id="other_customer_name"  aria-describedby="emailHelp" placeholder="Customer Name" name="customername" required>
                                <small class="text-danger" style="display:none" id="other_customer_name_e">Please Provide a name</small>
                            </div>
                            <div class="form-group">
                                <label for="other_phoneNumber">Phone Number</label>
                                <input  oninput="RemoveSelect()" type="number" class="form-control" id="other_phoneNumber"   placeholder="Phone Number" name="phonenumber" required>
                            </div>
                            <div class="form-group">
                                <label  for="other_email">Email</label>
                                <input oninput="RemoveSelect()" type="email" class="form-control" id="other_email"  aria-describedby="emailHelp" placeholder="Email" name="email" required>

                            </div>
                           </form>

                        <div class="d-flex justify-content-end w-100">
                            <button type="button" onclick="TransferPlanCustomer('{{ route('HybridTransferPlanAdd') }}', '{{ route('HybridTransferPlanSelect') }}','{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" class="btn btn-success">Transfer Plan to this Customer</button>
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
              <button type="button" onclick="SwitchTransferPlan(this)" class="btn btn-outline-success">Transfer Plan</button>
              <button type="button" onclick="SaveChangesEditPlan('{{route('HybridEditPlans')}}', '{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <form id="selectedOtherCustomerForm" method="post">
        @csrf
        <input type="hidden" name="hph_id" id="transferCustomerHPH_ID_radio">
        <input type="hidden" name="hp_id" id="transferCustomer_id">
      </form>

      <div class="modal fade" id="changePlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Select New Plan</h1>
              <button type="button" id="changePlanClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePlanForm" method="post">
                    @csrf
                    <input type="hidden" id="changePlanHistoryId" name="hph_id">
                    <div class="form-group">
                        <select class="form-control" name="select_plan"required>
                        <option value="0" disabled selected>------Select New Plan------</option>
                        @php
                            $plans = App\Models\ServiceHP::where('service_disable','!=',1)->get();
                        @endphp

                        @foreach ($plans as $plan)
                            <option value="{{$plan->service_id}}">{{$plan->service_name}}</option>
                        @endforeach
                        </select>
                        <small style="display: none" id="select_plan_e" class="text-danger">Please Select a Plan</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="ChangePlan('{{ route('HybridChangePlan') }}','{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" class="btn btn-primary">Change Plan</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="buyNewPlan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Buy New Plan</h1>
              <button type="button" id="closeBuyNewPlan" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="buyNewPlanForm" method="post">
                @csrf
                <input type="hidden" name="customer_id" id="customer_id">
                <h5>Customer Name: <span class="text-decoration-underline" id="customerNewPlan"></span></h5>
                <h5>Select New Plan:</h5>
                <div class="pl-4 mt-4">
                 <div class="form-group">
                     <select class="form-control" id="bunos" onchange="DetectBunos(this)"  name="select_plan"required>
                     <option value="0" disabled selected>------Select Plan------</option>
                     @php
                         $plans = App\Models\ServiceHP::where('service_disable','!=',1)->get();
                     @endphp

                     @foreach ($plans as $plan)
                         <option value="{{$plan->service_id}}">{{$plan->service_name}}</option>
                     @endforeach
                     </select>
                     <small style="display: none" id="select_plan_e" class="text-danger">Please Select a Plan</small>
                 </div>

                 <div id="freeBunos" style="display:none">
                    <div class="form-group">
                        <label for="bunosExpDate">Expiration Date</label>
                        <input type="date" class="form-control" id="bunosExpDate"  aria-describedby="emailHelp" placeholder="Exp Date" name="expDate" required>

                    </div>
                    <div class="d-flex w-100 gap-4 justify-content-between">
                        <div class="form-group w-50">
                            <label for="bunosHours">Hours</label>
                            <input type="number" class="form-control" id="bunosHours"  aria-describedby="emailHelp" placeholder="Hours" name="hours" required>

                        </div>
                        <div class="form-group w-50">
                            <label for="bunosMinutes">Minutes</label>
                            <input type="number" class="form-control" id="bunosMinutes"  aria-describedby="emailHelp" placeholder="Minutes" name="minutes" required>

                        </div>
                    </div>
                 </div>

                </div>
               </form>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="BuyNewPlan('{{ route('HybridBuyNewPlan') }}','{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="accept_payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Accept Payment</h1>
              <button id="closeAcceptBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="accept_payment_form" class="container mt-5">
                    @csrf
                    <input type="hidden" name="id" id="hp_id">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="card-radio">
                                <input type="radio" name="mode" value="Cash">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Cash</h5>
                                        <p class="card-text">Accept Cash Payment</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="card-radio">
                                <input type="radio" name="mode" value="E-Pay">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">E-Pay</h5>
                                        <p class="card-text">G-Cash or online payment</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <p>Plan Purchase:  <span id="acceptPlanPurchased"></span></p>
                    <p>Expiration Date:  <span id="acceptExpirationDate"></span></p>
                    <div class="form-group">
                        <label for="acceptAmmount">Ammount</label>
                        <input type="text" class="form-control" id="acceptAmmount" name="acceptAmmount" placeholder="Ammount">
                    </div>
                </form>

            </div>
            <div class="modal-footer">
              <button type="button" onclick="AcceptPayment('{{ route('HybridAcceptPayment') }}', '{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}')" class="btn btn-primary">Confirm</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="viewAllHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Plan History</h1>
              <button id="closeAcceptBtn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="customerHistory" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                    <th>Plan</th>
                    <th>Date Purchased</th>
                    <th>Date Expired</th>
                    <th>Transfer Status</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
            </div>
            <div class="modal-footer">
              <button data-bs-dismiss="modal" type="button"  class="btn btn-primary">Okay</button>
            </div>
          </div>
        </div>
      </div>
     @include('admin.assets.adminscript')

     <form id="logging" method="post">
        @csrf
        <input type="hidden" name="customer_id" id="logging_id">
        <input type="hidden" name="status" id="logging_status">
     </form>

     <input type="hidden" id="customerHistoryAPI" value="{{ route('HybridCustomerHistory') }}">
     <input type="hidden" id="customerLogHistoryAPI" value="{{ route('HybridGetLogHistory') }}">
     <input type="hidden" id="customerGetOtherAPI" value="{{ route('HybridGetOtherCustomer') }}">

     <input type="hidden" id="customerRemoveCustomerAPI" value="{{ route('HybridRemoveCustomer') }}">
     <input type="hidden" id="customerRemovePlanAPI" value="{{ route('HybridRemovePlan') }}">


     <form method="POST" id="RemoveCustomerForm">
        @csrf
        <input type="hidden" id="removeCustomerHP_ID" name="hp_id">
     </form>

     <form method="POST" id="RemovePlanForm">
        @csrf
        <input type="hidden" id="removePlanHPH_ID" name="hph_id">
     </form>
<script>
    window.onload = () => {
        LoadCustomer('{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}');
    }

</script>

</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif
