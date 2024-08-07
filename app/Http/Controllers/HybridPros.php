<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerAcc;
use App\Models\HybridHistoryLogs;
use App\Models\HybridProsHistory;
use Illuminate\Http\Request;
use App\Models\HybridProsModel;
use App\Models\ServiceHP;
use App\Services\AdminLog;
use Carbon\Carbon;

class HybridPros extends Controller
{
    public function RegisterCustomer(Request $req){

        $service = ServiceHP::where('service_id', $req->select_plan)->first();
        $date = Carbon::now()->setTimezone('Asia/Hong_Kong');
        $hp = new HybridProsModel();
        $hph = new HybridProsHistory();

        $hp->hp_customer_name = $req->customername;
        $hp->hp_phone_number = empty($req->phonenumber) ? 0 : $req->phonenumber;
        $hp->hp_email = empty($req->email) ? '' : $req->email;
        $hp->save();

        $hph->hp_id = $hp->hp_id;
        $hph->service_id = $req->select_plan;
        $hph->hp_plan_start = $date->format('F j, Y');
        $hph->hp_plan_expire = $date->copy()->addDays($service->service_days)->format('F j, Y');
        $hph->hp_remaining_time = $service->service_hours == 99999 ? 'Unlimited' : $service->service_hours . ':00';
        $hph->hp_payment_mode = '';
        $hph->save();


        $header = 'Register Hybrid Pros Customer';
        $message = 'Customer ' . $req->customername . " has been recorded in the system";
        $location = 'hybridpros';
        $log = new AdminLog($header, $message, $location);
        $log->save();

        return response()->json(['status'=>'success']);
    }

    public function CustomerList(){
        $hp = HybridProsModel::all();

        foreach($hp as $h){
            $hph = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_payment_status', 0)->first();
            $hphActive = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_active_status', 1)->first();
            $inUse = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_active_status', 1)->where('hp_inuse_status', 1)->first();
            $h->payment = $hph ? 0 : 1;
            $h->active = $hphActive ? 1 : 0;
            $h->inuse = $inUse ? 1 : 0;
            $h->remaining_time = $hphActive ? $hphActive->hp_remaining_time : '00:00';
            if($hphActive){
                $hphActiveAll = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_active_status', 1)->get();

                foreach($hphActiveAll as $active){
                    $service = ServiceHP::where('service_id', $active->service_id)->first();
                    $active->act = $service->service_name;
                    $active->price = $service->service_price;
                }
            }else{
                $hphActiveAll = 'none';
            }

            if($hph){
                $PendingServ = ServiceHP::where('service_id', $hph->service_id)->first();
                $hph->name = $PendingServ->service_name;
                $hph->price = $PendingServ->service_price;
                $h->historyPending = $hph;
            }else{
                $h->historyPending = 'none';
            }

            $h->historyActive = $hphActiveAll;


        }
        return response()->json(['hp'=>$hp]);
    }

    public function BuyNewPlan(Request $req){
        $service = ServiceHP::where('service_id', $req->select_plan)->first();
        $date = Carbon::now()->setTimezone('Asia/Hong_Kong');
        $customer = HybridProsModel::where('hp_id', $req->customer_id)->first();
        $hph = new HybridProsHistory();
        $hph->hp_id = $req->customer_id;
        $hph->service_id = $req->select_plan;



        if($req->select_plan != 9){
            $hph->hp_plan_start = $date->format('F j, Y');
            $hph->hp_plan_expire = $date->copy()->addDays($service->service_days)->format('F j, Y');
            $hph->hp_remaining_time = $service->service_hours == 99999 ? 'Unlimited' : $service->service_hours . ":00";
        }else{

            $specificDate = Carbon::createFromFormat('Y-m-d', $req->expDate);
            $currentDate = Carbon::now();
            $differenceInDays = $currentDate->diffInDays($specificDate);

            if($differenceInDays > 0){
                $hph->hp_plan_start = $date->format('F j, Y');
                $hph->hp_plan_expire = $date->copy()->addDays($differenceInDays + 1)->format('F j, Y');
                $hph->hp_remaining_time =  $req->hours . ':' . $req->minutes;
                $hph->hp_active_status = 1;
                $hph->hp_payment_status = 1;
            }else{
                return response()->json(['status'=>'invalid date']);
            }

        }
        $hph->hp_payment_mode = '';
        $hph->save();


        $header = 'Buy New Plan for Customer';
        $message = 'Customer ' . $customer->hp_customer_name . " Buy new plan " . $service->service_name;
        $location = 'hybridpros_history';
        $log = new AdminLog($header, $message, $location);
        $log->save();
        return response()->json(['status'=>'success']);
    }

