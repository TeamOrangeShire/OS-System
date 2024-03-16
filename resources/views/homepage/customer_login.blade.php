<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orange Shire - Customer Login</title>
  <link rel="stylesheet" href="css/login2.css">
  <link rel="icon" href="img/os_logo.png">
  <script src="https://kit.fontawesome.com/33f625dcbc.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
</head>
<body>
<div class="loader" id="loader">
  <div class="hourglassBackground">
    <div class="hourglassContainer">
      <div class="hourglassCurves"></div>
      <div class="hourglassCapTop"></div>
      <div class="hourglassGlassTop"></div>
      <div class="hourglassSand"></div>
      <div class="hourglassSandStream"></div>
      <div class="hourglassCapBottom"></div>
      <div class="hourglassGlass"></div>
    </div>
  </div>
  <p>Verifying Credentials...</p>
</div>
  <div class="wrapper">
    <header>Welcome Back to Orange Shire</header>
    <form method="post" id="login-form">
      @csrf
      <div class="field email">
        <div class="input-area">
          <input type="text" name="username" placeholder="Email">
          <i class="icon fa-solid fa-circle-user"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt">Email can't be blank</div>
      </div>
      <div class="field password">
        <div class="input-area">
          <input type="password" name="password" placeholder="Password">
          <i class="icon fas fa-lock"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt">Password can't be blank</div>
      </div>
      <div class="pass-txt"><a href="#">Forgot password?</a></div>
      <input type="submit" value="Login">
    </form>
    <div class="sign-txt">Not yet member? <a href="{{ route('signup') }}">Signup now</a></div>
  </div>

  <script src="js/login2.js"></script>
<script>
    function Login() {
      document.getElementById('loader').style.display = 'flex';
    event.preventDefault();
     var formData = $('form#login-form').serialize();
 
     $.ajax({
         type: 'POST',
         url: "{{ route('custom_log') }}",
         data: formData,
         success: function(response) {
           if(response.status === 'success'){
            window.location.href = "{{ route('home') }}";
           }else if(response.status === 'fail'){
            document.getElementById('loader').style.display = 'none';
            alertify.set('notifier','position', 'top-center');
            alertify.warning('Incorrect Password'); 
           }else{
            document.getElementById('loader').style.display = 'none ';
            alertify.set('notifier','position', 'top-center');
            alertify.warning('Username Not Found'); 
           }
         }, 
         error: function (xhr) {

             console.log(xhr.responseText);
         }
     });
 }
</script>
</body>
</html>