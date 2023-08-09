/*Add Sub Category ......*/

$('#SendSubCategory').on('click',  function(e)
{
  var id = $('#subcategory_id').val();
      let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/subcategory/update`
        method='patch'
    } else {
        url= `${APP_URL}/subcategory` 
        method='post'  
    }
     $.ajax({
        url:url,
         method: method,
        data: $('#CreateSubCategory').serialize(),
        success: function(data)
        {
          
         var data = jQuery.parseJSON(data);
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
                    
        $('#myModal').modal('hide')
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



/*------------------Edit  SubCategory------------*/
$('.EditSubCategory').on('click',  function(e)
{
 
     var v_token1 = $('#token').val(); 
    var cat_name=$('#cat_name').val();
     var type=$('#industry_type').val();
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/subcategory/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
          $("input[name$='subcategory_name']").val(obj.subcategory_name);                                       
            $("select[name$='category_name']").val(obj.cat_id);  
            $('#subcategory_id').val(obj.id);  
           $('#myModal').modal("show");

        }
    });
});

/*-----Delete Single Row Data  SubCategory-----*/

$(document).on('click', '.deleteSubCategory', function(e)
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
            url:`${APP_URL}/subcategory/destroy/`+id,
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
                notify(data.message, "error");
                return false;
                    
            }
            }
        });
     
            return false;
        }
    })
    
});



