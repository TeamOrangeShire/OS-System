<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;

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
        $fname = $req->mname;
        $lname = $req->lname;
        $mname = $req->mname;
        $ext = $req->ext;
        $email = $req->email;
        $contact = $req->contact;
        $username =$req->username;
        $password = $req->password;

        $acc = new CustomerAcc();
        $acc->customer_firstname = $fname;
        $acc->customer_middlename = $mname;
        $acc->customer_lastname = $lname;
        $acc->customer_ext = $ext;
        $acc->customer_email = $email;
        $acc->customer_phone_num = $contact;
        $acc->customer_username = $username;
        $acc->customer_password = $password;
        $acc->customer_profile_pic = 'none';
    }
}
