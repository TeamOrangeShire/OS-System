<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;

class CreateAcc extends Controller
{
    public function CreateAdmin(Request $CreateAdmin){

        
        $post = new AdminAcc;
        $post->admin_firstname = '';
        $post->admin_middlename = '';
        $post->admin_lastname = '';
        $post->admin_ext = '';
        $post->admin_username = $CreateAdmin->AdminName;
        $post->admin_password = $CreateAdmin->AdminPass;
        $post->admin_profile_pic = '';



        $post->save();
        return redirect()->back();

    }
}
