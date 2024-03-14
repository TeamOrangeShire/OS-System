<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerVerification;
class Mailing extends Controller
{

    public function CreateAccGoogleVerification(Request $req){
        $fname = $req->mname;
        $lname = $req->lname;
        $mname = $req->mname;
        $email = $req->email;
        $password = $req->password;
        $code = VerificationCodeGenerator();
        Mail::to($email)->send(new CustomerVerification($code));
      
        return response()->json([
          'status'=>'success',
          'fname'=>$fname,
          'mname'=>$mname,
          'lname'=>$lname,
          'email'=>$email,
          'password'=>$password,
          'code'=>$code,
        ]);
    }

    // public function TestMail(Request $request){
    //     Mail::to('rjvblanco.chmsu@gmail.com')->send(new CustomerVerification());
    //     return redirect()->back();
    // }
}
