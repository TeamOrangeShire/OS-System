<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orange Shire - Success</title>
    <link rel="icon" href="img/os_logo.png">
    <link rel="stylesheet" href="css/finish.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(window).on("load",function(){
            setTimeout(function() {
                $('.done').addClass("drawn");
            }, 500);
        });
    </script>
</head>
<body>
    @php
        $newAcc = App\Models\CustomerAcc::where('customer_id', $id)->first();

        $fullname = $newAcc->customer_firstname. " ". $newAcc->customer_middlename[0]. ". ". $newAcc->customer_lastname;
    @endphp
    <div class="contain">
        <div class="congrats">
            <h1>Account Created!</h1>
            <div class="done">
                <svg version="1.1" id="tick" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 37 37" style="enable-background:new 0 0 37 37;" xml:space="preserve">
                    <path class="circ path" style="fill:#ff8c49;stroke:#ff5c49;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;" d="
                        M30.5,6.5L30.5,6.5c6.6,6.6,6.6,17.4,0,24l0,0c-6.6,6.6-17.4,6.6-24,0l0,0c-6.6-6.6-6.6-17.4,0-24l0,0C13.1-0.2,23.9-0.2,30.5,6.5z"
                    />
                    <polyline class="tick path" style="fill:none;stroke:#fff;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;" points="
                        11.6,20 15.9,24.2 26.4,13.8 "/>
                </svg>
            </div>
            <div class="text">
                <p>{{ $fullname }}</p>
                <p>{{ $newAcc->customer_email }}</p>
                
                <button onclick="goto()">
                    <span>Go to login</span>
                  </button>
            </div>
          <script>
            function goto(){
                window.location.href = {{ route('customer-login') }};
            }
          </script>
        </div>
    </div> 
</body>
</html>
