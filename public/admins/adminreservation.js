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
            } else {
                console.error("Data is not an array:", response.data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        },
    });
    
    $('#calendar').on('selectEvent', function (event, activeEvent) {
        // activeEvent contains details about the selected event
        console.log('Selected Event:', activeEvent);
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
       
        const [month, day, year] = newDate.split("/");
        const formattedDate = `${year}-${month.padStart(2, "0")}-${day.padStart(2,"0")}`; // "2024-09-17"
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
    let timeHTML = `
        <style>
            /* Hide the next button by default */
            .next-btn {
                display: none; /* Initially hidden */
                font-size: 1rem; /* Adjust font size */
                padding: 1rem; /* Adjust padding */
                transition: all 0.3s ease; /* Smooth transition */
                width: 100%; /* Make it full width */
                margin-left: 10px; /* Space between buttons */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Add shadow */
            }

            /* Show the next button when clicking the time button */
            .time-btn.active + .next-btn {
                display: inline-block; /* Show next button */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Add shadow */
            }

            /* Style for the time buttons */
            .time-btn {
                font-size: 1rem; /* Adjust font size */
                padding: 1rem; /* Adjust padding */
                transition: all 0.3s ease; /* Smooth transition */
                width: 100%; /* Make it full width */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Add shadow */
            }

            /* For proper layout and positioning */
            .time-btn-wrapper {
                display: flex; /* Use flexbox for horizontal layout */
                width: 100%; /* Ensure wrapper is full width */
                align-items: center; /* Align items vertically center */
            }

            .col-6 {
                transition: all 0.4s ease; /* Smooth transition */
            }
        </style>
        <div id="time-buttons" class="d-flex flex-column justify-content-start align-items-center m-2" style="height: 100vh;">
    `;

    // Array of 12AM to 11PM times
    const times = [
        "1AM", "2AM", "3AM", "4AM", "5AM", "6AM", "7AM", "8AM", "9AM", "10AM", "11AM", "12PM",
        "1PM", "2PM", "3PM", "4PM", "5PM", "6PM", "7PM", "8PM", "9PM", "10PM", "11PM", "12AM"
    ];

    // Generate buttons for each time with next button
    times.forEach(time => {
        timeHTML += `
            <div class="time-btn-wrapper my-2 col-12">
                <button type="button" class="btn btn-primary time-btn">${time}</button>
                <button type="button" class="btn btn-secondary next-btn" data-toggle="modal" data-target="#addEvent">Next</button>
            </div>
        `;
    });

    timeHTML += `</div>`; // Closing the container div

    // Inject the generated HTML into the element
    name.innerHTML = timeHTML;

    // Add click event listener to each time button
    const timeButtons = document.querySelectorAll('.time-btn');

    timeButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const parent = this.parentElement;
                    const nextBtn = this.nextElementSibling;

                    // Check if the button is already active
                    if (this.classList.contains('active')) {
                        // Remove active class and reset the button
                        this.classList.remove('active');
                        parent.classList.remove('col-6'); // Reset column class
                        parent.classList.add('col-12'); // Reset to col-12
                        nextBtn.style.display = 'none'; // Hide the next button
                    } else {
                        // Remove active class and reset all buttons
                        timeButtons.forEach(b => {
                            b.classList.remove('active');
                            const parent = b.parentElement;
                            parent.classList.remove('col-6'); // Reset column class
                            parent.classList.add('col-12'); // Reset to col-12
                            const nextBtn = b.nextElementSibling;
                            if (nextBtn) nextBtn.style.display = 'none'; // Hide the next button
                        });

                        // Add active class to the clicked button
                        this.classList.add('active');
                        parent.classList.remove('col-12'); // Change to col-12
                        parent.classList.add('col-6'); // Change to col-6

                        // Show the next button beside the time button
                        nextBtn.style.display = 'inline-block'; // Show next button
                    }
                });
            });
}


                document.getElementById('datepicker').value = formattedDate;
                $.ajax({
                    url: "/admin/getRoomData", // URL of the PHP script
                    method: "GET", // or 'POST'
                    dataType: "json", // Expecting a JSON response
                    success: function (data) {
                        const response = data.data;
                        const select = document.getElementById("roomList");
                        let options = "";

                        response.forEach((element) => {
                            options += `<option value="${element.room_id}">${element.room_number}</option>`;
                        }); // Handle success
                        select.innerHTML = options;
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
        }else{
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


function dynamicFuction(formId, routeUrl, process) {
    // Show the loader
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

        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // You can also add custom error handling here if needed
        }
    });
}