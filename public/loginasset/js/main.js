
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }
        
    });


})(jQuery);
function isEmail(email) {
    if (email.includes('@') && email.includes('.')) {
        return true;
    }
    return false;
  }

function Login(url, home) {
    document.getElementById('loader').style.display = 'flex';
    if(isEmail(document.getElementById('email').value)){
        var formData = $('form#login-form').serialize();
   $.ajax({
       type: 'POST',
       url: url,
       data: formData,
       success: function(response) {
        document.getElementById('loader').style.display = 'none';
         if(response.status === 'success'){
          window.location.href = home;
         }else if(response.status === 'fail'){
          alertify.set('notifier','position', 'top-center');
          alertify.warning('Incorrect Password'); 
         }else{
          alertify.set('notifier','position', 'top-center');
          alertify.warning('Username Not Found'); 
         }
       }, 
       error: function (xhr) {

           console.log(xhr.responseText);
       }
   });
    }else{
        document.getElementById('loader').style.display = 'none';
    }
 
}
function CleanInput(event, requiredInput) {
    const input = event.target;
    const inputValue = input.value;
    const newValue = inputValue.replace(/[^a-zA-Z\s]/g, '');  // Replace any non-letter characters with an empty string
    input.value = newValue; 

    if(requiredInput !== ''){
        document.getElementById(requiredInput).style.display = 'none';
    }

    if(input.value === ''){
        document.getElementById(requiredInput).style.display = '';
    }
}
function CleanContact(event, contact) {
    document.getElementById(contact).style.display = 'none'
    const input = event.target;
    let inputValue = input.value;
 
    inputValue = inputValue.replace(/\D/g, '').slice(0, 11);

    input.value = inputValue;
}

function CloseError(email){
    document.getElementById(email).style.display = 'none';
}
function CleanMail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression for validating email addresses
    return emailPattern.test(email);
}

function Proceed(step, instruct){
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const step3 = document.getElementById('step3');

  if(step === 'step2' && instruct === 'next'){
    const fname = document.getElementById('firstname');
    const mname = document.getElementById('middlename');
    const lname = document.getElementById('lastname');
    let validty = 0;
    if(fname.value === ''){
        document.getElementById('fname_required').style.display = '';
    }else{
        document.getElementById('fname_required').style.display = 'none';
        document.getElementById('f_fname').value = fname.value;
        validty++;
    }

    if(lname.value === ''){
        document.getElementById('lname_required').style.display = '';
    }else{
        document.getElementById('lname_required').style.display = 'none';
        document.getElementById('f_lname').value = lname.value;
        validty++;
    }

    document.getElementById('f_mname').value = mname.value;
    if(validty == 2){
       step1.style.display = 'none';
       step2.style.display = '';
    }
  }else if(step === 'step1' && instruct === 'previous'){
    step1.style.display = '';
    step2.style.display = 'none';
  }else if(step === 'step3' && instruct === 'next'){
    let validity = 0;
    const remail = document.getElementById('email_required');
    if(document.getElementById('email').value === ''){
        remail.style.display = '';
        remail.textContent = 'Field Required';
    }else{
        if(CleanMail(document.getElementById('email').value)){
            document.getElementById('f_email').value = document.getElementById('email').value;
            validity++;
         }else{
            remail.style.display = '';
            remail.textContent = 'Invalid Email';
         }
    }
    
     const contact = document.getElementById('contact');
     if(contact.value === '' || contact.value.length < 11){
        document.getElementById('contact_required').style.display = '';
     }else{
        document.getElementById('f_contact').value = contact.value;
        validity++;
     }

     if(validity == 2){
        step2.style.display = 'none';
        step3.style.display = '';
     }
  }else if(step === 'step2' || instruct === 'previous'){
    step2.style.display = '';
    step3.style.display = 'none';
  }

}

function Register(){

    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const confirm = document.getElementById('confirm_password');
    let validity = 0;
    if(username.value === ''){
        document.getElementById('username_required').style.display = '';
    }else{
        document.getElementById('username_required').style.display = 'none';
        validity++;
    }
    if(password.value === ''){
        document.getElementById('password_required').style.display = '';
    }else{
        document.getElementById('password_required').style.display = 'none';
        validity++;
    }
    if(confirm.value === ''){
        document.getElementById('confirm_required').style.display = '';
    }else{
        document.getElementById('confirm_required').style.display = 'none';
        validity++;
    }

    if(validity === 3){
        if(confirm.value === password.value){
            document.getElementById('f_password').value = password.value;
            document.getElementById('f_username').value = username.value;   
            document.getElementById('b_fname').textContent = document.getElementById('f_fname').value;
            document.getElementById('b_mname').textContent = document.getElementById('f_mname').value;
            document.getElementById('b_lname').textContent = document.getElementById('f_lname').value;

            document.getElementById('b_email').textContent = document.getElementById('f_email').value;
            document.getElementById('b_contact').textContent = document.getElementById('f_contact').value;

            document.getElementById('b_username').textContent = document.getElementById('f_username').value;
            let passChar = '';
            for(let i = 0; document.getElementById('f_password').value.length > i; i++){
                passChar += "*";
            }
            document.getElementById('b_password').textContent = passChar;
            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
           registerModal.show();
        }else{
            document.getElementById('confirm_required').style.display = '';
            document.getElementById('password_required').style.display = '';
            document.getElementById('confirm_required').textContent = 'Not Match';
            document.getElementById('password_required').textContent = 'Not Match';
        }
    }
   
}

function SubmitRegistration(url, login, home){
    document.getElementById('loader').style.display = 'flex';
    var formData = $('form#signUpForm').serialize();
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
          if(response.status === 'not_exist'){
            document.getElementById('loader').style.display = 'none';
            document.getElementById('loader').style.display = 'none';
            alertify.set('notifier','position', 'top-center');
            alertify.success('Account Created Successfully');
            alertify.success('Redirecting to home dashboard please wait....');
            
            document.getElementById('l_username').value = response.username;
            document.getElementById('l_password').value = response.password;
            var autoLogin = $('form#autoLogin').serialize();
            const formData2 = autoLogin + '&username=' + response.username + '&password=' + response.password;
            console.log(formData2);
            $.ajax({
                type: 'POST',
                url: login,
                data: formData2,
                success: function(responsedata) {
                    if(responsedata.status === 'success'){
                        window.location.href = home;
                    }
                }, 
                error: function (xhr) {
          
                    console.log(xhr.responseText);
                }
            });
          }else{
            document.getElementById('loader').style.display = 'none';
            alertify.set('notifier','position', 'top-center');
            alertify.warning('Username Already Exist');
          }
        }, 
        error: function (xhr) {
  
            console.log(xhr.responseText);
        }
    });
}