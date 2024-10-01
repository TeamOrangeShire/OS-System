$(document).ready(function () {

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
                            return '#ff8050';
                        case '1':
                            return '#63d867';
                        case '2':
                            return '#08f69c';
                        case '3':
                            return '#f60808';
                        case '4':
                            return '#f65f08';
                    }
                }
                const calendarEvents = response.data.map((event, index) => ({
                    id: `event${index + 1}`, // Generate a unique ID for each event
                    name: event.c_name, // Name of the person
                    description: `Reservation for ${event.c_name}`, // Custom description
                    date: [`"${event.start_date}"`, `"${event.end_date}"`], // Date range
                    type: 'reservation', // Custom type
                    color: getStatusColor(event.status)
                }));

                // Initialize the Evo Calendar with the events
                $("#calendar").evoCalendar({
                    theme: "Orange Coral", // Optional: default theme is "Midnight Blue"
                    language: "en", // Optional: default language is English
                    showSidebar: false,
                    calendarEvents: calendarEvents, // Use the dynamically generated events
                    
                });
                disableSundays()
                $('#calendar').on('selectMonth', function() {
                disableSundays(); // Call the function again when month changes
            });
            } else {
                console.error("Data is not an array:", response.data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });

    function disableSundays() {
    // Find all Sundays in the calendar
    $('.day').each(function() {
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

    $('#calendar').on('selectEvent', function (event, activeEvent) {
        // activeEvent contains details about the selected event
        const eventList = document.getElementsByClassName("event-list")[0];

        if (eventList) {
            // Create the event HTML
            const eventHTML = `
                <div class="event-container" role="button" data-event-index="event990">
                    <div class="event-icon">
                        <div class="event-bullet-reservation" style="background-color:#63d867"></div>
                    </div>
                    <div class="event-info">
                        <p class="event-title">Jpuabs</p>
                        <p class="event-desc">Reservation for Ubas</p>
                    </div>
                </div>
            `;

            // Set the innerHTML of the event list
            eventList.innerHTML = eventHTML;
        }

    });

    $("#calendar").on("selectDate", function (event, newDate, oldDate) {
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
        if (eventEmpty) {
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
        "07:00 AM", "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM","01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM",
        "07:00 PM", "08:00 PM", "09:00 PM", "10:00 PM", "11:00 PM", "12:00 AM","01:00 AM", "02:00 AM", "03:00 AM"
    ];
} else {
    // Times for other days
    times = [
        "07:00 AM", "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM","01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM",
        "07:00 PM", "08:00 PM", "09:00 PM", "10:00 PM", "11:00 PM", "12:00 AM","01:00 AM", "02:00 AM", "03:00 AM", "04:00 AM", "05:00 AM", "06:00 AM"
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
        <input type="number" class="form-control" value="1" name="customer_number" id="customer_number">
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
        <select class="form-control" id="customer_number" name="customer_number">
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

                                        // Loop through roomRate and check the rate description
                                        roomRate.forEach((rate) => {
                                            if (rate.rp_id == selectedValue) {
                                                const rateDescription = rate.rp_rate_description;

                                                if (rateDescription.includes("Daily") || rateDescription.includes("Weekly") || rateDescription.includes("Monthly")) {
                                                    // Append the 'End Date' field dynamically
                                                    const endDateField = `
                        <div class="col-md-12" id="endDateField">
                            <label for="datepicker2">End Date:</label>
                            <input type="date" class="form-control" id="datepicker2" name="end_date" placeholder="Select a date"> <!-- Use formattedDate -->
                            <small id="dateError2" class="form-text text-danger" style="display: none;"></small>
                        </div>
                    `;

                                                    // Use insertAdjacentHTML instead of innerHTML to avoid overwriting the container's existing content
                                                    if (!document.getElementById('endDateField')) {
                                                        container.insertAdjacentHTML('beforeend', endDateField);
                                                    }
                                                    document.getElementById('datepicker2').addEventListener('change', function () {
                    const selectedDate = new Date(this.value);  // Get the selected date
                    const currentDate = new Date(); // Get the current date

                    // Set current date to midnight (00:00:00) to avoid time discrepancies
                    currentDate.setHours(0, 0, 0, 0);

                    const dayOfWeek = selectedDate.getDay(); // Get the day of the week (0 = Sunday, 6 = Saturday)
                    const errorMessage = document.getElementById('dateError2');

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
            const eventList = document.getElementsByClassName("event-list")[0];

            if (eventList) {
                // Create the event HTML
                const eventHTML = `
                <div class="event-container" role="button" data-event-index="event990">
                    <div class="event-icon">
                        <div class="event-bullet-reservation" style="background-color:#63d867"></div>
                    </div>
                    <div class="event-info">
                        <p class="event-title">Add</p>
                        <p class="event-desc">-----------------------------------</p>
                    </div>
                </div>
            `;

                // Set the innerHTML of the event list
                eventList.innerHTML += eventHTML;
            }
        }
    });
});
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
    // document.getElementById('roller').style.display = 'flex';

    // // Serialize the form data
    // var formData = $("form#" + formId).serialize();

    // // Send the AJAX request
    // $.ajax({
    //     type: "POST",
    //     url: routeUrl + "?process=" + process,
    //     data: formData,
    //     success: function (response) {

    //         document.getElementById('roller').style.display = 'none';

    //     },
    //     error: function (xhr, status, error) {
    //         console.error(xhr.responseText);
    //         // You can also add custom error handling here if needed
    //     }
    // });
}