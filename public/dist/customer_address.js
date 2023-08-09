$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
/******Add Customer Address*************/

$('#customer_address').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
   let id = $('#customer_addressId').val();
   let url = '';
   let method='';
   if (id) {
        url= `${APP_URL}/address/update`
        method='post'
    } else {
        url= `${APP_URL}/address/customer`
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
          $('#CustomerAddressModal').modal('hide')
         location.reload(true);
      },
      error: function (data) {
         let errors = data.responseJSON.errors
         $.each(errors, function (key, value) {
            $('#' + key).text(value)
            $('#' + key).removeClass('alert-danger')
            $('#' + key).addClass('alert-danger', 10000);
         });
      }
   });
});


/*------------------Edit  Customer Address------------*/
$('.EditCustomerAddress').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/customer/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
           $("input[name$='house_no']").val(obj.house_no);
           $("input[name$='landmark']").val(obj.landmark); 
           $("textarea[name$='address']").val(obj.address); 
           $("input[name$='pincode']").val(obj.pincode);                                        
            $("select[name$='state']").val(obj.state);
             $("input[name$='hdncity']").val(obj.city);   
            $('#customer_addressId').val(obj.id);  
           $('#CustomerAddressModal').modal("show");
          getCity(obj.state);
        }
    });
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

  /*-----Delete Single Row Data  Customer Address-----*/

$(document).on('click', '.deleteCustomerAddress', function(e)
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
            url:`${APP_URL}/cartaddress/destroy/`+id,
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
