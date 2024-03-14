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
        $fname = $req->mname;
        $lname = $req->lname;
        $mname = $req->mname;
        $email = $req->email;
        $password = $req->password;


    }

    
}
