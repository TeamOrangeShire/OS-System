<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>{{ $title }}</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="{{ asset('img/os_logo.png') }}" rel="icon">
<link href="{{ asset('img/os_logo.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('customer_dashboards/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('customer_dashboards/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('customer_dashboards/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('customer_dashboards/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('customer_dashboards/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset('customer_dashboards/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('customer_dashboards/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('customer_dashboards/css/mycustom.css') }}" rel="stylesheet">
<link href="{{ asset('customer_dashboards/css/loader.css') }}" rel="stylesheet">

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--fontawsome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

<!--Alertify-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>

<!--QR Code Library-->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<!--Axios-->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!--Datatable-->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
@if ($status === 'not_verified')
@php
    $checkStat = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
@endphp
    <script>
        window.onload = function(){
            window.location.href = "{{ route('new_account') }}?id={{ $checkStat->session_id }}&redirect=true";
        }
    </script>
@endif

@if ($status === 'not_log_in')
@php
    $checkStat = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
@endphp
    <script>
        window.onload = function(){
            window.location.href = "{{ route('home') }}";
        }
    </script>
    @php
        die();
    @endphp
@endif

