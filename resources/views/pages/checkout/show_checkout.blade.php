@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Thanh toán</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        <li>Thanh toán</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<!-- checkout area start -->
<div class="checkout-area mt-60px mb-40px">
    <div class="container">
        <div class="row">
            <!-- cart area start -->
            <div class="cart-main-area mtb-60px">
                <div class="container">
                    <h3 class="cart-page-title">Giỏ hàng của bạn</h3>
                    <div class="row">
                        @if(session()->has('message'))
                                <div class="alert alert-success ml-3">
                                    {{ session()->get('message') }}
                                </div>
                            @elseif(session()->has('error'))
                                <div class="alert alert-danger ml-3">
                                    {{ session()->get('error') }}
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
                                                    <a href="#"><img width="120px" height="120px" src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="" /></a>
                                                </td>
                                                <td class="product-name"><a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}">{{$cart['product_name']}}</a></td>
                                                <td class="product-price-cart"><span class="amount">{{number_format($cart['product_price'],0,',','.')}}đ</span></td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" readonly disabled name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"> {{number_format($subtotal,0,',','.')}}đ</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="cart-tax flex-fill">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Khách hàng vui lòng chuẩn bị đủ tiền khi nhận hàng</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="discount-code-wrapper flex-fill">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Mã giảm giá</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Nhập mã giảm giá (nếu có)</p>
                                    <form method="POST" action="{{url('/check-coupon')}}">
                                        @csrf
                                        <input class="input-disount-code" type="text" name="coupon" />
                                        <button class="cart-btn-2 check_coupon" name="check_coupon" type="submit">Áp dụng mã giảm giá</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 d-flex">
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
                                    
                                            @php 
                                                $total_after_coupon = $total-$total_coupon;
                                            @endphp
                                    </h4>
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
                                            @php 
                                                $total_after_coupon = $total_coupon;
                                            @endphp
                                    </h4>
                                @endif
                                    @endforeach
                                </h5>
                                @endif
                                

                                <h4 class="grand-totall-title">Tổng thanh toán :
                                    @php 
											if(Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo '<span>'.number_format($total_after,0,',','.').'đ</span>';
											}elseif(!Session::get('coupon')){
												$total_after = $total;
												echo '<span>'.number_format($total_after,0,',','.').'đ</span>';
											}

									@endphp
                                </h4>

                                @if(Session::get('coupon'))
                                <a class="check_coupon mb-2" name="unset-coupon" href="{{url('/unset-coupon')}}">Xóa mã giảm giá</a>
                                @endif
                                
                                <form action="{{url('/momo-payment')}}" method="post">
                                    @csrf
                                    <div class="Place-order mt-25 text-center" id="btn_momo">
                                        <input type="hidden" value="{{$total_after}}" name="total_momo" class="btn btn-hover cart-btn-2">
                                        <input type="submit" value="Thanh toán qua Momo" name="payUrl" class="btn btn-hover cart-btn-2 w-100">
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="billing-info-wrap">
                    <h3>Thông tin thanh toán</h3>
                    <hr class="w-100 p-0">
                    <form method="post">
                        @csrf
                        @if(Session::get('coupon'))
							@foreach(Session::get('coupon') as $key => $cou)
								<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
							@endforeach
						@else 
							<input type="hidden" name="order_coupon" class="order_coupon" value="no">
						@endif
                        @if(Session::get('cart'))
                            <input type="hidden" value="{{$total_after}}" name="total_after" class="total_after">
                        @endif
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Họ và tên</label>
                                    <input type="text" name="shipping_name" class="shipping_name" required/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="shipping_phone" class="shipping_phone" required/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Email</label>
                                    <input type="text" name="shipping_email" class="shipping_email" required/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="shipping_address" class="shipping_address" required/>
                                </div>
                            </div>
                        </div>
                        <div class="additional-info-wrap">
                            <h4>Thông tin thêm</h4>
                            <div class="additional-info">
                                <label>Ghi chú đơn hàng</label>
                                <textarea placeholder="" name="shipping_notes" class="shipping_notes"></textarea>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-hover cart-btn-2 send_order">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout area end -->
@endsection