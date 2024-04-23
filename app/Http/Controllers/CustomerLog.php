<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogs;
use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\CustomerAcc;
use App\Models\CustomerLogUnregister;
use App\Models\UnregisterAcc;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerLog extends Controller
{
  public function getlog(Request $request){

    $id = $request->id;
    $log = CustomerLogs::where('customer_id',$id)->get();

    return response()->json(['logs'=>$log]);
  }
  public function acceptLog(Request $request){

    $id = $request->pending_log;
   

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
    $data->act_action = "Admin accept payment of " . $cus_info->customer_lastname;
    $data->act_header = "Accept log payment";
    $data->act_location = "customer_log";
    $data->save();

    return response()->json(['status'=> 'success']);
  }

  public function UnregisterLogout(Request $request){

    $id = $request->un_id;
   

    $log = CustomerLogUnregister::where('unregister_id',$id)->first();
    $log->update([

        'un_log_status'=> 2,

    ]);
    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accept payment of " . $log->un_lastname;
    $data->act_header = "Accept logout payment";
    $data->act_location = "customer_log_unregister";
    $data->save();
    return redirect()->back();
  }

   public function accept_unregistered(Request $request){

    $id = $request->unregister_id;
    

    $log = CustomerLogUnregister::where('unregister_id',$id)->first();
   $start = $log->un_log_start_time;
   $end = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');

   $time = timeDifference($start,$end);
   $totalPayment= PaymentCalc($time['hours'],$time['minutes'],'Students');
    $log->update([
        'un_log_end_time'=>$end,
        'un_log_status'=> 1,
        'un_log_transaction' =>$totalPayment,
    ]);
    
    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accept payment of " . $log->un_lastname;
    $data->act_header = "Accept unregister log payment";
    $data->act_location = "customer_log_unregister";
    $data->save();

    return response()->json(['payment'=> $totalPayment,'start'=>$start,'end'=>$end,'hours'=>$time['hours'],'minutes'=>$time['minutes']]);
  }

  public function AcceptUnregisterLog(request $request){

    $accept = new UnregisterAcc;
    $accept -> un_firstname = $request->firstname;
    $accept -> un_middlename = $request->middlename;
    $accept -> un_lastname = $request->lastname;
    $accept -> un_ext = $request->ext;
    $accept -> un_email = $request->email;
    $accept -> un_contact = $request->number;
    $accept->save();
   
    $unregister = new CustomerLogUnregister;
    $unregister -> un_id = $accept->un_id; 
    $unregister -> un_log_date = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
    $unregister -> un_log_start_time = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
    $unregister -> un_log_status = 0;
    $unregister->save();
    return redirect()->back();
  }
   public function UnregisterLogin(request $request){

    $id =$request ->login_id;
    $unregister = new CustomerLogUnregister;
    $unregister -> un_id = $id;
    $unregister -> un_log_date = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y');
    $unregister -> un_log_start_time = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
    $unregister -> un_log_status = 0;
    $unregister->save();
    return redirect()->back();
  }

  public function GetScannedURLlog(Request $request){
    $QRCode = $request->QRCode;
    $id = $request->cust_id;
    $customer = CustomerAcc::where('customer_id', $id)->first();

    if($QRCode === 'XCgEMtt4XMC9DN2'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      if(!$checkLogOut){
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
      $end = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
      $time = timeDifference($checkLogOut->log_start_time, $end);
      $hours = $time['hours'];
      $minutes = $time['minutes'];
      $payment = PaymentCalc($hours, $minutes, $customer->customer_type);
      $transaction = $payment . "-1";
      if($checkLogOut){
        $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
        $updateLog->update([
          'log_end_time'=> $end,
          'log_status'=> 1,
          'log_transaction'=>$transaction,
        ]);
        $status = 'logout';
        $log_id = $checkLogOut->log_id;
      }
   
    }else if($QRCode === 'IuFiIJwM3AupqAK'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      $end = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
      $time = timeDifference($checkLogOut->log_start_time, $end);
      $hours = $time['hours'];
      $minutes = $time['minutes'];
      
      $payment = PaymentCalc($hours, $minutes, $customer->customer_type);
      $finalCredit = $customer->account_credits - $payment;
     
      $transaction = $payment . "-2";
        if($checkLogOut){
          if($finalCredit < 0){
            $status = 'not_enough';
            $log_id = $checkLogOut->log_id;
          }else{
            $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
            $updateLog->update([
              'log_end_time'=> Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A'),
              'log_status'=> 1,
              'log_transaction'=>$transaction,
            ]);
           
          
            $status = 'logout';
            $log_id = $checkLogOut->log_id;
          }
        }
  }else{
    $status = 'download';
    $log_id = 'none';
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


}

