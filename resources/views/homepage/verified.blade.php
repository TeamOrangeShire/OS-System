
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orange Shire - Success</title>
    <link rel="icon" href="{{ asset('img/os_logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/finish.css') }}">
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
  
  
    <form id="verify-account">
        @csrf
        <input type="hidden" name="cust_id" value="{{ session('id') }}">
    </form>
    <div class="contain">
        <div class="congrats">
            @if(empty(session('status')))
            <script>
                window.onload = function(){
                    window.location.href = "{{ route('signup') }}";
                }
            </script>
            @else 
            @php
            $newAcc = App\Models\CustomerAcc::where('customer_id', session('id'))->first();
    
            $fullname = $newAcc->customer_firstname. " ". $newAcc->customer_middlename[0]. ". ". $newAcc->customer_lastname;
            @endphp
           @endif
           <h1>Account Verified Successfully!</h1>
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
                @if(empty(session('status')))
                <script>
                    window.onload = function(){
                        window.location.href = "{{ route('signup') }}";
                    }
                </script>
                @else 
                <p>{{ $fullname }}</p>
                <p>{{ $newAcc->customer_email }}</p>
               @endif
               
                <button onclick="goHome('{{ route('home') }}')">
                    <span>Go Home</span>
                  </button>
              
                  <p>
                  Account Email has been successfully verified your gmail will be used as your contact information while using the orange shire app  thank you for trusting us.</p>
            </div>
      
        </div> 
    </div> 
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
