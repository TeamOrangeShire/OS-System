
$(document).ready(function() {

    let reservationData = [];
    $.ajax({
        type:"GET",
        url:"/admin/getReservation",
        dataType: "json",
        success: res=> {
            console.log(res);
            res.data.forEach( data => {

                const reservation = {};
                if(data.room_id!=0){
                    reservation.id = data.r_id;
                    reservation.name = `Meeting Room ${data.room_number}`;
                    reservation.date = formatDate(data.start_date);
                    reservation.type = "holiday";
                    reservation.description = `${formatDate(data.start_date, 'display')} - ${formatDate(data.end_date, 'display')}`
                    reservation.color = '#63d867';

                    reservationData.push(reservation);
                }

             });

             $('#calendars').evoCalendar({
                theme:"Orange Coral",
                calendarEvents: reservationData
            });


        }, error: xhr=> console.log(xhr.responseText)
    })

});

function formatDate(dateString, type = 'render') {
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Split the input string by the hyphen to get year, month, and day
    const [year, month, day] = dateString.split('-');

    // Convert the month to the full month name
    const monthName = months[parseInt(month, 10) - 1];

    // Return the formatted date in "Month/day/year" format
   if(type == 'render'){
        return `${monthName}/${parseInt(day, 10)}/${year}`;
   }else{
        return `${monthName} ${parseInt(day, 10)}, ${year}`;
   }
}

