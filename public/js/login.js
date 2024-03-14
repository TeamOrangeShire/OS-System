function restrictToText(event) {
  var input = event.target;

  // Get the value of the input field
  var inputValue = input.value;

  // Replace any non-letter and non-space characters with an empty string
  var sanitizedValue = inputValue.replace(/[^a-zA-Z\s]/g, '');

  // Update the input field with the sanitized value
  input.value = sanitizedValue;
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

function clears(){
document.getElementById('input-1').value= '';
document.getElementById('input-2').value= '';
document.getElementById('input-3').value= '';
document.getElementById('input-4').value= '';
document.getElementById('input-5').value= '';
document.getElementById('input-6').value= '';
}