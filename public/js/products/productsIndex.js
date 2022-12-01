$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "api/products",
        dataType: "json",
        success: function (response) {
            var products =  response.products; 
            if(products.length  > 0){
                for(var  i = 0 ;i< 8; i++ ){
                    $('#products').append(
                        '<div class="col-lg-3 col-md-6">'
                        +'<a href="./products/'+products[i].SKU+'">'
						+'<div class="single-product">'
							+'<img class="img-fluid" src="img/product/'+products[i].ProductImage+'" alt="">'
							+'<div class="product-details">'
								+'<h6>'+products[i].Name+'</h6>'
								+'<div class="price">'
									+'<h6>'+products[i].Price.toLocaleString('en-US')+' VND</h6>'
									+'<h6 class="l-through">'+(products[i].Price*1.1).toLocaleString('en-US') +' VND</h6>'
								+'</div>'
							+'</div>'
						+'</div>'
                        +'</a>'
					+'</div>'
                    );
                }
            }
        }
    });
})