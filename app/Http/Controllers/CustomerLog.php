<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogs;
use App\Models\CustomerAcc;
use App\Http\Controllers\Controller;
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
    $currentTime = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');

    $log = CustomerLogs::where('log_id',$id)->first();
    
    $log->update([

        'log_end_time'=>$currentTime,
        'log_status'=> 2,

    ]);
    return response()->json(['status'=> 'success']);
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
      }
   
    }else if($QRCode === 'FLPguCIZSg9TTqO'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      $end = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
      $time = timeDifference($checkLogOut->log_start_time, $end);
      $payment = PaymentCalc($time['hours'], $time['minutes'], $customer->customer_type);
      $transaction = $payment . "-1";
      if($checkLogOut){
        $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
        $updateLog->update([
          'log_end_time'=> $end,
          'log_status'=> 1,
          'log_transaction'=>$transaction,
        ]);
      }
     
    }else if($QRCode === 'IuFiIJwM3AupqAK'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      $end = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
      $time = timeDifference($checkLogOut->log_start_time, $end);
      $hours = $time['hours'];
      $minutes = $time['minutes'];
      $payment = PaymentCalc($hours, $minutes, $customer->customer_type);
      $transaction = $payment . "-2";
     
      if($checkLogOut){
        $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
        $updateLog->update([
          'log_end_time'=> Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A'),
          'log_status'=> 2,
          'log_transaction'=>$transaction,
        ]);
        $finalCredit = $customer->account_credits - $payment;
        $customer->update([
          'account_credits'=> $finalCredit,
        ]);
      }

    
  }
  return response()->json(['status'=>'success']);
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
}

