<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAcc;
use App\Models\CustomerAcc;
use App\Models\UnregisterAcc;
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
  
   
    $file->move(public_path('User/Admin/'), $fileName); 
  
  
    $update =  AdminAcc::where('admin_id', $admin_id)->first();
    if ($update) {
        $update->admin_profile_pic = $fileName;
        $update->save();
        return redirect()->back();
    } else {
        return redirect()->route('admin_account');
    }
}
  
//edit customer password
    public function EditCustomerPassword(Request $Req){
        $password = $Req->password;
        $newpassword = $Req->newpassword;
        $renewpassword = $Req->renewpassword;

        if($newpassword === $renewpassword){
            $customer_id = $Req->customer_id;

            $passquery = CustomerAcc::where('customer_id', $customer_id)->first();

            if(Hash::check($password, $passquery->customer_password)){
                $passquery->update([
                    'customer_password' => Hash::make($newpassword),
                ]);
                return response()->json(['status'=>'success']);

            }else{
                return response()->json(['status'=>'current password not match']);
            }
        }else{
            return response()->json(['status'=>'new password not match']);
        }
    }

    //edit customer profile
    public function EditCustomerProfile(Request $customerProfile){
        $customerFirstName = $customerProfile->firstName;
        $customerMidName = $customerProfile->midName;
        $customerLastName = $customerProfile->lastName;
        $customerExtName = $customerProfile->extName;
        $customerEmail = $customerProfile->emailAddress;
        $customerPhoneNumber = $customerProfile->phoneNumber;
        $customer_id = $customerProfile->customer_id;
        $username = $customerProfile->username;

        $editProfilequery = CustomerAcc::where('customer_id', $customer_id)->first();
            $editProfilequery->update([
                'customer_firstname' => $customerFirstName,
                'customer_middlename' => $customerMidName,
                'customer_lastname' => $customerLastName,
                'customer_ext' => $customerExtName,
                'customer_email' => $customerEmail,
                'customer_phone_num' => $customerPhoneNumber,
                'customer_username'=> $username,
            ]);
        return redirect()->back();
        
    }

    public function UpdateCustomerProfilePic(Request $req){

        $file = $req->file('profilePic');

        if ($file->getSize() > 10485760) {
            return response()->json(['status' => 'exceed']);
        }else   if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
            return response()->json(['status' => 'invalid_type']);
        }
        else{
            $fileName = "Customer". $req->user_id.".". $file->getClientOriginalExtension();
            $filePath = public_path('User/Customer/');  
            $file->move($filePath, $fileName);
            
            $customer  = CustomerAcc::where('customer_id', $req->user_id)->first();
            $customer->update([
              'customer_profile_pic' => $fileName,
            ]);

            return response()->json(['status'=>'success']);
        }

     
    }
    public function addCredit(Request $request){

        $customer_id = $request->cus_id;
        $addcredit = $request->cus_credit;
        $operation = $request->operation;

        $customer_credit = CustomerAcc::where('customer_id', $customer_id)->first();

       
        $current_credit = $customer_credit->account_credits;
        if($operation === 'add'){
            $credit = $current_credit + $addcredit;
        }else{
            $credit = $current_credit - $addcredit;
        }
        $customer_credit->update([
               
          'account_credits'=>$credit,
    
        ]);
        return redirect()->back();
    }

    public function changeType(Request $request){
        $customer_id = $request->cus_id;
        $change = CustomerAcc::where('customer_id', $customer_id)->first();
        $type = $change->customer_type;
        $changetype = str_replace('(Pending Validity)', '', $type);
        $change->update([

          'customer_type'=>$changetype,

        ]);
        return redirect()->back();
    }
    public function changeCusttype(Request $request){
        $customer_id = $request->cus_id;
        $change = CustomerAcc::where('customer_id', $customer_id)->first();
        $change->update([

          'customer_type'=>$request->customertype,

        ]);
        return redirect()->back();
    }

    public function editType(Request $request){

        $Un_id_type = $request->Un_id_type;
        $Un_customer_type = $request->Un_customer_type;
       


        $change = UnregisterAcc::where('un_id', $Un_id_type)->first();
        $change->update([
        'un_firstname'=>$request->unfirstname,
        'un_middlename'=>$request->unmiddlename,
        'un_lastname'=>$request->unlastname,
        'un_email'=>$request->unemail,
        'un_contact'=>$request->unnumber,
        'un_ext'=>$request->unext,
        'un_type'=>$Un_customer_type,


        ]);
        return redirect()->back();
    }
}
