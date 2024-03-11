<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerVerification;
class Mailing extends Controller
{
    public function TestMail(Request $request){
        Mail::to('rjvblanco.chmsu@gmail.com')->send(new CustomerVerification());
        return redirect()->back();
    }
}
