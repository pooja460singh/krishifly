<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BannerController extends Controller
{
    public function banner(Request $request){
             $banner=DB::table('banner')->where('status','=', 1)->get();
           $status='';
           if($banner == null){

            $status=$banner[0]['status'];
           }else{
             foreach($banner as $key=>&$banners)
                {
                $images=$banners->banner_image;
                 $banners->banner_image=stripslashes(url('public')).stripslashes('/').$images;
                  $banners->created_at=\Carbon\Carbon::parse($banners->created_at)->format('Y-m-d\TH:i:s\Z');
                 $banners->updated_at=\Carbon\Carbon::parse($banners->updated_at)->format('Y-m-d\TH:i:s\Z');
                $status=$banners->status;
                } 
             $status;
           } 
             
            if($status != null){
            $data['msg']='All Get Record Successfuly.';
            $data['status']=true;
            $data['banner']=$banner;
            $myJSON = json_encode($data);
            echo $myJSON;

        }else{
            $data['msg']='Record Not Found .';
            $data['status']=false;
            $myJSON = json_encode($data);
            echo $myJSON;

        }
    }}
