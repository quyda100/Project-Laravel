
   $("#btnSearch").click(function() {
       var search = $("#search").val();
       $.ajax({
        type: "GET",
        url: "api/search",
        data: {
            searchSend:search,
        },
        
        success: function (response) {
            let html ="";
            $.each(response, function () { 
                // $('.productList').append(
                    html+='<div class="col-lg-4 col-md-6">'
                    +'<div class="single-product">'
                    +'<img class="img-fluid" src="img/product/'+response[0].ProductImage+'" alt="">'
                    +'<div class="product-details">'
                        +'<h6>'+response[0].Name+'</h6>'
                            +'<div class="price">'
                            +'<h6>'+response[0].Price.toLocaleString('en-US') +' VND</h6>'
                            +'<h6 class="l-through">'+(response[0].Price*1.1).toLocaleString('en-US') +' VND</h6>'
                            +'</div>'
                            +'<div class="prd-bottom">'

                            +'<a href="" class="social-info">'
                            +	'<span class="ti-bag"></span>'
                            +	'<p class="hover-text">add to bag</p>'
                            +'</a>'
                            +'<a href="" class="social-info">'
                            +	'<span class="lnr lnr-heart"></span>'
                            +	'<p class="hover-text">Wishlist</p>'
                            +'</a>'
                            +'<a href="" class="social-info">'
                            +	'<span class="lnr lnr-sync"></span>'
                            +	'<p class="hover-text">compare</p>'
                            +'</a>'
                            +'<a href="" class="social-info">'
                            +	'<span class="lnr lnr-move"></span>'
                            +	'<p class="hover-text">view more</p>'
                            +'</a>'
                            +'</div>'
                            +'</div>'
                            +'</div></div>'
            });
            $(".productList").html(html);
        }
       });
   });
