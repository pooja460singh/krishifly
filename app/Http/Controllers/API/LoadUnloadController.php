<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LoadUnloadController extends Controller
{
    public function add_load_unload(Request $Request){

    	$user_type=$Request->input('user_type');
    	$user_id=$Request->input('user_id');
    	$buyer_name=$Request->input('buyer_name');
    	$seller_name=$Request->input('seller_name');
    	$load_unload_image=$Request->file('load_unload_image');
    	$description=$Request->input('description');
    	$post_id=$Request->input('post_id');

         $profile_orignalName = time() . '.' . $load_unload_image->getClientOriginalName();
        $load_unload_image->move(public_path('images/loadunload') , $profile_orignalName);
        $profile_path= 'images/loadunload/'.$profile_orignalName;

    	if($user_type == 'agent'){

    		$loadArr=[
             'user_type'=>$user_type,
             'user_id'=>$user_id,
             'buyer_name'=>$buyer_name,
             'seller_name'=>$seller_name,
             'load_unload_image'=>$profile_path,
             'description'=>$description,
             'post_id'=>$post_id,
    		];

    		$loadId=DB::table('tbl_load_unload')->insertGetId($loadArr);
    	}else{

    		$loadArr=[
             'user_type'=>$user_type,
             'user_id'=>$user_id,
             'buyer_name'=>$buyer_name,
             'seller_name'=>$seller_name,
             'load_unload_image'=>$profile_path,
             'description'=>$description,
             'post_id'=>$post_id,
    		];

    		$loadId=DB::table('tbl_load_unload')->insertGetId($loadArr);
    	}
    if($loadId){
         $data['msg']='Thank You ! Your Data Successfuly.';
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
