<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        {{-- <title>Watch Store</title> --}}
        <title>{{$meta_title}}</title>
        <!---------Seo--------->
        <meta name="description" content="{{$meta_desc}}">
        <meta name="keywords" content="{{$meta_keywords}}"/>
        <meta name="robots" content="INDEX,FOLLOW"/>
        <link  rel="canonical" href="{{$url_canonical}}" />
        <meta name="author" content="">
        <link  rel="icon" type="image/x-icon" href="" />

        {{-- <meta property="og:image" content="{{$image_og}}" />   --}}
        <meta property="og:site_name" content="http://localhost:8080/DATN/" />
        <meta property="og:description" content="{{$meta_desc}}" />
        <meta property="og:title" content="{{$meta_title}}" />
        <meta property="og:url" content="{{$url_canonical}}" />
        <meta property="og:type" content="website" />
        
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{('public/frontend/images/favicon/favicon.png')}}" />

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800&display=swap" rel="stylesheet" />
        <!-- All CSS Flies   -->
        <!--===== Vendor CSS (Bootstrap & Icon Font) =====-->
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/font-awesome.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/ionicons.min.css')}}" />
        <!--===== Plugins CSS (All Plugins Files) =====-->
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/jquery-ui.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/meanmenu.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/nice-select.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/owl-carousel.css')}}" />
        <link rel="stylesheet" href="{{asset('public/frontend/css/plugins/slick.css')}}" />
        <!--===== Main Css Files =====-->
        <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}" />
        <!-- ===== Responsive Css Files ===== -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}" />

        <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->

        <!-- <link rel="stylesheet" href="{{asset('public/frontend/css/vendor/plugins.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontend/css/style.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.min.css')}}"> -->
        <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    </head>

    <body>
        <!-- main layout start from here -->
        <!--====== PRELOADER PART START ======-->

        <!-- <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div> -->

        <!--====== PRELOADER PART ENDS ======-->
        <div id="main">
            <!-- Header Start -->
            <header class="main-header">
                <!-- Header Top Start -->
                <div class="header-top-nav">
                    <div class="container-fluid">
                        <div class="row">
                            <!--Left Start-->
                            <div class="col-lg-4 col-md-4">
                                <div class="left-text">
                                    <p>Chào mừng bạn đến với Watch store!</p>
                                </div>
                            </div>
                            <!--Left End-->
                            <!--Right Start-->
                            <div class="col-lg-8 col-md-8 text-right">
                                <div class="header-right-nav">
                                    <ul class="res-xs-flex">
                                        <li class="after-n">
                                            <a href="compare.html"><i class="ion-ios-shuffle-strong"></i>So sánh (0)</a>
                                        </li>
                                        <li>
                                            <a href="wishlist.html"><i class="ion-android-favorite-outline"></i>Yêu thích (0)</a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-navs">
                                        <ul>
                                            <!-- Settings Start -->
                                            <li class="dropdown xs-after-n">
                                                <a class="angle-icon" href="#">Cài đặt</a>
                                                <ul class="dropdown-nav">
                                                    <li><a href="{{URL::to('/login-checkout')}}">Tài khoản</a></li>
                                                    <?php
                                                        $customer_id = Session::get('customer_id');
                                                        $shipping_id = Session::get('shipping_id');
                                                        if($customer_id!=NULL && $shipping_id==NULL){ 
                                                    ?>
                                                        <li><a href="{{URL::to('/checkout')}}">Thanh toán</a></li>
                                                    <?php 
                                                        }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                                    ?>
                                                        <li><a href="{{URL::to('/payment')}}">Thanh toán</a></li>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <li><a href="{{URL::to('/checkout')}}">Thanh toán</a></li>
                                                    <?php 
                                                        }
                                                    ?>

                                                    
                                                    <?php
                                                        $customer_id = Session::get('customer_id');
                                                        if($customer_id!=NULL){ 
                                                    ?>
                                                        <li><a href="{{URL::to('/logout-checkout')}}">Đăng xuất</a></li>
                                                    <?php 
                                                        }else{
                                                    ?>
                                                        <li><a href="{{URL::to('/login-checkout')}}">Đăng nhập</a></li>
                                                    <?php
                                                        } 
                                                    ?>
                                                </ul>
                                            </li>
                                            <!-- Settings End -->
                                            <!-- Currency Start -->
                                            <li class="top-10px first-child">
                                                <select>
                                                    <option value="1">USD $</option>
                                                    <option value="2">EUR €</option>
                                                </select>
                                            </li>
                                            <!-- Currency End -->
                                            <!-- Language Start -->
                                            <li class="top-10px mr-15px">
                                                <select>
                                                    <option value="1">English</option>
                                                    <option value="2">France</option>
                                                </select>
                                            </li>
                                            <!-- Language End -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--Right End-->
                        </div>
                    </div>
                </div>
                <!-- Header Top End -->
                <!-- Header Buttom Start -->
                <div class="header-navigation sticky-nav">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Logo Start -->
                            <div class="col-md-2 col-sm-2">
                                <div class="logo">
                                    <a href="{{URL::to('/trang-chu')}}"><img src="{{asset('public/frontend/images/logo/logo.png')}}" alt="logo.jpg" /></a>
                                </div>
                            </div>
                            <!-- Logo End -->
                            <!-- Navigation Start -->
                            <div class="col-md-10 col-sm-10">
                                <!--Main Navigation Start -->
                                <div class="main-navigation d-none d-lg-block">
                                    <ul>
                                        <li class="menu-dropdown">
                                            <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                                        </li>
                                        <li class="menu-dropdown">
                                            <a href="#">Danh mục <i class="ion-ios-arrow-down"></i></a>
                                            <ul class="mega-menu-wrap">
                                                <li>
                                                    <ul>
                                                        @foreach($category as $key => $cate)
                                                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-dropdown">
                                            <a href="#">Thương hiệu <i class="ion-ios-arrow-down"></i></a>
                                            <ul class="mega-menu-wrap">
                                                <li>
                                                    <ul>
                                                        @foreach($brand as $key => $brand)
                                                            <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">{{$brand->brand_name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-dropdown">
                                            <a href="#">Blog</a>
                                            <ul class="mega-menu-wrap">
                                                <li>
                                                    <ul>
                                                        @foreach($category_post as $key => $danhmucbaiviet)
                                                            <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                    </ul>
                                </div>
                                <!--Main Navigation End -->
                                <!--Header Bottom Account Start -->
                                <div class="header_account_area">
                                    <!--Seach Area Start -->
                                    <div class="header_account_list search_list">
                                        <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                                        <div class="dropdown_search">
                                            <form action="{{URL::to('/tim-kiem')}}" method="post">
                                                {{ csrf_field() }}
                                                <input name="keywords_submit" placeholder="Search entire store here ..." type="text" />
                                                <button name="search_items" type="submit"><i class="ion-ios-search-strong"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <!--Seach Area End -->
                                    <!--Contact info Start -->
                                    <div class="contact-link">
                                        <div class="phone">
                                            <p>Hotline:</p>
                                            <a href="tel:(+800)345678">(+012)3456789</a>
                                        </div>
                                    </div>
                                    <!--Contact info End -->
                                    <!--Cart info Start -->
                                    <div class="cart-info d-flex">
                                        <div class="mini-cart-warp">
                                            <a href="#" class="count-cart"><span>$20.00</span></a>
                                            <div class="mini-cart-content">
                                                <ul>
                                                    <li class="single-shopping-cart">
                                                        <div class="shopping-cart-img">
                                                            <a href="single-product.html"><img alt="" src="{{asset('public/frontend/images/banner1.jpg')}}" /></a>
                                                            <span class="product-quantity">1x</span>
                                                        </div>
                                                        <div class="shopping-cart-title">
                                                            <h4><a href="single-product.html">Juicy Couture...</a></h4>
                                                            <span>$9.00</span>
                                                            <div class="shopping-cart-delete">
                                                                <a href="#"><i class="ion-android-cancel"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="single-shopping-cart">
                                                        <div class="shopping-cart-img">
                                                            <a href="single-product.html"><img alt="" src="{{asset('public/frontend/images/banner2.jpg')}}" /></a>
                                                            <span class="product-quantity">1x</span>
                                                        </div>
                                                        <div class="shopping-cart-title">
                                                            <h4><a href="single-product.html">Water and Wind...</a></h4>
                                                            <span>$11.00</span>
                                                            <div class="shopping-cart-delete">
                                                                <a href="#"><i class="ion-android-cancel"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="shopping-cart-total">
                                                    <h4>Subtotal : <span>$20.00</span></h4>
                                                    <h4>Shipping : <span>$7.00</span></h4>
                                                    <h4>Taxes : <span>$0.00</span></h4>
                                                    <h4 class="shop-total">Total : <span>$27.00</span></h4>
                                                </div>
                                                <div class="shopping-cart-btn text-center">
                                                    <a class="default-btn" href="{{URL::to('/gio-hang')}}">Xem giỏ hàng</a>
                                                </div>
                                                <div class="shopping-cart-btn text-center mt-2">
                                                    <a class="default-btn" href="{{URL::to('/show-checkout')}}">Thanh toán</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Cart info End -->
                                </div>
                            </div>
                        </div>
                        <!-- mobile menu -->
                        <div class="mobile-menu-area">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul class="menu-overflow">
                                        <li>
                                            <a href="index.html">Trang chủ</a>
                                        </li>
                                        <li>
                                            <a href="#">Danh mục</a>
                                            <ul>
                                                <li>
                                                    <a href="#">Thương hiệu</a>
                                                    <ul>
                                                        <li><a href="shop-3-column.html">Shop Grid 3 Column</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Blog</a>
                                            <ul>
                                                <li><a href="blog-grid-left-sidebar.html">Blog Grid Left Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- mobile menu end-->
                    </div>
                </div>
                <!--Header Bottom Account End -->
            </header>
            <!-- Header End -->
            
            @yield('content')
            <!-- Footer Area start -->
            <footer class="footer-area">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-4">
                                <!-- footer logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="{{asset('public/frontend/images/logo/footer-logo.png')}}" alt="" /></a>
                                </div>
                                <!-- footer logo -->
                                <div class="about-footer">
                                    <p class="text-info">Chào mừng bạn đến với Watch Store</p>
                                    <div class="need-help">
                                        <p class="phone-info">
                                            Cần giúp đỡ?
                                            <span>
                                                (+012) 345 6789 <br />
                                                (+012) 123 4567
                                            </span>
                                        </p>
                                    </div>
                                    <div class="social-info">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="ion-social-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-youtube"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-google"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-2 mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">Information</h4>
                                    <div class="footer-links">
                                        <ul>
                                            <li><a href="#">Delivery</a></li>
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="#">Secure Payment</a></li>
                                            <li><a href="contact.html">Contact Us</a></li>
                                            <li><a href="#">Sitemap</a></li>
                                            <li><a href="#">Stores</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-2 mt-res-md-50px mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">Custom Links</h4>
                                    <div class="footer-links">
                                        <ul>
                                            <li><a href="#">Legal Notice</a></li>
                                            <li><a href="#">Prices Drop</a></li>
                                            <li><a href="#">New Products</a></li>
                                            <li><a href="#">Best Sales</a></li>
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="my-account.html">My Account</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-4 mt-res-md-50px mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">Newsletter</h4>
                                    <div class="subscrib-text">
                                        <p>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</p>
                                    </div>
                                    <div id="mc_embed_signup" class="subscribe-form">
                                        <form
                                            id="mc-embedded-subscribe-form"
                                            class="validate"
                                            novalidate=""
                                            target="_blank"
                                            name="mc-embedded-subscribe-form"
                                            method="post"
                                            action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                                        >
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <input class="email" type="email" required="" placeholder="Enter your email here.." name="EMAIL" value="" />
                                                <div class="mc-news" aria-hidden="true" style="position: absolute; left: -5000px;">
                                                    <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" />
                                                </div>
                                                <div class="clear">
                                                    <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Sign Up" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="img_app">
                                        <a href="#"><img src="{{asset('public/frontend/images/icons/app_store.png')}}" alt="" /></a>
                                        <a href="#"><img src="{{asset('public/frontend/images/icons/google_play.png')}}" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                        </div>
                    </div>
                </div>
                <!--  Footer Bottom Area start -->
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <p class="copy-text">Copyright © <a href="#"> HasThemes</a>. All Rights Reserved</p>
                            </div>
                            <div class="col-md-6 col-lg-8">
                                <img class="payment-img" src="{{asset('public/frontend/images/icons/payment.png')}}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Footer Bottom Area End-->
            </footer>
            <!--  Footer Area End -->
        </div>

        <!-- Modal -->
        
        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="{{asset('public/frontend/images/product-image/organic/product-11.jpg')}}" alt="" />
                                    </div>
                                    <div id="pro-2" class="tab-pane fade">
                                        <img src="{{asset('public/frontend/images/product-image/organic/product-9.jpg')}}" alt="" />
                                    </div>
                                    <div id="pro-3" class="tab-pane fade">
                                        <img src="{{asset('public/frontend/images/product-image/organic/product-20.jpg')}}" alt="" />
                                    </div>
                                    <div id="pro-4" class="tab-pane fade">
                                        <img src="{{asset('public/frontend/images/product-image/organic/product-19.jpg')}}" alt="" />
                                    </div>
                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image End -->
                                <div class="quickview-wrap mt-15">
                                    <div class="quickview-slide-active owl-carousel nav owl-nav-style owl-nav-style-2" role="tablist">
                                        <a class="active" data-toggle="tab" href="#pro-1"><img src="{{asset('public/frontend/images/product-image/organic/product-11.jpg')}}" alt="" /></a>
                                        <a data-toggle="tab" href="#pro-2"><img src="{{asset('public/frontend/images/product-image/organic/product-9.jpg')}}" alt="" /></a>
                                        <a data-toggle="tab" href="#pro-3"><img src="{{asset('public/frontend/images/product-image/organic/product-20.jpg')}}" alt="" /></a>
                                        <a data-toggle="tab" href="#pro-4"><img src="{{asset('public/frontend/images/product-image/organic/product-19.jpg')}}" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <div class="product-details-content quickview-content">
                                    <h2>Originals Kaval Windbr</h2>
                                    <p class="reference">Reference:<span> demo_17</span></p>
                                    <div class="pro-details-rating-wrap">
                                        <div class="rating-product">
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                        </div>
                                        <span class="read-review"><a class="reviews" href="#">Read reviews (1)</a></span>
                                    </div>
                                    <div class="pricing-meta">
                                        <ul>
                                            <li class="old-price not-cut">€18.90</li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisic elit eiusm tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim venialo quis nostrud exercitation ullamco</p>
                                    <div class="pro-details-size-color">
                                        <div class="pro-details-color-wrap">
                                            <span>Color</span>
                                            <div class="pro-details-color-content">
                                                <ul>
                                                    <li class="blue"></li>
                                                    <li class="maroon active"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                        </div>
                                        <div class="pro-details-cart btn-hover">
                                            <a href="#"> + Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="pro-details-wish-com">
                                        <div class="pro-details-wishlist">
                                            <a href="#"><i class="ion-android-favorite-outline"></i>Add to wishlist</a>
                                        </div>
                                        <div class="pro-details-compare">
                                            <a href="#"><i class="ion-ios-shuffle-strong"></i>Add to compare</a>
                                        </div>
                                    </div>
                                    <div class="pro-details-social-info">
                                        <span>Share</span>
                                        <div class="social-info">
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="ion-social-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="ion-social-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="ion-social-google"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="ion-social-instagram"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Modal end -->

        <!-- Scripts to be loaded  -->
        <!-- JS