    public function AcceptPayment(Request $req){
       $hp = HybridProsHistory::where('hp_id', $req->id)->where('hp_payment_status',0)->first();
       $customer = HybridProsModel::where('hp_id', $req->id)->first();
       $hp->update([
         'hp_payment_status' => 1,
         'hp_payment_mode'=> $req->mode,
         'hp_active_status'=> 1
       ]);


       $header = 'Accepted Payment Hybrid Pros';
       $message = 'Customer ' . $customer->hp_customer_name . " paid his plan by ". $req->mode ;
       $location = 'hybridpros_history';
       $log = new AdminLog($header, $message, $location);
       $log->save();
       return response()->json(['status'=> 'success']);
    }
    public function SearchCustomer(Request $req){
        $hp = HybridProsModel::where('hp_customer_name', 'like', '%' . $req->search . '%')->get();

        foreach($hp as $h){
            $hph = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_payment_status', 0)->first();
            $hphActive = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_active_status', 1)->first();
            $inUse = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_active_status', 1)->where('hp_inuse_status', 1)->first();
            $h->payment = $hph ? 0 : 1;
            $h->active = $hphActive ? 1 : 0;
            $h->inuse = $inUse ? 1 : 0;
            $h->remaining_time = $hphActive->hp_remaining_time;
            if($hphActive){
                $hphActiveAll = HybridProsHistory::where('hp_id', $h->hp_id)->where('hp_active_status', 1)->get();

                foreach($hphActiveAll as $active){
                    $service = ServiceHP::where('service_id', $active->service_id)->first();
                    $active->act = $service->service_name;
                    $active->price = $service->service_price;
                }
            }else{
                $hphActiveAll = 'none';
            }

            if($hph){
                $PendingServ = ServiceHP::where('service_id', $hph->service_id)->first();
                $hph->name = $PendingServ->service_name;
                $hph->price = $PendingServ->service_price;
                $h->historyPending = $hph;
            }else{
                $h->historyPending = 'none';
            }

            $h->historyActive = $hphActiveAll;


        }
        return response()->json(['hp'=>$hp]);
    }

    public function Logging(Request $req){
        $history = HybridProsHistory::where('hp_id', $req->customer_id)->where('hp_active_status', 1)->first();
        $date = Carbon::now()->setTimezone('Asia/Hong_Kong');
        $history->update([
          'hp_inuse_status'=> $req->status
        ]);
        $customer = HybridProsModel::where('hp_id', $req->customer_id)->first();
        if($req->status == 1){
           $mess = 'Logged in';
            $log = new HybridHistoryLogs();
            $log->hph_id = $history->hph_id;
            $log->log_date = $date->addDays(1)->format('F j, Y');
            $log->log_time_in =  $date->format('h:i A');
            $log->log_time_out = '';
            $log->log_time_consume = '';
            $log->log_time_remaining = '';
            $log->log_status = 0;
            $log->save();
        }else{
            $mess = 'Logged Out';
            $log = HybridHistoryLogs::where('hph_id', $history->hph_id)->where('log_status', 0)->first();
            $out = $date->format('h:i A');
            $time = timeDifference($log->log_time_in, $out);
            $log->update([
              'log_time_out' => $date->format('h:i A'),
              'log_time_consume' => $time['hours']. ":".$time['minutes'],
              'log_time_remaining' => $history->hp_remaining_time,
              'log_status' => 1
            ]);
        }
        $header = 'Customer '.$mess.' Hybrid Pros';
        $message = 'Customer ' . $customer->hp_customer_name . " has". $mess . "in hybridpros" ;
        $location = 'hybridpros_history';
        $logs= new AdminLog($header, $message, $location);
        $logs->save();
        return response()->json(['status'=> 'success']);
    }
    public function CustomerExist(){
        $cust = CustomerAcc::all();

        return response()->json(['cust'=>$cust]);
    }
    public function UpdateProfile(Request $req){
        $customer = HybridProsModel::where('hp_id', $req->updateCustomerId)->first();

        $customer->update([
          'hp_customer_name'=> $req->customername,
          'hp_phone_number'=>$req->phonenumber,
          'hp_email'=>$req->email
        ]);
        $header = 'Update Profile';
        $message = 'Customer details of' . $customer->hp_customer_name . " has been updated" ;
        $location = 'hybridpros_history';
        $logs= new AdminLog($header, $message, $location);
        $logs->save();
        return response()->json(['status'=>'success']);
    }

    public function UpdatePlans(Request $req){
       $hp = HybridProsHistory::where('hph_id', $req->hp_id)->first();
       $date = new \DateTime($req->expirationDate);
       $customer = HybridProsModel::where('hp_id',$req->hp_id)->first();
       // Format the date to "F j, Y" which will be "October 18, 2024"
       $formattedDate = $date->format('F j, Y');
       $hp->update([
        'hp_plan_expire_new'=> $formattedDate,
        'hp_remaining_time'=>$req->timeRemaining,
        'hp_active_status'=>$req->active_status
       ]);


       $header = 'Update Plans';
       $message = 'Customer plans' . $customer->hp_customer_name . " has been updated" ;
       $location = 'hybridpros_history';
       $logs= new AdminLog($header, $message, $location);
       $logs->save();
       return response()->json(['status'=>'success']);
    }


