<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogs;
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
    $direction = $request->direction;
    $id = $request->cust_id;


    if($direction === 'login'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      if(!$checkLogOut){
        $log = new CustomerLogs();
        $log->customer_id = $id;
        $log->log_date = Carbon::now()->format('d/m/Y');
        $log->log_start_time = Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A');
        $log->log_end_time = '';
        $log->log_status = 0;
        $log->save();
      }
   
    }else if($direction === 'logout_walkin'){
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      if($checkLogOut){
        $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
        $updateLog->update([
          'log_status'=> 1,
        ]);
      }
     
    }else{
      $checkLogOut = CustomerLogs::where('customer_id', $id)->where('log_status', 0)->first();
      if($checkLogOut){
        $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
        $updateLog->update([
          'log_end_time'=> Carbon::now()->setTimezone('Asia/Hong_Kong')->format('h:i A'),
          'log_status'=> 2,
        ]);
      }

    
  }
  return response()->json(['status'=>'success']);
}

  public function GetCustomerLoginStatus(Request $req){
    $customer = $req->cookie('customer_id');

    $logs = CustomerLogs::where('customer_id', $customer)->where('log_date', Carbon::now()->format('d/m/Y'))->first();

    return response()->json(['fetched'=>$logs]);
  }
}
