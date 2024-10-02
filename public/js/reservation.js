
$(document).ready(function() {

    let reservationData = [];
    $.ajax({
        type:"GET",
        url:"/admin/getReservation",
        dataType: "json",
        success: res=> {
            res.data.forEach( data => {

                const reservation = {};
                reservation.id = data.r_id;
                reservation.name = data.c_name;
                reservation.date = formatDate(data.start_date);
                reservation.type = "others";

                reservation.color = '#63d867'
                reservationData.push(reservation);
             });

             console.log(reservationData);

        }, error: xhr=> console.log(xhr.responseText)
    })

    $('#calendars').evoCalendar({
        theme:"Orange Coral",
        calendarEvents: reservationData
    });
});
function formatDate(dateString) {
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Split the input string by the hyphen to get year, month, and day
    const [year, month, day] = dateString.split('-');

    // Convert the month to the full month name
    const monthName = months[parseInt(month, 10) - 1];

    // Return the formatted date in "Month/day/year" format
    return `${monthName}/${parseInt(day, 10)}/${year}`;
}

// Example usage
const inputDate = "2024-10-02";
const formattedDate = formatDate(inputDate);
console.log(formattedDate); // Output: "October/2/2024"
