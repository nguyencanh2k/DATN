@extends('layout')
@section('slider')
    @include('pages.include.slider');
@endsection
@section('content')
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
                            <h4>Giao hàng siêu tốc</h4>
                            <p>Nhận hàng trong vòng 1 - 2 ngày</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0 pt-res-xs-20">
                        <img src="{{asset('public/frontend/images/icons/static-icons-2.png')}}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Đổi trả miễn phí</h4>
                            <p>Trả hàng miễn phí trong vòng 7 ngày kể từ khi nhận hàng</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pt-res-md-30 pb-res-sm-30 pb-res-xs-0 pt-res-xs-20">
                        <img src="{{asset('public/frontend/images/icons/static-icons-3.png')}}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Thanh toán an toàn</h4>
                            <p>Thanh toán của bạn luôn được bảo mật</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pt-res-md-30 pb-res-sm-30 pt-res-xs-20">
                        <img src="{{asset('public/frontend/images/icons/static-icons-4.png')}}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Hỗ trợ 24/7</h4>
                            <p>Đội ngũ tư vấn viên 24/7</p>
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
                                <h2>Sản phẩm mới nhất</h2>
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
                                <input type="hidden" value="{{$product->product_content}}">
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
                                <div class="product-decs">
                                    <h2><a class="product-link prd-name-hidden" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}"><span>{{$product->product_name}}</span></a></h2>
                                    <div class="pricing-meta">
                                        <ul>
                                            <li class="current-price">{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li class="cart"><a class="cart-btn add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm vào giỏ hàng </a></li>
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
            <!-- Banner Area 2 Start -->
            <div class="banner-area-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="banner-inner">
                                <a href=""><img src="{{asset('public/frontend/images/banner-area-2.png')}}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Area 2 End -->
            <!-- Category Tab Area Start -->
            <section class="category-tab-area sub-category-owl-nav mt-30">
                <div class="container">
                    <div class="section-title">
                        <h2>Danh mục sản phẩm</h2>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs sub-category mb-30px">
                                @php
                                    $i=0;
                                @endphp
                            @foreach ($cate_pro_tabs as $key => $cat_tabs)
                                @php
                                    $i++;
                                @endphp
                            <li style="cursor: pointer;" data-id="{{$cat_tabs->category_id}}" class="nav-item tabs_pro {{$i==1 ? 'active' : ''}}">
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
                                        <a><img src="{{asset('public/frontend/images/banner-area-3.png')}}" alt="" /></a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 mt-res-sm-90 mt-res-sm-60 mt-res-sm-60">                                   
                                    <div id="tabs_product"></div>
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
                                <a href=""><img src="{{asset('public/frontend/images/banner-area-6.png')}}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 mt-res-sx-30px">
                            <div class="banner-wrapper">
                                <a href=""><img src="{{asset('public/frontend/images/banner-area-5.png')}}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 mt-res-sx-30px">
                            <div class="banner-wrapper">
                                <a href=""><img src="{{asset('public/frontend/images/banner-area-7.png')}}" alt="" /></a>
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
                                <h2>Sản phẩm giá rẻ</h2>
                            </div>
                            <!-- Section Title -->
                        </div>
                    </div>
                    <!-- Feature Slider Start -->
                    <div class="feature-slider owl-carousel owl-nav-style">
                        <!-- Single Item -->
                        @foreach($all_product2 as $key => $product2)
                        <div class="feature-slider-item">
                            <article class="list-product">
                                <form action="">
                                    @csrf
                                    <input type="hidden" value="{{$product2->product_id}}" class="cart_product_id_{{$product2->product_id}}">
                                    <input type="hidden" value="{{$product2->product_name}}" class="cart_product_name_{{$product2->product_id}}">
                                    <input type="hidden" value="{{$product2->product_image}}" class="cart_product_image_{{$product2->product_id}}">
                                    <input type="hidden" value="{{$product2->product_price}}" class="cart_product_price_{{$product2->product_id}}">
                                    <input type="hidden" value="{{$product2->product_quantity}}" class="cart_product_quantity_{{$product2->product_id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$product2->product_id}}">
                                <div class="img-block">
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.$product2->product_id)}}" class="thumbnail">
                                        <img class="first-img" src="{{URL::to('public/uploads/product/'.$product2->product_image)}}" alt="" />
                                        <img class="second-img" src="{{URL::to('public/uploads/product/'.$product2->product_image)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-decs">
                                    <h2><a class="product-link prd-name-hidden" href="{{URL::to('/chi-tiet-san-pham/'.$product2->product_id)}}"><span>{{$product2->product_name}}</span></a></h2>
                                    <div class="pricing-meta">
                                        <ul>
                                            <li class="old-price not-cut">{{number_format($product2->product_price,0,',','.').' '.'VNĐ'}}</li>
                                        </ul>
                                    </div>
                                </div>
                                </form>
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
                                <a href=""><img src="{{asset('public/frontend/images/banner-area-4.png')}}" alt="" /></a>
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
                                <h2>Sản phẩm phổ biến</h2>
                            </div>
                            <!-- Section Title -->
                        </div>
                    </div>
                    <!-- Recent Product slider Start -->
                    <div class="recent-product-slider owl-carousel owl-nav-style">
                        @foreach($all_product3 as $key => $product3)
                        <!-- Single Item -->
                        <article class="list-product">
                            <form action="">
                                @csrf
                                <input type="hidden" value="{{$product3->product_id}}" class="cart_product_id_{{$product3->product_id}}">
                                <input type="hidden" value="{{$product3->product_name}}" class="cart_product_name_{{$product3->product_id}}">
                                <input type="hidden" value="{{$product3->product_image}}" class="cart_product_image_{{$product3->product_id}}">
                                <input type="hidden" value="{{$product3->product_price}}" class="cart_product_price_{{$product3->product_id}}">
                                <input type="hidden" value="{{$product3->product_content}}">
                                <input type="hidden" value="{{$product3->product_quantity}}" class="cart_product_quantity_{{$product3->product_id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                <div class="img-block">
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.$product3->product_id)}}" class="thumbnail">
                                        <img class="first-img" src="{{URL::to('public/uploads/product/'.$product3->product_image)}}" alt="" />
                                        <img class="second-img" src="{{URL::to('public/uploads/product/'.$product3->product_image)}}" alt="" />
                                    </a>
                                    <div class="quick-view">
                                        <a class="quick_view xemnhanh" href="#" data-link-action="quickview" title="Quick view" data-id_product="{{$product3->product_id}}" data-toggle="modal" data-target="#exampleModal">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-decs">
                                    <h2><a class="product-link prd-name-hidden" href="{{URL::to('/chi-tiet-san-pham/'.$product3->product_id)}}"><span>{{$product3->product_name}}</span></a></h2>
                                    <div class="pricing-meta">
                                        <ul>
                                            <li class="current-price">{{number_format($product3->product_price,0,',','.').' '.'VNĐ'}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li class="cart"><a class="cart-btn add-to-cart" data-id_product="{{$product3->product_id}}" name="add-to-cart">Thêm vào giỏ hàng </a></li>
                                    </ul>
                                </div>
                            </form>
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