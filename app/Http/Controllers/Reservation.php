<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\CancellationReasons;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationResponse;
use App\Mail\CancelReservationActive;
use Exception;
use App\Models\RoomRates;

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
        $rates = RoomRates::where('room_id', $d->room_id)->first();

        foreach($room->toArray() as $rKey => $rValue){
            $d->$rKey = $rValue;
        }

        foreach($rates->toArray() as $rateKey => $rateValue){
            $d->$rateKey = $rateValue;
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
              $endDate = convertToDateFormatReservation($req->endDates);
              $endTime = convertTo24HourFormat($req->startTime);
              break;
          case "Weekly":
              $endDate = convertToDateFormatReservation($req->endDates);
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
              $endDate = convertToDateFormatReservation($formattedDate);
              $endTime =  convertTo24HourFormat($req->startTime);
              break;
          case "Hourly":
              $endDate = convertToDateFormatReservation($req->startDate);
              $endTime = $req->endDates;
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

    Mail::to($req->email)->send(new ReservationResponse($generateTransaction, $reserve->r_id));

    if ($req->guestemails != "") {
      $emails = explode(',', $req->guestemails);

      array_pop($emails);

      foreach ($emails as $em) {
        $cleanEmail = str_replace(' ', '', $em);
        try {
          Mail::to($cleanEmail)->send(new ReservationResponse($generateTransaction, $reserve->r_id));
        } catch (Exception $ex) {
          // Ignore
        }
      }
    }
    return response()->json(['success' => true]);
  }


  public function submitAdminReservation(Request $request)
  {

    if ($request->process == 'add') {
      $input = $request->except('end_date', 'multipleEmail', 'customer_request', 'emailInput', 'room_id', 'customer_bill');
      foreach ($input as $key => $value) {
        if (empty($value)) {
          return response()->json(['status' => 'error', 'message' => " Please fill in all fields"]); // Return an error response
        }
      }
      $rate = RoomRates::where('rp_id', $request->customer_bill)->first();
      if($rate){
        if ($rate->rp_rate_description == 'Hourly') {
          $start = $request->start_time;  // Example start time, e.g., "23:30"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHour(); // Add 1 hour to the start time
          $endDateFormatted = $request->dateSelected2->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == '4 Hours') {
          $start = $request->start_time;  // Example start time, e.g., "16:00"
          $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
          $endTime = $startTime->copy()->addHours(4); // Add 4 hours to the start time
          $end = $endTime->format('H:i'); // Format the end time
          $endDateFormatted = $request->dateSelected2->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == 'Daily (12 Hours)') {
          $end = $request->start_time;
          $endDateFormatted = Carbon::createFromFormat('m/d/Y', $request->dateSelected2)->format('Y-m-d');
        } else if ($rate->rp_rate_description == 'Weekly') {
          $end = $request->start_time;
          $endDateFormatted = $request->dateSelected2->format('Y-m-d'); // Format the end date
        } else if ($rate->rp_rate_description == 'Monthly') {
          $end = $request->start_time;
         $endDateFormatted = $request->dateSelected2->format('Y-m-d'); // Format the end date
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
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

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
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

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
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

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
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

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
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

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
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

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
          $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

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

      $reserve = new Reservations();
      $reserve->c_name = $request->customer_name;
      $reserve->c_email = $request->customer_email;
      $reserve->phone_num = $request->customer_num;
      $reserve->c_guest_emails = $request->multipleEmail;
      $reserve->request = $request->customer_request;
      $reserve->room_id = $request->room_id;
      $reserve->pax = $request->customer_count;
      $reserve->rate_id = $request->customer_bill;
      $reserve->start_date = Carbon::createFromFormat('m/d/Y', $request->dateSelected)->format('Y-m-d');
      $reserve->end_date = $endDateFormatted;
      $reserve->start_time = $request->start_time;
      $reserve->end_time = $end;
      $reserve->date_approved =  Carbon::now();
      $reserve->status = 1;
      $reserve->save();
      return response()->json(['status' => 'success', 'message' => "Room Successfully reserved", 'reload' => 'getPendingReservation', 'modal' => 'addEvent']);
    }else if($request->process == 'accept'){
      $reserve = Reservations::where('r_id',$request->r_id)->first();
      $reserve->status = "1";
      $reserve->save();
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
      $reserve->status ='4';
      $reserve->reason = $request->cancelReason;
      $reserve->save();

      return response()->json(['status' => 'success', 'message' => "Reservation canceled successfully", 'reload' => 'getPendingReservation', 'modal' => 'viewCancelReservation']);
    }else if($request->process == 'resched'){

      if($request->re_r_id==''||$request->roomSelect==''||$request->rateSelect==''||$request->reschedDate==''||$request->reschedDate2==''||$request->reschedReason==''){
        return response()->json(['status' => 'error', 'message' => "Please fill-up all required fields", 'reload' => 'getPendingReservation']);
      }
      $reSched = Reservations::where('r_id', $request->re_r_id)->first();
      $formattedDateStart = Carbon::createFromFormat('m/d/Y', $request->reschedDate)->format('Y-m-d');
      $formattedDateEnd = Carbon::createFromFormat('m/d/Y', $request->reschedDate2)->format('Y-m-d');
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
              ->where('end_date', '>=', $date)->where('status', 1)->where('status', 2);
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
              ->where('end_date', '>=', $date)->where('status', 1)->where('status', 2);
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
    $cancel = CancellationReasons::all();

    return response()->json(['data'=> $cancel]);
  }

  public function CancelReservationActive(Request $req){
    $reservation = Reservations::where('r_id', $req->id)->first();

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
}
