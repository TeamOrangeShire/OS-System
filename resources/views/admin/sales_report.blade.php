@if (session()->has('Admin_id'))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header',['title'=>'Sales Report'])

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
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ Main Content start ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Sales report</h5>

                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active text-uppercase" id="profile-tab" data-toggle="tab"
                                        href="#profile" role="tab" aria-controls="profile"
                                        aria-selected="false">General Report</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  text-uppercase" id="home-tab" data-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Daily Report</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  text-uppercase" id="" data-toggle="tab" href="#weekly"
                                        role="tab" aria-controls="home" aria-selected="true">Weekly/Monthly Report</a>
                                </li>
                              
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">

                                    {{-- content --}}



                                    <!-- Table with stripped rows -->
                                    <table id="salesreport" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Log</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" style="text-align:right">Total:</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
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
                                                <table id="generalhistory" class="table table-striped"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Number</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                            <th>Total Time</th>
                                                            <th>Method</th>
                                                            <th>Comment</th>
                                                            <th>Payment</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="9" style="text-align:right">Total:</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                            </div>
                                        </div>
                                    </section>
                                    </p>
                                </div>

                                <div class="tab-pane fade " id="weekly" role="tabpanel" aria-labelledby="">
                                    <div class="col-12 d-flex justify-content-center gap-2 align-items-center">
                                        <div class="col-6 d-flex justify-content-center">
                                            <button id="filterCashButton" class="btn btn-success">Show Cash Payments</button>
                                        </div>
                                        <div class="col-6 d-flex justify-content-center">
                                            <button id="filterE-PayButton" class="btn btn-primary">Show GCash Payments</button>
                                        </div>
                                    </div>
                                    <form action="" id="filter">@csrf
                                        <div class="form-row mb-2 col-12">
                                            <div class="col">
                                                <label for="startdate">Start Date</label>
                                                <input type="month" class="form-control" id="startdate"
                                                    name="startdate">
                                            </div>
                                            <div class="col">
                                                <label for="end">End Date</label>
                                                <div class="input-group">
                                                    <input type="month" class="form-control" id="enddate"
                                                        name="enddate">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                            onclick="filterdate()">Filter Date</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                             <label for="">Filter Report By Time Period</label>
                                            <select class="form-control" name="" id="monthSelector" onchange="calculateDate()">
                                                <option value="">Please Select Date Range</option>
                                                <option value="0">Current Month</option>
                                                <option value="1">From 1 month ago</option>
                                                <option value="2">From 2 months ago</option>
                                                <option value="3">From 3 months ago</option>
                                                <option value="4">From 4 months ago</option>
                                                <option value="5">From 5 months ago</option>
                                                <option value="6">From 6 months ago</option>
                                                <option value="7">From 7 months ago</option>
                                                <option value="8">From 8 months ago</option>
                                                <option value="9">From 9 months ago</option>
                                                <option value="10">From 10 months ago</option>
                                                <option value="11">From 11 months ago</option>
                                                <option value="12">From 12 months ago</option>
                                            </select>
                                        </div>
                                        <br>
                                    </form>
                                    <table id="weeklyreport" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Number</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Total Time</th>
                                                <th>Method</th>
                                                <th>Comment</th>
                                                <th>Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="8" style="text-align:right;"></th>
                                                {{-- <th style="color:#3572EF;"></th>
                                                <th style="color: #ff5c40;"></th> --}}
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal with data table --}}
                <div class="modal" id="viewcuslog">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"> View Details </h4>

                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <table id="detailsalesreport" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Log Start</th>
                                            <th>Log End</th>
                                            <th>Total Time</th>
                                            <th>Method</th>
                                            <th>Comment</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" style="text-align:right">Total:</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- Modal with data table --}}

                <!-- [ Main Content ] end -->
            </div>
        </div>
        <!-- [ Main Content ] end -->

        @include('admin.assets.adminscript')

        <!-- Required Js -->
        <script>
          

            $(document).ready(function() {
                CustomerlogHistory();
                getsalereport();

            });


            function CustomerlogHistory() {
                $('#generalhistory').DataTable({
                    scrollY: '400px',
                    scrollCollapse: true,
                    paging: false,
                     scrollX: true,
                    order: [
                        [10, 'desc']
                    ],
                      columnDefs: [{
                          target: 10,
                                visible: false,
                               searchable: false
                      }],
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
                                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                'colvis'
                            ]
                        }
                    },
                    "destroy": "true",
                    "ajax": {
                        "url": "{{ route('GeneralReport') }}",
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
                            "data": null,
                            "render": function(data, type, row) {
                                var first = row.firstname;
                                var last = row.lastname;
                                return first + " " + last;
                            }
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "contact"
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
                            'data': 'log_payment_method'
                        },
                        {
                            "data": "log_comment",
                            "render": function(data, type, row) {

                                return data;
                            }
                        },
                        {
                            "data": "payment",
                            "render": function(data, type, row) {

                                return data;
                            }
                        },
                        {
                            "data":"created_at"
                        }

                    ],
                    footerCallback: function(row, data, start, end, display) {
                        let api = this.api();

                        // Remove the formatting to get integer data for summation
                        let intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i :
                                0;
                        };

                        // Total over all pages
                        total = api
                            .column(9)
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Total over this page
                        pageTotal = api
                            .column(9, {
                                page: 'current'
                            })
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Update footer
                        api.column(9).footer().innerHTML =
                            '₱' + pageTotal.toFixed(2);
                    }
                });
            }


            function getsalereport() {
                $('#salesreport').DataTable({
                    scrollY: '400px',
                    scrollCollapse: true,
                    paging: false,
                    order: [
                        [0, 'desc']
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
                                        columns: [0, 1, 2]
                                    }
                                },
                                'colvis'
                            ]
                        }
                    },
                    "destroy": "true",
                    ajax: {
                        url: "{{ route('CustomerLog') }}",
                        type: "GET",
                        dataType: "json",
                        dataSrc: "logsByDate"
                    },
                    columns: [ {
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
                            data: null,
                            render: function(data, type, row) {
                                return row.logs.length;
                            }
                        },
                        {
                            data: "total_log_transactions",
                        },
                        {
                            data: "log_date",
                            render: function(data, type, row) {
                                // Render a button to view log
                                return "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewcuslog' type='button' onclick='viewLog(\"" +
                                    data + "\")'>View Log</button>";
                            }
                        },
                    ],
                    footerCallback: function(row, data, start, end, display) {
                        let api = this.api();

                        // Remove the formatting to get integer data for summation
                        let intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i :
                                0;
                        };

                        // Total over all pages
                        total = api
                            .column(2)
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Total over this page
                        pageTotal = api
                            .column(2, {
                                page: 'current'
                            })
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Update footer
                        api.column(2).footer().innerHTML =
                            'Total: ₱' + pageTotal.toFixed(2);
                    }
                });
            }


            function viewLog(date) {
                $('#detailsalesreport').DataTable({
                    scrollY: '350px',
                    scrollCollapse: true,
                    paging: false,
                     scrollX: true,
                    order: [
                        [1, 'desc']
                    ],
                    layout: {
                        topStart: {
                            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                        }
                    },
                    destroy: true,
                    "ajax": {
                        "url": "{{ route('ViewDetails') }}?date=" + date,
                        "type": "GET",
                        "dataType": "json",
                        "dataSrc": "reg"
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row) {
                                var first = row.firstname;
                                var last = row.lastname;
                                return first + " " + last;
                            }
                        },
                        {
                            "data": "log_start_time",
                            "render": function(data, type, row) {
                                return data;
                            }
                        },
                        {
                            "data": "log_end_time",
                            "render": function(data, type, row) {
                                return data;
                            }
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                var start = row.log_start_time;
                                var end = row.log_end_time;
                                var totaltime = timeDifference(start, end);
                                return totaltime.hours + ":" + totaltime.minutes;
                            }
                        },
                        {
                            'data': 'log_payment_method'
                        },
                        {
                            'data': 'log_comment'
                        },
                        {
                            "data": "payment"
                        },
                    ],
                    footerCallback: function(row, data, start, end, display) {
                        let api = this.api();

                        // Remove the formatting to get integer data for summation
                        let intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i :
                                0;
                        };

                        // Total over all pages
                        total = api
                            .column(6)
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Total over this page
                        pageTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Update footer
                        api.column(6).footer().innerHTML =
                            ' Total: ₱' + pageTotal.toFixed(2);
                        api.column(5).footer().innerHTML =
                            'Date: ' + date;
                    }
                });
            }

