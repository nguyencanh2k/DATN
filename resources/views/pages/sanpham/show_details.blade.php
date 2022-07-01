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
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
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
                            <div class="rateYo_show" data-rating="{{$review_avg}}"></div>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">Đánh giá ({{$review_count}})</a></span>
                    </div>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut">{{number_format($value->product_price,0,',','.').'VNĐ'}}</li>
                        </ul>
                    </div>
                    <div class="pro-details-list">
                        <ul>
                            {{-- <li><p><span>- Danh mục sản phẩm: {{$value->category_name}}</span></p></li> --}}
                            <li><p>{!!$value->product_desc!!}</p></li>
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
                                <a type="button" class="add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </form>
                    <div class="pro-details-social-info">
                        <span>Share</span>
                        <div class="social-info">
                            <ul>
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" 
                                    class="fb-xfbml-parse-ignore"><i class="ion-social-facebook"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="pro-details-policy">
                        <div class="blog-single-tags d-flex">
                            <span class="title">Tags: </span>
                            <ul class="tag-list">
                                @php
                                $tags = $value->product_tags;
                                $tags = explode(",",$tags);
                                @endphp
                                @foreach ($tags as $tag)
                                    <li><a class="tags_style" href="{{url('/tag/'.str_slug($tag))}}">{{$tag}} </a></li>
                                @endforeach
                            </ul>
                        </div>
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
                            <li>{!!$value->product_content!!}</li>
                        </ul>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane">
                    <div class="product-description-wrapper">
                        <p>{!!$value->product_desc!!}</p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane ">
                    <div class="row">
                        @foreach($review as $key => $rev)
                            <div class="col-lg-7">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{asset('public/frontend/images/onlinemoney.png')}}" height="100px" width="100px" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>{{$rev->customer->customer_name}}</h4>
                                                    </div>
                                                    <div class="rateYo_show" data-rating="{{$rev->rating}}"></div>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>
                                                    {{$rev->comment}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                <form action="">
                    @csrf
                    <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
                    <input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
                    <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
                    <input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
                    <input type="hidden" value="{{$lienquan->product_quantity}}" class="cart_product_quantity_{{$lienquan->product_id}}">
                    <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">
                <div class="img-block">
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}" class="thumbnail">
                        <img class="first-img" src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                        <img class="second-img" src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                    </a>
                </div>
                <div class="product-decs">
                    <h2><a class="product-link prd-name-hidden" href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}"><span>{{$lienquan->product_name}}</span></a></h2>
                    <div class="pricing-meta">
                        <ul>
                            <li class="current-price">{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</li>
                        </ul>
                    </div>
                </div>
                <div class="add-to-link">
                    <ul>
                        <li class="cart"><a class="cart-btn add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">Thêm vào giỏ hàng </a></li>
                    </ul>
                </div>
                </form>
            </article>
            <!-- Single Item -->
            @endforeach
        </div>
        <!-- Recent product slider end -->
    </div>
</section>
<div class="container mt-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h2>Bình luận về sản phẩm</h2>
            </div>
        </div>
    </div>
    @if(session()->has('message'))
            <div class="alert alert-success">
                {!! session()->get('message') !!}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">
                {!! session()->get('error') !!}
            </div>
        @endif
    <div class="row">
        <div class="col-lg-7">
            <div class="review-wrapper">
                @foreach($comment as $key => $cmt)
                    <div class="single-review border rounded border-info mb-3">
                        <div class="review-img">
                            <img src="{{asset('public/frontend/images/guest.png')}}" height="80" width="80" alt="" />
                        </div>
                        <div class="review-content">
                            <div class="review-top-wrap">
                                <div class="review-left">
                                    <div class="review-name">
                                        <h4>{{$cmt->comment_name}}</h4>
                                    </div>
                                </div>
                                <div class="review-left">
                                    <a href="#">{{$cmt->comment_date}}</a>
                                </div>
                            </div>
                            <div class="review-bottom">
                                <p>
                                    {{$cmt->comment}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @foreach($comment_reply as $key => $cmt_reply)
                        @if($cmt_reply->comment_parent==$cmt->comment_id)
                            <div class="single-review child-review border rounded border-success mb-3">
                                @if ($cmt_reply->comment_name == 'ADMIN')
                                    <div class="review-img">
                                        <img src="{{asset('public/frontend/images/avatar_admin.png')}}" height="80" width="80" alt="" />
                                    </div>
                                @else
                                    <div class="review-img">
                                        <img src="{{asset('public/frontend/images/guest.png')}}" height="80" width="80" alt="" />
                                    </div>
                                @endif
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-left">
                                            <div class="review-name">
                                                <h4>@ {{$cmt_reply->comment_name}}</h4>
                                            </div>
                                        </div>
                                        <div class="review-left">
                                            <a href="#">{{$cmt_reply->comment_date}}</a>
                                        </div>
                                    </div>
                                    <div class="review-bottom">
                                        {{$cmt_reply->comment}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="ratting-form-wrapper">
                        <div class="ratting-form">
                            <div class="single-review child-review mt-3">
                                <div class="review-content">
                                    <form action="{{URL::to('/reply-comment-guest')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$value->product_id}}">
                                        <input type="hidden" name="comment_id" value="{{$cmt->comment_id}}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-10">
                                                    <input placeholder="Họ tên" type="text" name="comment_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="reply_comment" placeholder="Bình luận" style="height: 100px;" required></textarea>
                                                    <input type="submit" value="Gửi" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-5">
            <div class="ratting-form-wrapper pl-50">
                <h3 class="mb-4">Thêm bình luận</h3>
                <div class="ratting-form">
                    <form action="{{URL::to('/add-comment')}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$value->product_id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rating-form-style mb-10">
                                    <input placeholder="Họ tên" type="text" name="comment_name" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="rating-form-style form-submit">
                                    <textarea name="comment" placeholder="Bình luận" required></textarea>
                                    <input type="submit" value="Gửi" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recent product area end -->
{{-- <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
<div class="fb-share-button" data-href="http://localhost:8080/DATN/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div> --}}
@endsection
