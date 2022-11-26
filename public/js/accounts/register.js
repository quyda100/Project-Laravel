$(document).ready(function(){
    $("#register").click(function (e) { 
        e.preventDefault();
        var form = $('#contactForm').serialize()
        $.ajax({
            type: "POST",
            url: "api/registerApi",
            data: form,
            success: function (data) {
                $('.error-msg').html('');
                if(data==1){
                    cuteToast({
                        title: "Thông báo",
                        type: "success",
                        message: "Đăng ký thành công",
                        timer: 3000,
                    })
                    window.setTimeout(function () {
                        $('#contactForm').trigger('reset');
                        window.location.href = "/login";//chuyen huong trang "route" 
                    }, 1000);
                }
                else {
                    cuteToast({
                        title: "Thông báo",
                        type: "error",
                        message: "Đăng ký không thành công",
                        timer: 3000,
                    });
                    return;
                }
            },
            error : function(data){
                $('.error-msg').html('');
                    if(data.responseJSON.errors){
               $('.error-msg').css('display','block');
               $('.error-msg').css('text-align','left');
                $('#errorEmail').text(data.responseJSON.errors.email);
                $('#errorPassword').text(data.responseJSON.errors.password);
                $('#errorFullName').text(data.responseJSON.errors.FullName);
                $('#errorAddress').text(data.responseJSON.errors.Address);
                $('#errorPhone').text(data.responseJSON.errors.Phone);
            }
        }
        });
    });
});