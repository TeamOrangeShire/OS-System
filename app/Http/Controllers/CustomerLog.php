<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerLog extends Controller
{
  public function getlog(Request $request){

    $id = $request->id;
    $log = CustomerLogs::where('customer_id',$id)->get();

    return response()->json(['logs'=>$log]);
  }


  public function GetScannedURLlog(Request $request){
    $direction = $request->direction;
    $id = $request->id;

    if($direction === 'login'){
      $log = new CustomerLogs();
      $log->customer_id = $id;
    }
  }
}
