<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoomPricing;
use App\Models\RoomRate;
use App\Models\Reservations;
use App\Models\CustomerAcc;
use App\Models\Rooms;
use App\Models\CustomerLogs;
use App\Models\CustomerLogUnregister;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GetDataViews extends Controller
{
    public function GetHomeCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.index', [
                        'customer_id'=>$userId,
                        'status'=> 'not_verified'
                    ]);
                }else{
                    return view('homepage.index', [
                        'customer_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.index', ['customer_id'=> 'none', 'status'=> 'not_log_in']);
            }
        
      
    }

    public function GetSolutionsCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.solutions', [
                        'customer_id'=>$userId,
                        'status'=> 'not_verified'
                    ]);
                }else{
                    return view('homepage.solutions', [
                        'customer_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.solutions', ['customer_id'=> 'none', 'status'=> 'not_log_in']);
            }
        
    }

    public function GetReservationCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $room = Rooms::orderBy('room_number')->where('rooms_disable', '!=', 1)->get();

        $room_array=[];

        foreach($room as $array){
            array_push($room_array, $array->room_id);
        }
        if ($userId) {
            return view('homepage.reservation', [
                'customer_id'=>$userId,
                'room_array'=>  $room_array
            ]);
        } else {
            return view('homepage.reservation', ['customer_id'=> 'none', 'room_array'=> $room_array]);
        }
    }
    
    public function GetContactCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.contact', [
                        'customer_id'=>$userId,
                        'status'=> 'not_verified'
                    ]);
                }else{
                    return view('homepage.contact', [
                        'customer_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.contact', ['customer_id'=> 'none', 'status'=> 'not_log_in']);
            }
        
    }
    public function GetBookCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $room = Rooms::orderBy('room_number')->where('rooms_disable', '!=', 1)->get();

        $room_array=[];

        foreach($room as $array){
            array_push($room_array, $array->room_id);
        }
        if ($userId) {
            return view('homepage.book', [
                'customer_id'=>$userId,
                'room_array'=> $room_array
            ]);
        } else {
            return view('homepage.book', ['customer_id'=> 'none', 'room_array'=>$room_array]);
        }
    }

    public function CustomerProfile(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.profile', ['user_id'=>$userId,'status'=> 'not_verified' ]);
                }else{
                    return view('homepage.Dashboard.profile', [
                        'user_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.profile', ['user_id'=>$userId, 'status'=> 'not_log_in']);
            }


    }

    public function CustomerSubscription(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.subscription', ['user_id'=>$userId,'status'=> 'not_verified' ]);
                }else{
                    return view('homepage.Dashboard.subscription', [
                        'user_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.subscription', ['user_id'=>$userId, 'status'=> 'not_log_in']);
            }
    }
    public function CustomerReservation(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.reservation', ['user_id'=>$userId,'status'=> 'not_verified' ]);
                }else{
                    return view('homepage.Dashboard.reservation', [
                        'user_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.reservation', ['user_id'=>$userId, 'status'=> 'not_log_in']);
            }
    }

    public function CustomerHome(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.index', ['user_id'=>$userId,'status'=> 'not_verified' ]);
                }else{
                    return view('homepage.Dashboard.index', [
                        'user_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.index', ['user_id'=>$userId, 'status'=> 'not_log_in']);
            }
    }
    public function CustomerLogin(Request $req){
        $userId = $req->cookie('customer_id');
       if($userId){
        return view('homepage.login.index', ['user_id'=>$userId]);
       }else{
        return view('homepage.login.index', ['user_id'=>'none']);
       }
    }
    public function CustomerSettings(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.settings', ['user_id'=>$userId,'status'=> 'not_verified' ]);
                }else{
                    return view('homepage.Dashboard.settings', [
                        'user_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.settings', ['user_id'=>$userId, 'status'=> 'not_log_in']);
            }
    }

    public function CustomerViewNotification(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.notification_open', ['user_id'=>$userId,'status'=> 'not_verified', 'notif'=> $req->notification ]);
                }else{
                    return view('homepage.Dashboard.notification_open', [
                        'user_id'=>$userId,
                        'status'=> 'verified',
                        'notif'=>'none'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.notification', ['user_id'=>$userId, 'status'=> 'not_log_in', 'notif'=>'none']);
            }
    }
    public function CustomerNotification(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.notification', ['user_id'=>$userId,'status'=> 'not_verified' ]);
                }else{
                    return view('homepage.Dashboard.notification', [
                        'user_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.notification', ['user_id'=>$userId, 'status'=> 'not_log_in']);
            }
    }

    public function CustomerTransaction(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();
     
            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.Dashboard.transaction', ['user_id'=>$userId,'status'=> 'not_verified' ]);
                }else{
                    return view('homepage.Dashboard.transaction', [
                        'user_id'=>$userId,
                        'status'=> 'verified'
                    ]);
                }
               
            } else {
                return view('homepage.Dashboard.transaction', ['user_id'=>$userId, 'status'=> 'not_log_in']);
            }
    }
    public function CustomerLoginToShire(Request $req){
        $userId = $req->cookie('customer_id');
        if($req->has('status')){
            $stat = $req->status;
            $id = $req->log_id;
        }else{
            $stat = 'none';
            $id = 'none';
        }
        return view('homepage.Dashboard.loginshire', ['user_id'=> $userId, 'status'=>$stat, 'log_data'=>$id]);
    }

    public function GetRoomRate(Request $req){

        $room_id = $req->input('room_id');
        $date = $req->input('date');

        $rates = RoomPricing::where('room_id', $room_id)->get();
        $rate_id= [];
        $rate_name = [];
        $rate_price = [];

        $reserve = Reservations::where('res_date', $date)->get();

        if($reserve->isNotEmpty()){
            $res_status = 1;
        }else{
            $res_status = 0;
        }
        foreach($rates as $r){
            array_push($rate_id, $r->room_rates);
            $rateQuery = RoomRate::where('rate_id', $r->room_rates)->first();
            array_push($rate_name, $rateQuery->rate_name);
            array_push($rate_price, $rateQuery->rate_price);
        }
        return response()->json(['rate_id'=>$rate_id, 'rate_name'=>$rate_name, 'rate_price'=>$rate_price, 'res_status'=>$res_status]);
    }

    public function CheckTime(Request $req){
        $rate_id = $req->input('rate_id');
        $date = $req->input('date');

        $checkStart= Reservations::where('res_date', $date)->first();
        $checkEnd= Reservations::where('res_date', $date)->latest()->first();
        $checkDate= Reservations::where('res_date', $date)->latest()->first();
        $checkRate = RoomRate::where('rate_id', $rate_id)->first();
        if($checkRate->rate_name === 'Hourly'){
           $freq = 1;
        }else if($checkRate->rate_name === '4 Hours'){
            $freq = 4;
        }else{
            $freq = 0;
        }

        if($checkDate){
            return response()->json(['timeStart'=>$checkStart->res_start, 'timeEnd'=>$checkEnd->res_end, 'rate'=>$freq]);
        }else{
            return response()->json(['timeStart'=>'none', 'timeEnd'=>'none', 'rate'=>$freq]);
        }

    }


    public function GetTimeForDate(Request $req){
        $date = $req->date;
        $timeList = [];

        $checkDate = Reservations::where('res_date', $date)->get();
        if($checkDate->isNotEmpty()){
            foreach($checkDate as $time){
                $concatTime = $time->res_start . "-" . $time->res_end;
                array_push($timeList, $concatTime);
            }
            return response()->json(['status'=>'exist', 'time'=> $timeList]);
        }else{
            return response()->json(['status'=>'clear', 'time'=> 'none']);
        }
    }
    
    public function CustomerLog()
    {
        $logs = CustomerLogs::where('log_status', 2)->get()->groupBy('log_date');
    
        $logsByDate = [];
        foreach ($logs as $logDate => $logEntries) {
            $totalLogTransactions = 0;
            foreach ($logEntries as $logEntry) {
                $logTransactionParts = explode('-', $logEntry->log_transaction);
                $totalLogTransactions += (int)$logTransactionParts[0];
            }
            $logsByDate[] = [
                'log_date' => $logDate,
                'logs' => $logEntries->toArray(),
                'total_log_transactions' => $totalLogTransactions 
            ];
        }
        return response()->json(['logsByDate' => $logsByDate]);
    }
    
    public function ViewDetails(Request $request){

        $date = $request->query('date');

        $reg = CustomerLogs::join('customer_acc','customer_logs.customer_id','=','customer_acc.customer_id')->
  select('customer_logs.*','customer_acc.customer_firstname as firstname','customer_acc.customer_lastname as lastname',
  'customer_acc.customer_email as email','customer_acc.customer_phone_num as contact')->where('customer_logs.log_date', $date)->get();
        foreach($reg as $log){
            $log->payment = explode('-',$log->log_transaction)[0];
        }
        return response()->json(['reg'=>$reg]);
    }
    public function GetCustomerAccDetail(){
         $Acc = CustomerAcc::all();
         return response()->json(['data'=>$Acc]);
    }

    public function GeneralReport() {

  $logs = CustomerLogs::join('customer_acc','customer_logs.customer_id','=','customer_acc.customer_id')->
  select('customer_logs.*','customer_acc.customer_firstname as firstname','customer_acc.customer_lastname as lastname',
  'customer_acc.customer_email as email','customer_acc.customer_phone_num as contact')->Where('customer_logs.log_status',2)->get();

  foreach($logs as $log){

    $log->payment = explode('-',$log->log_transaction)[0];
 
  }

  return response()->json(['data' => $logs]);
}
public function GetWeeklyReport(Request $request) {

    $startDate = $request->startdate;
    $endDate = Carbon::parse($request->enddate)->addDay(); 

    $logs = CustomerLogs::join('customer_acc', 'customer_logs.customer_id', '=', 'customer_acc.customer_id')
    ->select(
        'customer_logs.*',
        'customer_acc.customer_firstname as firstname',
        'customer_acc.customer_lastname as lastname',
        'customer_acc.customer_email as email',
        'customer_acc.customer_phone_num as contact'
    )
    ->whereBetween('customer_logs.created_at', [$startDate, $endDate])
    ->where('customer_logs.log_status', 2)
    ->get();

    foreach($logs as $log){
        $log->payment = explode('-', $log->log_transaction)[0];
    }

    return response()->json(['data' => $logs]);
}

}
