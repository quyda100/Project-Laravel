$(document).ready(function () {
    var session = $('#session').val();
    if(session!== undefined){
       $('#user').append(
       
        '<li class="nav-item"><a id="logout"><span class="ti-arrow-right"></span></button></li>'
        );
       
        $('#logout').click(function(){
            $.ajax({
                type: "GET",
                url: "/logout",
                success: function (data) {
                    cuteToast({
                        title: "Thông báo",
                        type: "success",
                        message: "Đăng xuất thành công",
                        timer: 3000,
                    })
                    window.setTimeout(function () {
                        window.location.href = "/";//chuyen huong trang "route" 
                    }, 1000);
                }
            });
        });
    } 
    console.log(session);
});