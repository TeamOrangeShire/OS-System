<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;
use App\Models\CustomerAcc;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class EditAcc extends Controller
{
  public function EditAdmin(Request $EditAdmin){

    $admin_id = $EditAdmin->admin_id;
    $firstname = $EditAdmin->firstname;
    $middlename = $EditAdmin->middlename;
    $lastname = $EditAdmin->lastname;
    $ext = $EditAdmin->ext;
    $username = $EditAdmin->username;
    $update =  AdminAcc::where('admin_id',$admin_id)->first();

    if(empty($EditAdmin->new_password )|| empty($EditAdmin->old_password)){
        
       

        $update->update([
           
            'admin_firstname'=> $firstname,
            'admin_middlename'=> $middlename,
            'admin_lastname'=> $lastname,
            'admin_ext'=> $ext,
            'admin_username'=> $username,
           
    
        ]);
        return redirect()->back();
    }
    else{
        $new_password = $EditAdmin->new_password;
        $old_password = $EditAdmin ->old_password;

        
    if(Hash::check($old_password,$update->admin_password))
    {
        $update->update([
           
            'admin_firstname'=> $firstname,
            'admin_middlename'=> $middlename,
            'admin_lastname'=> $lastname,
            'admin_ext'=> $ext,
            'admin_username'=> $username,
            'admin_password' => Hash::make($new_password),
    
        ]);
        return redirect()->back();
    }
    else
    {
        $update =  AdminAcc::where('admin_id',$admin_id)->first();
        if(Hash::check($old_password,$update->admin_password))
        {
            $update->update([
               
                'admin_firstname'=> $firstname,
                'admin_middlename'=> $middlename,
                'admin_lastname'=> $lastname,
                'admin_ext'=> $ext,
                'admin_username'=> $username,
                'admin_password' => Hash::make($new_password),
        
            ]);
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
}
    

   

  }

  public function AdminProfile(Request $request) {
  
    $admin_id = $request->admin_id;
  
    
    $request->validate([
        'profile_picture' => 'required|image|max:10240', 
    ]);
  
   
    $file = $request->file('profile_picture'); 
  
   
    $fileName = $admin_id . '.' . $file->getClientOriginalExtension();
  
   
    $file->move(public_path('User/Admin'), $fileName); 
  
  
    $update =  AdminAcc::where('admin_id', $admin_id)->first();
    if ($update) {
        $update->admin_profile_pic = $fileName;
        $update->save();
        return redirect()->back();
    } else {
        return redirect()->route('admin_account');
    }
}
  
    public function EditCustomerPassword(Request $Req){
        $password = $Req->password;
        $newpassword = $Req->newpassword;
        $renewpassword = $Req->renewpassword;

        if($newpassword === $renewpassword){
            $customer_id = $Req->customer_id;

            $passquery = CustomerAcc::where('customer_id', $customer_id)->first();

            if(Hash::check($password, $passquery->customer_password)){
                $passquery->update([
                    'customer_password' => $newpassword,

                ]);
                return response()->json(['status'=>'success']);

            }else{
                return response()->json(['status'=>'current password not match']);
            }
        }else{
            return response()->json(['status'=>'new password not match']);
        }
    }
}
