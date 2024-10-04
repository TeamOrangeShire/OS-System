<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerAcc;
use App\Models\CustomerLogs;
use App\Models\HybridHistoryLogs;
use App\Models\HybridProsHistory;
use Illuminate\Http\Request;
use App\Models\HybridProsModel;
use App\Models\ServiceHP;
use App\Services\AdminLog;
use App\Services\HybridReport;
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

        switch($service->service_days){
            case '30':
                $expiration =  $date->copy()->addMonth()->format('F j, Y');
                break;
            case '60':
                $expiration = $date->copy()->addMonths(2)->format('F j, Y');
                break;
            default:
                $expiration =  $date->copy()->addDays($service->service_days)->format('F j, Y');
                break;
        }

        $hph->hp_id = $hp->hp_id;
        $hph->service_id = $req->select_plan;
        $hph->hp_plan_start = $date->format('F j, Y');
        $hph->hp_plan_expire = $expiration;
        $hph->hp_remaining_time = $service->service_hours . ':00';
        $hph->hp_consume_time ='00:00';
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
                $h->price = $PendingServ->service_price;
                $h->name = $PendingServ->service_name;
                $h->expiration = $hph->hp_plan_expire_new != null ? $hph->hp_plan_expire_new : $hph->hp_plan_expire;
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

        switch($service->service_days){
            case '30':
                $expiration =  $date->copy()->addMonth()->format('F j, Y');
                break;
            case '60':
                $expiration = $date->copy()->addMonths(2)->format('F j, Y');
                break;
            default:
                $expiration =  $date->copy()->addDays($service->service_days)->format('F j, Y');
                break;
        }

        if($req->select_plan != 9){
            $hph->hp_plan_start = $date->format('F j, Y');
            $hph->hp_plan_expire = $expiration;
            $hph->hp_remaining_time = $service->service_hours . ":00";
            $hph->hp_consume_time ='00:00';
        }else{

            $specificDate = Carbon::createFromFormat('Y-m-d', $req->expDate);
            $currentDate = Carbon::now();
            $differenceInDays = $currentDate->diffInDays($specificDate);

            if($differenceInDays > 0){
                $hph->hp_plan_start = $date->format('F j, Y');
                $hph->hp_plan_expire = $date->copy()->addDays($differenceInDays + 1)->format('F j, Y');
                $hph->hp_remaining_time =  $req->hours . ':' . $req->minutes;
                $hph->hp_consume_time ='00:00';
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
         'payment_edit' => $req->acceptAmmount,
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
            $log->log_date = $date->format('F j, Y');
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
        return response()->json(['status'=> 'success','mess'=> $mess]);
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
       $startDate = new \DateTime($req->inpPlanPurchaseDate);
       $customer = HybridProsModel::where('hp_id',$hp->hp_id)->first();
       // Format the date to "F j, Y" which will be "October 18, 2024"
       $formattedDate = $date->format('F j, Y');
       $formattedStartDate = $startDate->format('F j, Y');
       $hp->update([
        'hp_plan_start' => $formattedStartDate,
        'hp_plan_expire_new'=> $formattedDate === $hp->hp_plan_expire ? null : $formattedDate,
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
        $customer = HybridProsModel::where('hp_id',$hp->hp_id)->first();
        $givenDate = Carbon::parse($hp->hp_plan_start);
        $service = ServiceHP::where('service_id',$req->select_plan)->first();

        $hp->update([
         'service_id' => $req->select_plan,
         'hp_plan_expire' => $givenDate->addDays($service->service_days)->format('F j, Y'),
         'hp_remaining_time'=>  ReduceTimeConsume($service->service_hours. ":00", $hp->hp_consume_time )
        ]);

        $header = 'Change Plan';
        $message = 'Customer plans' . $customer->hp_customer_name . " has been changed" ;
        $location = 'hybridpros_history';
        $logs= new AdminLog($header, $message, $location);
        $logs->save();
        return response()->json(['status'=>'success']);
     }

     public function GetLogHistory(Request $req){
        $hph = HybridHistoryLogs::where('hph_id', $req->hph_id)->orderBy("created_at", "desc")->get();

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


     public function RemoveCustomer(Request $req){

        $history = HybridProsHistory::where('hp_id', $req->hp_id)->get();

        foreach($history as $hist){
           $logs = HybridHistoryLogs::where('hph_id', $hist->hph_id)->get();

           foreach($logs as $l){
            $l->delete();
           }

           $hist->delete();
        }

        HybridProsModel::where('hp_id', $req->hp_id)->first()->delete();

        return response()->json(['status'=> 'success']);
     }

     public function RemovePlan(Request $req){
        $logs = HybridHistoryLogs::where('hph_id', $req->hph_id)->get();

        foreach($logs as $l){
        $l->delete();
        }
        HybridProsHistory::where('hph_id', $req->hph_id)->first()->delete();

        return response()->json(['status'=>'success']);
     }

     public function LoadSalesReport(Request $req){
        $report = new HybridReport();
        switch($req->filter){
            case 'daily':
                $history = $report->getDaily();
                break;
            case 'monthly':
                $history = $report->getMonthly($req->month, $req->year);
                break;
            case 'yearly':
                $history = $report->getYearly($req->year);
                break;
            case 'dailybydate':
                $history = $report->getByDate($req->date);
                break;
            case 'weekly':
                $weekdata = explode('-', $req->week);
                $startWeek = Carbon::createFromFormat('F j, Y', $weekdata[0])->format('Y-m-d');
                $endWeek = Carbon::createFromFormat('F j, Y', $weekdata[1])->format('Y-m-d');

                $history = $report->getWeekly($startWeek, $endWeek);
                break;
        }

        return response()->json(['history'=>$history, 'today'=>Carbon::today()]);
     }

     public function LoadWeeks(Request $req){
       // Fetch all records
    $records = HybridProsHistory::all();

    // Check if records exist
    if ($records->isEmpty()) {
        return response()->json(['error' => 'No records found'], 404);
    }

    // Get the earliest and latest created_at dates
    $firstDate = $records->min('created_at');
    $lastDate = $records->max('created_at');

    // Initialize an array to hold weeks and their associated dates
    $weeks = [];

    // Generate weeks between first and last dates
    $start = Carbon::parse($firstDate)->startOfWeek();
    $end = Carbon::parse($lastDate)->endOfWeek();

    while ($start->lte($end)) {
        $weekStart = $start->copy();
        $weekEnd = $start->copy()->endOfWeek();

        // Add week information with associated start and end dates
        $weeks[] = [
            'week' => $start->format('Y-W'), // Format as 'Year-WeekNumber'
            'start_date' => $weekStart->format('F j, Y'), // Start date of the week
            'end_date' => $weekEnd->subDay()->format('F j, Y'), // End date of the week
        ];

        $start->addWeek();
    }
        // Return the weeks as a JSON response
        return response()->json($weeks);
     }


     public function SaveHybridLogsChanges(Request $req){
        $logs = HybridHistoryLogs::where('log_id', $req->id)->first();

        $allLogs = HybridHistoryLogs::where('hph_id', $logs->hph_id)
        ->orderBy('created_at', 'desc')
        ->get();

        $start = false;

        $time = timeDifference($req->time_in, $req->time_out);

        $currentConsumeTime = explode(':',$logs->log_time_consume);
        $currentRemainingTime = explode(':',$logs->log_time_remaining);

        $getConsumeTimeDifference = [$currentConsumeTime[0] - $time['hours'], $currentConsumeTime[1] - $time['minutes']];
        $getRemainingTimeDifference = [$currentRemainingTime[0] + $getConsumeTimeDifference[0], $currentRemainingTime[1] + $getConsumeTimeDifference[1]];

        if($getRemainingTimeDifference[1] < 0){
            $getRemainingTimeDifference[1] += 60;
            $getRemainingTimeDifference[0] -= 1;
        }

        $logs->update([
            'log_date'=> Carbon::createFromFormat('Y-m-d', $req->date)->format('F j, Y'),
            'log_time_in'=> Carbon::createFromFormat('H:i', $req->time_in)->format('h:i A'),
            'log_time_out'=> Carbon::createFromFormat('H:i', $req->time_out)->format('h:i A'),
            'log_time_consume' => $time['hours']. ":". $time['minutes'],
            'log_time_remaining' => $getRemainingTimeDifference[0]. ":". $getRemainingTimeDifference[1],
        ]);

        foreach ($allLogs as $all){
            if($all->log_id == $logs->log_id){
                $start = true;
            }

            if($start){
                if($all->log_id != $logs->log_id){
                    $updateOtherLogs = HybridHistoryLogs::where('log_id', $all->log_id)->first();
                    $timeRemaining = explode(':', $updateOtherLogs->log_time_remaining);
                    $remHours = $timeRemaining[0] + $getConsumeTimeDifference[0];
                    $remMinutes = $timeRemaining[1] + $getConsumeTimeDifference[1];
                    if($remMinutes < 0 ){
                        $remMinutes += 60;
                        $remHours -= 1;
                    }

                    $updateOtherLogs->update([
                        'log_time_remaining'=> $remHours. ":" . $remMinutes
                    ]);
                }
            }
        }

        $history = HybridProsHistory::where('hph_id', $logs->hph_id)->first();
        $historyTimeRemaining = explode(':', $history->hp_remaining_time);
        $hpRemHours = $historyTimeRemaining[0] - $getConsumeTimeDifference[0];
        $hpRemMinutes = $historyTimeRemaining[1] - $getConsumeTimeDifference[1];

        $hpConsumeTime = explode(':', $history->hp_consume_time);
        $hpConsumeHours = $hpConsumeTime[0] + $time['hours'];
        $hpConsumeMinutes = $hpConsumeTime[0] + $time['minutes'];

        if($hpConsumeMinutes > 60){
            $hpConsumeHours += 1;
            $hpConsumeMinutes -= 60;
        }

        if($hpRemMinutes < 0){
            $hpRemMinutes += 60;
            $hpRemHours -= 1;
        }

        $history->update([
            'hp_remaining_time' => $hpRemHours . ":" . $hpRemMinutes,
            'hp_consume_time' => $hpConsumeHours . ":" . $hpConsumeMinutes
        ]);

        return response()->json(['success'=> true]);
     }

     public function AddHybridProsLog(Request $req){
        $logs = new HybridHistoryLogs();

        $time = timeDifference($req->timeIn, $req->timeOut);

        $history = HybridProsHistory::where('hph_id', $req->hph_id)->first();

        $remainingTime = explode(':', $history->hp_remaining_time);

        $remainingHours = $remainingTime[0] - $time['hours'];
        $remainingMinutes = $remainingTime[1] - $time['minutes'];

        if($remainingMinutes < 0){
            $remainingMinutes += 60;
            $remainingHours -= 1;
        }

        if($remainingHours < 0){
            $remainingHours = 0;
            $remainingMinutes = 0;
        }

        $logs->hph_id = $req->hph_id;
        $logs->log_date = Carbon::createFromFormat('Y-m-d', $req->date)->format('F j, Y');
        $logs->log_time_in = Carbon::createFromFormat('H:i', $req->timeIn)->format('h:i A');
        $logs->log_time_out = empty($req->timeOut) ? " " : Carbon::createFromFormat('H:i', $req->timeOut)->format('h:i A');
        $logs->log_time_consume = $time['hours']. ":". $time ['minutes'];
        $logs->log_time_remaining = $remainingHours . ":" . $remainingMinutes;
        $logs->log_status = empty($req->timeOut) ? 0 : 1;

        $hpConsumeTime = explode(':', $history->hp_consume_time);
        $hpConsumeHours = $hpConsumeTime[0] + $time['hours'];
        $hpConsumeMinutes = $hpConsumeTime[1] + $time['minutes'];

        if($hpConsumeMinutes > 60){
            $hpConsumeHours += 1;
            $hpConsumeMinutes -= 60;
        }

        $history->update([
            'hp_remaining_time' => $remainingHours . ":" . $remainingMinutes,
            'hp_consume_time' => $hpConsumeHours . ":" . $hpConsumeMinutes,
        ]);

        $logs->save();

        return response()->json(['success'=> true]);
      }
}

