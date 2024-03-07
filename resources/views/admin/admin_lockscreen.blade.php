<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lock Screen</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('{{asset('assets/images/lock_bg.jpg')}}') no-repeat center center fixed;
      background-size: cover;
    }

    /* Overlay */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Black with 0.5 opacity */
      backdrop-filter: blur(5px); /* Blur effect */
      z-index: -1; /* Place the overlay behind other content */
    }

    .lock-screen-container {
      position: relative;
      z-index: 1;
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }

    .lock-screen-logo {
      text-align: center;
      margin-bottom: 30px;
      border-radius: 50%; /* Set border radius to 50% */
    }

    .lock-screen-logo img {
      max-width: 60%;
      height: auto;
      border-radius: inherit; /* Inherit the border radius from parent */
    }

    .lock-screen-form {
      text-align: center;
    }

    .form-control {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="lock-screen-container">
    <div class="lock-screen-logo">
      <img src="{{asset('assets/images/user/avatar-2.jpg')}}" alt="Logo">
    </div>
    <form class="lock-screen-form">
     
      <div class="form-group">
        <input type="password" class="form-control" id="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary">Unlock</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
