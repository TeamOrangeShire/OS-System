<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerVerification;
class Mailing extends Controller
{

    public function CreateAccGoogleVerification(Request $req){

      $data = $req->validate([
         'fname'=>'required',
         'mname'=>'required',
         'lname'=>'required',
         'extension'=> 'required',
         'email'=>'required',
         'password'=>'required',
      ]);
     
        $code = VerificationCodeGenerator();
        Mail::to($data['email'])->send(new CustomerVerification($code));
      
        return response()->json([
          'status'=>'success',
          'fname'=>$data['fname'],
          'mname'=>$data['mname'],
          'lname'=>$data['lname'],
          'ext'=>$data['extension'],
          'email'=>$data['email'],
          'password'=>$data['password'],
          'code'=>$code,
        ]);
    }

    // public function TestMail(Request $request){
    //     Mail::to('rjvblanco.chmsu@gmail.com')->send(new CustomerVerification());
    //     return redirect()->back();
    // }
}
