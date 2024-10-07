window.onload = () => {
    loadCancellationReason();
}

function loadCancellationReason(){
    $.ajax({
        type: "GET",
        url: "/admin/reservation/getcancellationreason",
        dataType:"json",
        success: res=> {
            const select = document.getElementById('selectActiveCancellationReason');

            select.innerHTML = '<option value="" disabled selected>----Select Reasons------</option>';

            res.data.forEach( data=> {
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


document.getElementById('selectActiveCancellationReason').addEventListener('change', e =>{
    const textArea = document.getElementById('cancellationReasonActive');
    textArea.value = e.target.value;
});


function cancelReservationActive(id){
    document.getElementById('reservationIdActiveCancellation').value = id;
}

document.getElementById('submitReservationActiveCancellation').addEventListener('click', ()=>{
    document.getElementById('confirmCancellationActive').requestSubmit();
});

document.getElementById('confirmCancellationActive').addEventListener('submit', e => {
    e.preventDefault();
    const roller = document.getElementById('roller');

    roller.style.display = 'flex';

    $.ajax({
        type:"POST",
        url: "/admin/reservation/cancelreservationactive",
        data: $('#confirmCancellationActive').serialize(),
        success: res => {
            if(res.status == 'success'){
                toastr['success']("Reservation Cancelled");
                getActiveReservation();
                roller.style.display = 'none';

            }
        }, error: xhr=> console.log(xhr.responseText)
    });
});
