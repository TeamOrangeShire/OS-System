const today = new Date();
today.setHours(0, 0, 0, 0);
let roomDetails;
let rateList;
let selectedDateGlobal;

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-full-width",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  const monthList = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
];


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


    $.ajax({
        type: "GET",
        url: "/user/reservation/getrooms",
        dataType: "json",
        success: res=> {
            const select = document.getElementById('selectReserve');

            res.rooms.forEach(data => {
                select.innerHTML += `<option value="${data.room_id}">${data.room_number != 0? 'Meeting Room ' + data.room_number : 'Hotdesk'}</option>`
            });

            roomDetails = res.rooms;
            rateList = res.rates;
        }, error: xhr=> console.log(xhr.responseText)
    });


    const currentYear = new Date().getFullYear();
    const weeks = getWeeksInYear(currentYear);

    const weeklySelect = document.getElementById('selectEndDateWeekly');
    const todayWeek = new Date();

    weeks.forEach(d => {
        // Parse the end date of the week to a Date object for comparison
        const endDate = new Date(d.end);

        // Disable if the end date of the week is in the past
        if (endDate < todayWeek) {
            weeklySelect.innerHTML += `<option value="${d.end}" disabled>${formatDate(d.start)} - ${formatDate(d.end)} (Week ${d.week}) Past</option>`;
        } else {
            weeklySelect.innerHTML += `<option value="${d.end}">${formatDate(d.start)} - ${formatDate(d.end)} (Week ${d.week})</option>`;
        }
    });


    const months = document.getElementById('selectEndDateMonthly');



    const currentMonth = new Date().getMonth();

    monthList.forEach((m, index) => {

        if (index <= currentMonth) {
            months.innerHTML += `<option value="${m}" disabled>${m}(Passed Month)</option>`;
        } else {
            months.innerHTML += `<option value="${m}">${m}</option>`;
        }
    });

    months.innerHTML += `<option value="other">${currentYear + 1} Months</option>`;

    const dateToday = new Date().toISOString().split('T')[0];

    document.getElementById('selectEndDate').setAttribute('min', dateToday);

});


function getWeeksInYear(year) {
    const weeks = [];
    let startDate = new Date(year, 0, 1); // January 1st of the given year

    // Adjust startDate to the first Sunday of the year
    while (startDate.getDay() !== 0) {
        startDate.setDate(startDate.getDate() + 1);
    }

    let weekNumber = 1;
    while (startDate.getFullYear() === year) {
        let endDate = new Date(startDate); // Copy startDate
        endDate.setDate(endDate.getDate() + 6); // End of the week (Saturday)

        // Ensure the endDate does not exceed the current year
        if (endDate.getFullYear() !== year) {
            endDate = new Date(year, 11, 31); // Set to December 31st
        }

        weeks.push({
            week: weekNumber,
            start: startDate.toLocaleDateString(), // Format as MM/DD/YYYY
            end: endDate.toLocaleDateString()
        });

        // Move to the next week
        startDate.setDate(startDate.getDate() + 7);
        weekNumber++;
    }

    return weeks;
}

