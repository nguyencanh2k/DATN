@extends('layout')
@section('content')

<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Tags tìm kiếm: {{$product_tag}}</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="index.html">Home</a></li>
                        <li>Tags tìm kiếm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<!-- Shop Category Area End -->
<div class="shop-category-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Shop Top Area Start -->
                <div class="shop-top-bar">
                    <!-- Left Side start -->
                    <div class="shop-tab nav mb-res-sm-15">
                        <a class="active" href="#shop-1" data-toggle="tab">
                            <i class="fa fa-th show_grid"></i>
                        </a>
                        <a href="#shop-2" data-toggle="tab">
                            <i class="fa fa-list-ul"></i>
                        </a>
                        <p>There Are 17 Products.</p>
                    </div>
                    <!-- Left Side End -->
                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap">
                        <div class="shot-product">
                            <p>Sort By:</p>
                        </div>
                        <div class="shop-select">
                            <select>
                                <option value="">Sort by newness</option>
                                <option value="">A to Z</option>
                                <option value=""> Z to A</option>
                                <option value="">In stock</option>
                            </select>
                        </div>
                    </div>
                    <!-- Right Side End -->
                </div>
                <!-- Shop Top Area End -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area mt-35">
                    <!-- Shop Tab Content Start -->
                    <div class="tab-content jump">
                        <!-- Tab One Start -->
                        <div id="shop-1" class="tab-pane active">
                            <div class="row">
                                @foreach($pro_tag as $key => $product)
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <article class="list-product">
                                        <form action="">
                                            @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                            <div class="img-block">
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="thumbnail">
                                                    <img class="first-img" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                    <img class="second-img" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                </a>
                                            </div>
                                            <ul class="product-flag">
                                                <li class="new">New</li>
                                            </ul>
                                            <div class="product-decs">
                                                <a class="inner-link" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}"><span>{{$product->product_name}}</span></a>
                                                {{-- <h2><a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="product-link">{{$product->product_content}}</a></h2> --}}
                                                <div class="rating-product">
                                                    <i class="ion-android-star"></i>
                                                    <i class="ion-android-star"></i>
                                                    <i class="ion-android-star"></i>
                                                    <i class="ion-android-star"></i>
                                                    <i class="ion-android-star"></i>
                                                </div>
                                                <div class="pricing-meta">
                                                    <ul>
                                                        {{-- <li class="old-price">{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</li> --}}
                                                        <li class="current-price">{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</li>
                                                        <li class="discount-price">-5%</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="add-to-link">
                                                <ul>
                                                    <li class="cart"><a class="cart-btn add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm vào giỏ hàng </a></li>
                                                    <li>
                                                        <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </article>
                                </div>
                                @endforeach
                        </div>
                        <!-- Tab Two End -->
                    </div>
                    <!-- Shop Tab Content End -->
                    <!--  Pagination Area Start -->
                    <div class="pro-pagination-style text-center">
                        <ul>
                            <li>
                                <a class="prev" href="#"><i class="ion-ios-arrow-left"></i></a>
                            </li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li>
                                <a class="next" href="#"><i class="ion-ios-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!--  Pagination Area End -->
                </div>
                <!-- Shop Bottom Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Category Area End -->
@endsection