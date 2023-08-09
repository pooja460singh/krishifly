@extends('admin.layouts.master')
@section('content')
<style type="text/css">
   .view
   {
   background: green;
   width: 30px;
   height: 30px;
   color: #fff;
   }
   .view:hover
   {
   color:#fff;
   }
   .edit
   {
   background: #f39c12 !important;
   width: 30px;
   height: 30px;
   color: #fff;
   }
   .edit:hover
   {
   color:#fff;
   }
   .delete
   {
   background: #dd4b39 !important;
   width: 30px;
   height: 30px;
   color: #fff;
   }
   .delete:hover
   {
   color:#fff;
   }
</style>
<div class="page-wrapper" style="min-height: 414px;">
<div class="container-fluid">
<!-- Title -->
<div class="row heading-bg">
   <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12">
      <h5 class="txt-dark">Post List</h5>
   </div>
   <!-- Breadcrumb -->
   <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#PostModal">
      <i class="fa fa-plus"></i> Add Post
      </a>
   </div>
   <!-- /Breadcrumb -->
</div>
<!-- /Title -->
<!-- Row -->
<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-default card-view">
         <div class="panel-heading">
            <div class="pull-left">
               <!--<h6 class="panel-title txt-dark">data Table</h6>-->
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="panel-wrapper collapse in">
            <div class="panel-body">
               <div class="table-wrap">
                  <div class="table-responsive">
                     <div id="datable_1_wrapper" class="dataTables_wrapper">
                        <table id="myTable" class="table table-hover display  pb-30" >
                           <thead>
                              <tr>
                                  <th rowspan="1" colspan="1">Crop Name</th>
                                  <th rowspan="1" colspan="1">Type</th>
                                 <th rowspan="1" colspan="1">Price</th>
                                  <th rowspan="1" colspan="1">Quantity</th>
                                 <th rowspan="1" colspan="1">Unity</th>
                                  <th rowspan="1" colspan="1">Location</th>
                                  <th rowspan="1" colspan="1">Description</th>
                                 <th rowspan="1" colspan="1">Action</
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($post as $post_list)
                              <tr>
                                   <td>{{$post_list->crop_name}}</td>
                                 <td>{{$post_list->type}}</td>
                                  <td>{{$post_list->price}}</td>
                              <td>{{$post_list->quantity}}</td>
                                 <td>{{$post_list->unit}}</td>
                                 <td>{{$post_list->crop_location}}</td>
                                 <td>{{$post_list->description}}</td>
                                 <td>
                                    <a href="{{url('post/show/'.$post_list->id)}}" class="btn btn-flat bg-green btn-sm view"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0);" data-id="{{$post_list->id}}" class="btn btn-flat bg-green btn-sm edit EditPost" data-token="{{csrf_token()}}"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);"  data-id="{{$post_list->id}}" class="btn btn-flat bg-green btn-sm delete deletePost"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Row -->
<!-- Modal -->
<div id="PostModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Add Post</h4>
         </div>
         <div class="modal-body">
 <form action="" method="post" id="post_form" enctype="multipart/form-data">
               {{ csrf_field() }} 
                <input type="hidden" id="token" name="token" value="{{csrf_token()}}"/>
                <div class="row">
                  <div class="col-sm-6">
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Crop Name</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <input type="text" class="form-control"  name="crop_name" placeholder="Crop Name" >
                  </div>
                  <div class="alert d-none" id="crop_name"></div>
               </div>
               </div>
              <div class="col-sm-6">
                <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Type</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                        <input type="text" name="type" placeholder="Type" class="form-control">

                        </div>
                         <div class="alert " id="type"></div>
                     </div>

                  </div>
               </div>
                <div class="row">
                  <div class="col-sm-6 post_image">
                     <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Image<span>(you can select multiple image)</span></label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                            <input type="file" class="form-control" multiple  name="post_image[]" >
                        </div>
                         <div class="alert " id="post_image"></div>
                     </div>
                      
                   </div>

                  <div class="col-sm-6">
                     <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Price</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
                        <input type="text" name="price" placeholder="Price" class="form-control">
                        </div>
                         <div class="alert " id="price"></div>
                      </div>
                       
                  </div>
               </div>
                    <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Quantity</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-reorder"></i></div>
                        <input type="number" name="quantity" placeholder="Quantity" class="form-control">
                        </div>
                         <div class="alert " id="quantity"></div>
                     </div>
                                        </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Unit</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                        <input type="text" name="unit" placeholder="Unit" class="form-control">

                        </div>
                         <div class="alert " id="unit"></div>
                     </div>

                                       </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                   <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Location</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                        <input type="text" name="location" placeholder="Location" class="form-control">

                        </div>
                         <div class="alert " id="location"></div>
                     </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Description</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                        <textarea type="text" name="description" placeholder="Description" class="form-control"></textarea>

                        </div>
                         <div class="alert " id="description"></div>
                     </div>
                  </div>
               </div>
              
               <input type="hidden" name="post_id" id="post_id">                                
         </div>
         <div class="modal-footer">
         <button type="Submit" class="btn btn-success mr-10" name="CreatePost" id="CreatePost">Submit</button>
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