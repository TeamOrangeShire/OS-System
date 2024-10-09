function reserveData() {
    $.ajax({
        url: "/admin/getReservation", // URL of the PHP script
        method: "GET", // or 'POST'
        dataType: "json", // Expecting a JSON response
        success: function (response) {
       
            // Filter to get only active reservations for the specified room
            const activeReservations = response.data.filter(event => event.status === '0' && event.room_id === 0);
             $('#reservationDataTable').DataTable({
                destroy: true,
                data: activeReservations,
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
        }
    });
}