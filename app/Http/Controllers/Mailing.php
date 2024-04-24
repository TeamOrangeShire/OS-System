<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerVerification;
use App\Models\CustomerAcc;
use Illuminate\Support\Facades\Cookie;
class Mailing extends Controller
{

    public function CreateAccGoogleVerification(Request $req){

        $id = $req->cust_id;
        $customer = CustomerAcc::where('customer_id', $id)->first();
        $email = $customer->customer_email;
        $code = VerificationCodeGenerator();
        $customer->update([
           'verification_code' => $code,
        ]);

        Mail::to($email)->send(new CustomerVerification($code, $customer->customer_id));
        
        return response()->json(['status'=>'success']);
    }


    public function VerificationRoute(Request $req){
       $code = $req->verificationcode;
       $id = $req->id;
       
       $customer = CustomerAcc::where('customer_id', $id)->first();
      if($customer->verification_code == $code){
        $customer->update([
          'verification_status'=> 1,
        ]);
        $cookie = Cookie::make('customer_id', $id , 60 * 24 * 31);
        return redirect()->route('verified')->with(['id' => $id, 'status' => 'success'])->withCookie($cookie);
      } else{
        return redirect()->route('verified')->with(['id' => 'none', 'status' => 'fail']);
      }
      
    }
}
