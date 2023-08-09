$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});



/*Create Brand Using Ajax*/
$('#SendFrench').on('click',  function(e)
{
 var id = $('#french_id').val();
   let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/french/update`
        method='patch'
    } else {
        url= `${APP_URL}/french` 
        method='post'  
    }
     $.ajax({
        url:url,
         method: method,
        data: $('#french_form').serialize(),
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
                    
        $('#FrenchModal').modal('hide')
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



$('.EditFrenchies').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/french/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
        	
          var obj = JSON.parse(data);

           $("input[name$='name']").val(obj.name); 
            $("input[name$='email']").val(obj.email); 
             $("input[name$='mobile_no']").val(obj.mobile_no); 
              $("input[name$='address']").val(obj.address);  
              $("select[name$='state']").val(obj.state);
               $('#hdncity').val(obj.city);                                        
            $('#french_id').val(obj.id);  
           $('#FrenchModal').modal("show");
           getCity(obj.state);

        }
    });
});

/*-----Delete Single Row Data  Category-----*/

$(document).on('click', '.deleteFrenchies', function(e)
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
            url:`${APP_URL}/french/destroy/`+id,
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


/*----Get Dropdown City Data--------*/
function getCity(sid){
    $.ajax({
      type:'GET',
      url:`${APP_URL}/french/getAjaxData`,
      data:{id:sid,action:'City'},
      success:function(res){
        $("select[name$='city']").html(res);
        if($('#hdncity').val()!=null)
        $("select[name$='city']").val($('#hdncity').val());
      }
    });
  }
