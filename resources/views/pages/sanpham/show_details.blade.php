@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">{{$meta_title}}</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li>Chi tiết sản phẩm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
@foreach($product_details as $key => $value)
<!-- Shop details Area start -->
<section class="product-details-area mtb-60px">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="product-details-img product-details-tab">
                    <div class="zoompro-wrap zoompro-2">
                        <div class="zoompro-border zoompro-span">
                            <img class="zoompro" src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" data-zoom-image="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="" />
                        </div>
                    </div>
                    <div id="gallery" class="product-dec-slider-2">
                        @foreach ($gallery as $key => $gal)
                        <a class="active" data-image="{{URL::to('/public/uploads/gallery/'.$gal->gallery_image)}}" data-zoom-image="{{URL::to('/public/uploads/gallery/'.$gal->gallery_image)}}">
                            <img src="{{URL::to('/public/uploads/gallery/'.$gal->gallery_image)}}" alt="{{$gal->gallery_name}}" />
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h2>{{$value->product_name}}</h2>
                    <p class="reference">Mã sản phẩm:<span> {{$value->product_id}}</span></p>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">Reviews (1)</a></span>
                    </div>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut">{{number_format($value->product_price,0,',','.').'VNĐ'}}</li>
                        </ul>
                    </div>
                    <div class="pro-details-list">
                        <ul>
                            <li><p><span>- Danh mục sản phẩm: {{$value->category_name}}</span></p></li>
                            <li><p>- {!!$value->product_desc!!}</p></li>
                        </ul>
                    </div>
                    <form action="{{URL::to('/save-cart')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                        
                        <div class="pro-details-quality mt-0px">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box cart_product_qty_{{$value->product_id}}" type="number" name="qty" min="1" value="1" />
                                <input class="cart-plus-minus-box" type="hidden" name="productid_hidden" value="{{$value->product_id}}" />
                            </div>
                            <div class="pro-details-cart btn-hover">
                                {{-- <a type="submit" href="{{URL::to('/save-cart')}}"> + Add To Cart</a> --}}
                                {{-- <button class="add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">+ Add To Cart </button> --}}
                                <a type="button" class="add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </form>
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
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" 
                                    class="fb-xfbml-parse-ignore"><i class="ion-social-facebook"></i>
                                    </a>
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
                    <div class="pro-details-policy">
                        <ul>
                            <li><img src="assets/images/icons/policy.png" alt="" /><span>Dịch vụ gói quà miễn phí khi mua tại cửa hàng</span></li>
                        </ul>
                        <style type="text/css">
                            a.tags_style{
                                margin: 3px 2px;
                                border: 1px solid;
                                height: auto;
                                background: #4fb68d;
                                color: #fff;
                                padding: 3px;
                            }
                            a.tags_style:hover{
                                background: black;
                            }
                        </style>
                        <fieldset>
                            <legend>Tags</legend>
                            <p><i class="fa fa-tag"></i>
                            @php
                                $tags = $value->product_tags;
                                $tags = explode(",",$tags);
                            @endphp
                            @foreach ($tags as $tag)
                                <a class="tags_style" href="{{url('/tag/'.str_slug($tag))}}">{{$tag}}</a>
                            @endforeach
                            </p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop details Area End -->
<!-- product details description area start -->
<div class="description-review-area mb-60px">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-toggle="tab" href="#des-details1">Mô tả</a>
                <a class="active" data-toggle="tab" href="#des-details2">Chi tiết sản phẩm</a>
                <a data-toggle="tab" href="#des-details3">Đánh giá</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane active">
                    <div class="product-anotherinfo-wrapper">
                        <ul>
                            <li><span>Nội dung sản phẩm: </span>{!!$value->product_content!!}</li>
                        </ul>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane">
                    <div class="product-description-wrapper">
                        <p>{!!$value->product_desc!!}</p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">                           
                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
                        <form action="">
                            @csrf
                        <div class="col-lg-7"  id="comment_show">
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Thêm bình luận</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <span>Đánh giá sao:</span>
                                            <ul class="list-inline rating" title="Đánh giá sao">
                                                @for ($count=1; $count<=5; $count++)
                                                    @php
                                                        if($count<=$rating){
                                                            $color = 'color:#ffcc00;';
                                                        }
                                                        else{
                                                            $color = 'color:#ccc;';
                                                        }
                                                    @endphp
                                                    <li title="star_rating" id="{{$value->product_id}}-{{$count}}" 
                                                        data-index="{{$count}}" data-product_id="{{$value->product_id}}"
                                                        data-rating="{{$rating}}" class="rating" 
                                                        style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-10">
                                                    <input placeholder="Name" class="comment_name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="comment" class="comment_content" placeholder="Message"></textarea>
                                                    <input type="submit" class="send-comment" value="Submit" />
                                                </div>
                                                <div id="notify_comment"></div>
                                            </div>
                                        </div>
                                    </form>
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
<!-- product details description area end -->
@endforeach
<!-- Recent Add Product Area Start -->
<section class="recent-add-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Recent Product slider Start -->
        <div class="recent-product-slider owl-carousel owl-nav-style">
            @foreach($relate as $key => $lienquan)
            <!-- Single Item -->
            <article class="list-product">
                <div class="img-block">
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}" class="thumbnail">
                        <img class="first-img" src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                        <img class="second-img" src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                    </a>
                </div>
                <ul class="product-flag">
                    <li class="new">New</li>
                </ul>
                <div class="product-decs">
                    <a class="inner-link" href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}"><span>{{$lienquan->product_name}}</span></a>
                    {{-- <h2><a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}" class="product-link">{{$lienquan->product_name}}</a></h2> --}}
                    <div class="rating-product">
                        <i class="ion-android-star"></i>
                        <i class="ion-android-star"></i>
                        <i class="ion-android-star"></i>
                        <i class="ion-android-star"></i>
                        <i class="ion-android-star"></i>
                    </div>
                    <div class="pricing-meta">
                        <ul>
                            {{-- <li class="old-price">{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</li> --}}
                            <li class="current-price">{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</li>
                            <li class="discount-price">-10%</li>
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
            <!-- Single Item -->
            @endforeach
        </div>
        <!-- Recent product slider end -->
    </div>
</section>
<!-- Recent product area end -->
{{-- <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
<div class="fb-share-button" data-href="http://localhost:8080/DATN/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div> --}}
@endsection