function calculateDate() {
            // Get the current date
            const currentDate = new Date();

            // Get the selected value from the dropdown
            const monthSelector = document.getElementById("monthSelector");
            const selectedMonths = parseInt(monthSelector.value);

            // Subtract the selected number of months
            const pastDate = new Date(currentDate);
            pastDate.setMonth(pastDate.getMonth() - selectedMonths);

            // Get the year and month in "YYYY-MM" format for both current and past dates
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                return `${year}-${month}`;
            };

            const formattedCurrentDate = formatDate(currentDate);
            const formattedPastDate = formatDate(pastDate);


            $('#weeklyreport').DataTable({
                    scrollY: '400px',
                    scrollCollapse: true,
                    paging: false,
                     scrollX: true,
                    order: [
                        [10, 'desc']
                    ],
                      columnDefs: [{
                          target: 10,
                                visible: false,
                               searchable: false
                      }],
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
                                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                'colvis'
                            ]
                        }
                    },
                    "destroy": "true",
                    "ajax": {
                        "url": "{{ route('GetWeeklyReport') }}?startdate=" + formattedPastDate + "&enddate=" +
                        formattedCurrentDate,
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
                            "data": null,
                            "render": function(data, type, row) {
                                var first = row.firstname;
                                var last = row.lastname==null?'':row.lastname;
                                return first + " " + last;
                            }
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "contact"
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
                            'data': 'log_payment_method'
                        },
                        {
                            "data": "log_comment",
                            "render": function(data, type, row) {

                                return data;
                            }
                        },
                        {
                            "data": "payment",
                            "render": function(data, type, row) {

                                return data;
                            }
                        },
                        {
                            "data":"created_at"
                        }

                    ],
                   "footerCallback": function(row, data, start, end, display) {
            let api = this.api();

            // Remove the formatting to get integer data for summation
            let intVal = function(i) {
                return typeof i === 'string' ?
                    parseFloat(i.replace(/[^\d.-]/g, '')) || 0 :
                    typeof i === 'number' ?
                    i :
                    0;
            };

            // Total over current page where column 7 equals "E-Pay"
            let total = api
                .column(9, { page: 'current' })
                .data()
                .filter((value, index) => api.column(7, { page: 'current' }).data()[index] === 'E-Pay')
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            // Total over current page where column 7 equals "Cash"
            let cashtotal = api
                .column(9, { page: 'current' })
                .data()
                .filter((value, index) => api.column(7, { page: 'current' }).data()[index] === 'Cash')
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            // Total over this page
            let pageTotal = api
                .column(9, { page: 'current' })
                .data()
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            // Update footer
            // api.column(7).footer().innerHTML =  'Total: ₱' + pageTotal +' E-Pay: ₱' + total +' Cash: ₱' + cashtotal;
            // api.column(8).footer().innerHTML = '<span style="color:red;">'+ cashtotal +'</span>';
            api.column(7).footer().innerHTML = '<span style="color:green; margin-right:2%;">Cash: ₱'+ cashtotal.toFixed(2) +'</span><span style="color:#3572EF;margin-right:2%;"> Gcash: ₱'+ total.toFixed(2) +'</span><span style="color:#ff5c40;margin-right:2%;"> Total: ₱'+ pageTotal.toFixed(2) +'</span>';
        }

                });
        }

            function filterdate() {
                var startDate = document.getElementById('startdate').value;
                var endDate = document.getElementById('enddate').value;

                $('#weeklyreport').DataTable({
                    scrollY: '400px',
                    scrollCollapse: true,
                    paging: false,
                     scrollX: true,
                    order: [
                        [10, 'desc']
                    ],
                      columnDefs: [{
                          target: 10,
                                visible: false,
                               searchable: false
                      }],
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
                                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                'colvis'
                            ]
                        }
                    },
                    "destroy": "true",
                    "ajax": {
                        "url": "{{ route('GetWeeklyReport') }}?startdate=" + startDate + "&enddate=" +
                        endDate,
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
                            "data": null,
                            "render": function(data, type, row) {
                                var first = row.firstname;
                                var last = row.lastname==null?'':row.lastname;
                                return first + " " + last;
                            }
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "contact"
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
                            'data': 'log_payment_method'
                        },
                        {
                            "data": "log_comment",
                            "render": function(data, type, row) {

                                return data;
                            }
                        },
                        {
                            "data": "payment",
                            "render": function(data, type, row) {

                                return data;
                            }
                        },
                        {
                            "data":"created_at"
                        }

                    ],
                   "footerCallback": function(row, data, start, end, display) {
            let api = this.api();

            // Remove the formatting to get integer data for summation
            let intVal = function(i) {
                return typeof i === 'string' ?
                    parseFloat(i.replace(/[^\d.-]/g, '')) || 0 :
                    typeof i === 'number' ?
                    i :
                    0;
            };

            // Total over current page where column 7 equals "E-Pay"
            let total = api
                .column(9, { page: 'current' })
                .data()
                .filter((value, index) => api.column(7, { page: 'current' }).data()[index] === 'E-Pay')
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            // Total over current page where column 7 equals "Cash"
            let cashtotal = api
                .column(9, { page: 'current' })
                .data()
                .filter((value, index) => api.column(7, { page: 'current' }).data()[index] === 'Cash')
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            // Total over this page
            let pageTotal = api
                .column(9, { page: 'current' })
                .data()
                .reduce((a, b) => intVal(a) + intVal(b), 0);

            // Update footer
            // api.column(7).footer().innerHTML =  'Total: ₱' + pageTotal +' E-Pay: ₱' + total +' Cash: ₱' + cashtotal;
            // api.column(8).footer().innerHTML = '<span style="color:red;">'+ cashtotal +'</span>';
            api.column(7).footer().innerHTML = '<span style="color:green; margin-right:2%;">Cash: ₱'+ cashtotal.toFixed(2) +'</span><span style="color:#3572EF;margin-right:2%;"> Gcash: ₱'+ total.toFixed(2) +'</span><span style="color:#ff5c40;margin-right:2%;"> Total: ₱'+ pageTotal.toFixed(2) +'</span>';
        }

                });
            }
        $('#filterCashButton').click(function() {
    var table = $('#weeklyreport').DataTable();
    table.column(7).search('^Cash$', true, false).draw(); // Filter for "Cash" in column 7
});    
        $('#filterE-PayButton').click(function() {
    var table = $('#weeklyreport').DataTable();
    table.column(7).search('^E-Pay$', true, false).draw(); // Filter for "Cash" in column 7
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
