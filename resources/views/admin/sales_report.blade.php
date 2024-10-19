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
                                <div class="row">
                                    <div class="col-4">
                                        <button onclick="viewLogDaily('all', this)" class="btn btn-dark w-100 selectDailyLog">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                          </svg> All </button>
                                   </div>
                                    <div class="col-4">
                                         <button onclick="viewLogDaily('cash', this)" class="btn btn-outline-dark w-100 selectDailyLog">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                                            <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                            <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z"/>
                                          </svg> Cash</button>
                                    </div>
                                    <div class="col-4">
                                        <button  onclick="viewLogDaily('gcash', this)" class="btn btn-outline-dark w-100 selectDailyLog"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
                                            <path d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.35.35 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91q.57-.403.993-1.005a4.94 4.94 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.7 2.7 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.7.7 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016q.326.186.548.438c.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.87.87 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.35.35 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32z"/>
                                          </svg> GCash</button>
                                    </div>
                                </div>
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
            let selectedDailyDate;

            function viewLogDaily(filter, element){
                const btn = document.querySelectorAll('.selectDailyLog');

                btn.forEach(b=> {

                    b.className = '';
                    b.classList.add('btn', 'btn-outline-dark', 'w-100', 'selectDailyLog');
                })

                element.className = '';
                element.classList.add('btn', 'btn-dark', 'w-100', 'selectDailyLog');

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
                        "url": "{{ route('ViewDetails') }}?date=" + selectedDailyDate + "&filter=" + filter,
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
                            'Date: ' + selectedDailyDate;
                    }
                });
            }

            function viewLog(date) {
                selectedDailyDate = date;
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
                        "url": "{{ route('ViewDetails') }}?date=" + date + "&filter=all",
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
