<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Reservation extends Controller
{
    public function SelectDate(Request $request){
      $date = $request->date;
      Session::put('selectedDate', $date);
      return redirect()->route('book');
    }
}
