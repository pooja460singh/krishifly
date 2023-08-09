<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB;

class PostController extends Controller
{

  public function product_genrate($number, $targetLength)
{
    $output = $number . '';
    while (strlen($output) < ($targetLength-2)) {
        $output = '0' . $output;
    }
    $output='PRD'.$output;
    return $output;
}

    public function add_post(Request $Request){

        $last_inserted=DB::table('tbl_post')->where('status',1)->latest()->first();
          if($last_inserted == null){
            $last_inserted_id=+1;
            $productId=$this->product_genrate($last_inserted_id,4);
          }else{
             $last_inserted_id=$last_inserted->id +1;
             $productId=$this->product_genrate($last_inserted_id,4);
          }

      $user_type='seller';
      $user_Id=$Request->input('user_Id');
      $crop_name=$Request->input('crop_name');
      $type=$Request->input('type');
      $description=$Request->input('description');
      $price=$Request->input('price');
      $location=$Request->input('crop_location');
      $quantity=$Request->input('quantity');
      $unit=$Request->input('unit');
      $crop_state=$Request->input('crop_state');
      $crop_village=$Request->input('crop_village');
      $tahsil=$Request->input('crop_tahsil');
      $district=$Request->input('crop_district');
      $pincode=$Request->input('crop_pincode');
      $post_image=$Request->file('post_image');
      
      

      $postArr=[
              'user_type'=>$user_type,
              'user_Id'=>$user_Id,
              'product_Id'=>$productId,
              'crop_name'=>$crop_name,
              'type'=>$type,
              'description'=>$description,
              'price'=>$price,
              'crop_location'=>$location,
              'quantity'=>$quantity,
              'unit'=>$unit,
              'crop_state'=>$crop_state,
              'crop_village'=>$crop_village,
              'crop_tahsil'=>$tahsil,
              'crop_district'=>$district,
              'crop_pincode'=>$pincode,

      ];
      
      $postId=DB::table('tbl_post')->insertGetId($postArr);

      if ($postId)
            {
                $ratingArr=[
                    'post_id'=>$postId,
                    
                    ];
                    $ratingId=DB::table('tbl_post_rating')->insertGetId($ratingArr);
                    $paymentArr=[
                    'post_id'=>$postId,
                    
                    ];
                    $paymentId=DB::table('tbl_payment')->insertGetId($paymentArr);
               
    
               
                 foreach($post_image as $orignalFile) {
                    
                          
            $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
            $orignalFile->move(public_path('images/post') , $orignalName);
            $image_path= 'images/post/'.$orignalName;
                        $orignalImageArr = [
                            'post_id' => $postId,
                             'post_image' => $image_path,
                         ];
                        
                     DB::table('tbl_post_image')->insertOrIgnore($orignalImageArr);
                 }
             
         
           
        $data['msg']='Thank You ! Your Post Create Successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
       }else{
        $data['msg']='Your Post Not Create  Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
      } 
                
    }

