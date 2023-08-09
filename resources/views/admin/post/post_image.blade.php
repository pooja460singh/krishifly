@extends('admin.layouts.master')
@section('content')
<div class="page-wrapper" style="min-height: 349px;">
<div class="container-fluid">
   <!-- Title -->
   <div class="row heading-bg">
      <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
         <h5 class="txt-dark">post image</h5>
      </div>
      <!-- Breadcrumb -->
      <div class="col-lg-2 col-sm-4 col-md-4 col-xs-12">
         <a href="{{url('post')}}" class="btn btn-primary">
         <i class="fa fa-arrow-left"></i>Back
         </a>
         <!-- /Breadcrumb -->
      </div>
   </div>
   <br>
   <!-- /Title -->
   <!-- Product Row One -->
   <div class="row">
       
      @foreach($post_image as $image)
      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
         <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
               <div class="panel-body pa-0">
                  <article class="col-item">
                     <div class="photo">
                        <div class="options">
                           <a href="javascript:void(0);" class="font-18 txt-grey mr-10 pull-left postimage_edit" data-id="{{$image->id}}"><i class="zmdi zmdi-edit"></i></a>
                           <a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning postimage_delete" data-id="{{$image->id}}"><i class="zmdi zmdi-close"></i></a>
                        </div>
                        <a href="javascript:void(0);"> <img src="{{url('public/'.$image->post_image)}}" class="img-responsive" alt="Product Image"> </a>
                     </div>
                     <div class="info">
                        <h6>{{$image->crop_name}}</h6>
                        <input type="hidden" name="image_id" data-id="{{$image->id}}" class="image_id" value="{{$image->id}}" id="image_id">
                        <!--<div class="product-rating inline-block">
                           <a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star-outline mr-0"></a>
                           </div>-->
                        <span class="head-font block text-warning font-16"><i class="fa fa-rupee" style="color:black;"></i>&nbsp;{{$image->price}}</span>
                     </div>
                  </article>
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
   <!-- /Product Row Four -->
</div>

         <!-- Modal -->
<div id="PostImage" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Post Image</h4>
         </div>
         <div class="modal-body">
            <form method="post" id="postimage_form"  enctype="multipart/form-data">
               {{ csrf_field() }} 
               <img src="" id="imageslider" class="img-responsive" style="width:100%;height:25%">
                <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Image</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                            <input type="file" class="form-control"  name="post_image" >
                        </div>
                         <div class="alert " id="post_image"></div>
                     </div>
            
              
               <input type="hidden"  id="postimage_id" name="postimage_id">
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-success mr-10" name="SendProductImage" id="SendProductImage">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script src="{{url('public/dist/post.js') }}"></script>
@endpush