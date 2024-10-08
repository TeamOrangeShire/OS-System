<?php
use Carbon\Carbon;

function VerificationCodeGenerator(){
    return  mt_rand(100000, 999999);
}

function RandomId($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $charLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charLength - 1)];
    }
    return $randomString;
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

function PaymentCalc($hoursString, $minutesString, $type){
    $hours = intval($hoursString);
    $minutes = intval($minutesString);
    $payment = 0;
    if($type === "Student" || $type === "Teacher" || $type === "Reviewer"){
      switch($hours){
        case 1:
          $payment += 50;
          break;
        case 2:
          $payment += 100;
          break;
        case 3:
          $payment += 140;
          break;
        case 4:
          $payment += 185;
          break;
        case 5:
          $payment += 220;
          break;
        case 6:
          $payment += 240;
          break;
        case 7:
          $payment += 280;
          break;
        case 8:
          $payment += 320;
          break;
        case 0:
          $payment += 0;
          break;
        default:
          $payment += 320;
          break;
      }
      if($hours === 0 && $minutes <= 15){
        $payment += 0;
      }
      if( ($hours === 0 || $hours === 1) && ($minutes > 15 && $minutes <= 45) ){
        $payment += 25;
      }
      if(($hours === 0 || $hours === 1) && ($hours < 2 && $minutes > 45) ){
          $payment += 50;
      }
      if($hours === 2 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 2 && $minutes > 15 && $minutes <= 45){
        $payment += 20;
      }
      if($hours === 2 && $hours < 3 && $minutes > 45){
        $payment += 40;
      }
      if($hours === 3 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 3 && $minutes > 15 && $minutes <= 45){
        $payment += 20;
      }
      if($hours === 3 && $hours < 4 && $minutes > 45){
        $payment += 45;
      }
      if($hours === 4 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 4 && $minutes > 15 && $minutes <= 45){
        $payment += 25;
      }
      if($hours === 4 && $hours < 5 && $minutes > 45){
        $payment += 35;
      }
      if($hours === 5 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 5 && $minutes > 15 && $minutes <= 45){
        $payment += 10;
      }
      if($hours === 5 && $hours < 6 && $minutes > 45){
        $payment += 20;
      }
      if($hours === 6 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 6 && $minutes > 15 && $minutes <= 45){
        $payment += 20;
      }
      if($hours === 6 && $hours < 7 && $minutes > 45){
        $payment += 40;
      }
      if($hours === 7 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 7 && $minutes > 15 && $minutes <= 45){
        $payment += 20;
      }
      if($hours === 7 && $hours < 8 && $minutes > 45){
        $payment += 40;
      }
    }else{
      switch($hours){
        case 1:
          $payment += 80;
          break;
        case 2:
          $payment += 160;
          break;
        case 3:
          $payment += 200;
          break;
        case 4:
          $payment += 260;
          break;
        case 5:
          $payment += 280;
          break;
        case 6:
          $payment += 300;
          break;
        case 7:
          $payment += 350;
          break;
        case 8:
          $payment += 400;
          break;
        case 0:
          $payment += 0;
          break;
        default:
          $payment += 400;
          break;
      }
      if($hours === 0 && $minutes <= 15){
        $payment += 0;
      }
      if( ($hours === 0 || $hours === 1) && ($minutes > 15 && $minutes <= 45) ){
        $payment += 40;
      }
      if(($hours === 0 || $hours === 1) && ($hours < 2 && $minutes > 45) ){
          $payment += 80;
      }
      if($hours === 2 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 2 && $minutes > 15 && $minutes <= 45){
        $payment += 30;
      }
      if($hours === 2 && $hours < 3 && $minutes > 45){
        $payment += 40;
      }
      if($hours === 3 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 3 && $minutes > 15 && $minutes <= 45){
        $payment += 30;
      }
      if($hours === 3 && $hours < 4 && $minutes > 45){
        $payment += 60;
      }
      if($hours === 4 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 4 && $minutes > 15 && $minutes <= 45){
        $payment += 10;
      }
      if($hours === 4 && $hours < 5 && $minutes > 45){
        $payment += 20;
      }
      if($hours === 5 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 5 && $minutes > 15 && $minutes <= 45){
        $payment += 10;
      }
      if($hours === 5 && $hours < 6 && $minutes > 45){
        $payment += 20;
      }
      if($hours === 6 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 6 && $minutes > 15 && $minutes <= 45){
        $payment += 30;
      }
      if($hours === 6 && $hours < 7 && $minutes > 45){
        $payment += 50;
      }
      if($hours === 7 && $minutes < 15){
        $payment += 0;
      }
      if($hours === 7 && $minutes > 15 && $minutes <= 45){
        $payment += 20;
      }
      if($hours === 7 && $hours < 8 && $minutes > 45){
        $payment += 50;
      }
    }

    return $payment;
  }

  function ReduceTimeConsume($remaining, $consume) {
    // Parse the remaining time
    list($remainingHours, $remainingMinutes) = explode(':', $remaining);
    $remainingHours = (int)$remainingHours;
    $remainingMinutes = (int)$remainingMinutes;

    // Parse the consume time
    list($consumeHours, $consumeMinutes) = explode(':', $consume);
    $consumeHours = (int)$consumeHours;
    $consumeMinutes = (int)$consumeMinutes;

    // Convert times to minutes
    $remainingTotalMinutes = ($remainingHours * 60) + $remainingMinutes;
    $consumeTotalMinutes = ($consumeHours * 60) + $consumeMinutes;

    // Subtract consume time from remaining time
    $newTotalMinutes = $remainingTotalMinutes - $consumeTotalMinutes;

    // Convert back to hours and minutes
    $finalHours = intdiv($newTotalMinutes, 60);
    $finalMinutes = $newTotalMinutes % 60;

    // Format hours and minutes with leading zeros
    $formattedHours = str_pad($finalHours, 2, '0', STR_PAD_LEFT);
    $formattedMinutes = str_pad($finalMinutes, 2, '0', STR_PAD_LEFT);

    return "$formattedHours:$formattedMinutes";
}

