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
      margin-top: 40px;
      padding: 20px;
      text-align: center; /* Align all content in center */
    }

    .lock-screen-logo {
      display: inline-block;
      margin-bottom: 30px;
      border-radius: 50%; /* Set border radius to 50% */
    }

    .lock-screen-logo img {
      max-width: 60%;
      height: auto;
      border-radius: inherit; /* Inherit the border radius from parent */
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5); /* Add box shadow */
    }

    .lock-screen-form {
      text-align: center;
    }

    .form-control {
      margin-bottom: 20px;
      width: 60%;
      margin: 0 auto; /* Center the form horizontally */
    }
    .btn-primary {
      background-color: #ff5c40;
      border-color: #ec5729f6;
    }
    
    .btn-primary:hover {
      background-color: gray;
      border-color: darkgray;
    }
    
    .clock {
        font-size: 3em;
        text-align: center;
        margin-top: 50px;
    }
    
    .clock div {
        display: inline-block;
        padding: 10px;
        color: white;
        border-radius: 5px;
    }
    
    #ampm {
        font-size: 0.5em;
    }
    
    /* Custom label style */
    label {
      color: white; /* Set label color to white */
      font-size: 30px;
      font-family: Arial, sans-serif; /* Set font to formal */
    }
  </style>
</head>
<body>
  <div class="lock-screen-container">
    <div class="clock">
        <div id="hour"></div>
        <div id="minute"></div>
        <div id="second"></div>
        <div id="ampm"></div>
    </div>
    <br>
    <br>
    <div class="lock-screen-logo">
      <img src="{{asset('assets/images/user/avatar-2.jpg')}}" alt="Logo">
    </div>
    <form class="lock-screen-form">
        <label for="">Albert Pimentel</label>
      <div class="form-group">
        <input type="password" class="form-control" id="password" placeholder="Password">
      </div>
      <a href="{{route('index')}}" class="btn btn-primary">Unlock</a>
    </form>
  </div>

<script>
    function updateClock() {
        var now = new Date();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        var ampm = hour >= 12 ? 'PM' : 'AM';
    
        // Convert 24-hour format to 12-hour format
        hour = hour % 12;
        hour = hour ? hour : 12; // Handle midnight
    
        // Add leading zeros to minutes and seconds
        minute = minute < 10 ? '0' + minute : minute;
        second = second < 10 ? '0' + second : second;
    
        // Update the DOM elements
        document.getElementById('hour').textContent = hour;
        document.getElementById('minute').textContent = minute;
        document.getElementById('second').textContent = second;
        document.getElementById('ampm').textContent = ampm;
    }
    
    // Call updateClock function every second
    setInterval(updateClock, 1000);
    
    // Initial call to updateClock to avoid delay
    updateClock();
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
