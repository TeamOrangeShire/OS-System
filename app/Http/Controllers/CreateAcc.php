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
        $username = $req->username;
        $email = $req->email;
        $password = $req->password;

        $usernameCheck = CustomerAcc::where('customer_username', $username)->first();
        if($usernameCheck){
            return response()->json(['id'=>'none', 'status'=>'exist', 'username'=>'none', 'password'=>'none']);
        }

        $account = new CustomerAcc();
        $account->customer_firstname = $fname;
        $account->customer_middlename = $mname;
        $account->customer_lastname = $lname;
        $account->customer_ext = 'none';
        $account->customer_email = $email;
        $account->customer_phone_num = 'none';
        $account->customer_username = $username;
        $account->customer_password = Hash::make($password);
        $account->customer_profile_pic = 'none';
        $account->verification_status = 0;
        $account->verification_code = 0;
        $account->save();
        
        $tour = new Tour();
        $tour->customer_id = $account->customer_id;
        $tour->save();

        return response()->json(['id'=>$account->customer_id, 'status'=>'not_exist', 'username'=>$username, 'password'=>$password]);
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


    public function UpdateType(Request $req){
        $type = $req->type;
        $id = $req->cust_id;

        $customer = CustomerAcc::where('customer_id', $id)->first();

        $customer->update([
            'customer_type'=> $type."(Pending Validity)",
        ]);

        return response()->json(['status'=>'success']);
    }
    
}
