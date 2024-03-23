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