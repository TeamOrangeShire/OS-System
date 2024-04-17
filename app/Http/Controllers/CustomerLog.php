<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogs;
use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\CustomerAcc;
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
    
    $log->update([

        'log_status'=> 2,

    ]);
    $cus_info = CustomerAcc::where('customer_id',$log->customer_id)->first();
    $data = new ActivityLog;
    $data->act_user_id =session('Admin_id');
    $data->act_user_type = "Admin";
    $data->act_action = "Admin accept payment of " . $cus_info->customer_lastname;
    $data->act_header = "Accept log payment";
    $data->act_location = "customer_log";
    $data->save();

    return response()->json(['status'=> 'success']);
  }

  public function GetScannedURLlog(Request $request){
    $QRCode = $request->QRCode;
    $id = $request->cust_id;


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
      if($checkLogOut){
        $updateLog = CustomerLogs::where('log_id', $checkLogOut->log_id)->first();
        $updateLog->update([
          'log_status'=> 1,
        ]);
      }
     
    }else if($QRCode === 'IuFiIJwM3AupqAK'){
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

    $logs = CustomerLogs::where('customer_id', $customer)->where('log_date', Carbon::now()->setTimezone('Asia/Hong_Kong')->format('d/m/Y'))->first();

    return response()->json(['fetched'=>$logs]);
  }
}
