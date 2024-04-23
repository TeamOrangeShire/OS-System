function restrictToText(event) {
 
  var input = event.target;

  // Get the value of the input field
  var inputValue = input.value;

  // Replace any non-letter and non-space characters with an empty string
  var sanitizedValue = inputValue.replace(/[^a-zA-Z\s]/g, '');

  // Update the input field with the sanitized value
  input.value = sanitizedValue;
}

function valueChecker(){
  const fname = document.getElementById('fname').value;
  const mname = document.getElementById('mnamne').vale;
  const lname = document.getElementById('lname').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  const btn = document.getElementById('create-acc-button');

  if(fname === '' || mname=== '' || lname=== '' || email=== '' || password === ''){
    btn.disable = true;
  }else{
    btn.disable = false;
  }
}
function restrictToNumbers(event, nextInputId, prevInputId) {
  var input = event.target;
  var inputValue = input.value;

  // Check if input is empty and move to previous input on backspace
  if (event.inputType === 'deleteContentBackward' && prevInputId) {
      document.getElementById(prevInputId).focus();
      return;
  }

  // Check if input is not empty and move to next input
  if (inputValue && nextInputId) {
      document.getElementById(nextInputId).focus();
  }

  // Replace any non-digit characters with an empty string
  var sanitizedValue = inputValue.replace(/\D/g, '');

  // Update the input field with the sanitized value
  input.value = sanitizedValue;
}

function isEmail(email) {
  if (email.includes('@') && email.includes('.')) {
      return true;
  }
  return false;
}

function CreateAccount(url, goto) {
  if(isEmail(document.getElementById('email').value)){
    var formData = $('form#account_info').serialize();
    document.getElementById('loadingDiv').style.display = 'flex';
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
         if(response.email === 'exist'){
          alertify.set('notifier','position', 'top-center');
          alertify.warning('Email Account is already registered use another'); 
          document.getElementById('loadingDiv').style.display = 'none';
         }
         else{
          window.location.href = goto + "?id=" + response.id + "&redirect=false";
         }
        
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
  }else{
    alertify.set('notifier','position', 'top-center');
    alertify.warning('Not A valid Email'); 
    document.getElementById('loadingDiv').style.display = 'none';
  }
  
}
function Verify(btn,url){
  document.getElementById('loadingDiv').style.display = 'flex';
  const sendButton =  document.getElementById('send_button');
  var formData = $('form#verify-account').serialize();
  sendButton.textContent = 'Sending....';
  $.ajax({
    type: 'POST',
    url: url,
    data: formData,
    success: function(response) {
      document.getElementById('loadingDiv').style.display = 'none';
      sendButton.textContent = 'Sent ✔';
      btn.disabled = true;
    },
    error: function (xhr) {
        console.log(xhr.responseText);
    }
});
}

function goHome(url){
  window.location.href = url;
}