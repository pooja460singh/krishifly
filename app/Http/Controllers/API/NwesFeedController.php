<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB;

class NwesFeedController extends Controller
{
    public function add_newsfeedlike(Request $Request){
     
     $news_feed_id=$Request->input('news_feed_id');
      $user_id=$Request->input('user_id');
      $like_status=$Request->input('like_status');

      $likeArr=[

             'news_feed_id'=>$news_feed_id,
             'userId'=>$user_id,
             'like_status'=>$like_status,
      ];
    $likeId=DB::table('tbl_newsfeed_like')->insertGetId($likeArr);
    if($likeId){
        $data['msg']='Thank You ! for giving like.';
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

     
    public function get_newsfeedlist(Request $Request){
         
         $newsfeedlist=DB::table('tbl_newsfeed')
         ->where('status',1)->orderBy('id', 'DESC')->paginate(10);
          $status='';

      if($newsfeedlist == null){

            $status=$newsfeedlist[0]['status'];
           }else{
             foreach($newsfeedlist as $key=>&$list)
                {
               $news_imagedata=DB::table('tbl_newsfeed_image')
        ->join('tbl_newsfeed', 'tbl_newsfeed_image.newsfeed_id', '=', 'tbl_newsfeed.id')
            ->select('tbl_newsfeed_image.*', 'tbl_newsfeed_image.id as id')
            ->where('tbl_newsfeed_image.newsfeed_id', $list->id)->get();
                foreach($news_imagedata as $key=>&$newsdata)
                   {
                 $images=$newsdata->newsfeed_image;
                 $newsdata->newsfeed_image=stripslashes(url('public')).stripslashes('/').$images;
                   }

                   $news_likedata=DB::table('tbl_newsfeed_like')
        ->join('tbl_newsfeed', 'tbl_newsfeed_like.news_feed_id', '=', 'tbl_newsfeed.id')
            ->select('tbl_newsfeed_like.like_status') 
            ->where('tbl_newsfeed_like.news_feed_id', $list->id)->first();
            $news_count=DB::table('tbl_newsfeed_like')
        ->join('tbl_newsfeed', 'tbl_newsfeed_like.news_feed_id', '=', 'tbl_newsfeed.id')
            ->where('tbl_newsfeed_like.news_feed_id', $list->id)->count();
             $comment_count=DB::table('tbl_comments')
        ->join('tbl_newsfeed', 'tbl_comments.news_feed_id', '=', 'tbl_newsfeed.id')
         ->where('tbl_comments.news_feed_id', $list->id)->count();
                   
                 $list->created_at=\Carbon\Carbon::parse($list->created_at)->format('Y-m-d\TH:i:s\Z');
                 $list->updated_at=\Carbon\Carbon::parse($list->updated_at)->format('Y-m-d\TH:i:s\Z');

                 $status=$list->status;


             $list->is_liked=[$news_likedata->like_status];
             $list->stats=['like'=>$news_count,'comment'=>$comment_count];
             $list->image=$news_imagedata;
             }
         $status;
           } 
      if($status != null){
      $news_data['msg']='Record Get Successfuly.';
      $news_data['status']=true;            
      $news_data['results']=$newsfeedlist;
      $myJSON = json_encode($news_data);
              echo $myJSON;

   }else{
        $value['msg']='Record Not Found.';
        $value['status']=false;
        $myJSON = json_encode($value);
        echo $myJSON;
    } 
    }
}
