function reserveData() {
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
            // Filter to get only active reservations for the specified room
            const activeReservations = response.data.filter(event => event.status === '1' && event.room_id === 0);
            
             $('#reservationDataTable').DataTable({
                destroy: true,
                data: activeReservations,
                columns: [
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                            <button type="button" class="btn btn-success" onclick="viewReservation('${row.r_id}','${row.room_id}','${row.room_number}','${row.start_date}','${row.end_date}','${row.start_time}','${row.end_time}','${row.c_name}','${row.c_email}','${row.phone_num}','${row.rp_price}','${row.rp_rate_description}','${row.transaction_id}')"><i class="fa fa-check" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-danger" onclick="cancelReservation('${row.r_id}','${row.room_id}','${row.room_number}','${row.start_date}','${row.end_date}','${row.start_time}','${row.end_time}','${row.c_name}','${row.c_email}','${row.phone_num}','${row.rp_price}','${row.rp_rate_description}')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            `
                        }
                    },
                    { data: 'transaction_id' },
                    { data: 'c_name' },
                    { data: 'c_email' },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const {
                                start_time,
                            } = row;
                            return `${Supp.parseDate(row.start_date)} <span style="color: #f53b23;">|</span> ${convertTo12HourFormat(start_time)} `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            const end_time = row.end_time
                            const final = end_time==''?'Not Set':convertTo12HourFormat(end_time)
                            return `${Supp.parseDate(row.end_date)} <span style="color: #f53b23;">|</span> ${final}`;
                        }
                    },
                ],
                "columnDefs": [
    { 
      "className": "text-center", 
      "targets": "_all"  // Applies to all columns
    }
  ]
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error); // Log any errors
            $("#result").html("<p>Error: " + error + "</p>");
        }
    });
}

function viewReservation(id, room_id, room, start_date, end_date, start_time, end_time, c_name, email, number, price, desc,transaction_id) {

alertify.confirm(
  'Log Reservation',
  `
<form id="customForm" method="POST">
    <div>
      <label for="input1">Reservation ID:</label>
      <input type="text" name="input1" id="input1" class="form-control" value="${transaction_id}" readonly/>
    </div>
    <div>
      <label for="input2">Customer Name:</label>
      <input type="text" name="input2" id="input2" class="form-control" value="${c_name}" readonly/>
    </div>
    <div>
      <label for="input3">Plan:</label>
      <input type="text" name="input3" id="input3" class="form-control" value="₱${price} | ${desc}" readonly/>
    </div>
    <div>
    <label for="input3">Customer Type:</label>
    <select class="form-control" name="customer_type">
    <option value="Regular">Regular</option>
    <option value="Student">Student</option>
    </select>
    </div>
    <input type="text" name="r_id" id="r_id" class="form-control" value="${id}" hidden readonly/>
</form>
  `,
  function() {
    // Serializing form data
    document.getElementById('roller').style.display = 'flex';

    // Serialize the form data
    var csrfToken = document.querySelector('input[name="_token"]').value;

    // Serialize the form data
    var formData = $('#customForm').serialize();
    
    // Append the CSRF token to serialized data
    formData += '&_token=' + csrfToken;
    // Send the AJAX request
    $.ajax({
        type: "POST",
        url: '/logReservation',
        data: formData,
        success: function (response) {
            console.log(response);
            document.getElementById('roller').style.display = 'none';
            if (response.status == 'error') {
                alertify.alert("Error", response.message);
            } else if (response.status == 'success') {

                if (response.reload && typeof window[response.reload] === 'function') {
                    window[response.reload](); // Safe dynamic function call
                }
                // $('#' + response.modal).modal('hide');
                alertify.alert("success", response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // You can also add custom error handling here if needed
        }
    });
    
    alertify.success('Form data logged to console');
  },
  function() {
    alertify.error('Action canceled');
  }
).set('labels', {ok:'Submit', cancel:'Cancel'});



}
// function dynamicFunction(formId, routeUrl, process) {
    
//     // const check = document.getElementById('dateSelected').value
//     // console.log('here')
//     // console.log(check)
//     document.getElementById('roller').style.display = 'flex';

//     // Serialize the form data
//     var formData = $("form#" + formId).serialize();

//     // Send the AJAX request
//     $.ajax({
//         type: "POST",
//         url: routeUrl + "?process=" + process,
//         data: formData,
//         success: function (response) {
//             document.getElementById('roller').style.display = 'none';
//             if (response.status == 'error') {
//                 alertify.alert("Error", response.message);
//             } else if (response.status == 'success') {

//                 if (response.reload && typeof window[response.reload] === 'function') {
//                     window[response.reload](); // Safe dynamic function call
//                 }
//                 $('#' + response.modal).modal('hide');
//                 alertify.alert("success", response.message);
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr.responseText);
//             // You can also add custom error handling here if needed
//         }
//     });
// }