@if (session()->has('Admin_id'))

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <button type="button" class="btn  btn-primary"  data-toggle="modal" data-target="#seeAllPlan">See All Plans</button>
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

<div class="modal fade" id="seeAllPlan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modify Hybrid Pros Plans</h1>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row p-4" id="planForm">
                @csrf
                <div class="form-group col-6">
                    <label for="addPlanName">Plan Name</label>
                    <input type="text" class="form-control" id="addPlanName" placeholder="Plan Name" name="name">
                    <small id="addPlanName_e" class="text-danger d-none">This is required</small>
                </div>
                <div class="form-group col-6">
                    <label for="addPrice">Price</label>
                    <input type="number" class="form-control" id="addPrice" placeholder="Price" name="price">
                    <small id="addPrice_e" class="text-danger d-none">This is required</small>
                </div>
                <div class="form-group col-6">
                    <label for="addTotalHours">Total Hours</label>
                    <input type="number" class="form-control" id="addTotalHours" placeholder="Hours" name="hours">
                    <small id="addTotalHours_e" class="text-danger d-none">This is required</small>
                </div>
                <div class="form-group col-6">
                    <label for="addActiveDays">Active Days</label>
                    <input type="number" class="form-control" id="addActiveDays" placeholder="Days" name="days">
                    <small id="addActiveDays_e" class="text-danger d-none">This is required</small>
                </div>
                <button id="addPlanBtn" type="button" class="btn btn-primary col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                        <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                      </svg>
                    Add Plan</button>

                    <button id="updatePlanBtn" type="button" class="btn btn-dark col-12 d-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square " viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                          </svg>

                        Edit Plan</button>
            </form>
            <table id="planTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Price</th>
                        <th>Total Hours</th>
                        <th>Active Days</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>
                </tbody>
            </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
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
               <form id="updatePlanForm" method="POST" class="row">
                @csrf
                <div class="col-6">
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
                </div>
                <div class="col-6 border p-2 rounded d-none" id="editHybridLogsDiv">
                    <div class="d-flex justify-content-between w-100 mb-2"> <h5>Edit HybridPros Login Logs</h5> <button id="closeEditHybridLogsBtn" type="button" class="btn-close"></button> </div>
                    <div class="form-group">
                        <label for="editHybridLogsDate">Log Date</label>
                        <input type="date" onchange="updateHybridLogsInput(this, 'editHybridprosLogsDate')" class="form-control" id="editHybridLogsDate" >
                    </div>
                    <div class="form-group">
                        <label for="editHybridLogsTimeIn">Time In</label>
                        <input onchange="updateHybridLogsInput(this, 'editHybridprosLogsTimeIn')" type="time" class="form-control" id="editHybridLogsTimeIn" >
                    </div>
                    <div class="form-group">
                        <label for="editHybridLogsTimeOut">Time Out</label>
                        <input onchange="updateHybridLogsInput(this, 'editHybridprosLogsTimeOut')" type="time" class="form-control" id="editHybridLogsTimeOut"  >
                    </div>

                    <div class="d-flex justify-content-end p-1 w-100">
                        <button id="saveChangesUpdateHybridprosLogs" type="button" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>

                <div class="col-6 border p-2 rounded d-none" id="addHybridLogDiv">
                    <div class="d-flex justify-content-between w-100 mb-2"> <h5>Add HybridPros Login Logs</h5> <button id="closeAddHybridLogsBtn" type="button" class="btn-close"></button> </div>
                    <div class="form-group">
                        <label for="addHybridLogsDate">Log Date</label>
                        <input type="date" onchange="updateHybridLogsInput(this, 'addHybridprosLogsDate')" class="form-control" id="addHybridLogsDate" >
                        <small id="addHybridLogsDateE" class="text-danger d-none">This Field is Required</small>
                    </div>
                    <div class="form-group">
                        <label for="addHybridLogsTimeIn">Time In</label>
                        <input onchange="updateHybridLogsInput(this, 'addHybridprosLogsTimeIn')" type="time" class="form-control" id="addHybridLogsTimeIn" >
                        <small  id="addHybridLogsTimeInE" class="text-danger d-none">This Field is Required</small>
                    </div>
                    <div class="form-group">
                        <label for="addHybridLogsTimeOut">Time Out</label>
                        <input onchange="updateHybridLogsInput(this, 'addHybridprosLogsTimeOut')" type="time" class="form-control" id="addHybridLogsTimeOut"  >

                    </div>

                    <div class="d-flex justify-content-end p-1 w-100">
                        <button id="addHybridProsLogsBtn" type="button" class="btn btn-primary">Add Logs</button>
                    </div>
                </div>

               </form>

               <div id="viewLogs">

                <div class="w-100 d-flex justify-content-between">
                    <h4 class="text-primary">Log Sessions</h4>
                    <button id="openHybridProsAddLogBtn" class="btn btn-primary">Add Logs</button>
                </div>
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
        <div class="modal-dialog modal-lg">
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
                        <div class="col-md-4">
                            <label class="card-radio w-100">
                                <input type="radio" name="mode" onclick="checkPaymentMethod(this)" value="Cash">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Cash</h5>
                                        <p class="card-text">Accept Cash Payment</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="card-radio w-100">
                                <input type="radio" name="mode" onclick="checkPaymentMethod(this)" value="E-Pay">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">E-Pay</h5>
                                        <p class="card-text">G-Cash or online payment</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="card-radio w-100">
                                <input type="radio" name="mode" onclick="checkPaymentMethod(this)" value="Both">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Both</h5>
                                        <p class="card-text">Accept Both Payment Methods</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <p>Plan Purchase:  <span id="acceptPlanPurchased"></span></p>
                    <p>Expiration Date:  <span id="acceptExpirationDate"></span></p>
                    <p>Total Ammount: <span id="totalAcceptAmmount"></span></p>
                    <input type="hidden" id="maxAmmountHolder">
                    <div class="form-group" id="paymentNotBoth">
                        <label for="acceptAmmount">Ammount</label>
                        <input type="number" class="form-control" id="acceptAmmount" name="acceptAmmount" placeholder="Ammount">
                    </div>

                    <div class="form-group d-none" id="paymentBothCash">
                        <label for="acceptAmmountBothCash">Cash Ammount</label>
                        <input type="number" class="form-control" id="acceptAmmountBothCash" name="cashAmmount" placeholder="Enter Cash Ammount">
                        <small class="text-danger" style="display: none" id="acceptAmmountBothCash_E">No Ammount is found please put something</small>
                    </div>
                    <div class="form-group d-none" id="paymentBothEPay">
                        <label for="acceptAmmountBothEPay">E-Pay Ammount</label>
                        <input type="number" class="form-control" id="acceptAmmountBothEPay" name="epayAmmount" placeholder="Enter E-Pay Ammount">
                        <small class="text-danger " style="display: none" id="acceptAmmountBothEPay_E">No Ammount is found please put something</small>
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
                    <th>Remaining Time</th>
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


     <form method="POST" id="editHybridprosLogsForms">
        @csrf
        <input type="hidden" id="editHybridprosLogsID" name="id">
        <input type="hidden" id="editHybridprosLogsDate" name="date">
        <input type="hidden" id="editHybridprosLogsTimeIn" name="time_in">
        <input type="hidden" id="editHybridprosLogsTimeOut" name="time_out">
     </form>
     <form id="addHybridProsLogsForm" method="POST">
        @csrf
        <input type="hidden" id="addHybridProsLogId" name="hph_id">
        <input type="hidden" id="addHybridprosLogsDate" name="date">
        <input type="hidden" id="addHybridprosLogsTimeIn" name="timeIn">
        <input type="hidden" id="addHybridprosLogsTimeOut" name="timeOut">
     </form>

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
     <script type="text/javascript" src="{{ asset('admins/hybridpros.js') }}"></script>
<script>
    window.onload = () => {
        LoadPlans();
        LoadCustomer('{{ route('HybridCustomerList') }}', '{{ route('HybridLogging') }}');
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif
