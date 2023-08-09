$.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

$('#post_form').on('submit', function(event){
   event.preventDefault();

   /* Submit form data using ajax*/
   let id = $('#post_id').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/post/update`
        method='post'
    } else {
        url= `${APP_URL}/post/add`
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
         $('#PostModal').modal('hide')
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
$('.EditPost').on('click',  function(e)
{

   $('.post_image').hide();
     
     var id=$(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/post/edit/`+id,
        method: 'get',
        data:{'id':id},
        success: function(data)
        {
          var obj = JSON.parse(data);
          
            $("input[name$='crop_name']").val(obj.crop_name);
             $("input[name$='type']").val(obj.type);
              $("input[name$='price']").val(obj.price);
               $("input[name$='quantity']").val(obj.quantity);
                 $("input[name$='unit']").val(obj.unit);
                  $("input[name$='location']").val(obj.location);
                   $("textarea[name$='description']").val(obj.description);
                    $('#post_id').val(obj.id);
                    $('#PostModal').modal("show");
              


        }
    });
});


/*-----Delete Single Row Data  Product-----*/

$(document).on('click', '.deletePost', function(e)
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
         var v_token = $(this).attr("data-token"); 
           $.ajax({
            method:'get',
            url:`${APP_URL}/post/destroy/`+id,
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

/*----Get Dropdown Subcategory Data--------*/
function getSubCategroy(cid){
    $.ajax({
      type:'GET',
      url:`${APP_URL}/subcategory/getAjaxData`,
      data:{id:cid,action:'subcategory'},
      success:function(res){
        $("select[name$='subcategory_Id']").html(res);
        if($('#hdnsubcategory').val()!=null)
        $("select[name$='subcategory_Id']").val($('#hdnsubcategory').val());
      }
    });
  }


/*-----Delete Single Row Data  Product Image-----*/

$(document).on('click', '.postimage_delete', function(e)
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
         $.ajax({
            method:'get',
            url:`${APP_URL}/post/destroy/`+id,
            data:{image_id:id},
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



/*------------------Edit  Product Image------------*/
$('.postimage_edit').on('click',  function(e)
{
     $('#imageslider').show();
     var id = $(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/postimage/edit/`+id,
        method: 'get',
        data:{'id':id},
        success: function(data)
        {
           var obj = JSON.parse(data);
          var image_name=obj.image_name;
          var image_path=`${APP_URL}/public/`+obj.post_image;
          $("#imageslider").attr("src",image_path);
            $('#postimage_id').val(obj.id);
             $('#PostImage').modal("show");
  
        }
    });
});


$('#postimage_form').on('submit', function(event){
   event.preventDefault();

   $.ajax({
      url: `${APP_URL}/postimage/update`,
      method: 'post',
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
         $('#PostImage').modal('hide')
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



/*------------------  Product Image Modal Show------------*/
$('.AddImage').on('click',  function(e)
{
  
     var id=$(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/product/image/edit/`+id,
        method: 'get',
        data:{'id':id},
        success: function(data)
        {
          var obj = JSON.parse(data);
    
                    $('#product_image_id').val(obj[0].id);
                    $('#ProductImageModal').modal("show");
           


        }
    });
});

/**********************Add Multiple Product Image***************/
$('#post_image_form').on('submit', function(event){
   event.preventDefault();

   $.ajax({
      url: `${APP_URL}/post/image/add`,
      method: 'post',
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
         $('#ProductImageModal').modal('hide')
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

