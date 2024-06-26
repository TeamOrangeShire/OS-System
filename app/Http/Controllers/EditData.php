<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promos;
use App\Models\RoomPricing;
use App\Models\RoomRate;
use App\Models\Rooms;
use App\Models\ServiceHP;
use App\Models\CustomerNotification;
use Illuminate\Http\Request;

class EditData extends Controller
{
    public function EditPromo(Request $request){

        $promo_id = $request->promo_id;
        $promo_name = $request->promo_name;
        $promo_percentage = $request->promo_percentage;

        $checkdata = Promos::where('promo_name',$promo_name)->first();
        if($checkdata){
            return response()->json(['status'=> 'exist']);

        } else { 

        $update =  Promos::where('promo_id',$promo_id)->first();
        $update->update([
           
            'promo_name'=> $promo_name,
            'promo_percentage'=> $promo_percentage,

        ]);
        return response()->json(['status'=> 'success']);
    }
    }
    public function EditPlan(Request $request){

        $plan_id = $request->plan_id;
        $plan_name = $request->plan_name;
        $plan_hours = $request->plan_hours;
        $plan_price = $request->plan_price;
        $promolist = $request->promolist;

        $checkdata = ServiceHP::where('service_name',$plan_name)->where('service_hours', $plan_hours)->where('service_price', $plan_price)->where('promo_id', $promolist)->first();
            if($checkdata){
                return response()->json(['status'=> 'exist']);

            } else {

        $update =  ServiceHP::where('service_id',$plan_id)->first();
        
        $update->update([

            'service_name'=> $plan_name,
            'service_hours'=> $plan_hours,
            'service_price'=> $plan_price,
            'promo_id'=> $promolist,
   
        ]);
        return response()->json(['status'=> 'success']);
    }

        }
        public function EditRoom(Request $request){

            $room_id = $request->room_id;
            $edit_room = $request->edit_room;
            $edit_room_c = $request->edit_room_c;
            $check =  Rooms::where('room_number',$edit_room)->where('room_capacity',$edit_room_c)->first();
            if($check){
                return response()->json(['status'=>'exist']);
            }else{
                $update =  Rooms::where('room_id',$room_id)->first();
            
                $update->update([
                   
                    'room_number'=> $edit_room,
                    'room_capacity'=> $edit_room_c,
                  
           
                ]);
                return response()->json(['status'=>'success']);
            }
        

        }
        public function EditRate(Request $request){

            $rate_id = $request->rate_id;
            $edit_rate_name = $request->edit_rate_name;
            $edit_rate_price = $request->edit_rate_price;
           
            $checkdata = RoomRate::where('rate_name',$edit_rate_name)->where('rate_price', $edit_rate_price)->first();
            if($checkdata){
                return response()->json(['status'=> 'exist']);

            } else{

            $update =  RoomRate::where('rate_id',$rate_id)->first();
            
            
            $update->update([
               
                'rate_name'=> $edit_rate_name,
                'rate_price'=> $edit_rate_price,
              
       
            ]);
            return response()->json(['status'=> 'success']);
        }

        }
        public function EditRoomRate(Request $request){

            $roompriceid = $request->roompriceid;
            $rom_numb2 = $request->rom_numb2;
            $room_rate_list1 = $request->room_rate_list1;
            $promolist1 = $request->promolist1;


            $check =  RoomPricing::where('room_id',$rom_numb2)->where('room_rates',$room_rate_list1)->where('promo_id',$promolist1)->first();
            if($check){
                return response()->json(['status'=>'exist']);

            }else{
                $update =  RoomPricing::where('rprice_id',$roompriceid)->first();
            
                $update->update([
                   
                    'room_id'=> $rom_numb2,
                    'room_rates'=> $room_rate_list1,
                    'promo_id'=> $promolist1,
                  
           
                ]);
                return response()->json(['status'=>'success']);
            }
           

        }
        public function DisableRate(Request $request){

            $rate_id = $request->rate_id;
           
            $update =  RoomRate::where('rate_id',$rate_id)->first();
            
            $update->update([
               
                
                'rate_disable'=> 1,
              
       
            ]);
            $update2 =  RoomPricing::where('room_rates',$rate_id)->get();
            
            foreach($update2 as $drp){
                $drp->update([
                    'room_pricing_disable'=> 1,
                ]);
            }
            return redirect()->back()->with('disabled','h');

        }
        public function EnableRate(Request $request){

            $rate_id = $request->rate_id;
           
            $update =  RoomRate::where('rate_id',$rate_id)->first();
            
            $update->update([
               
                
                'rate_disable'=> 0,
              
       
            ]);
            $update2 =  RoomPricing::where('room_rates',$rate_id)->get();
            
                
                foreach($update2 as $rr_id){
            
            $room_id = $rr_id->room_id;
            $update3 =  Rooms::where('room_id',$room_id)->first();
            $room_status = $update3->rooms_disable;
            $roomid = $update3->room_id;

            if( $room_status == 0){
                
                $update4 =  RoomPricing::where('room_id',$roomid)->where('room_rates',$rate_id)->get();
                foreach($update4 as $erp){
                    $erp->update([
                        'room_pricing_disable'=> 0,
                    ]);
                }
            }
            }
            return redirect()->back()->with('enabled','h');
        }
        

