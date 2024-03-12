<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;
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
}
