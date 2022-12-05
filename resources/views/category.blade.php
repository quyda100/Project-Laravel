@extends('layouts.app')
@section('banner')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Fashon Category</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
@endsection
	
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-md-5">
			<div class="sidebar-categories">
				<div class="head">Browse Categories</div>
				<ul class="main-categories">
				</ul>
			</div>
			<div class="sidebar-filter mt-50">
				<div class="top-filter-head">Product Filters</div>
				<div class="common-filter">
					<div class="head">Size</div>
					<form action="#">
						<ul class="size">
							{{-- <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span></span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span></span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span></span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span></span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span></span></label></li>
						 --}}</ul>
					</form>
				</div>
				<div class="common-filter">
					<div class="head">Color</div>
					<form action="#">
						<ul class="color">
							{{-- <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
									Leather<span>(29)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
									with red<span>(19)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
						 --}}</ul>
					</form>
				</div>
				<div class="common-filter">
					<div class="head">Price</div>
					<div class="price-range-area">
						<div id="price-range"></div>
						<div class="value-wrapper d-flex">
							<div class="price">Price:</div>
							<span>$</span>
							<div id="lower-value"></div>
							<div class="to">to</div>
							<span>$</span>
							<div id="upper-value"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8 col-md-7">
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting">
					<select name="sort" id="sort">
						<option value="0">Giảm dần</option>
						<option value="1">Tăng dần</option>
					</select>
				</div>
				<div class="sorting mr-auto">
				
					<input id="search"  type="text" placeholder="Search.." name="search">
					<button id="btnSearch"class="btn btn-primary" type="submit">
                        <i class="fa fa-search"></i> Search
                    </button>
					
				</div>
				<div class="pagination">
					{{-- <a class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a> --}}
					{{-- <a data-id="1" class="active">1</a>
					<a data-id="2">2</a>
					<a data-id="3">3</a>
					<a class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<a data-id="4">6</a> --}}
					{{-- <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> --}}
					
				</div>
			</div>
			<!-- End Filter Bar -->
			<!-- Start Best Seller -->
			<section class="lattest-product-area pb-40 category-list">
				<div class="row productList">
					
				</div>
			</section>
			<!-- End Best Seller -->
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting mr-auto">
				</div>
				<div class="pagination">
					{{-- <a class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a> --}}
					{{-- <a data-id="1" class="active">1</a>
					<a data-id="2">2</a>
					<a data-id="3">3</a>
					<a class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<a data-id="4">6</a> --}}
					{{-- <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> --}}
				</div>
			</div>
			<!-- End Filter Bar -->
		</div>
	</div>
</div>
<script src="{{asset('js/products/search.js')}}"></script>
@endsection
@section('script')
<script src="{{asset('js/products/productsCategory.js')}}"></script>
@endsection