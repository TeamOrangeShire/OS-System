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
      $company = $req->company_name;
      $contact = $req->contact;
      $r_dur_price = $req->duration;
      $date = $req->date;
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
      $res->res_notes = '';
      $res->res_status = '';
      $res->res_disable = 0;
      $res->save();

      $cust = CustomerAcc::where('customer_id', $customer)->first();
      $cust->update([
        'customer_phone_num'=>$contact,
      ]);

      return response()->json(['status'=>'success']);

    }
}
