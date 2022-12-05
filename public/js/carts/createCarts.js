$(document).ready(function () {
    $(document).on("click", '.addCart', function(){
        var id = $(this).data('idproduct');
        var session = $('#session').val();
        var quantity = 1;
        if(session=== undefined)
        {
            $(this).prop('href','/login');
            return;
        }else{
           createOrUpdateCart(id,quantity);
            //console.log(session);
        }
       
    });
    function createOrUpdateCart(id,quantity){
        $.ajax({
            type: "POST",
            url: "api/carts",
            data: {idProduct : id, quantity : quantity},
            dataType: "JSON",
            success: function (response) {
               if(response==1){
                cuteToast({
                    title: "Thông báo",
                    type: "success",
                    message: "Thêm vào giỏ hàng thành công",
                    timer: 3000,
                })
               }else if(response==-2){
                cuteToast({
                    title: "Thông báo",
                    type: "error",
                    message: "Sản phẩm đã hết hàng",
                    timer: 3000,
                })
               }
               else if(response==-3){
                cuteToast({
                    title: "Thông báo",
                    type: "error",
                    message: "Sản phẩm Không đủ số lượng",
                    timer: 3000,
                })
               }
               else{
                cuteToast({
                    title: "Thông báo",
                    type: "error",
                    message: "Thêm vào giỏ hàng không thành công",
                    timer: 3000,
                })
               }
            },
            error: function(e){
                console.log(e);
            }
        });
    }
});