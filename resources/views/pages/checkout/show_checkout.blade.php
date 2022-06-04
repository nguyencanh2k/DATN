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
                                                    <a href="#"><img width="120px" height="120px" src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="" /></a>
                                                </td>
                                                <td class="product-name"><a href="#">{{$cart['product_name']}}</a></td>
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
                                
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="cart-tax">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Chọn hình thức thanh toán</h4>
                                </div>
                                <div class="tax-wrapper" style="padding-bottom:50px">
                                    <p>Chọn 1 trong các hình thức thanh toán dưới đây</p>
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <select name="payment_select" class="email s-email s-wid payment_select">
                                                <option value="0">Thanh toán khi nhận hàng</option>
                                                <option value="1">Thanh toán bằng thẻ ngân hàng</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="discount-code-wrapper">
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
                        <div class="col-lg-4 col-md-12">
                            @if(Session::get('cart'))
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
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
                                                $total_coupon = $total - $cou['coupon_number'];
                                                // echo '<span>'.number_format($total_coupon,0,',','.').'đ</span>';
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
                                
                                @if(Session::get('fee'))
                                <h5>Phí vận chuyển :<span>{{number_format(Session::get('fee'),0,',','.')}}đ</span></h5>
                                    @php
                                        $total_after_fee = $total + Session::get('fee');
                                    @endphp
                                @endif 

                                <h4 class="grand-totall-title">Tổng đã giảm :
                                    @php 
											if(Session::get('fee') && !Session::get('coupon')){
												$total_after = $total_after_fee;
												echo '<span>'.number_format($total_after,0,',','.').'đ</span>';
											}elseif(!Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo '<span>'.number_format($total_after,0,',','.').'đ</span>';
											}elseif(Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												$total_after = $total_after + Session::get('fee');
												echo '<span>'.number_format($total_after,0,',','.').'đ</span>';
											}elseif(!Session::get('fee') && !Session::get('coupon')){
												$total_after = $total;
												echo '<span>'.number_format($total_after,0,',','.').'đ</span>';
											}

									@endphp
                                </h4>

                                @if(Session::get('fee'))
                                <a class="cart_quantity_delete mb-2" href="{{url('/del-fee')}}">Đặt lại phí vận chuyển</a></h5>
                                @endif 

                                @if(Session::get('coupon'))
                                <a class="check_coupon mb-2" name="unset-coupon" href="{{url('/unset-coupon')}}">Xóa mã giảm giá</a>
                                @endif
                                
                                <form action="{{url('/momo-payment')}}" method="post">
                                    @csrf
                                    <div class="Place-order mt-25 text-center">
                                        <input type="hidden" value="{{$total_after}}" name="total_momo" class="btn btn-hover cart-btn-2">
                                        <input type="submit" value="Thanh toán qua ATM Momo" name="payUrl" class="btn btn-hover cart-btn-2 w-100">
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
                    <h3>Tính phí vận chuyển</h3>
                    <hr class="w-100 p-0">
                    <form>
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Chọn thành phố</label>
                            <div class="col-sm-10 form-group">
                                <select name="city" id="city" class="form-control choose city">
                                    <option>----Chọn thành phố----</option>
                                    @foreach($city as $key => $ci)
                                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Chọn quận huyện</label>
                            <div class="col-sm-10 form-group">
                                <select name="province" id="province" class="form-control province choose">
                                    <option>----Chọn quận huyện----</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Chọn xã phường</label>
                            <div class="col-sm-10 form-group">
                                <select name="wards" id="wards" class="form-control wards">
                                    <option>----Chọn xã phường----</option>
                                </select>
                            </div>
                        </div>
                        <div class="Place-order mt-25 mb-5">
                            <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-hover cart-btn-2 calculate_delivery">
                        </div>
                    </form>
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
                        @if(Session::get('fee'))
                        <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                        @else 
                            <input type="hidden" name="order_fee" class="order_fee" value="30000">
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
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="shipping_notes" class="shipping_notes"></textarea>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-hover cart-btn-2 send_order">
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="col-lg-5">
                <div class="your-order-area">
                    <h3>Đơn hàng của bạn</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Sản phẩm</li>
                                    <li>Tổng tiền</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    <li><span class="order-middle-left">Product Name X 1</span> <span class="order-price">$329 </span></li>
                                    <li><span class="order-middle-left">Product Name X 1</span> <span class="order-price">$329 </span></li>
                                </ul>
                            </div>
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">Phí vận chuyển</li>
                                    <li>Freeship</li>
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total">Tổng tiền</li>
                                    <li>$329</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="Place-order mt-25">
                        <a class="btn-hover" href="#">Place Order</a>
                    </div>
                </div>
            </div> --}}
            
        </div>
    </div>
</div>
<!-- checkout area end -->
@endsection