<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogs;
use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\CustomerAcc;
use App\Models\Tour;
use App\Models\Reservations;
use App\Models\RoomRates;
use App\Models\CustomerNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\DateTime;
use App\Http\Controllers\DateInterval;
use Illuminate\Support\Facades\Hash;

class CustomerLog extends Controller
{
  public function getlog(Request $request){

    $id = $request->id;
    $log = CustomerLogs::where('customer_id',$id)->get();

    return response()->json(['logs'=>$log]);
  }
  public function acceptLog(Request $request){

    $id = $request->id;


    $log = CustomerLogs::where('log_id',$id)->first();
    $method=explode('-',$log->log_transaction);

    $log->update([

        'log_status'=> 2,

    ]);
    $cus_info = CustomerAcc::where('customer_id',$log->customer_id)->first();
    if($method[1]==='2'){
      $credit=$cus_info->account_credits - $method[0];
      $cus_info->update([

        'account_credits'=> $credit,

    ]);
    }
    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accepted ".$method[0]." payment from " . $cus_info->customer_lastname;
    $data->act_header = "Accept log payment";
    $data->act_location = "customer_log";
    $data->save();

    return response()->json(['data' => $cus_info->customer_id]);
  }

  public function getCustomerAcc()
    {
        // Retrieve all customer accounts
        $accounts = CustomerAcc::all();

        // Iterate through each account
        foreach ($accounts as $acc) {
            // Retrieve the latest logs of different statuses in a single query
            $customerLogs = CustomerLogs::where('customer_id', $acc->customer_id)
                                        ->whereIn('log_status', [0, 1, 2])
                                        ->orderBy('updated_at', 'desc')
                                        ->get()
                                        ->groupBy('log_status');

            // Assign log attributes based on log_status
            if (isset($customerLogs[0]) && $customerLogs[0]->isNotEmpty()) {
                $log = $customerLogs[0]->first();
                $acc->log_in = "0";
                $acc->logtype = $log->log_type;
                $acc->log_id = $log->log_id;
                $acc->log_start_time = $log->log_start_time;
                $acc->sort = $log->updated_at;
            } elseif (isset($customerLogs[1]) && $customerLogs[1]->isNotEmpty()) {
                $log = $customerLogs[1]->first();
                $acc->log_in = "1";
                $acc->logtype = $log->log_type;
                $acc->log_payment = $log->log_transaction;
                $acc->log_start_time = $log->log_start_time;
                $acc->log_end_time = $log->log_end_time;
                $acc->log_id = $log->log_id;
                $acc->sort = $log->updated_at;
            } elseif (isset($customerLogs[2]) && $customerLogs[2]->isNotEmpty()) {
                $log = $customerLogs[2]->first();
                $acc->log_in = "2";
                $acc->logtype = $log->log_type;
                $acc->log_payment = $log->log_transaction;
                 $acc->log_start_time = $log->log_start_time;
                $acc->log_end_time = $log->log_end_time;
                 $acc->log_id = $log->log_id;
                $acc->sort = $log->updated_at;
            }
        }

        // Convert accounts to array and return JSON response
        return response()->json(['data' => $accounts->toArray()]);
    }


 public function viewGroupLog(Request $request) {
    $GroupLog = CustomerLogs::where('log_group_id',$request->id)->get();
    $logData=[];
    foreach ($GroupLog as $log) {
       $accounts = CustomerAcc::where('customer_id',$log->customer_id)->first();
      if($log->log_status==0){
         $logData[]=[
         'log_in' => '0',
         'logtype' => $log->log_type,
         'log_id' => $log->log_id,
         'name'=>$accounts->customer_firstname.' '.$accounts->customer_lastname
          ];
      }else if($log->log_status==1){
        $logData[]=[
          'log_in' => "1",
          'logtype' => $log->log_type,
          'log_payment' => $log->log_transaction,
          'log_start_time' => $log->log_start_time,
          'log_end_time' => $log->log_end_time,
          'log_id' => $log->log_id,
          'name'=>$accounts->customer_firstname.' '.$accounts->customer_lastname
        ];
      }else if($log->log_status==2){
         $logData[]=[
          'name'=>$accounts->customer_firstname.' '.$accounts->customer_lastname,
         'log_in' => "2"
        ];
      }
    }

    return response()->json(['data' => $logData]);
}

public function GetCustomerlog(Request $request) {

    $logs = CustomerLogs::where('customer_id',$request->cuslogid)->get();

    return response()->json(['data' => $logs]);
}
public function CustomerlogHistory() {


  $logs = CustomerLogs::join('customer_acc','customer_logs.customer_id','=','customer_acc.customer_id')->
  select('customer_logs.*','customer_acc.customer_firstname as firstname','customer_acc.customer_lastname as lastname',
  'customer_acc.customer_email as email','customer_acc.customer_phone_num as contact','customer_acc.customer_middlename as middlename')
  ->orderBy('updated_at', 'desc')->take(100)->get();

  return response()->json(['data' => $logs]);
}
public function LogToPending(Request $request) {

    $logs = CustomerLogs::where('log_id',$request->id)->first();
    $current = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
    $starTime = $logs->log_start_time;
    $endTime = $logs->log_end_time;
    $cusAcc = CustomerAcc::where('customer_id',$logs->customer_id)->first();
    $type =$cusAcc->customer_type;
    // $DayPassTime = add12Hours($starTime);
    $totalTime = timeDifference($starTime, $current);
    $paymentPass = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $type);

