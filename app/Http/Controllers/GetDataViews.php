<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoomPricing;
use App\Models\Reservations;
use App\Models\CustomerAcc;
use App\Models\Rooms;
use App\Models\CustomerLogs;

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

                    ]);
                }else{
                    return view('homepage.index', [
                        'customer_id'=>$userId,

                    ]);
                }

            } else {
                return view('homepage.index', ['customer_id'=> 'none', 'status'=> 'not_log_in']);
            }

    }

    public function GetBlogsContentCookies(Request $req, $id){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();

            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.blog_content', [
                        'customer_id'=>$userId,
                        'blog_id'=> $id
                    ]);
                }else{
                    return view('homepage.blog_content', [
                        'customer_id'=>$userId,
                        'blog_id'=> $id
                    ]);
                }

            } else {
                return view('homepage.blog_content', ['customer_id'=> 'none', 'status'=> 'not_log_in', 'blog_id'=> $id]);
            }

    }
    public function GetBlogsCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();

            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.blogs', [
                        'customer_id'=>$userId,

                    ]);
                }else{
                    return view('homepage.blogs', [
                        'customer_id'=>$userId,

                    ]);
                }

            } else {
                return view('homepage.blogs', ['customer_id'=> 'none', 'status'=> 'not_log_in']);
            }

    }

    public function GetInstructionCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();

            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.instruction', [
                        'customer_id'=>$userId,

                    ]);
                }else{
                    return view('homepage.instruction', [
                        'customer_id'=>$userId,

                    ]);
                }

            } else {
                return view('homepage.instruction', ['customer_id'=> 'none', 'status'=> 'not_log_in']);
            }

    }
    public function GetPrivacyCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();

            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.privacy', [
                        'customer_id'=>$userId,

                    ]);
                }else{
                    return view('homepage.privacy', [
                        'customer_id'=>$userId,

                    ]);
                }

            } else {
                return view('homepage.privacy', ['customer_id'=> 'none', 'status'=> 'not_log_in']);
            }


    }
    public function GetSolutionsCookies(Request $req){
        $userId = $req->cookie('customer_id');
        $customer= CustomerAcc::where('customer_id', $userId)->first();

            if ($userId) {
                if($customer->verification_status === 0){
                    return view('homepage.solutions', [
                        'customer_id'=>$userId,

                    ]);
                }else{
                    return view('homepage.solutions', [
                        'customer_id'=>$userId,

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

                    ]);
                }else{
                    return view('homepage.contact', [
                        'customer_id'=>$userId,

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

        if($request->filter == 'cash'){
            $reg = CustomerLogs::join('customer_acc','customer_logs.customer_id','=','customer_acc.customer_id')->
            select('customer_logs.*','customer_acc.customer_firstname as firstname','customer_acc.customer_lastname as lastname',
            'customer_acc.customer_email as email','customer_acc.customer_phone_num as contact')->where('customer_logs.log_date', $date)->where('log_payment_method', 'Cash')->get();
        }else if($request->filter == 'gcash'){
            $reg = CustomerLogs::join('customer_acc','customer_logs.customer_id','=','customer_acc.customer_id')->
            select('customer_logs.*','customer_acc.customer_firstname as firstname','customer_acc.customer_lastname as lastname',
            'customer_acc.customer_email as email','customer_acc.customer_phone_num as contact')->where('customer_logs.log_date', $date)->where('log_payment_method', 'E-Pay')->get();
        }else{
            $reg = CustomerLogs::join('customer_acc','customer_logs.customer_id','=','customer_acc.customer_id')->
            select('customer_logs.*','customer_acc.customer_firstname as firstname','customer_acc.customer_lastname as lastname',
            'customer_acc.customer_email as email','customer_acc.customer_phone_num as contact')->where('customer_logs.log_date', $date)->get();
        }
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

        if ($request->startdate == 'NaN-NaN' || $request->enddate === 'NaN-NaN') {
            return response()->json(['data' => '']);
        }elseif($request->startdate == '' || $request->enddate == ''){
            return response()->json(['data' => '']);
        }
        $startDate = Carbon::createFromFormat('Y-m', $request->startdate);
        $endDate = Carbon::createFromFormat('Y-m', $request->enddate);

        // Query to get logs
        $logs = CustomerLogs::join('customer_acc', 'customer_logs.customer_id', '=', 'customer_acc.customer_id')
            ->select(
                'customer_logs.*',
                'customer_acc.customer_firstname as firstname',
                'customer_acc.customer_lastname as lastname',
                'customer_acc.customer_email as email',
                'customer_acc.customer_phone_num as contact'
            )
            ->whereBetween('customer_logs.created_at', [$startDate->startOfMonth(), $endDate->endOfMonth()])
            ->where('customer_logs.log_status', 2)
            ->get();

        // Process each log
        foreach ($logs as $log) {
            $log->payment = explode('-', $log->log_transaction)[0];
        }

        // Return the logs as JSON
        return response()->json(['data' => $logs]);
}

}
