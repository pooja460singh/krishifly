$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});



/*Create Category Using Ajax*/


$('#color_form').on('submit',  function(event){
   event.preventDefault();
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

  var id = $('#color_id').val();
 
      let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/color/update`
        method='post'
    } else {
        url= `${APP_URL}/color/add`
        method='post'  
    }
   
     $.ajax({
        url:url,
        method: method,
        data: new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data)
        {
            if(data.success)
            { 
             swal(
               'Good job!',
               data.message,
               'success'
            )
             
            }
            else
            {
               swal(
               'Error!',
               data.message,
               'error'
            )
                return false;
              }
                    
        $('#ColorModal').modal('hide')
         location.reload(true);
      },

      error: function (data) {

         let errors = data.responseJSON.errors
         $.each(errors, function (key, value) {
            $('#' + key).text(value)
            $('#' + key).removeClass('alert-danger')
            $('#' + key).addClass("alert-danger", 5000);
         });
      }
   }, "json");
   
   
});


/*------------------Edit  Category------------*/
$('.EditColor').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/color/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
           $("input[name$='color']").val(obj.color);                                       
            $('#color_id').val(obj.id);  
           $('#ColorModal').modal("show");

        }
    });
});

/*-----Delete Single Row Data  Category-----*/

$(document).on('click', '.deleteColor', function(e)
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
            url:`${APP_URL}/color/destroy/`+id,
            data:{id:id,v_token:v_token},
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

