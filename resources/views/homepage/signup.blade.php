<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Orange Shire - Sign up </title>
      <link rel="icon" href="img/os_logo.png">
      <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="libraries/modals/hystmodal.min.css">
      <script src="libraries/modals/hystmodal.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
          <input type="email" name="email" class="input" placeholder="Email">
          <input type="password" name="password" class="input" placeholder="Password">
          <button type="button" onclick="SendCode()" class="form-btn">Create account</button>
        </form>
        <p class="sign-up-label">
          Already have an account?<a href="{{ route('customer_login') }}" class="sign-up-link">Log in</a>
        </p>
        <div class="buttons-container">
         
          <div class="google-login-button">
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
          </div>
        </div>
      </div>


      <form class="form-verification" method="post" id="verification_code" style="display: none">
         @csrf
        <div class="info">
        <span class="title-ver">Verification Code</span>
      <p class="description">Enter the 6 digit verification code you recieve in your email you entered to continue the sign up</p>
         </div> 
         <input type="hidden" id="ver-code">

         <input type="hidden" id="fname" name="fname">
         <input type="hidden" id="mname" name="mname">
         <input type="hidden" id="lname" name="lname">
         <input type="hidden" id="email" name="email">
         <input type="hidden" id="password" name="password">

          <div class="input-fields">
          <input oninput="restrictToNumbers(event, 'input-2', '')" id="input-1" placeholder="" type="tel" maxlength="1">
          <input oninput="restrictToNumbers(event, 'input-3', 'input-1')" id="input-2" placeholder="" type="tel" maxlength="1">
          <input oninput="restrictToNumbers(event, 'input-4', 'input-2')" id="input-3" placeholder="" type="tel" maxlength="1">
          <input oninput="restrictToNumbers(event, 'input-5', 'input-3')" id="input-4" placeholder="" type="tel" maxlength="1">
          <input oninput="restrictToNumbers(event, 'input-6', 'input-4')" id="input-5" placeholder="" type="tel" maxlength="1">
          <input oninput="restrictToNumbers(event, '', 'input-5')" id="input-6" placeholder="" type="tel" maxlength="1">
        </div>
        <br>
        <p id="error" style="display: none">Invalid Code</p>
      
            <div class="action-btns">
              <button class="verify" type="button" onclick="verifys()">Verify</button>
              <button class="clear" type="button" onclick="clears()">Clear</button>
            </div>
      
      </form>
   <script>
     function SendCode() {
      document.getElementById('loadingDiv').style.display = 'flex';
     var formData = $('form#account_info').serialize();
 
     $.ajax({
         type: 'POST',
         url: '{{route('customer_verification')}}',
         data: formData,
         success: function(response) {
          document.getElementById('loadingDiv').style.display = 'none';
          document.getElementById('verification_code').style.display = '';
          document.getElementById('form-account').style.display = 'none';
          
          document.getElementById('fname').value = response.fname;
          document.getElementById('mname').value = response.mname;
          document.getElementById('lname').value = response.lname;
          document.getElementById('email').value = response.email;
          document.getElementById('password').value = response.password;
          document.getElementById('ver-code').value = response.code;
         },
         error: function (xhr) {
             console.log(xhr.responseText);
         }
     });
 }
 function verifys(){
  document.getElementById('loadingDiv').style.display = '';
  const code = document.getElementById('ver-code').value;

  const input1 = document.getElementById('input-1').value;
  const input2 = document.getElementById('input-2').value;
  const input3 = document.getElementById('input-3').value;
  const input4 = document.getElementById('input-4').value;
  const input5 = document.getElementById('input-5').value;
  const input6 = document.getElementById('input-6').value;

   
  const inputs = [input1, input2, input3, input4, input5, input6];
     let collectedCode = '';
 
     for (const input of inputs) {
         collectedCode += input;
         if (collectedCode.length === 6) {
             break;
         }
     }
 
     if (collectedCode.length < 6) {
         return;
     }
     console.log(code);
     console.log(collectedCode);
     if (collectedCode === code) {
      console.log('match');
         CreateAccount();
     } else {
      console.log('mis-match');
        input1.value='';
        input2.value='';
        input3.value='';
        input4.value='';
        input5.value='';
        input6.value='';
        document.getElementById('error').style.display="";
        document.getElementById('loadingDiv').style.display = 'none';
     }

 }
 
 function CreateAccount() {
     var formData = $('form#verification_code').serialize();
 
     $.ajax({
         type: 'POST',
         url: '{{route('customer_create_account')}}',
         data: formData,
         success: function(response) {
          console.log('acc_created');
         window.location.href = "{{ route('new_account') }}";
         
         },
         error: function (xhr) {
             console.log(xhr.responseText);
         }
     });
 }
   </script>
      <script src="js/login.js"></script>

   </body>
</html>