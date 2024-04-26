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
                    <div class="col-md-12 col-xl-4">
                        <div class="card flat-card">
                            <div class="card-header">
                                <h5>Customers</h5>
                                <div class="row-table">
                                    <div class="col-sm-6 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i><i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                                            width="24" height="24">
                                                            <path
                                                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"
                                                                fill="#405cff" />
                                                        </svg> </i>
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
                                                <span>Total</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"
                                                            fill="#405cff" />
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>
                                                @php
                                                    $newCustomer = App\Models\CustomerAcc::Where('created_at',Carbon\Carbon::now('Asia/Hong_Kong')->format('d/m/Y'))->get();
                                                    $newCustomercount = $newCustomer->count();

                                                @endphp
                                                    {{ $newCustomercount }}
                                                </h5>
                                                <span>New</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-table">
                                    <div class="col-sm-6 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M224 0a128 128 0 1 1 0 256A128 128 0 1 1 224 0zM178.3 304h91.4c20.6 0 40.4 3.5 58.8 9.9C323 331 320 349.1 320 368c0 59.5 29.5 112.1 74.8 144H29.7C13.3 512 0 498.7 0 482.3C0 383.8 79.8 304 178.3 304zM352 368a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-80c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h48c8.8 0 16-7.2 16-16s-7.2-16-16-16H512V304c0-8.8-7.2-16-16-16z"
                                                            fill="#405cff" />
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>
                                                @php
                                                    $Customerlog = App\Models\CustomerLogs::Where('log_date',Carbon\Carbon::now('Asia/Hong_Kong')->format('d/m/Y'))->get();
                                                    $Customerlogcount = $Customerlog->count();

                                                    $unCustomerlog = App\Models\CustomerLogUnregister::Where('un_log_date',Carbon\Carbon::now('Asia/Hong_Kong')->format('d/m/Y'))->get();
                                                    $unCustomerlogcount = $unCustomerlog->count();

                                                    $logTotal = $Customerlogcount + $unCustomerlogcount;
                                                @endphp
                                                    {{ $logTotal }}
                                                </h5>
                                                <span>Daily</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M309 106c11.4-7 19-19.7 19-34c0-22.1-17.9-40-40-40s-40 17.9-40 40c0 14.4 7.6 27 19 34L209.7 220.6c-9.1 18.2-32.7 23.4-48.6 10.7L72 160c5-6.7 8-15 8-24c0-22.1-17.9-40-40-40S0 113.9 0 136s17.9 40 40 40c.2 0 .5 0 .7 0L86.4 427.4c5.5 30.4 32 52.6 63 52.6H426.6c30.9 0 57.4-22.1 63-52.6L535.3 176c.2 0 .5 0 .7 0c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40c0 9 3 17.3 8 24l-89.1 71.3c-15.9 12.7-39.5 7.5-48.6-10.7L309 106z"
                                                            fill="#405cff" />
                                                    </svg>
                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>
                                                    
                                                </h5>
                                                <span>Repeat</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- widget primary card start -->

                        <!-- widget primary card end -->
                    </div>
                    <!-- table card-1 end -->
                    <!-- table card-2 start -->
                    {{-- <div class="col-md-12 col-xl-4">
                        <div class="card flat-card">
                            <div class="card-header">
                                <h5>Reservation</h5>
                                <div class="row-table">
                                    <div class="col-sm-6 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM96 75V64H288V75c0 19-5.6 37.4-16 53H112c-10.3-15.6-16-34-16-53zm16 309c3.5-5.3 7.6-10.3 12.1-14.9L192 301.3l67.9 67.9c4.6 4.6 8.6 9.6 12.1 14.9H112z"
                                                            fill="#007f8c" />
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>1000</h5>
                                                <span>Pending</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z"
                                                            fill="#007f8c" />
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>600</h5>
                                                <span>Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-table">
                                    <div class="col-sm-6 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M0 96C0 60.7 28.7 32 64 32H512c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM128 288a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm32-128a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM128 384a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm96-248c-13.3 0-24 10.7-24 24s10.7 24 24 24H448c13.3 0 24-10.7 24-24s-10.7-24-24-24H224zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H448c13.3 0 24-10.7 24-24s-10.7-24-24-24H224zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H448c13.3 0 24-10.7 24-24s-10.7-24-24-24H224z"
                                                            fill="#007f8c" />
                                                    </svg>


                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>3550</h5>
                                                <span>Completed</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"
                                                            fill="#007f8c" />
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>100%</h5>
                                                <span>Cancelled</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- widget-success-card start -->

                        <!-- widget-success-card end -->
                    </div> --}}
                    <!-- table card-2 end -->
                    <!-- Widget primary-success card start -->
                    {{-- <div class="col-md-12 col-xl-4">
                        <div class="card flat-card">
                            <div class="card-header">
                                <h5>Subscription</h5>
                                <div class="row-table">
                                    <div class="col-sm-6 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M0 24C0 10.7 10.7 0 24 0H360c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V67c0 40.3-16 79-44.5 107.5L225.9 256l81.5 81.5C336 366 352 404.7 352 445v19h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8V445c0-40.3 16-79 44.5-107.5L158.1 256 76.5 174.5C48 146 32 107.3 32 67V48H24C10.7 48 0 37.3 0 24zM110.5 371.5c-3.9 3.9-7.5 8.1-10.7 12.5H284.2c-3.2-4.4-6.8-8.6-10.7-12.5L192 289.9l-81.5 81.5zM284.2 128C297 110.4 304 89 304 67V48H80V67c0 22.1 7 43.4 19.8 61H284.2z"
                                                            fill="#9540ff" />
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>1000</h5>
                                                <span>Pending</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z"
                                                            fill="#9540ff" />
                                                    </svg>

                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>600</h5>
                                                <span>Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-table">
                                    <div class="col-sm-6 card-body br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"
                                                            fill="#9540ff" />
                                                    </svg>


                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>3550</h5>
                                                <span>Expired</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        width="24" height="24">
                                                        <path
                                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"
                                                            fill="#9540ff" />
                                                    </svg>
                                                </i>
                                            </div>
                                            <div class="col-sm-8 text-md-center">
                                                <h5>100%</h5>
                                                <span>Cancelled</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Widget primary-success card end -->

                    <!-- prject ,team member start -->

                    <!-- [ variant-chart ] start -->

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>Customer Tracking</h5>
                            </div>
                            <div class="card-body">
                                <div id="line-chart-1"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Latest Customers end -->
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

        <script src="assets/js/vendor-all.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>
        <script src="assets/js/pcoded.min.js"></script>

        <script src="assets/js/plugins/apexcharts.min.js"></script>
        <script src="assets/js/pages/chart-apex.js"></script>

    </body>

    </html>
@else
    @php
        echo '<script>
            window.location.href = "admin/login";
        </script>';
    @endphp
@endif
