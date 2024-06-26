<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promos;
use App\Models\RoomPricing;
use App\Models\RoomRate;
use App\Models\Rooms;
use App\Models\ServiceHP;
use App\Models\Subscriptions;
use Illuminate\Http\Request;

class AddData extends Controller
{
    public function AddPromo(Request $request){
        
        $promo_name = $request->promo_name;

        $checkdata = Promos::where('promo_name',$promo_name)->first();

        if($checkdata){ 
            return response()->json(['status'=> 'exist']);
        } else { 

        $data = new Promos;
        $data->promo_name = $request->promo_name;
        $data->promo_percentage = $request->promo_percentage;
        $data->save();
        return response()->json(['status'=> 'success']);
    }

    }

    public function AddPlan(Request $request){
        $service_name = $request->service_name;
        $service_hours = $request->service_hours;
        $service_price = $request->service_price;

        $checkdata = ServiceHP::where('service_name',$service_name)->where('service_hours', $service_hours)->where('service_price', $service_price)->first();
        if($checkdata){ 
            return response()->json(['status'=> 'exist']);
        } else { 
        
        $data = new ServiceHP;
        $data->service_name = $request->service_name;
        $data->service_hours = $request->service_hours;
        $data->service_price = $request->service_price;
        $data->promo_id = $request->service_id;
        $data->save();
        return response()->json(['status'=> 'success']);
        
        }
    }
    public function AddRoom(Request $request){
        
        $room_number = $request->room_number;
        $check = Rooms::where('room_number',$room_number)->first();
        if($check){
            return response()->json(['status'=>'exist']);
        }else{
            $data = new Rooms;
            $data->room_number = $request->room_number;
            $data->room_capacity = $request->room_capacity;
            $data->save();
            return response()->json(['status'=>'success']);
        }
      

    }
    public function AddRate(Request $request){
        $rate_name = $request->rate_name;
        $rate_price = $request->rate_price;


        $checkdata = RoomRate::where('rate_name',$rate_name)->where('rate_price', $rate_price)->first();
        if($checkdata){ 
            return response()->json(['status'=> 'exist']);
        } 
        else{
            $data = new RoomRate;
            $data->rate_name = $request->rate_name;
            $data->rate_price = $request->rate_price;
            $data->rate_disable = 0;
            $data->save();
            return response()->json(['status'=> 'success']);
        }
    }
    public function AddRoomRate(Request $request){
        
        $room_id = $request->add_room_rate_pricing_id;
        $room_rates = $request->add_rate_pricing_id;
        $check =  RoomPricing::where('room_id',$room_id)->where('room_rates',$room_rates)->first();
        if($check){  

            return response()->json(['status'=>'exist']);

           }else{
            $data = new RoomPricing;
        $data->room_id = $request->add_room_rate_pricing_id;
        $data->room_rates = $request->add_rate_pricing_id;
        $data->promo_id = 6;
        $data->save();
        
        return response()->json(['status'=>'success']);
           }
        

    }
}