    if($totalTime['hours'] > 12 && $logs->log_status == 0){

      if($logs->log_type == 0 ){
        if($type == 'Regular'){
            $limit = 12;
            $excessTime = max(0, $totalTime['hours'] - $limit);
            $exceed_Value = 33.34*$excessTime;
            $total = $paymentPass+$exceed_Value;
            $exceed_Value = number_format($exceed_Value, 2);
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$total.'-0',

        ]);
         return response()->json(['data' => 'DayPass','confirm'=>[$request->id,$current,$starTime,$total]]);
        }
        else{
            $limit = 12;
            $excessTime = max(0, $totalTime['hours'] - $limit);
            $exceed_Value = 26.67*$excessTime;
            $total = $paymentPass+$exceed_Value;
            $exceed_Value = number_format($exceed_Value, 2);
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$total.'-0',

        ]);
         return response()->json(['data' => 'DayPass','confirm'=>[$request->id,$current,$starTime,$total]]);
        }
      }else{
         if($type == 'Regular'){
            $limit = 12;
            $excessTime = max(0, $totalTime['hours'] - $limit);
            $exceed_Value = 33.34*$excessTime;
            $total = $paymentPass+$exceed_Value;
            $exceed_Value = number_format($exceed_Value, 2);
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$total.'-1',

        ]);
         return response()->json(['data' => 'DayPass','confirm'=>[$request->id,$current,$starTime,$total]]);
        }
        else{
            $limit = 12;
            $excessTime = max(0, $totalTime['hours'] - $limit);
            $exceed_Value = 26.67*$excessTime;
            $total = $paymentPass+$exceed_Value;
            $exceed_Value = number_format($exceed_Value, 2);
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$total.'-1',

        ]);
         return response()->json(['data' => 'DayPass','confirm'=>[$request->id,$current,$starTime,$total]]);
        }
      }

    }
    elseif($totalTime['hours'] >= 8 && $logs->log_status == 0){

       if($logs->log_type == 0){
       $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-0',

        ]);
         return response()->json(['data' => 'DayPass','confirm'=>[$request->id,$current,$starTime,$paymentPass]]);
      }else{
         $logs->update([
          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-1',
        ]);
         return response()->json(['data' => 'DayPass','confirm'=>[$request->id,$current,$starTime,$paymentPass]]);
      }

    }
    else{

    if($logs->log_status == 0){
      if($logs->log_type == 0){
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-1',

        ]);
      return response()->json(['data' => $logs->customer_id ,'confirm'=>[$request->id,$current,$starTime,$paymentPass]]);
      }else if($logs->log_type == 2){
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          
        ]);
      $paymentPass1 = explode('-',$logs->log_transaction)[0];
      return response()->json(['data' => $logs->customer_id ,'confirm'=>[$request->id,$current,$starTime,$paymentPass1]]);
      }
      else{
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-0',

        ]);
          return response()->json(['data' => $logs->customer_id ,'confirm'=>[$request->id,$current,$starTime,$paymentPass]]);
      }

    }else if($logs->log_status == 1){
      if($logs->log_type == 0){
        $logs->update([
          'log_payment_method'=>$request->paymentMethod,
          'log_transaction'=>$request->payment.'-1',
          'log_status'=> 2,

        ]);
    $data = new CustomerNotification;
    $data->user_type ='Customer';
    $data->user_id = $logs->customer_id;
    $data->notif_header = "Payment Confirmed ";
    $data->notif_message = "You have successfully logged out at Orange Shire, and we have received your payment.";
    $data->notif_status = "0";
    $data->notif_label = "Success";
    $data->notif_table ="customer_logs";
    $data->notif_table_id = $request->id;
    $data->notif_table_pk = "log_id";
    $data->save();

    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accepted ".$request->payment." payment from " . $cusAcc->customer_lastname;
    $data->act_header = "Accept log payment";
    $data->act_location = "customer_log";
    $data->save();
      }else{
        $logs->update([
          'log_payment_method'=>$request->paymentMethod,
          'log_transaction'=>$request->payment.'-0',
          'log_status'=> 2,


        ]);
         $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accepted ".$request->payment." payment from " . $cusAcc->customer_lastname;
    $data->act_header = "Accept log payment";
    $data->act_location = "customer_log";
    $data->save();
      }

    return response()->json(['data' => $logs->customer_id]);
    }

    }

}
public function LogToPending2(Request $request) {


    $logs = CustomerLogs::where('log_id',$request->id)->first();
    $current = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
    $starTime = $logs->log_start_time;
    $endTime = $logs->log_end_time;
    $cusAcc = CustomerAcc::where('customer_id',$logs->customer_id)->first();
    $type =$cusAcc->customer_type;
    // $DayPassTime = add12Hours($starTime);
    $totalTime = timeDifference($starTime, $current);
    $paymentPass = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $type);
    if($totalTime['hours'] >= 8 && $logs->log_status == 0){

       if($logs->log_type == 0){
       $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-0',

        ]);
         return response()->json(['data' => 'DayPass']);
      }else{
         $logs->update([
          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-1',
        ]);
         return response()->json(['data' => 'DayPass']);
      }

    }
    else{

    if($logs->log_status == 0){
      if($logs->log_type == 0){
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-1',

        ]);

      }else{
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-0',

        ]);
      }
    return response()->json(['data' => $logs->log_group_id]);
    }else if($logs->log_status == 1){
      if($logs->log_type == 0){
        $logs->update([
          'log_payment_method'=>$request->paymentMethod,
          'log_transaction'=>$request->payment.'-1',
          'log_status'=> 2,

        ]);
    $data = new CustomerNotification;
    $data->user_type ='Customer';
    $data->user_id = $logs->customer_id;
    $data->notif_header = "Payment Confirmed ";
    $data->notif_message = "You have successfully logged out at Orange Shire, and we have received your payment.";
    $data->notif_status = "0";
    $data->notif_label = "Success";
    $data->notif_table ="customer_logs";
    $data->notif_table_id = $request->id;
    $data->notif_table_pk = "log_id";
    $data->save();

    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accepted ".$request->payment." payment from " . $cusAcc->customer_lastname;
    $data->act_header = "Accept log payment";
    $data->act_location = "customer_log";
    $data->save();
      }else{
        $logs->update([
          'log_payment_method'=>$request->paymentMethod,
          'log_transaction'=>$request->payment.'-0',
          'log_status'=> 2,


        ]);
         $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accepted ".$request->payment." payment from " . $cusAcc->customer_lastname;
    $data->act_header = "Accept log payment";
    $data->act_location = "customer_log";
    $data->save();
      }

    return response()->json(['data' => $logs->log_group_id]);
    }

    }

}

