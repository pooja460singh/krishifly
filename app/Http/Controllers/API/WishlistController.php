<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB;

class WishlistController extends Controller
{
    public function add_wishlist(Request $Request){

      $post_id=$Request->input('post_id');
      $user_id=$Request->input('user_id');
      $status=$Request->input('wishlist_status');

      $wishlistArr=[

             'post_id'=>$post_id,
             'userId'=>$user_id,
             'wishlist_status'=>$status,
      ];
    $wishlistId=DB::table('tbl_wishlist')->insertGetId($wishlistArr);
    if($wishlistId){
      $data['msg']='Thank You ! Your Wishlist Add Successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
       }else{
        $data['msg']='Somthing wrong please try again...';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
      } 


    }

    public function get_wishlist(Request $Request){

      $user_id=$Request->input('user_id');
      $post_id=$Request->input('post_id');

      $wishlist_details=DB::table('tbl_post')
      ->leftJoin('tbl_post_image', 'tbl_post_image.id', '=', (DB::RAW('(
          SELECT id from  tbl_post_image where post_id=tbl_post.id ORDER BY tbl_post_image.id DESC LIMIT 1)')))
      ->join('tbl_wishlist','tbl_post.id','tbl_wishlist.post_id')
      ->join('role_users','role_users.user_ID','tbl_post.user_Id')
      ->join('tbl_post_rating','tbl_post.id','tbl_post_rating.post_id')
      ->join('tbl_payment','tbl_post.id','tbl_payment.post_id')
      ->select('tbl_post.*','tbl_post_image.post_image','role_users.name','role_users.user_ID','role_users.address','role_users.mandi_address','role_users.profile_image','role_users.contact','role_users.email','role_users.password','role_users.aadhar_no','role_users.pan_no','role_users.aadhar_front_image','role_users.aadhar_back_image','role_users.pan_image','role_users.trade_name','role_users.city','role_users.pincode','role_users.village','role_users.state','role_users.tahsil','role_users.district','role_users.account_no','role_users.account_holder_name','role_users.branch_name','role_users.passbook_image','role_users.ifsc_code','role_users.created_at','role_users.updated_at','tbl_post_rating.crop_description','tbl_post_rating.rating','tbl_post_rating.post_id','tbl_post_rating.agent_id','tbl_payment.plan_name','tbl_payment.payment_id','tbl_payment.userId','tbl_payment.recieverId','tbl_payment.amount','tbl_payment.no_of_month','tbl_payment.premium_member','tbl_payment.premium_status','tbl_wishlist.wishlist_status','tbl_wishlist.userId','role_users.role_id' )
      ->where('tbl_post.status',1)
      ->where('tbl_wishlist.post_id',$post_id)
    ->where('tbl_wishlist.userId',$user_id)
      ->paginate(10);
      $status='';
      if($wishlist_details == null)
      {
        $status=$wishlist_details[0]['status'];
      }else{
        foreach($wishlist_details as $key=>&$list)
        {
                
               $post_imagedata=DB::table('tbl_post_image')
                ->join('tbl_post','tbl_post.id','=','tbl_post_image.post_id')
                ->select('tbl_post_image.post_image','tbl_post_image.post_id')
                 ->where('tbl_post_image.post_id',$list->id)
                   ->where('tbl_post.status',1)->get();
                   foreach($post_imagedata as $key=>&$postdata)
                   {
                 $images=$postdata->post_image;
                 $postdata->post_image=stripslashes(url('public')).stripslashes('/').$images;
                   }
                $status=$list->status;
                $list->created_at=\Carbon\Carbon::parse($list->created_at)->format('Y-m-d\TH:i:s\Z');
                 $list->updated_at=\Carbon\Carbon::parse($list->updated_at)->format('Y-m-d\TH:i:s\Z');

                  $aadhar_front_image=$list->aadhar_front_image;
                 $list->aadhar_front_image=stripslashes(url('public')).stripslashes('/').$aadhar_front_image;

                 $aadhar_back_image=$list->aadhar_back_image;
                 $list->aadhar_back_image=stripslashes(url('public')).stripslashes('/').$aadhar_back_image;

                 $pan_image=$list->pan_image;
                 $list->pan_image=stripslashes(url('public')).stripslashes('/').$pan_image;

                 $profile_image=$list->profile_image;
                 $list->profile_image=stripslashes(url('public')).stripslashes('/').$profile_image;
                $status=$list->status;

$list->image=$post_imagedata;
$list->post_rating=['rating'=>$list->rating,'crop_description'=>$list->crop_description,'agent_id'=>$list->agent_id,'post_id'=>$list->post_id];

$list->wishlist=['wishlist_status'=>$list->wishlist_status,'user_id'=>$list->userId];

if($list->address == null || $list->account_no == null || $list->aadhar_no == null || $list->pan_no == null || $list->ifsc_code == null)
{
  $list->profile_verification_status=false;
  $list->verification_pending_list="Bank details is pending , Pan details is pending /address id pending like this  about every thing of user/address,Please check all profile data.";
}else{
  $list->profile_verification_status=true;
}

$list->premium=['payment_id'=>$list->payment_id,'premium_member'=>$list->premium_member,'premium_status'=>$list->premium_status,'plan_name'=>$list->plan_name,'amount'=>$list->amount,'month'=>$list->no_of_month,'user_id'=>$list->userId,'reciever_id'=>$list->recieverId];
    
  $list->user =["user_ID"=>$list->user_ID,"user_role"=>$list->role_id,"name"=>$list->name,"address"=>$list->address,"mandi_address"=>$list->mandi_address,"profile_image"=>$list->profile_image,"email"=>$list->email,"password"=>$list->password,
        "contact" =>$list->contact,
        "created_at" =>$list->created_at,
        "updated_at"=>$list->updated_at,
        "status"=>$list->status,
        "mandi_address"=>$list->status,
        "aadhar_no"=>$list->aadhar_no,
        "aadhar_front_image"=>$list->aadhar_front_image,
        "aadhar_back_image"=>$list->aadhar_back_image,
        "pan_no"=>$list->pan_no,
        "pan_image"=>$list->pan_image,
        "trade_name"=>$list->trade_name,
        "city"=>$list->city,
        "pincode"=>$list->pincode,
         "state"=>$list->state,
        "district"=>$list->district,
        "tahsil"=>$list->tahsil,
        "village"=>$list->village,
        "passbook_image"=>$list->passbook_image,
        "branch_name"=>$list->branch_name,
        "account_holder_name"=>$list->account_holder_name,
        "account_no"=>$list->account_no,
        "ifsc_code"=>$list->ifsc_code];
         unset($list->wishlist_status);
         unset($list->userId);
         unset($list->role_id);
        unset($list->recieverId);
         unset($list->no_of_month);
        unset($list->payment_id);
        unset($list->plan_name);
        unset($list->amount);
        unset($list->premium_status);
        unset($list->premium_member);
         unset($list->rating_id);
        unset($list->ids);
         unset($list->rating);
        unset($list->crop_description);
        unset($list->agent_id);
        unset($list->post_id);
        unset($list->user_ID);
        unset($list->address);
        unset($list->mandi_address);
        unset($list->name);
        unset($list->profile_image);
        unset($list->post_image);
         unset($list->otp);
        unset($list->city);
        unset($list->pincode);
        unset($list->pan_no);
        unset($list->trade_name);
        unset($list->pan_image);
          unset($list->aadhar_front_image);
        unset($list->aadhar_back_image);
        unset($list->account_holder_name);
        unset($list->account_no);
        unset($list->ifsc_code);
          unset($list->email);
        unset($list->password);
        unset($list->aadhar_no);
         unset($list->contact);
            unset($list->state);
        unset($list->district);
          unset($list->tahsil);
        unset($list->village);
        unset($list->passbook_image);
         unset($list->branch_name);
             $status;
           } 
         }

       if($status != null){
            $data['msg']='All Get Record Successfuly.';
            $data['status']=true;
            $data['results']=$wishlist_details;
            $myJSON = json_encode($data);
            echo $myJSON;

        }else{
            $data['msg']='Record Not Found .';
            $data['status']=false;
            $myJSON = json_encode($data);
            echo $myJSON;

        }

    }

}
