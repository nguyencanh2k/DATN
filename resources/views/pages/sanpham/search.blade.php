@extends('layout')
@section('content')

<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Kết quả tìm kiếm: {{$keywords}}</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="index.html">Home</a></li>
                        <li>Tìm kiếm</li>
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
                {{-- <div class="shop-top-bar">
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
                            <p>Sắp xếp theo</p>
                        </div>
                        <div class="shop-select">
                            <form>
                                @csrf
                                <select name="sort" id="sort" class="form-control">
                                    <option value="{{Request::url()}}?sort_by=none">---Lọc---</option>
                                    <option value="{{Request::url()}}?sort_by=tang_dan">---Giá tăng dần---</option>
                                    <option value="{{Request::url()}}?sort_by=giam_dan">---Giá giảm dần---</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_az">A đến Z</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_za">Z đến A</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <!-- Right Side End -->
                </div> --}}
                <!-- Shop Top Area End -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area mt-35">
                    <!-- Shop Tab Content Start -->
                    <div class="tab-content jump">
                        <!-- Tab One Start -->
                        <div id="shop-1" class="tab-pane active">
                            <div class="row">
                                @foreach($search_product as $key => $product)
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
                                            <div class="product-decs">
                                                <a class="inner-link  prd-name-hidden" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}"><span>{{$product->product_name}}</span></a>
                                                {{-- <h2><a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="product-link">{{$product->product_content}}</a></h2> --}}
                                                <div class="pricing-meta">
                                                    <ul>
                                                        {{-- <li class="old-price">{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</li> --}}
                                                        <li class="current-price">{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="add-to-link">
                                                <ul>
                                                    <li class="cart"><a class="cart-btn add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm vào giỏ hàng </a></li>
                                                    <li>
                                                        <a href=""><i class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="ion-ios-shuffle-strong"></i></a>
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
                    {{ $search_product->links('pages.include.my_paginate') }}
                    <!--  Pagination Area End -->
                </div>
                <!-- Shop Bottom Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Category Area End -->
@endsection