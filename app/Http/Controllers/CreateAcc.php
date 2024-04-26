<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;
use App\Models\CustomerAcc;
use App\Models\Tour;
use Illuminate\Support\Facades\Hash;

class CreateAcc extends Controller
{
    public function CreateAdmin(Request $CreateAdmin){

        
        $post = new AdminAcc;
        $post->admin_firstname = $CreateAdmin->FirstName;
        $post->admin_middlename = $CreateAdmin->MiddleName;
        $post->admin_lastname = $CreateAdmin->LastName;
        $post->admin_ext = $CreateAdmin->Ext;
        $post->admin_username = $CreateAdmin->AdminName;
        $post->admin_password = Hash::make($CreateAdmin->AdminPass);
        $post->admin_profile_pic = '';

        $post->save();
        return redirect()->back();

    } 

    public function CreateCustomerAcc(request $req){
        $fname = $req->fname;
        $lname = $req->lname;
        $mname = $req->mname;
        $email = $req->email;
        $password = $req->password;
        $ext = $req->extension;
        
        $checkEmail = CustomerAcc::where('customer_email', $email)->first();
        if($checkEmail){
            return response()->json(['id'=>'none', 'email'=>'exist']);
        }

        $session_id =  Hash::make($email);
        $account = new CustomerAcc();
        $account->customer_firstname = $fname;
        $account->customer_middlename = $mname;
        $account->customer_lastname = $lname;
        $account->customer_ext = $ext;
        $account->customer_email = $email;
        $account->customer_phone_num = 'none';
        $account->customer_username = $email;
        $account->customer_password = Hash::make($password);
        $account->customer_profile_pic = 'none';
        $account->customer_type = null;
        $account->verification_status = 0;
        $account->verification_code = 0;
        $account->session_id = $session_id;
        $account->save();
        
        $tour = new Tour();
        $tour->customer_id = $account->customer_id;
        $tour->tour_home = 0;
        $tour->tour_login = 0;
        $tour->tour_profile = 0;
        $tour->tour_subscription = 0;
        $tour->tour_reservation = 0;
        $tour->tour_settings = 0;
        $tour->save();

        return response()->json(['id'=>$session_id, 'email'=>'not_exist']);
    }

    public function SuccessCreateAccount(Request $request){

        $id = $request->id;
        $redirect = $request->redirect;
        $customer = CustomerAcc::where('session_id', $id)->first();
        if($customer){
            return view('homepage.finish_account', ['id'=>$customer->customer_id, 'redirect'=> $redirect]);
        }else{
            return view('homepage.finish_account', ['id'=>'none',  'redirect'=> $redirect]);
        }
     

    }

    public function UpdateTour(Request $req){
        $user = $req->user_id;
        $location = $req->location;

        $tour = Tour::where('customer_id', $user)->first();

        switch($location){
            case 'home':
                $tour->update([
                   'tour_home'=> 1,
                ]);
                break;
            case 'login':
                $tour->update([
                    'tour_login'=> 1,
                 ]);
                 break;
            case 'profile':
                $tour->update([
                    'tour_profile'=> 1,
                 ]);
                 break;
        }

        return response()->json(['status'=>'success']);
    }
    
}
