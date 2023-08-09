<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PlanController extends Controller
{
    public function plan_list(Request $Request){
        $user_type=$Request->input('user_type');
            if($user_type == 'seller')
            {
              $plan=DB::table('tbl_plan')->select('tbl_plan.plan')->where('user_type','seller')->where('status',1)->get();
            $planduration=DB::table('tbl_plan_duration')
            
       ->join('tbl_plan', 'tbl_plan_duration.plan_id','=','tbl_plan.id')
       ->select('tbl_plan.plan','tbl_plan_duration.*')
       ->where('tbl_plan_duration.user_type','seller')
       ->where('tbl_plan_duration.status',1)->get();
   }else{
    $plan=DB::table('tbl_plan')->select('tbl_plan.plan')->where('user_type','buyer')->where('status',1)->get();
       $planduration=DB::table('tbl_plan_duration')    
       ->join('tbl_plan', 'tbl_plan_duration.plan_id','=','tbl_plan.id')
       ->select('tbl_plan.plan','tbl_plan_duration.*')
       ->where('tbl_plan_duration.user_type','buyer')
       ->where('tbl_plan_duration.status',1)->get();
   }

      if($planduration != null){
                $res['message']='Record Get Successfully.';
          $res['status']=true;
          $res['tabs']=$plan;
          $res['data']=$planduration;
          $myJSON = json_encode($res);
          echo $myJSON;
      }else
         {
          $res['message']='Record Not Found.';
          $res['status']=false;
          $myJSON = json_encode($res);
          echo $myJSON;
        
         }   
    }
}
