$.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

$('#bannerimage').on("click",function(e){
 $('#imageBanner').hide();
});

$('#CreateBanner').on('submit', function(event){
   event.preventDefault();

   /* Submit form data using ajax*/


   let id = $('#banner_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/banner/update`
        method='post'
    } else {
        url= `${APP_URL}/banner/add`
        method='post'
    }

   $.ajax({
      url: url,
      method: method,
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
         if (data.success) {
             swal(
               'Good job!',
               data.message,
               'success'
            )
         } else {
             swal(
               'Error!',
               data.message,
               'error'
            )
         }
         $('#BannerModal').modal('hide')
         location.reload(true);
      },
      error: function (data) {
         let errors = data.responseJSON.errors
         $.each(errors, function (key, value) {
            $('#' + key).text(value)
            $('#' + key).removeClass('alert-danger')
            $('#' + key).addClass("alert-danger", 10000);
         });
      }
   });
});


/*------------------Edit  Product------------*/
$('.EditBanner').on('click',  function(e)
{
  $('#imageBanner').show();
     var id=$(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/banner/edit/`+id,
        method: 'get',
        data:{'id':id},

        success: function(data)
        {
          var obj = JSON.parse(data);
          var image_name=obj.banner_image;
          var image_path=`${APP_URL}/public/`+obj.banner_image;
          $("#imageBanner").attr("src",image_path);
            $('#banner_id').val(obj.id);
             $('#BannerModal').modal("show");
           
               

        }
    });
});


/*-----Delete Single Row Data  SubCategory-----*/

$(document).on('click', '.deleteBanner', function(e)
{
     e.preventDefault();
     swal({
         title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) =>
    {
        if(result.value)
        {

        var id = $(this).attr("data-id");
        var table = $(this).attr("data-table");
         var v_token = $(this).attr("data-token"); ;
           $.ajax({
            method:'get',
            url:`${APP_URL}/banner/destroy/`+id,
            data:{id:id},
            success:function(data)
            {
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {
           redirect_notify(data.message,'Please wait while we redirect',window.location.reload(),"success");

            }
            else
            {
                notify(data.message, "info");
                return false;

            }
            }
        });

            return false;
        }
    })

});



