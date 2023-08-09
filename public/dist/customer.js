$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});



/*Create Customer Using Ajax*/

$('#customer_form').on('submit', function(event){
   
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


   var id = $('#customer_id').val();
   let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/update/customer`
        method='post'
    } else {
        url= `${APP_URL}/customer` 
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
              location.reload(true);
         } else {
             swal(
               'Error!',
               data.message,
               'error'
            )
         }
         $('#CustomerModal').modal('hide')
        
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




/******Update Customer Profile*************/

$('#customer_profile').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/customer/update`,
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

  /******Update Customer Profile Image*************/

$('#customer_profile_image').on('submit', function(event){

   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/profile/update`,
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


 /******Update Customer Password*************/

$('#customer_password').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/password/update`,
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

function changeStatus(Id, Status) {
  swal({
     title: 'Are you sure?',
     text: "You won't be able to revert this!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes!'
  }).then((result) => {
     if (result.value) {
        $.ajax({
       url: `${APP_URL}/customer/status/update`,
           method: 'get',
           data: {
             id: Id,
            status: Status
           },
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
              location.reload(true);
           }
        }, "json");
     }
  })
};

/*-----Delete Single Row Data  Customer-----*/

$(document).on('click', '.deleteCustomer', function(e)
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
            url:`${APP_URL}/customer/destroy/`+id,
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

/*------------------Edit  Customer------------*/
$('.EditCustomer').on('click',  function(e)
{
     var email=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/edit/customer/`+email,
        method: 'get',
        data:{'email':email},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
           $("input[name$='customer_name']").val(obj.customer_name);                                       
              $("input[name$='email']").val(obj.support_email); 
               $("input[name$='phone_number']").val(obj.phone_number); 
                $("input[name$='address']").val(obj.address); 
                $("input[name$='pincode']").val(obj.pincode); 
                 $("select[name$='state']").val(obj.state);
           $('#hdncity').val(obj.city);     
            $('#customer_id').val(obj.id);  
           $('#CustomerModal').modal("show");
            getCity(obj.state);

        }
    });
});

 /**********Change Customer Password By Admin***************/

 $('.EditCustomerPassword').on('click',  function(e)
{
     var id=$(this).attr("data-id");
  
    $.ajax({
       
        url: `${APP_URL}/edit/customer/password/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
                                                
              $("input[name$='email']").val(obj.email); 
            
            $("input[name$='password_id']").val(obj.email);  
           $('#CustomerChangeModal').modal("show");

        }
    });
});

  /******Update Customer Password*************/

$('#customer_password_update').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/update/customer/password`,
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
         location.reload(true);
      },
   
   });
});