<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan Qr Code</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

</head>
<body style="background: rgb(250, 185, 114)">
    <form id="QRData">
        @csrf
        <input type="hidden" name="cust_id" value="{{ $user_id }}">
        <input type="hidden" name="QRCode" id="code">
    </form>
    <div style="width:100%; display:flex; align-items:center; justify-content:center; text-align:center">
        <img src="{{ asset('img/Scanner.png') }}" style="width:40%" alt="">
    </div>
    <div id="qrScanner" style="display: none;"></div>
    <p style="text-align: center;">Scan any QR-Code Related to Orange Shire</p>
    <script>
    window.onload = function (){
    DetectScreenSize("{{ route('home') }}", "{{ route('updateQRLog') }}", "{{ route('logintoshire') }}" );
    }
    </script>
    <script src="{{ asset('js/QRScan.js') }}"></script>
</body>
</html>