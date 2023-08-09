$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});



$('#newsfeed_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   var id = $('#newsfeed_id').val();
   let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/newsfeed/update`
        method='post'
    } else {
        url= `${APP_URL}/newsfeed/add` 
        method='post'  
    }
 
   /* Submit form data using ajax*/
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
         $('#NewsFeedModal').modal('hide')
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


/*------------------Edit  Category------------*/
$('.EditNewsFeed').on('click',  function(e)
{
     $('#imagefeed').hide();
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/newsfeed/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
            $("input[name$='heading']").val(obj.heading);                                       
            $("input[name$='type']").val(obj.type);
            $("textarea[name$='description']").val(obj.description);  
            $('#newsfeed_id').val(obj.id);  
            $('#NewsFeedModal').modal("show");

        }
    });
});

/*****************News Feed Image Edit******************/
/*------------------Edit  Product Image------------*/
$('.newsimage_edit').on('click',  function(e)
{
     $('#imageslider').show();
     var id = $(this).attr("data-id");
    $.ajax({
        url: `${APP_URL}/newsimage/edit/`+id,
        method: 'get',
        data:{'id':id},
        success: function(data)
        {
           var obj = JSON.parse(data);
          var image_name=obj.image_name;
          var image_path=`${APP_URL}/public/`+obj.newsfeed_image;
          $("#imageslider").attr("src",image_path);
            $('#newsimage_id').val(obj.id);
             $('#NewsFeedImage').modal("show");
  
        }
    });
});

/****************News Feed Update*************/
$('#newsimage_form').on('submit', function(event){
   event.preventDefault();
   $.ajax({
      url: `${APP_URL}/newsfeedimage/update`,
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
         $('#NewsFeedImage').modal('hide')
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

/*-----Delete Single Row Data  Product Image-----*/

$(document).on('click', '.newsimage_delete', function(e)
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
            url:`${APP_URL}/newsfeed/destroy/`+id,
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




