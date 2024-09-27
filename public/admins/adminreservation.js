$(document).ready(function () {
    $("#calendar").evoCalendar({
        theme: "Orange Coral", // Optional: default theme is "Midnight Blue"
        language: "en", // Optional: default language is English
        calendarEvents: [
            {
                id: "bHay68s", // Event's ID (required)
                name: "New Year", // Event name (required)
                date: "September/15/2024", // Event date (required)
                type: "holiday", // Event type (required)
            },
            {
                id: "dsadasdzxc",
                name: "Vacation Leave",
                badge: "02/13 - 02/15", // Event badge (optional)
                date: ["September/1/2024", "September/15/2024"], // Date range
                description: `<h1>hello</h1>`, // Event description (optional)
                type: "event",
                color: "#63d867", // Event custom color (optional)
            },
        ], // Initialize with no events
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
                eventEmpty.innerHTML = `
          <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Cutomer Name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
          <label for="exampleInputEmail1">Guest Email(optional):</label>
          <div class="tag-input">
            <input type="text" class="form-control" id="emailInput" placeholder="Enter email and press Enter">
            </div>
            </div>
          <div class="form-group">
            <label for="">Contact No.</label>
            <input type="Number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Num....">
          </div>
          <div class="form-group">
            <div class="row">
            <div class="col-md-6">
            <label for="datepicker">Start Date:</label>
            <input type="date" class="form-control" id="datepicker" placeholder="Select a date" data-date-val="${formattedDate}"> <!-- Use formattedDate -->
            <small id="dateError" class="form-text text-danger" style="display: none;"></small>
            </div>
            <div class="col-md-6">
            <label for="datepicker">Start Time:</label>
            <input type="time" class="form-control" id="" placeholder="Select a date">
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-md-6">
            <label for="datepicker">End Date:</label>
            <input type="date" class="form-control" id="datepicker2" placeholder="Select a date"> <!-- Use formattedDate -->
            <small id="dateError2" class="form-text text-danger" style="display: none;"></small>
             </div>
            <div class="col-md-6">
            <label for="datepicker">End Time:</label>
            <input type="time" class="form-control" id="">
            </div>
            </div>
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Rooms</label>
            <select class="form-control" id="roomList">
            
            </select>
            </div>
           <button type="submit" class="btn btn-secondary col-12">Submit</button>
        </form>
        `;
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

                document.getElementById("datepicker2").addEventListener("change", function () {
                        const selectedDate = new Date(this.value); // Get the selected date
                        const currentDate = new Date(); // Get the current date

                        // Set current date to midnight (00:00:00) to avoid time discrepancies
                        currentDate.setHours(0, 0, 0, 0);

                        if (selectedDate < currentDate) {
                            // If the selected date is in the past
                            document.getElementById(
                                "dateError2"
                            ).style.display = "block";
                            this.value = ""; // Clear the invalid selection
                        } else {
                            // Hide the error message if the date is valid
                            document.getElementById(
                                "dateError2"
                            ).style.display = "none";
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
