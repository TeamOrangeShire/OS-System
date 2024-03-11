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
</head>
<body>
  <div class="wrapper">
    <header>Welcome Back to Orange Shire</header>
    <form action="#">
      <div class="field email">
        <div class="input-area">
          <input type="text" placeholder="Username/Email">
          <i class="icon fa-solid fa-circle-user"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt">Username/Email can't be blank</div>
      </div>
      <div class="field password">
        <div class="input-area">
          <input type="password" placeholder="Password">
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

</body>
</html>