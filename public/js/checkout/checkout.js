$(document).ready(function () {
    function getOrder(){
        $.ajax({
            type: "GET",
            url: "../api/getInFo",
            dataType: "JSON",
            success: function (response) {
                if(response==-2) {
                    window.setTimeout(function () {
                        window.location.href="../user/cart";
                    }, 1000);
                    cuteToast({
                        title: "Thông báo",
                        type: "error",
                        message: "Bạn chưa có sản phẩm trong giỏ hàng",
                        timer: 3000,
                    })
                }else{
                if(response.user!=null){
                    $('#FullName').val(response.user.FullName);
                    $('#Phone').val(response.user.Phone);
                    $('#Email').val(response.user.Email);
                    $('#Address').val(response.user.Address);
                }
                if(response.total!=null){
                    $('#Subtotal span').html(response.total.toLocaleString('en-US') + ' VND');
                    $('#shipping span').html('50,000 VND');
                    $('#total span').html((response.total+50000).toLocaleString('en-US')+ 'VND');
                }
            }
            }
        });
    }
    $(document).on('click','#checkout',function(){
        var form = $('#formCheckout').serialize();
        $.ajax({
            type: "POST",
            url: "../api/orders",
            data: form,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if(response==-2){
                    window.setTimeout(function () {
                        window.location.href="../user/cart";
                    }, 1000);
                    cuteToast({
                        title: "Thông báo",
                        type: "error",
                        message: "Bạn chưa có sản phẩm trong giỏ hàng",
                        timer: 3000,
                    })
                }else{
                $('.error-msg').html('');
                if(response==1){
                    cuteToast({
                        title: "Thông báo",
                        type: "success",
                        message: "Thanh toán thành công",
                        timer: 3000,
                    })
                }
            }
            },
            error: function(e){
                $('.error-msg').html('');
                if(e.responseJSON.errors){
                    $('#errorFullName').html(e.responseJSON.errors.FullName);
                    $('#errorPhone').html(e.responseJSON.errors.Phone);
                    $('#errorAddress').html(e.responseJSON.errors.Address);
                }
                console.log(e);
            }
        });
    });
    getOrder();
});