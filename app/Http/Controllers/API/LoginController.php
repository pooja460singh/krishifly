<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;

class LoginController extends Controller
{
    public static function otp($length = 6)
  {
      $pool = '1234567890';

      $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
      return $refer_code;
  }
    public function otp_generator(Request $Request){

      $phone_number=$Request->input('phone_number');
      $username=$Request->input('username');
      $userId=strtoupper($username[0].$username[1]).$phone_number[6].$phone_number[7].$phone_number[8].$phone_number[9];
      $user_role=$Request->input('user_role');
      $otp=$this->otp();
      if($user_role == 'kisan'){

        $roleArr=[
             'user_ID'=>$userId,
             'role_id'=>$user_role,
             'contact'=>$phone_number,
             'otp'=>$otp,
             'name'=>$username,
        ];
        $roleId=DB::table('role_users')->insertGetId($roleArr);

        $userArr=[
            'username'=>$username,
            'user_id'=>$userId,
            'contact'=>$phone_number,
        ];
        $usersId=DB::table('tbl_kisan')->insertGetId($userArr);
      }elseif($user_role == 'transporter'){
        $roleArr=[
             'user_ID'=>$userId,
             'role_id'=>$user_role,
             'contact'=>$phone_number,
             'otp'=>$otp,
             'name'=>$username,
        ];
        $roleId=DB::table('role_users')->insertGetId($roleArr);

        $userArr=[
            'username'=>$username,
            'user_id'=>$userId,
            'contact'=>$phone_number,
        ];
        $usersId=DB::table('tbl_transporters')->insertGetId($userArr);

      }elseif($user_role == 'agent'){
        $roleArr=[
             'user_ID'=>$userId,
             'role_id'=>$user_role,
             'contact'=>$phone_number,
             'otp'=>$otp,
             'name'=>$username,
        ];
        $roleId=DB::table('role_users')->insertGetId($roleArr);

        $userArr=[
            'username'=>$username,
            'user_id'=>$userId,
            'contact'=>$phone_number,
        ];
        $usersId=DB::table('tbl_agent')->insertGetId($userArr);
      }
      if($usersId){
        $data['msg']='Otp Generate Successfuly.';
        $data['status']=true;
        $data['otp']=$otp;
        $data['user_id']=$userId;
        $data['phone_number']=$phone_number;
        $myJSON = json_encode($data);
        echo $myJSON;
      }else{
        $data['msg']='Otp Not Generate Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
       }

    }

    public function verify_otp(Request $Request){

      $otp=$Request->input('otp');
      $contact=$Request->input('phone_number');
      $userID=$Request->input('user_id');

      $user_data=DB::table('role_users')->where('user_ID',$userID)->where('contact',$contact)->where('otp',$otp)->first('otp');
      $userotp=123456;
      if($user_data == null){
        $user_otp='';
      }else{
        $user_otp=$user_data->otp;
      }

      if($otp == $userotp){
        $User=DB::table('role_users')->where('user_ID',$userID)->first();
         
      $data=array(
          'msg'=>'Otp Verify Successfuly.',
            'status'=>true,
            'user'=>$User,
        );
    $myJSON = json_encode($data);
        echo $myJSON;
        
      }else{
        $data['msg']='Otp Not Verify Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
       }
    }
}
