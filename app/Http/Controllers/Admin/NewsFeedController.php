<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NewsFeedController extends Controller
{

	public function index(){
        
        $newslist=DB::table('tbl_newsfeed')
        ->where('status',1)
        ->get();
        return view('admin.newsfeed.view_newsfeedlist',compact('newslist'));

	}
     public function add_newsfeed(Request $Request){
         
      $email=auth()->user()->email;  
      $heading=$Request->input('heading');
      $type=$Request->input('type');
      $description=$Request->input('description');
   
    
      

      $postArr=[
              'email'=>$email,
              'heading'=>$heading,
              'type'=>$type,
              'description'=>$description,

      ];
    	$postId=DB::table('tbl_newsfeed')->insertGetId($postArr);

    	if ($postId)
            {
    
               
                  
            foreach($Request->file('newsfeed_image') as $orignalFile) {
                          
                        $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
                        $orignalFile->move(public_path('images/news') , $orignalName);
                          $image_path= 'images/news/'.$orignalName;
                        $orignalImageArr = [
                            'newsfeed_id' => $postId,
                             'newsfeed_image' => $image_path,
                         ];
                        
                     DB::table('tbl_newsfeed_image')->insertOrIgnore($orignalImageArr);
                 }

                $success = true;
                $msg = "Thank you! Your News Feed is now ready to use";

            }else{
                $success = false;
                $msg = "An error has occurred. Please try again later";

            }
            echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));

    }

    public function edit_newsfeed($id){
        if ($id)
        {
            $news_edit = DB::table('tbl_newsfeed')
            ->where('id', $id)->first();

            echo json_encode($news_edit);
        }
    }

       public function show_NewsFeedImage($id)
    {
        
        $news_image = DB::table('tbl_newsfeed_image')
        ->join('tbl_newsfeed', 'tbl_newsfeed_image.newsfeed_id', '=', 'tbl_newsfeed.id')
            ->select('tbl_newsfeed_image.*', 'tbl_newsfeed_image.id as id')
            ->where('tbl_newsfeed_image.newsfeed_id', $id)->get();
        return view('admin.newsfeed.news_image', compact('news_image'));
    }

    public function update(Request $Request)
    {
         
        $data=$Request->all();
        $newsfeed_id =  $data['newsfeed_id'];
        $Udate = date('Y-m-d H:i:s');
       
        if ($newsfeed_id)
        {
            $result = DB::table('tbl_newsfeed')
            ->where('id', $newsfeed_id)->update([
              'heading'=>$data['heading'],
              'type'=>$data['type'],
              'description'=>$data['description'],
              'updated_at' => $Udate,
                 ]);
           
            $success = true;
            $msg = "News Feed  Updated Successfully";

        }else{

            $success = false;
            $msg = "An error has occurred. Please try again later";
        }

        
        echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));
    }

       public function destroy(Request $Request,$id){

        $msg = '';
        $success = '';
        $url = '';
        $newsId = $Request->input('id');
        $image_id = $Request->input('image_id');
          if($image_id)
          {

             $news_image = DB::table('tbl_newsfeed_image')
             ->where('id', $image_id)->first();
            $image_data = DB::table('tbl_newsfeed_image')
            ->where('id', $image_id);
             $image_path = public_path().'/'.$news_image->newsfeed_image;
            unlink($image_path);
            $image_data->delete();
            if($image_data)
            {
            $success = true;
            $msg = "News Feed Image Delete Successfully";
        }else{
            $success = false;
            $msg = "Somthing worng Please try again...";

        }


          }else{
             if ($newsId)
        {
        $datas = DB::table('tbl_newsfeed')
        ->where('id', $newsId)->update(['status' => 0]);
            //$datas->delete();
            $success = true;
            $msg = "News Feed Delete Successfully";
        }
        else
        {
            $success = false;
            $msg = "Somthing worng Please try again...";

        }
      }
            
          
       
        echo json_encode(array(
            'valid' => $success,
            'message' => $msg,
        ));
    }
      public function newsimage_edit($id){
        if($id)
        {
            $news_feed_image=DB::table('tbl_newsfeed_image')->where('id',$id)->first();
             echo json_encode($news_feed_image);

        }
    }

    public function newsimage_update(Request $Request){
        $msg = '';
        $success = '';
        $newsimage_id=$Request->input('newsimage_id');
         $orignalFile=$Request->file('news_image');
          $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
        $orignalFile->move(public_path('images/news') , $orignalName);
        $image_path= 'images/news/'.$orignalName;
        $post_imageupd=DB::table('tbl_newsfeed_image')->where('id',$newsimage_id)->update([
         'newsfeed_image'=>$image_path,
        ]);
         if($post_imageupd)
         {
          $success = true;
            $msg = "News Feed Image Update Successfully";
        }
        else
        {
            $success = false;
            $msg = "Somthing worng Please try again...";

        }
            
          
       
        echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));

    }
}
