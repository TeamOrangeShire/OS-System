
const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");

const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const fname_label = document.getElementById('fname_label');
const lname_label = document.getElementById('lname_label');

const mname = document.getElementById('mname');
const mname_label = document.getElementById('mname_label');

const email = document.getElementById('email');
const contact = document.getElementById('contact');
const email_label = document.getElementById('email_label');
const contact_label = document.getElementById('contact_label');

let current = 1;

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
 if(fname.value === '' || lname.value === ''){
  lname.style.border = '1px solid #ff0000';
  fname.style.border = '1px solid #ff0000';
  lname_label.style.color = '#ff0000';
  fname_label.style.color = '#ff0000';
  lname_label.textContent = "Last Name: Don't leave this field blank!";
  fname_label.textContent = "First Name: Don't leave this field blank!";
 }else{
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
 }
});
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  if(mname.value === ''){
     mname.style.border = '1px solid #ff0000';
     mname_label.style.color = '#ff0000';
     mname_label.textContent = "Middle Name: Don't leave this field blank!";
  }else{
    slidePage.style.marginLeft = "-50%";
    bullet[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
    current += 1;
  }
});
contact.addEventListener('input', function() {
  if (contact.value.length > 11) {
    contact.value = contact.value.slice(0, 11);
  }
});
nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  const emailinput = email.value.trim();
  if(email.value === '' || contact.value === ''){
    email.style.border = '1px solid #ff0000';
    contact.style.border = '1px solid #ff0000';
    email_label.style.color = '#ff0000';
    contact_label.style.color = '#ff0000';
    email_label.textContent = "Email Address: Don't leave this field blank!";
    contact_label.textContent = "Phone Number: Don't leave this field blank!";
    
  }
  else if(!emailRegex.test(emailinput) && contact.value.length < 11){
    contact_label.textContent = "Phone Number: Not a valid number!";
    contact_label.style.color = '#ff0000';
    contact.style.border = '1px solid #ff0000';
    email.style.border = '1px solid #ff0000';
    email_label.style.color = '#ff0000';
    email_label.textContent = "Email Address: Not a valid email!";
  }else if(contact.value.length < 11){
    contact_label.textContent = "Phone Number: Not a valid number!";
    contact_label.style.color = '#ff0000';
    contact.style.border = '1px solid #ff0000';
  }else if(!emailRegex.test(emailinput)){
    email.style.border = '1px solid #ff0000';
    email_label.style.color = '#ff0000';
    email_label.textContent = "Email Address: Not a valid email!";
  }else{
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  }
});

prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});