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
                        <li>Chi tiết đơn hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<div class="cart-main-area mtb-60px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body p-0">
                        <?php
                            $message= Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-danger">'.$message.'</span>';
                                Session::put('message', null);
                            }
                            ?>
                        <h4 class="card-title">Thông tin khách hàng</h4>
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Tên khách hàng:</strong> <span>{{$customer->customer_name}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Email:</strong> <span>{{$customer->customer_email}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Số điện thoại:</strong> <span>{{$customer->customer_phone}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body p-0">
                        <?php
                            $message= Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-danger">'.$message.'</span>';
                                Session::put('message', null);
                            }
                            ?>
                        <h4 class="card-title">Thông tin vận chuyển</h4>
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Tên người nhận:</strong> <span>{{$shipping->shipping_name}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Địa chỉ:</strong> <span>{{$shipping->shipping_address}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Số điện thoại:</strong> <span>{{$shipping->shipping_phone}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Email:</strong> <span>{{$shipping->shipping_email}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Ghi chú:</strong> 
                                <span>
                                    @if($shipping->shipping_notes !=null) {{$shipping->shipping_notes}}
                                    @else Không có
                                    @endif
                                </span>
                            </li>
                            <li class="mb-1"><strong class="text-dark mr-4">Hình thức thanh toán:</strong> 
                                <span>
                                    @if($shipping->shipping_method==0) Thanh toán khi nhận hàng 
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body p-0">
                        <h4 class="card-title">Liệt kê chi tiết đơn hàng</h4>
                        
                        <div class="table-responsive"> 
                            <?php
                            $message= Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-danger">'.$message.'</span>';
                                Session::put('message', null);
                            }
                            ?>
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Mã giảm giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Giá sản phẩm</th>
                                        <th scope="col">Tổng tiền</th>
                                        @if ($order_status == 2)
                                        <th scope="col"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                        $total = 0;
                                    @endphp
                                    @foreach($order_details as $key => $details)
                                    @php
                                        $i++;
                                        $subtotal = $details->product->product_price*$details->product_sales_quantity;
                                        $total+=$subtotal;
                                    @endphp
                                    <tr class="color_qty_{{$details->product->product_id}}">
                                        <td>{{$i}}</td>
                                        <td>{{$details->product->product_name}}</td>
                                        <td>@if($details->product_coupon!='no')
                                            {{$details->product_coupon}}
                                        @else 
                                            Không có
                                        @endif
                                        </td>
                                        <td>
                                            {{$details->product_sales_quantity}}
                                        </td>
                                        <td>{{number_format($details->product->product_price ,0,',','.')}}đ</td>
                                        <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                                        @if ($order_status == 2)
                                            <td><a href="{{URL::to('/review-order/'.$details->order_id)}}" data-toggle="tooltip" data-placement="top" title="View">Đánh giá sản phẩm</a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="8">
                                            @php 
                                                $total_coupon = 0;
                                            @endphp
                                            @if($coupon_condition==1)
                                                @php
                                                $total_after_coupon = ($total*$coupon_number)/100;
                                                echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').' đ'.'</br>';
                                                $total_coupon = $total - $total_after_coupon ;
                                                @endphp
                                            @else 
                                                @php
                                                echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').' đ'.'</br>';
                                                $total_coupon = $total - $coupon_number ;
            
                                                @endphp
                                            @endif
                                            Thanh toán: {{number_format($total_coupon,0,',','.')}} đ     
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection