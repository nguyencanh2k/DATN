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
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thông tin khách hàng</h4>
                
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
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->customer_email}}</td>
                                <td>{{$customer->customer_phone}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thông tin vận chuyển</h4>
                
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
                                <th scope="col">Tên người nhận</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Hình thức thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$shipping->shipping_name}}</td>
                                <td>{{$shipping->shipping_address}}</td>
                                <td>{{$shipping->shipping_phone}}</td>
                                <td>{{$shipping->shipping_email}}</td>
                                <td>{{$shipping->shipping_notes}}</td>
                                <td>
                                    @if($shipping->shipping_method==0) Thanh toán khi nhận hàng 
                                    @else Thanh toán bằng thẻ ngân hàng
                                    @endif    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
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
                            $subtotal = $details->product_price*$details->product_sales_quantity;
                            $total+=$subtotal;
                        @endphp
                        <tr class="color_qty_{{$details->product_id}}">
                            <td>{{$i}}</td>
                            <td>{{$details->product_name}}</td>
                            <td>@if($details->product_coupon!='no')
                                {{$details->product_coupon}}
                              @else 
                                Không có
                              @endif
                            </td>
                            <td>
                                <input type="number" readonly min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
                                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

                                <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                  
                                <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
                  
                            </td>
                            <td>{{number_format($details->product_price ,0,',','.')}}đ</td>
                            <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                            @if ($order_status == 2)
                                <td><a href="{{URL::to('/review-order/'.$details->order_code)}}" data-toggle="tooltip" data-placement="top" title="View">Đánh giá sản phẩm</a></td>
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
            <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
        </div>
    </div>
</div>
@endsection