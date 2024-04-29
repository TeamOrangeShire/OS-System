function purchasePlan(id, price, credit, hours, minutes, days, plan) {

  const service_id = document.getElementById('service_id');
  const balance = document.getElementById('radio2');
  const errorCredit = document.getElementById('errorCredit');
  service_id.value = id;


  const detailPrice = document.getElementById('detailPrice');
  const detailMinutes = document.getElementById('detailMinutes');
  const detailDays = document.getElementById('detailDays');
  const detailHours = document.getElementById('detailHours');
  const planName = document.getElementById('planName');

  detailPrice.textContent = price;
  detailHours.textContent = hours;
  detailMinutes.textContent = minutes;
  detailDays.textContent = days;
  planName.textContent = plan;
  const more = credit - price;
  if (more < 0) {
    balance.disabled = true;
    errorCredit.style.display = '';

    errorCredit.innerHTML = "<i class='bi bi-exclamation-triangle me-1'></i>" + 'Not Enough Credit to purchase the plan!' + ' You need ₱' + more + ' more';
  } else {
    balance.disabled = false;
    errorCredit.style.display = 'none';
  }

}

function confirmPurchase() {
  var radioButtons = document.getElementsByName("payment");
  var radioButtonChecked = false;

  for (var i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      radioButtonChecked = true;
      break;
    }
  }

  if (!radioButtonChecked) {
    alertify
      .alert("Warning!", "Please Select A mode of payment first before proceeding");
  } else {
    alertify.confirm("Confirm Purchase?", "Do you want to Purchase this plan?",
      function () {
        Subscribe();
      },
      function () {

      });
  }

}

function logOut(route, home, mobileHome) {
  var formData = $('form#customer_logOut').serialize();

  $.ajax({
    type: 'POST',
    url: route,
    data: formData,
    success: function (response) {
      if (/Mobi|Android/i.test(navigator.userAgent)) {
        window.location.href = mobileHome;
      } else {
        window.location.href = home;
      }

    },
    error: function (xhr) {

      console.log(xhr.responseText);
    }
  });
}

function startScan(scannedRoute, refreshURL) {

  document.getElementById('qrScanner').style.display = 'block';
  const formInput = document.getElementById('scannedQRCode');

  const html5QrCode = new Html5Qrcode('qrScanner');

  // Start QR code scanning
  html5QrCode.start(
    { facingMode: "environment" },
    {
      fps: 10, // Set frames per second (optional)
      qrbox: 250 // Set size of QR code scanning box (optional)
    },
    qrCodeMessage => {

      formInput.value = qrCodeMessage;
      SubmitScannedData(scannedRoute, refreshURL);
      html5QrCode.stop().then(ignore => {
        document.getElementById('qrScanner').style.display = 'none';
      }).catch(err => console.error(err));
    },
    errorMessage => {
      console.error('Error scanning QR code:', errorMessage);

    }
  );
}

function SubmitScannedData(route, refURL) {
  const loading = document.getElementById('loadingDiv');
  loading.style.display = 'flex';
  var formData = $('form#scannedDataHolder').serialize();

  $.ajax({
    type: 'POST',
    url: route,
    data: formData,
    success: function (response) {
      if (response.status === 'login') {
        document.getElementById('scanner').textContent = 'Scan to Log Out';
        loading.style.display = 'none';
        LoginStatusFetch(refURL);
      } else if (response.status === 'logout') {
        loading.style.display = 'none';
        const successData = document.getElementById('custom_success');
        successData.style.display = 'flex';
        DisplaySuccessModal(response.log_data);
      } else if (response.status === 'already_login') {
        loading.style.display = 'none';
        const already = document.getElementById('custom_login');
        already.style.display = 'flex';
      } else {
        loading.style.display = 'none';
        const errorData = document.getElementById('custom_error');
        errorData.style.display = 'flex';
      }
    },
    error: function (xhr) {

      console.log(xhr.responseText);
    }
  });
}