public function LogToPending3(Request $request) {


$LogG = CustomerLogs::where('log_group_id',$request->id)->where('log_status',0)->get();
foreach($LogG as $log){
$LogG2 = CustomerLogs::where('log_id',$log->log_id)->first();
$cusAcc = CustomerAcc::where('customer_id',$LogG2->customer_id)->first();
$current = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
$totalTime = timeDifference($LogG2->log_start_time, $current);
$paymentPass = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $cusAcc->customer_type);

 $LogG2->update([
          'log_end_time'=>$current,
          'log_transaction'=>$paymentPass.'-0',
          'log_status'=> 1,

        ]);
}
    return response()->json(['data' => $request->id]);
}
public function BackToLogout(Request $request){

  $logs = CustomerLogs::where('log_id',$request->id)->first();
  if($logs->log_type=='2'){
      $logs->update([
        'log_status' => 0,
        'log_end_time' => '',
      ]);
  }else{
      $logs->update([

        'log_status' => 0,
        'log_end_time' => '',
        'log_transaction' => '',

      ]);
  }
}

public function AccLogin(Request $request){
        $insertnewlog = new CustomerLogs;
        $insertnewlog->customer_id = $request->id;
        $insertnewlog->log_date = now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
        $insertnewlog->log_start_time = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
        $insertnewlog->log_status = 0;
        $insertnewlog->log_type= 1;
        $insertnewlog->save();

        return response()->json(['status'=> 'success']);
}

  public function InsertNewCustomer(Request $request){
    if($request->firstname && $request->lastname && $request->middlename == '' && $request->email == '' && $request->number == ''){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->count();
       if($acc){return response()->json(['status'=> 'exist']);}
    }elseif ($request->firstname && $request->lastname && $request->middlename && $request->email =='' && $request->number ==''){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->where('customer_middlename', 'like', '%' . $request->middlename . '%')->count();
      if($acc){return response()->json(['status'=> 'match']);}
    }elseif ($request->firstname && $request->lastname && $request->middlename && $request->email && $request->number ==''){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->where('customer_middlename', 'like', '%' . $request->middlename . '%')->where('customer_email', 'like', '%' . $request->email . '%')->count();
      if($acc){return response()->json(['status'=> 'email_match']);}
    }elseif ($request->firstname && $request->lastname && $request->middlename && $request->email && $request->number){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->where('customer_middlename', 'like', '%' . $request->middlename . '%')->where('customer_email', 'like', '%' . $request->email . '%')->where('customer_phone_num', 'like', '%' . $request->number . '%')->count();
      if($acc){return response()->json(['status'=> 'number_match']);}
    }

   if($request->firstname == '' || $request->lastname == '') {
      if($request->firstname == '' && $request->lastname == ''){
         return response()->json(['status'=> 'failed']);
      }else if($request->firstname == ''){
         return response()->json(['status'=> 'firstname']);
      }else if($request->lastname == ''){
         return response()->json(['status'=> 'lastname']);
      }
    }
    else{
        $format = strtolower(str_replace(' ', '', $request->firstname));
        $insertnew = new CustomerAcc;
        $insertnew->customer_firstname= $request->firstname;
        $insertnew->customer_middlename= $request->middlename;
        $insertnew->customer_lastname= $request->lastname;
        $insertnew->customer_ext= $request->ext;
        $insertnew->customer_email= $request->email;
        $insertnew->customer_type= $request->customer_type;
        $insertnew->customer_phone_num= $request->number;
        $insertnew->customer_profile_pic= 'none';
        $insertnew->customer_username = strtolower(str_replace(' ', '', $request->firstname));
        $insertnew->customer_password= Hash::make($format.'123');
        $insertnew->save();

        $tour = new Tour;
        $tour->customer_id = $insertnew->customer_id;
        $tour->save();

        $insertnewlog = new CustomerLogs;
        $insertnewlog->customer_id = $insertnew->customer_id;
        $insertnewlog->log_date = now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
        $insertnewlog->log_start_time = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
        $insertnewlog->log_status = 0;
        $insertnewlog->log_type= 1;
        $insertnewlog->save();

        return response()->json(['status'=> 'success']);
    }
  }
   public function insertnewcustomerByDayPass(Request $request){
    if($request->firstname && $request->lastname && $request->middlename == '' && $request->email == '' && $request->number == ''){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->count();
       if($acc){return response()->json(['status'=> 'exist']);}
    }elseif ($request->firstname && $request->lastname && $request->middlename && $request->email =='' && $request->number ==''){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->where('customer_middlename', 'like', '%' . $request->middlename . '%')->count();
      if($acc){return response()->json(['status'=> 'match']);}
    }elseif ($request->firstname && $request->lastname && $request->middlename && $request->email && $request->number ==''){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->where('customer_middlename', 'like', '%' . $request->middlename . '%')->where('customer_email', 'like', '%' . $request->email . '%')->count();
      if($acc){return response()->json(['status'=> 'email_match']);}
    }elseif ($request->firstname && $request->lastname && $request->middlename && $request->email && $request->number){
     $acc = CustomerAcc::where('customer_firstname', 'like', '%' . $request->firstname . '%')->where('customer_lastname', 'like', '%' . $request->lastname . '%')->where('customer_middlename', 'like', '%' . $request->middlename . '%')->where('customer_email', 'like', '%' . $request->email . '%')->where('customer_phone_num', 'like', '%' . $request->number . '%')->count();
      if($acc){return response()->json(['status'=> 'number_match']);}
    }

   if($request->firstname == '' || $request->lastname == '') {
      if($request->firstname == '' && $request->lastname == ''){
         return response()->json(['status'=> 'failed']);
      }else if($request->firstname == ''){
         return response()->json(['status'=> 'firstname']);
      }else if($request->lastname == ''){
         return response()->json(['status'=> 'lastname']);
      }
    }
    else{
    $format = strtolower(str_replace(' ', '', $request->firstname));
        $insertnew = new CustomerAcc;
        $insertnew->customer_firstname= $request->firstname;
        $insertnew->customer_middlename= $request->middlename;
        $insertnew->customer_lastname= $request->lastname;
        $insertnew->customer_ext= $request->ext;
        $insertnew->customer_email= $request->email;
        $insertnew->customer_type= $request->customer_type;
        $insertnew->customer_phone_num= $request->number;
        $insertnew->customer_profile_pic= 'none';
        $insertnew->customer_username = strtolower(str_replace(' ', '', $request->firstname));
        $insertnew->customer_password= Hash::make($format.'123');
        $insertnew->save();

        $tour = new Tour;
        $tour->customer_id = $insertnew->customer_id;
        $tour->save();

      $startTime = Carbon::now()->setTimezone('Asia/Hong_Kong');
      $startTimeFormatted = $startTime->format('h:i A'); // Format the start time
      $endTime = $startTime->copy()->addHours(12)->format('h:i A');
      $totalTime = timeDifference($startTimeFormatted, $endTime);
      $payment = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $request->customer_type);

        $insertnewlog = new CustomerLogs;
        $insertnewlog->customer_id = $insertnew->customer_id;
        $insertnewlog->log_date = now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
        $insertnewlog->log_start_time = $startTimeFormatted;
        $insertnewlog->log_end_time = null;
        $insertnewlog->log_transaction = $payment.'-0';
        $insertnewlog->log_status = 0;
        $insertnewlog->log_type= 2;
        $insertnewlog->save();

    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin  Accepted Daypass of " . $request->lastname.".";
    $data->act_header = "Customer log";
    $data->act_location = "customer_log";
    $data->save();

        return response()->json(['status'=> 'success']);
    }
  }

  public function GetScannedURLlog(Request $request){
    $QRCode = $request->QRCode;
    $id = $request->cust_id;
    $customer = CustomerAcc::where('customer_id', $id)->first();

    if($QRCode === 'XCgEMtt4XMC9DN2'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      $checkTransaction =  CustomerLogs::where('customer_id', $id)->where('log_status', 1)->first();
      if(!$checkLogOut && !$checkTransaction){
        $log = new CustomerLogs();
        $log->customer_id = $id;
        $log->log_date =  Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
        $log->log_start_time = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
        $log->log_end_time = '';
        $log->log_status = 0;
        $log->save();
        $status = 'login';
        $log_id = 'none';
      }else{
        $status = 'already_login';
        $log_id = 'none';
      }

    }else if($QRCode === 'FLPguCIZSg9TTqO'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      if($checkLogOut){
        $end = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
        $time = timeDifference($checkLogOut->log_start_time, $end);
        $hours = $time['hours'];
        $minutes = $time['minutes'];
        $payment = PaymentCalc($hours, $minutes, $customer->customer_type);
        $transaction = $payment . "-1";
        $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
        $updateLog->update([
          'log_end_time'=> $end,
          'log_status'=> 1,
          'log_transaction'=>$transaction,
        ]);
        $status = 'logout';
        $log_id = $checkLogOut->log_id;
      }else{
        $status = 'not_login';
        $log_id = 'none';
      }

    }else if($QRCode === 'IuFiIJwM3AupqAK'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();

        if($checkLogOut){
          $end = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
          $time = timeDifference($checkLogOut->log_start_time, $end);
          $hours = $time['hours'];
          $minutes = $time['minutes'];

          $payment = PaymentCalc($hours, $minutes, $customer->customer_type);
          $finalCredit = $customer->account_credits - $payment;

          $transaction = $payment . "-2";
          if($finalCredit < 0){
            $status = 'not_enough';
            $log_id = $checkLogOut->log_id;
          }else{
            $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
            $updateLog->update([
              'log_end_time'=> Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A'),
              'log_status'=> 1,
              'log_transaction'=>$transaction,
              'log_payment_method'=> 'Credit',
            ]);


            $status = 'logout';
            $log_id = $checkLogOut->log_id;
          }
        }else{
          $status = 'not_login';
          $log_id = $checkLogOut->log_id;
        }
  }else if($QRCode === 'https://orangeshire.com/download'){
    $status = 'download';
    $log_id = 'none';
  }else{
    $status = 'fail';
    $log_id = 'fail';
  }
  return response()->json(['status'=>$status, 'log_data'=>$log_id]);
}

  public function GetCustomerLoginStatus(Request $req){
    $customer = $req->cookie('customer_id');

    $logs = CustomerLogs::where('customer_id', $customer)->where('log_date', Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y'))->where('log_status', 0)->first();

    return response()->json(['fetched'=>$logs]);
  }
  public function GetLogInfo(Request $req){
      $id = $req->log_id;

      $log = CustomerLogs::where('log_id', $id)->first();

      return response()->json(['info'=>$log]);
  }

public function GetLogDetails(Request $req){
  $id = $req->log_id;

  $log= CustomerLogs::where('log_id', $id)->first();

  return response()->json(['log_details'=>$log]);
}


public function Scanning(Request $req){
  $userId = $req->cookie('customer_id');
  $customer= CustomerAcc::where('customer_id', $userId)->first();

      if ($userId) {
          if($customer->verification_status === 0){
              return view('homepage.scanQr', [
                  'user_id'=>$userId,
                  'status'=> 'not_verified'
              ]);
          }else{
              return view('homepage.scanQr', [
                  'user_id'=>$userId,
                  'status'=> 'verified'
              ]);
          }

      } else {
          return view('homepage.scanQr', ['user_id'=> 'none', 'status'=> 'not_log_in']);
      }

}

public function GetHistoryData(Request $req){
$id = $req->cust_id;

$log = CustomerLogs::where('customer_id', $id)->orderBy('created_at', 'desc')->get();

return response()->json([
  'log' => $log
]);
}

public function SaveComment(Request $req){
  $log = CustomerLogs::where('log_id', $req->log_id)->first();
  $log->update([
     'log_comment'=>$req->comment,
  ]);

  return response()->json(['status'=>'success']);
}
public function DeleteLog(Request $request){

  $log = CustomerLogs::where('log_id', $request->log_id)->first();
  $cus = CustomerAcc::where('customer_id',$log->customer_id)->first();

    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin deleted " . $cus->customer_lastname."'s log history";
    $data->act_header = "Delete log";
    $data->act_location = "customer_log";
    $data->save();

  $log->delete();

   return response()->json(['status'=>'success']);
}

public function EditPaymentLog(Request $request){
  if($request->editpaymentamount==''){
    return response()->json(['status'=>'empty']);
  }else{
    $log = CustomerLogs::where('log_id', $request->editpaymentid)->first();
    $cus = CustomerAcc::where('customer_id',$log->customer_id)->first();
    $payment = explode('-',$log->log_transaction)[1];
    $pay = explode('-',$log->log_transaction)[0];

    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin  Modified " . $cus->customer_lastname."'s Payment ".$pay." To " .$request->editpaymentamount;
    $data->act_header = "Modified log";
    $data->act_location = "customer_log";
    $data->save();


    $log->update([
       'log_transaction'=>$request->editpaymentamount.'-'.$payment,
    ]);

    return response()->json(['status'=>'success']);
  }

}

public function EditPaymentLogMethod(Request $request){
  if($request->EditpaymentMethod==''){
    return response()->json(['status'=>'empty']);
  }else{
    $log = CustomerLogs::where('log_id', $request->editpaymenMethodtid)->first();
    $cus = CustomerAcc::where('customer_id',$log->customer_id)->first();


    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin  Modified " . $cus->customer_lastname."'s Payment Mthod".$log->log_payment_method." To " .$request->EditpaymentMethod;
    $data->act_header = "Modified log";
    $data->act_location = "customer_log";
    $data->save();


    $log->update([
       'log_payment_method'=>$request->EditpaymentMethod,
    ]);

    return response()->json(['status'=>'success']);
  }

}

public function logAsDayPass(Request $request){

      $cus = CustomerAcc::where('customer_id',$request->id)->first();

      $startTime = Carbon::now()->setTimezone('Asia/Hong_Kong');
      $startTimeFormatted = $startTime->format('h:i A'); // Format the start time
      $endTime = $startTime->copy()->addHours(12)->format('h:i A');
      $totalTime = timeDifference($startTimeFormatted, $endTime);
      $payment = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $cus->customer_type);

        $insertnewlog = new CustomerLogs;
        $insertnewlog->customer_id = $request->id;
        $insertnewlog->log_date = now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
        $insertnewlog->log_start_time = $startTimeFormatted;
        $insertnewlog->log_end_time = null;
        $insertnewlog->log_transaction = $payment.'-0';
        $insertnewlog->log_status = 0;
        $insertnewlog->log_type= 2;
        $insertnewlog->save();

    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin  Accepted Daypass of " . $cus->customer_lastname.".";
    $data->act_header = "Customer log";
    $data->act_location = "customer_log";
    $data->save();

        return response()->json(['status'=> 'success']);
}
public function SaveLogByGroup(Request $request)
{
    // Input validation
    $request->validate([
        'IndivFirstName' => 'required|array',
        'IndivLastName' => 'required|array',
        'IndivType' => 'required|array',
        'groupId' => 'required',
    ]);

    // Retrieve request data
    $firstNames = $request->input('IndivFirstName');
    $lastNames = $request->input('IndivLastName');
    $types = $request->input('IndivType');
    $groupId = $request->input('groupId');

    // Get current time in Asia/Hong_Kong timezone
    $startTime = now()->setTimezone('Asia/Hong_Kong');
    $startTimeFormatted = $startTime->format('h:i A');

    // Loop through each individual
    foreach ($firstNames as $key => $firstName) {
        // Compute lowercase username
        $lower = strtolower(str_replace(' ', '', $firstName));

        // Create new customer account
        $customer = CustomerAcc::create([
            'customer_firstname' => $firstName,
            'customer_lastname' => $lastNames[$key],
            'customer_type' => $types[$key],
            'customer_username' => $lower,
            'customer_password' => Hash::make($lower . '123'),
        ]);

        // Create new customer log
        CustomerLogs::create([
            'customer_id' => $customer->customer_id,
            'log_date' => $startTime->format('d/m/Y'),
            'log_start_time' => $startTimeFormatted,
            'log_status' => 0,
            'log_type' => 1,
            'log_group_id' => $groupId,
        ]);
    }

    return response()->json(['status' => 'success']);
}

