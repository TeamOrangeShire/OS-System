<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Reservations;
use App\Models\CustomerAcc;

class Reservation extends Controller
{
    public function SelectDate(Request $request){
      $date = $request->date;
      Session::put('selectedDate', $date);
      return redirect()->route('book');
    }

    public function SaveReservation(Request $req){
      $customer = $req->customer_id;
      $company = empty($req->company_name) ? 'NA' : $req->company_name;
      $contact = $req->contact;
      $r_dur_price = $req->duration;
      $date = $req->date;
      $notes = empty($req->notes) ? 'NA' : $req->notes;
      $time = $req->hiddenTime;
      $start = $time[0].$time[1];
      $end = $time[3].$time[4];
     
      $res = new Reservations();
      $res->customer_id = $customer;
      $res->rprice_id = $r_dur_price;
      $res->res_date = $date;
      $res->res_company = $company;
      $res->res_start = $start;
      $res->res_end = $end;
      $res->res_notes = $notes;
      $res->res_status = '0';
      $res->res_cancel = '0';
      $res->res_reason = '';

      $res->save();

      $cust = CustomerAcc::where('customer_id', $customer)->first();
      $cust->update([
        'customer_phone_num'=>$contact,
      ]);

      return response()->json(['status'=>'success']);

    }
    public function ConfirmReservation(Request $req){

      $res_id = $req->r_id;
      $update =  Reservations::where('res_id',$res_id)->first();
      $update->update([
         
          'res_status'=> 1,
          
      ]);
      return redirect()->back();
    }
    public function DeclineReservation(Request $req){

      $res_id = $req->res_id;
      $reason = $req->reasonlist;
      $update =  Reservations::where('res_id',$res_id)->first();
      $update->update([
         
          'res_cancel'=> 1,
          'res_reason'=>$reason,

          
      ]);
      return redirect()->back();
    }
}
