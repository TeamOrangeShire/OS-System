$(document).ready(function() {
    const today = new Date();
    $('#calendars').evoCalendar({
        theme:"Orange Coral",
        calendarEvents: [
      {
        id: 'bHay68s', // Event's ID (required)
        name: "New Year", // Event name (required)
        date: "September/29/2024", // Event date (required)
        type: "holiday", // Event type (required)
        everyYear: true // Same event every year (optional)
      },
      {
        name: "Vacation Leave",
        badge: "02/13 - 02/15", // Event badge (optional)
        date: ["September/1/2024", "September/15/2024"], // Date range
        description: "Vacation leave for 3 days.", // Event description (optional)
        type: "event",
        color: "#63d867" // Event custom color (optional)
      }
    ],   onSelectDate: function(event, date) {
        // Convert selected date to a Date object
        const selectedDate = new Date(date);

        // Disable past dates
        if (selectedDate < today) {
            alert("Past dates cannot be selected.");
            return false; // Disable click action for past dates
        }
        
    }
    });
    disablePastDates(today);
});

function disablePastDates(today) {
    // Get all calendar days
    $('#calendars .day').each(function() {
        const dayDate = new Date($(this).attr('data-date-val'));

        // If the date is in the past, disable it
        if (dayDate < today) {
            $(this).addClass('disabled-date'); // Add a custom class
        }
    });
}
