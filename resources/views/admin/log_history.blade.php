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
                        <div class="card-header">
                            <h5>Log History</h5>
                            <button class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#insertmodal">Insert Log</button>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active text-uppercase" id="profile-tab" data-toggle="tab"
                                        href="#profile" role="tab" aria-controls="profile" aria-selected="false">Log
                                        History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Customer Log</a>
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
                                                            <th>Action</th>
                                                           
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
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
                                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Info</h5>
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
                                        <button type="button" class="btn btn-success"
                                            onclick="acceptPending()">Accept Payment</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="myLargeModalLabel">Log History</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
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
                                                <h5>Customer name:</h5>
                                                <h5 id="cus_name"></h5>
                                            </div>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">

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
                                            <label for="">User Type <span
                                                style="color: red;">*</span></label>
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

                                        <button class="btn  btn-primary" type="button" style="margin-top: 4%;"
                                            onclick="insertnewcustomer()">Insert Log</button>

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
                    $.ajax({
                        type: "POST",
                        url: "{{ route('InsertNewCustomer') }}",
                        data: formData,
                        success: function(response) {
                            if (response.status == 'firstname') {
                                document.getElementById('firstname').style.border = '1px solid red';
                            } else if (response.status == 'lastname') {
                                document.getElementById('lastname').style.border = '1px solid red';
                            } else if (response.status == 'failed') {
                                document.getElementById('firstname').style.border = '1px solid red';
                                document.getElementById('lastname').style.border = '1px solid red';
                            } else if (response.status == 'exist') {
                                alertify
                                    .alert("Warning","Customer First And Last Name Already Exist! Insert Additional Information.",
                                        function() {
                                            alertify.message('OK');
                                        });
                            } else if (response.status == 'match') {
                                alertify
                                    .alert("Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response.status == 'email_match') {
                                alertify
                                    .alert("Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else if (response.status == 'number_match') {
                                alertify
                                    .alert("Customer Already Exists!", function() {
                                        alertify.message('OK');
                                    });
                            } else {
                                alertify
                                    .alert("Customer Successfully Loged", function() {
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
                    getCustomerData();

                });

                function CustomerlogHistory() {
                    $('#loghistory').DataTable({
                        scrollX: true,
                        order: [
                            [12, 'desc']
                        ],
                        columnDefs: [{
                                target: 2,
                                visible: false,

                            },
                            {
                                target: 1,
                                visible: false,

                            },
                            {
                                target: 12,
                                visible: false,
                               searchable: false

                            },
                        ],
                        layout: {
                            topStart: {
                                buttons: [{
                                        extend: 'copyHtml5',
                                        exportOptions: {
                                            columns: [0, ':visible']
                                        }
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        exportOptions: {
                                            columns: [0, 1, 2, 4, 5, 6, 7, 8, 9, 10]
                                        }
                                    },
                                    'colvis'
                                ]
                            }
                        },
                        "destroy": "true",
                        "ajax": {
                            "url": "{{ route('CustomerlogHistory') }}",
                            "type": "GET"
                        },
                        "columns": [{
                                "data": null,
                                "render": function(data, type, row) {
                                    var first = row.firstname;
                                    var last = row.lastname;
                                    var middle = row.middlename == null ? '' : row.middlename;
                                    return first + " " + middle + " " + last;
                                }
                            },
                            {
                                "data": "email"
                            },
                            {
                                "data": "contact"
                            },
                            {
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
                                    var start = row.log_start_time;
                                    var end = row.log_end_time;
                                    if (end == '' || end == null) {
                                        return '';
                                    } else {
                                        var totaltime = timeDifference(start, end);
                                        var between = totaltime.hours + ':' + totaltime.minutes;
                                        return between;
                                    }

                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    var payment = row.log_transaction;
                                    if (payment == '' || payment == null) {
                                        return '';
                                    } else {
                                        var payment2 = parseFloat(payment).toFixed(2);
                                        return payment2;
                                    }

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
                            {
                                "data": null,
                                "render": function(data, type, row) {

                                    // return row.log_comment;
                                    return `<input value="${row.log_comment === null ? '' : row.log_comment}" style="border:none;background-color:transparent" placeholder="No Comment" class="undeditSpan" id="log_comment${row.log_id}" onclick="editComment(${row.log_id})" >`;
                                }
                            },
                            {
                                "data": "log_type",
                                "render": function(data, type, row) {
                                    if (data === 1) {
                                        var log_status = row.log_status;
                                        if (log_status === 0) {
                                            return "<button class='btn btn-danger' type='button' onclick='Pending(" +
                                                row.log_id + ")'>Logout</button>";
                                        } else if (log_status === 1) {
                                            var transac = row.log_transaction;
                                            var parts = transac.split('-');
                                            var payment = parts[0];
                                            return "<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#out' type='button' onclick=\"PendingToOut('" +
                                                row.log_id + "', " + payment + ", '" + row.log_start_time + "', '" +
                                                row.log_end_time +
                                                "')\">Confirm</button>";
                                        } else {
                                            return "Paid";
                                        }
                                    } else if (data === 0) {
                                        var log_status = row.log_status;
                                        if (log_status === 0) {
                                            return "<button class='btn btn-danger' type='button' onclick='Pending(" +
                                                row.log_id + ")'>Logout</button>";
                                        } else if (log_status === 1) {

                                            var transac = row.log_transaction;
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
                                            return "Paid";
                                        }
                                    }
                                }
                            },
                            {
                                "data":"created_at"
                            }
                        ],
                    });
                }

                function getCustomerData() {
                    $('#customerlog').DataTable({
                        "destroy": "true",
                        "ajax": {
                            "url": "{{ route('GetCustomerAcc') }}",
                            "type": "GET"
                        },
                        "columns": [{
                                "data": null,
                                "render": function(data, row) {
                                    const fullname = data.customer_firstname + ' ' + (data.customer_middlename ==
                                        null ? '' : data.customer_middlename) + ' ' + data.customer_lastname;
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
                                    var payment = row.log_payment;
                                    var payment2 = parseFloat(payment).toFixed(2);
                                    var start_time = row.log_start_time;
                                    var end_time = row.log_end_time;
                                    var logtype = row.logtype;
                                    if (logtype == 1) {
                                        if (log_in === '0') {
                                            return "<button class='btn btn-danger' type='button' onclick='inAndout(" +
                                                log_id + ")'>Logout</button>";
                                        } else if (log_in === '1') {
                                            return "<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#out' type='button' onclick=\"PendingToOut('" +
                                                log_id + "', " + payment2 + ", '" + start_time + "', '" + end_time +
                                                "')\">Confirm</button>";
                                        } else {
                                            return "<button class='btn btn-success' type='button' onclick='AccLogin(" +
                                                customer_id + ")'>Login</button>";
                                        }
                                    } else {
                                        if (log_in === '0') {
                                            return "<button class='btn btn-danger' type='button' onclick='inAndout(" +
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
                                            return "<button class='btn btn-success' type='button' onclick='AccLogin(" +
                                                customer_id + ")'>Login</button>";
                                        }
                                    }
                                }
                            }
                        ]
                    });
                }

                function PendingToOut(id, payment, start, end) {
                    console.log(id);
                    console.log(payment);
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

                    console.log(formData);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('LogToPending') }}",
                        data: formData,
                        success: function(response) {
                            getCustomerData();
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

                    alertify.confirm("Are You Sure You Want To Logout This Customer?",
                        function() {
                            alertify.success('Ok');
                            document.getElementById('cuslogoutid').value = id;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + id;
                            console.log(formData);
                            $.ajax({
                                type: "POST",
                                url: "{{ route('LogToPending') }}",
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
                        },
                        function() {
                            alertify.error('Cancel');
                        });

                }

                function AccLogin(id) {
                    alertify.confirm("Are You Sure You Want To Login This Customer?",
                        function() {
                            alertify.success('Ok');
                            console.log(id);
                            document.getElementById('cuslogoutid').value = id;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + id;
                            console.log(formData);
                            $.ajax({
                                type: "POST",
                                url: "{{ route('AccLogin') }}",
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
                        },
                        function() {
                            alertify.error('Cancel');
                        });

                }

                function viewLog(id) {
                    console.log(id);
                    $('#viewcustomerlog').DataTable({
                        order: [
                            [0, 'desc']
                        ],
                        destroy: true,
                        "ajax": {
                            "url": "{{ route('GetCustomerlog') }}?cuslogid=" + id,
                            "type": "GET"
                        },
                        "columns": [ {
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
                            {
                                "data": "log_type",
                                "render": function(data, type, row) {
                                    if (data === 1) {
                                        var log_status = row.log_status;
                                        if (log_status === 0) {
                                            return "<button class='btn btn-danger' type='button' onclick='Pending(" +
                                                row.log_id + ")'>Logout</button>";
                                        } else if (log_status === 1) {
                                            return "<button class='btn btn-warning' type='button' onclick='Pending(" +
                                                row.log_id + ")'>Confirm</button>";
                                        } else {
                                            return "Paid";
                                        }
                                    } else if (data === 0) {
                                        var log_status = row.log_status;
                                        if (log_status === 0) {
                                            return "<button class='btn btn-danger' type='button' onclick='Pending(" +
                                                row.log_id + ")'>Logout</button>";
                                        } else if (log_status === 1) {
                                            var transac = row.log_transaction;
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
                                            return "Paid";
                                        }
                                    }
                                }
                            }

                        ]
                    });
                }

                function acceptLog(id) {
                    console.log(id);

                    document.getElementById('cuslogoutid').value = id;
                    var formData = $("form#pendingLog").serialize();
                    var Dataform = formData + '&id=' + id;
                    console.log(formData);
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

                function Pending(id) {
                    console.log(id);

                    alertify.confirm("Are You Sure You Want To Logout This Customer?",
                        function() {
                            alertify.success('Ok');
                            document.getElementById('cuslogoutid').value = id;
                            var formData = $("form#pendingLog").serialize();
                            var Dataform = formData + '&id=' + id;
                            console.log(formData);
                            $.ajax({
                                type: "POST",
                                url: "{{ route('LogToPending') }}",
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
                document.addEventListener("click", function(event) {
                    const editSpans = document.querySelectorAll(".undeditSpan");

                    let clickedInsideEditSpan = false;
                    editSpans.forEach(editSpan => {
                        if (editSpan.contains(event.target)) {
                            clickedInsideEditSpan = true;
                        }
                    });

                    if (!clickedInsideEditSpan) {
                        editSpans.forEach(edit => {
                            const editId = edit.id.substring("log_comment".length);
                            document.getElementById('comment_log_id').value = editId;
                            document.getElementById('comment_log_message').value = edit.value;
                            const formData = $('form#submitComment').serialize();

                            $.ajax({
                                type: "POST",
                                url: "{{ route('SaveComment') }}",
                                data: formData,
                                success: function(response) {
                                    edit.style.border = "none";
                                },
                                error: function(xhr) {
                                    console.log(xhr.responseText);
                                }
                            });
                        });
                    }
                });

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

    </html>
@else
    @php
        echo '<script>
            window.location.href = "login";
        </script>';
    @endphp
@endif
