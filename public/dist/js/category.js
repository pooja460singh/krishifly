/*Create Category Using Ajax*/

$('#SendCategory').on('click',  function(e)
{
  var id = $('#category_id').val(); 
   alert('ok');
   let url = '';
    if (!empty(id)) {
        url= `${APP_URL}/category/`
    } else {
        url= `${APP_URL}/category/update/`+id   
    }
   
     $.ajax({
       url: url,
         method: 'post',
        data: $('#CreateCategory').serialize(),
        success: function(data)
        {
         var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.message,'Please wait while we redirect',"success");
             
            }
            else
            {
                notify(data.message, "info");
                return false;
                    
            }

        }
    });
   
   
});



/*------------------Edit  Category------------*/
$('.EditCategory').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/category/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
          $('#cat_name').val(obj.cat_name);                                       
            $('#industry_type').val(obj.industry_id);  
            $('#category_id').val(obj.id);  
           $('#myModal').modal("show");

        }
    });
});

/*-----Delete Single Row Data  Category-----*/

$(document).on('click', '.deleteCategory', function(e)
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
            url:`${APP_URL}/category/destroy/`+id,
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

