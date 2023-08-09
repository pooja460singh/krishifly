<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use DB;
use Request;

class PostController extends Controller
{
    public function index(){
       
       $post=DB::table('tbl_post')->where('status',1)->get();
    	return view('admin.post.post_list',compact('post'));
    }

     public function product_genrate($number, $targetLength)
{
    $output = $number . '';
    while (strlen($output) < ($targetLength-2)) {
        $output = '0' . $output;
    }
    $output='PRD'.$output;
    return $output;
}

    public function add_Post(PostRequest $Request){
         
         $msg = '';
         $success = '';
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
             

                $success = true;
                $msg = "Thank you! Your Post is now ready to use";

            }else{
                $success = false;
                $msg = "An error has occurred. Please try again later";

            }
            echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));
    }

     public function show_PostImage($id)
    {
        
        $post_image = DB::table('tbl_post_image')->join('tbl_post', 'tbl_post_image.post_id', '=', 'tbl_post.id')
            ->select('tbl_post_image.*', 'tbl_post_image.id as id', 'tbl_post.crop_name', 'tbl_post.price')
            ->where('tbl_post_image.post_id', $id)->get();
        return view('admin.post.post_image', compact('post_image'));
    }


        public function edit_Post($id){

          $id = Request::input('id');

        if ($id)
        {
            $post_edit = DB::table('tbl_post')
            ->where('id', $id)->first();

            echo json_encode($post_edit);
        }
      }

    public function update_Post(PostRequest $Request)
    {
         
        $data=Request::all();
        $post_id =  $data['post_id'];
        $Udate = date('Y-m-d H:i:s');
       
        if ($post_id)
        {
            $result = DB::table('tbl_post')->where('id', $post_id)->update([
              'crop_name'=>$data['crop_name'],
              'type'=>$data['type'],
              'description'=>$data['description'],
              'price'=>$data['price'],
              'crop_location'=>$data['location'],
              'quantity'=>$data['quantity'],
              'unit'=>$data['unit'],
              'crop_state'=>$data['crop_state'],
              'crop_village'=>$data['crop_village'],
              'crop_tahsil'=>$data['tahsil'],
              'crop_district'=>$data['district'],
              'crop_pincode'=>$data['pincode'],

              'updated_at' => $Udate,
                 ]);
           
            $success = true;
            $msg = "Post  Updated Successfully";

        }else{

            $success = false;
            $msg = "An error has occurred. Please try again later";
        }

        
        echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));
    }

    public function destroy($id){

        $msg = '';
        $success = '';
        $url = '';
        $postId = Request::input('id');
        $image_id = Request::input('image_id');
          if($image_id)
          {

             $post_image = DB::table('tbl_post_image')->where('id', $image_id)->first();
            $image_data = DB::table('tbl_post_image')->where('id', $image_id);
             $image_path = public_path().'/'.$post_image->post_image;
            unlink($image_path);
            $image_data->delete();
            if($image_data)
            {
            $success = true;
            $msg = "Post Image Delete Successfully";
        }else
        {
            $success = false;
            $msg = "Somthing worng Please try again...";

        }


          }else{
             if ($postId)
        {
        $datas = DB::table('tbl_post')->where('id', $postId)->update(['status' => 0]);
            //$datas->delete();
            $success = true;
            $msg = "Post Delete Successfully";
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

    public function postimage_edit($id){
        if($id)
        {
            $post_image=DB::table('tbl_post_image')->where('id',$id)->first();
             echo json_encode($post_image);

        }
    }

    public function postimage_update(){
        $msg = '';
        $success = '';
        $postimage_id=Request::input('postimage_id');
         $orignalFile=Request::file('post_image');
          $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
        $orignalFile->move(public_path('images/post') , $orignalName);
        $image_path= 'images/post/'.$orignalName;
        $post_imageupd=DB::table('tbl_post_image')->where('id',$postimage_id)->update([
         'post_image'=>$image_path,
        ]);
         if($post_imageupd)
         {
          $success = true;
            $msg = "Post Image Update Successfully";
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
