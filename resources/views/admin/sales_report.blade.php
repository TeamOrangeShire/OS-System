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
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" style="text-align:right">Total:</th>
                                                <th></th>
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
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:right">Total:</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
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
                    destroy: true,
                    ajax: {
                        url: "{{ route('CustomerLog') }}",
                        type: "GET",
                        dataType: "json",
                        dataSrc: "logsByDate"
                    },
                    columns: [{
                            data: "log_date",
                            render: function(data, type, row) {
                                return data;
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
                            '₱' + pageTotal + ' ( ₱' + total + ' total)';
                    }
                });
            }


            function viewLog(date) {
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
                        "dataType": "json",
                        "dataSrc": "reg"
                    },
                    "columns": [{
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
                            "data": "log_transaction",
                            "render": function(data, type, row) {
                                var transactionParts = data.split('-');
                                var final = transactionParts[0];
                                return final;
                            }
                        },
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api();
                        var total = api
                            .column(3) // Assuming 'log_transaction' is the 4th column (0-indexed)
                            .data()
                            .reduce(function(acc, curr) {
                                return parseFloat(curr) + acc;
                            }, 0);
                        $(api.column(3).footer()).html(total); // Update the footer cell with the total
                    }
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
