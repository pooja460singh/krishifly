/*----Get Dropdown Subcategory Data--------*/

function updateOrderStatus(id, status) {
    $.ajax({
      type:'GET',
      url:`${APP_URL}/order/getAjaxData`,
      data:{id:id,status:status,action:'orderstatus'},
      success:function(res){
        location.reload(); 
      }
    });
}
function UpdateOrderStatus(id,status){
   // alert(status);
  //var status=$('#order_status'+id).val();
    $.ajax({
      type:'GET',
      url:`${APP_URL}/order/getAjaxData`,
      data:{id:id,status:status,action:'orderstatus'},
      success:function(res){
        location.reload();
      
      }
    });
  }


  /*------------------Edit Feature------------*/
$('.OrderDetail').on('click',  function(e)
{

    
     var orderno=$(this).attr("data-id");
    $.ajax({
       
        url: `${APP_URL}/order/detail/`+orderno,
        method: 'get',
        data:{'orderno':orderno},
      
        success: function(data)
        {

          var obj = JSON.parse(data); 
          url=`${APP_URL}`;
$("#data_detail").empty(); 
  var option1='';  
  option1+="<table class='table table-striped table-hover table-bordered'>";
 option1+="<thead class='thead-detail'>";
  option1+="<tr>";
option1+="<th>Product Name</th>";
option1+="<th>Product Image</th>";
option1+="<th>Quantity</th>";
option1+="<th>Price</th>";
option1+="<th>Size</th>";
option1+="</tr> ;"
 option1+="<thead>";
  option1+="<tbody>";
 for (var i=0;i<obj.length;i++)
{

option1+="</tr>";
option1+="</thead>";
option1+="<tbody class='detail-td text-center'>";
option1+="<tr>";
option1+="<td>"+obj[i].product_name+"</td>";
 option1+="<td><img src='"+url+"/public/"+obj[i].image_name+"' class='img-fluid' width='60px' height='60px'></td>";
option1+="<td>"+obj[i].quantity+"</td>";
option1+="<td>Rs-"+obj[i].finalamount+"/-</td>";
option1+="<td>"+obj[i].size+"</td>";
option1+="</tr>";

}
 option1+="</tbody>";
  option1+="<table>";
 $("#data_detail").append(option1);
   $('#OrderDetail').modal('show')

   }
    });
});
