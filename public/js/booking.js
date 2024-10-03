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


$(document).ready(function () {


    let reservationData = [];
    $.ajax({
        type: "GET",
        url: "/admin/getReservation",
        dataType: "json",
        success: res => {

            res.data.forEach(data => {

                const reservation = {};
                if (data.room_id != 0 && data.status != 0) {
                    reservation.id = data.r_id;
                    reservation.name = `Meeting Room ${data.room_number}`;
                    reservation.date = data.start_date == data.end_date ? formatDateCal(data.start_date) : [formatDateCal(data.start_date), formatDateCal(data.end_date)];
                    reservation.type = "holiday";
                    reservation.description = data.start_date == data.end_date ? `${formatDateCal(data.start_date, 'display')} (Occupied)` : `${formatDateCal(data.start_date, 'display')} - ${formatDate(data.end_date, 'display')} (Occupied)`
                    reservation.color = getRoomColor(data.room_number);

                    reservationData.push(reservation);
                }


            });

            $('#calendars').evoCalendar({
                theme: "Orange Coral",
                calendarEvents: reservationData,
                'eventDisplayDefault': false,
                'eventListToggler': false,
            });
            disablePastDates(today);

        }, error: xhr => console.log(xhr.responseText)
    })




    $.ajax({
        type: "GET",
        url: "/user/reservation/getrooms",
        dataType: "json",
        success: res => {
            const select = document.getElementById('selectReserve');
            select.innerHTML = '<option value="" selected disabled>-----Reserve-----</option>';
            res.rooms.forEach(data => {
                select.innerHTML += `<option value="${data.room_id}">${data.room_number != 0 ? 'Meeting Room ' + data.room_number : 'Hotdesk'}</option>`
            });

            roomDetails = res.rooms;
            rateList = res.rates;
        }, error: xhr => console.log(xhr.responseText)
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

function getRoomColor(num) {
    switch (+num) {
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



function formatDateCal(dateString, type = 'render') {
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Split the input string by the hyphen to get year, month, and day
    const [year, month, day] = dateString.split('-');

    // Convert the month to the full month name
    const monthName = months[parseInt(month, 10) - 1];

    // Return the formatted date in "Month/day/year" format
    if (type == 'render') {
        return `${monthName}/${parseInt(day, 10)}/${year}`;
    } else {
        return `${monthName} ${parseInt(day, 10)}, ${year}`;
    }
}

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

$('#calendars').on('selectDate', function (event, newDate) {
    disablePastDates(today);
    // Parse the selected date string into a Date object
    const [month, day, year] = newDate.split("/").map(Number);
    const selectedDate = new Date(year, month - 1, day); // month is 0-indexed

    // Get the day of the week for the selected date (0 = Sunday, 6 = Saturday)
    const dayOfWeek = selectedDate.getDay();

    let reserveButton = '';

    switch (dayOfWeek) {
        case 1:
            reserveButton = AddReservationButtons(1, newDate);
            break;
        case 2:
            reserveButton = AddReservationButtons(2, newDate);
            break;
        case 3:
            reserveButton = AddReservationButtons(3, newDate);
            break;
        case 4:
            reserveButton = AddReservationButtons(4, newDate);
            break;
        case 5:
            reserveButton = AddReservationButtons(5, newDate);
            break;
        case 6:
            reserveButton = AddReservationButtons(6, newDate);
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


$('#calendars').on('selectMonth', function () {
    disablePastDates(today);
});

$('#calendars').on('selectYear', function () {
    setTimeout(() => {
        disablePastDates(today);
    }, 100);
});

// Function to disable past dates and Sundays by adding a custom class
function disablePastDates(today) {

    $('#calendars .day').each(function () {
        const dayDate = new Date($(this).attr('data-date-val'));
        dayDate.setHours(0, 0, 0, 0);

        // If the date is in the past or a Sunday, disable it
        if (dayDate < today || dayDate.getDay() === 0) {
            $(this).addClass('disabled-date'); // Add a custom class
            $(this).off('click'); // Disable click event for these dates
        } else {
            $(this).removeClass('disabled-date'); // Ensure enabled dates are not disabled
            $(this).on('click', function () {
            });
        }
    });
}


function AddReservationButtons(num, date) {

    let buttons = '';

    const mondayTime = [
        ['08:00 AM', false],
        ['09:00 AM', false],
        ['10:00 AM', false],
        ['11:00 AM', false],
        ['12:00 PM', false],
        ['01:00 PM', false],
        ['02:00 PM', false],
        ['03:00 PM', false],
        ['04:00 PM', false],
        ['05:00 PM', false],
        ['06:00 PM', false],
        ['07:00 PM', false],
        ['08:00 PM', false],
        ['09:00 PM', false],
        ['10:00 PM', false],
        ['11:00 PM', false],
        ['12:00 AM', false],
    ];

    const nonMondayTime = [
        ['01:00 AM', false],
        ['02:00 AM', false],
        ['03:00 AM', false],
        ['04:00 AM', false],
        ['05:00 AM', false],
        ['06:00 AM', false],
        ['07:00 AM', false],
        ['08:00 AM', false],
        ['09:00 AM', false],
        ['10:00 AM', false],
        ['11:00 AM', false],
        ['12:00 PM', false],
        ['01:00 PM', false],
        ['02:00 PM', false],
        ['03:00 PM', false],
        ['04:00 PM', false],
        ['05:00 PM', false],
        ['06:00 PM', false],
        ['07:00 PM', false],
        ['08:00 PM', false],
        ['09:00 PM', false],
        ['10:00 PM', false],
        ['11:00 PM', false],
        ['12:00 AM', false],
    ];

    const saturdayTime = [
        ['01:00 AM', false],
        ['02:00 AM', false],
        ['03:00 AM', false],
        ['04:00 AM', false],
        ['05:00 AM', false],
        ['06:00 AM', false],
        ['07:00 AM', false],
        ['08:00 AM', false],
        ['09:00 AM', false],
        ['10:00 AM', false],
        ['11:00 AM', false],
        ['12:00 PM', false],
        ['01:00 PM', false],
        ['02:00 PM', false],
        ['03:00 PM', false],
        ['04:00 PM', false],
        ['05:00 PM', false],
        ['06:00 PM', false],
        ['07:00 PM', false],
        ['08:00 PM', false],
        ['09:00 PM', false],
        ['10:00 PM', false],
        ['11:00 PM', false],
        ['12:00 AM', false],
        ['01:00 AM', false],
        ['02:00 AM', false],
        ['03:00 AM', false],
    ];

    const current = new Date();
    const currentTime = current.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true,
        timeZone: 'Asia/Manila'  // Set timezone to the Philippines
    });

    const currentDate = current.toLocaleDateString('en-US', {
        month: '2-digit',
        day: '2-digit',
        year: 'numeric',
        timeZone: 'Asia/Manila'
    });

    const getPastHours = (currentTime) => {
        // Parse the given time (current time)
        const time = new Date(`01/01/1970 ${currentTime}`);

        const pastHours = [];
        let currentHour = time.getHours();

        // Add the current hour and past hours in AM/PM format to the array
        for (let hour = 1; hour <= currentHour + 1; hour++) {
            let hourFormatted = (hour > 12) ? (hour - 12).toString() : hour.toString();  // Convert to 12-hour format
            let period = (hour >= 12) ? 'PM' : 'AM';

            // Handle special case for midnight and noon
            if (hour === 0) hourFormatted = '12';  // Midnight
            if (hour === 12) period = 'PM';        // Noon

            // Add leading zero for single-digit hours
            hourFormatted = hourFormatted.padStart(2, '0');

            pastHours.push(`${hourFormatted}:00 ${period}`);
        }

        return pastHours;
    };




    const add = (delay, data) => {
        return `<div onclick="selectReservationTime(this)" class="w-100 d-flex p-1 gap-1">
            <button ${data[1] ? 'disabled' : ''} class="btn btn-primary w-100 wow fadeInLeft select" data-wow-delay="${delay}s">${data[0]}</button>
            <button onclick="openReserveModal('${data[0]}')" class="btn btn-info d-none nextBtn" data-bs-toggle="modal" data-bs-target="#reserveModal" style="width:0%;">Proceed</button>
        </div>`
    }

    const disableTime = (timeList, disabledTimeList) => {
       return timeList.map(data => {
            if(disabledTimeList.includes(data[0])){
                data[1] = true;
            }

            return data;
        });
    }

    let delay = 0.01;
    if (num == 1) {

        if(currentDate == date){
           disableTime(mondayTime, getPastHours(currentTime));
        }

        mondayTime.forEach(data => {
            buttons += add(delay, data);
        });
    }

    if (num == 2 || num == 3 || num == 4 || num == 5) {
        if(currentDate == date){
            disableTime(nonMondayTime, getPastHours(currentTime));
        }

        nonMondayTime.forEach(data => {
            buttons += add(delay, data);
        });
    }

    if (num == 6) {
        if(currentDate == date){
            disableTime(saturdayTime, getPastHours(currentTime));
        }

        saturdayTime.forEach(data => {
            buttons += add(delay, data);

        });
    }


    return buttons;
}


function selectReservationTime(element) {

    const allSelect = document.querySelectorAll('.select');

    allSelect.forEach(data => {
        const classList = data.classList;
        const array = Array.from(classList);

        if (array.includes('w-50')) {
            data.nextElementSibling.classList.add('d-none');
            data.nextElementSibling.style.width = "0";
            data.classList.add('w-100');
            data.classList.remove('w-50');
        }
    });

    element.children[0].classList.remove('w-100');
    element.children[0].classList.add('w-50');

    element.children[1].classList.remove('d-none');
    element.children[1].style.width = "50%";
}

document.getElementById('selectReserve').addEventListener('change', () => {
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

    const endDateType = document.getElementById('endDateType');

    document.getElementById('hotdeskEndTimeDiv').classList.add('d-none');
    if (selectReserve.value != 0) {

        document.getElementById('submitReservation').disabled = true;

        selectPaxDiv.classList.remove('d-none');
        hotdeskDiv.classList.add('d-none');
        selectPaxHotdeskDiv.classList.add('d-none');
        const selectedRoom = roomDetails.filter(x => x.room_id == selectReserve.value);
        const selectPax = document.getElementById('selectPax');
        selectPax.innerHTML = '';
        for (let i = 0; i < +selectedRoom[0].room_capacity; i++) {
            selectPax.innerHTML += `<option>${i + 1}</option>`;
        }
        selectEndTime.disabled = false;
        selectEndTimeDiv.classList.remove('d-none');
        selectRoomRatesDiv.classList.remove('d-none');
        selectEndDateWeeklyDiv.classList.add('d-none');
        selectEndDateMonthlyDiv.classList.add('d-none');
        selectEndDateDiv.classList.add('d-none');
        const roomRates = rateList.filter(x => x.room_id == selectReserve.value);
        selectRoomRates.innerHTML = '';
        roomRates.forEach(data => {
            selectRoomRates.innerHTML += `<option value="${data.rp_id}">${data.rp_rate_description} (₱${data.rp_price})</option>`
        });

        endDateType.value = "Hourly";
    } else {

        document.getElementById('submitReservation').disabled = false;

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

        endDateType.value = "Hotdesk";

        selectEndDate.disabled = true;
        selectEndDateMonthly.disabled = true;
        selectEndDateWeekly.disabled = true;
        selectEndTime.disabled = true;

        hotdeskRates.forEach(data => {
            selectHotdesk.innerHTML += `<option value="${data.rp_id}">${data.rp_rate_description}</option>`;
        });

    }

});

document.getElementById('addGuestBtn').addEventListener('click', () => {
    const addGuestBtnDiv = document.getElementById('addGuestBtnDiv');
    const addGuestDiv = document.getElementById('addGuestDiv');

    addGuestBtnDiv.classList.add('d-none');
    addGuestDiv.classList.remove('d-none');
});


document.getElementById('selectRoomRates').addEventListener('change', (e) => {
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
        if (!element.classList.contains('d-none')) {
            element.classList.add('d-none');
        }
        input.disabled = true;
    }
    const submit = document.getElementById('submitReservation');
    hide(selectEndDateDiv, selectEndDate);
    hide(selectEndDateWeeklyDiv, selectEndDateWeekly);
    hide(selectEndDateMonthlyDiv, selectEndDateMonthly);
    hide(selectEndTimeDiv, selectEndTime);
    const endDateType = document.getElementById('endDateType');
    switch (selectedRate[0].rp_rate_description) {
        case "Daily (12 Hours)":
            selectEndDateDiv.classList.remove('d-none');
            selectEndDate.disabled = false;
            endDateType.value = "Daily";
            if (document.getElementById('selectEndDate').value == '') {
                submit.disabled = true;
            } else {
                submit.disabled = false;
            }

            break;
        case "Weekly":
            selectEndDateWeeklyDiv.classList.remove('d-none');
            selectEndDateWeekly.disabled = false;
            endDateType.value = "Weekly";
            submit.disabled = false;
            break;
        case "Monthly":
            selectEndDateMonthlyDiv.classList.remove('d-none');
            selectEndDateMonthly.disabled = false;
            endDateType.value = "Monthly";
            submit.disabled = false;
            break;
        case "Hourly":
            selectEndTimeDiv.classList.remove('d-none');
            selectEndTime.disabled = false;
            endDateType.value = "Hourly";

            if (document.getElementById('selectEndTime').value != "") {
                submit.disabled = false;
            } else {
                submit.disabled = true;
            }

            break;
        default:
            endDateType.value = "4 Hours";
            submit.disabled = false;
            break;
    }

});

function openReserveModal(time) {
    const selectedTimeModal = document.getElementById('selectedTimeModal');
    const selectDateModal = document.getElementById('selectedDateModal');

    selectDateModal.textContent = selectedDateGlobal;
    selectedTimeModal.textContent = time;

    document.getElementById('startDateReservation').value = selectedDateGlobal;
    document.getElementById('startTimeReservation').value = time;

    const selectReserve = document.getElementById('selectReserve');
    selectReserve.innerHTML = '<option value="" selected disabled>-----Reserve-----</option>';
    roomDetails.forEach(data => {
        selectReserve.innerHTML += `<option value="${data.room_id}">${data.room_number != 0 ? 'Meeting Room ' + data.room_number : 'Hotdesk'}</option>`
    });
    $.ajax({
        type: "GET",
        url: `/user/reservation/checkroomavailability?date=${selectedDateGlobal}`,
        dataType: "json",
        success: res => {

           res.rooms.forEach(d => {

            for (let i = 0; i < selectReserve.options.length; i++) {
                if (selectReserve.options[i].value == d) {
                    selectReserve.options[i].disabled = true;
                    selectReserve.options[i].textContent += '(Not Available)'
                }
            }
           })
        }, error: xhr => console.log(xhr.responseText)
    });
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
        type: "POST",
        url: '/user/reservation/submitreservation',
        data: $('#submitReservationForm').serialize(),
        success: res => {
            if (res.success) {
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
                document.getElementById('selectEndTimeDiv').classList.add('d-none');
                document.getElementById('selectEndDateWeeklyDiv').classList.add('d-none');
                document.getElementById('selectEndDateMonthlyDiv').classList.add('d-none');
                document.getElementById('hotdeskEndTimeDiv').classList.add('d-none');
                toastr["success"]("Reservation Submitted wait for the email for the response.")

                const selectBtn = document.querySelectorAll('.select');

                selectBtn.forEach(data => {
                    const classList = Array.from(data.classList);

                    if (classList.includes('w-50')) {
                        data.classList.remove('w-50');
                        data.classList.add('w-100');

                        const next = data.nextElementSibling;

                        next.classList.add('d-none');

                    }
                });
            }
        }, error: xhr => console.log(xhr.responseText)
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
    const timeSelect = document.getElementById('selectedTimeModal').textContent.trim(); // 12-hour format (e.g., "04:00 AM")
    const selectedTime = e.target.value; // 24-hour format (e.g., "05:00")

    // Function to convert 12-hour time format (e.g., "04:00 AM") to 24-hour time
    const convertTo24Hour = (timeStr) => {
        const [time, modifier] = timeStr.split(' ');
        let [hours, minutes] = time.split(':');

        if (modifier === 'AM' && hours === '12') {
            hours = '00'; // Handle 12 AM as 00 in 24-hour format
        } else if (modifier === 'PM' && hours !== '12') {
            hours = parseInt(hours, 10) + 12; // Handle PM conversion
        }

        return `${hours.padStart(2, '0')}:${minutes}`; // Return in 24-hour format
    };

    // Convert the `timeSelect` (e.g., "04:00 AM") to 24-hour format
    const convertedTime = convertTo24Hour(timeSelect);

    // Create a date object for `timeSelect`
    const now = new Date();
    const [selectedHoursInput, selectedMinutesInput] = selectedTime.split(':'); // Input time (e.g., "05:00")
    const [selectedHoursModal, selectedMinutesModal] = convertedTime.split(':'); // Converted time from `textContent`

    const inputTimeDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), selectedHoursInput, selectedMinutesInput);
    const modalTimeDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), selectedHoursModal, selectedMinutesModal);

    // Get the modal time plus 1 hour
    const modalTimePlusOneHour = new Date(modalTimeDate.getTime() + (1 * 60 * 60 * 1000)); // Adds 1 hour to `timeSelect` modal time

    // Compare `selectedTime` (input time) with the `timeSelect` + 1 hour (from the modal)
    if (inputTimeDate < modalTimePlusOneHour) {
        toastr["error"]("Invalid Time! The selected time must be at least one hour ahead of the selected reservation time.");
        document.getElementById('submitReservation').disabled = true;
    } else {
        document.getElementById('submitReservation').disabled = false;
    }
});



document.getElementById('selectEndDateMonthly').addEventListener('change', e => {
    const months = document.getElementById('selectEndDateMonthly');
    if (e.target.value === "other") {
        months.innerHTML = '';
        const nextYear = new Date().getFullYear() + 1;
        const currentYear = new Date().getFullYear();
        monthList.forEach(data => {
            months.innerHTML += `<option value="${data}-${nextYear}">${data} (${nextYear})</option>`
        });

        months.innerHTML += `<option value="back">Back to ${currentYear}</option>`
    } else if (e.target.value === 'back') {
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


document.getElementById('selectHotdesk').addEventListener('change', e => {
    document.getElementById('submitReservation').disabled = false;
    const hotdesk = document.getElementById('hotdeskEndTime');
    const hotdeskError = document.getElementById('errorHotdeskEndTime');
    hotdesk.value = 1;
    hotdesk.classList.remove('border', 'border-danger');
    hotdeskError.classList.add('d-none');

    if (e.target.options[e.target.selectedIndex].text.includes("Hourly")) {
        document.getElementById('hotdeskEndTimeDiv').classList.remove('d-none');
    } else {
        document.getElementById('hotdeskEndTimeDiv').classList.add('d-none');
    }
});


document.getElementById('hotdeskEndTime').addEventListener('input', e => {
    const hotdeskEndTime = document.getElementById('hotdeskEndTime');
    const hotdeskError = document.getElementById('errorHotdeskEndTime');
    if (e.target.value > 16) {
        hotdeskEndTime.classList.add('border', 'border-danger');
        hotdeskError.classList.remove('d-none');
        document.getElementById('submitReservation').disabled = true;
    } else {
        hotdeskEndTime.classList.remove('border', 'border-danger');
        hotdeskError.classList.add('d-none');
        document.getElementById('submitReservation').disabled = false;
    }
});


document.getElementById('selectEndDate').addEventListener('change', () => document.getElementById('submitReservation').disabled = false);
