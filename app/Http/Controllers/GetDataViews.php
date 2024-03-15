<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetDataViews extends Controller
{
    public function GetHomeCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.index', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.index', ['customer_id'=> 'none']);
        }
    }

    public function GetSolutionsCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.solutions', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.solutions', ['customer_id'=> 'none']);
        }
    }

    public function GetReservationCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.reservation', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.reservation', ['customer_id'=> 'none']);
        }
    }
    
    public function GetContactCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.contact', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.contact', ['customer_id'=> 'none']);
        }
    }
    public function GetBookCookies(Request $req){
        $userId = $req->cookie('customer_id');

        if ($userId) {
            return view('homepage.book', [
                'customer_id'=>$userId,
            ]);
        } else {
            return view('homepage.book', ['customer_id'=> 'none']);
        }
    }
}
