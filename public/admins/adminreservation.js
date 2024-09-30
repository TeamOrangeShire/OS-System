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


    });

    $("#calendar").on("selectDate", function (event, newDate, oldDate) {
        const [month, day, year] = newDate.split("/");
        const formattedDate = `${year}-${month.padStart(2, "0")}-${day.padStart(
            2,
            "0"
        )}`; // "2024-09-17"
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
                $('#addEvent').modal('show');
                console.log(formattedDate)
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
                        multi.value+=email+','
                        if (email !== "") {
                            createTag(email);
                            emailInput.value = ""; // Clear input after creating the tag
                        }
                    }
                });
            }
        }
    });
});


function dynamicFuction(formId, routeUrl,process) {
    // Show the loader
    document.getElementById('roller').style.display = 'flex';

    // Serialize the form data
    var formData = $("form#" + formId).serialize();

    // Send the AJAX request
    $.ajax({
        type: "POST",
        url: routeUrl+"?process="+process,
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