<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB;

class CommentController extends Controller
{
    public function add_newsfeedcomment(Request $Request){
     
     $news_feed_id=$Request->input('news_feed_id');
      $user_id=$Request->input('user_id');
      $comment=$Request->input('comment');

      $commentArr=[

             'news_feed_id'=>$news_feed_id,
             'userId'=>$user_id,
             'comment'=>$comment,
      ];
    $commentId=DB::table('tbl_comments')->insertGetId($commentArr);
    if($commentId){
        $data['msg']='Thank You ! for giving comment.';
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

    public function get_commentlist(Request $Request){

    	 $commentlist=DB::table('tbl_comments')
    	  ->select('tbl_comments.*')
         ->where('tbl_comments.status',1)
         ->orderBy('tbl_comments.id', 'DESC')
         ->paginate(10);
          $status='';

      if($commentlist == null){

            $status=$commentlist[0]['status'];
           }else{
             foreach($commentlist as $key=>&$list)
                {
                	 $list->created_at=\Carbon\Carbon::parse($list->created_at)->format('Y-m-d\TH:i:s\Z');
                 $list->updated_at=\Carbon\Carbon::parse($list->updated_at)->format('Y-m-d\TH:i:s\Z');

                 $userlist=DB::table('role_users')
    	  ->select('role_users.user_ID','role_users.name','role_users.address','role_users.mandi_address','role_users.profile_image','role_users.contact','role_users.email')
         ->where('user_ID',$list->userId)
         ->first();

                 $profile_image=$userlist->profile_image;
                 $userlist->profile_image=stripslashes(url('public')).stripslashes('/').$profile_image;
                $status=$list->status;
                $list->user =["user_id"=>$userlist->user_ID,"name"=>$userlist->name,"address"=>$userlist->address,"mandi_address"=>$userlist->mandi_address,"profile_image"=>$userlist->profile_image,"email"=>$userlist->email,"contact" =>$userlist->contact];

                 unset($list->userId);
             }   
             $status;
           } 
 if($status != null){
      $post_data['msg']='Record Get Successfuly.';
      $post_data['status']=true;            
      $post_data['results']=$commentlist;
      $myJSON = json_encode($post_data);
              echo $myJSON;

   }else{
        $value['msg']='Record Not Found.';
        $value['status']=false;
        $myJSON = json_encode($value);
        echo $myJSON;
    } 
    }

}
