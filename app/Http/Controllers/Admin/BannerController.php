<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use DB;
use Request;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $bannerlist= DB::table('banner')->where('status', 1)->get();
        return view('admin.banner.view_banner',compact('bannerlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $BannerRequest)
    {
        $data=$BannerRequest->all();
        $msg = '';
        $success = '';
     
            $orignalFile=$BannerRequest->file('banner_image');
            $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
            $orignalFile->move(public_path('images/banner') , $orignalName);  
             $image_path= 'images/banner/'.$orignalName;
            $bannerArr = [
            'banner_image' => $image_path, 
             ];
          $bannerId = DB::table('banner')->insertGetId($bannerArr);
          if($bannerId){
            $success = true;
            $msg = "Thank you! Your Banner is now ready to use";

        }else{
            $success = false;
            $msg = "An error has occurred. Please try again later";

        }
         echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Request::input('id');
        if ($id)
        {

            $banner = DB::table('banner')
                ->where('id', $id)->first();
            echo json_encode($banner);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
         $data=Request::all();
         $Udate = date('Y-m-d H:i:s');
         $msg = '';
         $success = '';
         $banner_id=$data['banner_id'];
        if ($banner_id)
        {

            $orignalFile=Request::file('banner_image');
              $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
            $orignalFile->move(public_path('images/banner') , $orignalName);
            $image_path='images/banner/'.$orignalName;
            $result = DB::table('banner')->where('id', $banner_id)->update([
                'banner_image' => $image_path, 
                 'updated_at' => $Udate,
                  ]);  
        
            

            $success = true;
            $msg = "banner Updated Successfully";

        }
        else
        {

            $success = false;
            $msg = "An error has occurred. Please try again later";
        }

        echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = '';
        $success = '';
        $url = '';
        $bannerId = Request::input('id');
        if ($bannerId)
        {
            $slider_data = DB::table('banner')->where('id', $id)->first();
             $image_path = public_path().'/'.$slider_data->banner_image;
            unlink($image_path);
           $datas = DB::table('banner')->where('id', $bannerId)->update(['status' => 0]);
            //$datas->delete();
            $success = true;
            $msg = "banner Delete Successfully";
        }
        else
        {
            $success = false;
            $msg = "Somthing worng Please try again...";

        }
        echo json_encode(array(
            'valid' => $success,
            'message' => $msg,
        ));
    }
}
