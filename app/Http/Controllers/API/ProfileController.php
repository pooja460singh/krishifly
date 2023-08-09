<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProfileController extends Controller
{
    public function update_profile(Request $Request){

        $userId=$Request->input('userId');
        $user_role=$Request->input('user_role');
        $name=$Request->input('name');
        $trade_name=$Request->input('trade_name');
        $address=$Request->input('address');
        $city=$Request->input('city');
        $mandi_address=$Request->input('mandi_address');
        $pincode=$Request->input('pincode');
        $state=$Request->input('state');
        $district=$Request->input('district');
        $tahsil=$Request->file('tahsil');
        $village=$Request->input('village');

     

        $profile_upd=DB::table('role_users')->where('role_id',$user_role)->where('user_ID',$userId)->update([
            'name'=>$name,
            'address'=>$address,
            'mandi_address'=>$mandi_address,
            'trade_name'=>$trade_name,
            'city'=>$city,
            'pincode'=>$pincode,
            'state'=>$state,
            'district'=>$district,
            'tahsil'=>$tahsil,
            'village'=>$village,
            
        ]);

        if($userId == 'kisan'){
        $profile_upd=DB::table('tbl_kisan')->where('user_id',$userId)->update([
            'username'=>$name,
            'address'=>$address,
        ]);
        }elseif($userId == 'Transporters'){
            $profile_upd=DB::table('tbl_transporters')->where('user_id',$userId)->update([
            'username'=>$name,
            'address'=>$address,
        ]);
        }elseif($userId == 'Agent'){
            $profile_upd=DB::table('tbl_agent')->where('user_id',$userId)->update([
            'username'=>$name,
            'address'=>$address,
        ]); 
        }

         if($profile_upd){
        $data['msg']='Thank You ! Your Profile Update Successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
    }else{
        $data['msg']='Your Profile Not Update Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
    } 

   }

   public function kyc_bank_update(Request $Request){

        $userId=$Request->input('userId');
        $user_role=$Request->input('user_role');
        $account_holder_name=$Request->input('account_holder_name');
        $account_no=$Request->input('account_no');
        $ifsc_code=$Request->input('ifsc_code');
        $aadhar_no=$Request->input('aadhar_no');
        $aadhar_front_image=$Request->file('aadhar_front_image');
        $aadhar_back_image=$Request->file('aadhar_back_image');
        $pan_no=$Request->input('pan_no');
        $pan_image=$Request->file('pan_image');
        $passbook_image=$Request->input('passbook_image');
        $branch_name=$Request->file('branch_name');

         $orignalName = time() . '.' . $aadhar_front_image->getClientOriginalName();
        $aadhar_front_image->move(public_path('images/aadhar') , $orignalName);
        $aadhar_front_path= 'images/aadhar/'.$orignalName;

         $orignalName_aadhar = time() . '.' . $aadhar_back_image->getClientOriginalName();
        $aadhar_back_image->move(public_path('images/aadhar') , $orignalName_aadhar);
        $aadhar_back_path= 'images/aadhar/'.$orignalName_aadhar;

         $panorignalName = time() . '.' . $pan_image->getClientOriginalName();
        $pan_image->move(public_path('images/pan') , $panorignalName);
        $pan_path= 'images/pan/'.$panorignalName;

        $kyc_upd=DB::table('role_users')->where('role_id',$user_role)->where('user_ID',$userId)->update([
       
            'aadhar_no'=>$aadhar_no,
            'aadhar_front_image'=>$aadhar_front_image,
            'aadhar_back_image'=>$aadhar_back_image,
            'pan_no'=>$pan_no,
            'pan_image'=>$pan_image,
            'account_holder_name'=>$account_holder_name,
            'account_no'=>$account_no,
            'ifsc_code'=>$ifsc_code,
            'passbook_image'=>$passbook_image,
            'branch_name'=>$branch_name,
            
        ]);


        if($kyc_upd){
        $data['msg']='Thank You ! Your KYC Update Successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
    }else{
        $data['msg']='Your KYC Not Update Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
    } 

   }
   
   public function change_profile_image(Request $Request){
     $userId=$Request->input('user_id');
        $user_role=$Request->input('user_role');
        
        $profile_image=$Request->file('profile_image');

    $profile_orignalName = time() . '.' . $profile_image->getClientOriginalName();
        $profile_image->move(public_path('images/profile') , $profile_orignalName);
        $profile_path= 'images/profile/'.$profile_orignalName;

        $profile_upd_image=DB::table('role_users')->where('role_id',$user_role)->where('user_ID',$userId)->update([
            'profile_image'=>$profile_path,
            
        ]);

           if($profile_upd_image){
        $data['msg']='Thank You ! Your Profile  Image Update Successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
    }else{
        $data['msg']='Your Profile Image Not Update Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
    } 
   }
}