        public function DisableRoom(Request $request){

            $room_id = $request->ro_id;
           
            $update =  Rooms::where('room_id',$room_id)->first();
            
            $update->update([
               
                
                'rooms_disable'=> 1,
              
       
            ]);
            $update2 =  RoomPricing::where('room_id',$room_id)->get();
            
            foreach($update2 as $drp){
                $drp->update([
               
                
                    'room_pricing_disable'=> 1,
                  
           
                ]);
            }

            return redirect()->back()->with('disabled','h');

        }
        public function EnableRoom(Request $request){

            $room_id = $request->ro_id;
           
            $update =  Rooms::where('room_id',$room_id)->first();
            
            $update->update([
               
                
                'rooms_disable'=> 0,
              
       
            ]);
            $update2 =  RoomPricing::where('room_id',$room_id)->get();

                foreach($update2 as $rrp_id){

            $rate_id = $rrp_id->room_rates;
            $update3 =  RoomRate::where('rate_id',$rate_id)->first();
            $rate_status = $update3->rate_disable;
            $rateid = $update3->rate_id;

            if( $rate_status == 0){

                $update4 =  RoomPricing::where('room_rates',$rateid)->where('room_id',$room_id)->get();
                foreach($update4 as $erp){
                    $erp->update([
                        
                        'room_pricing_disable'=> 0,
                      
               
                    ]);
                }

            }

            }
        
             
            return redirect()->back()->with('enabled','h');

        }
        public function DisableRoomRate(Request $request){

            $rp_id = $request->rp_id;
           
            $update =  RoomPricing::where('rprice_id',$rp_id)->first();
            
            $update->update([
               
                
                'room_pricing_disable'=> 1,
              
       
            ]);
            
            return redirect()->back()->with('disabled','h');

        }
        public function EnableRoomRate(Request $request){

            $rp_id = $request->rp_id;
            $room_id = $request->room_id;
            $room_rates = $request->room_rates;
                $rooms =  Rooms::where('room_id',$room_id)->first();
                $room_status = $rooms->rooms_disable;
                if($room_status == 0){
    
                $rates =  RoomRate::where('rate_id',$room_rates)->first();
                $rate_status = $rates->rate_disable;
                if($rate_status == 0){
    
                    $update =  RoomPricing::where('rprice_id',$rp_id)->first();
                
                    $update->update([
                       
                        
                        'room_pricing_disable'=> 0,
                      
               
                    ]);
                    return redirect()->back()->with('enabled','h');
    
                }
                }
            return redirect()->back();

        }
        public function DisablePromo(Request $request){

            $promo_id = $request->promoid;
           
            $update =  Promos::where('promo_id',$promo_id)->first();
            $update->update([
                'promos_disable'=> 1,
            ]);
            $update2 =  RoomPricing::where('promo_id',$promo_id)->get();
            foreach($update2 as $dprp){
              $dprp->update([

                'promo_id'=> 6,

              ]);
               
            }
            $update3 =  ServiceHP::where('promo_id',$promo_id)->get();
            foreach($update3 as $dshp){
              $dshp->update([

                'promo_id'=> 6,

              ]);
               
            }

            return redirect()->back()->with('disabled','h');

        }

        public function EnablePromo(Request $request){

            $promo_id = $request->promoid;
           
            $update =  Promos::where('promo_id',$promo_id)->first();
            
            $update->update([
               
                
                'promos_disable'=> 0,
              
       
            ]);
            
            return redirect()->back()->with('enabled','h');

        }
        public function EnablePlan(Request $request){

            $service_id = $request->planid;
           
            $update =  ServiceHP::where('service_id',$service_id)->first();
            
            $update->update([
               
                
                'service_disable'=> 0,
              
       
            ]);
            
            return redirect()->back()->with('enabled','h');

        }
        public function DisablePlan(Request $request){

            $service_id = $request->planid;
           
            $update =  ServiceHP::where('service_id',$service_id)->first();
            
            $update->update([
               
                
                'service_disable'=> 1,
              
       
            ]);
            
            return redirect()->back()->with('disabled','h');

        }

  public function ReadAllNotificationCustomer(Request $req){
    $cust = CustomerNotification::where('user_id', $req->cust_id)->where('user_type', 'Customer')->get();

    foreach($cust as $notif){
        $notif->update([
            'notif_status'=>1,
        ]);
    
    }
    return response()->json(['status'=>'success']);
  }

  public function ReadNotif(Request $req){
    $id = $req->notif_id;
    CustomerNotification::where('notif_id', $id)->first()->update(['notif_status'=>1]);
    return response()->json(['status'=>'success']);
  }
}
