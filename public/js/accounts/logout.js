$(document).ready(function(){
    var session = $('#session').val();
    if(session!== undefined){
        $('#user').append(
         '<li class="nav-item">'+
         '<a id="logout" href="../user/logout"><span class="lnr lnr-exit"></span></button></li>'
         );
        
         $('#logout').click(function(){
                     cuteToast({
                         title: "Thông báo",
                         type: "success",
                         message: "Đăng xuất thành công",
                         timer: 3000,
                     })
                 });
    }
});