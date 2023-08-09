$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});



/*Create Units Using Ajax*/


$('#createunit_form').on('submit',  function(event){
   event.preventDefault();
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
  var id = $('#unit_id').val();
 
      let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/units/update`
        method='post'
    } else {
        url= `${APP_URL}/units/add`
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
                    
        $('#UnitModal').modal('hide')
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

/***************************Edit Unit********************/
$('.EditUnit').on('click',  function(e)
{
 
     var v_token1 = $('#token').val(); 
    var cat_name=$('#cat_name').val();
     var type=$('#industry_type').val();
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/units/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
          $("input[name$='unit_name']").val(obj.unit_name); 
            $('#unit_id').val(obj.id);  
           $('#UnitModal').modal("show");

        }
    });
});

/*-----Delete Single Row Data  Unit-----*/

$(document).on('click', '.deleteUnit', function(e)
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
            url:`${APP_URL}/units/delete/`+id,
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