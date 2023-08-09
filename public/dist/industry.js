//Jquery Start For  Industry//
/*.....Add Industry Type ......*/




$('#industry_form').on('submit',  function(event){
   event.preventDefault();
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

  var id = $('#industry_id').val();
 
      let url = '';
      let method='';
   if (id) {
        url= `${APP_URL}/industry/update`
        method='post'
    } else {
        url= `${APP_URL}/industry` 
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
                    
        $('#IndustryModal').modal('hide')
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


/*------------------Edit  Industry------------*/
$('.EditIndustry').on('click',  function(e)
{
 
     var v_token1 = $('#token').val(); 
    var cat_name=$('#cat_name').val();
     var type=$('#industry_type').val();
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/industry/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
          var obj = JSON.parse(data);
           $("select[name$='industry_head']").val(obj.headId); 
          $("input[name$='industry_type']").val(obj.industry_type);                                       
            $('#industry_id').val(obj.id);   
           $('#IndustryModal').modal("show");

        }
    });
});

/*-----Delete Single Row Data  Industry-----*/

$(document).on('click', '.industrydelete', function(e)
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
            url:`${APP_URL}/industry/destroy/`+id,
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