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


    public function getRoomData(Request $req){
      $room = Rooms::select('room_id','room_number', 'room_capacity')->get();
      $roomRate = RoomRates::select('rp_id', 'room_id', 'rp_rate_description','rp_price')->get();

    return response()->json(['room'=>$room, 'rate'=>$roomRate,'status' => 'success']);
    }
    public function getRooms(){
        $rooms = Rooms::where('rooms_disable', 0)->get();
        $rates = RoomRates::where('rp_disable', 0)->get();
        return response()->json(['success'=> true, 'rooms'=> $rooms, 'rates'=> $rates]);

    }
    public function getReservation(Request $request){
      $data = Reservations::join('rooms', 'reservations.room_id', '=', 'rooms.room_id')->get();

    return response()->json(['data'=>$data,'status' => 'success']);
    }
    public function reservationData(Request $request){
      if($request->process=='add'){
      $data = new Reservations;
      $data->c_name = $request->customer_name;
      $data->c_email = $request->customer_email;
      $data->c_guest_emails = $request->emailInput;
      $data->phone_num = $request->customer_num;
      $data->start_date = $request->checkin;
      $data->end_date = $request->checkout;
      $data->room_id  = $request->room;
      $data->billing = $request->email;
      $data->pax = $request->email;
      $data->status = '1';
      $data->date_approved = Carbon::today();
      $data->save();
      return response()->json(['status' => 'success']);
      }
    }

    public function SubmitReservationCustomer(Request $req)
    {
        $reserve = new Reservations();
        $endTime = "";
        switch($req->endDateType){
            case "Daily":
                $endDate = $req->endDates;
                break;
            case "Weekly":
                $endDate = $req->endDates;
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
                $endDate = $formattedDate;
                break;
            case "Hourly":
                $endDate = $req->startDate;
                $endTime = $req->endDates;
                break;
            default:
                break;
        }
        $reserve->c_name = $req->name;
        $reserve->c_email = $req->email;
        $reserve->phone_num = $req->contact;
        $reserve->c_guest_emails = $req->guestemails;
        $reserve->request = $req->reservationRequest;
        $reserve->end_date = $endDate;
        $reserve->start_date = $req->startDate;
        $reserve->start_time = $req->startTime;
        $reserve->end_time = $endTime;
        $reserve->room_id = $req->reserveType;
        $reserve->pax = $req->reserveType == 0 ? $req->paxhotdesk : $req->pax;
        $reserve->rate_id = $req->rates;
        $reserve->status = 0;
        $reserve->save();

        Mail::to($req->email)->send(new ReservationResponse());

        if($req->guestemails != ""){
            $emails = explode(',', $req->guestemails);

            array_pop($emails);

            foreach($emails as $em){
                $cleanEmail = str_replace(' ', '', $em);
                try{
                    Mail::to($cleanEmail)->send(new ReservationResponse());
                }catch(Exception $ex){
                   // Ignore
                }
            }
        }


        return response()->json(['success'=> true]);
    }
}
