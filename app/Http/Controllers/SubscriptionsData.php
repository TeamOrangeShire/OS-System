<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use App\Models\ServiceHP;
use App\Models\CustomerAcc;
use App\Models\CustomerNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
           
      
            'sub_cancel'=> 1,
            'sub_cancel_reason'=>$reasonlist,
   
        ]);
        return redirect()->back();
    }

    public function Subscribe(Request $req){
        $payment = $req->payment;
        $service_id = $req->service_id;
        $customer_id = $req->cookie('customer_id');
        $service = ServiceHP::where('service_id', $service_id)->first();
        do {
            $checkInitialId = TransactionId();
            $checkId = Subscriptions::where('transaction_id', $checkInitialId)->first();
        } while ($checkId !== null);
        
        $transactionId = $checkInitialId;
        if($payment === "walkin"){
        $start = null;
        $end = null;
        $status = 0;
        $label = 'Pending';
        $notif_message =  'Subscription Request Sent! Waiting for Confirmation with a transaction id of <strong>'. $transactionId. "</strong>";     
        $header = 'Waiting for Confirmation <b>'.$service->service_name.'</b>';
        }else{
         $start = Carbon::now()->toDateString();
         $end = Carbon::now()->addMonth()->toDateString();
         $status = 1;
         $customer = CustomerAcc::where('customer_id', $customer_id)->first();
         $newBalance = $customer->account_credits - $service->service_price;
         $customer->update([
            'account_credits'=> $newBalance,
         ]);
         $label = 'Success';
         $header = 'Successfully Purchased <b>'.$service->service_name.'</b>';
         $notif_message =  'You are now currently subscribed in this plan from ' . Carbon::now()->toDateString() . " to ". Carbon::now()->addMonth()->toDateString(). ' with a transaction id of <strong>'. $transactionId. "</strong>";     
        }
      
        
        $subs = new Subscriptions();
        $subs->customer_id = $customer_id;
        $subs->service_id = $service_id;
        $subs->sub_start = $start;
        $subs->sub_end = $end;
        $subs->sub_time = HoursToMinutes($service->service_hours);
        $subs->sub_status = $status;
        $subs->sub_cancel = 0;
        $subs->sub_cancel_reason = '';
        $subs->transaction_id = $transactionId;
        $subs->save();

         $notif = new CustomerNotification();
         $notif->user_id = $customer_id;
         $notif->user_type = 'Customer';
         $notif->notif_header = $header;
         $notif->notif_message = $notif_message;
         $notif->notif_status = 0;
         $notif->notif_label = $label;
         $notif->notif_table = 'Subscription';
         $notif->notif_table_id = $subs->sub_id;
         $notif->save();
      

        return response()->json(['status'=>'success']);
    }
}
