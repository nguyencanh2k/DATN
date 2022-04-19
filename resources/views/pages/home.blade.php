@extends('layout')
@section('content')
<!-- Slider Arae Start -->
<div class="slider-area">
    <div class="slider-active-3 owl-carousel slider-hm8 owl-dot-style">
        <!-- Slider Single Item Start -->
        @php 
            $i = 0;
        @endphp
        @foreach($slider as $key => $slide)
        @php 
            $i++;
        @endphp
        <div class="slider-height-6 d-flex align-items-start justify-content-start bg-img item {{$i==1 ? 'active' : '' }}" style="background-image: url({{asset('public/uploads/slider/'.$slide->slider_image)}}">
            <div class="container">
                <div class="slider-content-1 slider-animated-1 text-left">
                    <span class="animated">Máy cơ THỤY SĨ siêu mỏng</span>
                    <h1 class="animated">
                        Frederique <br />
                        Constant 2022
                    </h1>
                    <h1>{!!$slide->slider_desc!!}</h1>
                    <p class="animated">Hàng tuyển chọn rất kỹ</p>
                    {{-- <a href="#" class="shop-btn animated">Mua ngay</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Slider Arae End -->
<!-- Static Area Start -->
<section class="static-area mtb-60px">
    <div class="container">
        <div class="static-area-wrap">
            <div class="row">
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0">
                        <img src="{{asset('public/frontend/images/icons/static-icons-1.png')}}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Free Shipping</h4>
                            <p>On all orders over $75.00</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0 pt-res-xs-20">
                        <img src="{{asset('public/frontend/images/icons/static-icons-2.png')}}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Free Returns</h4>
                            <p>Returns are free within 9 days</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pt-res-md-30 pb-res-sm-30 pb-res-xs-0 pt-res-xs-20">
                        <img src="{{asset('public/frontend/images/icons/static-icons-3.png')}}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>100% Payment Secure</h4>
                            <p>Your payment are safe with us.</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pt-res-md-30 pb-res-sm-30 pt-res-xs-20">
                        <img src="{{asset('public/frontend/images/icons/static-icons-4.png')}}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Support 24/7</h4>
                            <p>Contact us 24 hours a day</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
            </div>
        </div>
    </div>
</section>
<!-- Static Area End -->
<!-- Best Sells Area Start -->
<section class="best-sells-area mb-30px">
                <div class="container">
                    <!-- Section Title Start -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>Sản phẩm mới</h2>
                                {{-- <p>Add bestselling products to weekly line up</p> --}}
                            </div>
                        </div>
                    </div>
                    <!-- Section Title End -->
                    <!-- Best Sell Slider Carousel Start -->
                    <div class="best-sell-slider owl-carousel owl-nav-style">
                        <!-- Single Item -->
                        @foreach($all_product as $key => $product)
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
                                    <div class="quick-view">
                                        <a class="quick_view xemnhanh" href="#" data-link-action="quickview" title="Quick view" data-id_product="{{$product->product_id}}" data-toggle="modal" data-target="#exampleModal">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <ul class="product-flag">
                                    <li class="new">New</li>
                                </ul>
                                <div class="product-decs">
                                    <a class="inner-link" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}"><span>{{$product->product_name}}</span></a>
                                    {{-- <h2><a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="product-link">{!!$product->product_content!!}</a></h2> --}}
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
                                            <a class="add-to-wishlist" data-id_product="{{$product->product_id}}" name="add-to-wishlist"><i class="ion-android-favorite-outline"></i></a>
                                        </li>
                                        <li>
                                            <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </article>
                        @endforeach
                        <!-- Single Item -->
                    </div>
                    <!-- Best Sells Carousel End -->
                </div>
            </section>
            <!-- Best Sells Slider End -->
            <!-- Banner Area Start -->
            <div class="banner-3-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-res-xs-30">
                            <div class="banner-wrapper">
                                <a href="{{URL::to('/danh-muc-san-pham/10')}}"><img src="{{asset('public/frontend/images/dong-ho-nam-trang-chu-1.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="banner-wrapper">
                                <a href="{{URL::to('/danh-muc-san-pham/11')}}"><img src="{{asset('public/frontend/images/dong-ho-nu-trang-chu-1.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-4">
                            <div class="banner-wrapper">
                                <a href="{{URL::to('/danh-muc-san-pham/12')}}"><img src="{{asset('public/frontend/images/dong-ho-co-trang-chu.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-4">
                            <div class="banner-wrapper">
                                <a href="{{URL::to('/danh-muc-san-pham/13')}}"><img src="{{asset('public/frontend/images/dong-ho-pin-trang-chu.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Area End -->
            <!-- Category Tab Area Start -->
            <section class="category-tab-area sub-category-owl-nav mt-30">
                <div class="container">
                    <div class="section-title">
                        <h2>Dong ho </h2>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs sub-category mb-30px">
                                @php
                                    $i=0;
                                @endphp
                            @foreach ($cate_pro_tabs as $key => $cat_tabs)
                                @php
                                    $i++;
                                @endphp
                            <li data-id="{{$cat_tabs->category_id}}" class="nav-item tabs_pro {{$i==1 ? 'active' : ''}}">
                                <a class="nav-link" data-toggle="tab" >{{$cat_tabs->category_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="feature" class="tab-pane active">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4">
                                    <div class="banner-wrapper">
                                        <a><img src="{{asset('public/frontend/images/banner-image/26.jpg')}}" alt="" /></a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 mt-res-sm-90 mt-res-sm-60 mt-res-sm-60">
                                    <div class="new-product-slider owl-carousel owl-nav-style" >
                                        <div id="tabs_product"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    
                </div>
            </section>
            <!-- Category Tab Area end -->
            <!-- Banner Area Start -->
            <div class="banner-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <div class="banner-wrapper">
                                <a href="shop-4-column.html"><img src="{{asset('public/frontend/images/dong-ho-co-thuy-sy.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 mt-res-sx-30px">
                            <div class="banner-wrapper">
                                <a href="shop-4-column.html"><img src="{{asset('public/frontend/images/SRWATCH-GALAXY-SG99993.4602GLA-version2-1.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 mt-res-sx-30px">
                            <div class="banner-wrapper">
                                <a href="shop-4-column.html"><img src="{{asset('public/frontend/images/Ogival-OG358.88AGR-GL.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Area End -->
            <!-- Feature Area Start -->
            <section class="feature-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Section Title -->
                            <div class="section-title">
                                <h2>Featured Products</h2>
                                <p>Add products to weekly line up</p>
                            </div>
                            <!-- Section Title -->
                        </div>
                    </div>
                    <!-- Feature Slider Start -->
                    <div class="feature-slider owl-carousel owl-nav-style">
                        <!-- Single Item -->
                        @foreach($all_product as $key => $product2)
                        <div class="feature-slider-item">
                            <article class="list-product">
                                <div class="img-block">
                                    <a href="single-product.html" class="thumbnail">
                                        <img class="first-img" src="{{URL::to('public/uploads/product/'.$product2->product_image)}}" alt="" />
                                        <img class="second-img" src="{{URL::to('public/uploads/product/'.$product2->product_image)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-decs">
                                    <a class="inner-link" href="shop-4-column.html"><span>{{$product2->product_name}}</span></a>
                                    {{-- <h2><a href="single-product.html" class="product-link">{!!$product2->product_content!!}</a></h2> --}}
                                    <div class="rating-product">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                    </div>
                                    <div class="pricing-meta">
                                        <ul>
                                            <li class="old-price not-cut">{{number_format($product2->product_price,0,',','.').' '.'VNĐ'}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                    <!-- Feature Slider End -->
                </div>
            </section>
            <!-- Feature Area End -->
            <!-- Banner Area 2 Start -->
            <div class="banner-area-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="banner-inner">
                                <a href="shop-4-column.html"><img src="{{asset('public/frontend/images/4.jpg')}}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Area 2 End -->
            <!-- Recent Add Product Area Start -->
            <section class="recent-add-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Section Title -->
                            <div class="section-title">
                                <h2>Recently Added</h2>
                                <p>Add products to weekly line up</p>
                            </div>
                            <!-- Section Title -->
                        </div>
                    </div>
                    <!-- Recent Product slider Start -->
                    <div class="recent-product-slider owl-carousel owl-nav-style">
                        @foreach($all_product3 as $key => $product3)
                        <!-- Single Item -->
                        <article class="list-product">
                            <div class="img-block">
                                <a href="{{URL::to('/chi-tiet-san-pham/'.$product3->product_id)}}" class="thumbnail">
                                    <img class="first-img" src="{{URL::to('public/uploads/product/'.$product3->product_image)}}" alt="" />
                                    <img class="second-img" src="{{URL::to('public/uploads/product/'.$product3->product_image)}}" alt="" />
                                </a>
                            </div>
                            <ul class="product-flag">
                                <li class="new">New</li>
                            </ul>
                            <div class="product-decs">
                                <a class="inner-link" href="{{URL::to('/chi-tiet-san-pham/'.$product3->product_id)}}"><span>{{$product3->product_name}}</span></a>
                                {{-- <h2><a href="{{URL::to('/chi-tiet-san-pham/'.$product3->product_id)}}" class="product-link">{!!$product3->product_content!!}</a></h2> --}}
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
                                        <li class="current-price">{{number_format($product3->product_price,0,',','.').' '.'VNĐ'}}</li>
                                        <li class="discount-price">-5%</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="add-to-link">
                                <ul>
                                    <li class="cart"><a class="cart-btn add-to-cart" data-id_product="{{$product3->product_id}}" name="add-to-cart">Thêm vào giỏ hàng </a></li>
                                    <li>
                                        <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                                    </li>
                                    <li>
                                        <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        @endforeach
                        <!-- Single Item -->
                        
                    </div>
                    <!-- Recent product slider end -->
                </div>
            </section>
            <!-- Recent product area end -->
            <!-- Brand area start -->
            <div class="brand-area">
                <div class="container">
                    <div class="brand-slider owl-carousel owl-nav-style owl-nav-style-2">
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-citizen-9.png')}}" alt="" /></a>
                        </div>
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-skagen.png')}}" alt="" /></a>
                        </div>
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-casio.png')}}" alt="" /></a>
                        </div>
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-dong-ho-olympia-star-1.png')}}" alt="" /></a>
                        </div>
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-daniel-wellington.png')}}" alt="" /></a>
                        </div>
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-orient-1.png')}}" alt="" /></a>
                        </div>
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-seiko.png')}}" alt="" /></a>
                        </div>
                        <div class="brand-slider-item">
                            <a href="#"><img src="{{asset('public/frontend/images/logo-tisot.png')}}" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Brand area end -->
@endsection