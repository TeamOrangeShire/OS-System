<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use Illuminate\Http\Request;


class SubscriptionsData extends Controller
{
   
    public function ConfirmSubscription(Request $request){

        $sub_id = $request->sub_id;
        $currentDate = now();
        $date = $currentDate->format("d-m-Y");
    
  
        $dateAfterOneMonth = $currentDate->addMonth()->format("d-m-Y");
        $update =  Subscriptions::where('sub_id',$sub_id)->first();
            
        $update->update([
           
            'sub_start'=> $date,
            'sub_end'=> $dateAfterOneMonth,
            'sub_status'=> 1,
          
   
        ]);
        return redirect()->back();
    }
    public function CancelPendingSubscription(Request $request){

        $sub_id = $request->sub_id;
        $reasonlist = $request->reasonlist;
    
        $update =  Subscriptions::where('sub_id',$sub_id)->first();
            
        $update->update([
           
      
            'sub_cancel'=> 3,
            'sub_cancel_reason'=>$reasonlist,
   
        ]);
        return redirect()->back();
    }
}
