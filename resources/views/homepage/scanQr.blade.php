<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan Qr Code</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

</head>
<body style="background-image: url('{{ asset('assets/images/auth/img-auth-big.jpg') }}');
 background-size: fill; 

 ">
    <div id="qrScanner" style="display: none;"></div>

    <script>
window.onload = function (){
    DetectScreenSize("{{ route('home') }}");
}
    </script>
    <script src="{{ asset('js/QRScan.js') }}"></script>
</body>
</html>