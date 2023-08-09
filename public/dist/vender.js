$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});



/*Create Vender Using Ajax*/

$('#vender_form').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
var id = $('#vendor_id').val();
   let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/update/vendor`
        method='post'
    } else {
        url= `${APP_URL}/vender` 
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



/*------------------Edit Feature------------*/
$('.Feature').on('click',  function(e)
{
 
    
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/vender/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
           $("select[name$='signed']").val(obj.signed); 
            $('#signed_id').val(obj.id);  
           $('#myModal').modal("show");

        }
    });
});


$('#FeatureUpdate').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/vender/update`,
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
         $('#myModal').modal('hide')
         location.reload(true);
      },
      error: function (data) {
         let errors = data.responseJSON.errors
         $.each(errors, function (key, value) {
            $('#' + key).text(value)
            $('#' + key).removeClass('d-none')
            $('#' + key).addClass("d-none", 10000);
         });
      }
   });
});






 $(".french_id").blur(function(){ 
 var frenchId=$("input[name$='french_id']").val();
         $.ajax({
      type:'GET',
      url:`${APP_URL}/vender/show/`,
      data:{id:frenchId},
      success:function(res){
         var obj = JSON.parse(res);
        
        $("input[name$='french_name']").val(obj.name);
        $("input[name$='state']").val(obj.state_id);
        $("input[name$='city']").val(obj.city_id);
        $("input[name$='state_old']").val(obj.state_name);
        $("input[name$='city_old']").val(obj.city_name);
        $("input[name$='french_name']").prop('disabled', true);
        $("input[name$='state_old']").prop('disabled', true);
        $("input[name$='city_old']").prop('disabled', true);
      }
    });
    });

/*-----Delete Single Row Data  Vendor-----*/

$(document).on('click', '.deleteVendor', function(e)
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
            url:`${APP_URL}/vender/destroy/`+id,
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


function changeStatusVendor(Id, Status) {
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
       url: `${APP_URL}/status/update`,
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

/*------------------Edit  Customer------------*/
$('.EditVendor').on('click',  function(e)
{
     var email=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/edit/vendor/`+email,
        method: 'get',
        data:{'email':email},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
           $("input[name$='french_id']").val(obj.french_id);                                       
              $("input[name$='french_name']").val(obj.french_name); 
           $("input[name$='vender_name']").val(obj.vender_name);                                       
              $("input[name$='email']").val(obj.support_email); 
               $("input[name$='phone_number']").val(obj.phone_number); 
                $("input[name$='address']").val(obj.address); 
                  $("input[name$='business']").val(obj.business); 
                    $("input[name$='gst']").val(obj.gst); 
               $("input[name$='map_url']").val(obj.map_url); 
                $("input[name$='pan_card']").val(obj.pan_card); 
                $("input[name$='pincode']").val(obj.pincode);
                 //$("input[name$='password']").val(obj.password);
                 $("select[name$='industry_Type']").val(obj.industry_Id); 
                 $("select[name$='state']").val(obj.state);
           $('#hdncity').val(obj.city);     
             $("textarea[name$='about_me']").val(obj.about_me);
            $('#vendor_id').val(obj.id);  
           $('#VendorModal').modal("show");
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
  
  
  
  
  /**********Edit Vendor Profile***************/

  $('#vendor_profile').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/vendor/profile/update`,
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
         $('#VendorProfile').modal('hide')
         location.reload(true);
      },
     
   });
});


 /**********Change Vendor Password By Admin***************/

 $('.EditVendorPassword').on('click',  function(e)
{
     var id=$(this).attr("data-id");
  
    $.ajax({
       
        url: `${APP_URL}/edit/vendor/password/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
                                                
              $("input[name$='email']").val(obj.email); 
            
            $("input[name$='password_id']").val(obj.email);  
           $('#VendorChangeModal').modal("show");

        }
    });
});

  /******Update Customer Password*************/

$('#vendor_password').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/update/vendor/password`,
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

/*********************Notification Update Status*****************/

/*------------------Edit Feature------------*/
$('.Notification').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/vender/notify/update/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          location.reload(true);

        }
    });
});