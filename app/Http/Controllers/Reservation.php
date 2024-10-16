<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\CancellationReasons;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Jobs\MessageReservation;
use App\Mail\CancelReservationActive;
use App\Models\RoomRates;
use App\Mail\AdminMail;
use App\Mail\ApprovedMail;
use Exception;

class Reservation extends Controller
{

  public function getRoomData(Request $req)
  {
    $room = Rooms::select('room_id', 'room_number', 'room_capacity')->get();
    $roomRate = RoomRates::select('rp_id', 'room_id', 'rp_rate_description', 'rp_price')->get();
    return response()->json(['room' => $room, 'rate' => $roomRate, 'status' => 'success']);
  }
  public function getRooms()
  {
    $rooms = Rooms::where('rooms_disable', 0)->get();
    $rates = RoomRates::where('rp_disable', 0)->get();
    return response()->json(['success' => true, 'rooms' => $rooms, 'rates' => $rates]);
  }
  public function getReservation(Request $request)
  {
    $data = Reservations::all();

    foreach($data as $d){
        $room = Rooms::where('room_id', $d->room_id)->first();
        $rates = RoomRates::where('rp_id', $d->rate_id)->first();
        foreach($room->toArray() as $rKey => $rValue){
            $d->$rKey = $rValue;
        }

       if($rates){
        foreach($rates->toArray() as $rateKey => $rateValue){
            $d->$rateKey = $rateValue;
        }
       }else{
         $d->rates = 'null';
       }
    }

    return response()->json(['data' => $data, 'status' => 'success']);
  }
  public function SubmitReservationCustomer(Request $req)
  {
      $reserve = new Reservations();
      $endTime = "";
      $endDate = "";
      switch($req->endDateType){
          case "Daily":
              $date = Carbon::parse($req->endDates);
              $checkReservation = Reservations::where(function ($query) use ($date) {
                $query->where('start_date', '<=', $date)
                      ->where('end_date', '>=', $date)
                      ->whereIn('status', [1, 2]);
              })->where('room_id', $req->reserveType)->get();
              if(count($checkReservation) > 0){
                return response()->json(['success'=> false, 'message'=> 'Reservation Date conflict rooms is taken on dates between your choosen duration! Please choose another one']);
              }
              $endDate = convertToDateFormatReservation($req->endDates);
              $endTime = convertTo24HourFormat($req->startTime);
              break;
          case "Weekly":
              $parseStartDate =  Carbon::createFromFormat('m/d/Y', $req->startDate);

              $endDate = $parseStartDate->copy()->addWeeks($req->endDates)->toDateString();
              $parseDateCheck = Carbon::parse($endDate);
              $checkReservation = Reservations::where(function ($query) use ($parseDateCheck) {
                $query->where('start_date', '<=', $parseDateCheck)
                      ->where('end_date', '>=', $parseDateCheck)
                      ->whereIn('status', [1, 2]); // Checks if status is either 1 or 2
              })->get();
              if($checkReservation){
                return response()->json(['success'=> false, 'message'=> 'Reservation Date conflict rooms is taken on dates between your choosen duration! Please choose another one']);
              }
              $endTime = convertTo24HourFormat($req->startTime);
              break;
          case "Monthly":

              $nextYear = false;
              $month = $req->endDates;
              if(str_contains($req->endDates, "-")){
                  $month = explode('-', $req->endDates)[0];
                  $nextYear= true;
              }

              $date = Carbon::createFromFormat('m/d/Y', $req->startDate);
              $newDate = $date->month(Carbon::parse($month)->month);

              if($nextYear){
                 $newDate->addYear();
              }
              $formattedDate = $newDate->format('m/d/Y');
              $parseDateCheck = Carbon::parse($formattedDate);
              $checkReservation = Reservations::where(function ($query) use ($parseDateCheck) {
                $query->where('start_date', '<=', $parseDateCheck)
                      ->where('end_date', '>=', $parseDateCheck)
                      ->whereIn('status', [1, 2]); // Checks if status is either 1 or 2
              })->get();
              if($checkReservation){
                return response()->json(['success'=> false, 'message'=> 'Reservation Date conflict rooms is taken on dates between your choosen duration! Please choose another one']);
              }

              $endDate = convertToDateFormatReservation($formattedDate);
              $endTime =  convertTo24HourFormat($req->startTime);
              break;
          case "Hourly":
              $endDate = convertToDateFormatReservation($req->startDate);
              $time = Carbon::createFromFormat('h:i A', $req->startTime);
              $newTime = $time->copy()->addHours($req->endDates);
              $endTime = $newTime->format('H:i');
              break;
          case "4 Hours":
              $parseData = addHoursToTimeAndAdjustDate($req->startTime, $req->startDate, 4);
              $endTime =  convertTo24HourFormat($parseData['updatedTime']);
              $endDate = convertToDateFormatReservation($parseData['updatedDate']);
              break;
        default:
            $endDate = convertToDateFormatReservation($req->startDate);
            if($req->hotdesk != 0){
                $ratesData = RoomRates::where('rp_id', $req->hotdesk)->first();

                $expRate = explode(' ', $ratesData->rp_rate_description);

                switch($expRate[0]){
                    case "3":
                        $time = addHoursToTimeAndAdjustDate($req->startTime, $req->startDate, 3);
                        break;
                    case "6":
                        $time = addHoursToTimeAndAdjustDate($req->startTime, $req->startDate, 6);
                        break;
                    case "Day":
                        $time = addHoursToTimeAndAdjustDate($req->startTime, $req->startDate, 8);
                        break;
                    default:
                        $time = addHoursToTimeAndAdjustDate($req->startTime, $req->startDate, (int)$req->hotdeskEndtime);
                        break;
                }

                $endTime = convertTo24HourFormat($time['updatedTime']);
                $endDate = convertToDateFormatReservation($time['updatedDate']);
            }else{
                $endTime = "";
                $endDate = convertToDateFormatReservation($req->startDate);
            }
            break;
      }

    $generateTransaction = RandomId(10);
    $checkTransact = Reservations::where('transaction_id', $generateTransaction)->first();

    while($checkTransact){
        $generateTransaction = RandomId(10);
    }

    $reserve->c_name = $req->name;
    $reserve->c_email = $req->email;
    $reserve->phone_num = $req->contact;
    $reserve->c_guest_emails = $req->guestemails;
    $reserve->request = $req->reservationRequest;
    $reserve->room_id = $req->reserveType;
    $reserve->pax = $req->reserveType != 0 ? $req->pax : $req->paxhotdesk;
    $reserve->rate_id = $req->reserveType != 0 ?  $req->rates :  $req->hotdesk;
    $reserve->start_date = convertToDateFormatReservation($req->startDate);
    $reserve->end_date = $endDate;
    $reserve->start_time = convertTo24HourFormat($req->startTime);
    $reserve->end_time = $endTime;
    $reserve->status = 0;
    $reserve->transaction_id = $generateTransaction;
    $reserve->save();

    MessageReservation::dispatch($req->email, $req->guestemails, $generateTransaction, $reserve->r_id);

    return response()->json(['success' => true]);
  }


