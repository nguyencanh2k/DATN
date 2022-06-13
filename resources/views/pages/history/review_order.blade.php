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
                        <li>Lịch sử đơn hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<div class="cart-main-area mtb-60px">
    <div class="container">
        <div class="col-lg-12 p-0">
            <div class="card border-0">
                <div class="card-body p-0">
                    <h4 class="card-title mb-4">Đánh giá sản phẩm</h4>
                    
                    <div class="table-responsive"> 
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {!! session()->get('message') !!}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {!! session()->get('error') !!}
                            </div>
                        @endif
                        @foreach($product_review as $key => $prd)
                        <div class="col-lg-12 border border-secondary rounded p-4 mb-4">
                            <div class="ratting-form-wrapper" style="padding-left: 0px">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img height="120px" width="120px" src="{{URL::to('public/uploads/product/'.$prd->product->product_image)}}" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <a href="{{URL::to('/chi-tiet-san-pham/'.$prd->product->product_id)}}"><h3>{{$prd->product->product_name}}</h3></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ratting-form">
                                    <form action="{{URL::to('/add-review')}}" method="post">
                                        @csrf
                                        <div class="star-box">
                                            <span>Đánh giá sao:</span>
                                            <div class="rateYo"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    @php
                                                        $customer_id = Session::get('customer_id')
                                                    @endphp
                                                    <input type="hidden" name="product_id" value="{{$prd->product_id}}">
                                                    <input type="hidden" name="order_id" value="{{$prd->order_id}}">
                                                    <input type="hidden" name="customer_id" value="{{$customer_id}}">
                                                    <input type="hidden" name="rating" class="rating">
                                                    <textarea name="comment" placeholder="Vui lòng viết đánh giá sản phẩm" required></textarea>
                                                    <input type="submit" value="Gửi" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
@endsection