<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\RoomRates;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationResponse;
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
    $data = Reservations::join('rooms', 'reservations.room_id', '=', 'rooms.room_id')->get();

    return response()->json(['data' => $data, 'status' => 'success']);
  }

  public function SubmitReservationCustomer(Request $req)
  {
    $reserve = new Reservations();

    // Ensure startTime is in 'h:i A' format
    $rateDetails = RoomRates::where('rp_id', $req->rates)->first();
    $startTime = Carbon::createFromFormat('h:i A', $req->startTime);
    if ($rateDetails) {
      // Determine end time based on rate description

      switch ($rateDetails->rate_description) {
        case "Hourly":
          $endTime = $startTime->copy()->addHour();
          break;
        case "4 Hours":
          $endTime = $startTime->copy()->addHours(4);
          break;
        default:
          $endTime = $startTime; // Ensure endTime is a Carbon instance
          break;
      }
    } else {
      $endTime = "";
    }

    $reserve->c_name = $req->name;
    $reserve->c_email = $req->email;
    $reserve->phone_num = $req->contact;
    $reserve->c_guest_emails = $req->guestemails;
    $reserve->request = $req->reservationRequest;
    $reserve->room_id = (int) $req->reserveType;
    $reserve->pax = (int) $req->reserveType != 0 ? $req->pax : $req->paxhotdesk;
    $reserve->rate_id = (int) $req->rates;
    $reserve->start_date = Carbon::parse($req->startDate)->format('Y-m-d');
    $reserve->end_date = Carbon::parse($req->endDate)->format('Y-m-d');
    $reserve->start_time = $startTime->format('H:i:s');
    $reserve->end_time = $endTime == "" ? "" : $endTime->format('H:i:s');
    $reserve->status = 0;
    $reserve->save();

    Mail::to($req->email)->send(new ReservationResponse());

    if ($req->guestemails != "") {
      $emails = explode(',', $req->guestemails);

      array_pop($emails);

      foreach ($emails as $em) {
        $cleanEmail = str_replace(' ', '', $em);
        try {
          Mail::to($cleanEmail)->send(new ReservationResponse());
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
          return response()->json(['status' => 'error', 'message' => "$key Please fill in all fields"]); // Return an error response
        }
      }
      $rate = RoomRates::where('rp_id', $request->customer_bill)->first();


      if ($rate->rp_rate_description == 'Hourly') {
        $startDate = $request->start_date;  // Example start date
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
      } else if ($rate->rp_rate_description == '4 Hours') {
        $startDate = $request->start_date;  // Example start date
        $start = $request->start_time;  // Example start time, e.g., "16:00"
        $startTime = Carbon::createFromFormat('H:i', $start); // Parse the time using Carbon
        $endTime = $startTime->copy()->addHours(4); // Add 4 hours to the start time
        $endDate = Carbon::createFromFormat('Y-m-d', $startDate); // Parse the start date

        // Check if the end time exceeds midnight
        if ($endTime->format('H:i') < $startTime->format('H:i')) {
          // If the end time is earlier than the start time, it means it went past midnight
          $endDate->addDay();  // Add one day to the end date
        }

        $end = $endTime->format('H:i'); // Format the end time
        $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
      } else if ($rate->rp_rate_description == 'Daily (12 Hours)') {
        $startDate = $request->start_date;
        $start = $request->start_time;
        $end = $request->start_time;
        $endDateFormatted = $request->end_date;
      } else if ($rate->rp_rate_description == 'Weekly') {
        $startDate = $request->start_date; // e.g., '2024-10-03' (3rd October 2024)
        $endDate = $request->end_date;     // e.g., '2024-W43' (ISO week)

        // Convert $startDate to a Carbon instance
        $startCarbon = Carbon::createFromFormat('Y-m-d', $startDate);

        // Extract the year and week number from the endDate
        list($year, $week) = explode('-W', $endDate);

        // Get the first day of the specified ISO week
        $endWeekStart = Carbon::now()->setISODate($year, $week, 1); // Monday of the week

        // Calculate the number of weeks between the start date and the desired end week
        $weeksDiff = $startCarbon->diffInWeeks($endWeekStart);

        // Calculate the specific end date by adding the difference in weeks
        $specificEndDate = $startCarbon->copy()->addWeeks($weeksDiff);

        // Check if the specific end date is within the same week as the desired week
        $endDateCarbon = $endWeekStart->copy()->addDays(6); // Get the last day (Sunday) of the desired week

        // Ensure the specific end date does not exceed the desired end week
        if ($specificEndDate->greaterThan($endDateCarbon)) {
          $specificEndDate = $endDateCarbon; // Set it to the end of the specified week
        }

        // Add 7 days to the final end date
        $specificEndDate->addDays(7); // Add 7 days to the specific end date
        $end = $request->start_time;
        // Format the end date
        $endDateFormatted = $specificEndDate->format('Y-m-d'); // Format the end date
      } else if ($rate->rp_rate_description == 'Monthly') {
        $startDate = $request->start_date; // Format: Y-m-d
        $endDate = $request->end_date; // Format: Y-m (e.g., '2024-11')

        // Convert the start date to a Carbon instance
        $start = Carbon::createFromFormat('Y-m-d', $startDate);

        // Parse the endDate to get the year and month
        list($year, $month) = explode('-', $endDate);

        // Get the day from the start date
        $day = $start->day;

        // Set the end date to the same day of the specified month
        $endDate = Carbon::createFromDate($year, $month, $day);

        $end = $request->start_time;
        $endDateFormatted = $endDate->format('Y-m-d'); // Format the end date
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
      $reserve->start_date = $request->start_date;
      $reserve->end_date = $endDateFormatted;
      $reserve->start_time = $request->start_time;
      $reserve->end_time = $end;
      $reserve->date_approved =  Carbon::now();
      $reserve->status = 1;
      $reserve->save();
      return response()->json(['status' => 'success', 'message' => "$end and $endDateFormatted"]);
    }

    return response()->json(['status' => 'success']);
  }
}
