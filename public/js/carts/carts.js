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
                                /* '<a data-id="'+items.id+'" class = "btn btn-warning edit">S???a</a>   '+ */
                                '<button data-id="'+items.cartId+'" class= "btn btn-danger delete">X??a</button>'+
                                '</td>'+
                            '</tr>'
                            //'<p></p>'
                         );
                         if(items.quantity > items.Stock)
                         $('#getCarts').prepend('<td style="color:red">S???n ph???m kh??ng ????? s??? l?????ng vui l??ng ki???m tra ????? ti???p t???c thanh to??n</td>')
                            
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
                                    '<h5>T???ng ti???n</h5>'+
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
                                   '<a class="gray_btn" href="../products">Ti???p t???c mua h??ng</a>'+
                               '</div>'+
                           '</td>'+
                       '</tr>'
                   );
                if(response.total>0){
                    $('#total').html('<h5>'+response.total.toLocaleString('en-US')+' VND</h5>');
                    $('.checkout_btn_inner').append(
                        '<a class="primary-btn" href="../user/checkout">Thanh to??n</a>'
                    );
                    $('#deleteall').append('<button id="deleteAll" class="btn gray_btn">X??a t???t c???</button>');
                }
            }
        });
    }
    getCart();
    $(document).on('click','.plush',function() { 
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "../api/plush/" + id,
            data: {id:id},
            dataType: "JSON",
            success: function (response) {
                if(response==1){
                    getCart();
                    cuteToast({
                        title: "Th??ng b??o",
                        type: "success",
                        message: "C???p nh???t gi??? h??ng th??nh c??ng",
                        timer: 3000,
                    })
                }else if(response==-1){
                    cuteToast({
                        title: "Th??ng b??o",
                        type: "error",
                        message: "S??? l?????ng t???n kho kh??ng ?????",
                        timer: 3000,
                    })
                }else{
                    cuteToast({
                        title: "Th??ng b??o",
                        type: "error",
                        message: "L???i kh??ng x??c ?????nh",
                        timer: 3000,
                    })
                }
            }
        });
    });
    $(document).on('click','.minus',function() { 
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "../api/minus/" + id,
            data: {id:id},
            dataType: "JSON",
            success: function (response) {
                if(response==1){
                    getCart();
                    cuteToast({
                        title: "Th??ng b??o",
                        type: "success",
                        message: "C???p nh???t gi??? h??ng th??nh c??ng",
                        timer: 3000,
                    })
                }else if(response==-1){
                    cuteToast({
                        title: "Th??ng b??o",
                        type: "error",
                        message: "Kh??ng th??? th???c hi???n",
                        timer: 3000,
                    })
                }else{
                    cuteToast({
                        title: "Th??ng b??o",
                        type: "error",
                        message: "L???i kh??ng x??c ?????nh",
                        timer: 3000,
                    })
                }
            }
        });
        
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
                        title: "Th??ng b??o",
                        type: "success",
                        message: "C???p nh???t gi??? h??ng th??nh c??ng",
                        timer: 3000,
                    })}
                else if(response == -2){
                    getCart();
                    cuteToast({
                    title: "Th??ng b??o",
                    type: "error",
                    message: "S??? l?????ng kh??ng ???????c l?? s??? ??m",
                    timer: 3000,
                })
            }else if(response ==-3){
                getCart();
                cuteToast({
                title: "Th??ng b??o",
                type: "error",
                message: "Qu?? s??? l?????ng t???n kho",
                timer: 3000,
            })
            }
            else if(response==-1){
                cuteToast({
                title: "Th??ng b??o",
                type: "error",
                message: "S???n ph???m h???t h??ng",
                timer: 3000,
            })
            }else{
                getCart();
                cuteToast({
                    title: "Th??ng b??o",
                    type: "error",
                    message: "Nh???p sai c???u tr??c",
                    timer: 3000,
                })
            }
            }});  
    });
    $(document).on('click','#deleteAll',function(){
        var result =confirm('B???n c?? ch???c mu???n x??a kh??ng ?');
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
                            title: "Th??ng b??o",
                            type: "success",
                            message: "X??a gi??? h??ng th??nh c??ng",
                            timer: 3000,
                        });
                    }
                    else{
                        cuteToast({
                            title: "Th??ng b??o",
                            type: "error",
                            message: "L???i kh??ng x??c ?????nh",
                            timer: 3000,
                        });
                    }
                }
            });
        }
    });
    $(document).on('click','.delete',function(){
        var result = confirm("B???n c?? ch???c mu???n x??a kh??ng ? ");
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
                            title: "Th??ng b??o",
                            type: "success",
                            message: "X??a s???n ph???m th??nh c??ng",
                            timer: 3000,
                        });
                    }else{
                        cuteToast({
                            title: "Th??ng b??o",
                            type: "error",
                            message: "L???i kh??ng x??c ?????nh",
                            timer: 3000,
                        });
                    }
                }
            });
        }
    });
});