public function SaveLogByExistGroup(Request $request){

  $id = $request->IndivId;
   $groupId = $request->groupId2;
     $startTime = Carbon::now()->setTimezone('Asia/Hong_Kong');
      $startTimeFormatted = $startTime->format('h:i A');
  for($i=0;count($id)>$i;$i++){

        $insertnewlog = new CustomerLogs;
        $insertnewlog->customer_id = $id[$i];
        $insertnewlog->log_date = now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
        $insertnewlog->log_start_time = $startTimeFormatted;
        $insertnewlog->log_status = 0;
        $insertnewlog->log_type= 1;
         $insertnewlog->log_group_id= $groupId ;
        $insertnewlog->save();
  }

  return response()->json(['status'=> 'success']);
}
public function GetGroup() {
    $groupedLogs = CustomerLogs::whereNotNull('log_group_id')
        ->select('log_group_id')
        ->distinct()
        ->get();

    $group = [];
    $num = 1;
    foreach ($groupedLogs as $log) {
        $count = CustomerLogs::where('log_group_id', $log->log_group_id)->get()->count();
        $firstLog = CustomerLogs::where('log_group_id', $log->log_group_id)->first();
        $customer = CustomerAcc::where('customer_id', $firstLog->customer_id)->first();
        if ($customer) {
            $group[] = [
                'num'=>$num,
                'groupID' => $log->log_group_id,
                'count' => $count,
                'name' => $customer->customer_firstname . ' ' . $customer->customer_lastname
            ];
        }
          $num++;
    }

    return response()->json(['data' => $group]);
}