  public function submitAdminReservation(Request $request)
  {

    if ($request->process == 'add') {
      $input = $request->except('end_date','end_time2', 'multipleEmail', 'customer_request', 'emailInput', 'room_id');
      foreach ($input as $key => $value) {
        if (empty($value)) {
          if($key=='customer_name'){
          $field = 'customer name';
          }
          else if($key=='customer_num'){
          $field = 'customer number';
          }
          else if($key=='customer_email'){
          $field = 'customer email';
          }
          else if($key=='dateSelected2'){
          $field = 'rate and plan';
          }
          else if ($key == 'customer_bill') {
            $field = 'rate and plan';
          }
          return response()->json(['status' => 'error', 'message' => " Please fill $field"]); // Return an error response
        }
      }
      if($request->customer_bill==''){
        return response()->json(['status' => 'error', 'message' => " Please fill Rate"]); // Return an error response

      }
      $rate = RoomRates::where('rp_id', $request->customer_bill)->first();
      if($rate){
        if ($rate->rp_rate_description == 'Hourly') {
          $time24HourFormat = Carbon::createFromFormat('g:i A', $request->end_time2)->format('H:i');
          $start = $request->start_time;  // Example start time, e.g., "23:30"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHour(); // Add 1 hour to the start time
          $end = $time24HourFormat; // Format the end time
          $endDateFormatted = Carbon::createFromFormat('m/d/Y', $request->dateSelected2)->format('Y-m-d');
        } else if ($rate->rp_rate_description == '4 Hours') {
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(4); // Add 4 hours to the start time
          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = Carbon::createFromFormat('m/d/Y', $request->dateSelected2)->format('Y-m-d');
        } else if ($rate->rp_rate_description == 'Daily (12 Hours)') {
          $end = $request->start_time;
          $endDateFormatted = Carbon::createFromFormat('m/d/Y', $request->dateSelected2)->format('Y-m-d');
        } else if ($rate->rp_rate_description == 'Weekly') {
          $end = $request->start_time;
          $endDateFormatted = Carbon::createFromFormat('m/d/Y', $request->dateSelected2)->format('Y-m-d');

        } else if ($rate->rp_rate_description == 'Monthly') {
          $end = $request->start_time;
          $endDateFormatted = Carbon::createFromFormat('m/d/Y', $request->dateSelected2)->format('Y-m-d');
        } else if ($rate->rp_rate_description == 'Hourly(Educational Sector)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "23:30"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon

          $endTime = $startTime->copy()->addHour(); // Add 1 hour to the start time
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == '3 Hours(Educational Sector)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(3); // Add 3 hours to the start time
          $endDate = Carbon::createFromFormat('m/d/Y',  $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == '6 Hours(Educational Sector)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(6); // Add 6 hours to the start time
          $endDate = Carbon::createFromFormat('m/d/Y',  $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == 'Day Pass(Educational Sector)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(12); // Add 12 hours to the start time
          $endDate = Carbon::createFromFormat('m/d/Y',  $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == 'Hourly(Regular)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(); // Add hours to the start time (number of hours is missing)
          $endDate = Carbon::createFromFormat('m/d/Y',  $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == '3 Hours(Regular)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(3); // Add 3 hours to the start time
          $endDate = Carbon::createFromFormat('m/d/Y',  $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == '6 Hours(Regular)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(6); // Add 6 hours to the start time
          $endDate = Carbon::createFromFormat('m/d/Y',  $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == 'Day Pass(Regular)') {
          $startDate = $request->dateSelected;  // Example start date
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(12); // Add 12 hours to the start time
          $endDate = Carbon::createFromFormat('m/d/Y',  $startDate); // Parse the start date

          // Check if the end time exceeds midnight
          if ($endTime->format('H:i') < $startTime->format('H:i')) {
            // If the end time is earlier than the start time, it means it went past midnight
            $endDate->addDay();  // Add one day to the end date
          }

          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
        }
      }else{
        $end = '';
        $endDateFormatted = $request->dateSelected; // Format the end date
      }
      $transacID = RandomId(10);
      $checkingId = Reservations::where('transaction_id', $transacID)->first();
      while($checkingId){
        $transacID = RandomId(10);
      }

      if($rate){
        $status='1';
        $paybill = $request->customer_bill;
      }else{
        $status="1";
        $paybill = 0;
      }
      $reserve = new Reservations();
      $reserve->c_name = $request->customer_name;
      $reserve->c_email = $request->customer_email;
      $reserve->phone_num = $request->customer_num;
      $reserve->c_guest_emails = $request->multipleEmail;
      $reserve->request = $request->customer_request;
      $reserve->room_id = $request->room_id;
      $reserve->pax = $request->customer_count;
      $reserve->rate_id = $paybill;
      $reserve->start_date = Carbon::createFromFormat('m/d/Y', $request->dateSelected)->format('Y-m-d');
      $reserve->end_date = $endDateFormatted;
      $reserve->start_time = $request->start_time;
      $reserve->end_time = $end;
      $reserve->date_approved =  Carbon::now();
      $reserve->transaction_id = $transacID;
      $reserve->status = $status;
      $reserve->save();
      return response()->json(['status' => 'success', 'message' => "Room Successfully reserved", 'reload' => 'getPendingReservation', 'modal' => 'addEvent']);
    }else if($request->process == 'accept'){
      $reserve = Reservations::where('r_id',$request->r_id)->first();
      $room = Rooms::where('room_id',$reserve->room_id)->first();
      $rate = RoomRates::where('room_id',$room->room_id)->first();
      $reserve->status = "1";
      $reserve->save();

      try {
        Mail::to($reserve->c_email)->send(new ApprovedMail($reserve->transaction_id,'Room '.$room->room_number,$rate->rp_rate_description,$reserve->start_date,$reserve->end_date));
      } catch (Exception $x) {

      }

      return response()->json(['status' => 'success', 'message' => "Room Successfully reserved" ,'reload'=> 'getPendingReservation','modal'=> 'viewReservation']);
    }else if($request->process == 'cancel'){
      $input = $request->all(); // Get all input fields
      foreach ($input as $key => $value) {
        if (empty($value)) {
          return response()->json([
            'status' => 'error',
            'message' => "Please fill in all fields"
          ]); // Return error response
        }
      }
      $reserve = Reservations::where('r_id',$request->c_r_id)->first();
      $room = Rooms::where('room_id', $reserve->room_id)->first();
      $rate = RoomRates::where('room_id', $room->room_id)->first();
      $reserve->status ='5';
      $reserve->reason = $request->cancelReason;
      $reserve->save();

      try
      {
        Mail::to($reserve->c_email)->send(new
        AdminMail($reserve->transaction_id, 'Room ' . $room->room_number, $rate->rp_rate_description, $reserve->start_date, $reserve->end_date, $request->cancelReason));
      }
      catch(Exception $x){

      }

      return response()->json(['status' => 'success', 'message' => "Reservation canceled successfully", 'reload' => 'getPendingReservation', 'modal' => 'viewCancelReservation']);
    }else if($request->process == 'resched'){

      if($request->rescedTime==''|| $request->rescedTime2 == '' || $request->re_r_id==''||$request->roomSelect==''||$request->rateSelect==''||$request->reschedDate==''||$request->reschedDate2==''||$request->reschedReason==''){
        return response()->json(['status' => 'error', 'message' => "Please fill-up all required fields", 'reload' => 'getPendingReservation']);
      }
      $reSched = Reservations::where('r_id', $request->re_r_id)->first();
      $formattedDateStart = Carbon::createFromFormat('m/d/Y', $request->reschedDate)->format('Y-m-d');
      $formattedDateEnd = Carbon::createFromFormat('m/d/Y', $request->reschedDate2)->format('Y-m-d');


      $reSched->start_time = $request->rescedTime;
      $reSched->end_time = $request->rescedTime2;
      $reSched->start_date = $formattedDateStart;
      $reSched->end_date = $formattedDateEnd;
      $reSched->room_id = $request->roomSelect;
      $reSched->rate_id = $request->rateSelect;
      $reSched->status = 1;
      $reSched->reason = $request->reschedReason;
      $reSched->save();
      return response()->json(['status' => 'success', 'message' => "Reservation successfully rescheduled", 'reload' => 'getPendingReservation', 'modal' => 'viewReschedReservation']);

    }

    return response()->json(['status' => 'success']);
  }

  public function checkRoomAvailability(Request $req){
    $date = Carbon::parse($req->date);
    $reservation = Reservations::where(function ($query) use ($date) {
        $query->where('start_date', '<=', $date)
              ->where('end_date', '>=', $date)
              ->whereIn('status', [1, 2]); // Checks if status is either 1 or 2
    })->get();
    $rooms = [];
    foreach($reservation as $reserve){
        array_push($rooms, $reserve->room_id);
    }

    return response()->json(['status'=> true, 'rooms'=> $rooms]);

  }

  public function cancelReservation(Request $req){
    $reserve = Reservations::where('r_id', $req->id)->first();

    if($reserve){

        $reserve->update([
            'status'=> 3
        ]);
    }

    return view('mail.cancelledreservation');
  }

  public function CheckBookingStatus(Request $req){
    $date = Carbon::parse($req->date);
    $reservation = Reservations::where(function ($query) use ($date) {
        $query->where('start_date', '<=', $date)
              ->where('end_date', '>=', $date)
              ->whereIn('status', [1, 2]);
    })->get();

    $roomId = [];
    foreach($reservation as $reserve){
        $roomId[] = $reserve->room_id;
    }

    $filterRoomId = array_unique($roomId);

    $rooms = Rooms::where('room_id', '!=', 0)->get();

    $status = "Available";
    $i = 0;
    foreach($rooms as $room){
        if(in_array($room->room_id, $filterRoomId)){
            $i++;
        }
    }

    if($i == $rooms->count()){
        $status = "Fully Booked";
    }

    $customQuery = Rooms::query();
    $customQuery->where('room_id', '!=', 0);

    foreach($filterRoomId as $rId){
        $customQuery->where("room_id", '!=', $rId);
    }

    $checkAvailableRooms = $customQuery->get();


    return response()->json(['status' => $status, 'room_taken'=> $filterRoomId, 'available_room'=> $checkAvailableRooms]);
  }
  public function getCancellationReason(){
    $cancel = CancellationReasons::where('reason_type', 'Cancel')->get();

    return response()->json(['data'=> $cancel]);
  }

  public function CancelReservationActive(Request $req){
    $reservation = Reservations::where('r_id', $req->id)->first();

    if($req->reason_status == 'add'){
        $cancel = new CancellationReasons();
        $cancel->reason_header = $req->reason_header;
        $cancel->reason_message = $req->reason;
        $cancel->reason_type = 'Cancel';
        $cancel->save();
    }

    $reservation->update([
        'status'=> 4,
        'reason'=> $req->reason
    ]);

   try{
        Mail::to($reservation->c_email)->send(new CancelReservationActive($reservation->c_name, $req->reason));
   }catch(Exception $err){
        //Ignore
   }

    return response()->json(['status'=>'success']);
  }

  public function getCompleteReservation(){
    $reservation = Reservations::join('rooms', 'rooms.room_id', '=', 'reservations.room_id')->where('status', 3)->get();

    return response()->json(['data'=> $reservation]);
  }

  public function getCancelledDenied(){
    $reserve = Reservations::join('rooms', 'rooms.room_id', '=', 'reservations.room_id')->where('status', 4)->orWhere('status', 5)->get();

    return response()->json(['data'=> $reserve]);
  }
}
