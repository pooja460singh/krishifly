$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

function Vendorblog(id)
{ 

     swal({
         title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#61B329',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm'
    }).then((result) =>
    {

        if(result.value)
        { 
           $.ajax({
            method:'get',
            url:`${APP_URL}/vendorblog/store`,
            data: {id:id,transaction_id:transaction_id},
            success:function(data)
            {
           var data = jQuery.parseJSON(data);
           if(data.valid == 1)
            {                
           redirect_notify(data.message,'Please wait while we redirect',"success");
             window.location.url=`${APP_URL}/success`;
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
    
    
};

function changeBlogsStatus(blogId, blogStatus) {
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
       url: `${APP_URL}/blog/report/update`,
           method: 'get',
           data: {
             blog_id: blogId,
            blog_status: blogStatus
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


