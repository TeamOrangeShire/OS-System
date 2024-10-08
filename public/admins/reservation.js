window.onload = () => {
    loadCancellationReason();
    loadCompletDataTable();
}

function loadCancellationReason() {
    $.ajax({
        type: "GET",
        url: "/admin/reservation/getcancellationreason",
        dataType: "json",
        success: res => {
            const select = document.getElementById('selectActiveCancellationReason');

            select.innerHTML = '<option value="" disabled selected>----Select Reasons------</option>';

            res.data.forEach(data => {
                select.innerHTML += `<option value="${data.reason_message}">${data.reason_header}</option>`
            });

            select.innerHTML += ` <optgroup label="Reasons Management">
                                        <option value="addReason">+Add Reason</option>
                                        <option value="addReason">-Delete Reasons</option>
                                        <option value="addReason">~Edit Reasons</option>
                                        <optgroup>`;
        }
    })
}


document.getElementById('selectActiveCancellationReason').addEventListener('change', e => {
    const textArea = document.getElementById('cancellationReasonActive');
    textArea.value = e.target.value;
});


function cancelReservationActive(id) {
    document.getElementById('reservationIdActiveCancellation').value = id;
}

document.getElementById('submitReservationActiveCancellation').addEventListener('click', () => {
    document.getElementById('confirmCancellationActive').requestSubmit();
});

document.getElementById('confirmCancellationActive').addEventListener('submit', e => {
    e.preventDefault();
    const roller = document.getElementById('roller');

    roller.style.display = 'flex';

    $.ajax({
        type: "POST",
        url: "/admin/reservation/cancelreservationactive",
        data: $('#confirmCancellationActive').serialize(),
        success: res => {
            if (res.status == 'success') {
                toastr['success']("Reservation Cancelled");
                getActiveReservation();
                roller.style.display = 'none';

            }
        }, error: xhr => console.log(xhr.responseText)
    });
});
let dataTable;
function loadCompletDataTable() {
    $.ajax({
        type: "GET",
        url: "/admin/reservation/completetable",
        dataType: "json",
        success: res => {

            if (!$.fn.DataTable.isDataTable('#completeDataTable')) {
                dataTable = $('#completeDataTable').DataTable({
                    data: res.data,
                    columns: [
                        { title: 'Full Name', data: "c_name" },
                        { title: "Email", data: "c_email" },
                        {
                            title: "Room", data: null,
                            render: data => {
                                return `Room ${data.room_number}`
                            }
                        },
                        {
                            title: "Start", data: null,
                            render: data => {
                                return `${data.start_date} | ${data.start_time}`
                            }
                        },
                        {
                            title: "End", data: null,
                            render: data => {
                                return `${data.end_date} | ${data.end_time}`
                            }
                        },
                        {
                            title: "Action", data: null,
                            render: data => {
                                return `<button class="btn btn-primary">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg>
                                </button>`
                            }
                        }
                    ]
                });
            } else {
                dataTable.clear().rows.add(res.data).draw();
            }

        }, error: xhr => console.log(xhr.responseText)
    })
}

let cancelledDeniedDatatable;
function loadCancelledDenied(){
    $.ajax({
        type:"GET",
        url: "/admin/reservation/getcancelleddeniedreservation",
        dataType: "json",
        success: res=> {
            if($.fn.DataTable.isDataTable('#cancelledDeniedDataTable')){
                cancelledDeniedDatatable = $('#cancelledDeniedDataTable').DataTable({
                    data: res.data,
                    columns: [
                        {title: "Full Name", data: "c_name"},
                        {title: "Email", data: "c_email"},
                        {title: "Room", data: null,
                            render: data=> {
                                return `Room ${data.room_number}`
                            }
                        },
                        {title: "Start", data: null,
                            render: data=> {
                                return `${Supp.parseDate(data.start_date)}`
                            }
                        }
                    ]
                })
            }
        }, error: xhr=> console.log(xhr.responseText)
    });
}
