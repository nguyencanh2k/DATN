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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
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
                                    <p>Ch??o m???ng b???n ?????n v???i Watch store!</p>
                                </div>
                            </div>
                            <!--Left End-->
                            <!--Right Start-->
                            <div class="col-lg-8 col-md-8 text-right">
                                <div class="header-right-nav">
                                    <div class="dropdown-navs">
                                        <ul>
                                            <!-- Settings Start -->
                                            <li class="dropdown xs-after-n" style="height:24px; padding:13px 0;">
                                                <a class="angle-icon" href="#">C??i ?????t</a>
                                                <ul class="dropdown-nav">
                                                    <?php
                                                        $customer_id = Session::get('customer_id');
                                                        if($customer_id!=NULL){ 
                                                    ?>
                                                        <li><a href="{{URL::to('/chi-tiet-tai-khoan/'.$customer_id)}}">T??i kho???n</a></li>
                                                    <?php
                                                    } 
                                                    ?>

                                                    <li><a href="{{URL::to('/gio-hang')}}">Gi??? h??ng</a></li>
                                                    
                                                    <?php
                                                        $customer_id = Session::get('customer_id');
                                                        if($customer_id!=NULL){ 
                                                    ?>
                                                        <li  class="after-n"><a href="{{URL::to('/checkout')}}">Thanh to??n</a></li>
                                                    <?php 
                                                        }else{
                                                    ?>
                                                        <li  class="after-n"><a href="{{URL::to('/login-checkout')}}">Thanh to??n</a></li>
                                                    <?php 
                                                        }
                                                    ?>

                                                    <?php
                                                        $customer_id = Session::get('customer_id');
                                                        if($customer_id!=NULL){ 
                                                    ?>
                                                        <li><a href="{{URL::to('/history')}}">L???ch s??? ????n h??ng</a></li>
                                                    <?php
                                                    } 
                                                    ?>
                                                    
                                                </ul>
                                            </li>
                                            <!-- Settings End -->
                                        </ul>
                                    </div>
                                    <ul class="res-xs-flex">
                                        <?php
                                            $customer_id = Session::get('customer_id');
                                            if($customer_id!=NULL){ 
                                        ?>
                                            <li class="after-n"><a href="{{URL::to('/logout-checkout')}}">????ng xu???t</a></li>
                                        <?php 
                                            }else{
                                        ?>
                                            <li class="after-n"><a href="{{URL::to('/login-checkout')}}">????ng nh???p</a></li>
                                        <?php
                                            } 
                                        ?>
                                    </ul>
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
                                            <a href="{{URL::to('/trang-chu')}}">Trang ch???</a>
                                        </li>
                                        <li class="menu-dropdown">
                                            <a href="{{URL::to('/tat-ca-san-pham')}}">Danh m???c <i class="ion-ios-arrow-down"></i></a>
                                            <ul class="sub-menu">
                                                @foreach($category as $key => $cate)
                                                    <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="menu-dropdown">
                                            <a href="{{URL::to('/tat-ca-san-pham')}}">Th????ng hi???u <i class="ion-ios-arrow-down"></i></a>
                                            <ul class="sub-menu">
                                               @foreach($brand as $key => $brand)
                                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">{{$brand->brand_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="menu-dropdown">
                                            <a href="#">Blog</a>
                                            <ul class="sub-menu">
                                                @foreach($category_post as $key => $danhmucbaiviet)
                                                    <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{URL::to('/lien-he')}}">Li??n h???</a></li>
                                    </ul>
                                </div>
                                <!--Main Navigation End -->
                                <!--Header Bottom Account Start -->
                                <div class="header_account_area">
                                    <!--Seach Area Start -->
                                    <div class="header_account_list search_list">
                                        <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                                        <div class="dropdown_search">
                                            <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="">
                                                <input name="keywords_submit" id="keywords" placeholder="T??m ki???m s???n ph???m" type="text" />
                                                <div class="search-category bootstrap-select" id="search_ajax"></div>
                                                <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <!--Seach Area End -->
                                    <!--Contact info Start -->
                                    <div class="contact-link">
                                        <div class="phone">
                                            <p>Hotline:</p>
                                            <a href="tel:(+800)345678">(+093)1892222</a>
                                        </div>
                                    </div>
                                    <!--Contact info End -->
                                    <!--Cart info Start -->
                                    <div class="cart-info d-flex">
                                        <div class="mini-cart-warp">
                                            <a href="#" class="count-cart"><span class="show-cart"></span></a>
                                            <div class="mini-cart-content"></div>
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
                                            <a href="{{URL::to('/trang-chu')}}">Trang ch???</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::to('/tat-ca-san-pham')}}">Danh m???c</a>
                                            <ul>
                                                @foreach($category as $key => $cate_mb)
                                                <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_mb->category_id)}}">{{$cate_mb->category_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        {{-- <li>
                                            <a href="{{URL::to('/tat-ca-san-pham')}}">Th????ng hi???u</a>
                                            <ul>
                                                @foreach($brand as $key => $brand_mb)
                                                <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand_mb->brand_id)}}">{{$brand_mb->brand_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li> --}}
                                        <li>
                                            <a href="#">Blog</a>
                                            <ul>
                                                @foreach($category_post as $key => $danhmucbaiviet_mb)
                                                <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet_mb->cate_post_slug)}}">{{$danhmucbaiviet_mb->cate_post_name}}</a></li>
                                                @endforeach
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
            
            @yield('slider')
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
                                    <p class="text-info">Ch??o m???ng b???n ?????n v???i Watch Store</p>
                                    <div class="need-help">
                                        <p class="phone-info">
                                            C???n gi??p ??????
                                            <span>
                                                (+093) 189 2222 <br />
                                                (+096) 139 5555
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
                                    <h4 class="footer-herading">Th??m th??ng tin</h4>
                                    <div class="footer-links">
                                        <ul>
                                            <li><a href="#">V???n chuy???n</a></li>
                                            <li><a href="#">V??? ch??ng t??i</a></li>
                                            <li><a href="#">Thanh to??n an to??n</a></li>
                                            <li><a href="#">Li??n h??? ch??ng t??i</a></li>
                                            <li><a href="#">C???a h??ng</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-2 mt-res-md-50px mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">Li??n k???t</h4>
                                    <div class="footer-links">
                                        <ul>
                                            <li><a href="#">Gi?? t???t nh???t</a></li>
                                            <li><a href="#">S???n ph???m m???i</a></li>
                                            <li><a href="#">S???n ph???m b??n ch???y</a></li>
                                            <li><a href="">????ng nh???p</a></li>
                                            <li><a href="">T??i kho???n c???a t??i</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-4 mt-res-md-50px mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">T???i ngay</h4>
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
                                <p class="copy-text">Copyright ?? <a href="#"> NXC</a>. All Rights Reserved</p>
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
                
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="tab-content quickview-big-img">
                                    <div class="tab-pane fade show active" id="product_quickview_image"></div>
                                    {{-- <div class="tab-pane fade" id="product_quickview_gallery"></div> --}}
                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image End -->
                                <div class="quickview-wrap mt-15">
                                    <div class="quickview-slide-active owl-carousel nav owl-nav-style owl-nav-style-2" role="tablist">
                                        <a class="active" data-toggle="tab" id="product_quickview_image"></a>
                                        {{-- <a data-toggle="tab" href="#pro-2" id="product_quickview_gallery"></a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <form action="">
                                    @csrf
                                <div id="product_quickview_value"></div>
                                <div class="product-details-content quickview-content">
                                    <h2 id="product_quickview_title"></h2>
                                    <p class="reference">M?? s???n ph???m: <span id="product_quickview_id"></span></p>
                                    <div class="pricing-meta">
                                        <ul>
                                            <li class="old-price not-cut" id="product_quickview_price"></li>
                                        </ul>
                                    </div>
                                    <p id="product_quickview_desc"></p>
                                    <div id="beforesend_quickview"></div>
                                    <div class="pro-details-quality">
                                        <div class="pro-details-cart btn-hover" id="product_quickview_button">
                                    </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <script src="{{asset('public/frontend/js/simple.money.format.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <script type="text/javascript">
            click_cart_mini();
            show_cart();
            function click_cart_mini(){
                $.ajax({
                    url:"{{url('/click-cart-mini')}}",
                    method:"GET",
                    success:function(data){
                        $('.mini-cart-content').html(data);
                        }
                    });
            }
            function show_cart(){
                $.ajax({
                    url:"{{url('/show-cart')}}",
                    method:"GET",
                    success:function(data){
                        $('.show-cart').html(data);
                        }
                    });
                }
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
                        alert('L??m ??n ?????t nh??? h??n ' + cart_product_quantity);
                    }else{
                        $.ajax({
                            url: '{{url('/add-cart-ajax')}}',
                            method: 'POST',
                            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                            success:function(){
        
                                swal({
                                        title: "???? th??m s???n ph???m v??o gi??? h??ng",
                                        text: "Ti???p t???c mua s???m",
                                        showCancelButton: true,
                                        cancelButtonText: "Xem ti???p",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "??i ?????n gi??? h??ng",
                                        closeOnConfirm: false
                                    },
                                    function() {
                                        window.location.href = "{{url('/gio-hang')}}";
                                    });
                                    show_cart();
                                    click_cart_mini();
        
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            function Addtocart($product_id){
                    var id = $product_id;
                    // alert(id);
                    var cart_product_id = $('.cart_product_id_' + id).val();
                    var cart_product_name = $('.cart_product_name_' + id).val();
                    var cart_product_image = $('.cart_product_image_' + id).val();
                    var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                    var cart_product_price = $('.cart_product_price_' + id).val();
                    var cart_product_qty = $('.cart_product_qty_' + id).val();
                    var _token = $('input[name="_token"]').val();
                    if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                        alert('L??m ??n ?????t nh??? h??n ' + cart_product_quantity);
                    }else{
                        $.ajax({
                            url: '{{url('/add-cart-ajax')}}',
                            method: 'POST',
                            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                            success:function(){
        
                                swal({
                                        title: "???? th??m s???n ph???m v??o gi??? h??ng",
                                        text: "Ti???p t???c mua s???m",
                                        showCancelButton: true,
                                        cancelButtonText: "????ng",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "??i ?????n gi??? h??ng",
                                        closeOnConfirm: false
                                    },
                                    function() {
                                        window.location.href = "{{url('/gio-hang')}}";
                                    });
                                    show_cart();
                                    click_cart_mini();
        
                            }
                        });
                    }
            }
        </script>
        <script type="text/javascript">
                $(document).on('click','.add-to-cart-quickview',function(){
    
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
                        alert('L??m ??n ?????t nh??? h??n ' + cart_product_quantity);
                    }else{
                        $.ajax({
                            url: '{{url('/add-cart-ajax')}}',
                            method: 'POST',
                            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                            beforeSend: function(){
                                $("#beforesend_quickview").html("<h4 class='text text-primary mt-4'>??ang th??m s???n ph???m v??o gi??? h??ng</h4>");
                            },
                            success:function(){      
                                $("#beforesend_quickview").html("<h4 class='text text-success mt-4'>S???n ph???m ???? ???????c th??m v??o gi??? h??ng</h4>");
                                window.setTimeout(function(){ 
                                    location.reload();
                                } ,1000);
                            }
                        });
                    }
                });
            
        </script>
        
        <script type="text/javascript">

            $(document).ready(function(){
              $('.send_order').click(function(){
                  swal({
                    title: "X??c nh???n ????n h??ng",
                    text: "????n h??ng s??? ???????c th???c hi???n sau khi x??c nh???n, b???n c?? mu???n ?????t kh??ng?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "?????t h??ng",
                    cancelButtonText: "????ng",
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
                          var order_coupon = $('.order_coupon').val();
                          var total_after = $('.total_after').val();
                          var _token = $('input[name="_token"]').val();
  
                          $.ajax({
                              url: '{{url('/confirm-order')}}',
                              method: 'POST',
                              data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_coupon:order_coupon,total_after:total_after},
                              success:function(){
                                 swal("????n h??ng", "????n h??ng c???a b???n ???? ???????c g???i th??nh c??ng", "success");
                              }
                          });
  
                          window.setTimeout(function(){ 
                              //location.reload();
                                window.location.href = "{{url('/history')}}";
                          } ,2000);
  
                        } else {
                          swal("????ng", "????n h??ng ch??a ???????c ?????t, l??m ??n ho??n t???t ????n h??ng", "error");
                        }
                  });
              });
          });
      </script>
      <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query = $(this).val();
            if(query !='')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/autocomplete-ajax')}}",
                    method: 'POST',
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            }else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.li_search_ajax', function(){
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <script type="text/javascript">
        $('.xemnhanh').click(function(){
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/quickview')}}",
                method:"POST",
                dataType:"JSON",
                data:{product_id:product_id, _token:_token},
                success:function(data){
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                }
            });
        });
    </script>
    <script type="text/javascript">
        function Xemnhanh($product_id){
            var product_id = $product_id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/quickview')}}",
                method:"POST",
                dataType:"JSON",
                data:{product_id:product_id, _token:_token},
                success:function(data){
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var cate_id = $('.tabs_pro').data('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/product-tabs')}}",
                method:"POST",
                data:{cate_id:cate_id, _token:_token},
                success:function(data){
                    $('#tabs_product').html(data);
                    $('.owl-carousel').owlCarousel({
                        autoplay :   false,
                        smartSpeed : 1000,
                        nav :  true ,
                        loop: false,
                        dots :  false ,
                        items:4,
                        margin:30,
                        responsive:{
                            0:{
                                items:1,
                                autoplay: true,
                                loop: true,
                            },
                                
                            360:{
                                items:1,
                                autoplay: true,
                                loop: true,
                            },
                            500:{
                                items:2,
                                autoplay: true,
                                loop: true,
                
                            },
                            768:{
                                items:2,
                            },
                            992:{
                                items:2,
                            },
                            1024:{
                                items:2,
                            },
                            1200:{
                                items:3,
                            },
                            1300:{
                                items:4,
                            }
                        }
                    });
                }
            });
            $('.tabs_pro').click(function(){
                var cate_id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/product-tabs')}}",
                    method:"POST",
                    data:{cate_id:cate_id, _token:_token},
                    success:function(data){
                        $('#tabs_product').html(data);
                        $('.owl-carousel').owlCarousel({
                            autoplay :   false,
                            smartSpeed : 1000,
                            nav :  true ,
                            loop: false,
                            dots :  false ,
                            items:4,
                            margin:30,
                            responsive:{
                                0:{
                                    items:1,
                                    autoplay: true,
                                    loop: true,
                                },
                                    
                                360:{
                                    items:1,
                                    autoplay: true,
                                    loop: true,
                                },
                                500:{
                                    items:2,
                                    autoplay: true,
                                    loop: true,
                    
                                },
                                768:{
                                    items:2,
                                },
                                992:{
                                    items:2,
                                },
                                1024:{
                                    items:2,
                                },
                                1200:{
                                    items:3,
                                },
                                1300:{
                                    items:4,
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').on('change', function(){
                var url = $(this).val();
                if(url){
                    window.location = url;
                }
                return false;
            });
        });
    </script>
    <script>
        $(document).ready(function(){
        $( "#slider-range" ).slider({
        range: true,
        min: {{$min_price_range}},
        max: {{$max_price_range}},
        step: 100000,
        values: [ {{$min_price}}, {{$max_price}} ],
        slide: function( event, ui ) {
            $( "#amount" ).val(ui.values[ 0 ].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + " VN?? - " + ui.values[ 1 ].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + " VN?? ");
            $( "#start_price" ).val(ui.values[ 0 ]);
            $( "#end_price" ).val(ui.values[ 1 ]);
        }
        });
        $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
        " ?? - " + $( "#slider-range" ).slider( "values", 1 ).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + " ??");

    });
    </script>
   
    <script type="text/javascript">
        function Huydonhang(id){
            var order_id = id;
            var lydohuydon = '#lydohuydon_' + order_id;
            var lydo = $(lydohuydon).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{url('/huy-don-hang')}}",
                method: 'POST',
                data:{order_id:order_id, lydo:lydo, _token:_token},
                success:function(data){
                    alert("H???y ????n h??ng th??nh c??ng");
                    location.reload();
                }
            });
        }
    </script>

    <script>
        $(function () {
            $(".rateYo").rateYo({
                rating: 0,
                fullStar: true
            }).on("rateyo.set", function (e, data) {
                $('.rating').val(data.rating);
                });;
            });
    </script>
    <script>
        $('.rateYo_show').each(function() {
        $(this).rateYo({
            rating: this.dataset.rating,
            readOnly: true,
            starWidth: "18px",
        });
        });
    </script>
    <script>
        $("#btn_momo").hide();
        // $(function () {
        // $("#show_btn_momo").change(function() {
        //     var val = $(this).val();
        //     if(val === "0") {
        //         $("#btn_momo").hide();
        //     }
        //     else if(val === "1") {
        //         $("#btn_momo").show();
        //     }
        // });
        // });
    </script>
    </body>
</html>
