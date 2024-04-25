(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.nav-bar').addClass('sticky-top');
        } else {
            $('.nav-bar').removeClass('sticky-top');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            992:{
                items:2
            }
        }
    });
    
})(jQuery);


function TimeButtonCheck(button){
    
    const unselectButtons = document.querySelectorAll('.comic-button-active');

    unselectButtons.forEach(function(button) {
      button.classList.remove('comic-button-active');
      button.classList.add('comic-button');
    });
    
    button.classList.remove('comic-button');
    button.classList.add('comic-button-active');

    const start = button.value.substring(0, 4); 
    const end = button.value.substring(5, 9); 

    document.getElementById('hiddenTime').value = TimeToInt(start, end);
    document.getElementById('vis_time').value = Format_Time(start, end);
}

function Format_Time(start, end){

    const startTime = ProcessTime(start);
    const endTime = ProcessTime(end);

    const time = startTime + "-" + endTime;
    return time;

}

function ProcessTime(time){
    if(time[0] === "0"){
        var startTime = time[1] + ":00" + time.substring(2,4);
    }else{
        var startTime = time.substring(0,2) + ":00" + time.substring(2,4);
    }

    return startTime;
}

function TimeToInt(start, end){
    const StartTime = GetIntTime(start);
    const EndTime = GetIntTime(end);

    return StartTime + "-" + EndTime;
}
function GetIntTime(time){
    if(time[0]=== "0"){
        var initialTime = time[1];
    }else{
        var initialTime = time.substring(0, 2);
    }

    if(time.substring(2, 4) === 'PM' && time.substring(0,2) != "12"){
        return parseInt(initialTime) + 12;
    }else if(time.substring(2, 4) === 'AM' && time.substring(0,2) === "12" ){
        return "00";
    }else{
      if(initialTime.length === 2){
          return initialTime;
      }else{
          return "0" + initialTime;
      }
    }
}


function FilterTime(time){
    const start = addSuffix(time.substring(0,2));
    const end = addSuffix(time.substring(3,5));
 
    return start + ' - ' + end;
 }
 
 function TrimTime(time){
     const start = time.substring(0,2);
     const end = time.substring(3,5);
 
     return [start, end];
 }
 
 function addSuffix(time){
     if(time[0]=== "0"){
         var initial = time[1];
     } else {
         var initial = time;
     }
 
     if(parseInt(initial) < 12 && initial != "0"){
         var format = initial + ":00AM";
     } else if(initial === "0"){
         var format = "12:00AM";
     } else if(parseInt(initial) < 12){
         var format = initial + ":00AM"; 
     } else if(parseInt(initial) === 12){
         var format = "12:00PM";
     } else {
         const adjust = parseInt(initial) - 12;
         var format = adjust + ":00PM";
     }
 
     return format;
 }

 function TimeFinder1(time){
    let start = parseInt(time[0]); 
    const end = parseInt(time[1]);
    const timeList = [];
     
    while (start < end) {
        const semiEnd = start + 1;
        if (semiEnd <= end) {
            const timeString = start + "-" + semiEnd;
            timeList.push(timeString);
            start = parseInt(start) + 1; 
        } else {
            break; 
        }
    }

    return timeList;
}

function TimeFinder4(time) {
    const combi = ["09-13", "10-14", "11-15", "12-16", "13-17", "14-18", "15-19", "16-20", "17-21", "18-22", "19-23", "20-24", "21-01", "22-02", "23-03", "24-04"];
    const start = parseInt(time[0]);
    const end = parseInt(time[1]);
    const timeList = [];

    for (const slot of combi) {
        const [slotStart, slotEnd] = slot.split('-').map(Number);
        if (slotStart <= end && slotEnd >= start) {
            timeList.push(slot);
        }
    }

    return timeList;
}

const draggableElement = document.getElementById('draggable');



let offsetX, offsetY, isDragging = false;

// Function to handle touch start event
const handleTouchStart = (e) => {
  const touch = e.touches[0];
  isDragging = true;
  offsetX = touch.clientX - draggableElement.getBoundingClientRect().left;
  offsetY = touch.clientY - draggableElement.getBoundingClientRect().top;
  e.preventDefault();
};

// Function to handle touch move event
const handleTouchMove = (e) => {
  if (isDragging) {
    const touch = e.touches[0];
    let newX = touch.clientX - offsetX;
    let newY = touch.clientY - offsetY;
    
    // Ensure the element stays within the viewport
    newX = Math.max(0, newX);
    newX = Math.min(newX, window.innerWidth - draggableElement.offsetWidth);
    newY = Math.max(0, newY);
    newY = Math.min(newY, window.innerHeight - draggableElement.offsetHeight);
    
    // Update element's position directly
    draggableElement.style.left = newX + 'px';
    draggableElement.style.top = newY + 'px';
  }
  e.preventDefault();
};

// Function to handle touch end event
const handleTouchEnd = () => {
  isDragging = false;
};

// Add touch event listeners
draggableElement.addEventListener('touchstart', handleTouchStart);
draggableElement.addEventListener('touchmove', handleTouchMove);
draggableElement.addEventListener('touchend', handleTouchEnd);

// Add mouse event listeners for desktop
draggableElement.addEventListener('mousedown', (e) => {
  isDragging = true;
  offsetX = e.clientX - draggableElement.getBoundingClientRect().left;
  offsetY = e.clientY - draggableElement.getBoundingClientRect().top;
  e.preventDefault();
});

document.addEventListener('mousemove', (e) => {
  if (isDragging) {
    let newX = e.clientX - offsetX;
    let newY = e.clientY - offsetY;
    
    // Ensure the element stays within the viewport
    newX = Math.max(0, newX);
    newX = Math.min(newX, window.innerWidth - draggableElement.offsetWidth);
    newY = Math.max(0, newY);
    newY = Math.min(newY, window.innerHeight - draggableElement.offsetHeight);
    
    // Update element's position directly
    draggableElement.style.left = newX + 'px';
    draggableElement.style.top = newY + 'px';
  }
});

document.addEventListener('mouseup', () => {
  isDragging = false;
});

// Function to handle onclick event
function ScanDrag(url){
    window.location.href= url;
}