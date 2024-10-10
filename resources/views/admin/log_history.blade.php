@if (session()->has('Admin_id'))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header', ['title' => 'Log History'])
    </head>

    <body class="">
        <div class="lds-roller" id="roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
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
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="col-sm-8 mt-2">Log History</h5>
                            <button class="btn btn-primary col-auto" data-toggle="modal" data-target="#groupmodal"
                                onclick="GenerateId()">
                                Group Log </button>

                            <button class="btn btn-primary col-auto" data-toggle="modal"
                                data-target="#insertmodal">Insert Log</button>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                                <li class="nav-item" onclick="runLogHistory()">
                                    <a class="nav-link active text-uppercase" id="profile-tab" data-toggle="tab"
                                        href="#profile" role="tab" aria-controls="profile" aria-selected="false">Log
                                        History</a>
                                </li>
                                <li class="nav-item" onclick="runGroupLog()">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#group"
                                        role="tab" aria-controls="home" aria-selected="true">Group Log</a>
                                </li>
                                <li class="nav-item" onclick="runCustomerLog()">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Customer Log</a>
                                </li>
                                <li class="nav-item" onclick="reserveData()">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#reservationTable"
                                        role="tab" aria-controls="home" aria-selected="true">Reservation</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">

                                    {{-- content --}}



                                    <!-- Table with stripped rows -->
                                    <table id="customerlog" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Log</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>


                                    {{-- content end --}}
                                </div>
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <p class="mb-0">
                                    <section class="section">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- Table with stripped rows -->
                                                <table id="loghistory" class="table table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Mark</th>
                                                            <th>Action</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <Th>Contact</Th>
                                                            <th>Log Date</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                            <th>Total Time</th>
                                                            <th>Payment</th>
                                                            <th>Method</th>
                                                            <th>Status</th>
                                                            <th>Comment</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="col-sm-12">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="col-sm-8 mt-2"></h5>
                                                        <button class="btn btn-danger col-auto" id="logoutbymark"
                                                            style="display:none;" onclick="logoutmark()">Logout</button>
                                                        <button class="btn btn-danger col-auto" id="deletebymark"
                                                            style="display:none;" onclick="deletemark()">Delete</button>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </p>
                                </div>
                                <div class="tab-pane fade " id="group" role="tabpanel" aria-labelledby="home-tab">

                                    {{-- content --}}



                                    <!-- Table with stripped rows -->
                                    <table id="GroupTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Group Name</th>
                                                <th>Number Of People</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- content end --}}
                                </div>
                                <div class="tab-pane fade" id="reservationTable" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <p class="mb-0">
                                    <section class="section">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- Table with stripped rows -->
                                                <table id="reservationDataTable" class="table table-striped text-center" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Action</th>
                                                            <th>Reservation ID</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="viewcuslog" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Customer Log</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table id="viewcustomerlog" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Log Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Total Time</th>
                                            <th>Transaction Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="viewgrouplog" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Group Log</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="LogoutAllId" id="LogoutAllId">
                                <table id="viewgrouplogTable" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Mark</th>
                                            <th>Full Name</th>
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
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-danger col-auto" id="logoutbymark1" style="display:none;" onclick="logoutmark1()">Logout</button>
                                <button type="button" class="btn btn-danger" onclick="LogoutAll()">Logout
                                    All</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- modal start info --}}
                <div id="out" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Payment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="pendingPayment">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div style="margin-left: 40px;">
                                                <br>
                                                <input type="hidden" name="id" id="id">
                                                <label for="email"><strong>Hours</strong></label> <br>
                                                <p class="" id="hours"></p>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div style="margin-left: 40px;">
                                                <br>
                                                <label for="email"><strong>Payment : </strong></label> <br>

                                                <input type="text" name="payment" style="width: 80px;height:40px;"
                                                    class="form-control" id="payment">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div style="margin-left: 40px;">
                                                <br>
                                                <label for="email"><strong>Start time: </strong></label> <br>
                                                <p class="" id="start"></p>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div style="margin-left: 40px;">
                                                <br>
                                                <label for="email"><strong>End time: </strong></label> <br>
                                                <p class="" id="end"></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="margin-left: 40px;">
                                                <label for=""><strong>Payment Method</strong></label>
                                                <select class="form-control" style="width: 80px;height:40px;"
                                                    id="" name="paymentMethod">
                                                    <option value="Cash">Cash</option>
                                                    <option value="E-Pay">E-Pay</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div style="text-align: center;">
                                        <button type="button" class="btn btn-danger"
                                            onclick="BackToLogout()">Continue Session</button>

                                        <button type="button" class="btn btn-success"
                                            onclick="acceptPending()">Accept Payment</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}
                <!-- [ Main Content ] end -->
            </div>
            </div>

            {{-- GROUP MODAL START --}}
            <div class="modal fade" id="groupmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Group Log</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                id="modalCloseButton"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">

                            <div>
                                <form action="" id="LogByGroupForm" method="POST">
                                    @csrf
                                    <div id="Groupbody">
                                        <h5 class="modal-title" id="">New Customer</h5>
                                        <input type="hidden" id="groupId" name="groupId">
                                        <div class="col-md-12 d-flex align-items-center">
                                            <hr class="flex-grow-1">
                                            <i class="fas fa-plus ml-3" onclick="AddFieldGroup()"></i>
                                        </div>
                                        <h4 class="text-center" id="addfieldtext">Add New Customer</h4>


                                    </div>
                                </form>
                                <div class="col-md-12 d-flex align-items-center">
                                    <hr class="flex-grow-1">
                                </div>
                                <form action="" id="LogByExistGroupForm" method="POST">
                                    @csrf
                                    <div id="ExistGroupbody">
                                        <h5 class="modal-title" id="">Existing Customer</h5>
                                        <input type="hidden" id="groupId2" name="groupId2">
                                        <div class="col-md-12 d-flex align-items-center">
                                            <hr class="flex-grow-1">
                                            <i class="fas fa-plus ml-3" data-toggle="modal"
                                                data-target="#existgroupmodal" onclick="GetExistGroupTable()"></i>
                                        </div>
                                        <h4 class="text-center" id="addfieldtext2">Existing Customer</h4>

                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 d-flex align-items-center">
                                <hr class="flex-grow-1">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                aria-label="Close">Close</button>
                            <button type="button" class="btn btn-primary" onclick="SaveLogByGroup()">LogIn
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal --}}

            {{-- GROUP MODAL START --}}
            <div class="modal fade" id="existgroupmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Existing Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <table id="existgroupform" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal --}}

            {{-- insert modal start --}}
            <div id="insertmodal" class="custom-modal" tabindex="-1" role="dialog"
                aria-labelledby="customModalTitle" aria-hidden="true">
                <div class="custom-modal-dialog custom-modal-fullscreen" role="document">
                    <div class="custom-modal-content">
                        <div class="custom-modal-header">
                            <h5 class="custom-modal-title" id="customModalTitle">Insert Log</h5>
                            <button type="button" class="custom-close" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="custom-modal-body">

                            <form class="needs-validation" novalidate method="POST" id="Insertnewcus">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label for="validationTooltip01">First name <span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                            placeholder="First name" value="" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label for="validationTooltip02">Middle name</label>
                                        <input type="text" class="form-control" id="" name="middlename"
                                            placeholder="Optional" value="">
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label for="validationTooltip03">Last name <span
                                                style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                            placeholder="Last name" value="" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label for="">Ext.(Optional)</label>
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
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip04">Email</label>
                                        <input type="text" class="form-control" id="" name="email"
                                            placeholder="Optional">
                                        <div class="invalid-tooltip">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip05">Phone Number</label>
                                        <input type="number" class="form-control" id="number" name="number"
                                            placeholder="Optional" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid number
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="">User Type <span style="color: red;">*</span></label>
                                            <select class="form-control" name="customer_type" id="">
                                                <option value="Regular">Regular</option>
                                                <option value="Student">Student</option>
                                                <option value="Teacher">Teacher</option>
                                                <option value="Reviewer">Reviewer</option>
                                                <option value="Professional">Professional</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <button class="btn btn-primary" type="button" style="margin-top: 5%;"
                                            onclick="insertnewcustomer()">Regular Log</button>

                                        <button class="btn btn-success" type="button" style="margin-top: 5%;"
                                            onclick="insertnewcustomerByDayPass()">DayPass</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="editpaymentmodal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="" novalidate method="POST" id="EditPaymentbillForm">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01">Payment</label>
                                        <input type="hidden" name="editpaymentid" id="editpaymentid">
                                        <input type="text" class="form-control" id="editpaymentamount"
                                            name="editpaymentamount" placeholder="Payment Amount " value=""
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn  btn-primary" type="button"
                                            onclick="EditPaymentLog()">Save Changes</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div id="editpaymentmethodmodal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Payment Method</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="" novalidate method="POST" id="EditPaymentMethodForm">
                                @csrf
                                <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center -->
                                    <div class="col-md-12 mb-6 text-center"> <!-- Added text-center -->
                                        <label for="validationTooltip01">Payment Method</label>
                                        <input type="hidden" name="editpaymenMethodtid" id="editpaymenMethodtid">
                                        <select class="form-control" id="EditpaymentMethod" name="EditpaymentMethod">
                                            <option value="Cash">Cash</option>
                                            <option value="E-Pay">E-Pay</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn  btn-primary" type="button"
                                            onclick="EditPaymentLogMethod()">Save Changes</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div id="editstarttime" class="modal fade " tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Login Time</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="" novalidate method="POST" id="editstarttimeform">
                                @csrf
                                <div class="row mb-4 justify-content-center text-center">
                                    <!-- Added justify-content-center -->
                                    <div class="col-md-12 mb-6 justify-content-center text-center">
                                        <!-- Added text-center -->
                                        <label for="validationTooltip01">Start Time</label>
                                        <input type="hidden" name="editstarttimeid" id="editstarttimeid">
                                        <input type="time" name="logstarttime" id="logstarttime"
                                            class="form-control text-center">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn  btn-primary" type="button" data-bs-dismiss="modal"
                                            onclick="EditStartTime()">Save Changes</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div id="SelectLogType" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Select log Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="" novalidate method="POST" id="EditPaymentForm">
                                @csrf
                                <div class="row d-flex justify-content-between align-items-start">
                                    <input type="hidden" name="logtypeid" id="logtypeid">
                                    <div class="col-md-6 text-center">
                                        <button class="btn btn-primary" type="button" onclick="AccLogin()">Regular
                                            Log</button>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <button class="btn btn-success" type="button"
                                            onclick="logAsDayPass()">DayPass</button>
                                    </div>
                                </div>



                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <form action="" id="pendingLog" method="post">
                @csrf
                <input type="hidden" name="" id="cuslogoutid">
            </form>

            <!-- [ Main Content ] end -->
            <form id="submitComment" method="post">
                @csrf
                <input type="hidden" name="log_id" id="comment_log_id">
                <input type="hidden" name="comment" id="comment_log_message">
            </form>

            @include('admin.assets.adminscript')
            <!-- Required Js -->
            <script>
                function GenerateId1() {
                    return Math.floor(100000 + Math.random() * 900000);

                }

                function GenerateId() {
                    var id = GenerateId1();
                    document.getElementById('groupId').value = id;
                    document.getElementById('groupId2').value = id;
                }

                var addedContentArray = [];
                var uniqueId = 1;

                function AddFieldGroup() {
                    document.getElementById('addfieldtext').style.display = 'none';
                    var groupBody = document.getElementById('Groupbody');
                    var container = document.createElement('div');
                    container.innerHTML = `
        <div class="row" id="rowid${uniqueId}">
            <div class="col-md-4">
                <label for="validationTooltip01">First name <span style="color: red;">*</span></label>
                <input type="text" name="IndivFirstName[]" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="validationTooltip01">Last name <span style="color: red;">*</span></label>
                <input type="text" name="IndivLastName[]" class="form-control">
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">User Type <span style="color: red;">*</span></label>
                    <select class="form-control" name="IndivType[]" id="">
                        <option value="Regular">Regular</option>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Reviewer">Reviewer</option>
                        <option value="Professional">Professional</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 text-center" style= "margin-top:5%;">
                <i class="fas fa-minus ml-3" onclick="RemoveFieldGroup('rowid${uniqueId}')"></i>
            </div>
        </div>
    `;
                    groupBody.appendChild(container);
                    addedContentArray.push(container);
                    uniqueId++;
                }


                function newcusgrouplog() {
                    var formData = $("form#LogByGroupForm").serialize();


                    var saveLogByGroupURL = "{{ route('SaveLogByGroup') }}";

                    $.ajax({
                        type: "POST",
                        url: saveLogByGroupURL,
                        data: formData,
                        success: function(response) {

                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                function existcusgrouplog() {
                    var formData1 = $("form#LogByExistGroupForm").serialize();

                    var saveLogByGroupURL = "{{ route('SaveLogByExistGroup') }}";
                    $.ajax({
                        type: "POST",
                        url: saveLogByGroupURL,
                        data: formData1,
                        success: function(response) {
                            return true;
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                function SaveLogByGroup() {
                    var successCount = 0;
                    document.getElementById('roller').style.display = 'flex';

                    var formData = $("form#LogByGroupForm").serialize();
                    var saveLogByGroupURL = "{{ route('SaveLogByGroup') }}";

                    $.ajax({
                        type: "POST",
                        url: saveLogByGroupURL,
                        data: formData,
                        success: function(response) {

                            successCount++;
                            checkSuccess();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });

                    var formData1 = $("form#LogByExistGroupForm").serialize();
                    var saveLogByExistGroupURL = "{{ route('SaveLogByExistGroup') }}";

                    $.ajax({
                        type: "POST",
                        url: saveLogByExistGroupURL,
                        data: formData1,
                        success: function(response) {

                            successCount++;
                            checkSuccess();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });

                    function checkSuccess() {
                        if (successCount === 2) {
                            alertify.success('Both requests successful');
                        } else if (successCount === 1) {
                            alertify.success('One request successful');
                        }
                        if (successCount === 2 || successCount === 1) {
                            document.getElementById('roller').style.display = 'none';
                            CustomerlogHistory();
                            getCustomerData();
                            GetGroup();
                            document.getElementById('modalCloseButton').click();
                        }
                    }
                }

                function RemoveFieldGroup(id) {
                    var groupBody = document.getElementById(id);
                    groupBody.remove();
                }

                function GetExistGroupTable() {
                    $('#existgroupform').DataTable({
                        scrollX: true,
                        order: [
                            [2, 'desc']
                        ],
                        columnDefs: [{
                            target: 2,
                            visible: false,
                            searchable: false

                        }, ],

                        "destroy": "true",
                        "ajax": {
                            "url": "{{ route('GetCustomerAccDetail') }}",
                            "type": "GET"
                        },
                        "columns": [{
                                "data": null,
                                "render": function(data, type, row) {
                                    var first = row.customer_firstname;
                                    var last = row.customer_lastname;
                                    return first + " " + last;
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {

                                    return `<button class="btn btn-success" type="button" onclick="AddexistCustomerTable('` +
                                        row.customer_id + `','` + row.customer_firstname + `','` + row
                                        .customer_lastname + `','` + row.customer_type + `')">Add</button>`;
                                }
                            },
                            {
                                "data": "created_at"
                            }
                        ],
                    });
                }

                function AddexistCustomerTable(id, first, last, type) {
                    document.getElementById('addfieldtext2').style.display = 'none';
                    var groupBody = document.getElementById('ExistGroupbody');
                    var container = document.createElement('div');
                    var existingId = document.getElementById(`rowid${id}`);
                    if (existingId) {
                        alertify.alert("Warning", "Customer Already Added.", function() {});
                    } else {
                        container.innerHTML = `
        <div class="row" id="rowid${id}">
            <div class="col-md-4">
                 <input type="hidden" name="IndivId[]" value="${id}" class="form-control" readonly>
                <label for="validationTooltip01">First name <span style="color: red;">*</span></label>
                <input type="text" name="IndivFirstName[]" value="${first}" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="validationTooltip01">Last name <span style="color: red;">*</span></label>
                <input type="text" name="IndivLastName[]" value="${last}" class="form-control" readonly>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">User Type <span style="color: red;">*</span></label>
                     <input type="text" name="IndivType[]" class="form-control" value="${type}" readonly>
                </div>
            </div>
            <div class="col-md-1 text-center" style= "margin-top:5%;">
                <i class="fas fa-minus ml-3" onclick="RemoveFieldGroup('rowid${id}')"></i>
            </div>
        </div>
    `;
                        groupBody.appendChild(container);
                        addedContentArray.push(container);
                    }


                }



                function editType(id, first, mid, last, email, contact, ext, type) {
                    document.getElementById('Un_id_type').value = id;
                    document.getElementById('unfirstname').value = first;
                    document.getElementById('unmiddlename').value = mid;
                    document.getElementById('unlastname').value = last;
                    document.getElementById('unemail').value = email;
                    document.getElementById('unnumber').value = contact;
                    document.getElementById('unext').value = ext;
                    document.getElementById('Un_customer_type').value = type;
                }

                function insertnewcustomer() {
                    var formData = $("form#Insertnewcus").serialize();
                    document.getElementById('roller').style.display = 'flex';
                    $.ajax({
                        type: "POST",
                        url: "{{ route('InsertNewCustomer') }}",
                        data: formData,
                        success: function(response) {
                            document.getElementById('roller').style.display = 'none';
                            if (response.status == 'firstname') {
                                document.getElementById('firstname').style.border = '1px solid red';
                            } else if (response.status == 'lastname') {
                                document.getElementById('lastname').style.border = '1px solid red';
                            } else if (response.status == 'failed') {
                                document.getElementById('firstname').style.border = '1px solid red';
                                document.getElementById('lastname').style.border = '1px solid red';
                            } else if (response.status == 'exist') {
                                alertify
                                    .alert("Warning",
                                        "Customer First And Last Name Already Exist! Insert Additional Information.",
                                        function() {
                                            alertify.message('OK');
                                        });
                            } else if (response.status == 'match') {
                                alertify
                                    .alert("Warning", "Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response.status == 'email_match') {
                                alertify
                                    .alert("Warning", "Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response.status == 'number_match') {
                                alertify
                                    .alert("Warning", "Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else {
                                alertify
                                    .alert("Success", "Customer Successfully Logged", function() {
                                        alertify.message('OK');
                                        location.reload();
                                    });
                            }


                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                function insertnewcustomerByDayPass() {
                    var formData = $("form#Insertnewcus").serialize();
                    document.getElementById('roller').style.display = 'flex';
                    $.ajax({
                        type: "POST",
                        url: "{{ route('insertnewcustomerByDayPass') }}",
                        data: formData,
                        success: function(response) {
                            document.getElementById('roller').style.display = 'none';
                            if (response.status == 'firstname') {
                                document.getElementById('firstname').style.border = '1px solid red';
                            } else if (response.status == 'lastname') {
                                document.getElementById('lastname').style.border = '1px solid red';
                            } else if (response.status == 'failed') {
                                document.getElementById('firstname').style.border = '1px solid red';
                                document.getElementById('lastname').style.border = '1px solid red';
                            } else if (response.status == 'exist') {
                                alertify
                                    .alert("Warning",
                                        "Customer First And Last Name Already Exist! Insert Additional Information.",
                                        function() {
                                            alertify.message('OK');
                                        });
                            } else if (response.status == 'match') {
                                alertify
                                    .alert("Warning", "Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response.status == 'email_match') {
                                alertify
                                    .alert("Warning", "Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response.status == 'number_match') {
                                alertify
                                    .alert("Warning", "Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else {
                                alertify
                                    .alert("Success", "Customer Successfully Logged", function() {
                                        alertify.message('OK');
                                        location.reload();
                                    });
                            }


                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }


                $(document).ready(function() {
                    CustomerlogHistory();
                    // getCustomerData();
                    // GetGroup();
                    reloadPageEvery30Minutes();
                });

                function reloadPageEvery30Minutes() {
                    setTimeout(function() {
                        location.reload();
                    }, 30 * 60 * 1000); // 30 minutes in milliseconds
                }

                function runLogHistory() {
                    CustomerlogHistory();
                    if ($.fn.DataTable.isDataTable('#customerlog')) {
                        $('#customerlog').DataTable().clear().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#GroupTable')) {
                        $('#GroupTable').DataTable().clear().destroy();
                    }
                }

                function runCustomerLog() {
                    getCustomerData();
                    if ($.fn.DataTable.isDataTable('#loghistory')) {
                        $('#loghistory').DataTable().clear().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#GroupTable')) {
                        $('#GroupTable').DataTable().clear().destroy();
                    }
                }

                function runGroupLog() {
                    GetGroup();
                    if ($.fn.DataTable.isDataTable('#loghistory')) {
                        $('#loghistory').DataTable().clear().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#customerlog')) {
                        $('#customerlog').DataTable().clear().destroy();
                    }
                }

            function MarkData() {
            let checkboxes = document.querySelectorAll('input[name="mark1[]"]');
            let atLeastOneChecked = false;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        atLeastOneChecked = true;
                    }
                });

                if (atLeastOneChecked) {
                    document.getElementById('logoutbymark').style.display = 'block';
                    document.getElementById('deletebymark').style.display = 'block';
                    document.getElementById('logoutbymark1').style.display = 'block';
                } else {
                    document.getElementById('logoutbymark').style.display = 'none';
                    document.getElementById('deletebymark').style.display = 'none';
                       document.getElementById('logoutbymark1').style.display = 'none';
                }
        }

                function MarkDelete() {
                    const checkboxes = document.querySelectorAll('input[id="mark2"]');
                    let atLeastOneChecked = false;

                    checkboxes.forEach(checkbox => {
                        if (checkbox.checked) {
                            atLeastOneChecked = true;
                        }
                    });

                    if (atLeastOneChecked) {
                        document.getElementById('deletebymark').style.display = 'block';
                    } else {
                        document.getElementById('deletebymark').style.display = 'none';
                    }
                }

                function deletemark() {
                    alertify.confirm("Message","Are You Sure You Want to Delete Selected Log?",
  function(){
   var formData = new FormData();
                    var csrfToken = '{{ csrf_token() }}';
                    $('input[name="mark1[]"]:checked').each(function() {
                        formData.append('array[]', $(this).val());
                    });
                    formData.append('_token', csrfToken);
                    document.getElementById('roller').style.display = 'flex';
                    $.ajax({
                        type: "POST",
                        url: "{{ route('deletemark') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            document.getElementById('roller').style.display = 'none';
                            document.getElementById('logoutbymark').style.display = 'none';
                            document.getElementById('deletebymark').style.display = 'none';
                            if (response.status === 'success') {
                                alertify.alert("Message", "Log Successfully Deleted", CustomerlogHistory);
                            } else {
                                alertify.error('Failed to delete log: ' + (response.message || 'Unknown error.'));
                            }
                        },
                        error: function(xhr, status, error) {
                            document.getElementById('roller').style.display = 'none';
                            console.error(xhr.responseText);
                            alertify.error('An error occurred while deleting the log.');
                        }
                    });
  },
  function(){
    alertify.error('Cancel');
  });

                }

                function logoutmark() {
                alertify.confirm("Message","Are You Sure You Want to Logout Selected Log?",
  function(){
                    var formData = new FormData();
                    var csrfToken = '{{ csrf_token() }}';

                    $('input[name="mark1[]"]:checked').each(function() {
                        formData.append('array[]', $(this).val());
                    });
                    formData.append('_token', csrfToken);
                    document.getElementById('roller').style.display = 'flex';
                    $.ajax({
                        type: "POST",
                        url: "{{ route('logoutmark') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            document.getElementById('roller').style.display = 'none';
                            document.getElementById('logoutbymark').style.display = 'none';
                            if (response.status === 'success') {
                                alertify.alert("Message", "Log Successfully Logout", CustomerlogHistory);
                            } else {
                                alertify.error('Failed to delete log: ' + (response.message || 'Unknown error.'));
                            }
                        },
                        error: function(xhr, status, error) {
                            document.getElementById('roller').style.display = 'none';
                            console.error(xhr.responseText);
                            alertify.error('An error occurred while deleting the log.');
                        }
                    });
},
  function(){
    alertify.error('Cancel');
  });
                }
                function logoutmark1() {
                                    alertify.confirm("Message","Are You Sure You Want to Logout Selected Log?",
  function(){
                     const var_id =document.getElementById('LogoutAllId').value;
                    var formData = new FormData();
                    var csrfToken = '{{ csrf_token() }}';

                    $('input[name="mark1[]"]:checked').each(function() {
                        formData.append('array[]', $(this).val());
                    });
                     formData.append('group_id', var_id);
                    formData.append('_token', csrfToken);

                    document.getElementById('roller').style.display = 'flex';
                    $.ajax({
                        type: "POST",
                        url: "{{ route('logoutmark1') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            document.getElementById('roller').style.display = 'none';
                            document.getElementById('logoutbymark1').style.display = 'none';
                              viewGroupLog(response.group_id);
                            if (response.status === 'success') {
                                alertify.alert("Message", "Log Successfully Logout", CustomerlogHistory);
                            } else {
                                alertify.error('Failed to delete log: ' + (response.message || 'Unknown error.'));
                            }
                        },
                        error: function(xhr, status, error) {
                            document.getElementById('roller').style.display = 'none';
                            console.error(xhr.responseText);
                            alertify.error('An error occurred while deleting the log.');
                        }
                    });
                    },
  function(){
    alertify.error('Cancel');
  });

                }

                function CustomerlogHistory() {
                    $('#loghistory').DataTable({
                        scrollX: true,
                        scrollY: '400px',
                        scrollCollapse: true,
                         paging: true, // Enable paging
                         pageLength: 25, // Set the number of rows per page
                        info: false,
                        order: [
                            [13, 'asc']
                        ],
                        columnDefs: [{
                                targets: [0,3, 4, 13],
                                visible: false
                            },
                            {
                                targets: 14,
                                visible: false,
                                searchable: false
                            }
                        ],
                        layout: {
                            topStart: {
                                buttons: [
                                    'colvis'
                                ]
                            }
                        },
                        destroy: true,
                        ajax: {
                            url: '{{ route('CustomerlogHistory') }}',
                            type: 'GET'
                        },
                        columns: [
                            {
                                data: null,
                                render: function(data, type, row) {
                                    const {
                                        log_id,
                                        log_status
                                    } = row;
                                    if (log_status == 0) {
                                        return '<input type="checkbox" style="border:1px solid;" class="form-check-input" name="mark1[]" value="' +
                                            log_id + '" id="mark1" onclick="MarkData()">';
                                    } else {
                                        return '<input type="checkbox" style="border:solid 1px;" class="form-check-input" name="mark1[]" value="' +
                                            log_id + '" id="mark2" onclick="MarkDelete()">';
                                    }
                                },
                                className: 'text-center' // Center align the column content
                            },
                             {
                                data: 'log_type',
                                render: (data, type, row) => {
                                    const {
                                        log_status,
                                        log_transaction,
                                        log_id,
                                        log_start_time,
                                        log_end_time
                                    } = row;
                                    if (data === 1 || data === 2) {
                                        if (log_status === 0) {
                                            return `<button class='btn btn-danger' type='button' data-bs-toggle='modal' data-bs-target='#out' onclick='Pending(${log_id})'>Logout</button>`;
                                        } else if (log_status === 1) {
                                            const payment = log_transaction.split('-')[0];
                                            return `<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#out' type='button' onclick="PendingToOut('${log_id}', ${payment}, '${log_start_time}', '${log_end_time}')">Confirm</button>`;
                                        } else {
                                            return 'Paid';
                                        }
                                    } else if (data === 0) {
                                        if (log_status === 0) {
                                            return `<button class='btn btn-danger' type='button' onclick='Pending(${log_id})'>Logout</button>`;
                                        } else if (log_status === 1) {
                                            const [payment, secondPart] = log_transaction.split('-');
                                            if (secondPart == 1) {
                                                return `<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#out' type='button' onclick="PendingToOut('${log_id}', ${payment}, '${log_start_time}', '${log_end_time}')">Confirm</button>`;
                                            } else {
                                                return `<button class='btn btn-warning' type='button' onclick='acceptLog(${log_id})'>Confirm</button>`;
                                            }
                                        } else {
                                            return 'Paid';
                                        }
                                    }
                                }
                            },
                            {
                                data: null,
                                render: (data, type, row) => {
                                    const {
                                        firstname,
                                        lastname,
                                        middlename
                                    } = row;
                                    return `${firstname} ${middlename ? middlename : ''} ${lastname? lastname:''}`;
                                }
                            },
                            {
                                data: 'email'
                            },
                            {
                                data: 'contact'
                            },
                            {
                                data: null,
                                render: (data, type, row) => {
                                    const dateParts = row.log_date.split('/');
                                    return `${dateParts[1]}/${dateParts[0]}/${dateParts[2]}`;
                                }
                            },
                            {
                                data: null,
                                render: (data, type, row) => {
                                    const {
                                        log_id,
                                        log_start_time
                                    } = row;
                                    return `<span data-bs-toggle="modal" data-bs-target="#editstarttime" onclick="editstarttimedata('${log_id}', '${log_start_time}')">${log_start_time}</span>`;
                                }
                            },
                            {
                                data: 'log_end_time'
                            },
                            {
                                data: null,
                                render: (data, type, row) => {
                                    const {
                                        log_start_time,
                                        log_end_time
                                    } = row;
                                    if (!log_end_time) return '';
                                    const totaltime = timeDifference(log_start_time, log_end_time);
                                    return `${totaltime.hours<10?'0'+totaltime.hours:totaltime.hours}:${totaltime.minutes<10?'0'+totaltime.minutes:totaltime.minutes}`;
                                }
                            },
                            {
                                data: null,
                                render: (data, type, row) => {
                                    const {
                                        log_id,
                                        log_transaction
                                    } = row;
                                    if (!log_transaction) return '';
                                    const payment = parseFloat(log_transaction);
                                    return `<span data-bs-toggle="modal" data-bs-target="#editpaymentmodal" onclick="EditLogPayment('${log_id}', '${payment}')">${payment}</span>`;
                                }
                            },
                            {
                                data: null,
                                render: (data, type, row) => {
                                    const {
                                        log_id,
                                        log_payment_method
                                    } = row;
                                    const method = log_payment_method ? log_payment_method : 'Not Set';
                                    return `<span data-bs-toggle="modal" data-bs-target="#editpaymentmethodmodal" onclick="EditLogPaymentMethod('${log_id}', '${method}')">${method}</span>`;
                                }
                            },
                            {
                                data: 'log_status',
                                render: (data) => {
                                    switch (data) {
                                        case 0:
                                            return 'Active';
                                        case 1:
                                            return 'Pending';
                                        default:
                                            return 'Completed';
                                    }
                                }
                            },
                            {
                                data: null,
                                render: (data, type, row) => {
                                    const {
                                        log_id,
                                        log_comment
                                    } = row;
                                    return `<input value="${log_comment ? log_comment : ''}" style="border:none;background-color:transparent" placeholder="No Comment" class="undeditSpan" id="log_comment${log_id}" onclick="editComment(${log_id})">`;
                                }
                            },
                           
                            {
                                data: null,
                                render: (data, type, row) => {
                                    return `<button class='btn btn-warning' type='button' onclick='delete_log("${row.log_id}")'>Delete</button>`;
                                }
                            },
                            {
                                data: 'updated_at'
                            }
                        ],

                    });
                }

                function convertTo24Hour(timeStr) {
                    // Extract the parts of the time
                    const [time, modifier] = timeStr.split(' ');

                    let [hours, minutes] = time.split(':');

                    // Convert hours to number
                    hours = parseInt(hours, 10);

                    // Handle the AM/PM modifier
                    if (modifier === 'PM' && hours !== 12) {
                        hours += 12;
                    }
                    if (modifier === 'AM' && hours === 12) {
                        hours = 0;
                    }

                    // Format hours and minutes to always be two digits
                    hours = hours < 10 ? '0' + hours : hours;
                    minutes = minutes < 10 ? '0' + minutes : minutes;

                    return `${hours}:${minutes}`;
                }

                // Function to convert 24-hour time format to 12-hour format
                function convertTo12HourFormat(time24) {
                    // Split the time into hours and minutes
                    const [hours, minutes] = time24.split(':');

                    // Determine if it's AM or PM
                    const period = hours >= 12 ? 'PM' : 'AM';

                    // Convert hours to 12-hour format
                    let hours12 = parseInt(hours) % 12;
                    hours12 = hours12 === 0 ? 12 : hours12; // If hours is 0, convert it to 12

                    // Format the time in 12-hour format
                    const time12 = `${hours12}:${minutes} ${period}`;

                    return time12;
                }

                // Function to edit start time data
                function editstarttimedata(id, time) {
                    document.getElementById('editstarttimeid').value = id;
                    document.getElementById('logstarttime').value = convertTo24Hour(time);
                }

                function EditStartTime() {
                    document.getElementById('roller').style.display = 'flex';
                    const timeInputValue = document.getElementById('logstarttime').value;
                    const time12 = convertTo12HourFormat(timeInputValue);
                    const formData = $("form#editstarttimeform").serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('EditStartTime') }}?safix=" + time12,
                        data: formData,
                        success: function(response) {
                            if (response.status == 'success') {
                                CustomerlogHistory();
                                document.getElementById('roller').style.display = 'none';
                                alertify.alert("Message", "Log Start Time Successfully Updated", function() {
                                    alertify.message('OK');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alertify.alert("Error",
                                "An error occurred while updating the start time. Please try again.",
                                function() {
                                    alertify.message('OK');
                                });
                        }
                    });
                }



                // function EditStartTime(){
                //     const t = document.getElementById('logstarttime').value;
                //     console.log(t);

                //     alertify.confirm("Warning", "Are You Sure You Want To Update This Log Start Time?",
                //         function() {
                //             alertify.success('Ok');
                //             var formData = $("form#editstarttimeform").serialize();
                //     $.ajax({
                //         type: "POST",
                //         url: "{{ route('EditStartTime') }}",
                //         data: formData,
                //         success: function(response) {
                //             if (response.status == 'success') {
                //                 alertify
                //                     .alert("Message",
                //                         "Customer First And Last Name Already Exist! Insert Additional Information.",
                //                         function() {
                //                             alertify.message('OK');
                //                         });
                //             }
                //         },
                //            error: function(xhr, status, error) {
                //             console.error(xhr.responseText);
                //         }
                //     });
                //         },
                //         function() {
                //             alertify.error('Cancel');

                //         });
                // }

                function EditLogPayment(id, payment) {
                    alertify.confirm("Warning", "Are You Sure You Want To Edit This Log Payment?",
                        function() {

                            document.getElementById('editpaymentamount').value = payment;
                            document.getElementById('editpaymentid').value = id;
                        },
                        function() {
                            $('#editpaymentmodal').modal('hide');
                        });
                }

                function EditLogPaymentMethod(id, method) {
                    alertify.confirm("Warning", "Are You Sure You Want To Edit This Log Payment Method?",
                        function() {

                            document.getElementById('EditpaymentMethod').value = method;
                            document.getElementById('editpaymenMethodtid').value = id;
                        },
                        function() {
                            $('#editpaymentmodal').modal('hide');
                        });
                }

                function EditPaymentLog() {
                    var formData = $("form#EditPaymentbillForm").serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('EditPaymentLog') }}",
                        data: formData,

                        success: function(response) {
                            if (response.status == 'success') {
                                alertify
                                    .alert("Message", "Payment Successfully Updated", function() {
                                        $('#editpaymentmodal').modal('hide');
                                        CustomerlogHistory();
                                    });
                            } else if (response.status == 'empty') {
                                alertify
                                    .alert("Warning", "Insert Payment First!", function() {

                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                function EditPaymentLogMethod() {
                    var formData = $("form#EditPaymentMethodForm").serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('EditPaymentLogMethod') }}",
                        data: formData,

                        success: function(response) {
                            if (response.status == 'success') {
                                alertify
                                    .alert("Message", "Payment Method Successfully Updated", function() {
                                        $('#editpaymentmodal').modal('hide');
                                        CustomerlogHistory();
                                    });
                            } else if (response.status == 'empty') {
                                alertify
                                    .alert("Warning", "Select Payment Method First!", function() {

                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                function delete_log(id) {
                    alertify.confirm("Warning", "Are You Sure You Want To Delete This Log?",
                        function() {
                            alertify.success('Ok');
                            var formData = new FormData();
                            formData.append('log_id', id);
                            formData.append('_token', '{{ csrf_token() }}');
                            document.getElementById('roller').style.display = 'flex';

                            $.ajax({
                                type: "POST",
                                url: "{{ route('DeleteLog') }}",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    document.getElementById('roller').style.display = 'none';
                                    if (response.status === 'success') {
                                        alertify.alert("Message", "Log Successfully Deleted", CustomerlogHistory);
                                    } else {
                                        alertify.error('Failed to delete log: ' + (response.message ||
                                            'Unknown error.'));
                                    }
                                },
                                error: function(xhr, status, error) {
                                    document.getElementById('roller').style.display = 'none';
                                    console.error(xhr.responseText);
                                    alertify.error('An error occurred while deleting the log.');
                                }
                            });
                        },
                        function() {
                            alertify.error('Cancel');
                        }
                    );
                }

                function getCustomerData() {
                    $('#customerlog').DataTable({
                        order: [
                            [5, 'desc']
                        ],
                        columnDefs: [{
                            target: 5,
                            visible: false,
                            searchable: false

                        }, ],
                        scrollX: true,
                        scrollY: '400px',
                        scrollCollapse: true,
                        paging: false,
                        "destroy": "true",
                        "ajax": {
                            "url": "{{ route('GetCustomerAcc') }}",
                            "type": "GET"
                        },
                        "columns": [{
                                "data": null,
                                "render": function(data, row) {
                                    const fullname = data.customer_firstname + ' ' + (data.customer_middlename ==
                                        null ? '' : data.customer_middlename) + ' ' + (data.customer_lastname ==
                                        null ? '':data.customer_lastname);
                                    return fullname;
                                }
                            },
                            {
                                "data": "customer_email"
                            },
                            {
                                "data": "customer_phone_num"
                            },
                            {
                                "data": "customer_id",
                                "render": function(data) {
                                    return "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewcuslog' type='button' onclick='viewLog(" +
                                        data + ")'>View Log</button>";
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    var customer_id = row.customer_id;
                                    var log_in = row.log_in;
                                    var log_id = row.log_id;
                                    var payment = row.log_payment ? row.log_payment : '';
                                    var payment2 = parseFloat(payment).toFixed(2);
                                    var start_time = row.log_start_time;
                                    const end_time = row.log_end_time ? row.log_end_time : '';
                                    var logtype = row.logtype;
                                    if (logtype == 1) {
                                        if (log_in === '0') {
                                            return " ";
                                        } else if (log_in === '1') {
                                            return " ";
                                        } else {
                                            return "<button class='btn btn-success' type='button' data-bs-toggle='modal' data-bs-target='#SelectLogType' onclick='selectlogtype(" +
                                                customer_id + ")'>Login</button>";
                                        }
                                    } else {
                                        if (log_in === '0') {
                                            return " ";
                                        } else if (log_in === '1') {
                                            return " ";
                                        } else {
                                            return "<button class='btn btn-success' type='button' data-bs-toggle='modal' data-bs-target='#SelectLogType' onclick='selectlogtype(" +
                                                customer_id + ")'>Login</button>";
                                        }
                                    }
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    // Check if the sort property is null and return an empty string if true
                                    if (row.sort == null) {
                                        return '2023-05-17 10:51:50';
                                    } else {
                                        // Otherwise, return the value of sort
                                        return row.sort;
                                    }
                                }

                            },
                        ]
                    });
                }


                function GetGroup() {
                    $('#GroupTable').DataTable({
                        order: [
                            [3, 'desc']
                        ],
                        columnDefs: [{
                            target: 3,
                            visible: false,
                            searchable: false
                        }, ],
                        scrollX: true,
                        "destroy": "true",
                        "ajax": {
                            "url": "{{ route('GetGroup') }}",
                            "type": "GET"
                        },
                        "columns": [{
                                "data": "name"
                            },
                            {
                                "data": "count"
                            },
                            {
                                "data": "groupID",
                                "render": function(data) {
                                    return "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewgrouplog' type='button' onclick='viewGroupLog(" +
                                        data + ")'>View Log</button>";
                                }
                            },
                            {
                                "data": "num"
                            }

                        ]
                    });
                }

                function LogoutAll() {
                    alertify.confirm("Alert", "Are You Sure You Want To Logout This Group?",
                        function() {
                            alertify.success('Ok');
                            const id = document.getElementById('LogoutAllId').value;

                            var formData = new FormData();

                            formData.append('id', id);
                            formData.append('_token', '{{ csrf_token() }}');
                            document.getElementById('roller').style.display = 'flex';
                            $.ajax({
                                type: "POST",
                                url: "{{ route('LogToPending3') }}",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    viewGroupLog(response.data);
                                    document.getElementById('roller').style.display = 'none';

                                    alertify
                                        .alert("Message", "Group Successfully Logged Out", function() {

                                        });
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        },
                        function() {
                            alertify.error('Cancel');
                        });

                }

                function viewGroupLog(id) {
                    document.getElementById('LogoutAllId').value = id;
                    $('#viewgrouplogTable').DataTable({
                        scrollX: true,
                        "destroy": "true",
                        "ajax": {
                            "url": "{{ route('viewGroupLog') }}?id=" + id,
                            "type": "GET"

                        },
                        "columns": [{
                                data: null,
                                render: function(data, type, row) {
                                    const {log_id} = row;
                                    return '<input type="checkbox"  style="border:1px solid;" class="form-check-input" name="mark1[]" value="' +
                                        log_id + '" id="mark3" onclick="MarkData()">';
                                },
                                className: 'text-center' // Center align the column content
                            },
                            {
                                "data": "name",
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    var log_in = row.log_in;
                                    var log_id = row.log_id;
                                    var payment = row.log_payment;
                                    var payment2 = parseFloat(payment).toFixed(2);
                                    var start_time = row.log_start_time;
                                    var end_time = row.log_end_time;
                                    var logtype = row.logtype;
                                    if (logtype == 1) {
                                        if (log_in === '0') {
                                            return "<button class='btn btn-danger' type='button' onclick='inAndout2(" +
                                                log_id + ")'>Logout</button>";
                                        } else if (log_in === '1') {
                                            return "<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#out' type='button' onclick=\"PendingToOut('" +
                                                log_id + "', " + payment2 + ", '" + start_time + "', '" + end_time +
                                                "')\">Confirm</button>";
                                        } else {
                                            return "paid";
                                        }
                                    } else {
                                        if (log_in === '0') {
                                            return "<button class='btn btn-danger' type='button' onclick='inAndout2(" +
                                                log_id + ")'>Logout</button>";
                                        } else if (log_in === '1') {
                                            var transac = row.log_payment;
                                            var parts = transac.split('-');
                                            var secondPart = parts[1];
                                            var payment = parts[0];
                                            if (secondPart == 1) {
                                                return "<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#out' type='button' onclick=\"PendingToOut('" +
                                                    row.log_id + "', " + payment + ", '" + row.log_start_time +
                                                    "', '" + row.log_end_time +
                                                    "')\">Confirm</button>";
                                            } else {
                                                return "<button class='btn btn-warning' type='button' onclick='acceptLog(" +
                                                    row.log_id + ")'>Confirm</button>";
                                            }
                                        } else {
                                            return "paid";
                                        }
                                    }
                                }
                            }
                        ]
                    });
                }

                function selectlogtype(id) {
                    document.getElementById('logtypeid').value = id;
                }

                function PendingToOut(id, payment, start, end) {

                    document.getElementById('id').value = id;
                    document.getElementById('payment').value = payment;
                    document.getElementById('start').textContent = start;
                    document.getElementById('end').textContent = end;
                    var totaltime = timeDifference(start, end);
                    var between = totaltime.hours + ':' + totaltime.minutes;
                    document.getElementById('hours').textContent = between;

                }


                function acceptPending() {

                    var formData = $("form#pendingPayment").serialize();
                    document.getElementById('roller').style.display = 'flex';

                    $.ajax({
                        type: "POST",
                        url: "{{ route('LogToPending') }}",
                        data: formData,
                        success: function(response) {
                            CustomerlogHistory();
                            document.getElementById('roller').style.display = 'none';
                            alertify
                                .alert("Message",
                                    "Customer Successfully Paid.",
                                    function() {

                                        viewLog(response.data);
                                        $('#out').modal('hide');

                                    });

                        },
                        error: function(xhr, status, error) {

                            console.error(xhr.responseText);
                        }
                    });
                }

                function BackToLogout() {

                    var formData = $("form#pendingPayment").serialize();
                    document.getElementById('roller').style.display = 'flex';

                    $.ajax({
                        type: "POST",
                        url: "{{ route('BackToLogout') }}",
                        data: formData,
                        success: function(response) {
                            document.getElementById('roller').style.display = 'none';
                            CustomerlogHistory();
                            viewLog(response.data);
                            $('#out').modal('hide');
                        },
                        error: function(xhr, status, error) {

                            console.error(xhr.responseText);
                        }
                    });
                }

                function inAndout(id) {

                    alertify.confirm("Confirmation", "Are You Sure You Want To Logout This Customer?",
                        function() {
                            alertify.success('Ok');
                            document.getElementById('cuslogoutid').value = id;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + id;

                            $.ajax({
                                type: "POST",
                                url: "{{ route('LogToPending') }}",
                                data: Dataform,
                                success: function(response) {
                                    if (response.data == "DayPass") {
                                        alertify
                                            .alert("Message",
                                                "The customer has already exceeded 8 hours, so the plan was automatically upgraded to a DayPass.",
                                                function() {
                                                    getCustomerData();
                                                    CustomerlogHistory();
                                                });
                                    } else {

                                        var totaltime = timeDifference(response.confirm[2], response.confirm[1]);
                                        var between = totaltime.hours + ':' + totaltime.minutes;
                                        document.getElementById('id').value = response.confirm[0];
                                        document.getElementById('payment').value = response.confirm[3];
                                        document.getElementById('start').textContent = response.confirm[2];
                                        document.getElementById('end').textContent = response.confirm[1];
                                        document.getElementById('hours').textContent = between;
                                        getCustomerData();
                                        CustomerlogHistory();
                                        viewLog(response.data);
                                        $('#viewgrouplog').modal('hide');
                                        GetGroup();

                                    }
                                },
                                error: function(xhr, status, error) {

                                    console.error(xhr.responseText);
                                }
                            });
                        },
                        function() {
                            alertify.error('Cancel');
                        });

                }

                function inAndout2(id) {

                    alertify.confirm("Confirmation", "Are You Sure You Want To Logout This Customer?",
                        function() {
                            alertify.success('Ok');
                            document.getElementById('cuslogoutid').value = id;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + id;

                            $.ajax({
                                type: "POST",
                                url: "{{ route('LogToPending2') }}",
                                data: Dataform,
                                success: function(response) {
                                    if (response.data == "DayPass") {
                                        alertify
                                            .alert("Message",
                                                "The customer has already exceeded 8 hours, so the plan was automatically upgraded to a DayPass.",
                                                function() {
                                                    getCustomerData();
                                                    CustomerlogHistory();
                                                });
                                    } else {
                                        getCustomerData();
                                        CustomerlogHistory();

                                        viewLog(response.data);
                                        viewGroupLog(response.data);

                                    }
                                },
                                error: function(xhr, status, error) {

                                    console.error(xhr.responseText);
                                }
                            });
                        },
                        function() {
                            alertify.error('Cancel');
                        });

                }

                function AccLogin() {
                    alertify.confirm("Confirmation", "Are You Sure You Want To Login This Customer?",
                        function() {
                            const logtypeid = document.getElementById('logtypeid').value;
                            document.getElementById('cuslogoutid').value = logtypeid;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + logtypeid;

                            document.getElementById('roller').style.display = 'flex';
                            $.ajax({
                                type: "POST",
                                url: "{{ route('AccLogin') }}",
                                data: Dataform,
                                success: function(response) {
                                    document.getElementById('roller').style.display = 'none';
                                    getCustomerData();
                                    viewLog(response.data);
                                    $('#SelectLogType').modal('hide');
                                },
                                error: function(xhr, status, error) {

                                    console.error(xhr.responseText);
                                }
                            });
                        },
                        function() {
                            alertify.error('Cancel');
                        });

                }

                function logAsDayPass() {
                    alertify.confirm("Confirmation", "Are You Sure You Want To Login This Customer Using DayPass Promo?",
                        function() {
                            const logtypeid = document.getElementById('logtypeid').value;
                            document.getElementById('cuslogoutid').value = logtypeid;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + logtypeid;

                            document.getElementById('roller').style.display = 'flex';
                            $.ajax({
                                type: "POST",
                                url: "{{ route('logAsDayPass') }}",
                                data: Dataform,
                                success: function(response) {
                                    document.getElementById('roller').style.display = 'none';
                                    getCustomerData();
                                    viewLog(response.data);
                                    $('#SelectLogType').modal('hide');
                                },
                                error: function(xhr, status, error) {

                                    console.error(xhr.responseText);
                                }
                            });
                        },
                        function() {
                            alertify.error('Cancel');
                        });
                }

                function viewLog(id) {

                    $('#viewcustomerlog').DataTable({
                        scrollX: true,
                        order: [
                            [0, 'desc']
                        ],
                        destroy: true,
                        "ajax": {
                            "url": "{{ route('GetCustomerlog') }}?cuslogid=" + id,
                            "type": "GET"
                        },
                        "columns": [{
                                "data": null,
                                "render": function(data, type, row) {
                                    const date = row
                                        .log_date;
                                    const parts = date.split('/');
                                    const formattedDate =
                                        `${parts[1]}/${parts[0]}/${parts[2]}`;
                                    return formattedDate;
                                }
                            },
                            {
                                "data": "log_start_time"
                            },
                            {
                                "data": "log_end_time"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    var start_time = row.log_start_time;
                                    var end_time = row.log_end_time || null;
                                    if (end_time === null) {
                                        return '';
                                    } else {
                                        var totaltime = timeDifference(start_time, end_time);
                                        var between = totaltime.hours + ':' + totaltime.minutes;
                                        return between;

                                    }
                                }
                            },
                            {
                                "data": "log_transaction",
                                "render": function(data, type, row) {
                                    var renderedContent = data || '0-0';
                                    var payment = renderedContent.split('-');
                                    return payment[0];

                                }
                            },
                            {
                                'data': 'log_payment_method'
                            },
                            {
                                "data": "log_status",
                                "render": function(data, type, row) {
                                    if (data === 0) {
                                        return "Active";
                                    } else if (data === 1) {
                                        return "Pending";
                                    } else {
                                        return "Completed";
                                    }
                                }
                            },

                        ]
                    });
                }

                function acceptLog(id) {


                    document.getElementById('cuslogoutid').value = id;
                    var formData = $("form#pendingLog").serialize();
                    var Dataform = formData + '&id=' + id;

                    $.ajax({
                        type: "POST",
                        url: "{{ route('acceptLog') }}",
                        data: Dataform,
                        success: function(response) {
                            getCustomerData();
                            CustomerlogHistory();
                            viewLog(response.data);

                        },
                        error: function(xhr, status, error) {

                            console.error(xhr.responseText);
                        }
                    });
                }


                //         function closeDetect() {
                //             CustomerlogHistory();
                // }

                // // Detect when the modal is closed
                // $('#out').on('hidden.bs.modal', function () {
                //     closeDetect();
                // });
                function Pending(id) {
                    alertify.confirm("Confirmation", "Are You Sure You Want To Logout This Customer?",
                        function() {
                            alertify.success('Ok');
                            document.getElementById('cuslogoutid').value = id;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + id;
                            document.getElementById('roller').style.display = 'flex';
                            $.ajax({
                                type: "POST",
                                url: "{{ route('LogToPending') }}",
                                data: Dataform,
                                success: function(response) {
                                    if (response.data == "DayPass") {
                                        document.getElementById('roller').style.display = 'none';
                                        CustomerlogHistory();
                                        const tend = response.confirm[1];
                                        const tstart = response.confirm[2];
                                        var totaltime = timeDifference(tstart, tend);
                                        var between = totaltime.hours + ':' + totaltime.minutes;
                                        document.getElementById('id').value = response.confirm[0];
                                        document.getElementById('payment').value = parseFloat(response.confirm[3]).toFixed(2);
                                        document.getElementById('start').textContent = response.confirm[2];
                                        document.getElementById('end').textContent = response.confirm[1];
                                        document.getElementById('hours').textContent = between;
                                        // CustomerlogHistory();
                                        viewLog(response.data);
                                        alertify
                                            .alert("Message",
                                                "The customer has already exceeded 8 hours, so the plan was automatically upgraded to a DayPass.",
                                                function() {
                                                    $('#viewcuslog').modal('hide');
                                                });
                                    } else {
                                        CustomerlogHistory();
                                        const tend = response.confirm[1];
                                        const tstart = response.confirm[2];
                                        var totaltime = timeDifference(tstart, tend);
                                        var between = totaltime.hours + ':' + totaltime.minutes;
                                        document.getElementById('id').value = response.confirm[0];
                                        document.getElementById('payment').value = response.confirm[3];
                                        document.getElementById('start').textContent = response.confirm[2];
                                        document.getElementById('end').textContent = response.confirm[1];
                                        document.getElementById('hours').textContent = between;
                                        // CustomerlogHistory();
                                        viewLog(response.data);
                                        document.getElementById('roller').style.display = 'none';
                                    }


                                },
                                error: function(xhr, status, error) {

                                    console.error(xhr.responseText);
                                }
                            });
                        },
                        function() {
                            alertify.error('Cancel');
                        });


                }


                function editComment(id) {
                    const spanName = "log_comment" + id;
                    const editSpan = document.getElementById(spanName);
                    editSpan.addEventListener("dblclick", function() {

                        const unedit = document.querySelectorAll('.undeditSpan');
                        unedit.forEach(un => {
                            un.contentEditable = false;
                            un.style.border = "none";
                        });
                        editSpan.contentEditable = true;
                        editSpan.style.border = "1px solid black";
                    });
                }
                document.addEventListener('DOMContentLoaded', events => {
                    document.addEventListener("keydown", function(event) {
                        if (event.key === 'Enter') {
                            document.getElementById('roller').style.display = 'flex';
                            const editSpans = document.querySelectorAll(".undeditSpan");
                            editSpans.forEach(edit => {
                                const editId = edit.id.substring("log_comment".length);
                                document.getElementById('comment_log_id').value = editId;
                                if (edit.value != '') {
                                    document.getElementById('comment_log_message').value = edit.value;
                                    const formData = $('form#submitComment').serialize();
                                    console.log(formData);
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('SaveComment') }}",
                                        data: formData,
                                        success: function(response) {
                                            edit.style.border = "none";
                                            document.getElementById('roller').style.display =
                                                'none';
                                        },
                                        error: function(xhr) {
                                            console.log(xhr.responseText);
                                        }
                                    });
                                }
                            });

                        }

                    });
                })

                function validatePhoneNumber(event) {
                    const phoneNumberInput = event.target;
                    let phoneNumber = phoneNumberInput.value;

                    phoneNumber = phoneNumber.replace(/\D/g, '');

                    if (phoneNumber.length > 11) {
                        phoneNumber = phoneNumber.slice(0, 11);
                    }

                    if (phoneNumber.length > 0 && phoneNumber.charAt(0) !== '9') {
                        phoneNumberInput.setCustomValidity("Please Enter Valid Phone Number.");
                    } else if (phoneNumber.length !== 11) {
                        phoneNumberInput.setCustomValidity("Phone number must be exactly 10 digits.");
                    } else {
                        phoneNumberInput.setCustomValidity("");
                    }

                    phoneNumberInput.value = phoneNumber;
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const phoneInputs = document.querySelectorAll('input[placeholder="Phone Number"]');
                    if (phoneInputs.length > 0) {
                        phoneInputs.forEach(function(phoneInput) {
                            phoneInput.addEventListener('input', validatePhoneNumber);
                            validatePhoneNumber({
                                target: phoneInput
                            });
                        });
                    }
                });
            </script>

    </body>

    <script src="{{ asset('admins/admincustomerlog.js') }}"></script>
    </html>
@else
    @php
        echo '<script>
            window.location.href = "login";
        </script>';
    @endphp
@endif
