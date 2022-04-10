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
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <?php
                        $content = Cart::content();
                        
                        ?>
                        <table>
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
                                @foreach($content as $v_content)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" alt="" /></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{$v_content->name}}</a></td>
                                    <td class="product-price-cart"><span class="amount">{{number_format($v_content->price).' '.'vnđ'}}</span></td>
                                    
                                    <form action="{{URL::to('/update-cart-quantity')}}" method="post">
                                        {{ csrf_field() }}
                                        <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="cart_quantity" value="{{$v_content->qty}}">
                                            <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
                                            <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                            
                                        </div>
                                    </td></form>
                                    <td class="product-subtotal">
                                        <?php
                                        $subtotal = $v_content->price * $v_content->qty;
                                        echo number_format($subtotal).' '.'vnđ';
                                        ?>    
                                    </td>
                                    <td class="product-remove">
                                        <a href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
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
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <button>Update Shopping Cart</button>
                                    <a href="#">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * Country
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Region / State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select mb-25px">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text" />
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <form>
                                    <input type="text" required="" name="name" />
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total products <span>{{Cart::priceTotal(0).' '.'vnđ'}}</span></h5>
                            <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox" /> Standard <span>{{Cart::tax(0).' '.'vnđ'}}</span></li>
                                    <li><input type="checkbox" /> Express <span>{{Cart::tax(0).' '.'vnđ'}}</span></li>
                                </ul>
                            </div>
                            <h4 class="grand-totall-title">Grand Total <span>{{Cart::total(0).' '.'vnđ'}}</span></h4>
                            <?php
                                $customer_id = Session::get('customer_id');
                                if($customer_id!=NULL){ 
                            ?>
                               <a href="{{URL::to('/checkout')}}">Thanh toán</a>
                            <?php 
                                }else{
                            ?>
                                <a href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                            <?php
                                } 
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart area end -->
@endsection