<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promos;
use App\Models\Rooms;
use App\Models\ServiceHP;
use App\Models\Subscriptions;
use Illuminate\Http\Request;

class AddData extends Controller
{
    public function AddPromo(Request $request){

        $data = new Promos;
        $data->promo_name = $request->promo_name;
        $data->promo_percentage = $request->promo_percentage;
        $data->save();
        return redirect()->back();

    }
    public function AddPlan(Request $request){
        
        $data = new ServiceHP;
        $data->service_name = $request->service_name;
        $data->service_hours = $request->service_hours;
        $data->service_price = $request->service_price;
        $data->promo_id = $request->service_id;
        $data->save();
        return redirect()->back();
    }
    public function AddRoom(Request $request){
        
        $data = new Rooms;
        $data->room_number = $request->room_number;
        $data->room_capacity = $request->room_capacity;
        $data->save();
        return redirect()->back();

    }
}
