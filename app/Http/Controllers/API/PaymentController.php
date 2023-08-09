<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{

    public function paymentId($number, $targetLength)
        {
            $output = $number . '';
            while (strlen($output) < ($targetLength-2)) {
                $output = '0' . $output;
            }
            $output='NP00'.$output;
            return $output;
        }
    public function add_Payment(Request $Request){


        $last_inserted=DB::table('tbl_payment')->where('premium_status',1)->latest()->first();
          if($last_inserted == null){
            $last_inserted_id=+1;
          }else{
             $last_inserted_id=$last_inserted->id +1;
          }
          $payment_no=$this->paymentId($last_inserted_id,4);
        $premium_member=$Request->input('premium_member');
    	$premium_status=$Request->input('premium_status');
        $userid=$Request->input('userid');
    	$recieverId=$Request->input('recieverId');
    	$post_id=$Request->input('post_id');
    	$contact=$Request->input('contact');
    	$amount=$Request->input('amount');
    	$plan_name=$Request->input('plan_name');
    	$month=$Request->input('no_of_month');

        $payment=DB::table('tbl_payment')->where('post_id',$post_id)->first(['post_id']);
        $postId=$payment->post_id;
        if($post_id == $postId){
           $paymentArr=DB::table('tbl_payment')->where('post_id',$post_id)->update([
            'payment_id'=>$payment_no,
             'userId'=>$userid,
             'recieverId'=>$recieverId,
             'post_id'=>$post_id,
             'contact'=>$contact,
             'amount'=>$amount,
             'plan_name'=>$plan_name,
             'no_of_month'=>$month,
             'premium_status'=>$premium_status,
             'premium_member'=>$premium_member,

         ]);
 
        }else{
             $paymentId=[
            'payment_id'=>$payment_no,
             'userId'=>$userid,
             'recieverId'=>$recieverId,
             'post_id'=>$post_id,
             'contact'=>$contact,
             'amount'=>$amount,
             'plan_name'=>$plan_name,
             'no_of_month'=>$month,
             'premium_status'=>$premium_status,
             'premium_member'=>$premium_member,

         ];

         $paymentArr=DB::table('tbl_payment')->insertGetId($paymentId
         );

        }
    	
    	

    	if(!empty($paymentArr)){
    	$data['msg']='Thank You for purchase plan, Your payment send  successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
       }else{
        $data['msg']='Somthing wrong please try again.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
      } 
    }
}