function LoginStatusFetch(url) {
  axios.get(url)
    .then(function (response) {

      const data = response.data.fetched;

      const login_status = document.getElementById('login_status');
      const login_date = document.getElementById('login_date');
      const login_start = document.getElementById('login_start');

      if (data === null) {
        login_status.innerHTML = '<i class="bi bi-x-square-fill text-danger"></i> Not Logged In ';
        login_date.textContent = 'N/A';
        login_start.textContent = 'N/A';

      } else {
        login_status.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Logged In';
        login_date.textContent = data.log_date;
        login_start.textContent = data.log_start_time;
      }
    })
    .catch(function (error) {
      console.error(error);
    });

}


function MoreInfoModal(url, type) {
  const login_status = document.getElementById('i_login_status');
  const login_date = document.getElementById('i_login_date');
  const login_start = document.getElementById('i_login_start');
  const login_end = document.getElementById('i_login_end');
  const login_total = document.getElementById('i_login_total');
  const login_payment = document.getElementById('i_login_payment');
  const login_mode = document.getElementById('i_login_mode');
  const login_final = document.getElementById('i_login_final_status');
  const paid_status = document.getElementById('i_paid_status');

  axios.get(url)
    .then(function (response) {
      const data = response.data.info;
      if (data.log_status === 0) {
        login_status.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Still Logged In';
        login_end.textContent = 'N/A';
        login_total.textContent = 'N/A';
        login_payment.textContent = 'N/A';
        login_mode.textContent = 'N/A';
        login_final.textContent = 'N/A';
        paid_status.textContent = 'N/A';
      } else {
        const time = timeDifference(data.log_start_time, data.log_end_time);
        const mode = data.log_transaction.split('-');
        switch (mode[1]) {
          case '1':
            login_mode.textContent = 'Cash';
            if (data.log_status === 1) {
              login_final.textContent = 'Unpaid';
              paid_status.textContent = 'Not Yet Available';
            }
            if (data.log_status === 2) {
              login_final.textContent = 'Paid';
              paid_status.textContent = formatDateTime(data.updated_at);
            }
            break;
          case '2':
            login_mode.textContent = 'Account Balance';
            login_final.textContent = 'Paid';
            paid_status.textContent = formatDateTime(data.updated_at);
            break;

        }

        login_status.innerHTML = '<i class="bi bi-x-square-fill text-danger"></i> Logged Out';
        login_end.textContent = data.log_end_time;
        login_total.textContent = time.hours + 'Hrs & ' + time.minutes + 'mins';
        login_payment.textContent = PaymentCalc(time.hours, time.minutes, type);
      }
      login_date.textContent = data.log_date;
      login_start.textContent = data.log_start_time;
    })
    .catch(function (error) {
      console.error(error);
    });
}

function formatDateTime(dateTimeString) {

  let dateTime = new Date(dateTimeString);

  let year = dateTime.getFullYear();
  let month = String(dateTime.getMonth() + 1).padStart(2, '0');
  let day = String(dateTime.getDate()).padStart(2, '0');
  let hours = String(dateTime.getHours()).padStart(2, '0');
  let minutes = String(dateTime.getMinutes()).padStart(2, '0');
  let seconds = String(dateTime.getSeconds()).padStart(2, '0');

  let formattedDateTime = year + '/' + month + '/' + day + ' - ' + hours + ':' + minutes + ':' + seconds;

  return formattedDateTime;
}



