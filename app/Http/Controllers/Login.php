<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;
use App\Models\CustomerAcc;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class Login extends Controller
{
  public function Admin_login(Request $request){
    $Admin_name = $request->input('username');
    $Admin_pass = $request->input('password');

    $Admin_info = AdminAcc::where('admin_username',$Admin_name)->first();
    if( Hash::check($Admin_pass,$Admin_info->admin_password)){
    
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
    if( Hash::check($lock_password,$Admin_info->admin_password)){
    
        Session::put('Admin_id',$Admin_info->admin_id);
        return redirect()->route('index');


    } else{
        return redirect()->back();
    }
        }

    public function LoginCustomer(Request $req){
        
        $username = $req->username;
        $password = $req->password;

        $customer  =  CustomerAcc::where('customer_username', $username)->first();
        if($customer){
            if(Hash::check($password, $customer->customer_password)){
                return response()->json(['status'=>'success']);
            }else{
                return response()->json(['status'=>'fail']);
            }
        }else{
            return response()->json(['status'=>'not found']);
        }

      
    }
}
