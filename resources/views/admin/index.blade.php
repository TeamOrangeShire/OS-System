@if (session()->has('Admin_id'))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header', ['title' => 'Admin Home'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

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
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Dashboard Analytics</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i
                                                class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- table card-1 start -->
                    <div class="col-md-12 col-xl-12">
                        <div class="card flat-card">
                            <div class="card-header">
                                {{-- <h5>Customers</h5> --}}
                                <div class="row-table">
                                    <div class="col-sm-2 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="#E76F51"
                                                        stroke="#222831 " stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-users">
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="9" cy="7" r="4"></circle>
                                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>
                                                    @php
                                                        $CustomerAcc = App\Models\CustomerAcc::all();
                                                        $count = $CustomerAcc->count();
                                                    @endphp
                                                    {{ $count }}
                                                </h5>
                                                <span>Customers</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="#FF6969"
                                                        stroke="#222831" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-activity">
                                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                                    </svg>
                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>

                                                    @php
                                                        $newCustomer = App\Models\CustomerLogs::where(
                                                            'log_status',
                                                            0,
                                                        )->get();
                                                        $newCustomercount = $newCustomer->count();
                                                    @endphp
                                                    {{ $newCustomercount }}

                                                </h5>
                                                <span>logged in</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="#1679AB"
                                                        stroke="#222831" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-award">
                                                        <circle cx="12" cy="8" r="7"></circle>
                                                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88">
                                                        </polyline>
                                                    </svg>
                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>
                                                    @php
                                                        $countReg = App\Models\CustomerAcc::where(
                                                            'customer_type',
                                                            '!=',
                                                            'Student',
                                                        )->get();
                                                        $logTotal = $countReg->count();
                                                    @endphp
                                                    {{ $logTotal }}
                                                </h5>
                                                <span>regular</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="#379777"
                                                        stroke="#222831" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-book-open">
                                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>
                                                    @php
                                                        $countStud = App\Models\CustomerAcc::where(
                                                            'customer_type',
                                                            'Student',
                                                        )->get();
                                                        $logTotalS = $countStud->count();
                                                    @endphp
                                                    {{ $logTotalS }}
                                                </h5>
                                                <span>students</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- widget primary card start -->

                        <!-- widget primary card end -->
                    </div>
                    <!-- Widget primary-success card end -->

                    <!-- prject ,team member start -->

                    <!-- [ variant-chart ] start -->

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Customer Log Tracking</h5>
                            </div>
                            <div class="card-body">
                                <label for="year">Select Year:</label>
                                <input type="text" id="yearPicker" onchange="GetLogByMonth()">
                                <canvas id="myLineChart" class="col-12"></canvas>


                            </div>
                        </div>
                    </div>
                    <!-- Latest Customers end -->


                    <div class="w-100 border p-4 rounded">
                        <h2 class="text-primary mb-4">Sales Report</h2>

                        <div class="d-flex w-100 gap-2">
                            <div class="w-50 border p-2 rounded">
                                <h5 class="text-success">Hybrid Pros</h5>

                                <table class="table table-success table-striped table-hover">
                                    <thead>
                                        <th>Month</th>
                                        <th>Total Amount</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>8934</td>
                                            <td>oauishdrias</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-50 border p-2 rounded">
                                <h5 class="text-success">Hotdesk</h5>
                                <table class="table table-success table-striped table-hover">
                                    <thead>
                                        <th>Month</th>
                                        <th>Total Amount</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>8934</td>
                                            <td>oauishdrias</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
        <!-- [ Main Content ] end -->
        <!-- Warning Section start -->
        <!-- Older IE warning message -->
        <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
        <!-- Warning Section Ends -->

        <!-- Required Js -->
        {{-- <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('assets/js/pages/dashboard-main.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

        <script src="assets/js/vendor-all.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>
        <script src="assets/js/pcoded.min.js"></script>

        <script src="assets/js/plugins/apexcharts.min.js"></script>
        <script src="assets/js/pages/chart-apex.js"></script>

        <script>
            $(document).ready(function() {
                GetLogByMonth();
            });
            flatpickr("#yearPicker", {
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true, // Display only the year
                        dateFormat: "Y", // Only show the year in the input
                        altFormat: "Y", // Alternative format for display
                        theme: "material"
                    })
                ],
                allowInput: true
            });
            const currentYear = new Date().getFullYear();
            document.getElementById('yearPicker').value = currentYear;
            let myLineChart;
            function GetLogByMonth() {
                $.ajax({
                    url: "{{ route('GetLogByMonth') }}" + "?year=" + document.getElementById('yearPicker').value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        
                        if (response && response.data) {

                            const inputData = response.data.map(log => ({
                                month: log.month,
                                count: log.count
                            }));


                            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                                'August', 'September', 'October', 'November', 'December'
                            ];
                            const labels = monthNames.slice(0, 12);
                            const data = new Array(12).fill(0);
                            inputData.forEach(item => {
                                const monthIndex = item.month - 1;
                                if (monthIndex >= 0 && monthIndex < 12) {
                                    data[monthIndex] = item.count;
                                }
                            });
                            const options = {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'Yearly Line Chart'
                                    }
                                }
                            };

                            if(myLineChart){
                                myLineChart.destroy();
                            }
                            
                            const ctx = document.getElementById('myLineChart').getContext('2d');
                             myLineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Customers',
                                        borderColor: 'rgb(75, 192, 192)',
                                        data: data,
                                        fill: false
                                    }]
                                },
                                options: options
                            });

                        } else {
                            console.log('No data returned or empty data array');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', xhr.responseText);
                    }
                });
            }
        </script>

    </body>

    </html>
@else
    @php
        echo '<script>
            window.location.href = "admin/login";
        </script>';
    @endphp
@endif