function LogHistory(url, getLogInfo, cust_type) {
  document.getElementById('custom_success').style.display = 'none';
  axios.get(url)
    .then(function (response) {
      const data = response.data.log;
      var html = [];
      data.forEach(dt => {
        const time = DisplayTime(dt.log_start_time, dt.log_end_time);
        html.push([
          dt.log_date,
          dt.log_start_time,
          dt.log_end_time,
          dt.log_end_time === '' ? '' : time,
          `<button data-bs-toggle="modal" data-bs-target="#MoreInfoLog" class="rounded-circle btn btn-primary" onclick="MoreInfoModal('${getLogInfo}?log_id=${dt.log_id}', '${cust_type}')">
        <i class="bi bi-info-circle-fill" style="font-size: 1.3rem"></i></button>`,
        ]);
      });

      if (!$.fn.DataTable.isDataTable('#historyBody')) {
        // If not initialized, then initialize the DataTable
        $('#historyBody').DataTable({
          responsive: true,
          select: true,
          data: html
        });
      } else {
        // If DataTable is already initialized, you can update its data
        var table = $('#historyBody').DataTable();
        table.clear().rows.add(html).draw();
      }

    })
    .catch(function (error) {
      console.error(error);
    });
}

function DisplayTime(start, end) {
  const time = timeDifference(start, end);
  const data = time.hours + 'hrs & ' + time.minutes + 'minutes';
  return data;
}

function goTo(url) {
  window.location.href = url;
}

function detectGoto(mobile, web) {
  if (/Mobi|Android/i.test(navigator.userAgent)) {
    window.location.href = mobile;
  } else {
    window.location.href = web;
  }
}
function CloseDataModals(element) {
  document.getElementById(element).style.display = 'none';
  location.reload();
}

function SnackBar(message) {
  const snackbar = document.getElementById('snackbar');
  const content = document.getElementById('snackbarContent');

  snackbar.style.display = '';
  content.textContent = message;

  setTimeout(() => {
    snackbar.style.animation = 'fadeOutSnackBar 0.7s';
    setTimeout(() => {
      snackbar.style.display = 'none';
    }, 700);
  }, 2000);
}


function UpdateTour(userChoice) {
  const route = document.getElementById('status_route').value;
  var formData = $('form#tour_status').serialize();
  console.log(formData);
  $.ajax({
    type: 'POST',
    url: route,
    data: formData,
    success: function (response) {
      if (response.status === 'success') {
        const formatString = userChoice + ' Tour is Finished';
        SnackBar(formatString);
      }
    },
    error: function (xhr) {

      console.log(xhr.responseText);
    }
  });
}

function SelectType(type) {

  const selection = document.getElementById('selectionPhase');
  const deciding = document.getElementById('decidingPhase');

  selection.style.animation = "phaseOut 0.4s";
  setTimeout(() => {
    selection.style.display = 'none';
    deciding.style.display = '';
    deciding.style.animation = 'phaseIn 0.4s';
  }, 400);


  document.getElementById('customerTypeSelected').value = type
  document.getElementById('spanTypeHolder').textContent = type;
}

function UpdateSelection(url) {
  alertify.confirm('Confirm Selection','Are you sure you want to chose', function () {
    var formData = $('form#typeChange').serialize();
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      success: function (response) {
        if (response.status === 'success') {
          location.reload();
        }
      },
      error: function (xhr) {
  
        console.log(xhr.responseText);
      }
    });
  }, function () {
    alertify.set('notifier','position', 'top-center');
    alertify.success('Cancelled');
  });
  
}

function BackToSelection() {
  const selection = document.getElementById('selectionPhase');
  const deciding = document.getElementById('decidingPhase');

  deciding.style.animation = "phaseOut 0.4s";
  setTimeout(() => {
    deciding.style.display = 'none';
    selection.style.display = '';
    selection.style.animation = 'phaseIn 0.4s';
  }, 400);

}


function UploadingPhase() {
  const uploading = document.getElementById('uploadingPhase');
  const deciding = document.getElementById('decidingPhase');

  deciding.style.animation = "phaseOut 0.4s";
  setTimeout(() => {
    deciding.style.display = 'none';
    uploading.style.display = '';
    uploading.style.animation = 'phaseIn 0.4s';
  }, 400);
}