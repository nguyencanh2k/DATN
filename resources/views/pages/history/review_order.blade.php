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
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Đánh giá sản phẩm</h2>
            
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
                <div class="col-lg-12">
                    <div class="ratting-form-wrapper pl-50">
                        <div class="single-review">
                            <div class="review-content">
                                <div class="review-top-wrap">
                                    <div class="review-left">
                                        <div class="review-name">
                                            <h3>{{$prd->product_name}}</h3>
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
@endsection