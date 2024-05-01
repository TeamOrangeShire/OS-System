@if (session()->has('Admin_id'))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header')

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
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Salas Report</h5>
                                <div class="col-md-12">
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
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <table id="detailsalesreport" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Log Start</th>
                                            <th>Log End</th>
                                            <th>Total Time</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>


                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                getsalereport();
            });

            function getsalereport() {
                $('#salesreport').DataTable({
                    layout: {
        topStart: {
            buttons: [
                {
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
                        columns: [0, 1, 2, 5]
                    }
                },
                'colvis'
            ]
        }
    },
                    destroy: true,
                    "ajax": {
                        "url": "{{ route('CustomerLog') }}",
                        "type": "GET",
                        "dataType": "json", // Ensure the response is parsed as JSON
                        "dataSrc": "logsByDate" // Specify the key containing the data in the JSON response
                    },
                    "columns": [{
                            "data": "log_date", // Map date data from JSON response
                            "render": function(data, type, row) {
                                // Use row.logs to access logs for the current date
                                return data; // Display number of logs
                            }
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                // Use row.logs to access logs for the current date
                                return row.logs.length; // Display number of logs
                            }
                        },
                        {
                            "data": "total_log_transactions", // Map total_log_transactions from JSON response
                        },
                        {
                            "data": "log_date", // Map date data from JSON response
                            "render": function(data, type, row) {
                                // Render a button to view log
                                return "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewcuslog' type='button' onclick='viewLog(\"" +
                                    data + "\")'>View Log</button>";
                            }
                        },

                    ]
                });
            }

            function viewLog(date) {
                console.log(date);
                $('#detailsalesreport').DataTable({
                    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    },
                    destroy: true,
                    "ajax": {
                        "url": "{{ route('ViewDetails') }}?date=" + date,
                        "type": "GET",
                        "dataType": "json", // Ensure the response is parsed as JSON
                        "dataSrc": "reg" // Specify the key containing the data in the JSON response
                    },
                    "columns": [{
                            "data": "log_start_time", // Map date data from JSON response
                            "render": function(data, type, row) {
                                // Use row.logs to access logs for the current date
                                return data; // Display number of logs
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

                                var startTimeParts = row.log_start_time.split(":");
                                var startHours = parseInt(startTimeParts[0]);
                                var startMinutes = parseInt(startTimeParts[1].split(" ")[0]);
                                var startAmPm = startTimeParts[1].split(" ")[1];
                                if (startAmPm === "PM" && startHours !== 12) {
                                    startHours += 12;
                                }
                                var endTimeParts = row.log_end_time.split(":");
                                var endHours = parseInt(endTimeParts[0]);
                                var endMinutes = parseInt(endTimeParts[1].split(" ")[0]);
                                var endAmPm = endTimeParts[1].split(" ")[1];
                                if (endAmPm === "PM" && endHours !== 12) {
                                    endHours += 12;
                                }
                                if (endHours < startHours || (endHours === startHours && endMinutes <
                                        startMinutes)) {
                                    endHours += 24;
                                }
                                var startTimeInMinutes = startHours * 60 + startMinutes;
                                var endTimeInMinutes = endHours * 60 + endMinutes;
                                var timeDifferenceInMinutes = endTimeInMinutes - startTimeInMinutes;
                                var hours = Math.floor(timeDifferenceInMinutes / 60);
                                var minutes = timeDifferenceInMinutes % 60;
                                var duration = hours + ":" + minutes;

                                return duration;
                            }
                        }


                        ,
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                var payment = row.log_transaction;
                                var payment2 = parseFloat(payment).toFixed(2);
                                return payment2;
                            }
                        },
                        // Map other columns as needed
                    ]
                });
            }
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
