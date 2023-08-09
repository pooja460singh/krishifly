@extends('admin.layouts.app_login')
@section('content')
<section class="fxt-template-animation fxt-template-layout4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12 fxt-bg-wrap">
                    <div class="fxt-bg-img" data-bg-image="{{url('public/login/img/figure/bg4-l.jpg')}}">
                        <div class="fxt-header">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <a href="{{url('/')}}" class="fxt-logo"><img src="{{url('public/login/img/logo4.png')}}" alt="Logo"></a>
                            </div>
                            <div class="fxt-transformY-50 fxt-transition-delay-2">
                                <h1>Welcome To KC</h1>
                            </div>
                            <div class="fxt-transformY-50 fxt-transition-delay-3">
                                <p>The Kohinoor Collections company build technologies that give people the power to connect wave customers and shopkeepers, find communities and grow businesses. It offers shopping experience to its customer from anywhere, anytime from a vast range of products of their favourite one's all across the globe. Kohinoor Collections is an Indian brand wholly owned by Kohinoor Collections Pvt. Ltd.</p>
                            </div>
                        </div>
                        <ul class="fxt-socials">
                            <li class="fxt-facebook fxt-transformY-50 fxt-transition-delay-4">
                                <a target="_blank" rel="nofollow" href="https://www.facebook.com/Kohinoor-Collections-102332758267155/" title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="fxt-twitter fxt-transformY-50 fxt-transition-delay-5">
                                <a target="_blank" rel="nofollow" href="https://twitter.com/KOHINOORCOLLEC4?s=08" title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="fxt-linkedin fxt-transformY-50 fxt-transition-delay-7">
                                <a target="_blank" rel="nofollow" href="https://www.instagram.com/kohinoor.collections/?igshid=107ej6s3w649g" title="Instagram">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-12 fxt-bg-color">
                  

                    <div class="fxt-content">
               

                        <div class="fxt-form">
                        <form method="POST" action="{{route('admin/login')}}" enctype="multipart/form-data">
                             {{ csrf_field() }} 
                          
                           
                                 <div class="form-group">  
                                    <label for="email" class="input-label">User ID</label>                                              
                                    <input type="email" id="email" class="form-control" name="email" placeholder="youremail@gmail.com" >
                                </div>
                                <div class="form-group">  
                                    <label for="password" class="input-label">Password</label>                                               
                                    <input id="password" type="password" class="form-control" name="password" placeholder="********" >
                                    <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-checkbox-area">
                                        <!-- <div class="checkbox">
                                            <input id="checkbox1" name="remember_me" type="checkbox">
                                            <label for="checkbox1">Remember me logged in</label>
                                        </div> -->
                                        <a href="{{url('forgot/password')}}"  class="switcher-text">Forgot Password</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="fxt-btn-fill">Log in</button>
                                </div>
                            </form>                            
                        </div> 
                       <!--  <div class="fxt-footer">
                            <p>Don't have an account?<a href="{{url('customerregister')}}" class="switcher-text">Register</a></p>
                        </div>  -->                           
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection