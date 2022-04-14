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
                                @foreach($category_by_id as $key => $product)
                                <div class="col-xl-3 col-md-6 col-lg-4 col-sm-6 col-xs-12">
                                    <article class="list-product">
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
                                            <h2><a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="product-link">{{$product->product_content}}</a></h2>
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
                                                <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                                                <li>
                                                    <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                                                </li>
                                                <li>
                                                    <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                                                </li>
                                            </ul>
                                        </div>
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
                            <h4 class="pro-sidebar-title">Categories</h4>
                            <div class="sidebar-widget-list">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" /> <a href="#">Fresh Fruit<span>(17)</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value="" /> <a href="#">Fresh Vegetables <span>(17)</span></a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value="" /> <a href="#">Fresh Salad & Dips<span>(17)</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value="" /> <a href="#">Milk,Butter & Eggs<span>(17)</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                    </div>
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget mt-20">
                        <h4 class="pro-sidebar-title">Price</h4>
                        <div class="price-filter mt-10">
                            <div class="price-slider-amount">
                                <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                            </div>
                            <div id="slider-range"></div>
                        </div>
                    </div>
                    <div class="sidebar-widget mt-30">
                        <h4 class="pro-sidebar-title">Brand</h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" /> <a href="#">Studio Design<span>(10)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">Graphic Corner<span>(7)</span></a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar Area End -->
        </div>
    </div>
</div>
<!-- Shop Category Area End -->
@endsection