    public function post_list(Request $Request){

      $postlist=DB::table('tbl_post')
      ->leftJoin('tbl_post_image', 'tbl_post_image.id', '=', (DB::RAW('(
      SELECT id from  tbl_post_image where post_id=tbl_post.id ORDER BY tbl_post_image.id DESC LIMIT 1)')))
      ->join('role_users','role_users.user_ID','tbl_post.user_Id')
      ->join('tbl_post_rating','tbl_post.id','tbl_post_rating.post_id')
      ->join('tbl_payment','tbl_post.id','tbl_payment.post_id')
      ->select('tbl_post.*','tbl_post_image.post_image','role_users.name','role_users.user_ID','role_users.address','role_users.mandi_address','role_users.profile_image','role_users.contact','role_users.email','role_users.password','role_users.aadhar_no','role_users.pan_no','role_users.aadhar_front_image','role_users.aadhar_back_image','role_users.pan_image','role_users.trade_name','role_users.city','role_users.pincode','role_users.village','role_users.state','role_users.tahsil','role_users.district','role_users.account_no','role_users.account_holder_name','role_users.branch_name','role_users.passbook_image','role_users.ifsc_code','role_users.created_at','role_users.updated_at','tbl_post_rating.crop_description','tbl_post_rating.rating','tbl_post_rating.post_id','tbl_post_rating.agent_id','tbl_payment.plan_name','tbl_payment.payment_id','tbl_payment.userId','tbl_payment.recieverId','tbl_payment.amount','tbl_payment.no_of_month','tbl_payment.premium_member','tbl_payment.premium_status','role_users.role_id' )
      ->where('tbl_post.status',1)->orderBy('tbl_post.id', 'DESC')->paginate(10);
      $status='';

      if($postlist == null){

            $status=$postlist[0]['status'];
           }else{
             foreach($postlist as $key=>&$list)
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
        unset($list->role_id);
         unset($list->userId);
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
             }   
             $status;
           } 
 if($status != null){
      $post_data['msg']='Record Get Successfuly.';
      $post_data['status']=true;            
      $post_data['results']=$postlist;
      $myJSON = json_encode($post_data);
              echo $myJSON;

   }else{
        $value['msg']='Record Not Found.';
        $value['status']=false;
        $myJSON = json_encode($value);
        echo $myJSON;
    } 


    }

    public function update_rating(Request $Request){

      $post_id=$Request->input('post_id');
      $agent_id=$Request->input('agent_id');
      $rating=$Request->input('rating');
      $crop_description=$Request->input('crop_description');

     $upd_rating=DB::table('tbl_post_rating')->where('post_id',$post_id)->update([
        'post_id'=>$post_id,
         'agent_id'=>$agent_id,
         'rating'=>$rating,
        'crop_description'=>$crop_description,
      ]);
       

         if($upd_rating){
        $data['msg']='Thank You given for rating.';
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

    public function search_post(Request $Request){

      $crop_name=$Request->input('crop_name');

      $search_list=DB::table('tbl_post')
        ->leftJoin('tbl_post_image', 'tbl_post_image.id', '=', (DB::RAW('(
      SELECT id from  tbl_post_image where post_id=tbl_post.id ORDER BY tbl_post_image.id DESC LIMIT 1)')))
      ->join('role_users','role_users.user_ID','tbl_post.user_Id')
      ->join('tbl_post_rating','tbl_post.id','tbl_post_rating.post_id')
      ->join('tbl_payment','tbl_post.id','tbl_payment.post_id')
      ->select('tbl_post.*','tbl_post_image.post_image','role_users.name','role_users.user_ID','role_users.address','role_users.mandi_address','role_users.profile_image','role_users.contact','role_users.email','role_users.password','role_users.aadhar_no','role_users.pan_no','role_users.aadhar_front_image','role_users.aadhar_back_image','role_users.pan_image','role_users.trade_name','role_users.city','role_users.pincode','role_users.village','role_users.state','role_users.tahsil','role_users.district','role_users.account_no','role_users.account_holder_name','role_users.branch_name','role_users.passbook_image','role_users.ifsc_code','role_users.created_at','role_users.updated_at','tbl_post_rating.crop_description','tbl_post_rating.rating','tbl_post_rating.post_id','tbl_post_rating.agent_id','tbl_payment.plan_name','tbl_payment.payment_id','tbl_payment.userId','tbl_payment.recieverId','tbl_payment.amount','tbl_payment.no_of_month','tbl_payment.premium_member','tbl_payment.premium_status','role_users.role_id' )
      ->where('tbl_post.status',1)
    ->where('tbl_post.crop_name', 'LIKE', '%'.$crop_name.'%')
      ->paginate(10);
      $status='';
      if($search_list == null)
      {
        $status=$search_list[0]['status'];
      }else{
        foreach($search_list as $key=>&$list)
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
                }
                $status;
      }

      if($status != null){
          $res['message']='Record Get Successfully.';
          $res['status']=true;
          $res['results']=$search_list;
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