function convertTo12Hour($time) {
    // Convert the 24-hour format to a timestamp
    $timestamp = strtotime($time);

    // Format the timestamp into 12-hour format with AM/PM
    return date("g:i A", $timestamp);
}

function addHoursToTimeAndAdjustDate($startTime, $date, $hoursToAdd) {
    // Parse the date (e.g., "10/03/2024") and time (e.g., "11:00 PM") together
    $dateTime = Carbon::createFromFormat('m/d/Y h:i A', $date . ' ' . $startTime);

    // Add the specified number of hours (e.g., 4 hours)
    $dateTime->addHours($hoursToAdd);

    // Return the updated time and date in the required formats
    return [
        'updatedTime' => $dateTime->format('h:i A'), // Updated time (e.g., "03:00 AM")
        'updatedDate' => $dateTime->format('m/d/Y')  // Updated date (if day changes, e.g., "10/04/2024")
    ];
}


function convertToDateFormatReservation($dateString)
{
    // Check if the date string is already in YYYY-MM-DD format
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateString)) {
        return $dateString; // Return the string as is
    }

    try {
        // Try to parse the date using Carbon
        $date = Carbon::parse($dateString);

        // Return the date in YYYY-MM-DD format
        return $date->format('Y-m-d');
    } catch (\Exception $e) {
        // Return null or handle the error if the date string is invalid
        return null;
    }
}

function convertTo24HourFormat($timeString)
{
    // Use the DateTime class to parse the 12-hour time format
    $dateTime = DateTime::createFromFormat('h:i A', $timeString);

    // Return the time in 24-hour format (HH:mm)
    return $dateTime ? $dateTime->format('H:i') : null;
}
?>
