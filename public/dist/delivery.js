$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});



/*Create Delivery Boy Using Ajax*/

$('#delivery_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   var id = $('#delivery_id').val();
   let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/delivery/update`
        method='post'
    } else {
        url= `${APP_URL}/delivery/store` 
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
         $('#CustomerModal').modal('hide')
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

/*------------------Edit  Delivery Boy------------*/
$('.EditDelivery').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/delivery/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
          $("input[name$='name']").val(obj.name);                                       
              $("input[name$='email']").val(obj.email); 
               $("input[name$='contact']").val(obj.contact); 
               $("input[name$='password']").val(obj.password); 
                $("input[name$='confirm_password']").val(obj.password); 
                $("input[name$='address']").val(obj.address); 
                $("input[name$='vehicle_no']").val(obj.vehicle_no); 
                 $("select[name$='vehicle']").val(obj.vehicle);  
            $('#delivery_id').val(obj.id);  
           $('#DeliveryModal').modal("show");

        }
    });
});

/*-----Delete Single Row Data  Delivery Boy-----*/

$(document).on('click', '.deleteDelivery', function(e)
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
            url:`${APP_URL}/delivery/destroy/`+id,
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


/*------------------Pick Up Center Address------------*/
function PickUpCenter(orderno){
 
    $.ajax({
       
        url: `${APP_URL}/delivery/pickupcenter/`+orderno,
        method: 'get',
        data:{'id':orderno},
      
        success: function(data)
        {
        var obj = JSON.parse(data); 
         $('#Shopkeeper').text(obj.vender_name);
         $('#vendor_email').text(obj.email);
         $('#contact').text(obj.phone_number);
         $('#address').text(obj.address);
          $('#shop_name').text(obj.business);
           $('#PickUpCenterModal').modal("show");

        }
    });
}


/*------------------Pick Up Center Address------------*/
function DeliveryCenter(email){
 
    $.ajax({
       
        url: `${APP_URL}/delivery/deliverycenter/`+email,
        method: 'get',
        data:{'email':email},
      
        success: function(data)
        {
         
          var obj = JSON.parse(data);
         $('#Customer').text(obj.customer_name);
         $('#customer_email').text(obj.email);
         $('#customer_contact').text(obj.phone_number);
         $('#customer_address').text(obj.address);
           $('#DeliveryModal').modal("show");

        }
    });
}




