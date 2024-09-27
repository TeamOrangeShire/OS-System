const today = new Date();
today.setHours(0, 0, 0, 0);

$(document).ready(function() {
    $('#calendars').evoCalendar({
        theme: "Orange Coral",
        calendarEvents: [
            {
                id: 'bHay68s',
                name: "New Year",
                date: "September/29/2024",
                type: "holiday",
                everyYear: true
            },
            {
                name: "Vacation Leave",
                badge: "02/13 - 02/15",
                date: ["September/1/2024", "September/15/2024"],
                description: "Vacation leave for 3 days.",
                type: "event",
                color: "#63d867"
            }
        ],
        'eventDisplayDefault': false,
        'eventListToggler': false,
        onSelecteDate: (event, date) => {
            const selectedDate = new Date(date);
            selectedDate.setHours(0, 0, 0, 0);
            // Disable past dates and Sundays
            if (selectedDate < today || selectedDate.getDay() === 0) {
                alert("Past dates and Sundays cannot be selected.");
                return false; // Disable click action for past dates and Sundays
            }
        }
    });

});

$('#calendars').on('selectDate', function(event, newDate, oldDate) {
    disablePastDates(today);
});
$('#calendars').on('selectMonth', function() {
    disablePastDates(today);
});

$('#calendars').on('selectYear', function() {
    setTimeout(() => {
        disablePastDates(today);
    }, 100); // Wait for the calendar to update
});

// Function to disable past dates and Sundays by adding a custom class
function disablePastDates(today) {

    $('#calendars .day').each(function() {
        const dayDate = new Date($(this).attr('data-date-val'));
        dayDate.setHours(0, 0, 0, 0);

        // If the date is in the past or a Sunday, disable it
        if (dayDate < today || dayDate.getDay() === 0) {
            $(this).addClass('disabled-date'); // Add a custom class
            $(this).off('click'); // Disable click event for these dates
        } else {
            $(this).removeClass('disabled-date'); // Ensure enabled dates are not disabled
            $(this).on('click', function() {
            });
        }
    });
}
