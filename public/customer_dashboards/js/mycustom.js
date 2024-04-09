function purchasePlan(id, price, credit, hours, minutes, days, plan){

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
    if (more < 0){
        balance.disabled = true;
        errorCredit.style.display = '';
     
        errorCredit.innerHTML = "<i class='bi bi-exclamation-triangle me-1'></i>" +'Not Enough Credit to purchase the plan!' + ' You need ₱' + more + ' more';
    }else{
        balance.disabled = false;
        errorCredit.style.display = 'none';
    }

}

function confirmPurchase(){
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
  .alert("Warning!","Please Select A mode of payment first before proceeding");
    }else{
        alertify.confirm("Confirm Purchase?","Do you want to Purchase this plan?",
        function(){
          Subscribe();
        },
        function(){
          
        });
    }

}

function logOut(route, home) {
  var formData = $('form#customer_logOut').serialize();

  $.ajax({
      type: 'POST',
      url: route,
      data: formData,
      success: function(response) {
        window.location.href = home;
      }, 
      error: function (xhr) {

          console.log(xhr.responseText);
      }
  });
}

function startScan(scannedRoute, refreshURL, userType) {

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
        SubmitScannedData(scannedRoute, refreshURL, userType);
        html5QrCode.stop().then(ignore => {
          document.getElementById('qrScanner').style.display = 'none';
        }).catch(err => console.error(err));
      },
      errorMessage => {
        console.error('Error scanning QR code:', errorMessage);
        
      }
    );
  }

  function SubmitScannedData(route, refURL, type){
    const loading = document.getElementById('loadingDiv');
    loading.style.display = 'flex';
    var formData = $('form#scannedDataHolder').serialize();
  
    $.ajax({
        type: 'POST',
        url: route,
        data: formData,
        success: function(response) {
          if(response.status === 'success'){
            loading.style.display = 'none';
            LoginStatusFetch(refURL, type);
          }
        }, 
        error: function (xhr) {
  
            console.log(xhr.responseText);
        }
    });
  }

  function LoginStatusFetch(url, type){
    axios.get(url)
        .then(function (response) {

          const data = response.data.fetched;
          
          const login_status = document.getElementById('login_status');
          const login_date = document.getElementById('login_date');
          const login_start = document.getElementById('login_start');
          const login_end = document.getElementById('login_end');
          const login_total = document.getElementById('login_total');
          const login_payment = document.getElementById('login_payment');
          const login_mode = document.getElementById('login_mode');
          const login_final = document.getElementById('login_final_status');
          if(data === null){
            login_status.textContent = 'Not Logged In';
            login_date.textContent = 'N/A';
            login_start.textContent = 'N/A';
            login_end.textContent = 'N/A';
            login_total.textContent = 'N/A';
            login_payment.textContent = 'N/A';
            login_mode.textContent = 'N/A';
            login_final.textContent = 'N/A';
          }else{
            login_status.textContent = 'Logged In';
            login_date.textContent = data.log_date;
            login_start.textContent = data.log_start_time;
            switch(data.log_status){
              case 1:
                var diff = timeDifference(data.log_start_time, data.log_end_time);
                login_end.textContent = data.log_end_time;
                login_total.textContent = `${diff.hours}Hrs & ${diff.minutes}Minutes`;
                var payment = PaymentCalc(diff.hours, diff.minutes, type);
                login_payment.textContent = payment;
                login_mode.textContent = 'Cash';
                login_final.textContent = 'Unpaid/Pending Payment';
                break;
              case 2:
                var diff = timeDifference(data.log_start_time, data.log_end_time);
                login_end.textContent = data.log_end_time;
                login_total.textContent = `${diff.hours}Hrs & ${diff.minutes}Minutes`;
                var payment = PaymentCalc(diff.hours, diff.minutes, type);
                login_payment.textContent = payment;
                login_mode.textContent = 'Account Credit';
                login_final.textContent = 'Paid/Deducted on Credit';
                break;
              default:
                login_end.textContent = 'N/A';
                login_total.textContent = 'N/A';
                login_payment.textContent = 'N/A';
                login_mode.textContent = 'N/A';
                login_final.textContent = 'N/A';
                break;
            }
          
          }
        })
       .catch(function (error) {
        console.error(error);
        });
        
  }

  function timeDifference(startTime, endTime) {
    const start = parseTime(startTime);
    const end = parseTime(endTime);

    let diff = end - start;
    if (diff < 0) {
        diff += 24 * 60 * 60 * 1000;
    }

    const hours = Math.floor(diff / (60 * 60 * 1000));
    const minutes = Math.floor((diff % (60 * 60 * 1000)) / (60 * 1000));

    return { hours, minutes };
}

function parseTime(time) {
    const parts = time.split(':');
    const hour = parseInt(parts[0]);
    const minute = parseInt(parts[1]);
    const isPM = time.includes('PM');

    let totalMinutes = hour * 60 + minute;

    if (isPM && hour !== 12) {
        totalMinutes += 12 * 60; 
    } else if (!isPM && hour === 12) {
        totalMinutes -= 12 * 60; 
    }

    return totalMinutes * 60 * 1000; 
}



function PaymentCalc(hours, minutes, type){
  const HtoM = hours * 60;
  const total = HtoM + minutes;

  if(type === "Students" || type === "Teachers" || type === "Reviewers"){

  }else{

  }

  return 'test';
}

