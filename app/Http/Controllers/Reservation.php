<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Reservations;
use App\Models\CustomerAcc;
use App\Models\RoomPricing;
use App\Models\RoomRate;
use App\Models\Rooms;
use Carbon\Carbon;

class Reservation extends Controller
{
    
    public function getRoomData(Request $req){
      $room = Rooms::select('room_id','room_number')->where('room_id', '!=', 0)->get();
    return response()->json(['data'=>$room,'status' => 'success']);
    }
    public function getReservation(Request $request){
      $data = Reservations::all();
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
}
