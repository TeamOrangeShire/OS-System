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
            login_status.innerHTML = '<i class="bi bi-x-square-fill text-danger"></i> Not Logged In ';
            login_date.textContent = 'N/A';
            login_start.textContent = 'N/A';
            login_end.textContent = 'N/A';
            login_total.textContent = 'N/A';
            login_payment.textContent = 'N/A';
            login_mode.textContent = 'N/A';
            login_final.textContent = 'N/A';
          }else{
            login_status.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Logged In';
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
                login_final.innerHTML = '<i class="bi bi-clock-fill text-warning"></i>  Unpaid/Pending Payment';
                break;
              case 2:
                var diff = timeDifference(data.log_start_time, data.log_end_time);
                login_end.textContent = data.log_end_time;
                login_total.textContent = `${diff.hours}Hrs & ${diff.minutes}Minutes`;
                var payment = PaymentCalc(diff.hours, diff.minutes, type);
                login_payment.textContent = payment;
                login_mode.textContent = 'Account Credit';
                login_final.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Paid/Deducted on Credit';
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
  var payment = 0;
  if(type === "Students" || type === "Teachers" || type === "Reviewers"){
    switch(hours){
      case 1:
        payment += 50;
        break;
      case 2:
        payment += 100
        break;
      case 3:
        payment += 140;
        break;
      case 4:
        payment += 185;
        break;
      case 5:
        payment += 220;
        break;
      case 6:
        payment += 240;
        break;
      case 7:
        payment += 280;
        break;
      case 8:
        payment += 320;
        break;
      case 0:
        payment += 0;
        break;
      default:
        payment += 320;
        break;
    }
    if(hours === 0 && minutes <= 15){
      payment += 0;
    }
    if( (hours === 0 || hours === 1) && ( minutes > 15 && minutes <= 45) ){
      payment += 25;
    }
    if((hours === 0 || hours === 1) && (hours < 2 && minutes > 45) ){
        payment += 50;
    }
    if(hours === 2 && minutes < 15){
      payment += 0;
    }
    if(hours === 2 && minutes > 15 && minutes <= 45){
      payment += 20;
    }
     if(hours === 2 && hours < 3 && minutes > 45){
      payment += 40;
    }
    
      if(hours === 3 && minutes < 15){
      payment += 0;
    }
    if(hours === 3 && minutes > 15 && minutes <= 45){
      payment += 20;
    }
     if(hours === 3 && hours < 4 && minutes > 45){
      payment += 45;
    }
    
     if(hours === 4 && minutes < 15){
      payment += 0;
    }
    if(hours === 4 && minutes > 15 && minutes <= 45){
      payment += 25;
    }
     if(hours === 4 && hours < 5 && minutes > 45){
      payment += 35;
    }
    
      if(hours === 5 && minutes < 15){
      payment += 0;
    }
    if(hours === 5 && minutes > 15 && minutes <= 45){
      payment += 10;
    }
     if(hours === 5 && hours < 6 && minutes > 45){
      payment += 20;
    }
    
     if(hours === 6 && minutes < 15){
      payment += 0;
    }
    if(hours === 6 && minutes > 15 && minutes <= 45){
      payment += 20;
    }
     if(hours === 6 && hours < 7 && minutes > 45){
      payment += 40;
    }
    
     if(hours === 7 && minutes < 15){
      payment += 0;
    }
    if(hours === 7 && minutes > 15 && minutes <= 45){
      payment += 20;
    }
     if(hours === 7 && hours < 8 && minutes > 45){
      payment += 40;
    }
  }else{
    switch(hours){
      case 1:
        payment += 80;
        break;
      case 2:
        payment += 160
        break;
      case 3:
        payment += 200;
        break;
      case 4:
        payment += 260;
        break;
      case 5:
        payment += 280;
        break;
      case 6:
        payment += 300;
        break;
      case 7:
        payment += 350;
        break;
      case 8:
        payment += 400;
        break;
      case 0:
        payment += 0;
        break;
      default:
        payment +=400;
        break;
    }
    if(hours === 0 && minutes <= 15){
      payment += 0;
    }
    if( (hours === 0 || hours === 1) && ( minutes > 15 && minutes <= 45) ){
      payment += 40;
    }
    if((hours === 0 || hours === 1) && (hours < 2 && minutes > 45) ){
        payment += 80;
    }
    if(hours === 2 && minutes < 15){
      payment += 0;
    }
    if(hours === 2 && minutes > 15 && minutes <= 45){
      payment += 30;
    }
     if(hours === 2 && hours < 3 && minutes > 45){
      payment += 40;
    }
    
      if(hours === 3 && minutes < 15){
      payment += 0;
    }
    if(hours === 3 && minutes > 15 && minutes <= 45){
      payment += 30;
    }
     if(hours === 3 && hours < 4 && minutes > 45){
      payment += 60;
    }
    
     if(hours === 4 && minutes < 15){
      payment += 0;
    }
    if(hours === 4 && minutes > 15 && minutes <= 45){
      payment += 10;
    }
     if(hours === 4 && hours < 5 && minutes > 45){
      payment += 20;
    }
    
      if(hours === 5 && minutes < 15){
      payment += 0;
    }
    if(hours === 5 && minutes > 15 && minutes <= 45){
      payment += 10;
    }
     if(hours === 5 && hours < 6 && minutes > 45){
      payment += 20;
    }
    
     if(hours === 6 && minutes < 15){
      payment += 0;
    }
    if(hours === 6 && minutes > 15 && minutes <= 45){
      payment += 30;
    }
     if(hours === 6 && hours < 7 && minutes > 45){
      payment += 50;
    }
    
     if(hours === 7 && minutes < 15){
      payment += 0;
    }
    if(hours === 7 && minutes > 15 && minutes <= 45){
      payment += 20;
    }
     if(hours === 7 && hours < 8 && minutes > 45){
      payment += 50;
    }
  }

  return payment;
}

function MoreInfoModal(url, type){
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
    console.log(data);
    if(data.log_status === 0){
      login_status.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Still Logged In';
      login_end.textContent = 'N/A';
      login_total.textContent = 'N/A';
      login_payment.textContent = 'N/A';
      login_mode.textContent = 'N/A';
      login_final.textContent = 'N/A';
      paid_status.textContent = 'N/A';
    }else{
      const time = timeDifference(data.log_start_time, data.log_end_time);
      login_status.innerHTML = '<i class="bi bi-x-square-fill text-danger"></i> Logged Out';
      login_end.textContent = data.log_end_time;
      login_total.textContent = time.hours + 'Hrs & ' + time.minutes + 'mins';
      login_payment.textContent = PaymentCalc(time.hours, time.minutes, type);
      login_mode.textContent = 'N/A';
      login_final.textContent = 'N/A';
      paid_status.textContent = 'N/A';
    }
    login_date.textContent = data.log_date;
    login_start.textContent = data.log_start_time;
  })
 .catch(function (error) {
  console.error(error);
  });
}