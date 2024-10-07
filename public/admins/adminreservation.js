let newDate3 = '';
$(document).ready(function () {
    loadCalendar()


    $('#calendar').on('selectEvent', function (event, activeEvent) {
        console.log('here')
        // activeEvent contains details about the selected event
        // const eventList = document.getElementsByClassName("event-list")[0];

        // if (eventList) {
        //     // Create the event HTML
        //     const eventHTML = `
        //         <div class="event-container" role="button" data-event-index="event990">
        //             <div class="event-icon">
        //                 <div class="event-bullet-reservation" style="background-color:#63d867"></div>
        //             </div>
        //             <div class="event-info">
        //                 <p class="event-title">Jpuabs</p>
        //                 <p class="event-desc">Reservation for Ubas</p>
        //             </div>
        //         </div>
        //     `;

        //     // Set the innerHTML of the event list
        //     eventList.innerHTML = eventHTML;
        // }

    });

    $("#calendar").on("selectDate", function (event, newDate, oldDate) {
        newDate3 = newDate;
        let satVal = 'false';
        var satdate = new Date(newDate); // Convert selected date string to a Date object
        if (satdate.getDay() === 6) { // 6 represents Saturday in getDay()
            satVal = 'true';
        }

        const [month, day, year] = newDate.split("/");
        const formattedDate = `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`; // "2024-09-17"
        // Create a Date object for the clicked date
        const clickedDate = new Date(year, month - 1, day); // month is 0-indexed in JavaScript
        const currentDate = new Date(); // Get the current date
        currentDate.setHours(0, 0, 0, 0); // Set to midnight
        // Check if clickedDate is less than currentDate
        const eventEmpty = document.querySelector(".event-empty");
        let con = true;
        if (eventEmpty) {
            con = false;
            if (clickedDate < currentDate) {
                // If clicked date is in the past, do not render the form
                eventEmpty.innerHTML =
                    "<p>This date is in the past. Please select a future date.</p>";
            } else {
                // Render the form if the date is today or in the future
                // $('#addEvent').modal('show');
                const name = document.getElementsByClassName("event-list")[0];

                if (name) {
                    let timeHTML = '';

                    // Declare the times array outside the condition block
                    let times = [];

                    // Array of times, you can customize this based on your needs
                    if (satVal === 'true') {
                        // Times for Saturday
                        times = [
                            "07:00 AM", "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM",
                            "07:00 PM", "08:00 PM", "09:00 PM", "10:00 PM", "11:00 PM", "12:00 AM", "01:00 AM", "02:00 AM", "03:00 AM"
                        ];
                    } else {
                        // Times for other days
                        times = [
                            "07:00 AM", "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM",
                            "07:00 PM", "08:00 PM", "09:00 PM", "10:00 PM", "11:00 PM", "12:00 AM", "01:00 AM", "02:00 AM", "03:00 AM", "04:00 AM", "05:00 AM", "06:00 AM"
                        ];
                    }

                    // Generate buttons for each time with the next button
                    times.forEach(time => {
                        timeHTML += `
        <div class="w-100 p-2 d-flex gap-2">
            <button type="button" class="w-100 btn btn-primary time-btn" onclick="selectTime(this)">${time}</button>
            <button type="button" class="w-50 btn btn-secondary d-none next-btn" onclick="viewForm('${newDate}','${time}')">Next</button>
        </div>
    `;
                    });

                    // Inject the generated HTML into the element
                    name.innerHTML = `<div class="w-100">${timeHTML}</div>`;
                }
                document.getElementById('datepicker').value = formattedDate;
                getResData()
                // Set the value of the date input to the formatted date
                const dateInput = eventEmpty.querySelector("#datepicker");
                if (dateInput) {
                    dateInput.value = formattedDate; // Assign the formatted date value+
                }

                document.getElementById('datepicker').addEventListener('change', function () {
                    const selectedDate = new Date(this.value);  // Get the selected date
                    const currentDate = new Date(); // Get the current date

                    // Set current date to midnight (00:00:00) to avoid time discrepancies
                    currentDate.setHours(0, 0, 0, 0);

                    const dayOfWeek = selectedDate.getDay(); // Get the day of the week (0 = Sunday, 6 = Saturday)
                    const errorMessage = document.getElementById('dateError');

                    if (selectedDate < currentDate) {
                        // If the selected date is in the past
                        errorMessage.style.display = 'block';
                        errorMessage.textContent = 'You cannot select a past date!';
                        this.value = '';  // Clear the invalid selection
                    } else if (dayOfWeek === 0) {
                        // If the selected date is a Sunday
                        errorMessage.style.display = 'block';
                        errorMessage.textContent = 'You cannot select a Sunday!';
                        this.value = '';  // Clear the invalid selection
                    } else {
                        // Hide the error message if the date is valid
                        errorMessage.style.display = 'none';
                    }
                });

                const emailInput = document.getElementById("emailInput");
                const tagInputDiv = document.querySelector(".tag-input");

                // Function to create a new tag
                function createTag(email) {
                    // Create the tag container
                    const tag = document.createElement("div");
                    tag.classList.add("tag");
                    tag.textContent = email;

                    // Create the remove button
                    const removeButton = document.createElement("span");
                    removeButton.textContent = "×";
                    removeButton.classList.add("remove-tag");
                    removeButton.onclick = function () {
                        tagInputDiv.removeChild(tag);
                        const multi = document.getElementById('multipleEmail');
                        multi.value = multi.value.split(',').filter(item => item.trim() !== email).join(', ').trim();
                    };

                    // Append the remove button to the tag
                    tag.appendChild(removeButton);

                    // Insert the tag before the input field
                    tagInputDiv.insertBefore(tag, emailInput);
                }

                // Event listener for the input field to create tags on Enter
                emailInput.addEventListener("keydown", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        const email = emailInput.value.trim();
                        const multi = document.getElementById('multipleEmail');
                        multi.value += email + ','
                        if (email !== "") {
                            createTag(email);
                            emailInput.value = ""; // Clear input after creating the tag
                        }
                    }
                });
            }
        } else {
            const eventList = document.getElementsByClassName("event-header")[0];

            if (eventList) {

                const eventList2 = document.querySelector('.event-list');

                if (eventList2 && eventList2.querySelector('.w-100')) {

                } else {

                    const [month, day, year] = newDate.split('/');
                    const monthNames = [
                        "January", "February", "March", "April", "May", "June", "July",
                        "August", "September", "October", "November", "December"
                    ];

                    // Convert the month number to month name and remove the leading zero from the day
                    const formattedDate = `${monthNames[parseInt(month) - 1]}${parseInt(day)}, ${year}`;


                    const eventHTML = `
        <div class="event-header" style="display: flex; justify-content: space-between; align-items: center;">
    <p style="margin: 0; font-size: 30px; font-weight: 600;">${formattedDate}</p>
    <button class="btn btn-primary time-btn" onclick="displayTimeHTML()"><svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h10" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg> Add New</button>
</div>

    `;

                    // Append the new event HTML
                    eventList.innerHTML = eventHTML;
                }
            }

        }
    });
});
function loadCalendar() {
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
            // Ensure response.data is an array
            if (Array.isArray(response.data)) {
                const getStatusColor = color => {
                    switch (color) {
                        case '0':
                            return '#ff8050'; // Pending
                        case '1':
                            return '#63d867'; // Approved
                        case '2':
                            return '#08f69c'; // Completed
                        case '3':
                            return '#f60808'; // Cancelled
                        case '4':
                            return '#f65f08'; // Rescheduled
                    }
                };

                // Filter the data to include only events with status = 1 (approved) and valid room
                const filteredData = response.data.filter(event => event.status === '1' && event.room_id != '0');

                // Generate the calendar events from the filtered data
                const calendarEvents = filteredData.map((event, index) => ({
                    id: `event${index + 1}`, // Generate a unique ID for each event
                    name: `Room ${event.room_number}`, // Name the event with room number
                    description: `Reservation for ${event.c_name}`, // Custom description
                    date: [`"${event.start_date}"`, `"${event.end_date}"`],
                    type: 'reservation', // Custom type for the event
                    color: getStatusColor(event.status) // Get color based on status
                }));
                // **Force Destroy** the existing calendar
                try {
                    $('#calendar').evoCalendar('destroy');
                } catch (e) {

                }

                // Initialize the Evo Calendar with the filtered events
                $("#calendar").evoCalendar({
                    theme: "Orange Coral", // Optional: default theme is "Midnight Blue"
                    language: "en", // Optional: default language is English
                    showSidebar: false,
                    calendarEvents: calendarEvents, // Use the dynamically generated events
                });

                // Disable Sundays function (if you have this function defined)
                disableSundays();

                // Add event listener for month change (optional)
                $('#calendar').on('selectMonth', function () {
                    disableSundays(); // Call disableSundays when the month changes
                });
            } else {
                console.error("Data is not an array:", response.data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        }
    });
}




