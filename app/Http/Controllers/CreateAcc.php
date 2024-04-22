<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;
use App\Models\CustomerAcc;
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
        $account->save();

        $id = $account->customer_id;

        return response()->json(['id'=>$id, 'email'=>'not_exist']);
    }

    public function SuccessCreateAccount(Request $request){

        $id = $request->id;
        return view('homepage.finish_account', ['id'=>$id]);

    }
    
}
