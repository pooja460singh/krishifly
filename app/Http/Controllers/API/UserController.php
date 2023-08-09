<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
   public function get_user(Request $Request){

    $user_id=$Request->input('user_id');

    $userlist=DB::table('role_users')->where('user_ID',$user_id)->where('status',1)->get();
    $status='';
           if($userlist == null){

            $status=$userlist[0]['status'];
           }else{
             foreach($userlist as $key=>&$list)
                {
                $aadhar_front_image=$list->aadhar_front_image;
                 $list->aadhar_front_image=stripslashes('public').stripslashes('/').$aadhar_front_image;
                 $aadhar_back_image=$list->aadhar_back_image;
                 $list->aadhar_back_image=stripslashes('public').stripslashes('/').$aadhar_back_image;

                  $pan_image=$list->pan_image;
                 $list->pan_image=stripslashes('public').stripslashes('/').$pan_image;
                  $profile_image=$list->profile_image;
                 $list->profile_image=stripslashes('public').stripslashes('/').$profile_image;
                $status=$list->status;
                } 
             $status;
           } 
      if($status != null){
        $data['msg']='Record Get Successfuly.';
        $data['status']=true;
        $data['user']=$userlist;
        $myJSON = json_encode($data);
        echo $myJSON;
    }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
    } 

   }
}
