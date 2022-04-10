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
                        <li><a href="index.html">Trang chủ</a></li>
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
            <div class="col-lg-12">
                <div class="your-order-area">
                    <h3>Đơn hàng của bạn</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="table-content table-responsive cart-table-content">
                            <?php
                            $content = Cart::content();
                            
                            ?>
                            <table class=" w-100">
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
                                    @foreach($content as $v_content)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="100" height="100" alt="" /></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$v_content->name}}</a></td>
                                        <td class="product-price-cart"><span class="amount">{{number_format($v_content->price).' '.'vnđ'}}</span></td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <form action="{{URL::to('/update-cart-quantity')}}" method="post">
                                                    {{ csrf_field() }}
                                                <input class="cart-plus-minus-box" type="text" name="cart_quantity" value="{{$v_content->qty}}">
                                                <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
                                                <input type="hidden" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                                </form>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <?php
                                            $subtotal = $v_content->price * $v_content->qty;
                                            echo number_format($subtotal).' '.'vnđ';
                                            ?>    
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="your-order-product-info">
                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total">Tổng tiền</li>
                                    <li>{{Cart::total(0).' '.'vnđ'}}</li>
                                </ul>
                            </div>
                        </div>
                        <form action="{{URL::to('/order-place')}}" method="post">
                            {{ csrf_field() }}
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-one">
                                                <h4 class="panel-title">
                                                    <input class="checkout-toggle2" type="checkbox" name="payment_option" value="1"/>
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#method1">
                                                        Thanh toán bằng thẻ ATM
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="method1" class="panel-collapse collapse show">
                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-two">
                                                <h4 class="panel-title">
                                                    <input class="checkout-toggle2" type="checkbox" name="payment_option" value="2"/>
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#method2">
                                                        Thanh toán khi nhận hàng
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="method2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-three">
                                                <h4 class="panel-title">
                                                    <input class="checkout-toggle2" type="checkbox" name="payment_option" value="3"/>
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#method3">
                                                        Thanh toán bằng thẻ ghi nợ
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="method3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Place-order mt-5">
                                <input type="submit" value="Đặt hàng" name="send_order_place" class="btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout area end -->
@endsection