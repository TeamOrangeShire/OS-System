<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class Login extends Controller
{
  public function Admin_login(Request $request){
    $Admin_name = $request->input('username');
    $Admin_pass = $request->input('password');

    $Admin_info = AdminAcc::where('admin_username',$Admin_name)->first();
    if($Admin_info && Hash::check($Admin_pass,$Admin_info->admin_password)){
    
        Session::put('Admin_id',$Admin_info->admin_id);
        return redirect()->route('index');


    } else{
        return redirect()->back();
    }
    }

    public function Admin_lockscreen(Request $request){
       
        $lock_password = $request->input('lock_password');
        $session_id = Session::get('Admin_id');
        
        $Admin_info = AdminAcc::where('admin_id',$session_id)->first();
        if($Admin_info->admin_password === $lock_password){
        
            
            return redirect()->route('index');
    
    
        } else{
            return redirect()->back();
        }
        }
}
