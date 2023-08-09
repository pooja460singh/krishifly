

  $("#search_autocomplete").keyup(function(){
  
       $("input[name$='search']").prop('disabled', true);
       var val= $("#search_autocomplete").val();
      var source='';
      
         $.ajax({
                type: "GET",
                url: `${APP_URL}/search`,
                data: {
                       search_keyword: val
                       },
               datatype:'json',
             
                success: function(res){
                  var nameArr = res.split(',');
                
     
    $("#search_autocomplete").autocomplete({
      source: nameArr
    });
    }
  });
});
          

/*----Get Dropdown Submenu Data--------*/
function getSubmenu(menuid)
{  
  var city=$("#City").val();
  $.ajax({
      type:'GET',
      url:`${APP_URL}/submenu/getAjaxData`,
      data:{id:menuid,action:'submenu',city:city},
      success:function(res){
       
$(".innersubmenu1").empty();
$(".innersubmenu2").empty();    
var option1='';   
var option2='';
var count=2;
var sub_id=0;
 var obj = JSON.parse(res);
 for (var i=0;i<obj.length;i++)
{
      
   if(count%2==0)
    {            
     var url=`${APP_URL}/front/category/`+obj[i].id+'/'+obj[i].industry_Id+'/'+sub_id;
              option1+="<li>";
              option1+="<a href="+url+" >";
              option1+="<div class='row border-pro'>";
                                  option1+="<div class='col-xs-4 col-sm-4 col-md-4 col-lg-3 pro-img'>";
                                   option1+="<img src='public/"+obj[i].vender_image+"' class='img-fluid'>";
                                  option1+="</div>";
                                  option1+="<div class=' col-xs-8 col-sm-8 col-md-8 col-lg-9'>";
                                    option1+="<div class='entry-header'>";
                                      option1+="<h3 class='entry-title'>";
                                      option1+="<b>"+obj[i].business+"</b>";
                                       
                                      option1+="</h3>";
                                    option1+="</div>";
                                    option1+="<div class='featured-add'>";
                                      option1+="<div class='col-md-12 address-pd addro'>";
                                        option1+=obj[i].address;
                                      option1+="</div>";
                                      option1+="<div class='col-md-12 address-pd'>";
                                       
                                      option1+="</div>";
                                    option1+="</div>";
                                  option1+="</div>";
                              option1+="</div>";
                                 option1+="</a>";
                            option1+="</li> ";
                          
                      }
                      else {
                        var url=`${APP_URL}/front/category/`+obj[i].id+'/'+obj[i].industry_Id+'/'+sub_id;

                          
                         option2+="<li>";
                         option2+="<a href="+url+" >";
              option2+="<div class='row border-pro'>";
                                  option2+="<div class='col-xs-4 col-sm-4 col-md-4 col-lg-3 pro-img'>";
                                   option2+="<img src='public/"+obj[i].vender_image+"' class='img-fluid'>";                                 option2+="</div>";
                                  option2+="<div class=' col-xs-8 col-sm-8 col-md-8 col-lg-9'>";
                                    option2+="<div class='entry-header'>";
                                      option2+="<h3 class='entry-title'>";
                                     
                                          option2+="<b>"+obj[i].business+"</b>";
                                       
                                      option2+="</h3>";
                                    option2+="</div>";
                                    option2+="<div class='featured-add'>";
                                      option2+="<div class='col-md-12 address-pd addro'>";
                                        option2+=obj[i].address;
                                      option2+="</div>";
                                      option2+="<div class='col-md-12 address-pd'>";
                                       // option2+="<span class=' post-rate pull-right'>";
                                         // option2+="<i class='fa fa-star-o'></i> 4.25";
                                       // option2+="</span>";
                                      option2+="</div>";
                                    option2+="</div>";
                                  option2+="</div>";
                              option2+="</div>";
                              option2+="</a>";
                            option2+="</li> ";
                            
                      }
                          count=count+1;
                        }

         
         $(".innersubmenu1").append(option1);
             $(".innersubmenu2").append(option2);
      }
    });
};
/********Category Page***********/
function getSubcategory(SubcategoryId)
{  
   var vendorId=$('#vendorID').val();
  $.ajax({
      type:'GET',
      url:`${APP_URL}/front/subcategory`,
      data:{id:SubcategoryId,action:'subcategory',vendorId:vendorId},
      success:function(res){
$(".subCategory").empty();    
var option1='';  

 var obj = JSON.parse(res);

            for (var i=0;i<obj.length;i++)
           {
     var url=`${APP_URL}/front/category/`+obj[i].venderId+'/'+'0'+'/'+obj[i].id;
             option1+="<ul>";
              option1+="<li><a href="+url+" ><span class='box-sq'>■</span>"+obj[i].subcategory_name+"</a></li>";
              option1+="</ul>";
        
        }
        $(".subCategory").append(option1);
      },
     
   });
};


/*********ProductList Get On Subcategory********/


function get_productlist(Subcategoryid)
{  
  var industryId=$("#industryId").val();
  
  $.ajax({
      type:'GET',
      url:`${APP_URL}/front/category/`+industryId+'/'+Subcategoryid,
      data:{},
      success:function(res){

      }

    });  

};

/*-----Delete Single Row Data  Product-----*/

$(document).on('click', '.cartdelete', function(e)
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
         var v_token = $(this).attr("data-token"); 
           $.ajax({
            method:'get',
            url:`${APP_URL}/cart/destroy/`+id,
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

/************************Forgot Password*******************/

$('#forgot_password').on('submit', function(event){
   event.preventDefault();
  $.ajaxSetup({
  headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
 
   /* Submit form data using ajax*/
   $.ajax({
      url: `${APP_URL}/forgot-password`,
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

$( document ).ready(function(){
  //alert('ok');
  //debugger;
    $("#City").val($("#hdnCityId").val());
    
});

function getCityFooter(FooterCity)
{  
  
  
  $.ajax({
      type:'GET',
      url:`${APP_URL}/front`,
      data:{City:FooterCity},
      success:function(res){
         location.reload(true);
      }

    });  

};