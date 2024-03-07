<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Time</title>

<style>

body{
    background-color: black;
}

.clock {
    font-size: 10em;
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

</style>

</head>
<body>
    <div class="clock">
        <div id="hour"></div>
        <div id="minute"></div>
        <div id="second"></div>
        <div id="ampm"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>


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