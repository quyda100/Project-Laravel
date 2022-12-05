$(document).ready(function () {
    function getCategory(){
        $("#sort").val(0);
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
    function getProducts(id=0,page = 1,order=0){
        $('.productList').html('');
        $.ajax({
            type: "GET",
            url: "api/product",
            data: {id : id, page:page, order:order},
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
                    var count = 1;
                    console.log(response.count);
                    $(".pagination").html('');
                    for(var i =0 ; i<response.count/9;i++){ 
                        if(i==page-1)
                        $(".pagination").append(
                            '<a data-id="'+count+'" class="page active">'+count+'</a>'
                        );
                        else
                        $(".pagination").append(
                            '<a data-id="'+count+'" class="page">'+count+'</a>'
                        );
                        
                        count++;
                     }
                }
                else{
                    $('.productList').css('justify-content','center');
                    $('.productList').html('<h4>Không Tìm Thấy Sản Phẩm</h4>');
                }
                
            }
        });
    };
    $(document).on('click','.page',function(){
            var page = $(this).data('id');
            var sort =$("#sort").val();
            $('.pagination a').removeClass('active');
            getProducts(0,page,sort);
    });
    $(document).on('click','.category',function(){
        var id = $(this).data('category');
        getProducts(id);
    });

    $("#sort").on('change', function(){
        var val= $(this).val();
        var page = $('.page').data('id');
        $("#sort").val(val);
        $('.pagination').html('');
        getProducts(0,page,val);

    })
    function getSize(){
        $.ajax({
            type: "GET",
            url: "api/options",
            dataType: "JSON",
            success: function (response) {
                if(response.size.length>0){
                $.each(response.size,function(key,item){
                    $('ul.size').append(
                        '<li class="filter-list"><input class="pixel-radio" data-idOption="'+item.id+'" type="radio" id="'+item.option_name+'" name="size"><label for="size">'+item.option_name+'<span></span></label></li>'
                    );
                });
            }
            if(response.color.length>0){
                $.each(response.color, function (indexInArray, item) { 
                     $('ul.color').append(
                        '<li class="filter-list"><input class="pixel-radio" data-idOption="'+item.id+'" type="radio" id="'+item.option_name+'" name="color"><label for="black">'+item.option_name+'<span></span></label></li>'
                     );
                });
            }
            }
        });
    }
    $(document).on("click",'.pixel-radio',function(){
        var id = $(this).data('idoption');
        $('.productList').html('');
        $('.productList').css('justify-content','unset');
        //$('.pagination a').html('');
        $.ajax({
            type: "GET",
            url: "api/productoptions" + '/'+ id,
            data: {id : id},
            dataType: "Json",
            success: function (response) {
                if(response.getSize.length>0){
                   $.each(response.getSize, function (indexInArray, products) { 
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
                else{
                    $('.productList').css('justify-content','center');
                    $('.productList').html('<h4>Không Tìm Thấy Sản Phẩm</h4>');
                }
            }
        });
    });
    getSize();
    getProducts();
    getCategory();
    $("#sort").val(0); 
});