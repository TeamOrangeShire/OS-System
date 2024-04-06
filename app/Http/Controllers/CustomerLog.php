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
}
