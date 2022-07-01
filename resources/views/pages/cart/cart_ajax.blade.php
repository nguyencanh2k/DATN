@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Giỏ hàng</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                        <li>Giỏ hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<!-- cart area start -->
<div class="cart-main-area mtb-60px">
    <div class="container">
        <h3 class="cart-page-title">Giỏ hàng của bạn</h3>
        <div class="row">
            @if(session()->has('message'))
                    <div class="alert alert-success ml-3">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger ml-3">
                        {!! session()->get('error') !!}
                    </div>
            @endif
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="{{url('/update-cart')}}" method="post">
                    @csrf
                    @if(Session::get('cart')==true)
                    <div class="table-content table-responsive cart-table-content">
                        <table class="w-100">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach(Session::get('cart') as $key => $cart)
                                @php
                                    $subtotal = $cart['product_price']*$cart['product_qty'];
                                    $total+=$subtotal;
                                @endphp
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img style="width: 120px; height: 120px;" src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="" /></a>
                                    </td>
                                    <td class="product-name"><a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}">{{$cart['product_name']}}</a></td>
                                    <td class="product-price-cart"><span class="amount">{{number_format($cart['product_price'],0,',','.')}}đ</span></td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                        </div>
                                    </td>
                                    <td class="product-subtotal"> {{number_format($subtotal,0,',','.')}}đ
                                    </td>
                                    <td class="product-remove">
                                        <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{URL::to('/')}}">Tiếp tục mua sắm</a>
                                </div>
                                <div class="cart-clear">
                                    <button type="submit" name="update_qty">Cập nhật giỏ hàng</button>
                                    <a href="{{url('/del-all-product')}}">Xóa tất cả sản phẩm trong giỏ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-danger">
                        Giỏ hàng trống
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 d-flex">
                {{-- <div class="discount-code-wrapper flex-fill">
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gray">Mã giảm giá</h4>
                    </div>
                    <div class="discount-code">
                        <p>Enter your coupon code if you have one.</p>
                        <form method="POST" action="{{url('/check-coupon')}}">
                            @csrf
                            <input class="input-disount-code" type="text" name="coupon" />
                            <button class="cart-btn-2 check_coupon" name="check_coupon" type="submit">Áp dụng mã giảm giá</button>
                        </form>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-6 col-md-12 d-flex">
                @if(Session::get('cart'))
                <div class="grand-totall flex-fill">
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gary-cart">Tổng tiền</h4>
                    </div>
                    <h5>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></h5>
                    @if(Session::get('coupon'))
                    <h5>
                        @foreach(Session::get('coupon') as $key => $cou)
                        @if($cou['coupon_condition']==1)
                            Mã giảm : {{$cou['coupon_number']}} %
                            <span>
                                @php 
                                    $total_coupon = ($total*$cou['coupon_number'])/100;
                                    echo '<span>'.number_format($total_coupon,0,',','.').'đ</span>';
                                @endphp
                            </span>
                    </h5>
                    <h4 class="grand-totall-title">Tổng thanh toán :<span>{{number_format($total-$total_coupon,0,',','.')}}đ</span></h4>
					@elseif($cou['coupon_condition']==2)
                    <h5>Mã giảm :  <span>{{number_format($cou['coupon_number'],0,',','.')}}đ</span>
						<span>
							@php 
                                                if($cou['coupon_number']>=$total){
                                                    $cou['coupon_number'] = $total;
                                                    $total_coupon = $total - $cou['coupon_number'];
                                                }else{
                                                    $total_coupon = $total - $cou['coupon_number'];
                                                }
							@endphp
						</span>
					<h4 class="grand-totall-title">Tổng thanh toán :<span>{{number_format($total_coupon,0,',','.')}}đ</span></h4>
					@endif
						@endforeach
                    </h5>
                    @endif
                    
                    @if(Session::get('coupon'))
                    <a class="check_coupon mb-2" name="unset-coupon" href="{{url('/unset-coupon')}}">Xóa mã giảm giá</a>
                    @endif
                    @if(Session::get('customer_id'))
	                    <a href="{{url('/checkout')}}">Đặt hàng</a>
	                @else 
	                    <a href="{{url('/login-checkout')}}">Đặt hàng</a>
					@endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- cart area end -->
@endsection