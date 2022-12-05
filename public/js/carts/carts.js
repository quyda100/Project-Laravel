$(document).ready(function () {
    function getCart(){
        $.ajax({
            type: "GET",
            url: "../api/carts",
            dataType: "JSON",
            success: function (response) {
                
                if(response.carts.length>0){
                    console.log(response);
                    $.each(response.carts, function (indexInArray, items) { 
                         $('#getCarts').prepend(
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
                                    '<h5>'+items.Price+'</h5>'+
                                '</td>'+
                               ' <td>'+
                                    '<div class="product_count">'+
                                        '<input type="text" name="qty" id="sst'+items.id+'" maxlength="12" value="'+items.quantity+'" title="Quantity:"'+
                                           ' class="input-text qty">'+
                                        '<button click="" data-id="'+items.id+'"'+
                                            'class="increase items-count plush" type="button"><i class="lnr lnr-chevron-up"></i></button>'+
                                        '<button click="" data-id="'+items.id+'"'+
                                            'class="reduced items-count minus" type="button"><i class="lnr lnr-chevron-down"></i></button>'+
                                    '</div>'+
                                '</td>'+
                               '<td>'+
                                    '<h5>'+items.Price*items.quantity+'</h5>'+
                                '</td>'+
                            '</tr>'
                         );
                    });
                   
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
        if(result > 0 ) 
            result--;
        $('#sst'+id).attr('value',result);
        return false;
    });
});