============================================ -->
        
        <!--====== Vendors js ======-->
        <script src="{{asset('public/frontend/js/vendor/jquery-3.5.1.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/vendor/modernizr-3.7.1.min.js')}}"></script>

        <!--====== Plugins js ======-->
        <script src="{{asset('public/frontend/js/plugins/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/popper.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/meanmenu.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/owl-carousel.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/jquery.nice-select.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/countdown.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/elevateZoom.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/jquery-ui.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/slick.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/scrollup.js')}}"></script>
        <script src="{{asset('public/frontend/js/plugins/range-script.js')}}"></script>

        <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->

        <!-- <script src="{{asset('public/frontend/js/plugins.min.js')}}"></script> -->

        <!-- Main Activation JS -->
        <script src="{{asset('public/frontend/js/main.js')}}"></script>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="imywgrxV"></script>

        <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.add-to-cart').click(function(){
    
                    var id = $(this).data('id_product');
                    // alert(id);
                    var cart_product_id = $('.cart_product_id_' + id).val();
                    var cart_product_name = $('.cart_product_name_' + id).val();
                    var cart_product_image = $('.cart_product_image_' + id).val();
                    var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                    var cart_product_price = $('.cart_product_price_' + id).val();
                    var cart_product_qty = $('.cart_product_qty_' + id).val();
                    var _token = $('input[name="_token"]').val();
                    if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                        alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                    }else{
                        $.ajax({
                            url: '{{url('/add-cart-ajax')}}',
                            method: 'POST',
                            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                            success:function(){
        
                                swal({
                                        title: "Đã thêm sản phẩm vào giỏ hàng",
                                        text: "Tiếp tục mua sắm",
                                        showCancelButton: true,
                                        cancelButtonText: "Xem tiếp",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "Đi đến giỏ hàng",
                                        closeOnConfirm: false
                                    },
                                    function() {
                                        window.location.href = "{{url('/gio-hang')}}";
                                    });
        
                            }
                        });
                    }
                });
            });
        </script>
        {{-- <script type="text/javascript">
            $(document).ready(function(){
                $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
               
                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url : '{{url('/select-delivery-home')}}',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                       $('#'+result).html(data);  
                    }
                });
            });
            });
              
        </script> --}}
        <script type="text/javascript">

            $(document).ready(function(){
              $('.send_order').click(function(){
                  swal({
                    title: "Xác nhận đơn hàng",
                    text: "Đơn hàng sẽ thực hiện sau khi xác nhận,bạn có muốn đặt không?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Cảm ơn, Mua hàng",
  
                      cancelButtonText: "Đóng,chưa mua",
                      closeOnConfirm: false,
                      closeOnCancel: false
                  },
                  function(isConfirm){
                       if (isConfirm) {
                          var shipping_email = $('.shipping_email').val();
                          var shipping_name = $('.shipping_name').val();
                          var shipping_address = $('.shipping_address').val();
                          var shipping_phone = $('.shipping_phone').val();
                          var shipping_notes = $('.shipping_notes').val();
                          var shipping_method = $('.payment_select').val();
                          var order_coupon = $('.order_coupon').val();
                          var _token = $('input[name="_token"]').val();
  
                          $.ajax({
                              url: '{{url('/confirm-order')}}',
                              method: 'POST',
                              data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_coupon:order_coupon,shipping_method:shipping_method},
                              success:function(){
                                 swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                              }
                          });
  
                          window.setTimeout(function(){ 
                              location.reload();
                          } ,3000);
  
                        } else {
                          swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
                        }
                  });
              });
          });
      </script>
    </body>
</html>
