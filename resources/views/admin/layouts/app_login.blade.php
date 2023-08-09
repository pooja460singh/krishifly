

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kohinoor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('public/login/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/login/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('public/login/font/flaticon.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('public/login/loginstyle.css')}}">
     <link rel="stylesheet" href="{{ url('vendors/sweetalert2/sweetalert2.css') }}">
</head>
<body>
   <div id = "myDiv" style="display:none" class="loader"></div>
      @include('admin.partials.alerts')
         @yield('content')
         </body>
   <!-- jquery-->
    <!-------------------- Scripts ------------->
    <script src="{{url('public/login/js/jquery-3.5.0.min.js')}}"></script>
    <script src="{{url('public/login/js/popper.min.js')}}"></script>
    <script src="{{url('public/login/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/login/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{url('public/login/js/validator.min.js')}}"></script>
    <script src="{{url('public/login/js/main.js')}}"></script>

     <script src="{{url('public/dist/js/function.js')}}"></script>
    <script src="{{url('public/plugins/jquery/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{url('public/jquery/dist/toastr.min.js')}}"></script>
    <script type="text/javascript">
        $(document).on('click', '.browse', function () {
            var file = $(this).parent().parent().parent().find('.file');
            file.trigger('click');
        });
        $(document).on('change', '.file', function () {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    </script>
    <script>
         let APP_URL = {!! json_encode(url('/')) !!};
      </script>
         @stack('scripts')
      
   
    <script type="text/javascript">
  const preloader = document.querySelector('.loader');

const fadeEffect = setInterval(() => {
  
  if (!preloader.style.opacity) {
    preloader.style.opacity = 1;
  }
  if (preloader.style.opacity > 0) {
    preloader.style.display = "none";
    preloader.style.opacity -= 2;
  } else {
    clearInterval(fadeEffect);
  }
}, 2000);

window.addEventListener('load', fadeEffect);

</script>
<!-- <script type="text/javascript">
        $(document).ready(function(){
            $('#CreateVender').click(function(){
                alert('ok');
            $('#myDiv').show();
             setTimeout(hide, 60000); 
            });
        });
   </script> -->
    
</html>

