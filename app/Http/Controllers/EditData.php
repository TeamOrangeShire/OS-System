<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promos;
use App\Models\RoomPricing;
use App\Models\RoomRate;
use App\Models\Rooms;
use App\Models\ServiceHP;
use Illuminate\Http\Request;

class EditData extends Controller
{
    public function EditPromo(Request $request){

        $promo_id = $request->promo_id;
        $promo_name = $request->promo_name;
        $promo_percentage = $request->promo_percentage;
        $update =  Promos::where('promo_id',$promo_id)->first();
        $update->update([
           
            'promo_name'=> $promo_name,
            'promo_percentage'=> $promo_percentage,
           
           
    
        ]);
        return redirect()->back();
    }
    public function EditPlan(Request $request){
        $plan_id = $request->plan_id;
        $plan_name = $request->plan_name;
        $plan_hours = $request->plan_hours;
        $plan_price = $request->plan_price;
        $promolist = $request->promolist;
        $update =  ServiceHP::where('service_id',$plan_id)->first();
        
        $update->update([
           
            
            'service_name'=> $plan_name,
            'service_hours'=> $plan_hours,
            'service-price'=> $plan_price,
            'promo_id'=> $promolist,
   
        ]);
        return redirect()->back();
        }
        public function EditRoom(Request $request){

            $room_id = $request->room_id;
            $edit_room = $request->edit_room;
            $edit_room_c = $request->edit_room_c;
           
            $update =  Rooms::where('room_id',$room_id)->first();
            
            $update->update([
               
                'room_number'=> $edit_room,
                'room_capacity'=> $edit_room_c,
              
       
            ]);
            return redirect()->back();

        }
        public function EditRate(Request $request){

            $rate_id = $request->rate_id;
            $edit_rate_name = $request->edit_rate_name;
            $edit_rate_price = $request->edit_rate_price;
           
            $update =  RoomRate::where('rate_id',$rate_id)->first();
            
            $update->update([
               
                'rate_name'=> $edit_rate_name,
                'rate_price'=> $edit_rate_price,
              
       
            ]);
            return redirect()->back();

        }
        public function EditRoomRate(Request $request){

            $roompriceid = $request->roompriceid;
            $rom_numb2 = $request->rom_numb2;
            $room_rate_list1 = $request->room_rate_list1;
            $promolist1 = $request->promolist1;
           
            $update =  RoomPricing::where('rprice_id',$roompriceid)->first();
            
            $update->update([
               
                'room_id'=> $rom_numb2,
                'room_rates'=> $room_rate_list1,
                'promo_id'=> $promolist1,
              
       
            ]);
            return redirect()->back();

        }
        public function DisableRate(Request $request){

            $rate_id = $request->rate_id;
           
            $update =  RoomRate::where('rate_id',$rate_id)->first();
            
            $update->update([
               
                
                'rate_disable'=> 1,
              
       
            ]);
            return redirect()->back();

        }
        public function EnableRate(Request $request){

            $rate_id = $request->rate_id;
           
            $update =  RoomRate::where('rate_id',$rate_id)->first();
            
            $update->update([
               
                
                'rate_disable'=> 0,
              
       
            ]);
            return redirect()->back();

        }

        public function DisableRoom(Request $request){

            $room_id = $request->ro_id;
           
            $update =  Rooms::where('room_id',$room_id)->first();
            
            $update->update([
               
                
                'rooms_disable'=> 1,
              
       
            ]);
            return redirect()->back();

        }
        public function EnableRoom(Request $request){

            $room_id = $request->ro_id;
           
            $update =  Rooms::where('room_id',$room_id)->first();
            
            $update->update([
               
                
                'rooms_disable'=> 0,
              
       
            ]);
            return redirect()->back();

        }

}
