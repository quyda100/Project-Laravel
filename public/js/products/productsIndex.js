$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "api/productIndex",
        dataType: "json",
        success: function (response) {
            var products =  response.products; 
            if(products.length  > 0){
               $.each(products, function (indexInArray, products) { 
                $('#products').append(
                    '<div class="col-lg-3 col-md-6">'
                    +'<a href="./products/'+products.SKU+'">'
                    +'<div class="single-product">'
                        +'<img class="img-fluid" src="img/product/'+products.ProductImage+'" alt="">'
                        +'<div class="product-details">'
                            +'<h6>'+products.Name+'</h6>'
                            +'<div class="price">'
                                +'<h6>'+products.Price.toLocaleString('en-US')+' VND</h6>'
                                +'<h6 class="l-through">'+(products.Price*1.1).toLocaleString('en-US') +' VND</h6>'
                            +'</div>'
                        +'</div>'
                    +'</div>'
                    +'</a>'
                +'</div>'
                );
               });
            }
        }
    });
})