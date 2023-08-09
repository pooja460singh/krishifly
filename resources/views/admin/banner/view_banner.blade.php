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
      <h5 class="txt-dark">Banner List</h5>
   </div>
   <!-- Breadcrumb -->
   <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
      <a href="#" class="btn btn-primary" id="bannerimage" data-toggle="modal" data-target="#BannerModal">
      <i class="fa fa-plus"></i> Add Banner
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
                                 <th rowspan="1" colspan="1">Banner Image</th>
                                    
                                 <th rowspan="1" colspan="1">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                               @foreach($bannerlist as $banner)
                              <tr>
                                 <td>
                                    <img src="{{url('public/'.$banner->banner_image)}}" class="img-responsive" alt="Product Image" style="width:250px;height:150px;"></td>
                                   
                                 <td>
                                    <a href="javascript:void(0);" data-id="{{$banner->id}}" class="btn btn-flat bg-green btn-sm edit EditBanner" data-token="{{csrf_token()}}"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);"  data-id="{{$banner->id}}" class="btn btn-flat bg-green btn-sm delete deleteBanner"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
<div id="BannerModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Add Banner</h4>
         </div>
        
         <div class="modal-body">
            <form action="" method="post" id="CreateBanner" enctype="multipart/form-data">
               {{ csrf_field() }} 
                <img src="" id="imageBanner" class="img-responsive" style="width:100%;height:25%">
               <div class="form-group">
                  <label class="control-label mb-10" for="banner_image">Banner Image</label>
                  <div class="input-group">
                     <div class="input-group-addon"><i class="icon-user"></i></div>
                     <input type="file" class="form-control"  name="banner_image" placeholder="Slider Image" >
                  </div>
                  <div class="alert " id="banner_image"></div>
               </div>
               
              

              
               <input type="hidden" name="banner_id" id="banner_id">								                
         </div>
         <div class="modal-footer">
         <button type="Submit" class="btn btn-success mr-10" name="SendSlider" id="SendSlider">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script src="{{url('public/dist/banner.js') }}"></script>
@endpush