function disableSundays() {
    // Find all Sundays in the calendar
    $('.day').each(function () {
        var date = new Date($(this).attr('data-date-val'));
        if (date.getDay() === 0) { // 0 means Sunday in JavaScript's getDay()
            $(this).css({
                'pointer-events': 'none',  // Disable clicking on Sundays
                'background-color': '#f5f5f5',  // Optional: grey out Sundays
                'color': '#ccc'  // Optional: Change text color to indicate it's disabled
            });
        }
    });
}
function getResData() {
    // Select the event-header element
    const eventHeader = document.querySelector('.event-header');

    // Check if there is a button with class 'btn' inside the event-header
    const button = eventHeader.querySelector('button.btn');

    if (button) {
        // If the button exists, remove it
        button.remove();
    }

    $.ajax({
        url: "/admin/getRoomData", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (data) {
            const response = data.room;
            const roomRate = data.rate;
            const select = document.getElementById("roomList");
            let options = `<option value="">---Reserve---</option>`;

            response.forEach((element) => {
                if (element.room_id == 0) {
                    options += `<option value="${element.room_id}">Hotdesk</option>`;
                } else {
                    options += `<option value="${element.room_id}">Room ${element.room_number}</option>`;
                }
            });

            select.innerHTML = options;

            function selectReserve(selectElement) {
                const selectedValue = selectElement.value;
                const container = document.getElementById("reserveContainer");
                if (selectedValue == "") {
                    container.innerHTML = "";
                }
                else if (selectedValue == '0') {
                    // Get the container to hold the input field
                    let result = `
    <div class="col-md-6">
        <label for="customer_number">Number of Customer</label>
        <input type="number" class="form-control" value="1" name="customer_count" id="customer_count">
    </div> 
    `;

                    result += `
    <div class="col-md-6">
        <label for="customer_bill">Select Rate Plan</label>
        <select class="form-control" id="customer_bill" name="customer_bill">
    `;

                    result += `<option value="0">Open Time</option>`;
                    roomRate.forEach((rate) => {
                        if (rate.room_id == 0) {
                            result += `<option value="${rate.rp_id}">${rate.rp_rate_description}</option>`;  // Add each option to the result
                        }
                    });

                    result += `
        </select>
    </div>
    `;
                    container.innerHTML = result;
                } else {
                    let result = `
    <div class="col-md-6">
        <label for="customer_number">Number of Customers</label>
        <select class="form-control" id="customer_count" name="customer_count">
`;

                    // Add customer number options based on selected room capacity
                    response.forEach((room) => {
                        if (selectedValue == room.room_id) {
                            const capacity = parseInt(room.room_capacity, 10);
                            for (let i = 1; i <= capacity; i++) {
                                result += `<option value="${i}">${i}</option>`;
                            }
                        }
                    });

                    result += `
        </select>
    </div>
`;

                    result += `
    <div class="col-md-6">
        <label for="customer_bill">Room Rate</label>
        <select class="form-control" id="customer_bill" name="customer_bill">
`;

                    // Add room rate options based on the selected room
                    roomRate.forEach((rate) => {
                        if (rate.room_id == selectedValue) {
                            result += `<option value="${rate.rp_id}">${rate.rp_rate_description} ₱${rate.rp_price}</option>`;
                        }
                    });

                    result += `
        </select>
    </div>
`;

                    // Inject the generated HTML into the container
                    container.innerHTML = result;

                    // Attach change event listener to the 'customer_bill' select element
                    const validate = document.getElementById("customer_bill");

                    if (validate) {
                        validate.addEventListener('change', function () {
                            const selectedValue = validate.value;
                            const existingEndDateField = document.getElementById('endDateField');
                            if (existingEndDateField) {
                                existingEndDateField.remove();
                            }
                            // Loop through roomRate and check the rate description
                            roomRate.forEach((rate) => {
                                if (rate.rp_id == selectedValue) {
                                    const rateDescription = rate.rp_rate_description;

                                    if (rateDescription.includes("Daily") || rateDescription.includes("Weekly") || rateDescription.includes("Monthly")) {
                                        // Append the 'End Date' field dynamically
                                        let endDateField = "";
                                        if (rateDescription.includes("Daily")) {
                                            endDateField = `
                        <div class="col-md-12" id="endDateField">
    <label for="datepicker2">End Date:</label>
    <input type="date" class="form-control" id="datepicker2" name="end_date" placeholder="Select a date" onchange="validateDays(this)">
    <small id="dateError2" class="form-text text-danger" style="display: none;"></small>
</div>

                    `;
                                        } else if (rateDescription.includes("Weekly")) {
                                            endDateField = `
                        <div class="col-md-12" id="endDateField">
    <label for="datepicker2">End Date:</label>
    <input type="week" class="form-control" id="datepicker2" name="end_date" placeholder="Select a date" onchange="validateWeek()">
    <small id="dateError2" class="form-text text-danger" style="display: none;"></small>
</div>

                    `;
                                        } else if (rateDescription.includes("Monthly")) {
                                            endDateField = `
                                            <div class="col-md-12" id="endDateField">
    <label for="datepicker2">End Date:</label>
    <input type="month" class="form-control" id="datepicker2" name="end_date" placeholder="Select a month" onchange="validateMonth()">
    <small id="dateError2" class="form-text text-danger" style="display: none;"></small>
</div>

                                            `;
                                        }
                                        // Use insertAdjacentHTML instead of innerHTML to avoid overwriting the container's existing content
                                        if (!document.getElementById('endDateField')) {
                                            container.insertAdjacentHTML('beforeend', endDateField);
                                        }
                                    } else {
                                        // Remove the 'End Date' field if it exists
                                        const existingEndDateField = document.getElementById('endDateField');
                                        if (existingEndDateField) {
                                            existingEndDateField.remove();
                                        }
                                    }
                                }
                            });
                        });
                    }
                }
            }
            // Add an event listener to the select element instead of using onchange in HTML
            select.addEventListener('change', function () {
                selectReserve(this);
            });
        },
        error: function (xhr, status, error) {
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });
}
function validateDays(inputElement) {
    const selectedDate = new Date(inputElement.value);  // Get the selected date from the input element
    const currentDate = new Date(); // Get the current date

    // Set current date to midnight (00:00:00) to avoid time discrepancies
    currentDate.setHours(0, 0, 0, 0);

    const dayOfWeek = selectedDate.getDay(); // Get the day of the week (0 = Sunday, 6 = Saturday)
    const errorMessage = document.getElementById('dateError2');

    if (selectedDate < currentDate) {
        // If the selected date is in the past
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'You cannot select a past date!';
        inputElement.value = '';  // Clear the invalid selection
    } else if (dayOfWeek === 0) {
        // If the selected date is a Sunday
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'You cannot select a Sunday!';
        inputElement.value = '';  // Clear the invalid selection
    } else {
        // Hide the error message if the date is valid
        errorMessage.style.display = 'none';
    }
}

function validateMonth() {
    const monthInput = document.getElementById('datepicker2');
    const selectedMonth = monthInput.value; // Format: YYYY-MM

    // Get the current month and year
    const now = new Date();
    const currentYear = now.getFullYear();
    const currentMonth = now.getMonth() + 1; // Months are 0-based

    // Split the selected month into year and month
    const [selectedYear, selectedMonthValue] = selectedMonth.split('-').map(Number);

    // Validate the selected month
    if (selectedYear < currentYear || (selectedYear === currentYear && selectedMonthValue < currentMonth)) {
        const dateError = document.getElementById('dateError2');
        dateError.textContent = "Please select a future month.";
        dateError.style.display = 'block';
        monthInput.value = ''; // Clear the input
    } else {
        // Clear any previous error message
        const dateError = document.getElementById('dateError2');
        dateError.style.display = 'none';
    }
}

function validateWeek() {
    const weekInput = document.getElementById('datepicker2');
    const errorMessage = document.getElementById('dateError2');

    // Get the selected week value
    const selectedWeek = weekInput.value;

    if (!selectedWeek) {
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Please select a week.';
        return;
    }

    // Get the current date and week
    const currentDate = new Date();
    const currentWeekNumber = getISOWeek(currentDate);
    const currentYear = currentDate.getFullYear();

    // Parse the selected week (format: YYYY-Www)
    const [selectedYear, selectedWeekNumber] = selectedWeek.split('-W').map(Number);

    // Check if the selected week is in the past
    if (selectedYear < currentYear || (selectedYear === currentYear && selectedWeekNumber < currentWeekNumber)) {
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'You cannot select a past week.';
        weekInput.value = ''; // Clear the input
    } else {
        errorMessage.style.display = 'none'; // Hide error message

    }
}

// Function to calculate the ISO week number
function getISOWeek(date) {
    const target = new Date(date);
    const dayNr = (date.getDay() + 6) % 7;
    target.setDate(target.getDate() - dayNr + 3);
    const firstThursday = target.valueOf();
    target.setMonth(0, 1);
    if (target.getDay() !== 4) {
        target.setMonth(0, 1 + ((4 - target.getDay()) + 7) % 7);
    }
    return 1 + Math.ceil((firstThursday - target) / 604800000);
}

function displayTimeHTML() {
    getResData()
    let satVal = 'false';
    const selectedDate = newDate3;  // Assuming the datepicker exists
    const dateObject = new Date(selectedDate);
    if (dateObject.getDay() === 6) { // 6 represents Saturday
        satVal = 'true';
    }

    const times = (satVal === 'true') ?
        [
            "07:00 AM", "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM",
            "07:00 PM", "08:00 PM", "09:00 PM", "10:00 PM", "11:00 PM", "12:00 AM", "01:00 AM", "02:00 AM", "03:00 AM"
        ] :
        [
            "07:00 AM", "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM",
            "07:00 PM", "08:00 PM", "09:00 PM", "10:00 PM", "11:00 PM", "12:00 AM", "01:00 AM", "02:00 AM", "03:00 AM", "04:00 AM", "05:00 AM", "06:00 AM"
        ];

    let timeHTML = '';

    // Generate HTML for time buttons
    times.forEach(time => {
        timeHTML += `
            <div class="w-100 p-2 d-flex gap-2">
                <button type="button" class="w-100 btn btn-primary time-btn" onclick="selectTime(this)">${time}</button>
                <button type="button" class="w-50 btn btn-secondary d-none next-btn" onclick="viewForm('${selectedDate}','${time}')">Next</button>
            </div>
        `;
    });

    // Inject the timeHTML into the appropriate container
    const name = document.getElementsByClassName("event-list")[0];
    if (name) {
        name.innerHTML = `<div class="w-100">${timeHTML}</div>`;
    }
}

function selectTime(element) {

    const timeBtns = document.querySelectorAll('.time-btn');

    timeBtns.forEach((btn) => {
        if (btn.classList.contains('w-50')) {
            const nextSibling = btn.nextElementSibling;

            btn.classList.remove('w-50');
            btn.classList.add('w-100');

            if (nextSibling) {  // Ensure nextElementSibling exists
                nextSibling.classList.add('d-none');
            }
        }
    });

    element.classList.remove('w-100');
    element.classList.add('w-50');
    const next = element.nextElementSibling;
    next.classList.remove('d-none')

}
function viewForm(date, time) {
    $('#addEvent').modal('show');

    // Reformat the date from MM/DD/YYYY to Month/DD/YYYY
    const [month, day, year] = date.split('/');
    const monthNames = [
        "January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"
    ];

    // Convert the month number to month name
    const formattedDate = `${monthNames[parseInt(month) - 1]} ${day}, ${year}`;

    // Set the formatted date and time in the form labels
    document.getElementById('formTimeLabel').textContent = time;
    document.getElementById('formDateLabel').textContent = formattedDate;

    // Select the input element for the time
    const timeInput = document.getElementById('start_time');

    // Call setTime function to set the time in the input
    setTime(timeInput, time);
    const dateInput = document.getElementById("datepicker");
    if (dateInput) {
        dateInput.value = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`; // Proper format for input type="date"
    }
}

function setTime(inputElement, time12h) {
    // Convert 12-hour format (01:00 AM) to 24-hour format (HH:MM)
    const [time, modifier] = time12h.split(' ');  // Split time and AM/PM
    let [hours, minutes] = time.split(':');  // Split hours and minutes

    if (modifier === 'PM' && hours !== '12') {
        hours = String(parseInt(hours) + 12);  // Convert PM times to 24-hour format
    }
    if (modifier === 'AM' && hours === '12') {
        hours = '00';  // Special case for 12 AM (midnight)
    }

    // Ensure hours and minutes are always 2 digits
    hours = hours.padStart(2, '0');
    minutes = minutes.padStart(2, '0');

    // Set the value to the input type="time"
    inputElement.value = `${hours}:${minutes}`;
}

function dynamicFuction(formId, routeUrl, process) {
    // Show the loader
    // hello
    // const check = document.getElementById('reschedDate').value
    // console.log('here')
    // console.log(check)
    document.getElementById('roller').style.display = 'flex';

    // Serialize the form data
    var formData = $("form#" + formId).serialize();

    // Send the AJAX request
    $.ajax({
        type: "POST",
        url: routeUrl + "?process=" + process,
        data: formData,
        success: function (response) {
            document.getElementById('roller').style.display = 'none';
            if (response.status == 'error') {
                alertify.alert("Error", response.message);
            } else if (response.status == 'success') {

                if (response.reload && typeof window[response.reload] === 'function') {
                    window[response.reload](); // Safe dynamic function call
                }
                $('#' + response.modal).modal('hide');
                alertify.alert("success", response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // You can also add custom error handling here if needed
        }
    });
}
function convertTo12HourFormat(time24) {
    // Split the time into hours and minutes
    let [hours, minutes] = time24.split(':');

    // Convert hours from string to number
    hours = parseInt(hours, 10);

    // Determine AM or PM suffix
    const ampm = hours >= 12 ? 'PM' : 'AM';

    // Convert 24-hour time to 12-hour format
    hours = hours % 12 || 12; // If hour is 0, change it to 12

    // Return the formatted time with AM/PM
    return `${hours}:${minutes} ${ampm}`;
}
function getCurrentDate() {
    const today = new Date(); // Get the current date
    const year = today.getFullYear(); // Get the full year (YYYY)
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Get the month (MM), adding 1 because months are 0-indexed
    const day = String(today.getDate()).padStart(2, '0'); // Get the day (DD)

    return `${year}-${month}-${day}`; // Return formatted date
}
function getPendingReservation() {
    if ($.fn.DataTable.isDataTable('#activeDataTable')) {
        $('#activeDataTable').DataTable().clear().destroy();
    }
    if ($.fn.DataTable.isDataTable('#GroupTable')) {
        $('#GroupTable').DataTable().clear().destroy();
    }
    loadCalendar()
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
            const pendingReservations = response.data.filter(event => event.status === '0');
            console.log(pendingReservations)
            $('#pendingDataTable').DataTable({
                destroy: true,
                data: pendingReservations,
                columns: [
                    { data: 'c_name' },
                    { data: 'c_email' },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const {
                                room_number,
                            } = row;
                            return `Room ${room_number} `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const {
                                start_date,
                                start_time,
                            } = row;
                            return `${start_date} <span style="color: #f53b23;">|</span> ${convertTo12HourFormat(start_time)} `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const {
                                end_date,
                                end_time,
                            } = row;
                            return `${end_date} <span style="color: #f53b23;">|</span> ${convertTo12HourFormat(end_time)} `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<button type="button" class="btn btn-primary" onclick="viewReservation('${row.r_id}','${row.room_id}','${row.room_number}','${row.start_date}','${row.end_date}','${row.start_time}','${row.end_time}','${row.c_name}','${row.c_email}','${row.phone_num}','${row.rp_price}','${row.rp_rate_description}')"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></button>`
                        }
                    }
                ]
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });
}
function getActiveReservation() {
    if ($.fn.DataTable.isDataTable('#pendingDataTable')) {
        $('#pendingDataTable').DataTable().clear().destroy();
    }
    if ($.fn.DataTable.isDataTable('#GroupTable')) {
        $('#GroupTable').DataTable().clear().destroy();
    }
    loadCalendar()
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
            const pendingReservations = response.data.filter(event => event.status === '1');
            $('#activeDataTable').DataTable({
                destroy: true,
                data: pendingReservations,
                columns: [
                    { data: 'c_name' },
                    { data: 'c_email' },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const {
                                room_number,
                            } = row;
                            return `Room ${room_number} `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const {
                                start_date,
                                start_time,
                            } = row;
                            return `${start_date} <span style="color: #f53b23;">|</span> ${convertTo12HourFormat(start_time)} `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const {
                                end_date,
                                end_time,
                            } = row;
                            return `${end_date} <span style="color: #f53b23;">|</span> ${convertTo12HourFormat(end_time)} `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<button type="button" class="btn btn-primary" onclick="viewReservation('${row.r_id}','${row.room_id}','${row.room_number}','${row.start_date}','${row.end_date}','${row.start_time}','${row.end_time}','${row.c_name}','${row.c_email}','${row.phone_num}','${row.rp_price}','${row.rp_rate_description}')"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></button>`
                        }
                    }
                ]
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });
}
function viewReservation(id, room_id, room, start_date, end_date, start_time, end_time, c_name, email,number,price,desc) {
    $('#viewReservation').modal('show');
    document.getElementById('r_id').value = id;
    document.getElementById('namelabel').textContent = c_name;
    document.getElementById('emaillabel').textContent = email;
    document.getElementById('cardTitle').textContent = 'Room ' + room;
    document.getElementById('roomrateLabel').textContent =desc +' '+ '₱'+price;
    document.getElementById('numberLabel').textContent = number;
    document.getElementById('startDatelabel').textContent = start_date;
    document.getElementById('endDatelabel').textContent = end_date;
    document.getElementById('startTimelabel').textContent = convertTo12HourFormat(start_time);
    document.getElementById('endTimelabel').textContent = convertTo12HourFormat(end_time);

    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
            const activeReservations = response.data.filter(event => event.status === '1');

            // Convert the provided start and end times to Date objects for comparison
            const newStartDate = new Date(start_date);
            const newEndDate = new Date(end_date);

            let conflict = false;

            // Loop through active reservations to check for date conflicts
            if (start_date < getCurrentDate()) {
                conflict = true;
            } else {
                activeReservations.forEach(reservation => {
                    const existingStartDate = new Date(reservation.start_date);
                    const existingEndDate = new Date(reservation.end_date);

                    // Check if the new reservation overlaps with an existing reservation
                    if (
                        (newStartDate <= existingEndDate && newEndDate >= existingStartDate && reservation.room_id == room_id) || (newStartDate == existingStartDate && newEndDate == existingEndDate && reservation.room_id == room_id)
                    ) {
                        conflict = true;
                    }
                });
            }
            const card = document.getElementById('reserveCard');
            if (conflict) {
                if (card) {
                    card.style.backgroundColor = "#f97a6e";
                    card.style.border = "1.5px solid red"; // This sets the border width, style, and color
                    card.style.borderRadius = "6px";
                    document.getElementById('innerCard2').style.display = "";
                    document.getElementById('innerCard1').style.display = "none";
                } else {

                    console.error("Element with id 'reserveCard' not found");
                }
            } else {
                if (card) {
                    card.style.backgroundColor = "";
                    card.style.border = ""; // This sets the border width, style, and color
                    card.style.borderRadius = "";
                    document.getElementById('innerCard2').style.display = "none";
                    document.getElementById('innerCard1').style.display = "";
                } else {

                    console.error("Element with id 'reserveCard' not found");
                }
                // Proceed with other actions if no conflict
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });
}
function cancelReservation() {
    $('#viewReservation').modal('hide');
    $('#viewCancelReservation').modal('show');
    const r_id = document.getElementById('r_id').value;
    const name = document.getElementById('namelabel').textContent
    const email = document.getElementById('emaillabel').textContent
    const room = document.getElementById('cardTitle').textContent
    document.getElementById('cancel_cardTitle').textContent = room
    document.getElementById('cancel_namelabel').value = name
    document.getElementById('cancel_emaillabel').value = email
    document.getElementById('c_r_id').value = r_id;
}
function reschedReserve() {
    $('#viewReservation').modal('hide');
    $('#viewReschedReservation').modal('show');
    document.getElementById('c_r_id').value = document.getElementById('r_id').value;
    document.getElementById('resched_namelabel').value = document.getElementById('namelabel').textContent
    document.getElementById('resched_emaillabel').value = document.getElementById('emaillabel').textContent
    document.getElementById('resched_cardTitle').textContent = document.getElementById('cardTitle').textContent
    $.ajax({
        url: "/admin/getRoomData", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
            const roomSelect = document.getElementById("roomSelect");
            const rateSelect = document.getElementById("rateSelect");
            // Clear previous options
            roomSelect.innerHTML = '<option value="">Select Room</option>';
            // Populate the select element with room data
            response.room.forEach(event => {
                if (event.room_capacity > 0) { // Only include rooms with capacity > 0
                    const option = document.createElement("option");
                    option.value = event.room_number; // Set value to room number
                    option.textContent = `Room ${event.room_number} (Capacity: ${event.room_capacity})`; // Set the display text with capacity
                    roomSelect.appendChild(option); // Add option to the select element
                }
            });
            function roomRateSelect(elem) {
                rateSelect.innerHTML =``;
                if(elem.value==''){
                    rateSelect.innerHTML =`<option value="">Select Room First</option>`;
                }else{
                    const filteredRates = response.rate.filter(event => event.room_id == elem.value);
                    rateSelect.innerHTML =`<option value="">Select Rate</option>`;
                filteredRates.forEach(event => {
                    const option = document.createElement("option");
                    option.value = event.rp_id; // Set value to room number
                    option.textContent = `${event.rp_rate_description} (Price: ₱${event.rp_price})`; // Set the display text with capacity
                    rateSelect.appendChild(option);
                });
                }
            }
            const container = document.getElementById("reschedField");
             rateSelect.addEventListener('change', function () {
                            const selectedValue = rateSelect.value;
                            // Loop through roomRate and check the rate description
                            response.rate.forEach((rate) => {
                                if (rate.rp_id == selectedValue) {
                                 
                                    const rateDescription = rate.rp_rate_description;
                                    if (rateDescription.includes("Daily") || rateDescription.includes("Weekly") || rateDescription.includes("Monthly")) {
                                        // Append the 'End Date' field dynamically
                                        let endDateField = "";
                                        if (rateDescription.includes("Daily")) {
                                            checkRoomSchedByDay()
                                           } else if (rateDescription.includes("Weekly")) {
                                            checkRoomSchedByWeek()
                                         } else if (rateDescription.includes("Monthly")) {
                                            checkRoomSchedByMonths()
                                        }
                                       
                                    } else {
                                     checkRoomSchedByHour()
                                    }
                                }
                            });
                        });

            roomSelect.addEventListener('change', function () {
                roomRateSelect(this);
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });
}
function checkRoomSchedByHour() {
    const roomNumber = parseInt(document.getElementById('roomSelect').value, 10);
    
    // Clear the date fields
    document.getElementById('reschedDate').value = '';
    document.getElementById('reschedDate2').value = '';

    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
            // Filter to get only active reservations for the specified room
            const activeReservations = response.data.filter(event => event.status === '1' && event.room_number === roomNumber);
            const disabledDates = []; // Array to hold disabled dates

            // Process active reservations to populate the disabledDates array
            if (activeReservations.length > 0) {
                activeReservations.forEach(reservation => {
                    const startDate = new Date(reservation.start_date);
                    const endDate = new Date(reservation.end_date);

                    // Push dates into the disabledDates array
                    let currentDate = startDate;
                    while (currentDate <= endDate) {
                        disabledDates.push($.datepicker.formatDate('yy-mm-dd', currentDate));
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                });
            }

            // Destroy any existing datepicker instances
            $("#reschedDate").datepicker("destroy");
            $("#reschedDate2").datepicker("destroy");

            // Initialize the start datepicker
            $("#reschedDate").datepicker({
                beforeShowDay: function (date) {
                    const string = $.datepicker.formatDate('yy-mm-dd', date);
                    return [disabledDates.indexOf(string) === -1, '']; // Disable dates in the array
                },
                minDate: 0, // Disable past dates
                onSelect: function(dateText) {
                    // When a start date is selected, set the same value for the end date
                    $("#reschedDate2").val(dateText); // Set the end date to the same value as the start date
                }
            });

            // Initialize the end datepicker
            $("#reschedDate2").datepicker({
                beforeShowDay: function (date) {
                    const string = $.datepicker.formatDate('yy-mm-dd', date);
                    return [disabledDates.indexOf(string) === -1, '']; // Disable dates in the array
                },
                minDate: 0 // Disable past dates
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        }
    });
}

function checkRoomSchedByDay() {
    const roomNumber = parseInt(document.getElementById('roomSelect').value, 10);
     document.getElementById('reschedDate').value=''
    document.getElementById('reschedDate2').value=''
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {

            // Filter to get only active reservations for the specified room
            const activeReservations = response.data.filter(event => event.status === '1' && event.room_number === roomNumber);
            // Get an array of date ranges to disable
            const disabledDates = [];

            // If there are active reservations, process them
            if (activeReservations.length > 0) {
                activeReservations.forEach(reservation => {
                    const startDate = new Date(reservation.start_date);
                    const endDate = new Date(reservation.end_date);

                    // Push dates into the disabledDates array
                    let currentDate = startDate;
                    while (currentDate <= endDate) {
                        disabledDates.push($.datepicker.formatDate('yy-mm-dd', currentDate));
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                });
            }
            $("#reschedDate").datepicker("destroy");
            // Initialize the datepicker
            $("#reschedDate").datepicker({
                beforeShowDay: function (date) {
                    const string = $.datepicker.formatDate('yy-mm-dd', date);
                    return [disabledDates.indexOf(string) === -1, '']; // Disable dates in the array
                },
                minDate: 0 // Disable past dates
            });
            $("#reschedDate2").datepicker("destroy");
            // Initialize the datepicker
            $("#reschedDate2").datepicker({
                beforeShowDay: function (date) {
                    const string = $.datepicker.formatDate('yy-mm-dd', date);
                    return [disabledDates.indexOf(string) === -1, '']; // Disable dates in the array
                },
                minDate: 0 // Disable past dates
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });
}
function checkRoomSchedByWeek() {
    const roomNumber = parseInt(document.getElementById('roomSelect').value, 10);
    document.getElementById('reschedDate').value=''
    document.getElementById('reschedDate2').value=''
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {

            // Filter to get only active reservations for the specified room
            const activeReservations = response.data.filter(event => event.status === '1' && event.room_number === roomNumber);
            
            // Get an array of date ranges to disable (reserved dates)
            const disabledDates = [];

            // If there are active reservations, process them
            if (activeReservations.length > 0) {
                activeReservations.forEach(reservation => {
                    const startDate = new Date(reservation.start_date);
                    const endDate = new Date(reservation.end_date);

                    // Push dates into the disabledDates array
                    let currentDate = startDate;
                    while (currentDate <= endDate) {
                        disabledDates.push($.datepicker.formatDate('mm/dd/yy', currentDate));
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                });
            }
            $("#reschedDate").datepicker("destroy");
            // Initialize the datepicker to disable conflicting dates and allow week selection
            $("#reschedDate").datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                firstDay: 0,  // Week starts on Sunday (0 = Sunday, 1 = Monday)
                dateFormat: 'mm/dd/yy',
                minDate: 0, // Disable past dates
                beforeShowDay: function (date) {
                    const dateString = $.datepicker.formatDate('mm/dd/yy', date);
                    
                    // Disable dates if they are in the disabledDates array
                    const isDisabled = disabledDates.indexOf(dateString) !== -1;

                    return [!isDisabled, isDisabled ? "disabled" : ""];
                },
                onSelect: function (selectedDate) {
                    let date = new Date(selectedDate);

                    // Use the selected date as the starting point of the week
                    let startOfWeek = new Date(date);  // The selected date is the start of the week
                    let endOfWeek = new Date(startOfWeek);
                    endOfWeek.setDate(startOfWeek.getDate() + 6); // End of week (7 days later)

                    // Format the start and end date
                    let formattedStartDate = $.datepicker.formatDate('mm/dd/yy', startOfWeek);
                    let formattedEndDate = $.datepicker.formatDate('mm/dd/yy', endOfWeek);

                    // Check for conflicts within the week
                    let hasConflict = false;
                    for (let d = startOfWeek; d <= endOfWeek; d.setDate(d.getDate() + 1)) {
                        const weekDateString = $.datepicker.formatDate('mm/dd/yy', d);
                        if (disabledDates.indexOf(weekDateString) !== -1) {
                            hasConflict = true;
                            break;
                        }
                    }

                    if (hasConflict) {
                        alert(`Conflict! Some dates in the week from ${formattedStartDate} to ${formattedEndDate} are reserved.`);
                        document.getElementById('reschedBtn').disabled = true;
                    } else {
                        $("#reschedDate").val(formattedStartDate);
                        $("#reschedDate2").val(formattedEndDate);
                        document.getElementById('reschedBtn').disabled = false;
                    }
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        }
    });
}
function checkRoomSchedByMonths() {
    const roomNumber = parseInt(document.getElementById('roomSelect').value, 10);
    document.getElementById('reschedDate').value=''
    document.getElementById('reschedDate2').value=''
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {

            // Filter to get only active reservations for the specified room
            const activeReservations = response.data.filter(event => event.status === '1' && event.room_number === roomNumber);
            
            // Get an array of date ranges to disable (reserved dates)
            const disabledDates = [];

            // If there are active reservations, process them
            if (activeReservations.length > 0) {
                activeReservations.forEach(reservation => {
                    const startDate = new Date(reservation.start_date);
                    const endDate = new Date(reservation.end_date);

                    // Push dates into the disabledDates array
                    let currentDate = startDate;
                    while (currentDate <= endDate) {
                        disabledDates.push($.datepicker.formatDate('mm/dd/yy', currentDate));
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                });
            }
            $("#reschedDate").datepicker("destroy");
            // Initialize the datepicker to select by month but display days
            $("#reschedDate").datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'mm/dd/yy',  // Format to select month and day
                minDate: 0, // Disable past dates
                beforeShow: function(input, inst) {
                    $(inst.dpDiv).addClass('monthpicker'); // Add a class for styling if needed
                },
                onClose: function(dateText, inst) {
                    const selectedDate = $(this).datepicker("getDate");
                    if (selectedDate) {
                        const selectedDay = selectedDate.getDate();
                        const selectedMonth = selectedDate.getMonth();
                        const selectedYear = selectedDate.getFullYear();

                        const startOfSelection = new Date(selectedYear, selectedMonth, selectedDay);
                        const endOfSelection = new Date(startOfSelection); // Copy start date
                        endOfSelection.setDate(startOfSelection.getDate() + 29); // Extend for 29 days

                        // Format the start and end date
                        let formattedStartDate = $.datepicker.formatDate('mm/dd/yy', startOfSelection);
                        let formattedEndDate = $.datepicker.formatDate('mm/dd/yy', endOfSelection);

                        // Check for conflicts within the selection period
                        let hasConflict = false;
                        for (let d = startOfSelection; d <= endOfSelection; d.setDate(d.getDate() + 1)) {
                            const monthDateString = $.datepicker.formatDate('mm/dd/yy', d);
                            if (disabledDates.indexOf(monthDateString) !== -1) {
                                hasConflict = true;
                                break;
                            }
                        }

                        if (hasConflict) {
                            alert(`Conflict! Some dates from ${formattedStartDate} to ${formattedEndDate} are reserved.`);
                            document.getElementById('reschedBtn').disabled = true;
                        } else {
                            $("#reschedDate").val(formattedStartDate); // Set the start date
                            $("#reschedDate2").val(formattedEndDate); // Set the end date
                            document.getElementById('reschedBtn').disabled = false;
                        }
                    }
                },
                beforeShowDay: function (date) {
                    const dateString = $.datepicker.formatDate('mm/dd/yy', date);
                    
                    // Disable dates if they are in the disabledDates array
                    const isDisabled = disabledDates.indexOf(dateString) !== -1;

                    return [!isDisabled, isDisabled ? "disabled" : ""];
                },
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        }
    });
}

$(document).ready(function () {
    getPendingReservation()
});
