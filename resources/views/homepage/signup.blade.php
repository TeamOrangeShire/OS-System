<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Orange Shire - Sign up </title>
      <link rel="icon" href="img/os_logo.png">
      <link rel="stylesheet" href="css/login.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
   </head>
  
   <body>
    
    <div class="loadingDiv" id="loadingDiv">
      <div class="typewriter">
        <div class="slide"><i></i></div>
        <div class="paper"></div>
        <div class="keyboard"></div>
        <br>
        <p style="text-align: center; color:white">Just a moment....</p>
    </div>
     </div>
  
    <div class="form-container" id="form-account" >
        <p class="title">Create account</p>

        <form class="form" method="post" id="account_info">
          @csrf
          <input type="text" name="fname" oninput="restrictToText(event)" class="input" placeholder="First Name">
          <input type="text" name="mname" oninput="restrictToText(event)" class="input" placeholder="Middle Name">
          <input type="text" name="lname" oninput="restrictToText(event)" class="input" placeholder="Last Name">
          <select name="extension" class="input">
              <option selected value="none" >None</option>
              <option value="Jr." >Junior(Jr.)</option>
              <option value="Sr." >Senior(Sr.)</option>
              <option value="I" >I</option>
              <option value="II" >II</option>
              <option value="III" >III</option>
              <option value="IV" >IV</option>
              <option value="V" >V</option>
          </select>
          <input type="email" name="email" class="input" id="email" placeholder="Email">
          <input type="password" name="password"   class="input" placeholder="Password">
          <button type="button" onclick="CreateAccount('{{route('customer_create_account')}}' , '{{ route('new_account') }}')" id="create-acc-button" class="form-btn">Create account</button>
          {{-- <button id="google-btn" type="button" class="google-login-button">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" class="google-icon" viewBox="0 0 48 48" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
              <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
      c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
      c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
              <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
      C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
              <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
      c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
              <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
      c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
            </svg>
            <span>Sign up with Google</span>
          </button> --}}
        </form>
        <p class="sign-up-label">
          Already have an account?<a href="{{ route('customer_login') }}" class="sign-up-link">Log in</a>
        </p>

      </div>

   <script>
     
 
   </script>
      <script src="js/login.js"></script>


   </body>
</html>