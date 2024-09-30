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
    });
    disablePastDates(today);
});

$('#calendars').on('selectDate', function(event, newDate) {
    disablePastDates(today);
    // Parse the selected date string into a Date object
    const [month, day, year] = newDate.split("/").map(Number);
    const selectedDate = new Date(year, month - 1, day); // month is 0-indexed

    // Get the day of the week for the selected date (0 = Sunday, 6 = Saturday)
    const dayOfWeek = selectedDate.getDay();

    let reserveButton = '';
    console.log(dayOfWeek);
    switch(dayOfWeek){
        case 1:
            reserveButton = AddReservationButtons(1);
            break;
        case 2:
            reserveButton = AddReservationButtons(2);
            break;
        case 3:
            reserveButton = AddReservationButtons(3);
            break;
        case 4:
            reserveButton = AddReservationButtons(4);
            break;
        case 5:
            reserveButton = AddReservationButtons(5);
            break;
        case 6:
            reserveButton = AddReservationButtons(6);
            break;
        default:
            console.log("invalid date")
            break;
    }

    const div = document.getElementById('reservationButtons');
    div.scrollTop = 0;
    div.innerHTML = '';
    div.innerHTML = reserveButton;
});


$('#calendars').on('selectMonth', function() {
    disablePastDates(today);
});

$('#calendars').on('selectYear', function() {
    setTimeout(() => {
        disablePastDates(today);
    }, 100);
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


function AddReservationButtons(num){

    let buttons = '';

    const mondayTime = [
        '08:00 AM',
        '09:00 AM',
        '10:00 AM',
        '11:00 AM',
        '12:00 PM',
        '01:00 PM',
        '02:00 PM',
        '03:00 PM',
        '04:00 PM',
        '05:00 PM',
        '06:00 PM',
        '07:00 PM',
        '08:00 PM',
        '09:00 PM',
        '10:00 PM',
        '11:00 PM',
        '12:00 AM',
    ];

    const nonMondayTime = [
        '01:00 AM',
        '02:00 AM',
        '03:00 AM',
        '04:00 AM',
        '05:00 AM',
        '06:00 AM',
        '07:00 AM',
        '08:00 AM',
        '09:00 AM',
        '10:00 AM',
        '11:00 AM',
        '12:00 PM',
        '01:00 PM',
        '02:00 PM',
        '03:00 PM',
        '04:00 PM',
        '05:00 PM',
        '06:00 PM',
        '07:00 PM',
        '08:00 PM',
        '09:00 PM',
        '10:00 PM',
        '11:00 PM',
        '12:00 AM',
    ];

    const saturdayTime= [
        '01:00 AM',
        '02:00 AM',
        '03:00 AM',
        '04:00 AM',
        '05:00 AM',
        '06:00 AM',
        '07:00 AM',
        '08:00 AM',
        '09:00 AM',
        '10:00 AM',
        '11:00 AM',
        '12:00 PM',
        '01:00 PM',
        '02:00 PM',
        '03:00 PM',
        '04:00 PM',
        '05:00 PM',
        '06:00 PM',
        '07:00 PM',
        '08:00 PM',
        '09:00 PM',
        '10:00 PM',
        '11:00 PM',
        '12:00 AM',
        '01:00 AM',
        '02:00 AM',
        '03:00 AM',
    ];
    const add = (delay, data) => {
        return `<div onclick="selectReservationTime(this)" class="w-100 d-flex p-1 gap-1">
            <button class="btn btn-primary w-100 wow fadeInLeft select" data-wow-delay="${delay}s">${data}</button>
            <button class="btn btn-info d-none nextBtn" data-bs-toggle="modal" data-bs-target="#reserveModal" style="width:0%;">Proceed</button>
        </div>`
   }

    let delay = 0.01;
    if(num == 1){

        mondayTime.forEach( data => {
            buttons += add(delay, data);
        });
    }

    if(num == 2 || num == 3 || num == 4 || num == 5){
        nonMondayTime.forEach( data => {
            buttons += add(delay, data);
        });
    }

    if(num == 6){
        saturdayTime.forEach( data => {
            buttons += add(delay, data);

        });
    }


    return buttons;
}


function selectReservationTime(element){

    const allSelect = document.querySelectorAll('.select');

    allSelect.forEach(data=> {
       const classList = data.classList;
       const array = Array.from(classList);

       if(array.includes('w-50')){
        data.nextElementSibling.classList.add('d-none');
        data.nextElementSibling.style.width ="0";
        data.classList.add('w-100');
        data.classList.remove('w-50');
       }
    });

    element.children[0].classList.remove('w-100');
    element.children[0].classList.add('w-50');

    element.children[1].classList.remove('d-none');
    element.children[1].style.width = "50%";
}