    public function CustomerHistory(Request $req){
        $history = HybridProsHistory::where('hp_id', $req->id)->get();

        foreach($history as $h){
            $service = ServiceHP::where('service_id', $h->service_id)->first();

            if(!empty($h->hp_transfer_from_id) ){
                $customer = HybridProsModel::where('hp_id', $h->hp_transfer_from_id)->first();
                if($h->hp_transfer_status == 1){
                    $h->transfer = $customer->hp_customer_name.'(Transfered)';
                }else{
                    $h->transfer = $customer->hp_customer_name.'(Recieved)';
                }
            }else{
                $h->transfer = 'N/A';
            }
            $h->plan_name = $service->service_name;


        }
        return response()->json(['history'=>$history]);
    }

    public function ChangePlan(Request $req){
        $hp = HybridProsHistory::where('hph_id', $req->hph_id)->first();
        if($hp->service_id == $req->select_plan){
         return response()->json(['status'=>'already_selected']);
        }
        $customer = HybridProsModel::where('hp_id',$req->hp_id)->first();
        $givenDate = Carbon::parse($hp->hp_plan_start);
        $service = ServiceHP::where('service_id',$req->select_plan)->first();

        $hp->update([
         'service_id' => $req->select_plan,
         'hp_plan_expire' => $givenDate->addDays($service->service_days)->format('F j, Y'),
         'hp_remaining_time'=>$service->service_hours == 99999 ? 'Unlimited' :  ReduceTimeConsume($service->service_hours. ":00", $hp->hp_consume_time )
        ]);

        $header = 'Change Plan';
        $message = 'Customer plans' . $customer->hp_customer_name . " has been changed" ;
        $location = 'hybridpros_history';
        $logs= new AdminLog($header, $message, $location);
        $logs->save();
        return response()->json(['status'=>'success']);
     }

     public function GetLogHistory(Request $req){
        $hph = HybridHistoryLogs::where('hph_id', $req->hph_id)->get();

        return response()->json(['hph'=>$hph]);
     }

     public function GetOtherCustomer(Request $req){
        $customer = HybridProsModel::where('hp_id', '!=', $req->hp_id)->get();

        return response()->json(['customer'=>$customer]);
     }

     public function TransferPlanAdd(Request $req){
         $history = HybridProsHistory::where('hph_id', $req->hph_id)->first();

         $customer = new HybridProsModel();
         $customer->hp_customer_name = $req->customername;
         $customer->hp_phone_number = empty($req->phonenumber) ? '' : $req->phonenumber;
         $customer->hp_email = empty($req->email) ? '' : $req->email;
         $customer->save();

         $history->update([
           'hp_active_status' => 0,
           'hp_transfer_status'=> 1,
           'hp_transfer_from_id'=> $customer->hp_id
         ]);

         $add = new HybridProsHistory();
         $add->hp_id = $customer->hp_id;
         $add->service_id = $history->service_id;
         $add->hp_plan_start = $history->hp_plan_start;
         $add->hp_plan_expire = $history->hp_plan_expire;
         $add->hp_plan_expire_new = $history->hp_plan_expire_new;
         $add->hp_remaining_time = $history->hp_remaining_time;
         $add->hp_consume_time = $history->hp_consume_time;
         $add->hp_inuse_status = $history->hp_inuse_status;
         $add->hp_active_status = 1;
         $add->hp_payment_status = $history->hp_payment_status;
         $add->hp_payment_mode = $history->hp_payment_mode."(Transferred)";
         $add->hp_transfer_status = 2;
         $add->hp_transfer_from_id = $history->hp_id;
         $add->save();

         $customersss = HybridProsModel::where('hp_id',$history->hp_id)->first();
         $header = 'Transfer Plan';
         $message = 'Customer plans' . $customersss->hp_customer_name . " was transfered to another customer" ;
         $location = 'hybridpros_history';
         $logs= new AdminLog($header, $message, $location);
         $logs->save();
         return response()->json(['status'=> 'success']);
     }

     public function TransferPlanSelect(Request $req){
        $history = HybridProsHistory::where('hph_id', $req->hph_id)->first();
        $history->update([
            'hp_active_status' => 0,
            'hp_transfer_status'=> 1,
            'hp_transfer_from_id'=> $req->hp_id
          ]);

          $add = new HybridProsHistory();
          $add->hp_id = $req->hp_id;
          $add->service_id = $history->service_id;
          $add->hp_plan_start = $history->hp_plan_start;
          $add->hp_plan_expire = $history->hp_plan_expire;
          $add->hp_plan_expire_new = $history->hp_plan_expire_new;
          $add->hp_remaining_time = $history->hp_remaining_time;
          $add->hp_consume_time = $history->hp_consume_time;
          $add->hp_inuse_status = $history->hp_inuse_status;
          $add->hp_active_status = 1;
          $add->hp_payment_status = $history->hp_payment_status;
          $add->hp_payment_mode = $history->hp_payment_mode."(Transferred)";
          $add->hp_transfer_status = 2;
          $add->hp_transfer_from_id = $history->hp_id;
          $add->save();


          $customersss = HybridProsModel::where('hp_id',$history->hp_id)->first();
          $header = 'Transfer Plan';
          $message = 'Customer plans' . $customersss->hp_customer_name . " was transfered to another customer" ;
          $location = 'hybridpros_history';
          $logs= new AdminLog($header, $message, $location);
          $logs->save();

          return response()->json(['status'=> 'success']);
     }
}
