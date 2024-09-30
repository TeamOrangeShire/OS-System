<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Reservations;
use App\Models\CustomerAcc;
use App\Models\RoomRates;
use App\Models\Rooms;

class Reservation extends Controller
{
    public function getRooms(){
        $rooms = Rooms::where('rooms_disable', 0)->get();
        $rates = RoomRates::where('rp_disable', 0)->get();
        return response()->json(['success'=> true, 'rooms'=> $rooms, 'rates'=> $rates]);
    }
}
