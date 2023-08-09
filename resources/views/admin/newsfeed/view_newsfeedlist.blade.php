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
      <h5 class="txt-dark">News Feed List</h5>
   </div>
   <!-- Breadcrumb -->
   <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#NewsFeedModal">
      <i class="fa fa-plus"></i> Add News Feed
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
                                  <th rowspan="1" colspan="1">Heading</th>
                                  <th rowspan="1" colspan="1">Type</th>
                                  <th rowspan="1" colspan="1">Description</th>
                                 <th rowspan="1" colspan="1">Action</
                              </tr>
                           </thead>
                           <tbody>
                            @foreach($newslist as $news)
                            <tr>
                                   <td>{{$news->heading}}</td>
                                 <td>{{$news->type}}</td>
                                 <td>{{$news->description}}</td>
                                 <td>
                                    <a href="{{url('newsfeed/show/'.$news->id)}}" class="btn btn-flat bg-green btn-sm view"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0);" data-id="{{$news->id}}" class="btn btn-flat bg-green btn-sm edit EditNewsFeed" data-token="{{csrf_token()}}"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);"  data-id="{{$news->id}}" class="btn btn-flat bg-green btn-sm delete deletePost"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
<div id="NewsFeedModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Add News Feed</h4>
         </div>
         <div class="modal-body">
          <form action="" method="post" id="newsfeed_form" enctype="multipart/form-data">
               {{ csrf_field() }} 
                <input type="hidden" id="token" name="token" value="{{csrf_token()}}"/>
                <div class="row">
                  <div class="col-sm-6">
               <div class="form-group">
                  <label class="control-label mb-10" for="exampleInputuname_1">Heading</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <input type="text" class="form-control"  name="heading" placeholder="Heading" >
                  </div>
                  <div class="alert d-none" id="heading"></div>
               </div>
               </div>
              <div class="col-sm-6">
                <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Type</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                        <select class="form-control" name="type">
                        <option value="image">Image</option>
                        <option value="Video">Video</option>
                        </select>
                        </div>
                         <div class="alert " id="type"></div>
                     </div>

                  </div>
               </div>
                <div class="row">
                  <div class="col-sm-6 post_image" id="imagefeed">
                     <div class="form-group">
                        <label class="control-label mb-10" for="customer image">Image<span>(you can select multiple image)</span></label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                            <input type="file" class="form-control" multiple  name="newsfeed_image[]" >
                        </div>
                         <div class="alert " id="newsfeed_image"></div>
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
              
               <input type="hidden" name="newsfeed_id" id="newsfeed_id">                                
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
<script src="{{url('public/dist/news_feed.js') }}"></script>
@endpush