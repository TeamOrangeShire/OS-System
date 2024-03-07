<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Full Calendar</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .day {
      border: 1px solid #ccc;
      height: 100px;
    }
    .current-date {
      background-color: orange;
    }
    .calendar-container {
      background-color: rgba(0, 0, 0, 0.5); /* Adjust the alpha value for the desired level of opacity */
      backdrop-filter: blur(10px); /* Apply blur effect */
      padding: 20px;
      border-radius: 10px;
    }
    .day-cell {
      background-color: transparent; /* Set background color to transparent */
      border-radius: 5px;
      padding: 5px;
      margin: 5px;
      color: white; /* Set text color to white */
      font-size: 1.5em; /* Increase font size */
    }
    .current-day {
      background-color: #00bfff; /* Set background color for the current day */
    }
  </style>
</head>
<body>
  <div class="container calendar-container">
    <div class="row">
      <div class="col-1">
        <button class="btn btn-primary" id="prev-month">&lt;</button>
      </div>
      <div class="col-10">
        <h2 class="text-center my-4" id="current-month"></h2>
      </div>
      <div class="col-1">
        <button class="btn btn-primary" id="next-month">&gt;</button>
      </div>
    </div>
    <div class="row">
      <div class="col border text-center">Sunday</div>
      <div class="col border text-center">Monday</div>
      <div class="col border text-center">Tuesday</div>
      <div class="col border text-center">Wednesday</div>
      <div class="col border text-center">Thursday</div>
      <div class="col border text-center">Friday</div>
      <div class="col border text-center">Saturday</div>
    </div>
    <div id="calendar"></div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){
      var currentMonth;
      var currentYear;
      var monthsArray = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

      // Function to generate calendar for a given month and year
      function generateCalendar(year, month) {
        var daysInMonth = new Date(year, month + 1, 0).getDate();
        var firstDay = new Date(year, month, 1).getDay();

        var calendarHtml = '';
        for (var i = 0; i < 6; i++) {
          calendarHtml += '<div class="row">';
          for (var j = 0; j < 7; j++) {
            var day = i * 7 + j + 1 - firstDay;
            if (day > 0 && day <= daysInMonth) {
              var currentDate = new Date();
              if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
                calendarHtml += '<div class="col border text-center day-cell current-day">' + day + '</div>';
              } else {
                calendarHtml += '<div class="col border text-center day-cell">' + day + '</div>';
              }
            } else {
              calendarHtml += '<div class="col border text-center day-cell"></div>';
            }
          }
          calendarHtml += '</div>';
        }

        $('#calendar').html(calendarHtml);
      }

      // Function to get current month and year
      function getCurrentMonthAndYear() {
        var date = new Date();
        currentMonth = date.getMonth();
        currentYear = date.getFullYear();
        $('#current-month').text(monthsArray[currentMonth] + ' ' + currentYear);
        generateCalendar(currentYear, currentMonth);
      }

      // Call the function to initialize the calendar
      getCurrentMonthAndYear();

      // Event listener for previous month button
      $('#prev-month').click(function() {
        if (currentMonth === 0) {
          currentMonth = 11;
          currentYear--;
        } else {
          currentMonth--;
        }
        $('#current-month').text(monthsArray[currentMonth] + ' ' + currentYear);
        generateCalendar(currentYear, currentMonth);
      });

      // Event listener for next month button
      $('#next-month').click(function() {
        if (currentMonth === 11) {
          currentMonth = 0;
          currentYear++;
        } else {
          currentMonth++;
        }
        $('#current-month').text(monthsArray[currentMonth] + ' ' + currentYear);
        generateCalendar(currentYear, currentMonth);
      });
    });
  </script>
</body>
</html>
