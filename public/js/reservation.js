
$(document).ready(function() {

    let reservationData = [];
    $.ajax({
        type:"GET",
        url:"/admin/getReservation",
        dataType: "json",
        success: res=> {
            res.data.forEach( data => {

                const reservation = {};
                if(data.room_id!=0 && data.status != 0){
                    reservation.id = data.r_id;
                    reservation.name = `Meeting Room ${data.room_number}`;
                    reservation.date = data.start_date == data.end_date ? formatDate(data.start_date) : [formatDate(data.start_date), formatDate(data.end_date)];
                    reservation.type = `MeetingRoom${data.room_number}`;
                    reservation.description = data.start_date == data.end_date ? `${formatDate(data.start_date, 'display')} (Occupied)` :  `${formatDate(data.start_date, 'display')} - ${formatDate(data.end_date, 'display')} (Occupied)`
                    reservation.color = getRoomColor(data.room_number);

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

function getRoomColor(num){
    switch(+num){
        case 1:
            return '#FF4500';
        case 2:
            return '#32CD32';
        case 3:
            return '#1E90FF';
        case 4:
            return '#FFD700';
        case 5:
            return '#FF1493';
    }
}



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