public function EditStartTime(Request $request){

  $log = CustomerLogs::where('log_id', $request->editstarttimeid)->first();
  $time = explode(':',$request->safix)[0];
  if($time<10){
  $log->update([
          'log_start_time'=>'0'.$request->safix,
              ]);

   return response()->json(['status'=>'success']);
  }else{
     $log->update([
          'log_start_time'=>$request->safix,
              ]);

   return response()->json(['status'=>'success']);
  }

}
public function GetLogByMonth(Request $request) 
{
    $year = $request->year;
    $logs = CustomerLogs::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
    ->whereYear('created_at', $year)
      ->groupBy('year', 'month')
      ->orderByRaw('year DESC, month DESC')
      ->get();


    $formattedLogs = [];

    foreach ($logs as $log) {
        $formattedLogs[] = [
            'year' => $log->year,
            'month' => $log->month,
            'count' => $log->count,
        ];
    }

    return response()->json(['data' => $formattedLogs]);
}
public function logoutmark(Request $request){

  $array = $request->array;

  foreach ($array as $log_id) {
  $log = CustomerLogs::where('log_status',0)->where('log_id', $log_id)->first();
  if($log){
  $starTime = $log->log_start_time;
  $current = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
  $totalTime = timeDifference($starTime, $current);
  $paymentPass = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $log->customer_type);
  $log->update([
          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-1',
        ]);

  }
}
return response()->json(['status' => 'success']);

}
public function logoutmark1(Request $request){

  $array = $request->array;
  $group = $request->group_id;
  foreach ($array as $log_id) {
  $log = CustomerLogs::where('log_status',0)->where('log_id', $log_id)->first();
  if($log){
  $starTime = $log->log_start_time;
  $current = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
  $totalTime = timeDifference($starTime, $current);
  $paymentPass = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $log->customer_type);
  $log->update([
          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$paymentPass.'-1',
        ]);

  }
}
return response()->json(['status' => 'success','group_id'=>$group]);

}
public function deletemark(Request $request){

  $array = $request->array;
  foreach ($array as $log_id) {
  $log = CustomerLogs::where('log_id', $log_id)->first();
  if($log){
    $cus = CustomerAcc::where('customer_id',$log->customer_id)->first();

    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin deleted " . $cus->customer_lastname."'s log history";
    $data->act_header = "Delete log";
    $data->act_location = "customer_log";
    $data->save();
    $log->delete();
}
}
return response()->json(['status' => 'success']);
}
public function logReservation(Request $request){
    $reserve = Reservations::where('r_id',$request->r_id)->first();
    $rate = RoomRates::where('rp_id',$reserve->rate_id)->first();
    $reserve->status=3;
    $reserve->save();

    $format = strtolower(str_replace(' ', '', $reserve->c_name));
    $insertnew = new CustomerAcc;
    $insertnew->customer_firstname = $reserve->c_name;
    $insertnew->customer_type = $request->customer_type;
    $insertnew->customer_phone_num = $reserve->phone_num;
    $insertnew->customer_profile_pic = 'none';
    $insertnew->customer_username = strtolower(str_replace(' ', '', $reserve->c_name));
    $insertnew->customer_password = Hash::make($format . '123');
    $insertnew->save();

    $tour = new Tour;
    $tour->customer_id = $insertnew->customer_id;
    $tour->save();

    $formattedStartTime = Carbon::createFromFormat('H:i', $reserve->start_time)->format('h:i A');
   
    $formattedDate = Carbon::createFromFormat('Y-m-d', $reserve->start_date)->format('d/m/Y');

    $insertnewlog = new CustomerLogs;
    $insertnewlog->customer_id = $insertnew->customer_id;
    $insertnewlog->log_date = $formattedDate;
    $insertnewlog->log_start_time = $formattedStartTime;
    if($rate){
      $formattedEndTime = Carbon::createFromFormat('H:i', $reserve->end_time)->format('h:i A');
      $totalTime = timeDifference($formattedStartTime, $formattedEndTime);
      $paymentPass = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $request->customer_type);
      $insertnewlog->log_transaction = $paymentPass . '-0';
      $insertnewlog->log_type=2;
    }else{
      $insertnewlog->log_type = 1;
    }
    $insertnewlog->log_status = 0;
    $insertnewlog->save();



    return response()->json(['status' => 'success','message'=> 'Customer successfully log','reload'=> 'reserveData']);
}
public function logCancelReservation(Request $request){
    $reserve = Reservations::where('r_id', $request->r_id)->first();
    $reserve->reason = $request->cancellationReason;
    $reserve->status = 4;
    $reserve->save();
    return response()->json(['status' => 'success', 'message' => 'Reservation successfully canceled', 'reload' => 'reserveData']);
}
}
