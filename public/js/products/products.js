$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "api/products",
        dataType: "json",
        success: function (response) {
            if(response.length  > 0){
                response.forEach(element => {
                    $('#products').append(
                        '<div class="col-lg-3 col-md-6">'
                        +'<a href="./products/'+element.SKU+'">'
						+'<div class="single-product">'
							+'<img class="img-fluid" src="img/product/'+element.ProductImage+'" alt="">'
							+'<div class="product-details">'
								+'<h6>'+element.Name+'</h6>'
								+'<div class="price">'
									+'<h6>'+element.Price.toLocaleString('en-US')+' VND</h6>'
									+'<h6 class="l-through">'+(element.Price*1.1).toLocaleString('en-US') +' VND</h6>'
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