$('#calendars').on('selectDate', function(event, newDate) {
    disablePastDates(today);
    // Parse the selected date string into a Date object
    const [month, day, year] = newDate.split("/").map(Number);
    const selectedDate = new Date(year, month - 1, day); // month is 0-indexed

    // Get the day of the week for the selected date (0 = Sunday, 6 = Saturday)
    const dayOfWeek = selectedDate.getDay();

    let reserveButton = '';

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
    selectedDateGlobal = newDate;

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
            <button onclick="openReserveModal('${data}')" class="btn btn-info d-none nextBtn" data-bs-toggle="modal" data-bs-target="#reserveModal" style="width:0%;">Proceed</button>
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

document.getElementById('selectReserve').addEventListener('change', ()=> {
    const selectReserve = document.getElementById('selectReserve');
    const selectPaxDiv = document.getElementById('selectPaxDiv');
    const hotdeskDiv = document.getElementById('hotdeskDiv');
    const selectHotdesk = document.getElementById('selectHotdesk');
    const selectRoomRatesDiv = document.getElementById('selectRoomRatesDiv');
    const selectRoomRates = document.getElementById('selectRoomRates');

    const selectPaxHotdeskDiv = document.getElementById('selectPaxHotdeskDiv');


    const selectEndDateDiv = document.getElementById('selectEndDateDiv');
    const selectEndTimeDiv = document.getElementById('selectEndTimeDiv');
    const selectEndDateMonthlyDiv = document.getElementById('selectEndDateMonthlyDiv');
    const selectEndDateWeeklyDiv = document.getElementById('selectEndDateWeeklyDiv');


    const selectEndDate = document.getElementById('selectEndDate');
    const selectEndDateWeekly = document.getElementById('selectEndDateWeekly');
    const selectEndDateMonthly = document.getElementById('selectEndDateMonthly');
    const selectEndTime = document.getElementById('selectEndTime');


    if(selectReserve.value != 0){
        selectPaxDiv.classList.remove('d-none');
        hotdeskDiv.classList.add('d-none');
        selectPaxHotdeskDiv.classList.add('d-none');
        const selectedRoom = roomDetails.filter( x => x.room_id == selectReserve.value);
        const selectPax = document.getElementById('selectPax');
        selectPax.innerHTML = '';
        for(let i = 0; i < +selectedRoom[0].room_capacity; i++){
            selectPax.innerHTML += `<option>${i+1}</option>`;
        }
        selectEndTime.disabled = false;
        selectEndTimeDiv.classList.remove('d-none');
        selectRoomRatesDiv.classList.remove('d-none');
        selectEndDateWeeklyDiv.classList.add('d-none');
        selectEndDateMonthlyDiv.classList.add('d-none');
        selectEndDateDiv.classList.add('d-none');
        const roomRates = rateList.filter(x => x.room_id == selectReserve.value);
        selectRoomRates.innerHTML = '';
        roomRates.forEach(data=> {
            selectRoomRates.innerHTML += `<option value="${data.rp_id}">${data.rp_rate_description} (₱${data.rp_price})</option>`
        });
    }else{
        hotdeskDiv.classList.remove('d-none');
        selectPaxDiv.classList.add('d-none');
        selectRoomRatesDiv.classList.add('d-none');
        selectEndDateDiv.classList.add('d-none');
        selectPaxHotdeskDiv.classList.remove('d-none');
        const hotdeskRates = rateList.filter(x => x.room_id == 0);
        selectHotdesk.innerHTML = '<option value="0">Open Time</option>';
        selectEndTimeDiv.classList.add('d-none');
        selectEndDateWeeklyDiv.classList.add('d-none');
        selectEndDateMonthlyDiv.classList.add('d-none');

        selectEndDate.disabled = true;
        selectEndDateMonthly.disabled = true;
        selectEndDateWeekly.disabled = true;
        selectEndTime.disabled = true;

        hotdeskRates.forEach(data=> {
            selectHotdesk.innerHTML += `<option value="${data.rp_id}">${data.rp_rate_description}</option>`;
        });

    }

});

document.getElementById('addGuestBtn').addEventListener('click', ()=> {
    const addGuestBtnDiv = document.getElementById('addGuestBtnDiv');
    const addGuestDiv = document.getElementById('addGuestDiv');

    addGuestBtnDiv.classList.add('d-none');
    addGuestDiv.classList.remove('d-none');
});


document.getElementById('selectRoomRates').addEventListener('change', (e)=> {
    const selectedRate = rateList.filter(x => x.rp_id == e.target.value);
    const selectEndDateDiv = document.getElementById('selectEndDateDiv');
    const selectEndDateWeeklyDiv = document.getElementById('selectEndDateWeeklyDiv');
    const selectEndDateMonthlyDiv = document.getElementById('selectEndDateMonthlyDiv');
    const selectEndTimeDiv = document.getElementById('selectEndTimeDiv');

    const selectEndDate = document.getElementById('selectEndDate');
    const selectEndDateWeekly = document.getElementById('selectEndDateWeekly');
    const selectEndDateMonthly = document.getElementById('selectEndDateMonthly');
    const selectEndTime = document.getElementById('selectEndTime');

    const hide = (element, input) => {
        if(!element.classList.contains('d-none')){
            element.classList.add('d-none');
        }
        input.disabled = true;
    }

    hide(selectEndDateDiv, selectEndDate);
    hide(selectEndDateWeeklyDiv, selectEndDateWeekly);
    hide(selectEndDateMonthlyDiv, selectEndDateMonthly);
    hide(selectEndTimeDiv, selectEndTime);
    const endDateType = document.getElementById('endDateType');
    switch(selectedRate[0].rp_rate_description){
        case "Daily (12 Hours)":
            selectEndDateDiv.classList.remove('d-none');
            selectEndDate.disabled = false;
            endDateType.value = "Daily";
            break;
        case "Weekly":
            selectEndDateWeeklyDiv.classList.remove('d-none');
            selectEndDateWeekly.disabled = false;
            endDateType.value = "Weekly";
            break;
        case "Monthly":
            selectEndDateMonthlyDiv.classList.remove('d-none');
            selectEndDateMonthly.disabled = false;
            endDateType.value = "Monthly";
            break;
        case "Hourly":
            selectEndTimeDiv.classList.remove('d-none');
            selectEndTime.disabled = false;
            endDateType.value = "Hourly";
            break;
        default:
            endDateType.value = "4 Hours";
            break;
    }

});

function openReserveModal(time){
    const selectedTimeModal = document.getElementById('selectedTimeModal');
    const selectDateModal = document.getElementById('selectedDateModal');

    selectDateModal.textContent = selectedDateGlobal;
    selectedTimeModal.textContent = time;

    document.getElementById('startDateReservation').value = selectedDateGlobal;
    document.getElementById('startTimeReservation').value = time;
}

document.getElementById('submitReservation').addEventListener('click', e => {
    const form = document.getElementById('submitReservationForm');

    if (form.checkValidity()) {
        form.requestSubmit();
        e.target.innerHTML = '<div class="loaderSubmit"></div> Submitting Please Wait...';
    } else {
        form.reportValidity();
    }
});

document.getElementById('submitReservationForm').addEventListener('submit', e => {
    e.preventDefault();

    $.ajax({
        type:"POST",
        url: '/user/reservation/submitreservation',
        data: $('#submitReservationForm').serialize(),
        success: res => {
            if(res.success){
                document.getElementById('submitReservation').innerHTML = 'Submit Reservation';
                e.target.reset();
                document.getElementById('closeReservation').click();
                document.getElementById('addGuestBtnDiv').classList.remove('d-none');
                document.getElementById('addGuestDiv').classList.add('d-none');
                document.getElementById('selectPaxHotdeskDiv').classList.add('d-none');
                document.getElementById('selectPaxDiv').classList.add('d-none');
                document.getElementById('selectRoomRatesDiv').classList.add('d-none');
                document.getElementById('hotdeskDiv').classList.add('d-none');
                document.getElementById('selectEndDateDiv').classList.add('d-none');

                toastr["success"]("Reservation Submitted wait for the email for the response.")

                const selectBtn = document.querySelectorAll('.select');

                selectBtn.forEach(data => {
                    const classList = Array.from(data.classList);

                    if(classList.includes('w-50')){
                        data.classList.remove('w-50');
                        data.classList.add('w-100');

                        const next = data.nextElementSibling;

                        next.classList.add('d-none');

                    }
                });
            }
        }, error: xhr=> console.log(xhr.responseText)
    })
});




function formatDate(dateString) {
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Split the input string by the hyphen to get year, month, and day
    const [month, day, year] = dateString.split('/');

    // Convert the month to the full month name
    const monthName = months[parseInt(month, 10) - 1];

    // Return the formatted date in "Month/day/year" format

        return `${monthName} ${parseInt(day, 10)}, ${year}`;

}

document.getElementById('selectEndTime').addEventListener('change', e => {
    const now = new Date();

    // Get the current time plus one hour
    const currentTime = new Date(now.getTime() + 60 * 60 * 1000); // Add 1 hour to current time

    // Get the selected time from the input
    const selectedTime = e.target.value;

    if (selectedTime === "") {
        alert("Please select a time.");
        return;
    }

    // Create a date object for the selected time, keeping the same date as the current date
    const [selectedHours, selectedMinutes] = selectedTime.split(':');
    const selectedDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), selectedHours, selectedMinutes);

    // Compare selected time with the current time (plus 1 hour)
    if (selectedDate < currentTime) {
        toastr["error"]("Invalid Time! The selected time must be at least one hour ahead of the current time.");
    }
});

document.getElementById('selectEndDateMonthly').addEventListener('change', e=> {
    const months = document.getElementById('selectEndDateMonthly');
    if(e.target.value === "other"){
        months.innerHTML = '';
        const nextYear = new Date().getFullYear() + 1;
        const currentYear = new Date().getFullYear();
        monthList.forEach(data => {
            months.innerHTML += `<option value="${data}-${nextYear}">${data} (${nextYear})</option>`
        });

        months.innerHTML += `<option value="back">Back to ${currentYear}</option>`
    }else if(e.target.value === 'back'){
        months.innerHTML = '';

        const currentMonth = new Date().getMonth();

        monthList.forEach((m, index) => {

        if (index <= currentMonth) {
            months.innerHTML += `<option value="${m}" disabled>${m}(Passed Month)</option>`;
        } else {
            months.innerHTML += `<option value="${m}">${m}</option>`;
        }
        });
        const nextYear = new Date().getFullYear() + 1;
        months.innerHTML += `<option value="other">${nextYear} Months</option>`
    }
});

document.getElementById('selectEndDateWeekly').addEventListener('change', e => {


});
