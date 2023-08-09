/*
* tostr options
*/
  /*toastr.options = {
                "closeButton": true,               
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "400",
                "hideDuration": "400",
                "timeOut": "4000",              
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              } */



/*
* function for notify 
*/

function notify(msg, msgtype) {
    swal({
        type: msgtype,
        title: msg,
        text: ''
    });
}

/*
*function for notify successs 

*/

function redirect_notify(msg, subtext, redirect,msgtype) {
     swal({
        type: msgtype,
        title: msg,
        text: subtext,
        timer: 3000,
        onOpen: function onOpen() {
            swal.showLoading();
        }
    }).then(function (result) {
        if (redirect == '') {
            location.reload();
        } else {
            window.location.href = redirect;
        }
    });
}





