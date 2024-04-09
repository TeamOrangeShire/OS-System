<?php
use Carbon\Carbon;

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

 function FirstNameFormat($string){
     $count = str_word_count($string);
     $initials = "";
     if($count === 1){
       $finalInitials = $initials . $string[0];
     }else{
          $firstName = explode(" ", $string);
          for($i = 0; $i < $count; $i++){
            $initials = $initials . $firstName[$i][0];
          }
       $finalInitials = $initials;
     }
  return $finalInitials;
 }


 function HoursToMinutes($time){
    return $time * 60;
 }

 function MinutesToHours($time){
     $hours = intval($time / 60);
     $minutes = $time % 60;

     $formatTime = TimeConv($hours) . ":" . TimeConv($minutes);

     return $formatTime;
 }
 function TimeConv($time){
     if(strlen($time) === 2){
     return $time;
     }else{
          return '0'.$time;
     }
 }

 function TransactionId(){
     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
     $randomString = '';
 
     for ($i = 0; $i < 15; $i++) {
         $randomString .= $characters[rand(0, strlen($characters) - 1)];
     }
 
     return $randomString;
 }

 function PastTimeCalc($date){
    $now = Carbon::now()->format('Y-m-d H:i:s');

    $nowTime = Carbon::parse($now);
    $dateTime = Carbon::parse($date);
    
    $diffInHours = $dateTime->diffInHours($nowTime);
    $diffInMinutes = $dateTime->diffInMinutes($nowTime);
    $diffInDays= $dateTime->diffInDays($nowTime);

   return [$diffInHours, $diffInMinutes, $diffInDays];
 }

 function DisplayTime($start, $end) {
    $total = timeDifference($start, $end);
    $totalTime = $total['hours'] . 'hrs & ' . $total['minutes'] . 'mins';
    return $totalTime;
}

 function timeDifference($startTime, $endTime) {
    $start = parseTime($startTime);
    $end = parseTime($endTime);

    $diff = $end - $start;
    if ($diff < 0) {
        $diff += 24 * 60 * 60 * 1000;
    }

    $hours = floor($diff / (60 * 60 * 1000));
    $minutes = floor(($diff % (60 * 60 * 1000)) / (60 * 1000));

    return ['hours' => $hours, 'minutes' => $minutes];
}

function parseTime($time) {
    $parts = explode(':', $time);
    $hour = (int)$parts[0];
    $minute = (int)$parts[1];
    $isPM = strpos($time, 'PM') !== false;

    $totalMinutes = $hour * 60 + $minute;

    if ($isPM && $hour !== 12) {
        $totalMinutes += 12 * 60; 
    } elseif (!$isPM && $hour === 12) {
        $totalMinutes -= 12 * 60; 
    }

    return $totalMinutes * 60 * 1000; 
}

?>