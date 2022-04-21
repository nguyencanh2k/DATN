@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    @foreach($category_name as $key => $name)
                    <h1 class="breadcrumb-hrading">{{$name->category_name}}</h1>
                    @endforeach
                    <ul class="breadcrumb-links">
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        <li>Danh mục</li>
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
            <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
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
                </div>
                <!-- Shop Top Area End -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area mt-35">
                    <!-- Shop Tab Content Start -->
                    <div class="tab-content jump">
                        <!-- Tab One Start -->
                        <div id="shop-1" class="tab-pane active">
                            <div class="row">
                                @foreach($category_by_id as $key => $product)
                                <div class="col-xl-3 col-md-6 col-lg-4 col-sm-6 col-xs-12">
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
                                                <li class="cart"><a class="cart-btn add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">ADD TO CART </a></li>
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
                        </div>
                        <!-- Tab One End -->
                    </div>
                    <!-- Shop Tab Content End -->
                    <!--  Pagination Area Start -->
                    <div class="pro-pagination-style text-center">
                        <ul>
                            {{-- {{$category_by_id->links()}} --}}
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
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 order-lg-first col-md-12 order-md-last mb-res-md-60px mb-res-sm-60px">
                <div class="left-sidebar">
                    <div class="sidebar-heading">
                        <div class="main-heading">
                            <h2>Filter By</h2>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title">Lọc danh mục</h4>
                            <div class="sidebar-widget-list">
                                <ul>
                                    @php
                                        $category_id = [];
                                        $category_arr = [];
                                        if(isset($_GET['cate'])){
                                            $category_id = $_GET['cate'];
                                        }else{
                                            $category_id = $name->category_id.",";
                                        }
                                        $category_arr = explode(",", $category_id);
                                    @endphp
                                    @foreach ($category as $key => $cate)
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" {{in_array($cate->category_id, $category_arr) ? 'checked' : ''}} class="category-filter" data-filters="category" 
                                            value="{{$cate->category_id}}" name="category-filter"/> <a href="#">{{$cate->category_name}}</a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                    </div>
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget mt-20">
                        <h4 class="pro-sidebar-title">Price</h4>
                        <div class="price-filter mt-10">
                            <form action="">
                            <div class="price-slider-amount">
                                <input type="text" id="amount" class="w-100" placeholder="Add Your Price" />
                                <input type="hidden" id="start_price" name="start_price"/>
                                <input type="hidden" id="end_price" name="end_price"/>
                            </div>
                            <div id="slider-range"></div>
                            <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-success" />
                            </form>
                        </div>
                    </div>
                    {{-- <div class="sidebar-widget mt-30">
                        <h4 class="pro-sidebar-title">Brand</h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" /> <a href="#">Studio Design<span>(10)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- Sidebar Area End -->
        </div>
    </div>
</div>
<!-- Shop Category Area End -->
@endsection
