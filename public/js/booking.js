const today = new Date();
today.setHours(0, 0, 0, 0);
let roomDetails;
let rateList;
let selectedDateGlobal;
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
    })
});

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
    const selectEndDateDiv = document.getElementById('selectEndDateDiv');

    const selectPaxHotdeskDiv = document.getElementById('selectPaxHotdeskDiv');

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

        selectRoomRatesDiv.classList.remove('d-none');
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
    if(selectedRate[0].rp_rate_description == 'Daily (12 Hours)' || selectedRate[0].rp_rate_description == 'Weekly' || selectedRate[0].rp_rate_description == 'Monthly' ){
        selectEndDateDiv.classList.remove('d-none');
    }else{
        selectEndDateDiv.classList.add('d-none');
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
            }
        }, error: xhr=> console.log(xhr.responseText)
    })
});
