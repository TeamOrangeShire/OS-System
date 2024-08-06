<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerAcc;
use App\Models\HybridProsHistory;
use Illuminate\Http\Request;
use App\Models\HybridProsModel;
use App\Models\ServiceHP;
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
        $hph->hp_remaining_time = $service->service_hours . ':00';
        $hph->hp_payment_mode = '';
        $hph->save();

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

    public function BuyNewPlan(Request $req){
        $service = ServiceHP::where('service_id', $req->select_plan)->first();
        $date = Carbon::now()->setTimezone('Asia/Hong_Kong');

        $hph = new HybridProsHistory();
        $hph->hp_id = $req->customer_id;
        $hph->service_id = $req->select_plan;



        if($req->select_plan != 9){
            $hph->hp_plan_start = $date->format('F j, Y');
            $hph->hp_plan_expire = $date->copy()->addDays($service->service_days)->format('F j, Y');
            $hph->hp_remaining_time = $service->service_hours . ':00';
        }else{

            $specificDate = Carbon::createFromFormat('Y-m-d', $req->expDate);
            $currentDate = Carbon::now();
            $differenceInDays = $currentDate->diffInDays($specificDate);

            if($differenceInDays > 0){
                $hph->hp_plan_start = $date->format('F j, Y');
                $hph->hp_plan_expire = $date->copy()->addDays($differenceInDays + 1)->format('F j, Y');
                $hph->hp_remaining_time = $req->hours . ':' . $req->minutes;
                $hph->hp_active_status = 1;
                $hph->hp_payment_status = 1;
            }else{
                return response()->json(['status'=>'invalid date']);
            }

        }
        $hph->hp_payment_mode = '';
        $hph->save();
        return response()->json(['status'=>'success']);
    }

    public function AcceptPayment(Request $req){
       $hp = HybridProsHistory::where('hp_id', $req->id)->where('hp_payment_status',0)->first();
       $hp->update([
         'hp_payment_status' => 1,
         'hp_payment_mode'=> $req->mode,
         'hp_active_status'=> 1
       ]);
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

        $history->update([
          'hp_inuse_status'=> $req->status
        ]);

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

        return response()->json(['status'=>'success']);
    }

    public function UpdatePlans(Request $req){
       $hp = HybridProsHistory::where('hph_id', $req->hp_id)->first();
       $date = new \DateTime($req->expirationDate);

       // Format the date to "F j, Y" which will be "October 18, 2024"
       $formattedDate = $date->format('F j, Y');
       $hp->update([
        'hp_plan_expire_new'=> $formattedDate,
        'hp_remaining_time'=>$req->timeRemaining,
        'hp_active_status'=>$req->active_status
       ]);

       return response()->json(['status'=>'success']);
    }

    public function CustomerHistory(Request $req){
        $history = HybridProsHistory::where('hp_id', $req->id)->get();

        foreach($history as $h){
            $service = ServiceHP::where('service_id', $h->service_id)->first();

            $h->plan_name = $service->service_name;
        }
        return response()->json(['history'=>$history]);
    }
}
