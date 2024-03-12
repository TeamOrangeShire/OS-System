<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promos;
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
           
            'service_id'=> $plan_id,
            'service_name'=> $plan_name,
            'service_hours'=> $plan_hours,
            'service-price'=> $plan_price,
            'promo_id'=> $promolist,
   
        ]);
        return redirect()->back();


    }
}
