//Jquery Start For Sub Industry//
/*.....Add Industry Type ......*/

$('#CreateIndustry').on('click',  function(e)
{
    $.ajax({
       
        url: `${APP_URL}/industry`,
         method: 'post',
        data: new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
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
          $('#industry_type').val(obj.industry_type);                                       
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




/*Create Category Using Ajax*/

$('#SendCategory').on('click',  function(e)
{
    //alert('==');
    $.ajax({
       
        url: `${APP_URL}/category`,
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
 
     var v_token1 = $('#token').val(); 
    var cat_name=$('#cat_name').val();
     var type=$('#industry_type').val();
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


//Jquery Start For Sub Category//

/*Add Sub Category ......*/

$('#SendSubCategory').on('click',  function(e)
{
    $.ajax({
       
        url: `${APP_URL}/subcategory`,
         method: 'post',
        data: $('#CreateSubCategory').serialize(),
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
          $('#subcategory_name').val(obj.subcategory_name);                                       
            $('#category_name').val(obj.cat_id);  
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
                notify(data.message, "info");
                return false;
                    
            }
            }
        });
     
            return false;
        }
    })
    
});

/*----Get Dropdown Subcategory Data--------*/
function getSubCategroy(cid){
    $.ajax({
      type:'GET',
      url:`${APP_URL}/subcategory/getAjaxData`,
      data:{id:cid,action:'subcategory'},
      success:function(res){
        $('#subcategory_Id').html(res);
      }
    });
  }



  //Jquery Start For Product//

/*.....Add Product ......*/

$('#CreateProduct').on('click',  function(e)
{
    $.ajax({
       
        url: `${APP_URL}/product`,
         method: 'post',
        data: new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
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


/*------------------Edit  Product------------*/
$('.EditProduct').on('click',  function(e)
{
 
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/product/edit/`+id,
        method: 'get',
        data:{'id':id},
      
        success: function(data)
        {
        
           debugger;
          var obj = JSON.parse(data);
           //getSubCategroy(obj.category_Id);
          console.log(obj.subcategory_Id);
          $('#category_Id').val(obj.category_Id); 
          getSubCategroy(obj.category_Id);
          $('#subcategory_Id').val(obj.subcategory_Id);                                        
            $('#product_name').val(obj.product_name);
             $('#sku').val(obj.sku);  
              $('#size').val(obj.size);
               $('#color').val(obj.color);
                $('#price').val(obj.price);
                 $('#discount').val(obj.discount);
                  $('#total_price').val(obj.total_price);
                   $('#moq').val(obj.MOQ);
                    $('#total_stock').val(obj.total_stock);
                    $('#gallery').val(obj.image_name);
              $('#myModal').modal("show");

        }
    });
});


/*-----Delete Single Row Data  SubCategory-----*/

$(document).on('click', '.deleteProduct', function(e)
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
            url:`${APP_URL}/product/destroy/`+id,
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