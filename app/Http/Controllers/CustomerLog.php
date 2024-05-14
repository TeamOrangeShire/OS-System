<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogs;
use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\CustomerAcc;
use App\Models\Tour;
use App\Models\CustomerNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

  public function GetCustomerAcc() {
    $accounts = CustomerAcc::all();
    foreach ($accounts as $acc) {
        $customerLogs1 = CustomerLogs::where('customer_id', $acc->customer_id)
                                     ->whereIn('log_status', [0]) // Changed to an array with one element
                                     ->first();
        $customerLogs2 = CustomerLogs::where('customer_id', $acc->customer_id)
                                     ->whereIn('log_status', [1]) // Changed to an array with one element
                                     ->first();
        if ($customerLogs1) {
            $acc->log_in = "0";
            $acc->logtype = $customerLogs1->log_type;
            $acc->log_id = $customerLogs1->log_id;
        } elseif ($customerLogs2) {
            $acc->log_in = "1";
            $acc->logtype = $customerLogs2->log_type;
            $acc->log_payment = $customerLogs2->log_transaction;
            $acc->log_start_time = $customerLogs2->log_start_time;
            $acc->log_end_time = $customerLogs2->log_end_time;
            $acc->log_id = $customerLogs2->log_id;
        } else {
            $acc->log_in = "2"; 
        }
        unset($acc->created_at);
        unset($acc->updated_at);
      
    }
    $accounts = $accounts->toArray();
    return response()->json(['data' => $accounts]);
}



public function GetCustomerlog(Request $request) {

    $logs = CustomerLogs::where('customer_id',$request->cuslogid)->get();

    return response()->json(['data' => $logs]);
}
public function CustomerlogHistory() {

 
  $logs = CustomerLogs::join('customer_acc','customer_logs.customer_id','=','customer_acc.customer_id')->
  select('customer_logs.*','customer_acc.customer_firstname as firstname','customer_acc.customer_lastname as lastname',
  'customer_acc.customer_email as email','customer_acc.customer_phone_num as contact','customer_acc.customer_middlename as middlename')->get();

  return response()->json(['data' => $logs]);
}
public function LogToPending(Request $request) {

    $logs = CustomerLogs::where('log_id',$request->id)->first();
    $start = $logs->log_start_time;
    $current = now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
    $totalTime = timeDifference($start, $current);
    $cusAcc = CustomerAcc::where('customer_id',$logs->customer_id)->first();
    $type =$cusAcc->customer_type;
    $payment = PaymentCalc($totalTime['hours'], $totalTime['minutes'], $type);
   
    if($logs->log_status == 0){
      if($logs->log_type == 0){
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$payment.'-1',
    
        ]);
        
      }else{
        $logs->update([

          'log_status'=> 1,
          'log_end_time'=> $current,
          'log_transaction'=>$payment.'-0',
    
        ]);
      }
    return response()->json(['data' => $logs->customer_id]);
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
public function BackToLogout(Request $request){

  $logs = CustomerLogs::where('log_id',$request->id)->first();
  $logs->update([

    'log_status'=> 0,
    'log_end_time'=> '',
    'log_transaction'=>'',

  ]);

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
        $insertnewlog->log_end_time = $endTime;
        $insertnewlog->log_transaction = $payment.'-0';
        $insertnewlog->log_status = 1;
        $insertnewlog->log_type= 1;
        $insertnewlog->save();
        
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
        $insertnewlog->log_end_time = $endTime;
        $insertnewlog->log_transaction = $payment.'-0';
        $insertnewlog->log_status = 1;
        $insertnewlog->log_type= 1;
        $insertnewlog->save();

        return response()->json(['status'=> 'success']);
}
}

