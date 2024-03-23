<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoomPricing;
use App\Models\RoomRate;
use App\Models\Reservations;
use App\Models\Rooms;
use Illuminate\Http\Request;

class GetDataViews extends Controller
{
    public function GetHomeCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.index', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.index', ['customer_id'=> 'none']);
        }
    }

    public function GetSolutionsCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.solutions', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.solutions', ['customer_id'=> 'none']);
        }
    }

    public function GetReservationCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $room = Rooms::orderBy('room_number')->where('rooms_disable', '!=', 1)->get();

        $room_array=[];

        foreach($room as $array){
            array_push($room_array, $array->room_id);
        }
        if ($userId) {
            return view('homepage.reservation', [
                'customer_id'=>$userId,
                'room_array'=>  $room_array
            ]);
        } else {
            return view('homepage.reservation', ['customer_id'=> 'none', 'room_array'=> $room_array]);
        }
    }
    
    public function GetContactCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.contact', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.contact', ['customer_id'=> 'none']);
        }
    }
    public function GetBookCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $room = Rooms::orderBy('room_number')->where('rooms_disable', '!=', 1)->get();

        $room_array=[];

        foreach($room as $array){
            array_push($room_array, $array->room_id);
        }
        if ($userId) {
            return view('homepage.book', [
                'customer_id'=>$userId,
                'room_array'=> $room_array
            ]);
        } else {
            return view('homepage.book', ['customer_id'=> 'none', 'room_array'=>$room_array]);
        }
    }

    public function CustomerProfile(Request $req){
        $userId = $req->cookie('customer_id');

        return view('homepage.Dashboard.profile', ['user_id'=>$userId]);
    }

    public function CustomerSubscription(Request $req){
        $userId = $req->cookie('customer_id');

        return view('homepage.Dashboard.subscription', ['user_id'=>$userId]);
    }
    public function CustomerReservation(Request $req){
        $userId = $req->cookie('customer_id');

        return view('homepage.Dashboard.reservation', ['user_id'=>$userId]);
    }
    public function CustomerSettings(Request $req){
        $userId = $req->cookie('customer_id');

        return view('homepage.Dashboard.settings', ['user_id'=>$userId]);
    }

    public function GetRoomRate(Request $req){

        $room_id = $req->input('room_id');

        $rates = RoomPricing::where('room_id', $room_id)->get();
        $rate_id= [];
        $rate_name = [];
        $rate_price = [];


        foreach($rates as $r){
            array_push($rate_id, $r->room_rates);
            $rateQuery = RoomRate::where('rate_id', $r->room_rates)->first();
            array_push($rate_name, $rateQuery->rate_name);
            array_push($rate_price, $rateQuery->rate_price);
        }
        return response()->json(['rate_id'=>$rate_id, 'rate_name'=>$rate_name, 'rate_price'=>$rate_price]);
    }

    public function CheckTime(Request $req){
        $rate_id = $req->input('rate_id');
        $date = $req->input('date');

        $checkStart= Reservations::where('res_date', $date)->first();
        $checkEnd= Reservations::where('res_date', $date)->latest()->first();
        $checkDate= Reservations::where('res_date', $date)->latest()->first();
        $checkRate = RoomRate::where('rate_id', $rate_id)->first();
        if($checkRate->rate_name === 'Hourly'){
           $freq = 1;
        }else if($checkRate->rate_name === '4 Hours'){
            $freq = 4;
        }else{
            $freq = 0;
        }

        if($checkDate){
            return response()->json(['timeStart'=>$checkStart->res_start, 'timeEnd'=>$checkEnd->res_end, 'rate'=>$freq]);
        }else{
            return response()->json(['timeStart'=>'none', 'timeEnd'=>'none', 'rate'=>$freq]);
        }

    }


    public function GetTimeForDate(Request $req){
        $date = $req->date;

        $checkDate = Reservations::where('res_date', $date)->get();
        if($checkDate){

        }else{
            
        }
    }
}
