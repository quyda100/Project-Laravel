$(document).ready(function () {
    function getCart(){
        $('#getCarts').html('');
        $.ajax({
            type: "GET",
            url: "../api/carts",
            dataType: "JSON",
            success: function (response) {
                if(response.carts.length>0){
                    $.each(response.carts, function (indexInArray, items) { 
                         $('#getCarts').append(
                            '<tr>'+
                                '<td>'+
                                    '<div class="media">'+
                                       '<div class="d-flex">'+
                                            '<img style="width:100px" src="../img/product/'+items.ProductImage+'" alt="">'+
                                        '</div>'+
                                        '<div class="media-body">'+
                                            '<p>'+items.Name+'</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</td>'+
                               ' <td>'+
                                    '<h5>'+items.Price.toLocaleString('en-US')+'VND</h5>'+
                                '</td>'+
                               ' <td>'+
                                    '<div class="product_count">'+
                                        '<input type="text" name="qty" id="sst'+items.id+'" maxlength="12" value="'+items.quantity+'" title="Quantity:"'+
                                           ' class="input-text qty edit" data-idcart="'+items.cartId+'">'+
                                        '<button click="" data-id="'+items.cartId+'"'+
                                            'class="increase items-count plush" type="button"><i class="lnr lnr-chevron-up"></i></button>'+
                                        '<button click="" data-id="'+items.cartId+'"'+
                                            'class="reduced items-count minus" type="button"><i class="lnr lnr-chevron-down"></i></button>'+
                                    '</div>'+
                                '</td>'+
                               '<td>'+
                                    '<h5>'+(items.total).toLocaleString('en-US')+ 'VND</h5>'+
                                '</td>'+
                                '<td style="width:15%">'+
                                /* '<a data-id="'+items.id+'" class = "btn btn-warning edit">Sửa</a>   '+ */
                                '<button data-id="'+items.cartId+'" class= "btn btn-danger delete">Xóa</button>'+
                                '</td>'+
                            '</tr>'
                            //'<p>Sản phẩm này của bạn đã hết hàng vui lòng xóa sản phẩm để tiếp tục thanh toán</p>'
                         );
                    });
                }
                $('#getCarts').append(
                    '<tr class="bottom_button">'+
                                '<td id="deleteall"></td>'+
                                '<td></td>'+
                                '<td> </td>'+
                                '<td>'+
                                    '<div class="cupon_text d-flex align-items-center">'+
                                        '<input type="text" placeholder="Coupon Code">'+
                                        '<a class="primary-btn" href="#">Apply</a>'+
                                        '<a class="gray_btn" href="#">Close Coupon</a>'+
                                    '</div>'+
                                '</td>'+
                                '<td></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td></td>'+
                                '<td></td>'+
                                '<td>'+
                                    '<h5>Subtotal</h5>'+
                                '</td>'+
                                '<td id="total">'+
                                '</td>'+
                           ' </tr>'+
                           '<tr class="out_button_area">'+
                           '<td></td>'+
                           '<td></td>'+
                           '<td></td>'+
                           '<td>'+
                               '<div class="checkout_btn_inner d-flex align-items-center">'+
                                   '<a class="gray_btn" href="../products">Tiếp tục mua hàng</a>'+
                               '</div>'+
                           '</td>'+
                       '</tr>'
                   );
                if(response.total>0){
                    $('#total').html('<h5>'+response.total.toLocaleString('en-US')+' VND</h5>');
                    $('.checkout_btn_inner').append(
                        '<a class="primary-btn" href="../user/checkout">Thanh toán</a>'
                    );
                    $('#deleteall').append('<button id="deleteAll" class="btn gray_btn">Xóa tất cả</button>');
                }
            }
        });
    }
    getCart();
    $(document).on('click','.plush',function() { 
        var id = $(this).data('id');
        var result = $('#sst'+ id).val();
        result++;
        $('#sst' + id).attr('value',result);
        return false;
    });
    $(document).on('click','.minus',function() { 
        var id = $(this).data('id');
        var result = $('#sst'+id).val(); 
        if(result <= 1 ) 
            return false;
        else{    
            result--;
            $('#sst'+id).attr('value',result);
        }
        
    });
    $(document).on('change','.edit',function(){
        var quantity = $(this).val();
        var id = $(this).data('idcart');
        $.ajax({
            type: "PUT",
            url: "../api/carts/" + id,
            data: {quantity : quantity,id:id},
            dataType: "JSON",
            success: function (response){
                console.log(response);
                if(response==1){
                    getCart();
                    cuteToast({
                        title: "Thông báo",
                        type: "success",
                        message: "Cập nhật giỏ hàng thành công",
                        timer: 3000,
                    })}
                else if(response == -2){
                    getCart();
                    cuteToast({
                    title: "Thông báo",
                    type: "error",
                    message: "Số lượng không được là số âm",
                    timer: 3000,
                })
            }else if(response ==-3){
                getCart();
                cuteToast({
                title: "Thông báo",
                type: "error",
                message: "Quá số lượng tồn kho",
                timer: 3000,
            })
            }
            else if(response==-1){
                cuteToast({
                title: "Thông báo",
                type: "error",
                message: "Sản phẩm hết hàng",
                timer: 3000,
            })
            }else{
                getCart();
                cuteToast({
                    title: "Thông báo",
                    type: "error",
                    message: "Nhập sai cấu trúc",
                    timer: 3000,
                })
            }
            }});  
    });
    $(document).on('click','#deleteAll',function(){
        var result =confirm('Bạn có chắc muốn xóa không ?');
        if(result){
            $.ajax({
                type: "POST",
                url: "../api/deleteAll",
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if(response==1){
                        getCart();
                        cuteToast({
                            title: "Thông báo",
                            type: "success",
                            message: "Xóa giỏ hàng thành công",
                            timer: 3000,
                        });
                    }
                    else{
                        cuteToast({
                            title: "Thông báo",
                            type: "error",
                            message: "Lỗi không xác định",
                            timer: 3000,
                        });
                    }
                }
            });
        }
    });
    $(document).on('click','.delete',function(){
        var result = confirm("Bạn có chắc muốn xóa không ? ");
        if(result){
            var id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                url: "../api/carts/" + id,
                data: {id : id},
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if(response==1){
                        getCart();
                        cuteToast({
                            title: "Thông báo",
                            type: "success",
                            message: "Xóa sản phẩm thành công",
                            timer: 3000,
                        });
                    }else{
                        cuteToast({
                            title: "Thông báo",
                            type: "error",
                            message: "Lỗi không xác định",
                            timer: 3000,
                        });
                    }
                }
            });
        }
    });
});