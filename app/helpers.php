<?php
function VerificationCodeGenerator(){
    return  mt_rand(100000, 999999);
}

function FilterTime($time){
     $start = addSuffix(substr($time, 0,2));
     $end = addSuffix(substr($time, 3, 5));
 
    return $start . ' - ' . $end;
 }
 
 function addSuffix($time){
     if($time[0]=== "0"){
          $initial = $time[1];
     } else {
          $initial = $time;
     }
 
     if(intval($initial) < 12 && $initial != "0"){
          $format = $initial . ":00AM";
     } else if($initial === "0"){
          $format = "12:00AM";
     } else if(intval($initial) < 12){
        $format = $initial . ":00AM"; 
     } else if(intval($initial) === 12){
         $format = "12:00PM";
     } else {
          $adjust = intval($initial) - 12;
          $format = $adjust . ":00PM";
     }
 
     return $format;
 }
?>