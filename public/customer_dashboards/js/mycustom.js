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
    event.preventDefault();
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


