<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function add_ProductDetail(Request $Request){
    	$product_id=$Request->input('product_id');
            $post_id=$Request->input('post_id');

     $productArr=[
    	    'product_id'=>$product_id,
            'post_id'=>$post_id,
            'seller_name'=>$Request->input('seller_name'),
            'user_type'=>$Request->input('user_type'),
            'seller_pan_no'=>$Request->input('seller_pan_no'),
            'seller_aadhar_no'=>$Request->input('seller_aadhar_no'),
            'agent_name'=>$Request->input('agent_name'),
            'agent_pan_no'=>$Request->input('agent_pan_no'),
            'agent_aadhar_no'=>$Request->input('agent_aadhar_no'),
            'buyer_name'=>$Request->input('buyer_name'),
            'buyer_pan_no'=>$Request->input('buyer_pan_no'),
            'buyer_aadhar_no'=>$Request->input('buyer_aadhar_no'),
            'transporter_name'=>$Request->input('transporter_name'),
            'vehicle_no'=>$Request->input('vehicle_no'),
            'transpoter_pan_no'=>$Request->input('transpoter_pan_no'),
            'transporter_aadhar_no'=>$Request->input('transporter_aadhar_no'),
            'driving_license_no'=>$Request->input('driving_license_no'),
            'product_name'=>$Request->input('product_name'),
            'from_where'=>$Request->input('from_where'),
           'to'=>$Request->input('to'),
            'crop_quantity'=>$Request->input('crop_quantity'),
            'crop_insurance'=>$Request->input('crop_insurance'),
            'crop_insurance_no'=>$Request->input('crop_insurance_no'),
            'product_date'=>$Request->input('product_date'),
            'product_time'=>$Request->input('product_time'),
            'terms_and_condition'=>$Request->input('terms_and_condition'),
            
        ];
        $productId=DB::table('tbl_product_details')->insertGetId($productArr);
        if($productId != null){
         $data['msg']='Thank You ! Your Product Detail Create Successfuly.';
        
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
