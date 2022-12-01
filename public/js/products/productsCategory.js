$(document).ready(function () {
    function getCategory(){
        $.ajax({
            type: "GET",
            url: "api/products",
            dataType: "JSON",
            success: function (response) {
                var categories = response.categories;
                if(categories.length > 0)
                {
                    $('.main-categories').append(
                        '<li class="main-nav-list category" data-category=0><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span'
                            + 'class="lnr lnr-arrow-right"></span>All<span class="number"></span></a>'
                    +'</li>'
                    );
                    $.each(response.categories, function (key, item) { 
                        $('.main-categories').append(
                            '<li class="main-nav-list category" data-category= '+ item.id+'><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span'
                                + 'class="lnr lnr-arrow-right"></span>'+item.name +'<span class="number"></span></a>'
                        +'</li>'
                        );
                    });
                   
                }
            }
        });
    }
    function getProducts(id=0,page = 1){
        $('.productList').html('');
        $.ajax({
            type: "GET",
            url: "api/product",
            data: {id : id, page:page},
            dataType: "Json",
            success: function (response) {
                if(response.products.length>0){
                    $.each(response.products, function (indexInArray, products) { 
                        $('.productList').append(
                            '<div class="col-lg-4 col-md-6">'
                            +'<div class="single-product">'
							+'<img class="img-fluid" src="img/product/'+products.ProductImage+'" alt="">'
							+'<div class="product-details">'
								+'<h6>'+products.Name+'</h6>'
                                    +'<div class="price">'
									+'<h6>'+products.Price.toLocaleString('en-US') +' VND</h6>'
									+'<h6 class="l-through">'+(products.Price*1.1).toLocaleString('en-US') +' VND</h6>'
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
                        );
                    });
                }
                
            }
        });
    };
    $(document).on('click','.pagination a',function(){
            var page = $(this).data('id');
            $('.pagination a').removeClass('active');
            $(this).addClass('active');
            console.log(page);
            getProducts(0,page);
    });
    $(document).on('click','.category',function(){
        var id = $(this).data('category');
        getProducts(id);
    });
    getProducts();
    getCategory();
   
})