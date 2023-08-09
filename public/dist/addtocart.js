
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});




$('.buymultipleproduct').on('click',  function(e)
{
     $.ajax({
       url:`${APP_URL}/front/multiproduct`,
         method: 'post' ,
        data:$('#addtocart_form').serialize(),
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
             window.location.href=`${APP_URL}/cart`;
            }
            else
            {
               swal(
               'Warning!',
               data.message,
               'info'
            )
                if(data.message =='Please Login Your Email And Password.')
               {
                window.location.href=`${APP_URL}/user/login`;
               }
                return false;
                  
              }
                    
        
        
      },

    
   }, "json");
   
   
});

/*Create Cart Using Ajax*/
$('.addtocart').on('click',  function(e)
{

 var qty = $('#qty').val();
  var price = $('#product_price').val();
   var id = $('#productdetailsId').val();
   var total_price=price * qty;
     $.ajax({
        url:`${APP_URL}/front/addtocart`,
         method: 'post' ,
        data:$('#addtocart_form').serialize(),
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
               'Warning!',
               data.message,
               'info'
            )

                if(data.message =='Please Login Your Email And Password.')
               {
                window.location.href=`${APP_URL}/user/login`;
               }
                return false;
              }
                    
        
         location.reload(true);
      },

    
   }, "json");
   
   
});


/*Create Brand Using Ajax*/

function singleproduct(id)
{
 var size = $('#size'+id).val();
 //alert(size)
     $.ajax({
        url:`${APP_URL}/front/singleproduct`,
         method: 'get' ,
        data:{id:id,size:size},
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
               'Warning!',
               data.message,
               'info'
            )

                 if(data.message =='Please Login Your Email And Password.')
               {
                window.location.href=`${APP_URL}/user/login`;
               }
                return false;
              }
                    
        
         location.reload(true);
      },

    
   }, "json");
   
   
};


/*Create  AddtoCart Single Product Using Ajax*/

function buysingleproduct(id)
{
 var size = $('#size'+id).val();
     $.ajax({
        url:`${APP_URL}/front/buysingleproduct`,
         method: 'get' ,
        data:{id:id,size:size},
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
             window.location.href=`${APP_URL}/cart`;
            }
            else
            {
               swal(
               'Warning!',
               data.message,
               'info'
            )
                if(data.message =='Please Login Your Email And Password.')
               {
                window.location.href=`${APP_URL}/user/login`;
               }
                return false;
                  
              }
                    
        
        
      },

    
   }, "json");
   
   
};
/*Cart Qty Add Ajax*/

function addqty(id)
{
   var i = 1;
    var qty=parseInt($("#qty"+id).val());
    var price=parseInt($("#addcart_price"+id).val());
    var cart_qty=parseInt($("#addcart_qty"+id).val());
    var grandtotal=parseInt($("#addcart_grand"+id).val());
    var discount=parseInt($("#addcart_discount"+id).val());
    var totalqty=qty+1;
    var total_price=price *totalqty;
    var gand_total=grandtotal+price;
   // $("#priceadd"+id).text(total_price);
     //$("#grandtotal").text(gand_total);
     
       
     $.ajax({
        url:`${APP_URL}/cart/update`,
         method: 'get' ,
        data:{id:id,qty:totalqty,price:total_price,discount:discount},
        success: function(data)
        {
        window.location.reload(true);
      },

    
   }, "json");
   
   
};

/*Cart Qty Reduce Ajax*/

function reduce(id)
{
   var i = 1;
    var qty=parseInt($("#qty"+id).val());
    var price=parseInt($("#addcart_price"+id).val());
    var cart_qty=parseInt($("#addcart_qty"+id).val());
    var grandtotal=parseInt($("#addcart_grand"+id).val());
     var discount=parseInt($("#addcart_discount"+id).val());
    var totalqty=cart_qty-1;
    var total_price=price *totalqty;
    var gand_total=grandtotal+price;
   // $("#priceadd"+id).text(total_price);
     //$("#grandtotal").text(gand_total);
     
       
     $.ajax({
        url:`${APP_URL}/cart/reduce`,
         method: 'get' ,
        data:{id:id,qty:totalqty,price:total_price,discount:discount},
        success: function(data)
        {
        window.location.reload(true);
      },

    
   }, "json");
   
   
};

/*-----Delete Single Row Data  Customer Address-----*/

$(document).on('click', '.cartaddressdelete', function(e)
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
            window.location.reload();
            
            }
          });
     
            return false;
        }
    })
    
});

$('.EditCartAddress').on('click',  function(e)
{
     var id=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/cartaddress/edit/`+id,
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


function AssignDeliveryAddress(AddressId) {
  var OldAddresId = $("#deliveryaddressid").val();
    if (OldAddresId != "") {
        var OldDiv = document.getElementById("Address" + OldAddresId + "");
        OldDiv.classList.remove("deliver-white");
    }
    $("#deliveryaddressid").val(AddressId);
    var div = document.getElementById("Address" + AddressId + "");
    div.classList.add("deliver-white");

}


/*****************Placeorder*****************/
$('.placeorder').on('click',  function(e)
{
  var deliverid = $("#deliveryaddressid").val();
  if(deliverid == null){
    alert('Please Add Address');
  }else{
    var cod = $("#payment_mode1").val();
      var online = $("#payment_mode2").val();
   if(deliverid != "")
   {
   if($("input[name$='payment_mode1']:checked").val() == 'COD')
   {
     $("#payment_mode2"). prop("checked", false);
     $.ajax({
        url:`${APP_URL}/placeorder`,
         method: 'get' ,
        data:{id:deliverid},
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
              window.location.href=`${APP_URL}/order/customer`;
            }
            else
            {
               swal(
               'Error!',
               data.message,
               'error'
            )
               window.location.href=`${APP_URL}/cart`;  
              }
                    
        
      },

    
   }, "json");

   }else if($("input[name$='payment_mode2']:checked").val() == 'Online Payment'){
    $("#payment_mode2"). prop("checked", true);
      $.ajax({
        url:`${APP_URL}/payment/`+deliverid,
         method: 'get' ,
        data:{id:deliverid},
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
              var response= data.response;
              window.location.href=`${APP_URL}/payment/view/`+data.response;
            }
            else
            {
               swal(
               'Error!',
               data.message,
               'error'
            )
               window.location.href=`${APP_URL}/cart`;  
              }
                    
        
      },

    
   }, "json");
   }else{
    alert('Please Choose Payment Mode');
   }
    }else{
    alert('Please Select Address');
   }
 }
   
   
});

$(".check-male"). click(function(){
$("#payment_mode2"). prop("checked", false);
});
$(".check-female"). click(function(){
$("#payment_mode1"). prop("checked", false);
$("#payment_mode2"). prop("checked", true);
});